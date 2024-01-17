<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="http://localhost/php/crud/app.js" defer></script>
    <title>Pagrindinis Puslapis</title>
    <style>
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            width: 100%;
        }

        .welcome-container {
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .welcome-container h1 {
            margin-bottom: 100px;
        }

        .choices {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
        }

        .choices a {
            font-size: 30px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="welcome-container">
            <h1>Sveiki atvykę į Vaizduotės banką</h1>
            <div class="choices">
                <a class="btn btn-primary" href="http://localhost/phpnd/bank/register.php">Sukurti naują sąskaitą</a>
                <a class="btn btn-primary" href="http://localhost/phpnd/bank/accounts.php">Sąskaitų sąrašas</a>
            </div>
        </div>
    </div>

</body>

</html>