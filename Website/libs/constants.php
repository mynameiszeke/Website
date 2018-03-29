<?php
/*
 * @author Ezekiel Iyanobor
 */

// dont add a trailing / at the end
define('HTTP_SERVER', 'http://localhost:8080/phpmyadmin/db_structure.php?server=1&db=chemtox');
// add slash / at the end
define('SITE_DIR', '/website/');

// database prefix if you use
define('DB_PREFIX', 'mp_');

define('DB_DRIVER', 'mysql');
define('DB_HOST', 'localhost');
define('DB_HOST_USERNAME', 'root');
define('DB_HOST_PASSWORD', '');
define('DB_DATABASE', 'chemtox');

define('SITE_NAME', 'ChemTox Website');

// define database tables
define('TABLE_PAGES', DB_PREFIX.'pages');
define('TABLE_TAGLINE', DB_PREFIX.'tagline');
?>