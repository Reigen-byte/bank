<?php

require __DIR__ . '/iban.php';

$accounts = json_decode(file_get_contents(__DIR__ . '/data/accounts.json'), true);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $surname = isset($_POST['surname']) ? $_POST['surname'] : '';
    $idCode = isset($_POST['idCode']) ? $_POST['idCode'] : '';

    if (empty($name) || empty($surname) || empty($idCode)) {
        echo 'Visi laukeliai yra privalomi';
        return;
    }

    if (strlen($name) < 3) {
        echo 'Vardas turi būti ilgesnis nei 3 raidės';
        return;
    }

    if (strlen($surname) < 3) {
        echo 'Pavardė turi būti ilgesnė nei 3 raidės';
        return;
    }

    function isIdCodeUnique($idCode, $accounts)
    {
        foreach ($accounts as $account) {
            if ($account['idCode'] == $idCode) {
                return false;
            }
        }
        return true;
    }

    if (!isIdCodeUnique($idCode, $accounts)) {
        echo 'ID kodas jau naudojamas';
        return;
    }

    $formData = [
        'name' => $name,
        'surname' => $surname,
        'idCode' => $idCode,
        'IBAN' => generateIBANLikeCode(),
        'accountMoney' => 0
    ];

    $accounts[] = $formData;

    file_put_contents(__DIR__ . '/data/accounts.json', json_encode($accounts, JSON_PRETTY_PRINT));
}
