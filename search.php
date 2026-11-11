<?php
$page_title = "Ecopower - Search";
include("inc/header.inc");
require_once("settings.php");
?>

<main> <h2>Search Applications EOI</h2>
<div style="text-align:center;">
  <form action="search.php" method="get">
    <label for="search-input">Search projects and roles:</label>
    <input type="text" id="search-input" name="query" placeholder="Enter search term">
    <button type="submit">Search</button>
  </form>
  </div>
</main>

<?php include("inc/footer.inc"); ?>