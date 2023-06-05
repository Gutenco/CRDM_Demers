<?php
require_once 'auth.php';
require_once 'config/db_config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Users</title>
    <link rel="stylesheet" href="admin_mockup_style.css">
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/v/dt/dt-1.13.4/af-2.5.3/b-2.3.6/b-colvis-2.3.6/b-html5-2.3.6/b-print-2.3.6/cr-1.6.2/fh-3.3.2/kt-2.8.2/r-2.4.1/sc-2.1.1/sl-1.6.2/datatables.min.css" rel="stylesheet"/>
</head>
<body>


    <!-- Your main content goes here -->
    <div class="admin-title-container">
        <h3 class="manage-users">Administrare Utilizatori</h3>
    </div>

    <button type="button" id="add-user-btn" class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#addUserModal">
        Adaugă
    </button>

    <!-- Bootstrap Modal for Adding New Users -->
    <div class="modal" tabindex="-1" role="dialog" id="addUserModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Adaugă utilizator</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addUserForm" action="create_user.php" method="post">
                        <div class="d-grid gap-3">
                            <div class="form-group" >
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="new_username" required>
                            </div>
                            <div class="form-group" >
                                <label for="password">Parolă</label>
                                <input type="password" class="form-control" id="password" name="new_password" required>
                            </div>
                            <div class="form-group" >
                                <label for="role">Rol</label>
                                <select class="form-control" id="role" name="new_role" required>
                                    <option value="user">Utilizator</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-outline-success" id="submitBtn">Adaugă</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="view-accounts-section">
        <table id="accounts-table"  class="stripe" style="width:100%">

            <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Permisiuni</th>
                <th>Data Creării</th>
                <th>Acțiuni</th>
            </tr>
            </thead>
            <tbody>

            <?php

            // Retrieve data from the database
            $sql = "SELECT id_user, username, created_at, role FROM account";
            $result = $conn->query($sql);

            // Display the data in the HTML table
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id_user"] . "</td>";
                    echo "<td>" . $row["username"] . "</td>";
                    echo "<td>" . $row["role"] . "</td>";
                    echo "<td>" . $row["created_at"] . "</td>";
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

<style>

  #add-user-btn{
      margin-bottom: 20px ;
  }

</style>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/v/dt/dt-1.13.4/af-2.5.3/b-2.3.6/b-colvis-2.3.6/b-html5-2.3.6/b-print-2.3.6/cr-1.6.2/fh-3.3.2/kt-2.8.2/r-2.4.1/sc-2.1.1/sl-1.6.2/datatables.min.js"></script>

    <script>


      /*  $(document).ready(function() {
            $('#accounts-table').DataTable({
                "dom": '<"top"<"left"f><"right"B>>rt<"bottom"<"left"i><"center"l><"right"p>><"clear">',
                "buttons": [{
                    "text": "Adaugă",
                    "className": "btn btn-outline-success btn-sm",
                    "action": function(e, dt, node, config) {
                        // Add your action code here
                    }
                }]
            });
        }); */


        $(document).ready(function() {
            $('#accounts-table').DataTable({
                "dom": '<"top"f><"bottom"l><"bottom"r>rt<"clear">',

            });
        })


    </script>
</body>
</html>