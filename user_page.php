<?php
session_start();
if(!$_SESSION['logged']){
    header("Location: index.html");
    exit;
}
echo 'Welcome, '.$_SESSION['username'];
?>