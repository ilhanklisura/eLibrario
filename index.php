<?php 
require 'vendor/autoload.php';

Flight::route('/', function() {
 echo 'This is TalentTrack Web Application';
 echo '<br>';
 echo 'This is based on Employee Management System.';
});

Flight::start();
?>