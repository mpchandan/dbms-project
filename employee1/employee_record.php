<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Employee Management System</title>
<link rel="stylesheet" href="style.css">
<style>
    .error { color: red; }
</style>
</head>
<body>

<div class="form-container">
<h1>EMPLOYEE MANAGEMENT SYSTEM</h1>

<!-- Form for adding/editing students -->
<form id="employeeForm" action="process.php" method="POST">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required><br><br>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br><br>
    <label for="age">Age:</label>
    <input type="number" id="age" name="age" required><br><br>
    <label for="contact_number">Contact Number:</label>
    <input type="text" id="contact_number" name="contact_number"><br><br>
    <label for="place_of_birth">Place of Birth:</label>
    <input type="text" id="place_of_birth" name="place_of_birth"><br><br>
    <label for="date_of_birth">Date of Birth:</label>
    <input type="date" id="date_of_birth" name="date_of_birth"><br><br>
    <label for="name">Qualification:</label>
    <input type="text" id="qual" name="qual" required><br><br>
    <label for="name">Employee ID:</label>
    <input type="number" id="id" name="id" required><br><br>
    <label for="name">Department:</label>
    <input type="text" id="dept" name="dept" required><br><br>
    <label for="name">Designation:</label>
    <input type="text" id="des" name="des" required><br><br>
    <input type="hidden" id="employeeId" name="employeetId">
    <input type="submit" name="submit" value="Add Employee" id="submitButton">
    <input type="button" value="Clear Form" onclick="clearForm()">
</form>

<hr>

<!-- PHP code for database operations -->
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "employee_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Display all students
// Display all students
$sql = "SELECT * FROM employee";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<div class='employee-list'>";
    echo "<h2>Employee List:</h2>";
    echo "<table class='employee-table'>";
    echo "<tr><th>Name</th><th>Email</th><th>Age</th><th>Contact Number</th><th>Place of Birth</th><th>Date of Birth</th><th>Qualification</th><th>Employee ID</th><th>Department</th><th>Designation</th><th>Actions</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["age"] . " years old</td>";
        echo "<td>" . $row["contact_number"] . "</td>";
        echo "<td>" . $row["place_of_birth"] . "</td>";
        echo "<td>" . $row["date_of_birth"] . "</td>";
		echo "<td>" . $row["qualification"] . "</td>";
		echo "<td>" . $row["employee_id"] . "</td>";
		echo "<td>" . $row["department"] . "</td>";
		echo "<td>" . $row["designation"] . "</td>";
        echo "<td><a href='process.php?delete=" . $row["employee_id"] . "' class='delete-btn'>Delete</a></td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "</div>";
} else {
    echo "<div class='no-results'>No Employee found</div>";
}

$conn->close();
?>
</div>
<script>
    function clearForm() {
        document.getElementById("employeeForm").reset();
    }
</script>

</body>
</html>
