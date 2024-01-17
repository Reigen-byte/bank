    <?php
    session_start();

    $id = $_GET['id'] ?? 0;
    $accounts = json_decode(file_get_contents(__DIR__ . '/data/accounts.json'), true);
    $account = null;
    foreach ($accounts as $user) {
        if ($user['IBAN'] == $id) {
            $account = $user;
            break;
        }
    }

    if (!$id) {
        header('Location: http://localhost/phpnd/bank/accounts.php');
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['prideti'])) {
        foreach ($accounts as $i => $account) {
            if ($account['IBAN'] == $id) {
                $account['accountMoney'] += (int) $_POST['prideti'];
                $accounts[$i] = $account;
                break;
            }
        }

        file_put_contents(__DIR__ . '/data/accounts.json', json_encode($accounts, JSON_PRETTY_PRINT));

        $_SESSION['success'] = "Lėšos sėkmingai pridėtos";

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
        <title>Pridėti lėšų</title>
    </head>

    <body>

        <?php require __DIR__ . '/parts/navigation.php' ?>
        <?php require __DIR__ . '/parts/message.php' ?>

        <?php if (!$account) : ?>

            <div class="container mt-5">
                <div class="row">
                    <div class="col">
                        <h2>Show</h2>
                        <div class="alert alert-danger" role="alert">
                            Sąskaita nerasta!
                        </div>
                    </div>
                </div>
            </div>

        <?php else : ?>
            <div class="container mt-5">
                <div class="row">
                    <div class="col">
                        <h2>Pridėti lėšų</h2>
                        <div class="row">
                            <div class="card col-6 mt-5">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item fs-5">Vardas: <?php echo $account['name'] ?></li>
                                    <li class="list-group-item fs-5">Pavardė: <?php echo $account['surname'] ?></li>
                                    <li class="list-group-item fs-5">Banko sąskaitos numeris: <?php echo $account['IBAN'] ?></li>
                                </ul>
                            </div>
                            <div class="card w-50 mt-5">
                                <div class="card-body">
                                    <h5 class="card-title fs-3">Įrašykite sumą eurais</h5>
                                    <form action="" method="post">
                                        <input type="text" name="prideti">
                                        <button type="submit" class="btn btn-primary">Pridėti</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif ?>
    </body>

    </html>