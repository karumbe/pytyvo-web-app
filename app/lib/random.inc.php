<?php
/**
* akam at akameng dot com
* https://www.php.net/manual/es/function.random-bytes.php
* I used below function to create random token, and also a salt from the token.
* I used it in my application to prevent CSRF attack.
*/
function random_token($length = 32) {
    if (!isset($length) || intval($length) <= 8) {
        $length = 32;
    }

    if (function_exists('random_bytes')) {
        return bin2hex(random_bytes($length));
    }

    if (function_exists('mcrypt_create_iv')) {
        return bin2hex(mcrypt_create_iv($length, MCRYPT_DEV_URANDOM));
    }

    if (function_exists('openssl_random_pseudo_bytes')) {
        return bin2hex(openssl_random_pseudo_bytes($length));
    }
}

function salt() {
    return substr(strtr(base64_encode(hex2bin(RandomToken(32))), '+', '.'),
        0, 44);
}

# echo random_token();
# echo '\n';
# echo salt();
# echo '\n';

/**
* This function is same as above but its only used for debugging.
*/
function random_token_debug($length = 32) {
    if (!isset($length) || intval($length) <= 8 ) {
        $length = 32;
    }

    $randoms = array();

    if (function_exists('random_bytes')) {
        $randoms['random_bytes'] = bin2hex(random_bytes($length));
    }

    if (function_exists('mcrypt_create_iv')) {
        $randoms['mcrypt_create_iv'] = bin2hex(mcrypt_create_iv($length,
            MCRYPT_DEV_URANDOM));
    }

    if (function_exists('openssl_random_pseudo_bytes')) {
        $randoms['openssl_random_pseudo_bytes'] = bin2hex(
            openssl_random_pseudo_bytes($length));
    }

    return $randoms;
}

# echo '\n';
# print_r (random_token_debug());
?>