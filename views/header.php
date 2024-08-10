<?php
#includes initialization file for class loading
include_once '../app/init.php';

#Initializes Customer class containing all actions that can be performed by the user
load::admin();

#starts the  user session 
session_start();

#Logoutt action
#Logout method called statically from the Customer class
admin::logout();

#Checks if the user has a session ,if true access is given to the dashboard, if false the user is redirected to the login page
admin::session();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../assets/css/libs.bundle.css">
    <link rel="stylesheet" href="../assets/css/theme.bundle.css">
    <style>
    @font-face {
        font-family: engravers;
        src: url(../assets/fonts/Engravers-Gothic-BT-Font.ttf);
    }

    * {
        font-family: engravers;
    }

    .simplebar-content-wrapper {
        overflow: auto;
    }

    #logout-btn:hover {
        background-color: white !important;
        color: black !important;
        border-color: white !important;
    }
    </style>
    <title>Administrator</title>
</head>