<?php 
include "koneksi.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn ->prepare("SELECT id, username, password FROM login WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();

    $result = $stmt->get_result();

    if($result->num_rows === 1){

        $user = $result->fetch_assoc();
       
        print_r($user);

        $_SESSION['id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['current_login'] = true;
        header("Location: index.php");
        exit;
    } else{
        header("Location: login .php?message=". urlencode("Password salah GOBLOK!!"));
    }

    $stmt->close();

}

?>
