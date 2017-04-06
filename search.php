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
?>

<!doctype html>
<html lang="en">
<head>
    <title>Search results</title>
    <style>
table, th, td {
     border: 1px solid black;
}
</style>
</head>
<body>
<?php
    $query = $_GET['query'];
    // gets value sent over search form

    $min_length = 3;
    // you can set minimum length of the query if you want

    if(strlen($query) >= $min_length){ // if query length is more or equal minimum length then

        $query = htmlspecialchars($query);
        // changes characters used in html to their equivalents, for example: < to &gt;

	$sql = "SELECT * FROM CreativeInq
            WHERE (`Name` LIKE '%".$query."%') OR (`Des` LIKE '%".$query."%')";
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
}

   
		
?>
	</body>
</html>
