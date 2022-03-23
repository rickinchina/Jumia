<?php
session_start();
include './task/connect.php';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title> Login Page </title>

</head>
<body>
    <div class="login-page">
        <div class="form">
            <div class="login">
                <div class="login-header">
                    <h3>LOGIN</h3>
                    <p>Please enter your Username and Password to login.</p>
                </div>
            </div>
            <form class="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <input type="text" name="username" placeholder="username" autocomplete="off">
                <input type="password" name="password" placeholder="password" autocomplete="new-password">
                <input type="submit" value="login">
            </form>
        </div>
    </div>
</body>
</html>
<?php
     if ($_SERVER['REQUEST_METHOD'] == 'POST')
     {
         $username = $_POST['username'];
         $password = $_POST['password'];

         $stmt = $conn->prepare("SELECT * FROM users WHERE name = ? AND password = ? LIMIT 1");
         $stmt->execute(array($username,$password));

         $checkuser = $stmt->rowCount();

         $user = $stmt->fetch();

         if($checkuser > 0){
             $_SESSION['id'] = $user['id'];
             $_SESSION['user'] = $user['name'];
             $_SESSION['admin'] = $user['admin'];
             header('location:task/taskboard.php');
         }
     }

?>