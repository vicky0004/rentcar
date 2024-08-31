

<?php
    include("./Backend/conn.php");
    session_start();
    if (isset($_SESSION['msg'])) {
        $message = $_SESSION['msg'];
        echo "<script>alert('$message');</script>";
    }
    unset($_SESSION['msg']);
?>
<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="shortcut icon" href="./Assets/img/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="./Assets/css/style.css">
    <title>Agency Login</title>
</head>

<style>
    .login-card {
        width: 25%;
    }


    @media screen and (max-width: 768px) {
        .login-card {
            width: 75%;
        }
    }
</style>

<body >
    <?php include("./Layouts/navbar.php"); ?>
    <div class="bardbox d-flex justify-content-center" style=" height:90vh;">
        <div class="card my-auto shadow login-card">
            <div class="card-header text-center  text-white" style="background-color: #7091e6;">
                <h2>Agency Login</h2>
            </div>
            <div class="card-body">
                <form id="login-form" action="./Backend/Alogin.php" method="post">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email5" class="form-control" name="email" required />
                    </div>
                    <div class="form-group">
                        <label for="password">password</label>
                        <input type="password" id="password5" class="form-control" name="password" required />
                    </div>
                    <br>
                    <button type="submit" class="btn w-100 text-white page-btn" >Login</button>
                        <a href="#" style="text-decoration: none;"><small>Forget password</small></a>
                </form>
            </div>
            <div class="card-footer text-end">
            <a href="./AgencyRegistration.php">
                <button  class="btn btn-sm text-white page-btn"
                        >Register</button></a>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    </body>

</html>