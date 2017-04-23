<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tjb";


$url = $_SERVER['REQUEST_URI'];
$titleFromUrl = urldecode(parse_url($url, PHP_URL_QUERY)); 


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT Definition FROM sheet1 WHERE Title='$titleFromUrl'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        // echo "Title: " . $row["Title"]. " Definition: " . $row["Definition"]. "<br>";
        // echo $row['Definition'];
        $post_data = array('messages' =>
        					array(
  								array( 'text' => $row['Definition'] )
						 	)
						  );

    }
} else {
        $post_data = array('' =>
    					array(
								array( '' => '' )
					 	)
					  );
}


echo json_encode($post_data);

$conn->close();
?>