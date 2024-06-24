<?php
include 'config.php';

$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM uzytkownicy WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $user['username'];
            $_SESSION['is_admin'] = $user['is_admin'];
            header("Location: index.php");
            exit;
        } else {
            $error_message = "Nieprawidłowe hasło";
        }
    } else {
        $error_message = "Nieprawidłowa nazwa użytkownika";
    }
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Logowanie</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="status">
        <?php
        // Ping after checking everything
        echo $conn->ping() ? "<span class='status-green'></span>" : "<span class='status-red'></span>";
        ?>
    </div>
    <div class="login-container">
        <h2>Logowanie</h2>
        <form action="login.php" method="post">
            <label for="username">Nazwa użytkownika:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Hasło:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Zaloguj się</button>
        </form>
        <form action="index.php" method="get">
            <button type="submit">Powrót do strony głównej</button>
        </form>
        <?php if ($error_message): ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php endif; ?>
    </div>
    <?php
    // Close connection at the very end
    $conn->close();
    ?>
</body>
</html>
