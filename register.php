<?php

require_once "includes/db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $display_name = $_POST["display_name"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $password_hash =
        password_hash(
            $password,
            PASSWORD_DEFAULT
        );

    $stmt = $conn->prepare(
        "INSERT INTO users
        (display_name, email, password_hash)
        VALUES (?, ?, ?)"
    );

    $stmt->bind_param(
        "sss",
        $display_name,
        $email,
        $password_hash
    );

    $stmt->execute();

    header("Location: index.php");
    exit();
}
?>

<form method="POST">

    <input
        type="text"
        name="display_name"
        placeholder="Display Name"
        required>

    <input
        type="email"
        name="email"
        placeholder="Email"
        required>

    <input
        type="password"
        name="password"
        placeholder="Password"
        required>

    <button type="submit">
        Sign Up
    </button>

</form>