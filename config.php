<?php
// add the file prod.txt in the root of the project to ensure that your are in online server mode
if (file_exists($_SERVER["DOCUMENT_ROOT"] . '/prod.txt')) {
    define("IS_PROD", TRUE);
        // Database connection
    define("DB_HOST", "localhost");
    define("DB_PORT", "3306");
    define("DB_USER", "");
    define("DB_PWD", "");
    define("DB_NAME", "");
    // Domain name , Home url 
    define("HOME_URL", "");
    define("Domain", "");
    define("PREFIXE", "transport_");
  
} else {
    define('IS_PROD', FALSE);
        // Database connection
    define("DB_HOST", "localhost");
    define("DB_PORT", "3306");
    define("DB_USER", "agtc");
    define("DB_PWD", "agtc");
    define("DB_NAME", "agtc");
    // Domain name , Home url 
    define('HOME_URL', '/');
    define("Domain", "http://agtc");
    define("PREFIXE", "transport_");

 
}
