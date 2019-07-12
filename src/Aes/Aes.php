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
    public function encrypt($String='',$key=''){

        $data = openssl_encrypt($String, 'AES-128-ECB', $key, OPENSSL_RAW_DATA);
        $data = strtolower(bin2hex($data));
        return $data;
    }

    /**
     * 解密
     */
    public function decrypt( $String='',$key=''){
        $decrypted = openssl_decrypt(hex2bin($String), 'AES-128-ECB', $key, OPENSSL_RAW_DATA);
        return $decrypted;
    }


    /**
     * @param $data
     * @param string $secretKey
     * @param array $key
     */
    public function encryptArray($data,$secretKey='',$key=[]){
        if(empty($key)) return $data;
        foreach ($data as $kk=>$vv){
            if(is_array($vv)){
                foreach ($vv as $k=>$v){
                    if(in_array($kk,$key)){
                        $data[$kk][$k] = $this->encrypt($vv,$secretKey);
                    }
                }
            }else{
               if(in_array($kk,$key)){
                 $data[$kk] = $this->encrypt($vv,$secretKey);
               }
            }
        }
        return $data;
    }


    /**
     * @param $data
     * @param string $secretKey
     * @param array $key
     */
    public function decryptArray($data,$secretKey='',$key=[]){
        if(empty($key)) return $data;
        foreach ($data as $kk=>$vv){
            if(is_array($vv)){
                foreach ($vv as $k=>$v){
                    if(in_array($kk,$key)){
                        $data[$kk][$k] = $this->decrypt($vv,$secretKey);
                    }
                }
            }else{
                if(in_array($kk,$key)){
                    $data[$kk] = $this->decrypt($vv,$secretKey);
                }
            }
        }
        return $data;
    }
}