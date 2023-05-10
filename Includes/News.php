<?php
session_start();
include_once '../Classes/Database_Handler.php';
include_once '../Classes/News.php';
include_once '../Classes/News_Controller.php';


if(isset($_POST["create_news"]))
{

$title=$_POST['title'];
$description=$_POST['description'];
$NewsCntrl=new NewsContr($title,$description,$id);
$NewsCntrl->create();

}
if(isset($_POST["update_news"]))
{
$id=$_POST['news_id'];
$title=$_POST['title'];
$description=$_POST['description'];
$NewsCntrl=new NewsContr($title,$description,$id);
$NewsCntrl->update();

}

if(isset($_POST["delete_news"]))
{
$id=$_POST['news_id'];

$NewsCntrl=new NewsContr('','',$id);
$NewsCntrl->delete();

}
if(!isset($_SESSION['username'])) {
    header("Location: ../index.php?error=notloggedin");
    exit();
}
else
{
$NewsCntrl=new NewsContr();
$NewsCntrl->show();
}
