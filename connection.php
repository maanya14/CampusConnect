<?php
// Database connection settings
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// Database connection details
$servername = 'localhost';
$username = 'root';
$password = 'root';
$dbname = 'campus_connect';
$port= '3307';

// Create connection
$conn = new mysqli( $servername, $username, $password, $dbname, $port );

// Check connection
if ( $conn->connect_error ) {
    die( 'Connection failed: ' . $conn->connect_error );
}
