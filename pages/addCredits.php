<?php
session_start();
if ($_SESSION['logged'] != 'true') {
    header('location:../pages/login.php');
}

include_once("../include/headerPages.php");
?>

<body>
    <!-- navbar starts here -->
    <div class="nav navbar navbar-expand-lg bg-dark navbar-dark py-3">
        <div class="container">
            <a href="./profile.php" class="navbar-brand"><span class="text-warning h1 logo">sApati</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navlink">
                <i class="bi bi-grid-3x3-gap"></i>
            </button>
            <div class="container collapse navbar-collapse justify-content-center" id="navlink">
                <div class="d-lg-flex">
                    <div class="container">
                        <ul class="navbar-nav lead">
                            <li class="nav-item mx-3">
                                <a href="./profile.php" class="nav-link">Profile</a>
                            </li>
                            <li class="nav-item mx-3">
                                <a href="./addCredits.php" class="nav-link active">Add Credits</a>
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


    <!-- friends starts here -->
    <section class="p-5">
        <div class="container">
            <form method="post" action="../include/addCredits.php">
                <?php
                if (isset($_REQUEST['credit_created_sucessfully'])) {
                    echo '<span class="lead text-success">Credit added</span>';
                }
                if (isset($_REQUEST['error_adding_credit'])) {
                    echo '<span class="lead text-danger">Failed to add credit</span>';
                }
                ?><br>
                <label for="name" class="sr-only">Name</label>
                <select name="aid" class="form-control mb-3" id="name">
                    <?php
                    session_start();
                    $data = '1';
                    include_once('../include/dbConn.php');
                    $sql = "SELECT accounts.name, accounts.aid, accounts.address FROM accounts, users WHERE users.uid=accounts.uid AND users.uid = '{$_SESSION['uid']}'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        $data = '0';
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "
                        <option value='" . $row['aid'] . "'>{$row['name']}, {$row['address']}</options>
                        ";
                        }
                    }

                    ?>
                </select>
                <?php
                if ($data == '1') {
                    echo '<label for="balance" class="text-danger sr-only">No user account created : <a href="./addAccounts.php" class="text-decoration-none">Add Account</a></label><br>';
                }
                ?>
                <br>
                <label for="balance" class="sr-only">Amount</label>
                <input type="number" id="balance" class="form-control mb-3" required name="balance" placeholder="Amount credited"><br>
                <label for="date" class="sr-only">Date</label>
                <input type="date" id="date" class="form-control mb-3" name="date" required placeholder="Date"><br>
                <label for="comments" class="sr-only">Comments</label>
                <textarea type="text" id="comments" class="form-control mb-3" name="comments" placeholder="Description"></textarea><br>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-outline-warning btn-block mb-4" name="submit">Add Credits</button>
                </div>
            </form>

        </div>
    </section>




    <!-- friends ends here -->

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