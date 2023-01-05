<?php
require_once "../database/connection.php";
require_once "../path.php";
session_start();
?>
<?php 

// delete income
    if (isset($_POST['delete'])) {
        $delete = "DELETE FROM income WHERE inc_id = '".$_POST['inc_id']."'";
        $terUpdateResult = mysqli_query($conn, $delete);
        header('location: /');
    }
// end delete income

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
    <div class="container">

            <div class="mt-4"></div>
            <div class="header position-sticky">
            <h2 class="text-white">
                Income
            </h2>
            <p class="text-muted">
                Enter an income to keep track of.
            </p>
            <hr>
            </div>
            <div class="mt-4"></div>

            <table id="dtBasicExample" class=" table table-bordered">
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
                    $sql = "SELECT * FROM income";
                    $all = mysqli_query($conn, $sql);
                    if($all) {
                        while ($row = mysqli_fetch_assoc($all)) {
                          $inc_id         = $row['inc_id'];
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
                          <a style="text-decoration: none; background: none; color: inherit; border: none; padding: 0; font: inherit; cursor: pointer; outline: inherit;" href="view/index.php?id=<?php echo $inc_id; ?>"><span class="badge text-bg-success">View</span></a>
                          &nbsp;
                          <form method="post" action="">
                            <input type="hidden" name="inc_id" value="<?php echo $inc_id; ?>" />
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
            <nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item"><a class="page-link" href="#">Next</a></li>
  </ul>
</nav>

    </div> 

    <script type="text/javascript">
		$(document).ready(function () {
  $('#dtBasicExample').DataTable();
  $('.dataTables_length').addClass('bs-select');
});
		</script>


    <!-- custom script -->
    <script src="script.js"></script>
    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>