
<!DOCTYPE html>
<!--  This site was created in Webflow. http://www.webflow.com -->
<!--  Last Published: Tue Apr 18 2017 02:33:33 GMT+0000 (UTC)  -->
<head>
  <meta charset="utf-8">
  <title>Find a project</title>
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <meta content="Webflow" name="generator">
  <link href="css/normalize.css" rel="stylesheet" type="text/css">
  <link href="css/webflow.css" rel="stylesheet" type="text/css">
  <link href="css/brendan-9692d2.webflow.css" rel="stylesheet" type="text/css">
  <script src="/CRTINQ/js/modernizr.js" type="text/javascript"></script>
  <link href="https://daks2k3a4ib2z.cloudfront.net/img/favicon.ico" rel="shortcut icon" type="image/x-icon">
  <link href="https://daks2k3a4ib2z.cloudfront.net/img/webclip.png" rel="apple-touch-icon">
</head>
<body>
  <div class="container w-container">
    <div class="w-form">
      <form class="form w-clearfix" data-name="Search" id="email-form" name="search-form" action = "searcher.php" method="GET"><img class="image" src="images/ci.png">
        <input class="submit-button w-button" data-wait="Please wait..." type="submit" value="Search">     
        <input class="text-field w-input" data-name="Search" id="Search" maxlength="256" name="query" type="text">
        <h5>Find Creative Inquiry projects that need students with your interests.</h5>
      </form>
    </div>
  </div>
  <div>
    <div class="text-block">&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;<strong>Project #</strong> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <strong>Project Details</strong>
    </div>
  </div>
 
  <div class="section">
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
$count = 2;
if ($result->num_rows > 0) {
     // output data of each row
     while($row = $result->fetch_assoc()) {
		 echo "<div class=\"container-2 w-container\">
      <div class=\"text-block-3\">" . $row["CID"]. "</div>
      <h3 class=\"heading\">" . $row["Name"]. "</h3>
      <p class=\"paragraph\">" . $row["Des"]."</p>
    </div>";
	 }
} else {
     echo "0 results";
}

$conn->close();
?> 
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js" type="text/javascript"></script>
  <script src="js/webflow.js" type="text/javascript"></script>
  <!-- [if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif] -->
</body>
</html>