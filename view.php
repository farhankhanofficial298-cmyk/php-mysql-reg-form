<?php
$conn = new mysqli("localhost", "root", "", "sttudent_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM students");

echo "<h2>Registered Students</h2>";
echo "<table border='1' cellpadding='8' cellspacing='0'>
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Course</th>
    <th>Registered At</th>
</tr>";

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>".$row['id']."</td>
                <td>".$row['name']."</td>
                <td>".$row['email']."</td>
                <td>".$row['course']."</td>
                <td>".$row['reg_date']."</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='5'>No records found</td></tr>";
}

echo "</table>";

$conn->close();
?>
