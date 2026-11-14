<!DOCTYPE html>
<html lang="en">
<head>
  <link href="styles/style.css" rel="stylesheet">
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Ecopower renewable energy solutions and career website."  />
  <meta name="keywords" content="HTML5, renewable energy, Ecopower, jobs" />
  <meta name="author" content="Group 03 Team Members"  />
  <title><?php echo isset($page_title) ? $page_title : "Ecopower"; ?></title>

<style>.hero-banner h2 { text-shadow: 2px 2px 4px rgba(5, 5, 2, 0.5); }</style>

</head>

<body<?php if (!empty($body_class)) { echo ' class="' . htmlspecialchars($body_class) . '"'; } ?>>
  
  <header class="site-header fluid">
    <div class="header-container navbar ">
    <div class="brand-group">

    <img src="images/logo.png" alt="Ecopower Logo" class="logo-img">
    <h1 class="brand-title" style="color:black; margin:0;">Ecopower</h1>
    </div>

     <nav  class="nav-links-group">
        <a href="index.php">Home</a>
        <a href="search.php">Search</a>
        <a href="jobs.php">Job Description</a> 
        <a href="apply.php">Apply</a>
        <a href="manage.php">Manage</a> 
        <a href="about.php">About</a> 
  
    
      <a href="apply.php" class="btn-green">Apply Now!</a>
    
     </nav>
    </div>
  </header>
