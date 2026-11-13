<?php 
require_once("settings.php");
$title = "Search Results";
include('inc/header.inc');
?>

<main>
  <h2 id="job_description">Search Results</h2>
  <div class="search-container">
    <form method="GET" action="search.php">
      <label for="search-input">Search:</label>
      <input type="text" id="search-input" name="query" placeholder="Enter any keyword" value="<?php echo isset($_GET['query']) ? htmlspecialchars($_GET['query']) : ''; ?>" required><br>
      <input type="submit"value="Search">
    </form>
    </div>
  <br>

  <?php
  $dbconn= @mysqli_connect($host, $user, $pwd, $sql_db);
  if ($dbconn) {
    $search = "";
    if (isset($_GET['query'])) {
      $search = trim($_GET['query']);
    }   
 if($search !== ""){
  $word=preg_split('/\s+/', $search);
  $condition = [];
  foreach ($word as $word) {
    $word_escaped = mysqli_real_escape_string($dbconn, $word);
    $condition[] = "(
    title LIKE '%$word_escaped%' OR
    job_ref LIKE '%$word_escaped%'OR
    salary LIKE '%$word_escaped%' OR
    reports_to LIKE '%$word_escaped%'OR
    description LIKE '%$word_escaped%'OR
    responsibilities LIKE '%$word_escaped%'OR
    requirements LIKE '%$word_escaped%'OR
    REPLACE(salary, ',', '') LIKE '%$word_escaped%'
    )";
  }

   $where_clause = implode(" AND ", $condition);
   $query = "SELECT * FROM jobs WHERE $where_clause";
   echo'<p class="centered_heading">Showing results for <strong>' . htmlspecialchars($search) . '</strong></p>';
 }else{
  $query = "SELECT * FROM jobs";
 }

 $result = mysqli_query($dbconn, $query);
 if ($result && mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    echo '<section class="job_section">';
    echo '<h2 class="heading">' . htmlspecialchars($row['title']) . '</h2>';
    echo '<p>Reference Number: ' . htmlspecialchars($row['job_ref']) . '</p>';
    echo '<p>Salary: ' . htmlspecialchars($row['salary']) . '</p>';
    echo '<p>Position Reports To: ' . htmlspecialchars($row['reports_to']) . '</p>';
    echo '<h3 class="heading">Description:</h3>';
    echo '<p> ' . htmlspecialchars($row['description']) . '</p>';
    echo '<h3 class="heading">Key Responsibilities:</h3>';
    echo '<ul>';
    $resp_items = explode("\n", $row['responsibilities']);
    foreach ($resp_items as $item) {
      if (trim($item) !== "") {
        echo '<li>' . htmlspecialchars(trim($item)) . '</li>';
      }
    }
    echo '</ul>'; 

    echo '<h3>Essential and Preferable Requirements:</h3>';
    echo '<ol>';
    $req_items = explode("\n", $row['requirements']);
    foreach ($req_items as $item) {
      if (trim($item) !== "") {
        echo '<li>' . htmlspecialchars(trim($item)) . '</li>';
      }
    }
    echo '</ol>';
    echo '<p><a href="apply.php?job_ref=' . htmlspecialchars($row['job_ref']) . '">Apply for this position</a></p>';
    echo '</section>';
  }
  }else {
    echo '<p class="centered_heading">No results found for<strong>' . htmlspecialchars($search) . '</strong></p>';
  }
  mysqli_close($dbconn);
} else {
  echo '<p>Unable to connect to the database</p>';
}
?>

<div style="clear: both;"></div>
<p class="centered_heading"><a href="index.php">Back to Home | <a href="jobs.php">View all jobs</a></p>
</main>

<?php
include('inc/footer.inc');
?>



  
