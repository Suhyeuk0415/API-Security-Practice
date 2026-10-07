<?php
session_start();
// 1. Authentication Check (Validates if logged in, but lacks Authorization check)
if(!isset($_SESSION['emp_id'])) die(json_encode(["error" => "Access Denied"]));

header('Content-Type: application/json; charset=utf-8');
$conn = new mysqli("localhost", "webuser", "1234", "bank_db");
$conn->set_charset("utf8mb4");

if (isset($_GET['customer_id'])) {
    $customer_id = $_GET['customer_id'];
    
    // ⚠️ IDOR Vulnerability: No check to ensure the logged-in employee is authorized to view this specific customer.
    $stmt = $conn->prepare("SELECT * FROM customers WHERE customer_id = ?");
    $stmt->bind_param("i", $customer_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        echo json_encode($result->fetch_assoc(), JSON_UNESCAPED_UNICODE);
    } else {
        echo json_encode(["error" => "Customer not found"]);
    }
}
?>
