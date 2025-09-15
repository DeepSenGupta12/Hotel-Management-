<?php
session_start();
include "../include/config.php";
include "../include/function.php";
require_once ('../../vendor/autoload.php');
use \Statickidz\GoogleTranslate;


if(isset($_POST['SUBMIT']))
{
    if($_POST['SUBMIT'] == "TRANSLATE")
    {
        $ln = $_POST['ln'];
        $title = $_POST['title'];
        $source = $ln;
        $target = 'en';
        $text = $title;

        $trans = new GoogleTranslate();
        $result = $trans->translate($source, $target, $text);
        echo $result;
        echo "okkkkkkkkkkk";
    }
}
?>