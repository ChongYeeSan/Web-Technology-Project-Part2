<?php 
require_once("settings.php");
$title = "Search Results";
include('inc/header.inc');
?>
<style>
  span.highlight {
    background-color: yellow !important;
    font-weight: bold;
  }
  html, body {
    height: 100%;
    margin: 0;
  }
  body {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
  }
  main {
    flex: 1;
  }
  </style>

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
$lower_search = strtolower($search);
if($lower_search === "job" || $lower_search === "jobs" || $lower_search === "view jobs" || $lower_search === "vacancy" || $lower_search === "vacancies" || $lower_search === "job listing" || $lower_search === "job listings" || $lower_search === "job opening" || $lower_search === "job openings" || $lower_search === "job opportunity" || $lower_search === "job opportunities" || $lower_search === "job vacancy" || $lower_search === "job vacancies" || $lower_search==="job position" || $lower_search === "job positions" || $lower_search === "job role" || $lower_search === "job roles" || $lower_search === "job description" || $lower_search === "job descriptions" || $lower_search === "job detail" || $lower_search === "job details" || $lower_search === "job information" || $lower_search === "job informations" || $lower_search === "description" || $lower_search === "essential and preferable requirements" || $lower_search === "key responsibilities" || $lower_search === "responsibilities" || $lower_search === "requirements" || $lower_search === "descriptions" || $lower_search === "responsibility" || $lower_search === "job reference number" || $lower_search === "job reference numbers" || $lower_search === "job ref" || $lower_search === "job refs" || $lower_search === "salary" || $lower_search === "salaries" || $lower_search === "position reports to" || $lower_search === "position report to" || $lower_search === "position reports" || $lower_search === "position report" || $lower_search === "position" || $lower_search === "positions") {
mysqli_close($dbconn);
header("Location: jobs.php");
exit();
}elseif($lower_search === "apply" || $lower_search === "apply for job" || $lower_search === "application" || $lower_search === "apply for a job" || $lower_search === "apply job" || $lower_search === "apply for a role" || $lower_search === "apply for a vacancy" || $lower_search === "apply for a job position" || $lower_search === "apply job" || $lower_search === "apply for a job vacancy" ||  $lower_search === "apply for jobs") {
mysqli_close($dbconn);
header("Location: apply.php");
exit();
}elseif($lower_search === "about" || $lower_search === "about us" || $lower_search === "about the company" || $lower_search === "company information" || $lower_search === "company details" || $lower_search === "company profile" || $lower_search === "company overview" || $lower_search === "company background" || $lower_search === "company history" || $lower_search === "about company" || $lower_search === "company mission" || $lower_search === "company vision" || $lower_search === "company values" || $lower_search === "company culture" || $lower_search === "company team" || $lower_search === "company management" ) { 
mysqli_close($dbconn);
header("Location: about.php");
exit();
}


    $words_array=[];
 if($search !== ""){
  $words_array=preg_split('/\s+/', $search);
  $condition = [];
  foreach ($words_array as $w) {
    $word_escaped = mysqli_real_escape_string($dbconn, $w);
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

   $where_clause = implode(" OR ", $condition);
   $query = "SELECT * FROM jobs WHERE $where_clause";

 }else{
  $query = "SELECT * FROM jobs";
 }

 $result = mysqli_query($dbconn, $query);


function highlight($text, $words) {
  $safe_text = htmlspecialchars($text);
  if(empty($words)) {
    return $safe_text;
  }
  foreach ($words as $word) {
    if (trim($word) !== "") {
      $quoted_word = preg_quote($word, '/');
      $flexible_word = str_replace("'", "(?:'|&#039;|&apos;)", $quoted_word);

      if(is_numeric(str_replace(',', '', $word))) {
        $flexible_word = implode(',?', str_split($flexible_word));
        $pattern = '/(' . $flexible_word . ')/ui';
      } else {
        $pattern = '/(' . $flexible_word . ')/ui';
      }
$safe_text = preg_replace($pattern, '<span class="highlight">$1</span>', $safe_text);

    }
  }
  return $safe_text;
}





 if ($result && mysqli_num_rows($result) > 0) {
if ($search!==""){
  echo '<p class="centered_heading">Search results for <strong>' . htmlspecialchars($search) . '</strong></p>';
 }
  while ($row = mysqli_fetch_assoc($result)) {
    echo '<section class="job_section">';
    echo '<h2 class="heading">' . highlight($row['title'], $words_array) . '</h2>';
    echo '<p>Reference Number: ' . highlight($row['job_ref'], $words_array) . '</p>';
    echo '<p>Salary: ' . highlight($row['salary'], $words_array) . '</p>';
    echo '<p>Position Reports To: ' . highlight($row['reports_to'], $words_array) . '</p>';
    echo '<h3 class="heading">Description:</h3>';
    echo '<p> ' . highlight($row['description'], $words_array) . '</p>';
    echo '<h3 class="heading">Key Responsibilities:</h3>';
    echo '<ul>';
    $resp_items = explode("\n", $row['responsibilities']);
    foreach ($resp_items as $item) {
      if (trim($item) !== "") {
        echo '<li>' . highlight(trim($item), $words_array) . '</li>';
      }
    }
    echo '</ul>'; 

    echo '<h3>Essential and Preferable Requirements:</h3>';
    echo '<ol>';
    $req_items = explode("\n", $row['requirements']);
    foreach ($req_items as $item) {
      if (trim($item) !== "") {
        echo '<li>' . highlight(trim($item), $words_array) . '</li>';
      }
    }
    echo '</ol>';
    echo '<p><a href="apply.php?job_ref=' . htmlspecialchars($row['job_ref']) . '">Apply for this position</a></p>';
    echo '</section>';
  }
  }else {
    echo '<p class="centered_heading">No results found for <strong>' . htmlspecialchars($search) . '</strong></p>';
  }
  mysqli_close($dbconn);
} else {
  echo '<p>Unable to connect to the database</p>';
}
?>

<div style="clear: both;"></div>
<p class="centered_heading"><a href="index.php">Back to Home</a> | <a href="jobs.php">View all jobs</a></p>
</main>

<?php
include('inc/footer.inc');
?>


