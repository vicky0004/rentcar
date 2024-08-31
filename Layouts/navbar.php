<nav class="navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="./">
                <img src="./Assets/img/logo2.png" alt="Logo" width="30"
                    height="24" class="d-inline-block align-text-top">
                Car Rental
            </a>
            <div class="d-flex" role="search">
                <!-- <input class="form-control me-2" id="search" type="search" placeholder="Search" aria-label="Search"> -->
                <?php 
                    if (isset($_SESSION['loged_in']) &&  $_SESSION['user_type']=="user") {
                ?>
                <a href="./mybooking.php" class="btn btn-success mx-2">My Bookings</a>
                <?php
                    }
                ?>
                <?php 
                    if (isset($_SESSION['loged_in'])) {
                ?>
                <a href="./Logout.php" class="btn btn-danger">Logout</a>
                
                <?php
                    }else{
                        ?>
                        <a href="./AgencyLogin.php" class="btn btn-light mx-2">Agency</a>
                        <a href="./UserLogin.php" class="btn btn-light">Login</a>
                    <?php } ?>
            </div>
        </div>
    </nav>
