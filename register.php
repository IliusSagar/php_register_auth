<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['username']);
    $email = trim($_POST['useremail']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    try {
        $stmt = $pdo->prepare("INSERT INTO tbl_user (username, useremail, password) VALUES (:username, :useremail, :password)");
        $stmt->execute(['username' => $name, 'useremail' => $email, 'password' => $password]);
        echo "Registration successful! You can now log in.";
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) { // Duplicate entry
            echo "Email already registered!";
        } else {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>

<form method="POST" action="">
    <input type="text" name="username" placeholder="Full Name" required>
    <input type="email" name="useremail" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Register</button>
</form>
