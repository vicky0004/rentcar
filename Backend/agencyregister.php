<?php

include("conn.php");
if($_SERVER["REQUEST_METHOD"] == "GET"){
    header("Location: /");
    exit();
}

function sanitize_input($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $agencyName = sanitize_input($_POST['Agencyname']);
    $ownerName = sanitize_input($_POST['Ownername']);
    $address = sanitize_input($_POST['address']);
    $gstNo = sanitize_input($_POST['gstno']);
    $email = sanitize_input($_POST['email']);
    $mobile = sanitize_input($_POST['mobile']);
    $password = password_hash(sanitize_input($_POST['password']), PASSWORD_DEFAULT); // Hash the password


    $stmt = $conn->prepare("SELECT * FROM agencies WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        session_start();
        $_SESSION['msg'] = "Agency Already registered";
        header("Location: ../AgencyRegistration.php");
        exit();
    }

    $stmt = $conn->prepare("INSERT INTO agencies (agency_name, owner_name, address, gstin, email, mobile, password) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $agencyName, $ownerName, $address, $gstNo, $email, $mobile, $password);

    if ($stmt->execute()) {
        echo "Registration successful!";
        header("Location: ../RentedList.php");
        exit();
    } else {
        session_start();
        $_SESSION['msg']="Error: " . $stmt->error;
        header("Location: ../AgencyRegistration.php");
        exit();
    }

    $stmt->close();
}

$conn->close();
?>
