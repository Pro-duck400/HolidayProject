<?php

session_start();

require_once "../app/view/includes/db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = $_POST["email"];
    $password = $_POST["password"];

    $stmt = $conn->prepare(
        "SELECT *
        FROM users
        WHERE email = ?"
    );

    $stmt->bind_param("s", $email);

    $stmt->execute();

    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {

        if (
            password_verify(
                $password,
                $user["password_hash"]
            )
        ) {

            $_SESSION["user_id"] =
                $user["id"];

            $_SESSION["display_name"] =
                $user["display_name"];

            header(
                "Location: dashboard.php"
            );

            exit();
        }
    }

    echo "Invalid email or password";
}
?>
<?php include "../app/view/layout/navbar.php"; ?>
<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/index.css">
</head>

<body>
    <div class="login-container">
        <div class="login-box">
            <h2>Login</h2>
            <form method="POST">

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
                    Login
                </button>

            </form>
        </div>
    </div>
</body>

</html>