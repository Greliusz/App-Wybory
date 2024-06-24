<?php
include 'config.php';

$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Sprawdź, czy nazwa użytkownika już istnieje
    $sql = "SELECT * FROM uzytkownicy WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $error_message = "Nazwa użytkownika jest już zajęta.";
    } else {
        $sql = "INSERT INTO uzytkownicy (username, password, is_admin) VALUES ('$username', '$password', TRUE)";
        if ($conn->query($sql) === TRUE) {
            header("Location: index.php");
            exit;
        } else {
            $error_message = "Błąd: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Stwórz Administratora</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="status">
        <?php
        // Ping after checking everything
        echo $conn->ping() ? "<span class='status-green'></span>" : "<span class='status-red'></span>";
        ?>
    </div>
    <div class="main-container">
        <h1>Stwórz Administratora</h1>
        <div class="login-container">
            <h2>Rejestracja Administratora</h2>
            <form action="create_admin.php" method="post">
                <label for="username">Nazwa użytkownika:</label>
                <input type="text" id="username" name="username" required>
                <label for="password">Hasło:</label>
                <input type="password" id="password" name="password" required>
                <button type="submit">Zarejestruj się</button>
            </form>
            <form action="index.php" method="get">
                <button type="submit">Powrót do strony głównej</button>
            </form>
            <?php if ($error_message): ?>
                <p class="error"><?php echo $error_message; ?></p>
            <?php endif; ?>
        </div>
    </div>
    <?php
    // Close connection at the very end
    $conn->close();
    ?>
</body>
</html>
