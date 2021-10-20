<?php

# App name
define ("WEB_TITLE", "Utility Junction Test");

# Domain
define ("DOMAIN", $_SERVER["SERVER_NAME"]);

# App main folder name
define ("PATH", "project"); # App container folder

# PATH to media files and site root constants
define ("SITE_ROOT", "/" . PATH);
define ("MEDIA", SITE_ROOT . "/" . "public");
define ("HTML", "public" . DS . "html");
define ("THEME", "default-theme");
define ("UPLOAD", "public/uploads/");

# Default states
define ("DEFAULT_CONTROLLER", "page");
define ("DEFAULT_METHOD", "index");
define ("NOT_FOUND", "not_found");

# Startup Locales
define ("LOCALES", 
        array(
          "SITE_ROOT" => SITE_ROOT,
          "MEDIA" => MEDIA,
          "THEME" => THEME,
          "DOMAIN" => DOMAIN,
        ));

# Database link credentials
define ("DBNAME", "webapp");
define ("DBUSER", "root");
define ("DBPASS", "");
define ("DBHOST", "localhost");

# Email credentials
define ("MAIL_SERVER", "");
define ("USER_EMAIL", "");
define ("USER_PASS","");

?>