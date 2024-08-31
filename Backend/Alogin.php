<?php
if($_SERVER["REQUEST_METHOD"] == "GET"){
    header("Location: /");
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

    $stmt=$conn->prepare("select * from agencies where email= ?");
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $stmt_result= $stmt->get_result();
    
    if ($stmt_result->num_rows > 0) {
        $data= $stmt_result->fetch_assoc();
        if (password_verify($password, $data['password'])) {
            session_start();
            $_SESSION['loged_in'] = true;
            $_SESSION['user_type'] = "agency";
            $_SESSION['agency_id'] = $data['id'];
            $_SESSION['agency_name'] = $data['agency_name'];
            $_SESSION['owner_name'] = $data['owner_name'];
            $_SESSION['address'] = $data['address'];
            $_SESSION['email'] = $email;
            
            header("Location: ../RentedList.php");
            exit();
        } else {
            session_start();
            $_SESSION['msg']= "Invalid password!";
            header("Location: ../AgencyLogin.php");
            exit();
        }
    } else {
        session_start();
        $_SESSION['msg']="No account found with that email!";
        header("Location: ../AgencyLogin.php");
        exit();
    }

    $stmt->close();
}

$conn->close();
?>
