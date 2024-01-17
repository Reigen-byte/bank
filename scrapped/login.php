<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>Prisijungti</title>
</head>

<body>

    <?php require './parts/nav.php' ?>


    <h2 class="text-center mt-5">Prašome prisijungti</h2>

    <div class="container mt-5 col-4 ">
        <form action="http://localhost/phpnd/bank/login_process.php" method="post">
            <div class="form-group">
                <label for="email">Elektroninis Paštas:</label>
                <input type="email" class="form-control" name="email" placeholder="Elektroninis Paštas">
                <label for="password">Slaptažodis:</label>
                <input type="password" class="form-control" name="password" placeholder="Slaptažodis">
            </div>
            <div class="d-grid gap-2 col-6 mx-auto">
                <button class="btn btn-primary mt-3" type="submit">Prisijungti</button>

        </form>
    </div>
    <?php require './store.php' ?>
</body>


</body>

</html>