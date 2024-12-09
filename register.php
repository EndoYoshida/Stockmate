
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
</head>
<body>
    <h2>Register</h2>
    <form action="register.php" method="post">
    <div class="RegisterInputsContainer">
        <label for="">Username</label>
        <input placeholder="Username" name= "username" type="text" required>
    </div>
    <div class="RegisterInputsContainer">
        <label for="">Email</label>
        <input placeholder="Email" name= "email" type="email" required>
        <div class="RegisterInputsContainer">
        <label for="">Password</label>
        <input placeholder="Password" name= "password" type="password" required>
        <div class="RegisterButtonContainer">
                        <button type = "submit" value = "Register">Register</button>
                    </div>

        <div class="LoginButtonContainer">
    <button type="button" onclick="location.href='login.php'">Back to Login</button>
        </div>
    </form>

    <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $conn = new mysqli("localhost", "root", "", "user_auth");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $email, $password);
    
    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

</body>
</html>
