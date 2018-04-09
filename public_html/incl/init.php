<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

/* - DEFINE DOCUMENT ROOT - */
define("DOCROOT", filter_input(INPUT_SERVER, "DOCUMENT_ROOT", FILTER_SANITIZE_STRING));
/* - DEFINE CORE ROOT - */
define("COREPATH", substr(DOCROOT, 0, strrpos(DOCROOT, "/")) . "/core/");
/* - CLASS AUTOLOADER - */
require_once COREPATH . 'classes/auto_loader.php';
/* - INITIALIZE DATABASE - */
//$db = new db_conf();
