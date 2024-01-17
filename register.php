<?php
session_start();

require __DIR__ . '/iban.php';

$accounts = json_decode(file_get_contents(__DIR__ . '/data/accounts.json'), true);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $surname = isset($_POST['surname']) ? $_POST['surname'] : '';
    $idCode = isset($_POST['idCode']) ? $_POST['idCode'] : '';

    if (empty($name) || empty($surname) || empty($idCode)) {
        $_SESSION['error'] = 'Visi laukeliai yra privalomi';
        header('Location: http://localhost/phpnd/bank/register.php');
        return;
    }

    if (strlen($name) < 3) {
        $_SESSION['error'] = 'Vardas turi būti ilgesnis nei 3 raidės';
        header('Location: http://localhost/phpnd/bank/register.php');
        return;
    }

    if (strlen($surname) < 3) {
        $_SESSION['error'] = 'Pavardė turi būti ilgesnė nei 3 raidės';
        header('Location: http://localhost/phpnd/bank/register.php');
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
        $_SESSION['error'] = 'ID kodas jau naudojamas';
        header('Location: http://localhost/phpnd/bank/register.php');
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

    header('Location: http://localhost/phpnd/bank/accounts.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="http://localhost/php/crud/app.js" defer></script>
    <title>Sukurti sąskaitą</title>
</head>

<body>

    <?php require __DIR__ . '/parts/navigation.php' ?>
    <?php require __DIR__ . '/parts/message.php' ?>


    <h2 class="text-center mt-5">Prašome sukurti sąskaitą</h2>

    <div class="container mt-5 col-4 ">
        <form action="" method="post">
            <div class="form-group">
                <label for="name">Vardas:</label>
                <input type="text" class="form-control" name="name" placeholder="Vardas">
                <label for="surname">Pavardė:</label>
                <input type="text" class="form-control" name="surname" placeholder="Pavardė">
                <label for="idCode">Asmens kodas:</label>
                <input type="text" class="form-control" name="idCode" placeholder="Asmens kodas">
            </div>
            <div class="d-grid gap-2 col-6 mx-auto">
                <button class="btn btn-primary mt-3" type="submit">Užregistruoti sąskaitą</button>

        </form>
    </div>
</body>


</body>

</html>