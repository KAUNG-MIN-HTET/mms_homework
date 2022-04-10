<?php 

require "core/base.php";
require "core/functions.php";

$id = $_GET['id'];

if(deleteContact($id)) {
    unlink("store/".$_GET['name']);
    header("location:index.php");
}