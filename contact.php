<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header>
        <form action="webprieksmets-website/contact.php" method="post">
            <label for="text">
                <input id="text" type="text" placeholder="text input" name="vards">
            </label>
            <input type="password" placeholder="enter password here" name="parole">
            <input type="date" placeholder="date" name="datums">
            <input type="submit">
        </form>

        <?php

        if ($_SERVER["REQUEST_METHOD"] === 'POST') {
          $name = $_POST['vards'];
          $password = $_POST['parole'];
          $date = $_POST['datums'];
          
          $response = sprintf("Result: %s, %s, %s", $name, $password, $date);

          echo $response;
        }

        ?>

    </header>
</body>
</html>