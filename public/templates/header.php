<?php
// Start Session
session_start();

// Include functions
include_once '../functions.php';

?>

<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Simple DB App</title>

    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1><a href="index.php">Simple DB App</a></h1>

    <ul>
        <li><a href="index.php">Home</a></li>
        <?php if(user_logged_in()){ ?>
            <li><a href="profile.php">Profile</a></li>
        <?php } ?>
        <li><a href="create.php">Create</a></li>
        <li><a href="read.php">Read</a></li>
        <li><a href="update.php">Update</a></li>
        <li><a href="delete.php">Delete</a></li>
        <li><a href="list.php">List</a></li>
        <li><a href="search.php">Search</a></li>
    </ul>