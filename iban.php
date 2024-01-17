<?php

function generateRandomNumbers($length)
{
    $code = '';
    for ($i = 0; $i < $length; $i++) {
        $code .= rand(0, 9);
    }

    return $code;
}

function generateIBANLikeCode($countryCode = 'LT', $length = 20)
{
    $bban = generateRandomNumbers($length - 2);
    return $countryCode . $bban;
}
