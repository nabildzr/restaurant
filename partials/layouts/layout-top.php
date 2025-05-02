<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Foores - Single Restaurant Version">
    <meta name="author" content="Ansonika">
    <title>Foores - Single Restaurant Version</title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="/assets/img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="/assets/img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="/assets/img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="/assets/img/apple-touch-icon-144x144-precomposed.png">

    <!-- GOOGLE WEB FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital@1&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- BASE CSS -->
    <link href="/assets/css/vendors.min.css" rel="stylesheet">
    <link href="/assets/css/style.css" rel="stylesheet">

    <!-- SPECIFIC CSS -->
    <link href="/assets/css/wizard.css" rel="stylesheet">


    <!-- YOUR CUSTOM CSS -->
    <link href="/assets/css/custom.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets_dashboard/assets/css/remixicon.css">
    <!-- sweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <!-- custom header per file -->
    <?php echo (isset($heading) ? $heading : '') ?>




    <style>
        .custom-button {
            border: none;
            color: #fff;
            text-decoration: none;
            transition: background .5s ease;
            -moz-transition: background .5s ease;
            -webkit-transition: background .5s ease;
            -o-transition: background .5s ease;
            display: inline-block;
            cursor: pointer;
            outline: none;
            text-align: center;
            background: #978667;
            position: relative;
            font-size: 14px;
            font-size: 0.875rem;
            font-weight: 600;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            -ms-border-radius: 3px;
            border-radius: 3px;
            line-height: 1;
            padding: 12px 30px;
        }
    </style>
</head>

<body>

    <!-- <div id="preloader">
            <div data-loader="circle-side"></div>
        </div>

        <div id="loader_form">
            <div data-loader="circle-side-2"></div>
        </div -->
    <!-- /loader_form  -->
    <!-- /Page Preload -->
    <!-- header -->
    <?php include_once __DIR__ . '/../header.php' ?>