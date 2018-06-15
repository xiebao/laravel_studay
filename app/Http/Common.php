<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/19
 * Time: 15:45
 */

namespace App\Http;

use App\Http\Model\Admin;
use Illuminate\Http\Request;
use Storage;
use Redis;
use Symfony\Component\HttpFoundation\HeaderBag;

class Common
{
    /**
     * 上传文件并保存
     *
     * @param Request $request
     * @return boolean|string 失败返回false, 成功返回保存地址
     */
    public static function upload(Request $request)
    {
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $file = $request->file('image');

            // 上传图片类型不正确
            if (!in_array($file->getMimeType(), [
                'image/png',
                'image/gif',
                'image/jpeg',
            ])) {
                return false;
            }

            // 图片过大
            if ($file->getSize() > 1024 * 1024) return false;

            // 保存图片并返回图片地址(前端可访问的url地址)
            $filePath = date('Y/m');
            $fileName = md5($file->getBasename() . time()) . '.' . $file->extension();
            //$file->store($filePath, $fileName);

            Storage::put(
                $filePath . '/' . $fileName,
                file_get_contents($file->getRealPath())
            );
            return config('filesystems.disks.local.url') . '/' . $filePath . '/' . $fileName;
        }

        return false;
    }


    public static function removeFile($fileName)
    {
        $file = base_path('public/') . $fileName;

        if (file_exists($file)) unlink($file);
    }


    /**
     * 请求成功
     *
     * @param array $data
     * @return array
     */
    public static function success(array $data = [])
    {
        return [
            'code' => config('common.success')
        ] + $data;
    }

    /**
     * 请求失败
     *
     * @param string $message 错误信息
     * @param integer|boolean $code 请求码
     * @return array
     */
    public static function error($message, $code = false)
    {
        return [
            'code' => $code ?: config('common.error'),
            'message' => $message
        ];
    }

    /**
     * rsa
     * 对rsa加密的字符串进行解密
     *
     * @param $rsa
     * @return mixed
     */
    public static function decrypt($rsa)
    {
        /* $privateKey = openssl_pkey_get_private(file_get_contents(base_path('private_key.pem')));

         $hexEncryptData = ($sign);  //十六进制数据

         $encryptData = base64_decode($hexEncryptData); // 对密文base64解码

         // $decryptData为解密明文，解密函数为PHP自带函数
         openssl_private_decrypt($encryptData, $decryptData, $privateKey, OPENSSL_PKCS1_PADDING);

         return $decryptData;*/

        //
        /**
         * 获取秘钥文件的内容
         *
         * 生成秘钥文件
         * 1. openssl genrsa -out private_key.pem 2048
         *
         * 获取modulus内容,需要传给前端通过该值进行加密(即public key)
         * 2. openssl rsa -inform PEM -modulus -noout < private_key.pem
         *
         * 获取exponent值(一般默认为指数e的16进制值, 0x10001), 前端需要该参数进行加密("10001")
         * 3. openssl rsa -inform PEM -text -noout < private_key.pem
         */
        $privateKey = openssl_pkey_get_private(file_get_contents(base_path('private_key.pem')));

        $hexEncryptData = trim($rsa);  //十六进制数据
        try {
            $encryptData = pack("H*", $hexEncryptData); //对十六进制数据进行转换
        } catch (\Exception $e) {
            return false;
        }

        openssl_private_decrypt($encryptData, $decryptData, $privateKey, OPENSSL_PKCS1_PADDING); // 解密

        return $decryptData;
    }


    /**
     * 签名校验
     *
     * @param $headers
     * @param boolean $accessToken 当获取需要用户登录才可以得到的数据时需要该参数为true
     * @param string $requestIp 客户端IP, 当获取需要用户登录才可以得到的数据时需要填写,否则无法通过校验
     * @return integer
     */
    public static function checkSign(HeaderBag $headers, $accessToken = false, $requestIp = null)
    {
        // header中不存在sign
        if (!$headers->get('sign')) return false;

        // 一样的签名只可以请求一次
        if (Redis::get($headers->get('sign'))) return false;
        $sign = self::decrypt($headers->get('sign'));


        // 解密失败
        if (empty($sign)) return false;

        // 将sign转化为数组
        $sign = json_decode($sign, true);

        // Sign格式不为数组或为空数组,不满足要求
        if (!is_array($sign) || empty($sign)) return false;

        // 数据验签

        // 不存在时间戳
        if (!isset($sign['timestamp'])) return false;

        // 浏览器类型不匹配
        if (!isset($sign['type']) || !$sign['type'] || $sign['type'] != $headers->get('type')) return false;

        // 版本不匹配
        if (!isset($sign['version']) || !$sign['version'] || $sign['version'] != $headers->get('version')) return false;

        // 还可以进行其他的匹配进一步增加安全性


        // 签名超时, 无效
        if (time() - $sign['timestamp'] / 1000 > config('common.sign_timeout')) return false;


        if ($accessToken) {
            // 用户登录token不存在
            if (!$accessToken = $headers->get('accessToken')) return false;

            $token = self::decrypt($accessToken);

            // token解密失败
            if (empty($token)) return false;

            parse_str($token, $tokenArr);

            // token 格式不正确
            if (empty($tokenArr)) return false;

            if (!isset($tokenArr['token']) || !isset($tokenArr['timestamp']) || !isset($tokenArr['nonce'])) return false;

            // 真实token
            $realToken = md5($tokenArr['timestamp'] . $tokenArr['token']);

            $admin = Admin::where([
                'token' => $realToken,
                'last_login_ip' => $requestIp, // 用户IP地址
            ])->first();

            if (!$admin) return false;

            // token失效
            if (time() - $tokenArr['timestamp'] > config('common.login_timeout')) {

                // 重置服务器token
                $admin->update([
                    'token' => md5(uniqid() . md5(time()))
                ]);

                return config('common.logout');
            }
        }


        // 校验通过,保存数据.防止重复请求
        Redis::setex($headers->get('sign'), config('common.redis_timeout'), 1);

        return true;
    }
}