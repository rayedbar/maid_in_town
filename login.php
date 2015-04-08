<?php
    session_start();
?>

<?php include_once("includes/connection.php"); ?>

<?php

    if (isset($_POST['submit'])){
        $email = $_POST['email'];
        $password = $_POST['password'];

        $query = "SELECT * FROM users ";
        $query .= "WHERE email = '{$email}' AND password = '{$password}';";

        $result = mysqli_query($connection, $query);

        if (mysqli_num_rows($result) == 0){
            echo "<h1>You Entered a wrong email and password combination.</h1>";
        } else {
            $row = mysqli_fetch_assoc($result);
            if (strcmp($row['password'], 'admin') == 0 ){
                header('Location: admin.php');
                exit;
            } else {
                $_SESSION['user_id'] = $row['id'];
                header('Location: services.php');
                exit;
            }
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Log In</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="login.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">

      <form class="form-signin" method="post" action="#">
        <h2 class="form-signin-heading">Please Log In</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Log in</button>
      </form>

        <div id="signin_section">
            <p>&nbsp;</p>
            <p>Don't Have an Account Yet?</p>
            <p style="padding-left: 70px"><a href="signin.php" target="_blank">Sign Up</a></p>
        </div>

    </div> <!-- /container -->
  </body>
</html>
