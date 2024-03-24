<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "employee_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission for adding new employee
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $age = $_POST["age"];
    $contact_number = $_POST["contact_number"];
    $place_of_birth = $_POST["place_of_birth"];
    $date_of_birth = $_POST["date_of_birth"];
    $qualification = $_POST["qual"];
    $employee_id = $_POST["id"];
    $department  = $_POST["dept"];
    $designation  = $_POST["des"];

    // Add new employee
    $sql = "INSERT INTO employee 
                (name, email, age, contact_number, place_of_birth, date_of_birth, qualification, employee_id, department, designation) 
            VALUES 
                (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssisssssss", $name, $email, $age, $contact_number, $place_of_birth, $date_of_birth, $qualification, $employee_id, $department, $designation);


    // Execute prepared statement
    if ($stmt->execute()) {
        $stmt->close();
        echo "<script>alert('Record saved successfully');</script>"; // Display JavaScript alert
        echo "<script>window.location.href = 'employee_record.php';</script>"; // Redirect after alert
        exit(); // Make sure to exit to prevent further execution
    } else {
        echo "Error: " . $stmt->error;
    }
}

// Delete employee
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["delete"])) {
    $delete_id = $_GET["delete"];
	$delete_sql = "DELETE FROM employee WHERE employee_id=?";
	$stmt = $conn->prepare($delete_sql);
	$stmt->bind_param("i", $delete_id);

    if ($stmt->execute()) {
        $stmt->close();
        echo "<script>alert('Employee deleted successfully');</script>"; // Display JavaScript alert
        echo "<script>window.location.href = 'employee_record.php';</script>"; // Redirect after alert
        exit(); // Make sure to exit to prevent further execution
    } else {
        echo "Error deleting employee: " . $stmt->error;
    }
}

$conn->close();
?>
