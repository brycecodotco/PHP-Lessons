<?php
session_start();
$session_id = session_id();
//If session is not set, redirect to login

if(isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome Page</title>
</head>
<body>
    <h2>Welcome Page</h2>
    <p>
        Hi <?php echo $_SESSION['username']; ?>
    </p>

    <a href ="logout.php">Logout</a>
    
</body>
<script>
    let phpSessionId = "<?php echo $session_id; ?>";
    sessionStorage.setItem("PHP_SESSION_ID", phpSessionId);
    console.log("Session ID:", phpSessionId);
</script>
</html>