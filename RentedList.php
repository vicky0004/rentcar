<?php
    include("./Backend/conn.php");
    session_start();

    if (isset($_SESSION['loged_in']) && $_SESSION['user_type']=="agency") {
    
    }else{
      header("Location: AgencyLogin.php");
      exit();
    }
    $agency_id=$_SESSION['agency_id'];
    $agency_name =$_SESSION['agency_name'];
    $owner_name=$_SESSION['owner_name'];
    $address=$_SESSION['address'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Agency profile</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="shortcut icon" href="./Assets/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="./Assets/css/style.css">
</head>

<body>
<?php include("./Layouts/navbar.php"); ?>
  <section>
    <div class="container py-5">
      <div class="row">
        <div class="col-lg-4">
          <div class="card mb-4">
            <div class="card-body text-center">
              <img src="./Assets//img/car.jpg" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
              <h5 class="my-3"><?php echo $agency_name ?></h5>
              <p class="text-muted mb-1">Owner: <?php echo $owner_name ?></p>
              <p class="text-muted mb-4"><?php echo $address ?></p>
              <div class="d-flex justify-content-center mb-2">
                <a href="./CarList.php" type="button" class="btn btn-outline-primary ms-1">My cars</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-8">
          
          <div class="card mb-4">
          <div class="card-header">
            <h2>Rented Cars</h2>
          </div>
            <div class="card-body">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">User name</th>
                    <th scope="col">Vehicle number</th>
                    <th scope="col">Start Date</th>
                    <th scope="col">Booking Days</th>
                  </tr>
                </thead>
                <tbody>

                <?php 
                  $sql = "SELECT booking.*,cars.number,users.user_name as us_name FROM booking LEFT JOIN cars ON booking.car_id = cars.id LEFT JOIN users ON booking.user_id = users.id WHERE booking.owner_id = ".$agency_id;
                  $result = $conn->query($sql);
                  $sl=1;

                  if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                ?>
                  <tr>
                    <th scope="row"><?php echo $sl++ ?></th>
                    <td><?php echo $row["us_name"]; ?></td>
                    <td><?php echo $row["number"]; ?></td>
                    <td><?php echo $row["start_date"]; ?></td>
                    <td><?php echo $row["days"]; ?></td>
                  </tr>
                <?php }} ?>
                </tbody>
              </table>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>