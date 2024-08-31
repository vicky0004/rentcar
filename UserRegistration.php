<?php
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
    <title>User Registration</title>
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

<body>
    <?php include("./Layouts/navbar.php"); ?>
    <div class="bardbox d-flex justify-content-center" style="height:90vh;">
        <div class="card my-auto shadow login-card">
            <div class="card-header text-center  text-white" style="background-color: #7091e6;">
                <h2>User Registration</h2>
            </div>
            <div class="card-body">
                <form id="login-form" action="./Backend/register.php" method="post">
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" id="name" class="form-control" name="name" required />
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email5" class="form-control" name="email" required />
                    </div>

                    <div class="form-group">
                        <label for="mobile">Mobile</label>
                        <input type="number" id="mobile" class="form-control" name="mobile" required />
                    </div>
                    <div class="form-group">
                        <label for="password">password</label>
                        <input type="password" id="password" class="form-control" name="password" required />
                    </div>
                    <br>
                    <button type="submit" class="btn w-100 page-btn" 
                        >Register</button>
                </form>
            </div>
            <div class="card-footer text-end">
                
            </div>
        </div>
    </div>
</body>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>

</html>