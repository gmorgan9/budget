<?php
require_once "database/connection.php";
// require_once "path.php";
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- APPLE HOME SCREEN META TAGS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <!-- <link rel="apple-touch-icon" href="assets/images/gm.png"> -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable = no">
    <title>Budget</title>

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    <!-- custom styles -->
    <link rel="stylesheet" href="style.css">

    
    <?php if(!isset($_SESSION['username'])) {?>
        <style>
            .login {
                display: block;
            }
            .container {
                display: none;
            }
        </style>
    <?php } else { ?>
        <style>
            .login {
                display: none;
            }
            .container {
                display: block;
            }
        </style>
    <?php } ?>


</head>
<body style="background-color: rgb(78, 78, 78);">

    <div class="login">

        <div class="mt-4"></div>
            <h2 class="text-white">
                Login
            </h2>
            <div class="d-flex justify-content-center align-items-lg-center">

                <form action="" class="" method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label text-white">Username </label>
                        <input type="text" class="form-control" id="username">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label text-white">Password</label>
                        <input type="password" class="form-control" id="password">
                    </div>
                    <button type="submit" name="exp" class="btn btn-secondary">Submit</button>
                </form>

    </div>
    
    
    <div class="container">


        <section class="active" data-page="home">
            <div class="mt-4"></div>
            <h2 class="text-white">
                Welcome, Garrett Morgan!
            </h2>
            <p class="date text-muted">
                Wednesday, January  4th, 2023
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
                          <h5 class="card-title text-center">Monthly</h5>
                          <p class="card-text fs-1 text-center">1</p>
                          <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                        </div>
                    </div>

                    <div class="card" style="width: 40%; background-color: rgb(100, 100, 100) !important; color: white;">
                        <div class="card-body">
                            <h5 class="card-title text-center">Yearly</h5>
                            <p class="card-text fs-1 text-center">2</p>
                          <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
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
                            <h5 class="card-title text-center">Yearly</h5>
                            <p class="card-text fs-1 text-center">3</p>
                          <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                        </div>
                    </div>

                    <div class="card" style="width: 40%; background-color: rgb(100, 100, 100) !important; color: white;">
                        <div class="card-body">
                            <h5 class="card-title text-center">Monthly</h5>
                            <p class="card-text fs-1 text-center">4</p>
                          <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
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
                            <h5 class="card-title text-center">Yearly</h5>
                            <p class="card-text fs-1 text-center">5</p>
                          <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                        </div>
                    </div>

                    <div class="card" style="width: 40%; background-color: rgb(100, 100, 100) !important; color: white;">
                        <div class="card-body">
                            <h5 class="card-title text-center">Monthly</h5>
                            <p class="card-text fs-1 text-center">6</p>
                          <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
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
                <div class="mb-3">
                    <label for="desc" class="form-label text-white">Description &nbsp;<span style="font-size: 10px; color: rgb(169, 169, 169);">e.g "McDonalds"</span></label>
                    <input type="text" class="form-control" id="desc">
                </div>
                <div class="mb-3">
                    <label for="amount" class="form-label text-white">Amount &nbsp;<span style="font-size: 10px; color: rgb(169, 169, 169);">e.g 130.40</span></label>
                    <input type="number" class="form-control" id="amount">
                </div>
                <div class="mb-3">
                    <label for="date" class="form-label text-white">Date Spent</label>
                    <input type="date" class="form-control" id="amount">
                </div>
                <div class="mb-3">
                    <label for="comment" class="form-label text-white">Comments</label>
                    <textarea class="form-control" id="comment"></textarea>
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
                <div class="mb-3">
                    <label for="desc" class="form-label text-white">Description &nbsp;<span style="font-size: 10px; color: rgb(169, 169, 169);">e.g "Paycheck"</span></label>
                    <input type="text" class="form-control" id="desc">
                </div>
                <div class="mb-3">
                    <label for="amount" class="form-label text-white">Amount &nbsp;<span style="font-size: 10px; color: rgb(169, 169, 169);">e.g 130.40</span></label>
                    <input type="number" class="form-control" id="amount">
                </div>
                <div class="mb-3">
                    <label for="date" class="form-label text-white">Date Gained</label>
                    <input type="date" class="form-control" id="amount">
                </div>
                <div class="mb-3">
                    <label for="comment" class="form-label text-white">Comments</label>
                    <textarea class="form-control" id="comment"></textarea>
                </div>
                <button type="submit" name="exp" class="btn btn-secondary">Submit</button>
            </form>
        </section>

        <section class="" data-page="settings">
            <div class="mt-4"></div>
            <h2 class="text-white">
                Settings
            </h2>
            <hr>
            <div class="d-flex justify-content-center">
                <span class="profile-img"></span>
            </div>
            <div class="mt-3"></div>
            <div class="name">
                <h4 class="text-center text-white">
                    Garrett Morgan
                </h4>
            </div>
            <div class="mt-5"></div>
            <div class="d-flex justify-content-center">
                <ul class="list-group list-group-flush w-75">
                    <a style="text-decoration: none;" href="expenses/"><li class="list-group-item text-white text-center" style="background-color: rgb(100, 100, 100) !important;">Expenses</li></a>
                    <a style="text-decoration: none;" href="income/"><li class="list-group-item text-white text-center" style="background-color: rgb(100, 100, 100) !important;">Income</li></a>
                    <a style="text-decoration: none;" href="account/"><li class="list-group-item text-white text-center" style="background-color: rgb(100, 100, 100) !important;">Edit Account</li></a>
                    <a style="text-decoration: none;" href="#"><li class="list-group-item text-white text-center" style="background-color: rgb(100, 100, 100) !important;">Logout</li></a>
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

    <!-- custom script -->
    <script src="script.js"></script>
    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>