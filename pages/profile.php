<?php
session_start();
if ($_SESSION['logged'] != 'true') {
    header('location:../pages/login.php');
}

include_once("../include/headerPages.php");
?>


<body>
    <!-- navbar starts here -->
    <div class="nav navbar navbar-expand-lg bg-dark navbar-dark py-3 justify-content-between">
        <div class="container">
            <a href="./profile.php" class="navbar-brand"><span class="text-warning h1 logo">sApati</span></a>
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
                            <li class="nav-item mx-3 ">
                                <a href="../include/logOut.php?q=logOut" class="btn btn-outline-warning">Log Out</a>
                            </li>
                            <li class="nav-item mx-3 text-danger">

                                <a href="./myAccount.php" class="text-light text-decoration-none">
                                    <i class="bi bi-person-circle h3" onMouseOver="this.style.color='#0d6efd'" onMouseOut="this.style.color='#FFF'"></i>
                                </a>
                            </li>

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
                            <input type="text" name="client" class="form-control" placeholder="Search transaction">
                            <div class="input-group-append">
                                <button class="btn btn-outline-dark" name="search" type="submit">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6 text-center">
                    <div class="row text-center">
                        <div class="col">
                            <p class="text-center text-danger h6" id="sum"></p>
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
                        $sql = "SELECT A.name,A.address, A.contact, B.balance, B.bDate, B.bid, A.aid, B.comments FROM users AS U, accounts AS A, balance AS B WHERE U.uid=A.uid AND A.aid=B.aid AND U.uid={$_SESSION['uid']} AND A.name LIKE '%{$client}%';";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo  '
                            <div class="col-lg-4 col-md-6">
                            <div class="card mb-4 shadow rounded">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <h5 class="card-title">' . $row['name'] . '</h5>
                                        </div>
                                        <div class="col-6 d-flex">
                                            <span onclick="details(' . $row['aid'] . ',' . $row['bid'] . ')" class="bi bi-plus-lg btn mx-3 btn-sm btn-outline-warning">Total</span>
                                            <i onclick="remove(' . $row['bid'] . ')" class="bi bi-x btn btn-outline-danger "></i>
                                        </div>
                                    </div>
                                    <h6 class="card-subtitle mb-2 text-muted border-bottom">' . $row['contact'] . ', ' . $row['address'] . '</h6>
                                    <p class="card-text">' . $row['balance'] . '</p>
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
                            }
                        } else {
                            echo "No Credits";
                        }
                    } else {
                        $sql = "SELECT A.name,A.address, A.contact, B.balance, B.bDate, B.bid, A.aid, B.comments FROM users AS U, accounts AS A, balance AS B WHERE U.uid=A.uid AND A.aid=B.aid AND U.uid={$_SESSION['uid']};";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '
                    <div class="col-lg-4 col-md-6">
                        <div class="card mb-4 shadow rounded">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="card-title">' . $row['name'] . '</h5>
                                    </div>
                                    <div class="col-6 d-flex">
                                        <span onclick="details(' . $row['aid'] . ',' . $row['bid'] . ')" class="bi bi-plus-lg btn mx-3 btn-sm btn-outline-warning">Total</span>
                                        <i onclick="remove(' . $row['bid'] . ')" class="bi bi-x btn btn-outline-danger "></i>
                                    </div>
                                </div>
                                <h6 class="card-subtitle mb-2 text-muted border-bottom">' . $row['contact'] . ', ' . $row['address'] . '</h6>
                                <p class="card-text">' . $row['balance'] . '</p>
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
                            }
                        } else {
                            echo "No Credits";
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
        details = (aid, bid) => {
            $.ajax({
                type: 'get',
                url: '../include/details.php?q=' + aid + '&r=' + bid,
                success: (data) => {
                    $("#sum").text(data);

                }
            })
        }

        deduct = (balance, bid) => {
            let amount = prompt("Amount client paid", balance);
            if (amount > balance) {
                alert('Cannot pay more than the credited amount!');

            } else {
                let newAmount = balance - amount;
                $.ajax({
                    type: 'get',
                    url: '../include/deduct.php?q=' + newAmount + '&r=' + bid,
                    success: () => {
                        location.reload();
                    }
                })
            }

        }

        remove = (bid) => {
            $warn = "Do you want to delete the transaction?";
            if (confirm($warn) == true) {
                window.location.href = "../include/deleteCredit.php?q=" + bid;
            }
        }
    </script>
</body>

</html>