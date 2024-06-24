<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['kandydat_id']) && isset($_SESSION['username'])) {
    $kandydat_id = $_POST['kandydat_id'];
    $username = $_SESSION['username'];

    // Sprawdź, czy użytkownik już głosował
    $user_query = $conn->query("SELECT * FROM wyborcy WHERE imie='$username'");
    $wyborca = $user_query->fetch_assoc();

    if ($wyborca && !$wyborca['glosowal']) {
        // Zaktualizuj stan głosowania użytkownika
        $conn->query("UPDATE wyborcy SET glosowal=TRUE WHERE imie='$username'");
        // Zwiększ liczbę głosów kandydata
        $conn->query("UPDATE kandydaci SET glosy=glosy+1 WHERE id='$kandydat_id'");
    }
    header("Location: index.php");
    exit;
} else {
    header("Location: index.php");
    exit;
}
?>
