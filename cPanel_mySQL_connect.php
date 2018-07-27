<!-- Based on w3schools.com PHP - AJAX and MySQL tutorial -> https://www.w3schools.com/php/php_ajax_database.asp -->

<!DOCTYPE html>
<html>
<head>

<!-- style to draw table to display data  -->
<style>
table {
    width: 100%;
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
    padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>

<!-- PHP script to connect to SQL database on cPanel, get data requested by user, and display in table -->
<?php
$servername = "deptprddb01.cc.ku.edu";
$username = "interact_HillRD";
$password = "GroundWater1!";
$database = "interact_CyanoHABs";

// get the content of q containing the user's request from the dropdown list
$q = $_GET['q'];
echo "Selection: " . $q . "</br>";

// create connection -> based on https://www.w3schools.com/php/php_mysql_connect.asp
$conn = new mysqli($servername, $username, $password, $database);

// check connection
if (!$conn->connect_error) {
    die("Could not connect: " . $conn->connect_error);
}
echo "Connected successfully </br>";

//select parameter with the ID number matching the value of the parameter the user chose from the dropdown list
$sql = "SELECT * FROM 'Parameters' WHERE 'PARAM_ID' = '". $q ."'";
$result = $conn->query($sql);

// resulting table of data queried is returned to the HTML page
if ($result->num_rows > 0) {
  echo "<table>
    <tr>
    <th>Parameter ID</th>
    <th>Parameter</th>
    <th>Parameter Title</th>
    </tr>";
  // create table rows for each data record for the selected parameter
  while($row = $result->fetch_assoc()) {
      echo "<tr>";
      echo "<td>" . $row['PARAMETER_ID'] . "</td>";
      echo "<td>" . $row['PARAMETER'] . "</td>";
      echo "<td>" . $row['PARAM_TITLE'] . "</td>";
      echo "</tr>";
  }
  echo "</table>";
} else {
  echo "0 results";
}

$conn->close();
?>
</body>
</html>
