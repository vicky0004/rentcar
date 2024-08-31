<?php
if($_SERVER["REQUEST_METHOD"] == "GET"){
    header("Location: /");
    exit();
}
include("conn.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];

    if (empty($name) || empty($email) || empty($mobile) || empty($password)) {
        session_start();
        $_SESSION['msg']="All fields are required!";
        header("Location: ../UserRegistration.php");
        exit();
    }

  
    $name = $conn->real_escape_string($name);
    $email = $conn->real_escape_string($email);
    $mobile = $conn->real_escape_string($mobile);
    $password = $conn->real_escape_string($password);

    
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        session_start();
        $_SESSION['msg'] = "User Already registered";
        header("Location: ../UserRegistration.php");
        exit();
    }

    $sql = "INSERT INTO users (user_name,user_type, email, mobile, password) VALUES ('$name','1', '$email', '$mobile', '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../UserLogin.php");
        exit();
    } else {
        session_start();
        $_SESSION['msg']="Error: " . $sql . "<br>" . $conn->error;
        header("Location: ../UserRegistration.php");
        exit();
    }

    $conn->close();
}
?>
