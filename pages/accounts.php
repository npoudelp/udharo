<?php
session_start();
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sApati</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/main.css">
    <script src="../js/bootstrap.min.js"></script>

</head>

<body>
    <!-- navbar starts here -->
    <div class="nav navbar navbar-expand-lg bg-dark navbar-dark py-3">
        <div class="container">
            <a href="../index.php" class="navbar-brand"><span class="text-warning h1 logo">sApati</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navlink">
                <i class="bi bi-grid-3x3-gap"></i>
            </button>
            <div class="container collapse navbar-collapse justify-content-center" id="navlink">
                <div class="d-lg-flex">
                    <div class="container">
                        <ul class="navbar-nav lead">
                            <li class="nav-item">
                                <a href="./profile.php" class="nav-link">Profile</a>
                            </li>
                            <li class="nav-item">
                                <a href="./accounts.php" class="nav-link active">Account</a>
                            </li>
                        </ul>
                    </div>
                    <div class="container">
                        <li class="nav-item">
                            <a href="../include/logOut.php?q=logOut" class="btn btn-outline-warning">Log Out</a>
                        </li>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- navbar ends here -->

    <!-- display board starts here -->
    <section class="bg-dark text-light p-lg-3 p-5 text-center">
        <div class="container">
            <div class="d-sm-flex">
                <div class=" align-items-center">
                    <p class="h1"><span class="text-warning">Your transection will show how capable you are.
                        </span>
                    <p class="lead my-4">
                        <a href="./addAccounts.php" class="btn btn-lg btn-outline-warning btn-block">Add Transection</a>
                    </p>
                    <br>

                </div>
                <img class="img-fluid w-25 d-none d-sm-block" src="../images/profileShowcase.png" alt="">
            </div>
        </div>
    </section>
    <!-- display board ends here -->


    <!-- account starts here -->
    <section class="p-3 text-warning" style="height: 100vh;">
        <div class="container text-center">
            <label for="userName" class="lead">
                Hello <?php echo $_SESSION["userName"]; ?>
            </label>
        </div>
    </section>
    <!-- account ends here -->




    <!-- misc section -->
    <section class="p-1 bg-warning">
        <div class="container text-dark text-center">
            <span class="h1 lead fw-bold text-dark">
                <?php $year = date("F");
                $month = date("jS");
                $day = date("Y");
                echo $year . " " . $month . " " . $day;
                ?>
                <?php $year = date("l");
                echo $year;
                ?>
        </div>
    </section>
    <!-- misc ends -->

    <!-- footer starts here -->
    <?php
    include_once('../include/footer.php');
    ?>
</body>

</html>