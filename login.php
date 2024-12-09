<!DOCTYPE html>
<html>
        <head>
        <meta charset="UTF-8">
            <title>Stockmate</title>
        </head>
<link rel="stylesheet" type="text/css" href="css/styles.css">

    <body>
        <div class="container">
            <div class="LoginHeader">
                <h1>Stockmate</h1>
                <p>Inventory Management System</p>
            </div>
            <div class="LoginBody">
                <form action="login.php" method="post">
                    <div class="LoginInputsContainer">
                        <label for="">Username</label>
                        <input placeholder="Username" name= "username" type="text" required>
                    </div>
                    <div class="LoginInputsContainer">
                        <label for="">Password</label>
                        <input placeholder="Password" name= "password" type="password" required>
                    </div>
                    <div class="LoginButtonContainer">
                        <button>Login</button>
                    </div>
                    <div class="RegisterButtonContainer">
    <button type="button" onclick="location.href='register.php'">Register</button>
                    </div>

                    </div>
                </form>
            </div>
        </div>

        <?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $conn = new mysqli("localhost", "root", "", "user_auth");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT id, password FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $hashed_password);

    if ($stmt->fetch() && password_verify($password, $hashed_password)) {
        $_SESSION['username'] = $username;
        header("Location: welcome.php");
    } else {
        echo "Invalid username or password";
    }

    $stmt->close();
    $conn->close();
}
?>

    </body>
</html>