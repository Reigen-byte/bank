<?php
session_start();
$id = $_GET['id'] ?? 0;

$accounts = json_decode(file_get_contents(__DIR__ . '/data/accounts.json'), true);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($accounts as $i => $account) {
        if ($account['IBAN'] == $id) {
            if ($account['accountMoney'] == 0) {
                unset($accounts[$i]);
                break;
            } else {
                $_SESSION['error'] = 'Negalite ištrinti sąskaitos, kurioje dar yra lėšų';
                header('Location: http://localhost/phpnd/bank/accounts.php');
                exit;
            }
        }
    }
    $accounts = array_values($accounts);
    file_put_contents(__DIR__ . '/data/accounts.json', json_encode($accounts, JSON_PRETTY_PRINT));
    $_SESSION['success'] = 'Sąskaita sėkmingai ištrinta';
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
    <title>Ištrinti sąskaitą</title>
    <style>
        .delete {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            width: 100%;
        }

        .delete-container {
            width: 400px;
            height: 200px;
            border-radius: 10px;
            border: 2px solid crimson;
            color: crimson;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .delete-container div {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: row;
            gap: 10px;
        }

        .delete-container h2 {
            text-align: center;
            margin-bottom: 30px;
        }
    </style>
</head>

<body>

    <?php require __DIR__ . '/parts/navigation.php' ?>
    <?php require __DIR__ . '/parts/message.php' ?>


    <div class="delete">
        <div class="delete-container">
            <h2>Ar tikrai norite ištrinti sąskaitą?</h2>
            <div>
                <form action="" method="post">
                    <button type="submit" class="btn btn-outline-primary">Taip</button>
                </form>
                <a href="http://localhost/phpnd/bank/accounts.php" class="btn btn-outline-secondary">Ne</a>
            </div>

        </div>
    </div>
</body>

</html>