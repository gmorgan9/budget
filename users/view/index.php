<?php
require_once "../../database/connection.php";
require_once "../../path.php";
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
        $password = md5($_POST['password']);
        $cpassword = md5($_POST['cpassword']);
        $isadmin = $_POST['isadmin'];
        $loggedin = $_POST['loggedin'];
        
        $select = " SELECT * FROM users WHERE username = '$username' && password = '$password' ";
        
        $result = mysqli_query($conn, $select);
        
        if(mysqli_num_rows($result) > 0){
        
           $row = mysqli_fetch_array($result);
           $sql = "UPDATE users SET loggedin='1' WHERE username='$username'";
           if (mysqli_query($conn, $sql)) {
              echo "Record updated successfully";
            } else {
              echo "Error updating record: " . mysqli_error($conn);
            }
            $_SESSION['firstname']        = $row['firstname'];
            $_SESSION['user_id']          = $row['user_id'];
            $_SESSION['loggedin']         = $row['loggedin'];
            $_SESSION['user_idno']        = $row['idno'];
            $_SESSION['lastname']         = $row['lastname'];
            $_SESSION['username']         = $row['username'];
            $_SESSION['email']            = $row['email'];
            $_SESSION['pass']             = $row['password'];
            $_SESSION['cpass']            = $row['cpassword'];
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

// update user
    if(isset($_POST['update_user'])){
        $idno  = rand(10000, 99999);
        $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
        $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $account_link = mysqli_real_escape_string($conn, $_POST['account_link']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = md5($_POST['password']);
    
    
        date_default_timezone_set('America/Denver');
        $date = date('F d, Y, g:i a', time());
    
        if(isset($_POST['password'])) {
        $insert = "UPDATE users SET firstname = '$firstname', lastname = '$lastname', username = '$username', account_link = '$account_link', email = '$email', password = '$password' WHERE user_id = '".$_POST['user_id']."'";
        mysqli_query($conn, $insert);
        header("location: /");
        } else {
        $insert = "UPDATE users SET firstname = '$firstname', lastname = '$lastname', username = '$username', account_link = '$account_link', email = '$email' WHERE user_id = '".$_POST['user_id']."'";
        mysqli_query($conn, $insert);
        header("location: /");
        }
    
      };
// end update income
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- APPLE HOME SCREEN META TAGS -->
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
        <!-- <link rel="apple-touch-icon" href="assets/images/gm.png"> -->
    <!-- END APPLE TAGS -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable = no">
    <title>Budget</title>

    <!-- bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <!-- end bootstrap -->

    <!-- custom styles -->
        <link rel="stylesheet" href="../../style.css">
    <!-- end custom styles -->

</head>
<body style="background-color: rgb(78, 78, 78);">


    <?php 
    // $id = $_SESSION['user_id'];
    // $select2 = " SELECT * FROM users WHERE user_id = '$id' ";
    // $result2 = mysqli_query($conn, $select2);
    // if (mysqli_num_rows($result2) > 0) {
    //     while($row2 = mysqli_fetch_assoc($result2)) {
    //         $account_link    = $row2['account_link'];
    // }}


    $user_id = $_GET['id'];
    $select = " SELECT * FROM users WHERE user_id = '$user_id'";
    $result = mysqli_query($conn, $select);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $firstname    = $row['firstname'];
            $lastname     = $row['lastname'];
            $email         = $row['email'];
            $username    = $row['username'];
            $card_idno      = $row['card_idno'];
            $comments       = $row['comments'];
            $account_link   = $row['account_link'];
            $password       = $row['password'];
    }}

    ?>

    <!-- end php code -->


    <div class="container">

        <!-- <section class="" data-page="income"> -->
            <div class="mt-4"></div>
            <h2 class="text-white">
                View User
            </h2>
            <p class="text-muted">
                Enter an income to keep track of.
            </p>
            <hr>
            <div class="mt-4"></div>

            <form action="" class="" method="POST">
                <input type="hidden" class="form-control" name="user_id" value="<?php echo $user_id;?>">
                <div class="row">
                    <div class="mb-3 w-50">
                        <label for="fn" class="form-label text-white">First Name</label>
                        <input type="text" name="firstname" class="form-control" id="fn" value="<?php echo $firstname; ?>">
                    </div>
                    <div class="mb-3 w-50">
                        <label for="ln" class="form-label text-white">Last Name</label>
                        <input type="text" name="lastname" class="form-control" id="ln" value="<?php echo $lastname; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 w-50">
                        <label for="username" class="form-label text-white">Username</label>
                        <input type="text" name="username" class="form-control" id="username" value="<?php echo $username; ?>">
                    </div>
                    <div class="mb-3 w-50">
                        <label for="account_link" class="form-label text-white">Account Link</label>
                        <input type="text" name="account_link" class="form-control" id="account_link" value="<?php echo $account_link; ?>">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label text-white">Email</label>
                    <input type="text" name="email" class="form-control" id="email" value="<?php echo $email; ?>">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label text-white">Password</label>
                    <input type="password" name="password" class="form-control" id="password">
                </div>
                <button type="submit" name="update_user" class="btn btn-secondary">Update</button>
            </form>
        </section>



    </div>

    <!-- custom script -->
    <script src="script.js"></script>
    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>