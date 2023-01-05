<?php
require_once "../database/connection.php";
require_once "../path.php";
session_start();
?>
<?php 

// delete expenses
    if (isset($_POST['delete'])) {
        $delete = "DELETE FROM expenses WHERE exp_id = '".$_POST['exp_id']."'";
        $terUpdateResult = mysqli_query($conn, $delete);
        header('location: /');
    }
// end delete expenses

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- apple tags -->
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
        <!-- <link rel="apple-touch-icon" href="assets/images/gm.png"> -->
    <!-- end apple tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable = no">
    <title>Budget</title>

    <!-- bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <!-- end bootstrap -->

    <!-- custom styles -->
        <link rel="stylesheet" href="../style.css">
    <!-- end custome styles -->

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

?>


    <div class="container">

            <div class="mt-4"></div>
            <?php 
                $month_year = date('F Y');
                
                ?>
            <h2 class="text-white">
                <?php echo $month_year; ?> Expenses
            </h2>
            
            <p class="text-muted">
                Compliled list of Expenses for <?php echo $month_year; ?>.
            </p>
            <hr>
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




    <!-- custom script -->
    <script src="script.js"></script>
    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>