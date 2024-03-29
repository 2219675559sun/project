<?php

namespace App\Http\Rsa;

class Rsa
{
    private static $_privkey = '';
    private static $_pubkey = '';
    private static $_isbase64 = false;
    /**
     * 初始化key值
     * @param  string  $privkey  私钥
     * @param  string  $pubkey   公钥
     * @param  boolean $isbase64 是否base64编码
     * @return null
     */
    public  function init($privkey, $pubkey, $isbase64=false){
        self::$_privkey = $privkey;
        self::$_pubkey = $pubkey;
        self::$_isbase64 = $isbase64;
    }
    /**
     * 私钥加密
     * @param  string $data 原文
     * @return string       密文
     */
    public  function priv_encode($data){
        $outval = '';

        $res = openssl_pkey_get_private(self::$_privkey);

        openssl_private_encrypt($data, $outval, $res);
        if(self::$_isbase64){
            $outval = base64_encode($outval);
        }
        return $outval;
    }
    /**
     * 公钥解密
     * @param  string $data 密文
     * @return string       原文
     */
    public  function pub_decode($data){
        $outval = '';
        if(self::$_isbase64){
            $data = base64_decode($data);
        }
        $res = openssl_pkey_get_public(self::$_pubkey);
        openssl_public_decrypt($data, $outval, $res);
        return $outval;
    }
    /**
     * 公钥加密
     * @param  string $data 原文
     * @return string       密文
     */
    public  function pub_encode($data){
        $outval = '';
        $res = openssl_pkey_get_public(self::$_pubkey);
        openssl_public_encrypt($data, $outval, $res);
        if(self::$_isbase64){
            $outval = base64_encode($outval);
        }
        return $outval;
    }
    /**
     * 私钥解密
     * @param  string $data 密文
     * @return string       原文
     */
    public  function priv_decode($data){
        $outval = '';
        if(self::$_isbase64){
            $data = base64_decode($data);
        }
        $res = openssl_pkey_get_private(self::$_privkey);
        openssl_private_decrypt($data, $outval, $res);
        return $outval;
    }
    /**
     * 创建一组公钥私钥
     * @return array 公钥私钥数组
     */
    public function new_rsa_key(){
        $res = openssl_pkey_new();
        openssl_pkey_export($res, $privkey);
        $d= openssl_pkey_get_details($res);
        $pubkey = $d['key'];
        return array(
            'privkey' => $privkey,
            'pubkey'  => $pubkey
        );
    }
}

//自己的公钥
/* -----BEGIN RSA PRIVATE KEY-----
                MIICWwIBAAKBgQC/oiF4yRrucHhAxLKdghO8ufQ/wHewOcqRsYXfQ51cJVUlk9f8
                R5fIpA3lx9C7lf8nczLp6PL+wnaDHw96YIRsCy5cDMaEFhknt0Bc4Q9O7Lsz9tG/
                9FPX/0BR1ZlMAWvpvuoaJYobh5OMiePKs4Lp7xD06W9LcTBCQjs6U+E9CwIDAQAB
                AoGAXVXqV5obs+azq1giZvTkCBfKDwL/SKXdM/jy6ztTeX31asgHeqikFOVSn4gi
                8jqse9pwAd2j/NFaR6LpNwGrfNuf9PKcrtp+0mhb4nygzagotdfSW8c0xt6y03eO
                9uAFTf4MMrFnSQJNt/9tnyhZbx5TXYQmJjhjAZ+l+24WdgECQQDxuDeIHO6c/lvo
                Y2U8mLMC00N+6K591H1KDrvY9ezTyaPZ3zZLjW2Q+DtmSBE3krk+pWoomlqKgDZR
                3e/DPZFRAkEAyvRn3bQ5Bka06Mwy275CBGrXsr5v1I1bUk8VEcqmiGMntmFfULto
                uLO+XOwxaovIjwlo8dIpwkyEigggL73xmwJAdU5efMr1rfDvL4dVMSQ189ANOIC5
                dc1yhEdEOJWYumtn/isKUX4wRyOAyDF/UYX+Kn3iWBQYjpCMTAy19/1gEQJANCGn
                dFlQtH4BBjM9dRhf2Mag9TbZft14caICpXlKYYomr0A/vXsGITt6UGATKW0SbTtb
                i5ISS+hfuxzvN5QwtQJAbiOen7i53s2lK2/TY96jgINvv/xDXwxZjK/uWjzdBhVY
                CqwdCov5e3n8zr7cxvvxj8XaqqYbstcbty+t/AYoxQ==
                -----END RSA PRIVATE KEY----- */
//自己的私钥
/* -----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQC/oiF4yRrucHhAxLKdghO8ufQ/
wHewOcqRsYXfQ51cJVUlk9f8R5fIpA3lx9C7lf8nczLp6PL+wnaDHw96YIRsCy5c
DMaEFhknt0Bc4Q9O7Lsz9tG/9FPX/0BR1ZlMAWvpvuoaJYobh5OMiePKs4Lp7xD0
6W9LcTBCQjs6U+E9CwIDAQAB
-----END PUBLIC KEY----- */

//举个粒子
/*$Rsa = new Rsa();
// $keys = $Rsa->new_rsa_key(); //生成完key之后应该记录下key值，这里省略
// p($keys);
$privkey = "-----BEGIN RSA PRIVATE KEY-----
MIICWwIBAAKBgQCwemRwZ37Ker0hPjnUca3Gd1x65MB+IpgkHPrfFykU/kE1l5lv
l/umNihQ7rmc/pOXLNHVWGSrTL7P4LxF2F9nkKg33MYTWh3/KRUdEuYNKhzJubHh
WeE1cm1leWcJ+EQkCq8RqrRfIxNzkHZUAume1FadGpWtEcS4BQ5WaeXOmQIDAQAB
AoGAFyqJ4sODPlssVp/PgZbGpAXpKuy6ZBRwelUfjYeByhKyRrG235JI44G6ex1L
WlOE1lR42xO2a1IwviMXM+f6ZesdQ1XOS1H/i531tOz6992oeEtOwGy+xL3Ciktp
kgc4qKyUTCzTh/JzmSfdjqItsBOUzbKX0RyJ3zE0uptIws0CQQDcWGjVIFmM4T6x
7xU905m/G8ZVQ4J5BEpUPKGO4c+5DBV0r69jVTKDU40ivyA/paILjyPGh3fWA1aX
DrLD+j97AkEAzQjTImFXHlvrPbUx+kWEv2otFqywmzIobnd3aX9xCTCAdYiSPlWZ
apZXV8Nyf55DRVDp25VnL1jhvWSND+dj+wJAEi3dIFBV8xCWWpnOF9bAZYsGFvzF
4/QdqcuCzMYGnE7J6mGgR8K8sycOiuJX58hjkS6TFgsRMP//geD9kLuxxwJAVFRb
2pkkptTxlUjQTHqJVd1KvDe8z6g6nuy+DYMgL8JmI3FPjRnR5tf9BpjZoAms63aT
KQBzFzM8bZRMvIzUPwJAQkiQ+Aw9w1Skme/jFwHtoOk96k6z4sBdM6qiVYzAugHW
6EmXVIy0qpWqaFvnSJuVqoQntX6HGMHbUKxiKGH8/Q==
-----END RSA PRIVATE KEY-----";//$keys['privkey'];
$pubkey  = "-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCwemRwZ37Ker0hPjnUca3Gd1x6
5MB+IpgkHPrfFykU/kE1l5lvl/umNihQ7rmc/pOXLNHVWGSrTL7P4LxF2F9nkKg3
3MYTWh3/KRUdEuYNKhzJubHhWeE1cm1leWcJ+EQkCq8RqrRfIxNzkHZUAume1Fad
GpWtEcS4BQ5WaeXOmQIDAQAB
-----END PUBLIC KEY-----";//$keys['pubkey'];
//echo $privkey;die;
//初始化rsaobject
$Rsa->init($privkey, $pubkey,TRUE);

//原文
$data = '你妈妈让你回家吃饭了';

//私钥加密示例
$encode = $Rsa->priv_encode($data);
p($encode);
$ret = $Rsa->pub_decode($encode);
p($ret);

//公钥加密示例
$encode = $Rsa->pub_encode($data);

p($encode);
$ret = $Rsa->priv_decode($encode);
p($ret);

*/

//function p($str){
//    echo '<pre>';
//    print_r($str);
//    echo '</pre>';
//}

