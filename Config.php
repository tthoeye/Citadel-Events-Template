<?php
/*
 * Configuration settings
 */
 
// directories

/***********************************************************
 * Don't forget to insert the web root directory 
 * for example: "C:/wamp/www/" is the default root web dir in a standard wampServer setup)
 ***********************************************************
 */
define("HTDOCS_ROOT", "/code/uit/");  

/*********************************************************** 
 * Replace 'localhost' with your IP address, 
 * if you want to access the template with a mobile device
 * connected to the same network 
 ***********************************************************
 */
define("SERVERNAME", "http://localhost/"); 

/*********************************************************** 
 * Leave all the settings below unchanged if you only want
 * to run the template with the default dataset and parameters.
 ***********************************************************
 */
 
define("BASE_DIR", "" );
define("CLASSES_DIR", "php/");
define("CLASSES", HTDOCS_ROOT . BASE_DIR . CLASSES_DIR);

define("DEBUG", true);

// dataset
define("DATASET_FILE", HTDOCS_ROOT . BASE_DIR ."data/Citadel-POI-common-event-Issy.json");
define("DATASET_ID", 30);
define("DATASET_URL", SERVERNAME . BASE_DIR . "dataset.php");
define("USE_DATABASE", false);

// Map Options (coords point to center of Issy-les-Moulineaux)
define("MAP_CENTER_LATITUDE", 48.8275910);
define("MAP_CENTER_LONGITUDE", 2.27699460);
define("MAP_ZOOM", 16);

// database
define("DB_USERNAME", "root");
define("DB_PASSWORD", "");
define("DB_HOSTNAME", "127.0.0.1");
define("DB_PORT", "3306");
define("DB_NAME", "citadel");
?>
