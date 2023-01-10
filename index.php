<?php
require_once "database/connection.php";
require_once "path.php";
session_start();
?>

<!-- php functions -->
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
               $sql = "UPDATE users SET loggedin='1' WHERE pin='$pin'";
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

    // add item
        if(isset($_POST['add_item'])){
            $idno  = rand(10000, 99999); 
            $category = mysqli_real_escape_string($conn, $_POST['category']);
            $parent = mysqli_real_escape_string($conn, $_POST['parent']);

            $select = " SELECT * FROM categories WHERE idno = '$idno'";

            $result = mysqli_query($conn, $select);

            if(mysqli_num_rows($result) > 0){

                $error[] = 'category already exist!';

            }else {
                $insert = "INSERT INTO categories (idno, category, parent) VALUES ('$idno', '$category','$parent')";
                mysqli_query($conn, $insert);
                header('location: /');
            }

        };
    // end add item

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
        <link rel="stylesheet" href="style.css?v=1.32">
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
            
        </style>
    <!-- end custom styles -->


</head>


<?php if(!isset($_SESSION['username'])) {?>
    <body style="background-color: #3e4881;">

<!-- login -->
    <div class="login">
        <div class="background">

        
            <div class="mt-4"></div>
                <div class="mt-5"></div>
                <div class="d-flex justify-content-center">
                    <img class="" src="logo.png" alt="" width="175">
                </div>
                <div class="mt-2"></div>

                <div class="mt-2"></div>
                <div  class="">

                <?php echo $success;
                // if(isset($_GET['success'])) {
                //     echo "it was a success";
                // }
                ?>

                
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


                    <button type="button" class="text-muted" data-bs-toggle="modal" data-bs-target="#exampleModal">
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

                                <form action="https://formsubmit.co/4680eb710c6256f1618a05b47da52254" method="POST">
                                    <input type="hidden" name="_captcha" value="false">
                                    <input type="hidden" name="_subject" value="Forgotten Pin on Budget">
                                    <input type="hidden" name="_next" value="https://budget.morganserver.com?success=sent">
                                    <input type="hidden" name="_template" value="box">
                                    <p class="text-muted">
                                        Enter your name and email address for the request of a pin reset.
                                    </p>
                                    <div class="input-wrapper">
                                        <input type="hidden" name="Account&nbsp;ID" value="94768">
                                        <input type="text" name="Full&nbsp;Name" class="form-control" placeholder="Full name" required>
                                        <div class="pt-3"></div>
                                        <input type="email" name="Email" class="form-control" placeholder="Email address" required>
                                    </div>  



                              </div>
                              <div class="modal-footer">
                                <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                                <button type="submit" class="btn btn-primary">Send</button>
                              </div>
                              </form>
                            </div>
                          </div>
                        </div>
                    <!-- end Modal -->


                </p>
            </div>
        </div>
    </div>
<!-- end login -->
    
<?php } else { ?>
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

        <section class="active" data-page="home">

            <!-- header -->
                <div class="header">
                    <h2 class="text-white" style="padding-left: 10px; padding-top: 65px;">
                    <?php 
                        date_default_timezone_set('America/Denver');
                        $month_budget = date('F Y');
                        echo $month_budget;
                    ?>
                        <a style="text-decoration: none; color: white;" href="/entry/"><i class="float-end pe-3 bi bi-plus" style="font-size: 36px; margin-top: -10px !important;"></i></a>
                    </h2>
            
        
                    <div class="mt-3"></div>
                </div>
            <!-- end header -->

            <!-- top -->
                <div class="row d-flex justify-content-center" style="margin-top: 90px !important; background-color: rgb(245, 245, 245);">
                    <div class="card mt-5" style="border: none; margin-right: 20px; width: 40%; background-color: rgb(255, 255, 255) !important; color: black;">
                        <div class="card-body">
                            <i class="fs-1 bi bi-coin" style="margin-left: -20px; color: rgb(210,210,210)"></i>
                            <p class="card-title text-start text-muted fw-bold" style="margin-left: -20px; width: 50%; line-height: .95;">Spent So Far</p>
                            <p class="card-text fs-5 text-start fw-bold" style="margin-left: -20px;">

                        <!-- php code -->
                            <?php

                                $month_year = date('F Y');
                                $firstday = strtotime("first day of ". $month_year);
                                $first_day = date('Y-m-d', $firstday);
                                $month_year = date('F Y');
                                $lastday = strtotime("last day of ". $month_year);
                                $last_day = date('Y-m-d', $lastday);

                                $sql="SELECT count('1') FROM expenses WHERE date_spent BETWEEN '$first_day' AND '$last_day' AND account_link = '$account_link'";
                                $result=mysqli_query($conn,$sql);
                                $rowtotal=mysqli_fetch_array($result); 
                                $count_spent = $rowtotal[0];

                                $sql="SELECT sum(amount) FROM expenses WHERE date_spent BETWEEN '$first_day' AND '$last_day' AND account_link = '$account_link'";
                                $result=mysqli_query($conn,$sql);
                                $month_spent=mysqli_fetch_array($result); 
                                $m_spent = $month_spent[0];
                                    
                            ?>
                        <!-- end php code -->

                        <!-- php code -->
                            <?php
                                if($count_spent == 0){
                                    echo "$0.00";
                                } else {
                                    echo "$$m_spent";
                                }
                            ?>
                        <!-- end php code -->
                            
                            </p>
                        </div>
                    </div>
                    <div class="card mt-5" style="border:none; width: 40%; background-color: rgb(255, 255, 255) !important; color: black;">
                        <div class="card-body">
                          <i class="fs-1 bi bi-cash-coin" style="margin-left: -20px; color: rgb(210,210,210)"></i>
                          <p class="card-title text-start text-muted fw-bold" style="margin-left: -20px; width: 70%; line-height: .95;">Received So Far</p>
                          <p class="card-text fs-5 text-start fw-bold" style="margin-left: -20px;">
                          


                        <!-- php code -->
                            <?php

                                $sql="SELECT count('1') FROM income WHERE date_gained BETWEEN '$first_day' AND '$last_day' AND account_link = '$account_link'";
                                $result=mysqli_query($conn,$sql);
                                $rowtotal=mysqli_fetch_array($result); 
                                $count_inc = $rowtotal[0];

                                $sql="SELECT sum(amount) FROM income WHERE date_gained BETWEEN '$first_day' AND '$last_day' AND account_link = '$account_link'";
                                $result=mysqli_query($conn,$sql);
                                $month_inc=mysqli_fetch_array($result); 
                                $m_inc = $month_inc[0];
    
                            ?>
                        <!-- end php code -->

                        <!-- php code -->
                            <?php
                                if($count_inc == 0){
                                    echo "$0.00";
                                } else {
                                     echo "$$m_inc";
                                }
                            ?>
                        <!-- end php code -->


                          </p>
                        </div>
                    </div>
                </div>
            <!-- end top -->

            <!-- income -->
                
                <div class="row d-flex justify-content-center" style="background-color: rgb(245, 245, 245);">
                    <div class="card mt-3" style="border: none; width: 85%; background-color: rgb(255, 255, 255) !important; color: black;">
                        <div class="card-body" style="margin-bottom: -30px !important;">
                            <div>
                                <p class="card-title text-muted fw-bold float-start" style="margin-left: -10px;">Income</p>
                                <p class="card-title text-muted float-end">Received</p>
                            </div>

                        <!-- php code -->
                            <?php

                                $month_year = date('F Y');
                                $firstday = strtotime("first day of ". $month_year);
                                $first_day = date('Y-m-d', $firstday);
                                $month_year = date('F Y');
                                $lastday = strtotime("last day of ". $month_year);
                                $last_day = date('Y-m-d', $lastday);
                                
                                $query ="SELECT * FROM categories where parent = 'income'";
                                $result = $conn->query($query);
                                if($result->num_rows> 0){
                                  $income= mysqli_fetch_all($result, MYSQLI_ASSOC);
                                }
                                foreach ($income as $i) {

                                    $cat_idno = $i['idno'];

                                    $sql="SELECT count('1') FROM income WHERE date_gained BETWEEN '$first_day' AND '$last_day' AND cat_idno = '$cat_idno' AND account_link = '$account_link'";
                                    $result=mysqli_query($conn,$sql);
                                    $rowtotal=mysqli_fetch_array($result); 
                                    $count_income = $rowtotal[0];

                                    $sql="SELECT sum(amount) FROM income WHERE date_gained BETWEEN '$first_day' AND '$last_day' AND cat_idno = '$cat_idno' AND account_link = '$account_link'";
                                    $result=mysqli_query($conn,$sql);
                                    $month_income=mysqli_fetch_array($result); 
                                    $m_income = $month_income[0];
                                    
                            ?>
                        <!-- end php code -->

                          <p class="card-text fs-5 text-start fw-bold">
                            <div class="row" style="margin-top: -25px !important;">
                              <div class="col-8 text-start" style="margin-left: -10px;">
                                  <?php echo $i['category']; ?>
                              </div>
                              <div class="col text-end pb-1" style="">
                                <!-- php code -->
                                    <?php
                                        if($count_income == 0){
                                            echo "$0.00";
                                        } else {
                                             echo "$$m_income";
                                        }
                                    ?>
                                <!-- end php code -->
                              </div>
                              <hr>
                            </div>
                            <?php } ?>

                          </p>
                        </div>
                    </div>
                </div>

            <!-- end income -->

            <!-- giving -->
                
                <div class="row d-flex justify-content-center" style="background-color: rgb(245, 245, 245);">
                    <div class="card mt-3" style="border: none; width: 85%; background-color: rgb(255, 255, 255) !important; color: black;">
                        <div class="card-body" style="margin-bottom: -30px !important;">
                            <div>
                                <p class="card-title text-muted fw-bold float-start" style="margin-left: -10px;">Giving</p>
                                <p class="card-title text-muted float-end">Spent</p>
                            </div>

                        <!-- php code -->
                            <?php

                                $month_year = date('F Y');
                                $firstday = strtotime("first day of ". $month_year);
                                $first_day = date('Y-m-d', $firstday);
                                $month_year = date('F Y');
                                $lastday = strtotime("last day of ". $month_year);
                                $last_day = date('Y-m-d', $lastday);

                                $query ="SELECT * FROM categories where parent = 'giving'";
                                $result = $conn->query($query);
                                if($result->num_rows> 0){
                                  $giving= mysqli_fetch_all($result, MYSQLI_ASSOC);
                                }
                                foreach ($giving as $g) {
                                
                                    $cat_idno = $g['idno'];
                                
                                    $sql="SELECT count('1') FROM income WHERE date_gained BETWEEN '$first_day' AND '$last_day' AND cat_idno = '$cat_idno' AND account_link = '$account_link'";
                                    $result=mysqli_query($conn,$sql);
                                    $rowtotal=mysqli_fetch_array($result); 
                                    $count_giving = $rowtotal[0];
                                
                                    $sql="SELECT sum(amount) FROM income WHERE date_gained BETWEEN '$first_day' AND '$last_day' AND cat_idno = '$cat_idno' AND account_link = '$account_link'";
                                    $result=mysqli_query($conn,$sql);
                                    $month_giving=mysqli_fetch_array($result); 
                                    $m_giving = $month_giving[0];

                            ?>
                        <!-- end php code -->
                            
                            
                          <p class="card-text fs-5 text-start fw-bold">
                            <div class="row" style="margin-top: -25px !important;">
                              <div class="col-8 text-start" style="margin-left: -10px;">
                                  <?php echo $g['category']; ?>
                              </div>
                              <div class="col text-end pb-1" style="">
                                <!-- php code -->
                                    <?php
                                        if($count_giving == 0){
                                            echo "$0.00";
                                        } else {
                                             echo "$$m_giving";
                                        }
                                    ?>
                                <!-- end php code -->
                              </div>
                              <hr>
                            </div>
                            <?php } ?>

                          </p>
                        </div>
                    </div>
                </div>

            <!-- end giving -->

            <!-- housing -->
                
                <div class="row d-flex justify-content-center" style="background-color: rgb(245, 245, 245);">
                    <div class="card mt-3" style="border: none; width: 85%; background-color: rgb(255, 255, 255) !important; color: black;">
                        <div class="card-body" style="margin-bottom: -30px !important;">
                            <div>
                                <p class="card-title text-muted fw-bold float-start" style="margin-left: -10px;">Housing</p>
                                <p class="card-title text-muted float-end">Spent</p>
                            </div>

                        <!-- php code -->
                            <?php

                                $month_year = date('F Y');
                                $firstday = strtotime("first day of ". $month_year);
                                $first_day = date('Y-m-d', $firstday);
                                $month_year = date('F Y');
                                $lastday = strtotime("last day of ". $month_year);
                                $last_day = date('Y-m-d', $lastday);

                                $query ="SELECT * FROM categories where parent = 'housing'";
                                $result = $conn->query($query);
                                if($result->num_rows> 0){
                                  $housing= mysqli_fetch_all($result, MYSQLI_ASSOC);
                                }
                                foreach ($housing as $h) {
                                
                                    $cat_idno = $h['idno'];
                                
                                    $sql="SELECT count('1') FROM expenses WHERE date_spent BETWEEN '$first_day' AND '$last_day' AND cat_idno = '$cat_idno' AND account_link = '$account_link'";
                                    $result=mysqli_query($conn,$sql);
                                    $rowtotal=mysqli_fetch_array($result); 
                                    $count_housing = $rowtotal[0];
                                
                                    $sql="SELECT sum(amount) FROM expenses WHERE date_spent BETWEEN '$first_day' AND '$last_day' AND cat_idno = '$cat_idno' AND account_link = '$account_link'";
                                    $result=mysqli_query($conn,$sql);
                                    $month_housing=mysqli_fetch_array($result); 
                                    $m_housing = $month_housing[0];

                            ?>
                        <!-- end php code -->

                            
                        <p class="card-text fs-5 text-start fw-bold">
                            <div class="row" style="margin-top: -25px !important;">
                              <div class="col-8 text-start" style="margin-left: -10px;">
                                  <?php echo $h['category']; ?>
                              </div>
                              <div class="col text-end pb-1" style="">
                                <!-- php code -->
                                    <?php
                                        if($count_housing == 0){
                                            echo "$0.00";
                                        } else {
                                             echo "$$m_housing";
                                        }
                                    ?>
                                <!-- end php code -->
                              </div>
                              <hr>
                            </div>
                            <?php } ?>

                          </p>
                        </div>
                    </div>
                </div>

            <!-- end housing -->

            <!-- transportation -->
                
                <div class="row d-flex justify-content-center" style="background-color: rgb(245, 245, 245);">
                    <div class="card mt-3" style="border: none; width: 85%; background-color: rgb(255, 255, 255) !important; color: black;">
                        <div class="card-body" style="margin-bottom: -30px !important;">
                            <div>
                                <p class="card-title text-muted fw-bold float-start" style="margin-left: -10px;">Transportation</p>
                                <p class="card-title text-muted float-end">Spent</p>
                            </div>
                            

                        <!-- php code -->
                            <?php

                                $month_year = date('F Y');
                                $firstday = strtotime("first day of ". $month_year);
                                $first_day = date('Y-m-d', $firstday);
                                $month_year = date('F Y');
                                $lastday = strtotime("last day of ". $month_year);
                                $last_day = date('Y-m-d', $lastday);

                                $query ="SELECT * FROM categories where parent = 'transportation'";
                                $result = $conn->query($query);
                                if($result->num_rows> 0){
                                  $transportation= mysqli_fetch_all($result, MYSQLI_ASSOC);
                                }
                                foreach ($transportation as $t) {
                                
                                    $cat_idno = $t['idno'];
                                
                                    $sql="SELECT count('1') FROM expenses WHERE date_spent BETWEEN '$first_day' AND '$last_day' AND cat_idno = '$cat_idno' AND account_link = '$account_link'";
                                    $result=mysqli_query($conn,$sql);
                                    $rowtotal=mysqli_fetch_array($result); 
                                    $count_trans = $rowtotal[0];
                                
                                    $sql="SELECT sum(amount) FROM expenses WHERE date_spent BETWEEN '$first_day' AND '$last_day' AND cat_idno = '$cat_idno' AND account_link = '$account_link'";
                                    $result=mysqli_query($conn,$sql);
                                    $month_trans=mysqli_fetch_array($result); 
                                    $m_trans = $month_trans[0];

                            ?>
                        <!-- end php code -->


                            
                        <p class="card-text fs-5 text-start fw-bold">
                            <div class="row" style="margin-top: -25px !important;">
                              <div class="col-8 text-start" style="margin-left: -10px;">
                                  <?php echo $t['category']; ?>
                              </div>
                              <div class="col text-end pb-1" style="">
                                <!-- php code -->
                                    <?php
                                        if($count_trans == 0){
                                            echo "$0.00";
                                        } else {
                                             echo "$$m_trans";
                                        }
                                    ?>
                                <!-- end php code -->
                              </div>
                              <hr>
                            </div>
                            <?php } ?>

                          </p>
                        </div>
                    </div>
                </div>

            <!-- end transportation -->

            <!-- food -->
                
                <div class="row d-flex justify-content-center" style="background-color: rgb(245, 245, 245);">
                    <div class="card mt-3" style="border: none; width: 85%; background-color: rgb(255, 255, 255) !important; color: black;">
                        <div class="card-body" style="margin-bottom: -30px !important;">
                            <div>
                                <p class="card-title text-muted fw-bold float-start" style="margin-left: -10px;">Food</p>
                                <p class="card-title text-muted float-end">Spent</p>
                            </div>
                            

                        <!-- php code -->
                            <?php

                                $month_year = date('F Y');
                                $firstday = strtotime("first day of ". $month_year);
                                $first_day = date('Y-m-d', $firstday);
                                $month_year = date('F Y');
                                $lastday = strtotime("last day of ". $month_year);
                                $last_day = date('Y-m-d', $lastday);

                                $query ="SELECT * FROM categories where parent = 'food'";
                                $result = $conn->query($query);
                                if($result->num_rows> 0){
                                  $food= mysqli_fetch_all($result, MYSQLI_ASSOC);
                                }
                                foreach ($food as $f) {
                                
                                    $cat_idno = $f['idno'];
                                
                                    $sql="SELECT count('1') FROM expenses WHERE date_spent BETWEEN '$first_day' AND '$last_day' AND cat_idno = '$cat_idno' AND account_link = '$account_link'";
                                    $result=mysqli_query($conn,$sql);
                                    $rowtotal=mysqli_fetch_array($result); 
                                    $count_food = $rowtotal[0];
                                
                                    $sql="SELECT sum(amount) FROM expenses WHERE date_spent BETWEEN '$first_day' AND '$last_day' AND cat_idno = '$cat_idno' AND account_link = '$account_link'";
                                    $result=mysqli_query($conn,$sql);
                                    $month_food=mysqli_fetch_array($result); 
                                    $m_food = $month_food[0];

                            ?>
                        <!-- end php code -->


                        <p class="card-text fs-5 text-start fw-bold">
                            <div class="row" style="margin-top: -25px !important;">
                              <div class="col-8 text-start" style="margin-left: -10px;">
                                  <?php echo $f['category']; ?>
                              </div>
                              <div class="col text-end pb-1" style="">
                                <!-- php code -->
                                    <?php
                                        if($count_food == 0){
                                            echo "$0.00";
                                        } else {
                                             echo "$$m_food";
                                        }
                                    ?>
                                <!-- end php code -->
                              </div>
                              <hr>
                            </div>
                            <?php } ?>

                          </p>
                        </div>
                    </div>
                </div>

            <!-- end food -->

            <!-- personal -->
                
                <div class="row d-flex justify-content-center" style="background-color: rgb(245, 245, 245);">
                    <div class="card mt-3" style="border: none; width: 85%; background-color: rgb(255, 255, 255) !important; color: black;">
                        <div class="card-body" style="margin-bottom: -30px !important;">
                            <div>
                                <p class="card-title text-muted fw-bold float-start" style="margin-left: -10px;">Personal</p>
                                <p class="card-title text-muted float-end">Spent</p>
                            </div>
                            
                        <!-- php code -->
                            <?php

                                $month_year = date('F Y');
                                $firstday = strtotime("first day of ". $month_year);
                                $first_day = date('Y-m-d', $firstday);
                                $month_year = date('F Y');
                                $lastday = strtotime("last day of ". $month_year);
                                $last_day = date('Y-m-d', $lastday);

                                $query ="SELECT * FROM categories where parent = 'personal'";
                                $result = $conn->query($query);
                                if($result->num_rows> 0){
                                  $personal= mysqli_fetch_all($result, MYSQLI_ASSOC);
                                }
                                foreach ($personal as $p) {
                                
                                    $cat_idno = $p['idno'];
                                
                                    $sql="SELECT count('1') FROM expenses WHERE date_spent BETWEEN '$first_day' AND '$last_day' AND cat_idno = '$cat_idno' AND account_link = '$account_link'";
                                    $result=mysqli_query($conn,$sql);
                                    $rowtotal=mysqli_fetch_array($result); 
                                    $count_personal = $rowtotal[0];
                                
                                    $sql="SELECT sum(amount) FROM expenses WHERE date_spent BETWEEN '$first_day' AND '$last_day' AND cat_idno = '$cat_idno' AND account_link = '$account_link'";
                                    $result=mysqli_query($conn,$sql);
                                    $month_personal=mysqli_fetch_array($result); 
                                    $m_personal = $month_personal[0];

                            ?>
                        <!-- end php code -->
                            
                        <p class="card-text fs-5 text-start fw-bold">
                            <div class="row" style="margin-top: -25px !important;">
                              <div class="col-8 text-start" style="margin-left: -10px;">
                                  <?php echo $p['category']; ?>
                              </div>
                              <div class="col text-end pb-1" style="">
                                <!-- php code -->
                                    <?php
                                        if($count_personal == 0){
                                            echo "$0.00";
                                        } else {
                                             echo "$$m_personal";
                                        }
                                    ?>
                                <!-- end php code -->
                              </div>
                              <hr>
                            </div>
                            <?php } ?>

                          </p>
                        </div>
                    </div>
                </div>

            <!-- end personal -->

            <!-- lifestyle -->
                
                <div class="row d-flex justify-content-center" style="background-color: rgb(245, 245, 245);">
                    <div class="card mt-3" style="border: none; width: 85%; background-color: rgb(255, 255, 255) !important; color: black;">
                        <div class="card-body" style="margin-bottom: -30px !important;">
                            <div>
                                <p class="card-title text-muted fw-bold float-start" style="margin-left: -10px;">Lifestyle</p>
                                <p class="card-title text-muted float-end">Spent</p>
                            </div>
                            
                        <!-- php code -->
                            <?php

                                $month_year = date('F Y');
                                $firstday = strtotime("first day of ". $month_year);
                                $first_day = date('Y-m-d', $firstday);
                                $month_year = date('F Y');
                                $lastday = strtotime("last day of ". $month_year);
                                $last_day = date('Y-m-d', $lastday);

                                $query ="SELECT * FROM categories where parent = 'lifestyle'";
                                $result = $conn->query($query);
                                if($result->num_rows> 0){
                                  $lifestyle= mysqli_fetch_all($result, MYSQLI_ASSOC);
                                }
                                foreach ($lifestyle as $l) {
                                
                                    $cat_idno = $l['idno'];
                                
                                    $sql="SELECT count('1') FROM expenses WHERE date_spent BETWEEN '$first_day' AND '$last_day' AND cat_idno = '$cat_idno' AND account_link = '$account_link'";
                                    $result=mysqli_query($conn,$sql);
                                    $rowtotal=mysqli_fetch_array($result); 
                                    $count_life = $rowtotal[0];
                                
                                    $sql="SELECT sum(amount) FROM expenses WHERE date_spent BETWEEN '$first_day' AND '$last_day' AND cat_idno = '$cat_idno' AND account_link = '$account_link'";
                                    $result=mysqli_query($conn,$sql);
                                    $month_life=mysqli_fetch_array($result); 
                                    $m_life = $month_life[0];

                            ?>
                        <!-- end php code -->
                            
                          
                            <p class="card-text fs-5 text-start fw-bold">
                            <div class="row" style="margin-top: -25px !important;">
                              <div class="col-8 text-start" style="margin-left: -10px;">
                                  <?php echo $l['category']; ?>
                              </div>
                              <div class="col text-end pb-1" style="">
                                <!-- php code -->
                                    <?php
                                        if($count_life == 0){
                                            echo "$0.00";
                                        } else {
                                             echo "$$m_life";
                                        }
                                    ?>
                                <!-- end php code -->
                              </div>
                              <hr>
                            </div>
                            <?php } ?>

                          </p>
                        </div>
                    </div>
                </div>

            <!-- end lifestyle -->

            <!-- health -->
                
                <div class="row d-flex justify-content-center" style="background-color: rgb(245, 245, 245);">
                    <div class="card mt-3" style="border: none; width: 85%; background-color: rgb(255, 255, 255) !important; color: black;">
                        <div class="card-body" style="margin-bottom: -30px !important;">
                            <div>
                                <p class="card-title text-muted fw-bold float-start" style="margin-left: -10px;">Health</p>
                                <p class="card-title text-muted float-end">Spent</p>
                            </div>
                            

                        <!-- php code -->
                            <?php

                                $month_year = date('F Y');
                                $firstday = strtotime("first day of ". $month_year);
                                $first_day = date('Y-m-d', $firstday);
                                $month_year = date('F Y');
                                $lastday = strtotime("last day of ". $month_year);
                                $last_day = date('Y-m-d', $lastday);

                                $query ="SELECT * FROM categories where parent = 'health'";
                                $result = $conn->query($query);
                                if($result->num_rows> 0){
                                  $health= mysqli_fetch_all($result, MYSQLI_ASSOC);
                                }
                                foreach ($health as $he) {
                                
                                    $cat_idno = $he['idno'];
                                
                                    $sql="SELECT count('1') FROM expenses WHERE date_spent BETWEEN '$first_day' AND '$last_day' AND cat_idno = '$cat_idno' AND account_link = '$account_link'";
                                    $result=mysqli_query($conn,$sql);
                                    $rowtotal=mysqli_fetch_array($result); 
                                    $count_health = $rowtotal[0];
                                
                                    $sql="SELECT sum(amount) FROM expenses WHERE date_spent BETWEEN '$first_day' AND '$last_day' AND cat_idno = '$cat_idno' AND account_link = '$account_link'";
                                    $result=mysqli_query($conn,$sql);
                                    $month_health=mysqli_fetch_array($result); 
                                    $m_health = $month_health[0];

                            ?>
                        <!-- end php code -->

                            
                        <p class="card-text fs-5 text-start fw-bold">
                            <div class="row" style="margin-top: -25px !important;">
                              <div class="col-8 text-start" style="margin-left: -10px;">
                                  <?php echo $he['category']; ?>
                              </div>
                              <div class="col text-end pb-1" style="">
                                <!-- php code -->
                                    <?php
                                        if($count_health == 0){
                                            echo "$0.00";
                                        } else {
                                             echo "$$m_health";
                                        }
                                    ?>
                                <!-- end php code -->
                              </div>
                              <hr>
                            </div>
                            <?php } ?>

                          </p>
                        </div>
                    </div>
                </div>

            <!-- end health -->

            <!-- insurance -->
                
                <div class="row d-flex justify-content-center" style="background-color: rgb(245, 245, 245);">
                    <div class="card mt-3" style="border: none; width: 85%; background-color: rgb(255, 255, 255) !important; color: black;">
                        <div class="card-body" style="margin-bottom: -30px !important;">
                            <div>
                                <p class="card-title text-muted fw-bold float-start" style="margin-left: -10px;">Insurance</p>
                                <p class="card-title text-muted float-end">Spent</p>
                            </div>


                        <!-- php code -->
                            <?php

                                $month_year = date('F Y');
                                $firstday = strtotime("first day of ". $month_year);
                                $first_day = date('Y-m-d', $firstday);
                                $month_year = date('F Y');
                                $lastday = strtotime("last day of ". $month_year);
                                $last_day = date('Y-m-d', $lastday);

                                $query ="SELECT * FROM categories where parent = 'insurance'";
                                $result = $conn->query($query);
                                if($result->num_rows> 0){
                                  $insurance= mysqli_fetch_all($result, MYSQLI_ASSOC);
                                }
                                foreach ($insurance as $in) {
                                
                                    $cat_idno = $in['idno'];
                                
                                    $sql="SELECT count('1') FROM expenses WHERE date_spent BETWEEN '$first_day' AND '$last_day' AND cat_idno = '$cat_idno' AND account_link = '$account_link'";
                                    $result=mysqli_query($conn,$sql);
                                    $rowtotal=mysqli_fetch_array($result); 
                                    $count_insure = $rowtotal[0];
                                
                                    $sql="SELECT sum(amount) FROM expenses WHERE date_spent BETWEEN '$first_day' AND '$last_day' AND cat_idno = '$cat_idno' AND account_link = '$account_link'";
                                    $result=mysqli_query($conn,$sql);
                                    $month_insure=mysqli_fetch_array($result); 
                                    $m_insure = $month_insure[0];

                            ?>
                        <!-- end php code -->

                            
                        <p class="card-text fs-5 text-start fw-bold">
                            <div class="row" style="margin-top: -25px !important;">
                              <div class="col-8 text-start" style="margin-left: -10px;">
                                  <?php echo $in['category']; ?>
                              </div>
                              <div class="col text-end pb-1" style="">
                                <!-- php code -->
                                    <?php
                                        if($count_insure == 0){
                                            echo "$0.00";
                                        } else {
                                             echo "$$m_insure";
                                        }
                                    ?>
                                <!-- end php code -->
                              </div>
                              <hr>
                            </div>
                            <?php } ?>

                          </p>
                        </div>
                    </div>
                </div>

            <!-- end insurance -->

            <!-- debt -->
                
                <div class="row d-flex justify-content-center" style="background-color: rgb(245, 245, 245);">
                    <div class="card mt-3 mb-3" style="border: none; width: 85%; background-color: rgb(255, 255, 255) !important; color: black;">
                        <div class="card-body" style="margin-bottom: -30px !important;">
                            <div>
                                <p class="card-title text-muted fw-bold float-start" style="margin-left: -10px;">Debt</p>
                                <p class="card-title text-muted float-end">Spent</p>
                            </div>
                            

                        <!-- php code -->
                            <?php

                                $month_year = date('F Y');
                                $firstday = strtotime("first day of ". $month_year);
                                $first_day = date('Y-m-d', $firstday);
                                $month_year = date('F Y');
                                $lastday = strtotime("last day of ". $month_year);
                                $last_day = date('Y-m-d', $lastday);

                                $query ="SELECT * FROM categories where parent = 'debt'";
                                $result = $conn->query($query);
                                if($result->num_rows> 0){
                                  $debt= mysqli_fetch_all($result, MYSQLI_ASSOC);
                                }
                                foreach ($debt as $d) {
                                
                                    $cat_idno = $d['idno'];
                                
                                    $sql="SELECT count('1') FROM expenses WHERE date_spent BETWEEN '$first_day' AND '$last_day' AND cat_idno = '$cat_idno' AND account_link = '$account_link'";
                                    $result=mysqli_query($conn,$sql);
                                    $rowtotal=mysqli_fetch_array($result); 
                                    $count_debt = $rowtotal[0];
                                
                                    $sql="SELECT sum(amount) FROM expenses WHERE date_spent BETWEEN '$first_day' AND '$last_day' AND cat_idno = '$cat_idno' AND account_link = '$account_link'";
                                    $result=mysqli_query($conn,$sql);
                                    $month_debt=mysqli_fetch_array($result); 
                                    $m_debt = $month_debt[0];

                            ?>
                        <!-- end php code -->

                            
                        <p class="card-text fs-5 text-start fw-bold">
                            <div class="row" style="margin-top: -25px !important;">
                              <div class="col-8 text-start" style="margin-left: -10px;">
                                  <?php echo $d['category']; ?>
                              </div>
                              <div class="col text-end pb-1" style="">
                                <!-- php code -->
                                    <?php
                                        if($count_debt == 0){
                                            echo "$0.00";
                                        } else {
                                             echo "$$m_debt";
                                        }
                                    ?>
                                <!-- end php code -->
                              </div>
                              <hr>
                            </div>
                            <?php } ?>

                          </p>
                            
                        </div>
                    </div>
                    <div style="margin-bottom: 100px !important;"></div>
                </div>

            <!-- end debt -->

        </section>

        <section class="" data-page="transactions">

            <!-- header -->
            <div class="header">
                    <h2 class="text-white" style="padding-left: 10px; padding-top: 65px;">
                        Transactions
                    </h2>
                    <div class="mt-3"></div>
                </div>
            <!-- end header -->

            <div class="row d-flex justify-content-center background" style="position: relative; z-index: -1; left: 0 !important; width: 100vw !important;background-color: rgb(245, 245, 245);">


            <!--  deleted -->
                <div class="row d-flex justify-content-center" style="margin-top: 165px; background-color: rgb(245, 245, 245);">
                    <div class="card" style="border: none; background-color: rgb(255, 255, 255) !important; color: black;">
                        <div class="card-body" style="margin-bottom: -10px;">
                            <div>
                                <i class="bi bi-trash me-3 text-primary" style="margin-left: -10px;></i><h4 class="card-title"">Deleted</h4>
                            </div>

                          <p class="card-text fs-5 text-start fw-bold">
                            
                          </p>
                        </div>
                    </div>
                </div>

            <!-- end deleted -->

                <!-- income -->
                
                <div class="row d-flex justify-content-center" style="background-color: rgb(245, 245, 245);">
                    <div class="card mt-3" style="border: none; background-color: rgb(255, 255, 255) !important; color: black;">
                        <div class="card-body" style="margin-bottom: -30px !important;">
                            <div>
                                <p class="card-title text-muted fw-bold float-start" style="margin-left: -10px;">Income</p>
                                <p class="card-title text-muted float-end">Received</p>
                            </div>

                        <!-- php code -->
                            <?php

                                $month_year = date('F Y');
                                $firstday = strtotime("first day of ". $month_year);
                                $first_day = date('Y-m-d', $firstday);
                                $month_year = date('F Y');
                                $lastday = strtotime("last day of ". $month_year);
                                $last_day = date('Y-m-d', $lastday);
                                
                                $query ="SELECT * FROM categories where parent = 'income'";
                                $result = $conn->query($query);
                                if($result->num_rows> 0){
                                  $income= mysqli_fetch_all($result, MYSQLI_ASSOC);
                                }
                                foreach ($income as $i) {

                                    $cat_idno = $i['idno'];

                                    $sql="SELECT count('1') FROM income WHERE date_gained BETWEEN '$first_day' AND '$last_day' AND cat_idno = '$cat_idno' AND account_link = '$account_link'";
                                    $result=mysqli_query($conn,$sql);
                                    $rowtotal=mysqli_fetch_array($result); 
                                    $count_income = $rowtotal[0];

                                    $sql="SELECT sum(amount) FROM income WHERE date_gained BETWEEN '$first_day' AND '$last_day' AND cat_idno = '$cat_idno' AND account_link = '$account_link'";
                                    $result=mysqli_query($conn,$sql);
                                    $month_income=mysqli_fetch_array($result); 
                                    $m_income = $month_income[0];
                                    
                            ?>
                        <!-- end php code -->

                          <p class="card-text fs-5 text-start fw-bold">
                            <div class="row" style="margin-top: -25px !important;">
                              <div class="col-8 text-start" style="margin-left: -10px;">
                                  <?php echo $i['category']; ?>
                              </div>
                              <div class="col text-end pb-1" style="">
                                <!-- php code -->
                                    <?php
                                        if($count_income == 0){
                                            echo "$0.00";
                                        } else {
                                             echo "$$m_income";
                                        }
                                    ?>
                                <!-- end php code -->
                              </div>
                              <hr>
                            </div>
                            <?php } ?>

                          </p>
                        </div>
                    </div>
                </div>

            <!-- end income -->
                

        
            </div>

            
            <div class="mt-5"></div>

            <!-- start -->
            <div class="trans d-flex flex-column justify-content-top" style="margin-top: 125px; position: absolute; background-color: pink !important;">

            
            <?php 
                $month_year = date('F Y');
                
            ?>
            <h2 class="text-white">
                <?php echo $month_year; ?> Expenses
            </h2>
            
            <p class="" style="color: rgb(242, 247, 253);">
                Compliled list of Expenses for <?php echo $month_year; ?>.
            </p>
            <hr style="color: rgb(242, 247, 253);">
            <div class="mt-4"></div>

            <?php 
                $month_year = date('F Y');
                $firstday = strtotime("first day of ". $month_year);
                $first_day = date('Y-m-d', $firstday);
                $month_year = date('F Y');
                $lastday = strtotime("last day of ". $month_year);
                $last_day = date('Y-m-d', $lastday);
                
                ?>
                <p class="text-white">
                    <?php 

                    $sql="SELECT count('1') FROM expenses WHERE date_spent BETWEEN '$first_day' AND '$last_day' AND account_link = '$account_link'";
                    $result=mysqli_query($conn,$sql);
                    $rowtotal=mysqli_fetch_array($result); 
                    echo "<b>Expense Records:</b> $rowtotal[0]";

                    ?>
                </p>


            <table class=" table table-bordered">
                <thead style="background-color: white;">
                  <tr>
                    <th class="text-center" scope="col-1">ID #</th>
                    <th scope="col">Description</th>
                    <th scope="col">Amount</th>
                    <th class="text-center" scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody class="table-group-divider" style="background-color: #f0f0f0;">

                <?php

                    $sql = "SELECT * FROM expenses WHERE date_spent BETWEEN '$first_day' AND '$last_day' AND account_link = '$account_link' ORDER BY date_spent DESC ";
                    $all = mysqli_query($conn, $sql);
                    if($all) {
                        while ($row = mysqli_fetch_assoc($all)) {
                          $exp_id         = $row['exp_id'];
                          $idno           = $row['idno'];
                          $description    = $row['description'];
                          $amount         = $row['amount'];
                          ?>
                  <tr>
                      <th class="text-center" scope="row" style="width: 15px;"><?php echo $idno; ?></th>
                      <td><?php echo $description; ?></td>
                      <td>$<?php echo $amount; ?></td>
                      <td style="width: 20px;">
                        <div class="d-flex justify-content-center">
                          <a style="text-decoration: none; background: none; color: inherit; border: none; padding: 0; font: inherit; cursor: pointer; outline: inherit;" href="view/index.php?id=<?php echo $exp_id; ?>"><span class="badge text-bg-success">View</span></a>
                          &nbsp;
                          <form method="post" action="">
                            <input type="hidden" name="exp_id" value="<?php echo $exp_id; ?>" />
                            <button onclick="return confirm('Be Careful, Can\'t be undone! \r\nOK to delete?')" style="background: none; color: inherit; border: none; padding: 0; font: inherit; cursor: pointer; outline: inherit;" type="submit" name="delete"><span class="badge text-bg-danger">Delete</span></button>
                          </form>
                        </div>
                      </td>
                      <?php }}?>
                </tbody>
                <thead class="table-group-divider" style="background-color: white;">
                  <tr>
                    <th class="text-center" scope="col">ID #</th>
                    <th scope="col">Description</th>
                    <th scope="col">Amount</th>
                    <th class="text-center" scope="col">Actions</th>
                  </tr>
                </thead>

                
            </table>


            </div>
            <!-- end -->
            

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
                    <b><?php echo $firstname; ?> <?php echo $lastname; ?></b>
                </h4>
                <p class="text-center" style="margin-top: -10px !important; font-size: 10px !important; color: rgb(242, 247, 253) !important;">
                    <b>User ID: </b><?php echo $user_idno; ?>
                </p>
            </div>
            <div class="mt-5"></div>
            <div class="d-flex justify-content-center">
                <ul class="list-group list-group-flush w-75">
                    <?php if($role == 1) { ?>
                        <a style="text-decoration: none;" href="users/"><li class="list-group-item text-center" style="background-color: rgb(242, 247, 253) !important; border-radius: 15px 15px 0 0;">Users</li></a>
                        <a style="text-decoration: none;" href="expenses/"><li class="list-group-item text-center" style="background-color: rgb(242, 247, 253) !important;">Expenses</li></a>
                    <?php } else { ?>
                        <a style="text-decoration: none;" href="expenses/"><li class="list-group-item text-center" style="background-color: rgb(242, 247, 253) !important; border-radius: 15px 15px 0 0;">Expenses</li></a>
                    <?php } ?>
                    <a style="text-decoration: none;" href="income/"><li class="list-group-item text-center" style="background-color: rgb(242, 247, 253) !important;">Income</li></a>
                    <a style="text-decoration: none;" href="account/index.php?id=<?php echo $user_id; ?>"><li class="list-group-item text-center" style="background-color: rgb(242, 247, 253) !important;">Edit Account</li></a>
                    <a style="text-decoration: none;" href="logout.php"><li class="list-group-item text-center" style="background-color: rgb(242, 247, 253) !important;border-radius: 0 0 15px 15px;">Logout</li></a>
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
                        <button class="navbar-link" data-nav-link>Transactions</button>
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
<!-- custom scripts -->
</body>
</html>