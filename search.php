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
	
    $word = $_GET['query'];
	search($word,$conn);
	$apikey = "4D4492YORcpzKHggkLZM"; // NOTE: replace test_only with your own key 
	$language = "en_US"; // you can use: en_US, es_ES, de_DE, fr_FR, it_IT 
	$endpoint = "http://thesaurus.altervista.org/thesaurus/v1";
	
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_URL, "$endpoint?word=".urlencode($word)."&language=$language&key=$apikey&output=json"); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	$data = curl_exec($ch); 
	$info = curl_getinfo($ch); 
	curl_close($ch);
	
	if ($info['http_code'] == 200) { 
  	$result = json_decode($data, true);  
	$array = [];
	$flag = false;
  	foreach ($result["response"] as $value) { 
		$myarray = explode("|", $value["list"]["synonyms"]); //need to break each value into an array seperated by |
		array_push($array,$myarray);			
  	} 
		foreach($array as $value)
		{
			foreach($value as $entity)
			{
				 search($entity,$conn);
				//echo $entity . '<br>';
			}
			//print_r($value);
		}
	} else echo "Http Error: ".$info['http_code'];
	
	
	
function search($query,$conn){	
    $min_length = 3;
    // you can set minimum length of the query if you want

    if(strlen($query) >= $min_length){ // if query length is more or equal minimum length then

        $query = htmlspecialchars($query);
        // changes characters used in html to their equivalents, for example: < to &gt;

	$sql = "SELECT * FROM CreativeInq
            WHERE (`Name` LIKE '%".$query."%') OR (`Des` LIKE '%".$query."%')";
	$result = $conn->query($sql);

if ($result->num_rows > 0) {
	echo "<table><tr><th>Name</th><th>Description</th></tr>";     // output data of each row
     while($row = $result->fetch_assoc()) {
         echo "<tr><td>" . $row["Name"]. "</td><td>" . $row["Des"]. "</td></tr>";
     }
     echo "</table>";
} 
 }		
}


   
		
?>
	</body>
</html>
