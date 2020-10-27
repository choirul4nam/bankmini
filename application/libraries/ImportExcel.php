<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
  require_once "PHPExcel.php";
  require_once "PHPExcel/IOFactory.php";
 
 class ImportExcel extends PHPExcel {
       public function __construct() {
       parent::__construct();
   }
 }