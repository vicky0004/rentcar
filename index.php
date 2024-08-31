
<?php
    include("./Backend/conn.php");
    session_start();
    if (isset($_SESSION['msg'])) {
        $message = $_SESSION['msg'];
        echo "<script>alert('$message');</script>";
    }
    unset($_SESSION['msg']);
    $sql = "SELECT * FROM cars";
    $cars = $conn->query($sql);

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" 
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mukta:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="./Assets/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="./Assets/css/style.css">

    <title>Car Rental</title>
</head>

<body>
    <?php include("./Layouts/navbar.php"); ?>

    <div class="container d-flex flex-wrap justify-content-evenly mt-4">
        <?php 
        
        if ($cars->num_rows > 0) { 
            while($row = $cars->fetch_assoc()) {
                $image_path = "./uploads/".$row["image"];
                ?>
        <div class="card m-2 item-card" id="<?php echo "item".$row["model"] ?>" style="width: 16rem;">
            <img src="<?php echo $image_path?>" class="card-img-top" alt="..." >
            <div class="card-body">
                <h5 class="card-title"><?php echo $row["model"]; ?></h5>
                <ul class="list-unstyled mx-3">
                    <li><i class="fas fa-car"></i><b> Car Number:</b> <?php echo $row["number"]; ?></li>
                    <li><i class="fas fa-users"></i><b> Seating : </b> <?php echo $row["seating"]; ?></li>
                    <li><i class="fas fa-indian-rupee-sign"></i><b> Rent: </b><?php echo $row["rent"]; ?>rs/day</li>
                </ul>
            </div>
            <div class="form-group mx-1">
                <label for="start_date">Start Date</label>
                <input type="date" name="start_date" class="form-control" id="<?php echo 'start_date_'.$row["id"]; ?>"/>
            </div>
            <div class="row mt-2">
                <div class="col-md-7">
                        <select class="form-select" name="days" aria-label="Default select example" id="<?php echo 'days_'.$row["id"]; ?>">
                            <option selected value="">Select Days</option>
                            <option value="1">1 day</option>
                            <option value="2">2 day</option>
                            <option value="3">3 day</option>
                            <option value="4">4 day</option>
                            <option value="5">5 day</option>
                        </select>
                </div>
                <div class="col-md-5">
                        <p id="<?php echo 'text_'.$row['id']; ?>" class="text-success" style="display:none;">Booked</p>
                        <?php 
                            if (isset($_SESSION['loged_in']) && $_SESSION['user_type']=='user') {
                        ?>
                        
                            <button class="btn page-btn" id="<?php echo 'rentCarButton_'.$row["id"]; ?>" onclick= "rentCar('<?php echo $row['id']; ?>', '<?php echo $row['owner_id']; ?>', '<?php echo $_SESSION['user_id']; ?>')">Rent Car</button>
                        <?php
                        }else{
                            ?>
                            <a href="./UserLogin.php" class="btn page-btn" >Rent Car</a>

                        <?php } ?>
                </div>
            </div>
        </div>
        <?php }} ?>
    </div>
    <?php include("./Layouts/footer.php"); ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <script>
        function rentCar(carId, ownerId, userId) {
            const start_date = document.getElementById("start_date_"+carId).value;
            const days = document.getElementById("days_"+carId).value;
            const buttonId = "rentCarButton_"+carId;
            const textId = "text_"+carId;
            if (!start_date) {
                alert("Please select a start date.");
                document.getElementById("start_date_" + carId).focus();
                return; // Exit the function if start_date is not set
            }

            // Check if days is set
            if (!days || days === "") {
                alert("Please select the number of days.");
                document.getElementById("days_" + carId).focus();
                return; // Exit the function if days is not set
            }
            $.ajax({
                    url: 'Backend/Rent.php',
                    type: 'POST',
                    data: {
                        start_date: start_date,
                        days: days,
                        car_id : carId,
                        owner_id:ownerId,
                        user_id:userId
                    },
                    success: function(response) {
                        $('#response').html(response);
                        if (response.includes("Car rental booked successfully!")) {
                            $('#' + buttonId).hide();
                            $('#start_date_' + carId).val("");
                            $('#days_'+carId).val("");
                            $('#' + textId).show();
                            
                        }
                    },
                    error: function(xhr, status, error) {
                        $('#response').html('<div class="alert alert-danger">An error occurred: ' + error + '</div>');
                    }
            });
        }
    </script>
    <script>
        document.getElementById('search').addEventListener('keyup', function() {
            let filter = this.value.toUpperCase();
            let divs = document.querySelectorAll('div[id^="item"]');

            divs.forEach(div => {
                if (div.textContent.toUpperCase().indexOf(filter) > -1) {
                    div.classList.remove('hidden');
                } else {
                    div.classList.add('hidden');
                }
            });
        });
    </script>
</body>

</html>