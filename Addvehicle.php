<?php
    include("./Backend/conn.php");
    session_start();

    if (isset($_SESSION['loged_in']) && $_SESSION['user_type']=="agency") {
    
    }else{
      header("Location: AgencyLogin.php");
      exit();
    }
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
    <title>add new vehicle</title>
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
                <h2>Add vehicle</h2>
            </div>
            <div class="card-body">
                <form id="login-form" action="./Backend/addcar.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="image">Vehicle Image</label>
                        <input type="file" class="form-control" id="image" name="image"/>
                    </div>
                    <div class="form-group">
                        <label for="model">Vehicle Model Name</label>
                        <input type="text" id="model" class="form-control" name="model" required />
                    </div>
                    <div class="form-group">
                        <label for="number">Vehicle Number</label>
                        <input type="text" id="number" class="form-control" name="number" required />
                    </div>
                    
                    <div class="form-group">
                        <label for="seating">Seating Capacity</label>
                        <input type="number" id="seating" class="form-control" name="seating" required />
                    </div>
                    <div class="form-group">
                        <label for="rent">Rent per day</label>
                        <input type="number" id="rent" class="form-control" name="rent" required />
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                        <button type="button" class="btn w-100 btn-danger" onclick="history.back();">Cancle</button>
                            </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn w-100 btn-success" >Add</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer text-end">
                
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    </body>

</html>