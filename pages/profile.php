<?php
session_start();
if ($_SESSION['logged'] != 'true') {
    header('location:../pages/login.php');
}

?>
<html lang="en">

<head>
    <link rel="shortcut icon" href="../images/icon.ico" type="image/x-icon" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>udharo</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/main.css">
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jQuery.js"></script>

</head>

<body>
    <!-- navbar starts here -->
    <div class="nav navbar navbar-expand-lg bg-dark navbar-dark py-3 justify-content-between">
        <div class="container">
            <a href="./profile.php" class="navbar-brand"><img src="../images/logo.png" width="100%" height="100%"
                    alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#searchBar">
                <i class="bi bi-search"></i>
            </button>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navlink">
                <i class="bi bi-grid-3x3-gap"></i>
            </button>
            <div class="container collapse navbar-collapse justify-content-center" id="navlink">
                <div class="d-lg-flex">
                    <div class="container">
                        <ul class="navbar-nav lead">
                            <li class="nav-item mx-3">
                                <a href="./profile.php" class="nav-link active">Profile</a>
                            </li>
                            <li class="nav-item mx-3">
                                <a href="./addCredits.php" class="nav-link">Add Credits</a>
                            </li>
                            <li class="nav-item mx-3">
                                <a href="./addAccounts.php" class="nav-link">Add Account</a>
                            </li>
                            <ul class="navbar-nav" style="flex-direction: row;">
                                <li class="nav-item mx-3 ">
                                    <a href="../include/logOut.php?q=logOut" class="btn btn-outline-warning">Log Out</a>
                                </li>
                                <li class="nav-item mx-3 text-danger">

                                    <a href="./myAccount.php" class="text-light text-decoration-none">
                                        <i class="bi bi-person-circle h3" onMouseOver="this.style.color='#0d6efd'"
                                            onMouseOut="this.style.color='#FFF'"></i>
                                    </a>
                                </li>
                            </ul>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- navbar ends here -->


    <!-- Search starts here -->
    <nav class="navbar sticky-top navbar-warning bg-warning">
        <div class="container">
            <div class="row w-100">
                <div class="col-md-6 collapse navbar-collapse justify-content-center d-lg-flex" id="searchBar">
                    <form method="POST" action="#">
                        <div class="input-group">
                            <input type="text" name="client" class="form-control-sm" placeholder="Search transaction">
                            <div class="input-group-append">
                                <button class="btn-sm btn-outline-dark" name="search" type="submit">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6 text-center">
                    <div class="row w-100 text-center">
                        <div class="col">
                            <p class="text-center h6" id="sum"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <div class="container-flex p-1 bg-dark"></div>



    <!-- List credits -->

    <section id="packages">
        <div class="album py-3">
            <div class="container">
                <div class="row">

                    <?php
                    include_once('../include/dbConn.php');

                    if (isset($_POST['search'])) {
                        $client = $_POST['client'];
                        $sql = "SELECT A.name,A.address, A.contact, B.type, B.status,  B.balance, B.bDate, B.bid, A.aid, B.comments FROM users AS U, accounts AS A, balance AS B WHERE U.uid=A.uid AND A.aid=B.aid AND A.name LIKE '%{$client}%' AND U.uid={$_SESSION['uid']};";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                if ($row['status'] == 'show') {
                                    if ($row['type'] == 'credit') {
                                        echo '
                                        <div class="col-lg-4 col-md-6">
                                            <div class="card mb-4 shadow rounded">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <h5 class="card-title">' . $row['name'] . '</h5>
                                                        </div>
                                                        <div class="col-6 d-flex">
                                                            <span onclick="details(' . $row['aid'] . ',' . $row['bid'] . ',&#34' . $row['type'] . '&#34)" class="bi bi-plus-lg btn mx-3 btn-sm btn-outline-warning">Total</span>
                                                            <i onclick="remove(' . $row['bid'] . ')" class="bi bi-x btn btn-outline-danger "></i>
                                                        </div>
                                                    </div>
                                                    <h6 class="card-subtitle mb-2 text-muted border-bottom">' . $row['contact'] . ', ' . $row['address'] . '</h6>
                                                    <p class="card-text"> Rs:' . $row['balance'] . '/- &nbsp; to Receive</p>
                                                    <p class="card-text text-muted">' . $row['comments'] . '</p>
                                                    <div class="d-flex justify-content-between row align-items-center">
                                                        <div class="btn-group col-6">
                                                            <span onclick="deduct(' . $row['balance'] . ',' . $row['bid'] . ')" class="btn btn btn-outline-danger">Deduct</span>
                                                        </div>
                                                        <div class="col-6">
                                                            <small class="text-muted">' . $row['bDate'] . '</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
                                    } else {
                                        echo '
                                        <div class="col-lg-4 col-md-6">
                                            <div class="card mb-4 shadow rounded">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <h5 class="card-title">' . $row['name'] . '</h5>
                                                        </div>
                                                        <div class="col-6 d-flex">
                                                            <span onclick="details(' . $row['aid'] . ',' . $row['bid'] . ',&#34' . $row['type'] . '&#34)" class="bi bi-plus-lg btn mx-3 btn-sm btn-outline-dark">Total</span>
                                                            <i onclick="remove(' . $row['bid'] . ')" class="bi bi-x btn btn-outline-dark "></i>
                                                        </div>
                                                    </div>
                                                    <h6 class="card-subtitle mb-2 text-muted border-bottom">' . $row['contact'] . ', ' . $row['address'] . '</h6>
                                                    <p class="card-text"> Rs:' . $row['balance'] . '/- &nbsp; to Give</p>
                                                    <p class="card-text text-muted">' . $row['comments'] . '</p>
                                                    <div class="d-flex justify-content-between row align-items-center">
                                                        <div class="btn-group col-6">
                                                            <span onclick="deduct(' . $row['balance'] . ',' . $row['bid'] . ')" class="btn btn btn-outline-dark">Pay</span>
                                                        </div>
                                                        <div class="col-6">
                                                            <small class="text-muted">' . $row['bDate'] . '</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
                                    }
                                }
                            }
                        } else {
                            echo "No transaction to display";
                        }
                    } else {
                        $sql = "SELECT A.name,A.address, A.contact, B.status, B.type, B.balance, B.bDate, B.bid, A.aid, B.comments FROM users AS U, accounts AS A, balance AS B WHERE U.uid=A.uid AND A.aid=B.aid AND U.uid={$_SESSION['uid']};";
                        $result = mysqli_query($conn, $sql);
                        // header('location: ../pages/addCredits.php?empty_options');
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                if ($row['status'] == 'show') {
                                    if ($row['type'] == 'credit') {
                                        echo '
                                        <div class="col-lg-4 col-md-6">
                                            <div class="card mb-4 shadow rounded">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <h5 class="card-title">' . $row['name'] . '</h5>
                                                        </div>
                                                        <div class="col-6 d-flex">
                                                            <span onclick="details(' . $row['aid'] . ',' . $row['bid'] . ',&#34' . $row['type'] . '&#34)" class="bi bi-plus-lg btn mx-3 btn-sm btn-outline-warning">Total</span>
                                                            <i onclick="remove(' . $row['bid'] . ')" class="bi bi-x btn btn-outline-danger "></i>
                                                        </div>
                                                    </div>
                                                    <h6 class="card-subtitle mb-2 text-muted border-bottom">' . $row['contact'] . ', ' . $row['address'] . '</h6>
                                                    <p class="card-text"> Rs:' . $row['balance'] . '/- &nbsp; to Receive</p>
                                                    <p class="card-text text-muted">' . $row['comments'] . '</p>
                                                    <div class="d-flex justify-content-between row align-items-center">
                                                        <div class="btn-group col-6">
                                                            <span onclick="deduct(' . $row['balance'] . ',' . $row['bid'] . ')" class="btn btn btn-outline-danger">Deduct</span>
                                                        </div>
                                                        <div class="col-6">
                                                            <small class="text-muted">' . $row['bDate'] . '</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
                                    } else {
                                        echo '
                                        <div class="col-lg-4 col-md-6">
                                            <div class="card mb-4 shadow rounded">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <h5 class="card-title">' . $row['name'] . '</h5>
                                                        </div>
                                                        <div class="col-6 d-flex">
                                                            <span onclick="details(' . $row['aid'] . ',' . $row['bid'] . ',&#34' . $row['type'] . '&#34)" class="bi bi-plus-lg btn mx-3 btn-sm btn-outline-dark">Total</span>
                                                            <i onclick="remove(' . $row['bid'] . ')" class="bi bi-x btn btn-outline-dark "></i>
                                                        </div>
                                                    </div>
                                                    <h6 class="card-subtitle mb-2 text-muted border-bottom">' . $row['contact'] . ', ' . $row['address'] . '</h6>
                                                    <p class="card-text"> Rs:' . $row['balance'] . '/- &nbsp; to Give</p>
                                                    <p class="card-text text-muted">' . $row['comments'] . '</p>
                                                    <div class="d-flex justify-content-between row align-items-center">
                                                        <div class="btn-group col-6">
                                                            <span onclick="deduct(' . $row['balance'] . ',' . $row['bid'] . ')" class="btn btn btn-outline-dark">Pay</span>
                                                        </div>
                                                        <div class="col-6">
                                                            <small class="text-muted">' . $row['bDate'] . '</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
                                    }
                                }
                            }
                        } else {
                            echo "<span class='p-5'>No transaction to display<span>";
                        }
                    }

                    ?>
                </div>
            </div>
        </div>
    </section>

    <!--  -->


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


    <script type="text/javascript">
        details = (aid, bid, type) => {
            $.ajax({
                type: 'get',
                url: '../include/details.php?q=' + aid + '&r=' + bid + '&s=' + type,
                success: (data) => {
                    $("#sum").css('color', 'green');
                    $("#sum").text(data);

                }
            })
        }

        deduct = (balance, bid) => {
            let value = prompt("Amount: ", balance);
            let amount = parseInt(value);
            if (Number.isInteger(amount)) {
                if (amount > balance) {
                    $("#sum").css('color', 'red');
                    $("#sum").text('Cannot pay more than the credited amount!');
                } else {

                    let newAmount = balance - amount;
                    $.ajax({
                        type: 'get',
                        url: '../include/deduct.php?q=' + newAmount + '&r=' + bid + '&s=' + amount,
                        success: () => {
                            location.reload();
                        }
                    })

                }
            } else {
                $("#sum").css('color', 'red');
                $("#sum").text('Only ineger value supported');
            }

        }

        remove = (bid) => {
            $warn = "On deletion balance amount will be 0. Cannot be reverted. Want to proceed forward?";
            if (confirm($warn) == true) {
                window.location.href = "../include/deleteCredit.php?q=" + bid;
            }
        }
    </script>
</body>

</html>