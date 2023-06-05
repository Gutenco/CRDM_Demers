<?php
require_once 'auth.php';
require_once 'config/db_config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Database Connection Test</title>
</head>
<body>
<h1>History Info</h1>

<div class="view-accounts-section">
        <table id="accounts-table"  class="stripe" style="width:100%">

            <thead>
            <tr>
                <th>ID</th>
                <th>Data</th>
                <th>Created At</th>
            </tr>
            </thead>
            <tbody>

            <?php

            // Retrieve data from the database
            $sql = "SELECT * FROM list_hitory";
            $result = $conn->query($sql);

            // Display the data in the HTML table
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id_list_history"] . "</td>";
                    echo "<td>" . $row["account_id_user"] . "</td>";
                    echo "<td>" . $row["history_created_at"] . "</td>";
                    echo '<td>
                          <button type="button" class="btn btn-outline-secondary btn-sm">Edit</button>
                          <button type="button" class="btn btn-outline-danger btn-sm">Delete</button>
                     </td>';
                    echo "</tr>";
                }
            } else {
                echo "0 results";
            }

            // Close the database connection
            $conn->close();
            ?>

<!-- Add more rows for each account in the database -->
</tbody>
</table>
</div>

</body>
</html>
