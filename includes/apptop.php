<?
require('includes/config.php');
require('includes/functions.php');
require('includes/html_output.php');

if($logVisitors){
    user_track();
}