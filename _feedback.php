<?php
$connection = new mysqli("localhost", "root", "", "campaign_feedback");
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$results_per_page = 10;

$sql = "SELECT COUNT(*) AS total FROM feedback";

$result = $connection->query($sql);
$row = $result->fetch_assoc();
$total_results = $row['total'];

$total_pages = ceil($total_results / $results_per_page);

$page = isset($_GET['page']) ? $_GET['page'] : 1;

$start_limit = ($page - 1) * $results_per_page;

$sql = "SELECT id, name, email, feedback, rating FROM feedback LIMIT " . $start_limit . ', ' . $results_per_page;
$result = $connection->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Feedback</title>
    <link href="css/style.css" rel="stylesheet">
<style>
    table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    border: 1px solid #ddd;
    padding: 8px;
}

th {
    background-color: #f2f2f2;
    text-align: left;
}

tr:nth-child(even) {
    background-color: #f9f9f9;
}

tr:hover {
    background-color: #ddd;
}

</style>

</head>
<body>
    <h1>Feedback Records</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Feedback</th>
                <th>Rating</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["id"]. "</td>
                            <td>" . $row["name"]. "</td>
                            <td>" . $row["email"]. "</td>
                            <td>" . $row["feedback"]. "</td>
                            <td>" . $row["rating"]. "</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No records found</td></tr>";
            }
            $connection->close();
            ?>
        </tbody>
    </table>
    <div class="pagination">
        <?php
        for ($page = 1; $page <= $total_pages; $page++) {
            echo '<a href="view_feedback.php?page=' . $page . '">' . $page . '</a> ';
        }
        ?>
    </div>
</body>
</html>

