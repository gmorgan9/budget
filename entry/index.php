<?php
require_once "../database/connection.php";
require_once "../path.php";
session_start();
?>

<!-- php functions -->
    <?php
    // add expense
        if(isset($_POST['exp'])){
            $idno  = rand(10000, 99999); // figure how to not allow duplicates
            $description = mysqli_real_escape_string($conn, $_POST['description']);
            $amount = mysqli_real_escape_string($conn, $_POST['amount']);
            $comments = mysqli_real_escape_string($conn, $_POST['comments']);
            $date_spent = mysqli_real_escape_string($conn, $_POST['date_spent']);
            $cat_idno = mysqli_real_escape_string($conn, $_POST['cat_idno']);
            $card_idno = mysqli_real_escape_string($conn, $_POST['card_idno']);
            $person_fn = mysqli_real_escape_string($conn, $_POST['person_fn']);
            $person_ln = mysqli_real_escape_string($conn, $_POST['person_ln']);
            $person_idno = mysqli_real_escape_string($conn, $_POST['person_idno']);
            $account_link = mysqli_real_escape_string($conn, $_POST['account_link']);
            // $created_date = date("F j, Y");
            // $created_time = date("g:i a");
        
            $select = " SELECT * FROM expenses WHERE idno = '$idno'";
        
            $result = mysqli_query($conn, $select);
        
            if(mysqli_num_rows($result) > 0){
            
                $error[] = 'expense already exist!';
            
            }else {
                $insert = "INSERT INTO expenses (idno, description, amount, comments, person_idno, cat_idno, person_fn, person_ln, account_link, card_idno, date_spent) VALUES ('$idno', '$description','$amount','$comments','$person_idno','$cat_idno', '$person_fn', '$person_ln', '$account_link', '$card_idno', '$date_spent')";
                mysqli_query($conn, $insert);
                header('location: /');
            }
        
        };
    // end add expense

    // add income
        if(isset($_POST['inc'])){
            $idno  = rand(10000, 99999); // figure how to not allow duplicates
            $description = mysqli_real_escape_string($conn, $_POST['description']);
            $amount = mysqli_real_escape_string($conn, $_POST['amount']);
            $comments = mysqli_real_escape_string($conn, $_POST['comments']);
            $date_gained = mysqli_real_escape_string($conn, $_POST['date_gained']);
            $cat_idno = mysqli_real_escape_string($conn, $_POST['cat_idno']);
            $card_idno = mysqli_real_escape_string($conn, $_POST['card_idno']);
            $person_fn = mysqli_real_escape_string($conn, $_POST['person_fn']);
            $person_ln = mysqli_real_escape_string($conn, $_POST['person_ln']);
            $person_idno = mysqli_real_escape_string($conn, $_POST['person_idno']);
            $account_link = mysqli_real_escape_string($conn, $_POST['account_link']);
            // $created_date = date("F j, Y");
            // $created_time = date("g:i a");

            $select = " SELECT * FROM income WHERE idno = '$idno'";

            $result = mysqli_query($conn, $select);

            if(mysqli_num_rows($result) > 0){

                $error[] = 'income already exist!';

            }else {
                $insert = "INSERT INTO income (idno, description, amount, comments, person_idno, cat_idno, person_fn, person_ln, account_link, card_idno, date_gained) VALUES ('$idno', '$description','$amount','$comments','$person_idno','$cat_idno', '$person_fn', '$person_ln', '$account_link', '$card_idno', '$date_gained')";
                mysqli_query($conn, $insert);
                header('location: /');
            }

        };
    // end add income

    // success message
        if(isset($_GET['success'])) {
            $success = '
               <div class="pt-3"></div>
               <div class="success">
               <strong>Success:</strong> 
               Your request has been sent!
               </div>
               ';
        }
    // end success message
    ?>
<!-- end php functions -->

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- APPLE HOME SCREEN META TAGS -->
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
        <link rel="apple-touch-icon" href="logo.png">
    <!-- end APPLE -->
    <meta http-equiv="ScreenOrientation" content="autoRotate:disabled">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable = no, viewport-fit=cover">
    <title>Budget</title>

    <!-- bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <!-- end bootstrap -->

    <!-- custom styles -->
        <link rel="stylesheet" href="../style.css?v=1.32">
        <style>
            .header {
                margin-left: -12px !important;
                z-index: 1;
                background-color: #3e4881 !important;
                position: fixed; 
                top: 0 !important; 
                width: 100%;
                height: 120px !important;
            }
            .home_page {
                background-color: #c0c0c0;
                box-sizing: border-box;
            }
            * {
                margin: 0; 
                padding: 0; 
                box-sizing: border-box;
            }
            .success {
                width: 70%;
                border-left: 4px solid #00a32a;
                padding: 12px;
                margin-left: auto;
                margin-right: auto;
                margin-bottom: 20px;
                background-color: #fff;
                box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
                word-wrap:break-word
            }
            .background {
                background-color: rgb(242, 247, 253);
                width: 70%;
                margin-left: auto;
                margin-right: auto;
                border-radius: 15px;
                margin-top: 25%;
            }
        </style>
    <!-- end custom styles -->


</head>
<body style="background-color: #3e4881;">

    <!-- php code -->
        <?php 

        $user_id = $_SESSION['user_id'];
        $select = " SELECT * FROM users WHERE user_id = '$user_id' ";
        $result = mysqli_query($conn, $select);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $user_id      = $row['user_id'];
                $user_idno    = $row['idno'];
                $firstname    = $row['firstname'];
                $lastname     = $row['lastname'];
                $loggedin     = $row['loggedin'];
                $role         = $row['isadmin'];
                $profile_pic  = $row['profile_picture'];
                $account_link = $row['account_link'];
        }}

        ?>
    <!-- end php code -->

<!-- Container -->
    <div class="container-fluid">

    <div class="nav" style="background-color: pink;">
            <nav class="navbar d-flex justify-content-center">
                <ul class="navbar-list">
                    <li class="navbar-item">
                        <button class="navbar-link active" data-nav-link>Expenses</button>
                    </li>
                    <div class="pe-4"></div>
                    <li class="navbar-item">
                        <button class="navbar-link" data-nav-link>Income</button>
                    </li>
                </ul>
            </nav>
        </div>


        <section class="active" data-page="expenses">
            <div class="mt-4"></div>
            <h2 class="text-white">
                Expenses
            </h2>
            <p class="" style="color: rgb(242, 247, 253);">
                Enter an expense to keep track of.
            </p>
            <hr>
            <div class="mt-4"></div>

            <form action="" class="" method="POST">
                <input type="hidden" class="form-control" name="person_fn" value="<?php echo $firstname;?>">
                <input type="hidden" class="form-control" name="person_ln" value="<?php echo $lastname;?>">
                <input type="hidden" class="form-control" name="person_idno" value="<?php echo $user_idno;?>">
                <input type="hidden" class="form-control" name="account_link" value="<?php echo $account_link;?>">
                <div class="mb-3">
                    <label for="desc" class="form-label text-white">Description &nbsp;<span style="font-size: 10px; color: rgb(169, 169, 169);">e.g "McDonalds"</span></label>
                    <input type="text" name="description" class="form-control" id="desc">
                </div>
                <label for="amount" class="form-label text-white">Amount &nbsp;<span style="font-size: 10px; color: rgb(169, 169, 169);">e.g 130.40</span></label>
                <div class="mb-3 input-group">
                    <span class="input-group-text" id="basic-addon1">$</span>
                    <input type="text" name="amount" class="form-control" id="amount">
                </div>
                <div class="mb-3">
                    <label for="date" class="form-label text-white">Date Spent</label>
                    <input type="date" name="date_spent" class="form-control" id="amount">
                </div>
                <div class="row">
                <div class="mb-3 w-50">
                    <label for="category" class="form-label text-white">Category</label>
                    <select name="cat_idno" id="category" class="form-control">
                        <option value="">Select one...</option>
                        <?php
                        $query ="SELECT * FROM categories";
                        $result = $conn->query($query);
                        if($result->num_rows> 0){
                          $options= mysqli_fetch_all($result, MYSQLI_ASSOC);
                        }
                        ?>
                        <?php 
                            foreach ($options as $option) {
                        ?>
                            <option value="<?php echo $option['idno']; ?>"><?php echo $option['category']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-3 w-50">
                    <label for="date" class="form-label text-white">Card</label>
                    <select name="card_idno" id="card" class="form-control">
                        <option value="">Select one...</option>
                        <?php
                        $query ="SELECT * FROM cards";
                        $result = $conn->query($query);
                        if($result->num_rows> 0){
                          $options= mysqli_fetch_all($result, MYSQLI_ASSOC);
                        }
                        ?>
                        <?php 
                            foreach ($options as $option) {
                        ?>
                            <option value="<?php echo $option['idno']; ?>"><?php echo $option['name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                </div>
                <div class="mb-3">
                    <label for="comment" class="form-label text-white">Comments</label>
                    <textarea class="form-control" name="comments" id="comment"></textarea>
                </div>
                <button type="submit" name="exp" class="mt-3 btn" style="background-color: rgb(242, 247, 253);">Submit</button>
            </form>
        </section>

        <section class="" data-page="income">
            <div class="mt-4"></div>
            <h2 class="text-white">
                Income
            </h2>
            <p class="" style="color: rgb(242, 247, 253);">
                Enter an income to keep track of.
            </p>
            <hr>
            <div class="mt-4"></div>

            <form action="" class="" method="POST">
                <input type="hidden" class="form-control" name="person_fn" value="<?php echo $firstname;?>">
                <input type="hidden" class="form-control" name="person_ln" value="<?php echo $lastname;?>">
                <input type="hidden" class="form-control" name="person_idno" value="<?php echo $user_idno;?>">
                <input type="hidden" class="form-control" name="account_link" value="<?php echo $account_link;?>">
                <div class="mb-3">
                    <label for="desc" class="form-label text-white">Description &nbsp;<span style="font-size: 10px; color: rgb(169, 169, 169);">e.g "Paycheck"</span></label>
                    <input type="text" name="description" class="form-control" id="desc">
                </div>
                <label for="amount" class="form-label text-white">Amount &nbsp;<span style="font-size: 10px; color: rgb(169, 169, 169);">e.g 630.40</span></label>
                <div class="mb-3 input-group">
                    <span class="input-group-text" id="basic-addon1">$</span>
                    <input type="text" name="amount" class="form-control" id="amount">
                </div>
                <div class="mb-3">
                    <label for="date" class="form-label text-white">Date Gained</label>
                    <input type="date" name="date_gained" class="form-control" id="amount">
                </div>
                <div class="row">
                <div class="mb-3 w-50">
                    <label for="category" class="form-label text-white">Category</label>
                    <select name="cat_idno" id="category" class="form-control">
                        <option value="">Select one...</option>
                        <?php
                        $query ="SELECT * FROM categories";
                        $result = $conn->query($query);
                        if($result->num_rows> 0){
                          $options= mysqli_fetch_all($result, MYSQLI_ASSOC);
                        }
                        ?>
                        <?php 
                            foreach ($options as $option) {
                        ?>
                            <option value="<?php echo $option['idno']; ?>"><?php echo $option['category']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-3 w-50">
                    <label for="date" class="form-label text-white">Card</label>
                    <select name="card_idno" id="card" class="form-control">
                        <option value="">Select one...</option>
                        <?php
                        $query ="SELECT * FROM cards";
                        $result = $conn->query($query);
                        if($result->num_rows> 0){
                          $options= mysqli_fetch_all($result, MYSQLI_ASSOC);
                        }
                        ?>
                        <?php 
                            foreach ($options as $option) {
                        ?>
                            <option value="<?php echo $option['idno']; ?>"><?php echo $option['name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                </div>
                <div class="mb-3">
                    <label for="comment" class="form-label text-white">Comments</label>
                    <textarea class="form-control" name="comments" id="comment"></textarea>
                </div>
                <button type="submit" name="inc" class="mt-3 btn" style="background-color: rgb(242, 247, 253);">Submit</button>
            </form>
        </section>

    </div>
<!-- end Container -->


<!-- custom script -->
    <script src="../script.js"></script>
    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<!-- custom scripts -->
</body>
</html>