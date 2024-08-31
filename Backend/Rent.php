<?php
if($_SERVER["REQUEST_METHOD"] == "GET"){
    header("Location: /");
    exit();
}

include("conn.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    session_start();
    if (isset($_SESSION['loged_in']) && $_SESSION['user_type']=="user") {
    
    }else{
      header("Location: UserLogin.php");
      exit();
    }
    
    function sanitize_input($data) {
        return htmlspecialchars(strip_tags(trim($data)));
    }

    $start_date = sanitize_input($_POST['start_date']);
    $days = intval($_POST['days']);
    $carId = $_POST['car_id'];
    $ownerId = $_POST['owner_id'];
    $userId = $_POST['user_id'];


    $sql = "INSERT INTO booking (start_date, days,car_id, owner_id, user_id ) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sisss", $start_date, $days,$carId, $ownerId,$userId);

    if ($stmt->execute()) {
        echo '<div class="alert alert-success">Car rental booked successfully!</div>';
    } else {
        echo '<div class="alert alert-danger">Error: ' . $stmt->error . '</div>';
    }

    $stmt->close();
    $conn->close();
} else {
    echo '<div class="alert alert-danger">Invalid request method.</div>';
}
?>
