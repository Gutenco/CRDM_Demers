<?php
require_once 'config/db_config.php';
require_once 'auth.php';

// Check if user is logged in and has admin role
if ( !isAdmin()) {
header('Location: login.php'); // Update the file path to login.php if it's in the same directory
exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ADMIN</title>
    <link rel="stylesheet" href="admin_mockup_style.css">
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/v/dt/dt-1.13.4/af-2.5.3/b-2.3.6/b-colvis-2.3.6/b-html5-2.3.6/b-print-2.3.6/cr-1.6.2/fh-3.3.2/kt-2.8.2/r-2.4.1/sc-2.1.1/sl-1.6.2/datatables.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>
<body>

<nav class="navbar">
    <div class="logo">
        <span id="nav-logo-name" class="logo-name">IMSP CRDM</span>
        <img id="logo-img" src="images/logo%202.png" alt="logo_img">
        <span class="logo-name" id="admin-desc">ADMIN</span>
    </div>
</nav>

<div id="wrapper">
    <div id="sidebar">
        <button id="toggleSidebar" class="toggle-sidebar-btn">
            <i id="toggleIcon" class="bi bi-arrow-left-circle"></i>
        </button>
        <ul class="sidebar-menu">
            <li><a href="index_demers.php" id="homeButton">      <i class="bi bi-house">             </i>Home</a></li>
            <li><a href="#" id="profileButton">   <i class="bi bi-person">            </i>Profil</a></li>
            <li><a href="#" id="usersButton">     <i class="bi bi-people">            </i>Utilizatori</a></li>
            <li><a href="#" id="documentsButton"> <i class="bi bi-file-earmark-text"> </i>Documente</a></li>
            <li><a href="#" id="historyButton">   <i class="bi bi-clock-history">     </i>Istorie</a></li>
            <li><a href="#" id="settingsButton">  <i class="bi bi-gear">              </i>Settings</a></li>
            <li><a href="#" id="archiveButton">   <i class="bi bi-archive">           </i>Arhivă</a></li>
            <li><a href="logout.php"><i class="bi bi-box-arrow-right"> </i> Logout</a></li>
        </ul>
    </div>
     <div id="main-container">
         <div id="mainContainer"></div>
        <!-- Your main content goes here -->
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/v/dt/dt-1.13.4/af-2.5.3/b-2.3.6/b-colvis-2.3.6/b-html5-2.3.6/b-print-2.3.6/cr-1.6.2/fh-3.3.2/kt-2.8.2/r-2.4.1/sc-2.1.1/sl-1.6.2/datatables.min.js"></script>
<script>

    const profileButton = document.querySelector('#profileButton');
    const documentsButton = document.querySelector('#documentsButton');
    const historyButton = document.querySelector('#historyButton');
    const usersButton = document.querySelector('#usersButton');
    const settingsButton = document.querySelector('#settingsButton');
    const archiveButton = document.querySelector('#archiveButton');

    const mainContainer = document.querySelector('#mainContainer');

    profileButton.addEventListener('click', () => {
        mainContainer.innerHTML = '<h3>Profile information.</h3>';
    });
    documentsButton.addEventListener('click', () => {
        mainContainer.innerHTML = '<h3>Documents information.</h3>';
    });
    historyButton.addEventListener('click', () => {
        loadContent('history.php');
    });
    settingsButton.addEventListener('click', () => {
        mainContainer.innerHTML = '<h3>Settings INFO.</h3>';
    });

    usersButton.addEventListener('click', () => {

        loadContent('add_user.php');
    });

    archiveButton.addEventListener('click', () => {

        loadContent('Php_ajax_test.php');
    });


    function loadContent(url) {
        fetch(url)
            .then(response => response.text())
            .then(html => {
                mainContainer.innerHTML = html;
                // Reinitialize DataTables plugin
                $('#accounts-table').DataTable().destroy();
                $('#accounts-table').DataTable();
            })
            .catch(error => console.error(error));
    }


    var sidebarMenuItems = document.querySelectorAll('.sidebar-menu li a');

    sidebarMenuItems.forEach(function (menuItem) {
        menuItem.addEventListener('click', function () {
            sidebarMenuItems.forEach(function (item) {
                item.classList.remove('active');
            });
            this.classList.add('active');
        });
    });

    /*document.getElementById('toggleSidebar').addEventListener('click', function () {
        document.getElementById('sidebar').classList.toggle('closed');
    });

    document.getElementById('openSidebar').addEventListener('click', function () {
        document.getElementById('sidebar').classList.remove('closed');
    });*/


    document.getElementById('toggleSidebar').addEventListener('click', function () {
        var sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('minimized');
    });


    $(document).ready(function () {
        $('#accounts-table').DataTable();
    });


</script>

</body>
</html>