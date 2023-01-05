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

// update income
    if(isset($_POST['update_inc'])){
        $idno  = rand(10000, 99999);
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
    
    
        date_default_timezone_set('America/Denver');
        $date = date('F d, Y, g:i a', time());
    
        $insert = "UPDATE income SET description = '$description', amount = '$amount', comments = '$comments', date_gained = '$date_gained', cat_idno = '$cat_idno', card_idno = '$card_idno' WHERE inc_id = '".$_POST['inc_id']."'";
        mysqli_query($conn, $insert);
        header("location: /");
    
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
    $id = $_SESSION['user_id'];
    $select2 = " SELECT * FROM users WHERE user_id = '$id' ";
    $result2 = mysqli_query($conn, $select2);
    if (mysqli_num_rows($result2) > 0) {
        while($row2 = mysqli_fetch_assoc($result2)) {
            $account_link    = $row2['account_link'];
    }}


    $inc_id = $_GET['id'];
    $select = " SELECT * FROM income WHERE inc_id = '$inc_id' AND account_link = '$account_link'";
    $result = mysqli_query($conn, $select);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $description    = $row['description'];
            $amount         = $row['amount'];
            $date_gained    = $row['date_gained'];
            $cat_idno       = $row['cat_idno'];
            $card_idno      = $row['card_idno'];
            $comments       = $row['comments'];
            // $account_link   = $row['account_link'];
    }}

    ?>

    <!-- end php code -->


    <div class="container">

        <!-- <section class="" data-page="income"> -->
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
                <input type="hidden" class="form-control" name="inc_id" value="<?php echo $inc_id;?>">
                <!-- <input type="hidden" class="form-control" name="person_fn" value="<?php //echo $firstname;?>"> -->
                <!-- <input type="hidden" class="form-control" name="person_ln" value="<?php //echo $lastname;?>"> -->
                <!-- <input type="hidden" class="form-control" name="person_idno" value="<?php //echo $user_idno;?>"> -->
                <input type="hidden" class="form-control" name="account_link" value="<?php echo $account_link;?>">
                <div class="mb-3">
                    <label for="desc" class="form-label text-white">Description &nbsp;<span style="font-size: 10px; color: rgb(169, 169, 169);">e.g "McDonalds"</span></label>
                    <input type="text" name="description" class="form-control" id="desc" value="<?php echo $description ?>">
                </div>
                <label for="amount" class="form-label text-white">Amount &nbsp;<span style="font-size: 10px; color: rgb(169, 169, 169);">e.g 130.40</span></label>
                <div class="mb-3 input-group">
                    <span class="input-group-text" id="basic-addon1">$</span>
                    <input type="text" name="amount" class="form-control" id="amount" value="<?php echo $amount ?>">
                </div>
                <div class="mb-3">
                    <label for="date" class="form-label text-white">Date Gained</label>
                    <input type="date" name="date_gained" class="form-control" id="date" value="<?php echo $date_gained ?>">
                </div>
                <div class="row">
                <div class="mb-3 w-50">
                    <?php 
                        $grab = " SELECT * FROM categories WHERE idno = '$cat_idno' ";
                        $put = mysqli_query($conn, $grab);
                        if (mysqli_num_rows($put) > 0) {
                            while($cap = mysqli_fetch_assoc($put)) {
                                $cat_name    = $cap['category'];
                        }}

                    ?>

                    <label for="category" class="form-label text-white">Category</label>
                    <select name="cat_idno" id="category" class="form-control">
                        <option value="<?php echo $cat_idno; ?>"><?php echo $cat_name; ?></option>
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

                    <?php 
                        $select4 = " SELECT * FROM cards WHERE idno = '$card_idno'";
                        $result4 = mysqli_query($conn, $select4);
                        if (mysqli_num_rows($result4) > 0) {
                            while($row3 = mysqli_fetch_assoc($result4)) {
                                $card_name           = $row3['name'];
                        }}

                    ?>
                    <label for="date" class="form-label text-white">Card</label>
                    <select name="card_idno" id="card" class="form-control">
                        <option value="<?php echo $card_idno; ?>"><?php echo $card_name; ?></option>
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
                    <textarea class="form-control" name="comments" id="comment"><?php echo $comments; ?></textarea>
                </div>
                <button type="submit" name="update_inc" class="btn btn-secondary">Update</button>
            </form>
        </section>



    </div>

    <!-- custom script -->
    <script src="script.js"></script>
    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>