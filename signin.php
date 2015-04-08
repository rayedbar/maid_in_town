<?php include_once("includes/connection.php"); ?>

<?php

    if (isset($_POST['submit'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];

        $query = "INSERT INTO users (name, email, password, address, phone) ";
        $query .= "VALUES ('{$name}', '{$email}', '{$password}', '{$address}', '{$phone}');";


        $result = mysqli_query($connection, $query);

        if ($result){
            header('Location: index.html');
            exit;
        } else {
            echo "Something went wrong! Try again.";
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

    <title>Sign In</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<div class="container">

    <form class="form-signin" method="post" action="#">
        <h2 class="form-signin-heading">Please sign up</h2>
        <label for="inputName" class="sr-only">Name</label>
        <input type="text" id="inputName" name="name" class="form-control" placeholder="Name" required autofocus>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
        <label for="inputAddress" class="sr-only">Address</label>
        <input type="text" id="inputAddress" name="address" class="form-control" placeholder="Address" required>
        <label for="inputPhone" class="sr-only">Phone</label>
        <input type="number" id="inputPhone" name="phone" class="form-control" placeholder="Phone" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Sign Up</button>
    </form>

</div> <!-- /container -->


<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>
<?php mysqli_close($connection); ?>