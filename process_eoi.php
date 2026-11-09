<?php

require_once "settings.php";

$required_fields = ["jrefer", "fname", "lname", "dob", "address",
                    "suburb-town", "states", "pcode", "email", "pnum"];
                 
if ($_SERVER["REQUEST_METHOD"] !== "POST") { // checks how the page was accessed and if all fields are present
    header("Location: apply.php");
    exit();
}
foreach ($required_fields as $field) {
    if (!isset($_POST[$field])) {
        header("Location: apply.php");
        exit();
    }
}

function sanitise($data)
{
    $data = trim($data); // removes spaces at the start and end
    $data = stripslashes($data); // removes backslashes
    $data = htmlspecialchars($data); // turns special characters into harmless text
    return $data;
}
// reads the form values
$job_ref   = sanitise($_POST["jrefer"]);
$first     = sanitise($_POST["fname"]);
$last      = sanitise($_POST["lname"]);
$dob_input = sanitise($_POST["dob"]);
$gender    = isset($_POST["gender"]) ? sanitise($_POST["gender"]) : "";
$address   = sanitise($_POST["address"]);
$suburb    = sanitise($_POST["suburb-town"]);
$state     = sanitise($_POST["states"]);
$postcode  = sanitise($_POST["pcode"]);
$email     = sanitise($_POST["email"]);
$phone     = sanitise($_POST["pnum"]);
$other     = isset($_POST["others"]) ? sanitise($_POST["others"]) : "";

$skills_list = [];
foreach (["skills1", "skills2", "skills3", "skills4", "skills5", "skills6"] as $s) {
    if (isset($_POST[$s])) {
        $skills_list[] = sanitise($_POST[$s]);
    }
}
$skills = implode(", ", $skills_list);
// validate form values
$errors = [];
 
if (!preg_match("/^[A-Za-z0-9]{5}$/", $job_ref)) {
    $errors[] = "Job reference number must be exactly 5 alphanumeric characters.";
}
if (!preg_match("/^[A-Za-z ]{1,20}$/", $first)) {
    $errors[] = "First name must be 1 to 20 letters.";
}
if (!preg_match("/^[A-Za-z ]{1,20}$/", $last)) {
    $errors[] = "Last name must be 1 to 20 letters.";
}
 
/* Accepts dd/mm/yyyy, or yyyy-mm-dd (what <input type="date"> sends). */
$dob = "";
if (preg_match("#^(\d{2})/(\d{2})/(\d{4})$#", $dob_input, $m) && checkdate($m[2], $m[1], $m[3])) {
    $dob = $m[3] . "-" . $m[2] . "-" . $m[1];
} elseif (preg_match("#^(\d{4})-(\d{2})-(\d{2})$#", $dob_input, $m) && checkdate($m[2], $m[3], $m[1])) {
    $dob = $dob_input;
} else {
    $errors[] = "Date of birth must be a valid date (dd/mm/yyyy).";
}
 
if ($gender !== "Male" && $gender !== "Female") {
    $errors[] = "Please select a gender.";
}
if ($address === "" || strlen($address) > 40) {
    $errors[] = "Street address is required and must be at most 40 characters.";
}
if ($suburb === "" || strlen($suburb) > 40) {
    $errors[] = "Suburb/Town is required and must be at most 40 characters.";
}
$valid_states = ["victoria", "nsw", "qld", "nt", "wa", "sa", "tas", "act"];
if (!in_array($state, $valid_states)) {
    $errors[] = "Please choose a valid state.";
}
if (!preg_match("/^[0-9]{4}$/", $postcode)) {
    $errors[] = "Postcode must be exactly 4 digits.";
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Please enter a valid email address.";
}
if (!preg_match("/^[0-9]{8,12}$/", $phone)) {
    $errors[] = "Phone number must be 8 to 12 digits.";
}
 
/* Page output and errors */
$title = "Application Result";
include "header.inc"; //outputs the top of the page
echo "<main>";
 
if (!empty($errors)) {
    echo "<h2>Your application could not be submitted</h2><ul>";
    foreach ($errors as $error) {
        echo "<li>" . $error . "</li>";
    }
    echo "</ul><p><a href=\"apply.php\">Back to form</a></p>";
} else {

    $conn = @mysqli_connect($host, $user, $pwd, $sql_db);
 
    if (!$conn) {
        echo "<h2>Database connection failed</h2><p>Please try again later.</p>";
    } else {
        $create = "CREATE TABLE IF NOT EXISTS eoi ( 
            EOInumber      INT AUTO_INCREMENT PRIMARY KEY,
            job_ref        CHAR(5)      NOT NULL,
            first_name     VARCHAR(20)  NOT NULL,
            last_name      VARCHAR(20)  NOT NULL,
            dob            DATE         NOT NULL,
            gender         VARCHAR(10)  NOT NULL,
            street_address VARCHAR(40)  NOT NULL,
            suburb         VARCHAR(40)  NOT NULL,
            state          VARCHAR(10)  NOT NULL,
            postcode       CHAR(4)      NOT NULL,
            email          VARCHAR(100) NOT NULL,
            phone          VARCHAR(12)  NOT NULL,
            skills         VARCHAR(255),
            other_skills   TEXT,
            status         ENUM('New','Current','Final') NOT NULL DEFAULT 'New'
        )";
        mysqli_query($conn, $create); // runs create statement, question marks are placeholders and not real values
 
       
        $sql = "INSERT INTO eoi (job_ref, first_name, last_name, dob, gender,
                    street_address, suburb, state, postcode, email, phone,
                    skills, other_skills)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssssssssssss",
            $job_ref, $first, $last, $dob, $gender, $address, $suburb,
            $state, $postcode, $email, $phone, $skills, $other);
        // runs the insert statement and returns true if works
        if (mysqli_stmt_execute($stmt)) {
            $eoi_number = mysqli_insert_id($conn);
            echo "<h2>Thank you, " . $first . "!</h2>";
            echo "<p>Your application has been received.</p>";
            echo "<p>Your EOI number is <strong>" . $eoi_number . "</strong>.</p>";
        } else {
            echo "<h2>Something went wrong</h2><p>Your application was not saved.</p>";
        }
 
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
}
// closing
echo "</main>";
include "footer.inc";
?>