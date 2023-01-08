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
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable = no">
    <title>Budget</title>

    <!-- bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <!-- end bootstrap -->

    <!-- custom styles -->
        <link rel="stylesheet" href="style.css?v=1.25">
        <style>
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
                width: 85%;
                margin-left: auto;
                margin-right: auto;
                border-radius: 15px;
                margin-top: 25%;
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
    <body style="background-color: ">

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
            <div class="header" style="background-color: #3e4881;">

            <!-- <div class="mt-4"></div> -->
            <h2 class="text-white">
            <?php 
                date_default_timezone_set('America/Denver');
                $month_budget = date('F Y');
                echo $month_budget;
                ?>
                <a style="text-decoration: none; color: white;" href="#"><i class="float-end bi bi-plus"></i></a>
            </h2>
            <hr>

            </div>
            
            <div class="mt-3"></div>

            <!-- top -->
                <div class="ms-1 row justify-content-center">
                    <div class="card" style="margin-right: 20px; width: 40%; background-color: rgb(255, 255, 255) !important; color: black;">
                        <div class="card-body">
                          <i class="fs-1 bi bi-coin" style="margin-left: -20px; color: rgb(210,210,210)"></i>
                          <p class="card-title text-start text-muted fw-bold" style="margin-left: -20px; width: 50%; line-height: .95;">Spent So Far</p>
                          <p class="card-text fs-5 text-start fw-bold" style="margin-left: -20px;">
                          $14
                          </p>
                        </div>
                    </div>
                    <div class="card" style="margin-right: 20px; width: 40%; background-color: rgb(255, 255, 255) !important; color: black;">
                        <div class="card-body">
                          <i class="fs-1 bi bi-cash-coin" style="margin-left: -20px; color: rgb(210,210,210)"></i>
                          <p class="card-title text-start text-muted fw-bold" style="margin-left: -20px; width: 70%; line-height: .95;">Received So Far</p>
                          <p class="card-text fs-5 text-start fw-bold" style="margin-left: -20px;">
                          $25
                          </p>
                        </div>
                    </div>
                </div>
            <!-- end top -->

            <!-- income -->

                <div class="mt-3"></div>
                <div class="ms-1 row justify-content-center">
                    <div class="card" style="margin-right: 20px; width: 85%; background-color: rgb(255, 255, 255) !important; color: black;">
                        <div class="card-body">

                            <div class="row">
                                <div class="col">
                                    <p class="card-title text-start text-muted fw-bold" style="margin-left: -20px;line-height: .95; margin-top: -10px;">Income</p>
                                    <hr>
                                </div>
                                <div class="col">
                                    <p class="card-title text-muted fw-bold text-end" style="line-height: .95; margin-top: -10px;">Received</p>
                                    <hr>
                                </div>
                            </div>



                          <!-- <i class="fs-1 bi bi-coin" style="margin-left: -20px; color: rgb(210,210,210)"></i> -->
                          <p class="card-text fs-5 text-start fw-bold" style="margin-left: -20px;">
                          $14
                          </p>
                        </div>
                    </div>
                </div>

            <!-- end income -->

                <div class="mt-3"></div>
                <div class="row justify-content-center">
                    <h3 class="text-white">
                        Expenses
                    </h3>
                    <div class="card" style="margin-right: 20px; width: 40%; background-color: rgb(255, 255, 255) !important; color: black;">
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

                    <div class="card" style="width: 40%; background-color: rgb(255, 255, 255) !important; color: black;">
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
                    <div class="card" style="margin-right: 20px; width: 40%; background-color: rgb(255, 255, 255) !important; color: black;">
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

                    <div class="card" style="width: 40%; background-color: rgb(255, 255, 255) !important; color: black;">
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

            


        </section>

        <section class="" data-page="expenses">
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
<!-- custom scripts -->
</body>
</html>