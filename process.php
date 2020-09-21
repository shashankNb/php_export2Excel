<?php
include("class.export.php");

if (isset($_POST['submit'])) {
    $columns = [
        'name' => 'Name',
        'email' => 'Email'
    ];
    $metaData = [
        'Page Title' => 'Users Table'
    ];
    // $sql = "SELECT *, (SELECT count(*) FROM USERS) as recordCount FROM USERS";
    $sql = "SELECT * FROM USERS";
    // $obj->exportCSV($sql, $columns, $metaData, true);
    $obj->exportCSV($sql);
}
