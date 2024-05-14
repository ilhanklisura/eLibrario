<?php

require 'vendor/autoload.php';
require 'rest/routes/middleware_routes.php';
require 'rest/routes/employee_routes.php';
require 'rest/routes/admin_routes.php';
require 'rest/routes/auth_routes.php';

Flight::start();