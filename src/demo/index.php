<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

require '../../vendor/autoload.php';
require_once 'Class.Company.inc.php';
require_once 'Class.Employee.inc.php';





$emplyee = new Employee();

//echo $emplyee->addEmployee(array("namex"=>"samsam", "email"=>"blabla@gmail.com", "address"=>"blabla"));
echo $emplyee->findEmployee(array("name"=>"sam7sam"));
