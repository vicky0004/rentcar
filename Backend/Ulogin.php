<?php
if($_SERVER["REQUEST_METHOD"] == "GET"){
    header("Location: ../UserLogin.php");
    exit();
}

include("conn.php");
session_start();
session_unset(); 
session_destroy(); 


function sanitize_input($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = sanitize_input($_POST['email']);
    $password = sanitize_input($_POST['password']);

    
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt_result= $stmt->get_result();

    if ($stmt_result->num_rows > 0) {
        $data= $stmt_result->fetch_assoc();
        if (password_verify($password, $data['password'])) {
            session_start();
            $_SESSION['loged_in'] = true;
            $_SESSION['user_type'] = "user";
            $_SESSION['user_id'] = $data['id'];
            $_SESSION['user_name'] =$data["user_name"];
            $_SESSION['email'] = $data['email'];
            $_SESSION['mobile'] = $data['mobile'];  
            
            header("Location: ../index.php");
            exit();
        } else {
            session_start();
            $_SESSION['msg']="Invalid Password!";
            header("Location: ../UserLogin.php");
            exit();
        }
    } else {
        session_start();
        $_SESSION['msg']="No account found with that email!";
        header("Location: ../UserLogin.php");
        exit();
    }

    $stmt->close();
}

$conn->close();
?>
