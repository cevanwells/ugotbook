#!/usr/bin/env php -q
<?php namespace ugotbook; 
include_once('lib/functions.php');

// Read in configuration file
$config = parse_ini_file('config.ini', $process_sections = true);

// gather pieces of configuration
$endpoint = $config['API']['endpoint'];
$client_key = $config['API']['client_key'];
$client_secret = $config['API']['client_secret'];
$dbhost = $config['DNA']['hostname'];
$dbport = $config['DNA']['port'];
$dbname = $config['DNA']['database_name'];
$dbuser = $config['DNA']['database_user'];
$dbpass = $config['DNA']['database_pass'];

// create API object for requests
$api = new API($endpoint, $client_key, $client_secret);

// create a connection to the database
$db = new DNA($dbhost, $dbport, $dbname, $dbuser, $dbpass);

// request patron using barcode
$patron = $api->fetchPatron('1234567890123');
print_r($patron);

// request a hold
$res = $api->requestHold($patron, '1000011');
print_r($res);

// request a list of 10 bibs via DNA
// DOES NOT YET WORK
// $bibs = $db->query("SELECT * from sierra_view.bibs_view LIMIT 10");
// print_r($bibs);

?>
