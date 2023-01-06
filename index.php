<?php
require_once "database/connection.php";
require_once "path.php";
session_start();
?>
<?php
// login
    if(isset($_POST['login'])){
        // $idno  = rand(1000000, 9999999); // figure how to not allow duplicates
        $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
        $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
        $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $pin = $_POST['pin'];
        // $cpassword = $_POST['cpassword'];
        $isadmin = $_POST['isadmin'];
        $loggedin = $_POST['loggedin'];
        $account_link = $_POST['account_link'];
        
        $select = " SELECT * FROM users WHERE account_link = '$account_link' && pin = '$pin' ";
        
        $result = mysqli_query($conn, $select);
        
        if(mysqli_num_rows($result) > 0){
        
           $row = mysqli_fetch_array($result);
           $sql = "UPDATE users SET loggedin='1' WHERE account_link='$account_link'";
           if (mysqli_query($conn, $sql)) {
              echo "Record updated successfully";
            } else {
              echo "Error updating record: " . mysqli_error($conn);
            }
            $_SESSION['firstname']         = $row['firstname'];
            $_SESSION['user_id']          = $row['user_id'];
            $_SESSION['loggedin']         = $row['loggedin'];
            $_SESSION['user_idno']        = $row['idno'];
            $_SESSION['lastname']         = $row['lastname'];
            $_SESSION['username']         = $row['username'];
            $_SESSION['email']            = $row['email'];
            $_SESSION['pin']             = $row['pin'];
            // $_SESSION['cpass']            = $row['cpassword'];
            // header('location:' . BASE_URL . '/');
            header('location: /');
        
        }else{
           $error = '
           <div class="pt-3"></div>
           <div class="login_error">
           <strong>Error:</strong> 
           The username <strong>'. $_POST['username'] .'</strong> or password entered is not registered on this site. Please try again.
           </div>
           ';
        }

    };
// end login

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- APPLE HOME SCREEN META TAGS -->
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
        <link rel="apple-touch-icon" href="fav.png">
    <!-- end APPLE -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable = no">
    <title>Budget</title>

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    <!-- custom styles -->
    <link rel="stylesheet" href="style.css">



</head>


<?php if(!isset($_SESSION['username'])) {?>
    <body style="background-color: rgb(242, 247, 253);">

<!-- login -->
    <div class="login">

        <div class="mt-4"></div>
            <div class="mt-5"></div>
            <div class="d-flex justify-content-center">
                <img class="" src="logo.png" alt="" width="175">
            </div>
            <div class="mt-2"></div>
            <div  class="">

            <form class="form" action="" method="POST">
            <input type="hidden" id="user_login" name="account_link" value="94768" class="form-control">
            <div style="background-color: rgb(255, 255, 255); padding-left: 10px; padding-top: 5px; padding-bottom: 5px; width: 70%; margin-left: auto; margin-right: auto; border-radius: 15px;" class="username">
                <label class="fw-bold fs-3" for="user_login">Account ID</label>
                <p class="text-muted fs-6" style="color: rgb(25, 25, 25);">94768</p>
            </div>
            <br>
            <div style="background-color: rgb(255, 255, 255);  padding-left: 10px; padding-top: 5px; padding-bottom: 5px; width: 70%; margin-left: auto; margin-right: auto; border-radius: 15px;" class="pin">
                <label class="fw-bold fs-2" for="user_pass">PIN</label>
                <!-- <input type="password" name="pin" inputmode="numeric" class="form-control"> -->
                <!-- <label for="staticEmail" class="col-sm-2 col-form-label">Email</label> -->
                    <div class="col-sm-10">
                      <input type="password" class="form-control-plaintext" placeholder="****" name="pin"inputmode="numeric" id="staticEmail">
                    </div>
            </div>
            <br>
            <div class="button text-end d-flex justify-content-center">
                <input style="background-color: #3e4881 !important; border-radius: 15px !important; width: 70%; margin-left: auto; margin-right: auto;" type="submit" name="login" class="btn text-white fw-bold" value="Log In">
            </div>
        </form>
        <div class="mt-3"></div>
        <div class="d-flex justify-content-center" >
            <p class="text-muted text-end" style="width: 70%;">
                

                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Forgot Pin?
                </button>

                <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Forgot Pin?</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">

                            <form action="https://formsubmit.co/garrett.morgan.pro@gmail.com" method="POST">
                                <input type="hidden" name="_captcha" value="false">
                                <input type="hidden" name="_subject" value="Forgotten Pin on Budget">
                                <!-- <input type="hidden" name="_next" value="https://yourdomain.co/thanks.html"> -->
                                <input type="hidden" name="_template" value="box">

                                <div class="input-wrapper">
                                    <input type="text" name="Full&nbsp;Name" class="form-input" placeholder="Full name" required>
                                    <div class="pt-2"></div>
                                    <input type="email" name="Email" class="form-input" placeholder="Email address" required>
                                </div>

                                <button type="submit">
                                    <i class="bi bi-send"></i>
                                    <span>Send Message</span>
                                </button>

                            </form>

                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                          </div>
                        </div>
                      </div>
                    </div>
                <!-- end Modal -->


            </p>
        </div>

    </div>
<!-- end login -->
    
<?php } else { ?>
    <body style="background-color: rgb(78, 78, 78);">

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
    <div class="container">

        <section class="active" data-page="home">
            <div class="mt-4"></div>
            <h2 class="text-white">
                Welcome, <?php echo $firstname; ?>!
            </h2>
            <p class="date text-muted">
                <?php echo date("l, F j, Y"); ?>
            </p>
            <hr>
            <div class="mt-3"></div>
            <div class="d-fle flex-row justify-content-center">

                <div class="row justify-content-center">
                    <h3 class="text-white">
                        Income
                    </h3>
                    <div class="card" style="margin-right: 20px; width: 40%; background-color: rgb(100, 100, 100) !important; color: white;">
                        <div class="card-body">
                          <h3 class="card-title text-center">Monthly</h3>
                          <p class="card-text fs-5 text-center">
                          <?php 
                                $month_year = date('F Y');
                                $firstday = strtotime("first day of ". $month_year);
                                $first_day = date('Y-m-d', $firstday);
                                $month_year = date('F Y');
                                $lastday = strtotime("last day of ". $month_year);
                                $last_day = date('Y-m-d', $lastday);
                            ?>

                          <?php
                            $sql="SELECT count('1') FROM income WHERE date_gained BETWEEN '$first_day' AND '$last_day' AND account_link = '$account_link'";
                            $result=mysqli_query($conn,$sql);
                            $rowtotal=mysqli_fetch_array($result); 
                            $count_m_income = $rowtotal[0];
                          ?>
                            
                            <?php
                                $sql="SELECT sum(amount) FROM income WHERE date_gained BETWEEN '$first_day' AND '$last_day' AND account_link = '$account_link'";
                                $result=mysqli_query($conn,$sql);
                                $month_income=mysqli_fetch_array($result); 
                                $m_income = $month_income[0];
                                if($count_m_income == 0){
                                    echo "$0";
                                } else {
                                    echo "$$month_income[0]";
                                }
                            ?>
                          </p>
                        </div>
                    </div>

                    <div class="card" style="width: 40%; background-color: rgb(100, 100, 100) !important; color: white;">
                        <div class="card-body">
                            <h3 class="card-title text-center">Yearly</h3>
                            <p class="card-text fs-5 text-center">

                                <?php
                                $sql="SELECT count('1') FROM income WHERE account_link = '$account_link'";
                                $result=mysqli_query($conn,$sql);
                                $rowtotal=mysqli_fetch_array($result); 
                                $count_y_income = $rowtotal[0];
                                ?>

                                <?php
                                    $sql="SELECT sum(amount) FROM income WHERE account_link = '$account_link'";
                                    $result=mysqli_query($conn,$sql);
                                    $year_income=mysqli_fetch_array($result);
                                    $y_income = $year_income[0]; 
                                    if($count_y_income == 0){
                                        echo "$0";
                                    } else {
                                        echo "$$year_income[0]";
                                    }
                                ?>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="mt-3"></div>
                <div class="row justify-content-center">
                    <h3 class="text-white">
                        Expenses
                    </h3>
                    <div class="card" style="margin-right: 20px; width: 40%; background-color: rgb(100, 100, 100) !important; color: white;">
                        <div class="card-body">
                            <h3 class="card-title text-center">Monthly</h3>
                            <p class="card-text fs-5 text-center">
                                <?php 
                                    $month_year = date('F Y');
                                    $firstday = strtotime("first day of ". $month_year);
                                    $first_day = date('Y-m-d', $firstday);
                                    $month_year = date('F Y');
                                    $lastday = strtotime("last day of ". $month_year);
                                    $last_day = date('Y-m-d', $lastday);
                                ?>
                                <?php
                                $sql="SELECT count('1') FROM expenses WHERE date_spent BETWEEN '$first_day' AND '$last_day' AND account_link = '$account_link'";
                                $result=mysqli_query($conn,$sql);
                                $rowtotal=mysqli_fetch_array($result); 
                                $count_m_expenses = $rowtotal[0];
                                ?>
                                <?php
                                    $sql="SELECT sum(amount) FROM expenses WHERE date_spent BETWEEN '$first_day' AND '$last_day' AND account_link = '$account_link'";
                                    $result=mysqli_query($conn,$sql);
                                    $month_expenses=mysqli_fetch_array($result); 
                                    $m_expenses = $month_expenses[0];
                                    if($count_m_expenses == 0){
                                        echo "$0";
                                    } else {
                                        echo "$$month_expenses[0]";
                                    }
                                ?>
                            </p>
                        </div>
                    </div>

                    <div class="card" style="width: 40%; background-color: rgb(100, 100, 100) !important; color: white;">
                        <div class="card-body">
                            <h3 class="card-title text-center">Yearly</h3>
                            <p class="card-text fs-5 text-center">
                                <?php
                                $sql="SELECT count('1') FROM expenses WHERE date_spent BETWEEN '$first_day' AND '$last_day' AND account_link = '$account_link'";
                                $result=mysqli_query($conn,$sql);
                                $rowtotal=mysqli_fetch_array($result); 
                                $count_y_expenses = $rowtotal[0];
                                ?>
                                <?php
                                    $sql="SELECT sum(amount) FROM expenses WHERE account_link = '$account_link'";
                                    $result=mysqli_query($conn,$sql);
                                    $year_expenses=mysqli_fetch_array($result); 
                                    $y_expenses = $year_expenses[0];
                                    if($count_m_expenses == 0){
                                        echo "$0";
                                    } else {
                                        echo "$$year_expenses[0]";
                                    }
                                ?>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="mt-3"></div>
                <div class="row justify-content-center">
                    <h3 class="text-white">
                        Total
                    </h3>
                    <div class="card" style="margin-right: 20px; width: 40%; background-color: rgb(100, 100, 100) !important; color: white;">
                        <div class="card-body">
                            <h3 class="card-title text-center">Monthly</h3>
                            <p class="card-text fs-5 text-center">
                                <?php 
                                    $month_total = $m_income - $m_expenses;
                                    if($month_total < 0) {
                                        echo "<span class='text-danger'>$$month_total</span>";
                                    } else {
                                        echo "$$month_total";
                                    } 
                                ?>
                            </p>
                        </div>
                    </div>

                    <div class="card" style="width: 40%; background-color: rgb(100, 100, 100) !important; color: white;">
                        <div class="card-body">
                            <h3 class="card-title text-center">Yearly</h3>
                            <p class="card-text fs-5 text-center">
                                <?php 
                                    $year_total = $y_income - $y_expenses;
                                    if($year_total < 0) {
                                        echo "<span class='text-danger'>$$year_total</span>";
                                    } else {
                                        echo "$$year_total";
                                    }
                                     
                                ?>
                            </p>
                        </div>
                    </div>
                </div>



            </div>
            


        </section>

        <section class="" data-page="expenses">
            <div class="mt-4"></div>
            <h2 class="text-white">
                Expenses
            </h2>
            <p class="text-muted">
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
                <button type="submit" name="exp" class="btn btn-secondary">Submit</button>
            </form>
        </section>

        <section class="" data-page="income">
            <div class="mt-4"></div>
            <h2 class="text-white">
                Income
            </h2>
            <p class="text-muted">
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
                <button type="submit" name="inc" class="btn btn-secondary">Submit</button>
            </form>
        </section>

        <section class="" data-page="settings">
            <div class="mt-4"></div>
            <h2 class="text-white">
                Settings
            </h2>
            <hr>
            <div class="d-flex justify-content-center">
                <span class="profile-img">
                    <img src="<?php echo $profile_pic?>" height="150px" width="150px" style="border-radius: 100px;" alt="">
                </span>
            </div>
            <div class="mt-3"></div>
            <div class="name">
                <h4 class="text-center text-white">
                    <?php echo $firstname; ?> <?php echo $lastname; ?>
                </h4>
            </div>
            <div class="mt-5"></div>
            <div class="d-flex justify-content-center">
                <ul class="list-group list-group-flush w-75">
                    <?php if($role == 1) { ?>
                        <a style="text-decoration: none;" href="users/"><li class="list-group-item text-white text-center" style="background-color: rgb(100, 100, 100) !important;">Users</li></a>
                    <?php } else {}?>
                    <a style="text-decoration: none;" href="expenses/"><li class="list-group-item text-white text-center" style="background-color: rgb(100, 100, 100) !important;">Expenses</li></a>
                    <a style="text-decoration: none;" href="income/"><li class="list-group-item text-white text-center" style="background-color: rgb(100, 100, 100) !important;">Income</li></a>
                    <a style="text-decoration: none;" href="account/index.php?id=<?php echo $user_id; ?>"><li class="list-group-item text-white text-center" style="background-color: rgb(100, 100, 100) !important;">Edit Account</li></a>
                    <a style="text-decoration: none;" href="logout.php"><li class="list-group-item text-white text-center" style="background-color: rgb(100, 100, 100) !important;">Logout</li></a>
                </ul>
            </div>
        </section>

        <div class="footer-nav">
            <nav class="navbar d-flex justify-content-center">
                <ul class="navbar-list">
                    <li class="navbar-item">
                        <button class="navbar-link active" data-nav-link>Home</button>
                    </li>
                    <div class="pe-4"></div>
                    <li class="navbar-item">
                        <button class="navbar-link" data-nav-link>Expenses</button>
                    </li>
                    <div class="pe-4"></div>
                    <li class="navbar-item">
                        <button class="navbar-link" data-nav-link>Income</button>
                    </li>
                    <div class="pe-4"></div>
                    <li class="navbar-item">
                        <button class="navbar-link" data-nav-link>Settings</button>
                    </li>
                </ul>
            </nav>
        </div>

    </div>
<!-- end Container -->


<?php } ?>

    <!-- custom script -->
    <script src="script.js"></script>
    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>