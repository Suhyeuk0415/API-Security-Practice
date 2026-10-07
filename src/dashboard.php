<?php
session_start();
if(!isset($_SESSION['emp_id'])) { header("Location: index.php"); exit; }
?>
<meta charset="utf-8">
<h2>Welcome, <?php echo $_SESSION['emp_name']; ?></h2>
<p>Click the buttons below to view your assigned customers' financial details.</p>
<button onclick="lookup(1001)">View Customer 1001</button>
<button onclick="lookup(1002)">View Customer 1002</button>

<div id="result" style="margin-top:20px; padding:10px; border:1px solid black; background-color:#f9f9f9;">
    Query results will be displayed here.
</div>

<script>
function lookup(id) {
    fetch('api_lookup.php?customer_id=' + id)
    .then(res => res.text())
    .then(data => document.getElementById('result').innerText = data);
}
</script>
