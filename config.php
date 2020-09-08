<?php

/****************************
* File Name: config.php 	*
* Author: Ammar S.A.A 		*
* Output: Configuration 	*
****************************/

//error_reporting(0);

// Website Paths
define("WEBSITE_PATH", "C:/xampp/htdocs/lms");
define("WEBSITE_URL", "http://localhost:8080/lms/");

// Database Configurations
define("DB_SERVER", "localhost");
define("USER", "root");
define("PASS", "");
define("DATABASE_NAME","lms");

// Admin Configuration
define("ADMIN_EMAIL", "mk.masooma@gmail.com");

// Tables' Names
define('TBLADMIN', 'admin');
define('TBLAUTHORS', 'tblauthors');
define('TBLBOOKS', 'tblbooks');
define('TBLCATEGORIES', 'tblcategory');
define('TBLISSUEDBOOKS', 'tblissuedbooksdetail');
define('TBLFEEDBACK', 'tblfeedback');
define('TBLRULESANDREGULATIONS', 'tblrulesandregulations');
define('TBLSLIDER', 'tblslider');
define('TBLUSERS', 'tblusers');
