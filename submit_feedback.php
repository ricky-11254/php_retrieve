<?php
$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$feedback = $_POST['feedback'];
$rating = $_POST['rating'];

$connection = new mysqli("localhost", "root", "", "campaign_feedback");
if ($connection -> connect_error) {
  // If the connection failed, stop the script and print the error
  die("Connection failed: " . $connection->connect_error);
}

// Prepare the SQL query to insert the data into the new table (assuming a table named ATTENDANCE for storing the information)
$sql = "INSERT INTO feedback (id, name, email, feedback, rating) VALUES ('$id', '$name', '$email', '$feedback', '$rating')";

// Execute the SQL query
$result = $connection -> query($sql);

// Check if the query was successful
if ($result) {
    // If the query was successful, output a JavaScript alert and redirect to 1register.php
    echo "<script>
            alert('Record successfully added');
            window.location.href = '_feedback.php';
          </script>";
} else {
    // If there was an error with the query, print the error
    echo "Error: " . $sql . "<br>" . $connection->error;
}

// Close the database connection
$connection->close();
?>
