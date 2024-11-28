<?php
session_start();  // Start the session to use session variables
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $useremail = trim($_POST['useremail']);
    $password = trim($_POST['password']);

    try {
        // Check if the user exists in the database
        $stmt = $pdo->prepare("SELECT * FROM tbl_user WHERE useremail = :useremail");
        $stmt->execute(['useremail' => $useremail]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verify the password
        if ($user && password_verify($password, $user['password'])) {
            // Set session variables for the logged-in user
            $_SESSION['userid'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['useremail'] = $user['useremail'];

            // Redirect to the dashboard
            header("Location: dashboard.php");
            exit;  // Stop further script execution after redirect
        } else {
            echo "Invalid email or password!";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<form method="POST" action="">
    <input type="email" name="useremail" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form>
