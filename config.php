<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "platform_225314028";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    return $conn;

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }