<?php
    session_start();
?>

<?php include_once("includes/connection.php"); ?>

<?php

    if (isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];

        $query = "select name from users WHERE id = {$user_id}";
        $user_name = mysqli_query($connection, $query);
        $user_name = mysqli_fetch_assoc($user_name);
    }

    if (isset($_POST['submit'])){
                if (isset($_SESSION['user_id'])){

                    $user_id = $_SESSION['user_id'];

                    if(isset($_POST['check_list'])){
                        $array_size = count($_POST['check_list']);
                        $maid_tasks = array();
                        $total_price = 0;
                        foreach($_POST['check_list'] as $checked){
                            $task_price_values = explode(" ", $checked);
                            $task =  $task_price_values[0];
                            $price =  intval($task_price_values[1]);

                            $maid_tasks[$task] = 1;

                            $total_price += $price;
                        }

                        $maid_id = $_POST['maid_id'];

                        $query = "INSERT INTO user_maid (user_id, maid_id, total_price) ";
                        $query .= "VALUES({$user_id}, {$maid_id}, {$total_price}) ";
                        $user_maid_insertion = mysqli_query($connection, $query);
                        if (!$user_id){
                            echo "Insertion into table user_maid Failed";
                        }

                        $columns = implode(', ', array_keys($maid_tasks));
                        $values = implode(", ", array_values($maid_tasks));

                        $query = "INSERT INTO tasks (user_id, $columns) ";
                        $query .= "VALUES ({$user_id} ,{$values});";
                        $tasks_insertion= mysqli_query($connection, $query);
                        if (!$tasks_insertion){
                            echo "Insertion into table tasks failed";
                        }
                    }
            } else {
                echo "Please Log In First.";
            }
        }

if (isset($_POST['update'])) {
    if (isset($_SESSION['user_id'])) {

        $user_id = $_SESSION['user_id'];

        if (isset($_POST['check_list'])) {
            $maid_tasks = array();
            $total_price = 0;
            foreach ($_POST['check_list'] as $checked) {
                $task_price_values = explode(" ", $checked);
                $task = $task_price_values[0];
                $price = intval($task_price_values[1]);

                $maid_tasks[$task] = 1;

                $total_price += $price;
            }

            $maid_id = $_POST['maid_id'];

            $query = "UPDATE user_maid ";
            $query .= "SET maid_id = {$maid_id}, total_price = {$total_price} ";
            $query .= "WHERE user_id = {$user_id};";
            $user_maid_insertion = mysqli_query($connection, $query);

            if (!$user_maid_insertion) {
                echo "Update into table user_maid Failed";
            }

            $columns = implode(', ', array_keys($maid_tasks));
            $values = implode(", ", array_values($maid_tasks));

            $result = mysqli_query($connection, "DELETE FROM tasks WHERE user_id = {$user_id};");

            if ($result){
                $query = "INSERT INTO tasks (user_id, {$columns}) ";
                $query .= "VALUES ({$user_id} ,{$values}) ";

                $result = mysqli_query($connection, $query);

                if (!$result) {
                    echo "Update/new insert into table tasks failed";
                }
            } else {
                echo "Delete failed";
            }
        }
    }
}

    if (isset($_POST['logout'])){
        session_unset();
        header('Location: index.html');
    }
?>

<?php
    $query = "SELECT dishes, clothes, cooking, maintenance, beautification FROM tasks;";
    $tasks_result = mysqli_query($connection, $query);
    $fields = mysqli_fetch_fields($tasks_result);

    $query = "SELECT * FROM maids;";
    $maid_names = mysqli_query($connection, $query);

    $query = "SELECT * FROM task_price;";
    $task_price_result = mysqli_query($connection, $query);
    $task_price = mysqli_fetch_array($task_price_result, MYSQLI_NUM);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Services</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="carousel.css" rel="stylesheet">
    <link href="custom.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<div class="navbar-wrapper">
    <div class="container">
        <nav class="navbar navbar-inverse navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Maid In Town</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="index.html">Our Vision</a></li>
                        <li class="active"><a href="#">Our Services</a></li>
                        <li><a href="maids.php">Our Maids</a></li>
                        <li><a href="#">Yours Truly</a></li>
                    </ul>
                    <ul class="nav navbar-nav pull-right">
                        <li class="pull-right"><a href="login.php" id="log" target="_blank"><?php if (isset($user_name)) { echo "Hello, " . $user_name['name'] ;} else {echo "Log In";}?></a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>

<div class="container" id="tasks_section">
    <form class="form-group-sm" id="tasks_form" method="post" action="#">
        <h1 id="tasks_section_header">What tasks would you like have done: </h1>
        <div id="tasks_controls">
            <?php $i = 1; foreach($fields as $field) { ?>
                <div class="checkbox">
                    <label style="padding: 5px 0;" >
                        <input type="checkbox" name="check_list[]" value="<?php echo $field->name . " " . $task_price[$i];?>"><?php echo $field->name . " " . "(Tk " . $task_price[$i] . ")";?>
                    </label>
                </div>
            <?php $i++; } ?>
            <h4 id="tasks_maid_header">Select the maid you would like to hire. For more details regarding our maids, check the <a href="maids.php" target="_blank">Our Maids</a> page.</h4>
            <select class="form-control" name="maid_id">
                <?php while($name = mysqli_fetch_assoc($maid_names)) { ?>
                    <option value="<?php echo $name['id']; ?>">
                        <?php echo $name['name']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <button class="btn btn-lg btn-success pull-right" id="tasks_button" type="submit" name="update">Update</button>
        <button class="btn btn-lg btn-primary pull-right" id="tasks_button" type="submit" name="submit">Submit</button>
    </form>
</div>

<div class="container">
    <h4>Order Summary:</h4>
    <?php
    if ($_SESSION['user_id']) {
        $user_id = $_SESSION['user_id'];

        // FIND MAID NAME, ID and TOTAL PRICE
        $query = "SELECT maids.name, maids.id, total_price FROM maids INNER JOIN user_maid ";
        $query .= "ON maids.id = user_maid.maid_id ";
        $query .= "WHERE user_maid.user_id = {$user_id};";


        $result = mysqli_query($connection, $query);
        $maid_info = mysqli_fetch_assoc($result);
        $maid_name = $maid_info['name'];
        $maid_id = $maid_info["id"];
        $total_price = $maid_info['total_price'];
?>



        <div class="row">
            <div class="col-lg-4 text-center"><strong>Maid</strong></div>
            <div class="col-lg-4 text-center"><strong>Tasks</strong></div>
            <div class="col-lg-4 text-center"><strong>Total Price</strong></div>
        </div>
        <div class="row">
            <div class="col-lg-4 "><?php echo $maid_name; ?></div>
            <div class="col-lg-4">
                <?php
                //select tasks performed by maid
                $query = "SELECT * FROM tasks ";
                $query .= "WHERE user_id = {$user_id};";

                $tasks_result = mysqli_query($connection, $query);
                while ($row = mysqli_fetch_assoc($tasks_result)) {
                    foreach($row as $key => $value){
                        if ($value == 1){
                            echo $key . ", ";
                        }
                    }
                }
            ?>
            </div>
            <div class="col-lg-4"><?php echo "Tk " . $total_price; ?></div>
            <?php }  ?>
        </div>
</div>

<div class="container">
    <form method="post" action="">
        <button class="btn btn-warning pull-right" name="logout" type="submit">Log Out</button>
    </form>
</div>



<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery-1.11.2.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>


</body>
</html>
<?php mysqli_close($connection); ?>