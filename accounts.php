<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="http://localhost/php/crud/app.js" defer></script>
    <title>Vaizduotės Bankas</title>
</head>

<body>

    <?php require __DIR__ . '/parts/navigation.php' ?>
    <?php require __DIR__ . '/parts/message.php' ?>


    <h2 class="text-center">Sąskaitos</h2>

    <ul class="list-group list-group-flush">
        <li class="list-group-item">
            <div class="container">
                <div class="row">
                    <div class="col-1">
                        <b>Pavardė</b>
                    </div>
                    <div class="col-1">
                        <b>Vardas</b>
                    </div>
                    <div class="col-2">
                        <b>Asmens kodas</b>
                    </div>
                    <div class="col-2">
                        <b>IBAN</b>
                    </div>
                    <div class="col-2">
                        <b>Sąskaitos likutis</b>
                    </div>
                    <div class="col-4">
                        <b>Veiksmai</b>
                    </div>
                </div>
            </div>
        </li>

        <?php $accounts = json_decode(file_get_contents(__DIR__ . '/data/accounts.json'), true) ?>
        <?php
        usort($accounts, function ($a, $b) {
            return strcmp($a['surname'], $b['surname']);
        });
        ?>
        <?php foreach ($accounts as $account) : ?>
            <li class="list-group-item">
                <div class="container">
                    <div class="row">
                        <div class="col-1">
                            <?= $account['surname'] ?>
                        </div>
                        <div class="col-1">
                            <?= $account['name'] ?>
                        </div>
                        <div class="col-2">
                            <?= $account['idCode'] ?>
                        </div>
                        <div class="col-2">
                            <?= $account['IBAN'] ?>
                        </div>
                        <div class="col-2">
                            <?= $account['accountMoney'] ?>€
                        </div>
                        <div class="col-4">
                            <a href="http://localhost/phpnd/bank/add_money.php?id=<?= $account['IBAN'] ?>" class="btn btn-success ">Pridėti lėšų</a>
                            <a href="http://localhost/phpnd/bank/remove_money.php?id=<?= $account['IBAN'] ?>" class="btn btn-danger ">Nuskaičiuoti lėšas</a>
                            <a href="http://localhost/phpnd/bank/delete_account.php?id=<?= $account['IBAN'] ?>" class="btn btn-outline-danger ">Ištrinti sąskaitą</a>
                        </div>
                    </div>
                </div>
            </li>
        <?php endforeach ?>
    </ul>

</body>

</html>