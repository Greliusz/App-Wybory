<?php
include 'config.php';

if (!isset($_SESSION['loggedin']) || !$_SESSION['is_admin']) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Anuluj głosowanie wyborcy
    $sql = "UPDATE wyborcy SET glosowal = FALSE WHERE id = $id";
    $conn->query($sql);

    // Znajdź głosowanego kandydata i zmniejsz jego liczbę głosów
    $sql = "SELECT kandydaci.id FROM kandydaci 
            JOIN wyborcy ON kandydaci.id = wyborcy.glosowal 
            WHERE wyborcy.id = $id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $kandydat = $result->fetch_assoc();
        $kandydat_id = $kandydat['id'];
        $sql = "UPDATE kandydaci SET glosy = glosy - 1 WHERE id = $kandydat_id";
        $conn->query($sql);
    }

    header("Location: index.php");
    exit;
} else {
    echo "Brak ID wyborcy do anulowania.";
}
?>
