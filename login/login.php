<?php
//Variables from form
 $name = $_POST['username']; // required
 //$email = $_POST['email']; // required
 $password = $_POST['password'];



// connect to the "tests" database

$conn = new mysqli('localhost', 'osap_system','pass123','osap');

// check connection
if (mysqli_connect_errno()) {
  exit('Connect failed: '. mysqli_connect_error());
}

// sql query for INSERT INTO users
$sql = "INSERT INTO `users` (`Username`, `Password`, `Email`)
VALUES ('$name', '$password', 'name@domain.net')";

// Performs the $sql query on the server to insert the values
if ($conn->query($sql) === TRUE) {
  echo 'users entry saved successfully';
}
else {
 echo 'Error: '. $conn->error;
}

$conn->close();

?>