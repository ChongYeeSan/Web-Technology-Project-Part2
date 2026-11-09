<?php 
require_once("settings.php");

include('inc/header.inc');
?>

    <!-- Page Heading and Sidebox -->
        <h2 id="job_description">Job Description</h2>
        <p class="centered_heading">"Grow Your Career Where Innovation Meets Impact"</p>
        <!-- search form -->
        <div class="search-container">
        <form method="GET" action="jobs.php">
            <label for="search">Job Title or Reference Id:</label>
            <input type="text" id="search" name="search" placeholder="Search job title or ref id" required><br>
            <input type="submit"value="Search">
        </form>
        </div>
        <br>
        
        <aside>
            <h3 class="heading">Diversity & Community Partnership</h3>
            <p>At Ecopower, We believe a sustainable future relies on diverse perspectives and strong community collaboration. We are committed to inclusive recruitment and proudly encourage applications from Aboriginal and Torres Strait Islander peoples.</p>
            <h3 class="heading" >Application FAQ</h3>
            <p>Have questions about hiring process? Contact HR at <a href="mailto:josuahr@ecopower.com">josuahr@ecopower.com</a></p>
            <h3 class="heading">Quick Links</h3>
            <ul>
                <li><a href="apply.php">Go to Application Page</a></li>
                <li><a href="about.php">Learn About Ecopower</a></li>
            </ul>
        </aside>
       
    <?php
    $dbconn = @mysqli_connect($host, $user, $pwd, $sql_db);
    if ($dbconn) {
        $search ="";
        if (isset($_GET['search'])) {
            $search = trim($_GET['search']);
        }
        if ($search !== ""){
            $search_escaped = mysqli_real_escape_string($dbconn, $search);
            $query = "SELECT * FROM jobs WHERE title LIKE '%$search_escaped%' OR description LIKE '%$search_escaped%' OR job_ref LIKE '%$search_escaped%'";
        } else {
            $query = "SELECT * FROM jobs";
        }

        $result = mysqli_query($dbconn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<section class="job_section">';
                echo '<h2 class="heading">' . $row['title'] . '</h2>';
                echo '<p>Reference Number: ' . $row['job_ref'] . '</p>';
                echo '<p>Salary: ' . $row['salary'] . '</p>';
                echo '<p>Position Reports To: ' . $row['reports_to'] . '</p>';
                echo '<h3 class="heading">Description:</h3>';
                echo '<p> ' . $row['description'] . '</p>';

                echo '<h3 class="heading">Key Responsibilities:</h3>';
                echo '<ul>';
                $resp_items = explode('. ', $row['responsibilities']);
                foreach ($resp_items as $item) {
                    if (trim($item) !== "") {
                        echo '<li>' . trim($item) . '.</li>';
                    }
                }
                echo '</ul>';

                echo '<h3>Essential and Preferable Requirements:</h3>';
                echo '<ol>';
                $req_items = explode('. ', $row['requirements']);
                foreach ($req_items as $item) {
                    if (trim($item) !== "") {
                        echo '<li>' . trim($item) . '.</li>';
                    }
                }
                echo '</ol>';

                echo '<p><a href="apply.php?job_ref=' . $row['job_ref'] . '">Apply for this position</a></p>';
                echo '</section>';

            }
        } else {
            echo '<p>No jobs found.</p>';
        }
        mysqli_close($dbconn);
    } else {
        echo '<p>Unable to connect to the database.</p>';
    }

    include('inc/footer.inc');
    ?>