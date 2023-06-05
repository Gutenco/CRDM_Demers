<?php
// update.php

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the new department name and boss name from the form
    $department_name = $_POST['department_name'];
    $boss_name = $_POST['boss_name'];

    $dom = new DOMDocument();
    $dom->loadHTMLFile('index_demers.html');

    $department_element = $dom->getElementById('department');
    if (!empty($department_name)) {
        $department_element->textContent = mb_convert_case($department_name, MB_CASE_TITLE);
    }

    $boss_element = $dom->getElementById('boss-name');
    if (!empty($boss_name)) {
        $name_parts = explode(" ", $boss_name);
        $last_name = mb_strtoupper(array_pop($name_parts));
        $first_name = implode(" ", array_map(function($name_part) {
            return mb_convert_case($name_part, MB_CASE_TITLE);
        }, $name_parts));
        $boss_name = $first_name . " " . $last_name;
        $boss_element->textContent = $boss_name;
    }


    $html = $dom->saveHTML();
    file_put_contents('index_demers.html', $html);

    header('Location: admin/admin_page.php');
    exit();
}

