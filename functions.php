<?php
/**
 * FUNctions File
**/

/* Defining the functions directory */
define("FUN", get_template_directory() . "/functions");

/* Bring those files into this file, which is automatically read by Wordpress */
require_once FUN . "/wp_bootstrap_navwalker.php";
require_once FUN . "/general.php";
require_once FUN . "/point.php";

/* Do not add anything beneath this line! Else the world crumbles */