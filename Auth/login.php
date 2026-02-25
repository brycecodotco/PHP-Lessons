<?php
session_start();
$session_id = session_id();
if (isset($_SESSION['username'])) {
    header("Location: welcome.php");
    exit();
}

$users = [
    "admin" => "1234",
    "michael"=> "pass123",
    "student1"=> "abc123"
];

if ($_server["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];

    //Check if username exists and password matches
    if (isset($users[$username]) && $users[$username] === $password) {

        $_SESSION['username'] = $username;

        header("Location: welcome.php");
        exit();


    } else {
        echo "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
</head>
<body>
        <h2>Login</h2>

    <form method="post">
        Username: <input type="text" name="username" required><br><br>
        Password: <input type="password" name="password" required><br><br>
        <button type="submit">Login</button>
    </form>

<script>
    let phpSessionId = "<?php echo $session_id?>";
    sessionStorage.setItem("PHP_SESSION_ID", phpSessionId);
</script>
</body>
</html>
