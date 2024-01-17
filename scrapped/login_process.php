<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $accountsData = file_get_contents(__DIR__ . '/data/accounts.json');
    $accounts = json_decode($accountsData, true);
    foreach ($accounts as $account) {
        if ($account['email'] == $_POST['email']) {
            if ($account['password'] == password_verify($password, $accounts[$email]['password'])) {
                $_SESSION['login'] = 'Prisijungta';
                $_SESSION['name'] = $account['name'];
                header('Location: http://localhost/phpnd/bank/authorized.php');
                die;
            }
        }
    }
    $_SESSION['error'] = 'Wrong email or password';
    header('Location: http://localhost/phpnd/bank/login.php');
}
