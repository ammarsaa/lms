<?php

/********************************
* File Name: db_connection.php 	*
* Author: Tariq M.T.H 			*
* Output: Database Conneciton 	*
********************************/

// Create connection
$conn = new mysqli(DB_SERVER, USER, PASS, DATABASE_NAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed:  " . $conn->connect_error. " Please contact ".ADMIN_EMAIL);
}