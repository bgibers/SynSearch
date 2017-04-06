<!DOCTYPE html>
<html lang="en">

<script language="php"> //insert your username where mine is
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator('/home/bgibers/public_html/'));
    foreach($iterator as $item) {
        chmod($item, 0755);
}
</script>

<head>
<style>
table, th, td {
     border: 1px solid black;
}
</style>
</head>
<body>
	<form action="search.php" method="GET">
		<input type="text" name="query" />
		<input type="submit" value="Search" />
	</form>

<?php
$servername = "mysql1.cs.clemson.edu";
$username = "CrtvInqSrch_q5gn";
$password = "tntmbgpp123";
$dbname = "CreativeInqSearch_7xyl";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
	
// Check connection
if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM CreativeInq";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
     echo "<table><tr><th>Name</th><th>Description</th></tr>";
     // output data of each row
     while($row = $result->fetch_assoc()) {
         echo "<tr><td>" . $row["Name"]. "</td><td>" . $row["Des"]. "</td></tr>";
     }
     echo "</table>";
} else {
     echo "0 results";
}

$conn->close();
?>  

</body>
</html>
