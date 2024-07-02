<?php
const AES_KEY = '5bc426e8d81e2f4136a562fac893c2229e3faa99e3faa99d97df09ab604a2f8a0c0a60c';
const AES_IV = 'euro2024';

/**
 * Encrypt data in views
 * @param mixed $real The data to encrypt
 * @return string
 */
function fake_data($real): string
{
    return base64_encode(bin2hex(openssl_encrypt($real, "aes-256-cbc", AES_KEY, OPENSSL_RAW_DATA, AES_IV)));
}

/**
 * Decrypt data in views
 * @param mixed $fake The data to decrypt
 * @return string
 */
function real_data($fake)
{
    $value = base64_decode($fake);
    if (!isHexadecimal($value)) throw new \Exception('Dados inválidos');

    if ((strlen($value) % 2) != 0) return -1;
    return openssl_decrypt(hex2bin($value), "aes-256-cbc", AES_KEY, OPENSSL_RAW_DATA, AES_IV);
}

function isHexadecimal($str)
{
    return preg_match("/^[0-9a-fA-F]*$/", $str);
}

function dd($data)
{
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
}
