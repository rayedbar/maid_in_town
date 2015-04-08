<?php include_once("includes/connection.php"); ?>

<?php

    $display_table = false;
    $display_user_maid = false;

    if(isset($_POST['search_button'])){
        $search_term = $_POST['search_term'];
        if (strcmp($search_term, "male") == 0 || strcmp($search_term, "female") == 0){
            $query = "SELECT * FROM maids ";
            $query .= "WHERE gender = '{$search_term}'";

            $selection = mysqli_query($connection, $query);

            if ($selection){
                $display_table = true;
            }
        }

        else if (strcmp($search_term, "monthly") == 0 || strcmp($search_term, "annual") == 0){
            $query = "SELECT * FROM maids ";
            $query .= "WHERE contract = '{$search_term}'";

            $selection = mysqli_query($connection, $query);

            if ($selection){
                $display_table = true;
            }
        }

        else {
            $query = "SELECT * FROM maids ";
            $query .= "WHERE name LIKE '%{$search_term}%';";

            $selection = mysqli_query($connection, $query);

            if ($selection){
                $display_table = true;
            }
        }
    }

    if (isset($_POST['delete_button'])) {

        $delete_maid_id = $_POST['radio'];

        $query = "DELETE FROM maids WHERE id = {$delete_maid_id}";
        $result = mysqli_query($connection, $query);
    }

    if (isset($_POST['add_button'])){

        $maid_name = $_POST['name'];
        $maid_gender = $_POST['gender'];
        $maid_contract = $_POST['contract'];

        $query = "INSERT INTO maids (name, gender, contract) VALUES ('{$maid_name}', '{$maid_gender}', '{$maid_contract}');";
        $result = mysqli_query($connection, $query);

    }

    if (isset($_POST['user_maid_button'])){

        $query = "SELECT users.name AS user_name, maids.name AS maid_name, user_maid.total_price AS total_price FROM users ";
        $query .= "INNER JOIN user_maid ON users.id = user_maid.user_id ";
        $query .= "INNER JOIN maids ON maids.id = user_maid.maid_id;";

        $user_maid = mysqli_query($connection, $query);

        $display_user_maid = true;

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Admin Panel</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="custom.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <form name="search_box" id="search_box" method="post" action="#">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search_term" placeholder="Search for by name, gender or contract">
            <span class="input-group-btn">
                <button class="btn btn-default" type="submit" name="search_button">Go!</button>
            </span>
                        </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                </div><!-- /.row -->
            </form>

            <?php if ($display_table) { ?>
                <form method="post" action="#">
                    <table id="display_table" class="table table-bordered">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Gender</th>
                            <th>Contract</th>
                        </tr>
                        <?php while ($row = mysqli_fetch_assoc($selection)){?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['gender']; ?></td>
                                <td><?php echo $row['contract']; ?></td>
                                <td>
                                    <div class="radio">
                                        <label >
                                            <input type="radio" name="radio" value="<?php echo $row['id']; ?>">
                                        </label>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                        <?php mysqli_free_result($selection); ?>
                        <tr>
                            <td></td>
                            <td><input aria-describedby="basic-addon2" name="name" type="text" class="form-control" placeholder="Maid Name"></td>
                            <td><input aria-describedby="basic-addon2" name="gender" type="text" class="form-control" placeholder="Gender"></td>
                            <td><input aria-describedby="basic-addon2" name="contract" type="text" class="form-control" placeholder="Contract"></td>
                        </tr>
                    </table>
                    <button class="btn btn-lg btn-danger pull-right" type="submit" name="delete_button">DELETE!</button>
                    <button class="btn btn-lg btn-success pull-right" type="submit" name="add_button"> ADD </button>
                </form>
            <?php } ?>
        </div>
        <div class="col-md-4">
            <form name="user_maid_display" method="post" action="#">
                <h1>See a list of maids assigned to users</h1>
                <button class="btn btn-info" type="submit" name="user_maid_button">Show</button>
                <?php if ($display_user_maid) { ?>
                    <table class="table tab-content">
                        <tr>
                            <th>User Name</th>
                            <th>Maid Name</th>
                            <th>Total Price</th>
                        </tr>
                        <?php while ($row = mysqli_fetch_assoc($user_maid)) { ?>
                            <tr>
                                <td><?php echo $row['user_name']; ?></td>
                                <td><?php echo $row['maid_name']; ?></td>
                                <td><?php echo $row['total_price']; ?></td>
                            </tr>
                        <?php } ?>
                    </table>
                <?php } ?>
            </form>
        </div>
    </div>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery-1.11.2.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>