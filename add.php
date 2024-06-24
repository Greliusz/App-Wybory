<?php
include 'config.php';

if (!isset($_SESSION['loggedin']) || !$_SESSION['is_admin']) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['kandydat'])) {
        $imie = $_POST['imie_kandydata'];
        $sql = "INSERT INTO kandydaci (imie) VALUES ('$imie')";
    } elseif (isset($_POST['wyborca'])) {
        $imie = $_POST['imie_wyborcy'];
        $sql = "INSERT INTO wyborcy (imie) VALUES ('$imie')";
    }

    if ($conn->query($sql) === TRUE) {
        echo "Nowy rekord został dodany pomyślnie";
        header("refresh:2;url=index.php");
        exit;
    } else {
        echo "Błąd: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="2;url=index.php">
    <title>Dodawanie rekordu</title>
</head>
<body>
    <p>Nowy rekord został dodany pomyślnie. Za 2 sekundy zostaniesz przekierowany na stronę główną.</p>
</body>
</html>