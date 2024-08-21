<?php
// Check if the latitude and longitude were sent via AJAX
if (isset($_POST['latitude']) && isset($_POST['longitude'])) {
  // Get the latitude and longitude values
  $latitude = $_POST['latitude'];
  $longitude = $_POST['longitude'];
  
  // Do something with the latitude and longitude values
  // For example, you could store them in a MySQL database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bloodbank";
  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  $sql = "INSERT INTO locations (latitude, longitude) VALUES ('$latitude', '$longitude')";
  if ($conn->query($sql) === TRUE) {
    echo "Location saved successfully!";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  $conn->close();
} else {
  echo "Error: Latitude and longitude not provided.";
}
?>
