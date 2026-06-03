<?php

// DATABASE CONNECTION
$host = "p-studmysql02.fontysict.net";      
$username = "i571306_U_Matter";       
$password = "bYMSLaztBM3SejFu5Bag";           
$database = "i571306_U_Matter"; 

// Create connection 
$conn = new mysqli($host, $username, $password, $database); 
// Check connection 
if ($conn->connect_error) { 
    die("Connection failed: " . $conn->connect_error); 
} 
?>