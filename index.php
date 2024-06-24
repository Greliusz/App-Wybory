<?php
include 'config.php';
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Aplikacja Wyborcza</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="status">
        <?php
        echo $conn->ping() ? "<span class='status-green'></span>" : "<span class='status-red'></span>";
        ?>
    </div>
    <div class="main-container">
        <h1>Aplikacja Wyborcza</h1>
        <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']): ?>
            <p>Zalogowany jako: <?php echo htmlspecialchars($_SESSION['username']); ?> <a href="logout.php">Wyloguj się</a></p>
            <div class="tables-container">
                <div class="wyborcy">
                    <h2>Wyborcy</h2>
                    <table>
                        <tr>
                            <th>Imię</th>
                            <th>Głosował</th>
                            <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']): ?>
                                <th>Akcje</th>
                            <?php endif; ?>
                        </tr>
                        <?php
                        $result = $conn->query("SELECT * FROM wyborcy");
                        while($row = $result->fetch_assoc()) {
                            echo "<tr><td>{$row['imie']}</td><td>" . ($row['glosowal'] ? '✓' : '✗') . "</td>";
                            if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']) {
                                echo "<td><a href='cancel_vote.php?id={$row['id']}'>Anuluj głos</a></td>";
                            }
                            echo "</tr>";
                        }
                        ?>
                    </table>
                </div>
                <div class="kandydaci">
                    <h2>Kandydaci</h2>
                    <table>
                        <tr>
                            <th>Imię</th>
                            <th>Głosy</th>
                        </tr>
                        <?php
                        $result = $conn->query("SELECT * FROM kandydaci");
                        while($row = $result->fetch_assoc()) {
                            echo "<tr><td>{$row['imie']}</td><td>{$row['glosy']}</td></tr>";
                        }
                        ?>
                    </table>
                </div>
            </div>
            <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']): ?>
            <div class="add">
                <h2>Dodaj</h2>
                <form action="add.php" method="POST">
                    <input type="text" name="imie_kandydata" placeholder="Nazwa kandydata">
                    <button type="submit" name="kandydat">Dodaj kandydata</button>
                </form>
            </div>
            <?php endif; ?>
            <hr class="section-divider">
            <?php
            $username = $_SESSION['username'];
            $user_query = $conn->query("SELECT * FROM wyborcy WHERE imie='$username'");
            $wyborca = $user_query->fetch_assoc();
            if (!$wyborca) {
                $conn->query("INSERT INTO wyborcy (imie, glosowal) VALUES ('$username', FALSE)");
                $user_query = $conn->query("SELECT * FROM wyborcy WHERE imie='$username'");
                $wyborca = $user_query->fetch_assoc();
            }
            if ($wyborca['glosowal']): ?>
                <p>Już oddałeś głos.</p>
            <?php elseif (isset($_SESSION['is_admin']) && $_SESSION['is_admin']): ?>
                <p>Administrator nie może głosować.</p>
            <?php else: ?>
            <div class="vote">
                <h2>Głosuj!</h2>
                <form action="vote.php" method="POST">
                    <p>Ja, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>, głosuję na:</p>
                    <select name="kandydat_id">
                        <option value="">Wybierz kandydata</option>
                        <?php
                        $result = $conn->query("SELECT * FROM kandydaci");
                        while($row = $result->fetch_assoc()) {
                            echo "<option value='{$row['id']}'>{$row['imie']}</option>";
                        }
                        ?>
                    </select>
                    <button type="submit">Zatwierdź!</button>
                </form>
            </div>
            <?php endif; ?>
        <?php else: ?>
            <p>Nie jesteś zalogowany. <a href="login.php">Zaloguj się</a> lub <a href="register.php">Zarejestruj się</a></p>
        <?php endif; ?>
    </div>
    <?php
    $conn->close();
    ?>
</body>
</html>
