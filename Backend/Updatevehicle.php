<?php
if($_SERVER["REQUEST_METHOD"] == "GET"){
    header("Location: ../CarList.php");
    exit();
}

include("conn.php");
    session_start();

    if (isset($_SESSION['loged_in']) && $_SESSION['user_type']=="agency") {
      
    }else{
        header("Location: AgencyLogin.php");
        exit();
    }


function sanitize_input($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

// Function to handle file upload and rename it to the vehicle number
function upload_image($file, $vehicle_number) {
    $target_dir = "../uploads/";
    $imageFileType = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
    $target_file = $vehicle_number . "." . $imageFileType;
    $target_path = $target_dir.$target_file;
    $check = getimagesize($file["tmp_name"]);

    if($check !== false) {
        if (move_uploaded_file($file["tmp_name"], $target_path)) {
            return $target_file;
        } else {
            return false;
        }
    } else {
        return false;
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST['id']);
    $model = sanitize_input($_POST['model']);
    $number = sanitize_input($_POST['number']);
    $seating = sanitize_input($_POST['seating']);
    $rent = sanitize_input($_POST['rent']);

    
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $image = upload_image($_FILES["image"], $number);
        if ($image === false) {
            session_start();
            $_SESSION['msg']="Sorry, there was an error uploading your file.";
            header("Location: ../CarList.php");
            exit();
        }

        $stmt = $conn->prepare("UPDATE cars SET image = ?, model = ?, number = ?, seating = ?, rent = ? WHERE id = ?");
        $stmt->bind_param("ssssii", $image, $model, $number, $seating, $rent, $id);
    } else {
        $stmt = $conn->prepare("UPDATE cars SET model = ?, number = ?, seating = ?, rent = ? WHERE id = ?");
        $stmt->bind_param("sssii", $model, $number, $seating, $rent, $id);
    }

    if ($stmt->execute()) {
        echo "Vehicle updated successfully!";
        header("Location: ../CarList.php");
    } else {
        session_start();
        $_SESSION['msg']="Error: " . $stmt->error;
        header("Location: ../CarList.php");
        exit();
    }

    $stmt->close();
}

$conn->close();
?>
