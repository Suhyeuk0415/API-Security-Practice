<?php
session_start();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $conn = new mysqli("localhost", "webuser", "1234", "bank_db");
    $conn->set_charset("utf8mb4");
    
    $id = $_POST['emp_id'];
    $pw = $_POST['password'];
    $stmt = $conn->prepare("SELECT emp_name FROM employees WHERE emp_id=? AND password=?");
    $stmt->bind_param("ss", $id, $pw);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($row = $result->fetch_assoc()){
        $_SESSION['emp_id'] = $id;
        $_SESSION['emp_name'] = $row['emp_name'];
        header("Location: dashboard.php");
        exit;
    } else {
        echo "<script>alert('Login Failed');</script>";
    }
}
?>
<meta charset="utf-8">
<h2>[Bank Intranet] Employee Login</h2>
<form method="POST">
    Emp ID: <input type="text" name="emp_id"><br>
    Password: <input type="password" name="password"><br>
    <input type="submit" value="Login">
</form>
