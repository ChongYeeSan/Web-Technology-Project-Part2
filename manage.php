<?php
session_start();
require_once("settings.php");

$dbconn = @mysqli_connect($host, $user, $pwd, $sql_db);
if (!$dbconn) {
    die("<p>Database connection failure.</p>");
}


if (isset($_GET['logout'])) {
    session_destroy();
    header("location: manage.php");
    exit();
}

$login_error = "";
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if(($username == "admin" && $password == "admin")) {
        $_SESSION['user'] = $username;
        header("location: manage.php");
        exit();
    } else {
        $login_error = "Invalid login. Try again.";
    }
}

include("inc/header.inc");
?>

<h2>HR Manager</h2>

<?php if (!isset($_SESSION['user'])): ?>
    <!-- Login Form -->
     <h3>Manager Login</h3>
     <?php if ($login_error !== ""): ?>
        <p><?php echo $login_error; ?></p>
    <?php endif; ?>
    
    <form method="post" action="manage.php">
        <label for="username">Username:</label>
        <input type="text" name="username"required><br>

        <label for="password">Password:</label>
        <input type="password"name="password"required><br>

        <input type="submit"value="Login">
    </form>
<?php else: ?> 
    <p>Welcome, <?php echo $_SESSION['user']; ?>
    <div style="text-align: right;">
        <a href="manage.php?logout=true">Logout</a></p>
    </div>
    <hr>

    <?php
    $message = "";

    if (isset($_POST['update_status'])) {
        $eoi_id = $_POST['eoi_id'];
        $new_status = $_POST['status'];
        $update_query = "UPDATE eoi SET status = '$new_status' WHERE EOInumber = $eoi_id";
        mysqli_query($dbconn, $update_query);
        $message = "Status update for EOI ID: " .$eoi_id;
    }

    if (isset($_POST['delete_job_ref'])) {
        $del_ref = trim($_POST['del_job_ref']);
        $delete_query = "DELETE FROM eoi WHERE job_ref = '$del_ref'";
        mysqli_query($dbconn, $delete_query);
        $message = "Deleted all records for Job Reference: " .$del_ref;
    }

    if ($message !== "") {
        echo '<p>' .$message . '</p>';
    }

    $job_ref = isset($_GET['job_ref']) ? trim($_GET['job_ref']) : "";
    $applicant_name = isset($_GET['applicant_name']) ? trim($_GET['applicant_name']) : "";
    $sort = isset($_GET['sort']) ? trim($_GET['sort']) : "EOInumber";

    if ($job_ref !== "" && $applicant_name !== "") {
        $query = "SELECT * FROM eoi WHERE job_ref LIKE '%$job_ref%' AND (first_name LIKE '%$applicant_name%' OR last_name LIKE '%$applicant_name%') ORDER BY $sort ASC";
    } elseif ($job_ref !== "") {
        $query = "SELECT * FROM eoi WHERE job_ref LIKE '%$job_ref%' ORDER BY $sort ASC";
    }elseif ($applicant_name !== "") {
        $query = "SELECT * FROM eoi WHERE first_name LIKE '%$applicant_name%' OR last_name LIKE '%$applicant_name%' ORDER BY $sort ASC";
    } else {
        $query = "SELECT *FROM eoi ORDER BY $sort ASC";
    }

    $result = mysqli_query($dbconn, $query);
    ?>

    <!-- Search / Filter form  -->
     <h3>Search and Sort EOI</h3>
     <form method="get" action="manage.php">
        <label for="job_ref">Job Reference:</label>
        <input type="text" id="job_ref" name="job_ref" value="<?php echo ($job_ref); ?>">

        <label for="applicant_name">Applicant Name:</label>
        <input type="text" id="applicant_name" name="applicant_name" value="<?php echo $applicant_name; ?>">

        <label for="sort">Sort By:</label>
        <select id="sort" name="sort">
            <option value="EOInumber" <?php if($sort == "EOInumber") echo "selected"; ?> >EOI ID</option>
            <option value="job_ref" <?php if($sort == "job_ref") echo "selected"; ?> >Job Reference</option>
            <option value="first_name" <?php if($sort == "first_name") echo "selected"; ?> >First Name</option>
            <option value="last_name" <?php if($sort == "last_name") echo "selected"; ?> >Last Name</option>
            <option value="status" <?php if($sort == "status") echo "selected"; ?> >Status</option>
        </select>

        <input type="submit" value="Filter">
        <a href="manage.php">Reset</a>
     </form>
     <br>

     <!-- Delete Form  -->
      <h3>Delete by Jn Reference</h3>
      <form method="post" action="manage.php">
        <label for="del_job_ref">Job Reference:</label>
        <input type="text" id="del_job_ref" name="del_job_ref" required>
        <input type="submit" name="delete_job_ref" value="Delete">
      </form>
      <br>

      <!-- Results -->
       <h3>Expressions of Interest List</h3>
       <?php
       if ($result) {
        if (mysqli_num_rows($result) > 0) {
            echo "<table border='1'>";
            echo "<tr><th>EOI ID</th><th>Job Ref</th><th>Name</th><th>Email</th><th>Phone</th><th>Skills</th><th>Status</th></tr>";

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['EOInumber'] . "</td>";
                echo "<td>" . $row['job_ref'] . "</td>";
                echo "<td>" . $row['first_name'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['phone'] . "</td>";
                echo "<td>" . $row['skills'] . "</td>";
                echo "<td>";
                echo '<form method="post" action="manage.php">';
                echo '<input type="hidden" name="eoi_id" value="' . $row['EOInumber'] . '">';
                echo '<select name="status">';
                echo '<option value="New" ' . ($row['status']== 'New' ? 'selected' : '') . '>New</option>';
                echo '<option value="Current" ' . ($row['status']== 'Current' ? 'selected' : '') . '>Current</option>';
                echo '<option value="Final" ' . ($row['status']== 'Final' ? 'selected' : '') . '>Final</option>';
                echo '</select>';
                echo '<input type="submit" name="update_status" value="update">';
                echo '</form>';
                echo "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "<p>No records found.</p>";
        }
       } else {
        echo "<p>Error in query session.</p>";
       }
       ?>
<?php endif; ?>

<?php
mysqli_close($dbconn);
include("inc/footer.inc");
?>