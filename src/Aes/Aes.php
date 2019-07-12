<?php
/**
 * author : abel.tang
 * Date: 2019-07-12  14:16
 */
namespace Aes;
/**
 * Class Aes
 */
class Aes
{
    /**
     * @param array $data
     * @param array $field
     * @param string $key
     * @return array|string
     */
    public function encrypt(&$data =[],$field = [],$key=''){
        $data = openssl_encrypt($data, 'AES-128-ECB', $key, OPENSSL_RAW_DATA);

        $data = strtolower(bin2hex($data));

        return $data;
    }

    /**
     * 解密
     */
    public function decrypt(&$data =[],$field = [],$key=''){
        $decrypted = openssl_decrypt(hex2bin($data), 'AES-128-ECB', $key, OPENSSL_RAW_DATA);

        return $decrypted;
    }

}