<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply</title>
    <link href="css/styles.css" rel="stylesheet">

</head>
<body class="apply-page">
    <header class="site-header">
        <div class="header-container navbar">
            <div class="brand-group">
                <img src="images/logo.png" alt="Ecopower Logo" class="logo-img">
                <h1 class="brand-title"> Ecopower</h1>
            </div>

            <nav class="nav-links-group">
                <a href="index.html">Home</a>
                <a href="jobs.html">Job Description</a> 
                <a href="apply.html">Apply</a> 
                <a href="about.html">About</a> 
                <a href="apply.html#application-form" class="btn-green">Apply Now!</a>
            </nav>
        </div>
    </header>

    <main>

        <h2 style="margin-bottom: 4px;">Submit Your Application</h2>
        <h2>Start Your Career in Sustainable Energy</h2>

        <br>
        <form id="application-form" class="form-group" action="https://mercury.swin.edu.au/it000000/formtest.php" method="post">
            <div class="form-group">
                <label for="jrefer">Job reference number:</label>
                <input type="text" id="jrefer" name="jrefer" pattern="[A-Za-z0-9]{5}" maxlength="5">
            </div>
            <br>
            <div class="form-group">
                <label for="fname">First name:</label>
                <input type="text" id="fname" name="fname" pattern="[A-Za-z ]+" maxlength="20" required>
            </div>
            <br>
            <div class="form-group">
                <label for="lname">Last name:</label>
                <input type="text" id="lname" name="lname" pattern="[A-Za-z ]+" maxlength="20" required>
            </div>
            <br>
            <div class="form-group">
                <label for="dob">Date of Birth:</label>
                <input type="date" id="dob" name="dob" required>
            </div>
            <br>

            <fieldset class="gender-fieldset">
                <legend>Gender:</legend>
                <div class="skill-item">
                    <input type="radio" id="male" name="gender" value="Male" required>
                    <label for="male">Male</label>
                </div>
                <div class="skill-item">
                    <input type="radio" id="female" name="gender" value="Female">
                    <label for="female">Female</label>
                </div>
            </fieldset>

            <br>
            <div class="form-group">
                <label for="address">Street Address:</label>
                <input type="text" id="address" name="address" maxlength="40" required>
            </div>
            <br>
            <div class="form-group">
                <label for="suburb-town">Suburb/Town:</label>
                <input type="text" id="suburb-town" name="suburb-town" maxlength="40" required>
            </div>
            <br>
            <div class="form-group">
                <label for="state">State:</label>
                <select name="states" id="state" required>
                    <option value="victoria">VIC</option>
                    <option value="nsw">NSW</option>
                    <option value="qld">QLD</option>
                    <option value="nt">NT</option>
                    <option value="wa">WA</option>
                    <option value="sa">SA</option>
                    <option value="tas">TAS</option>
                    <option value="act">ACT</option>
                </select>
            </div>

            <br>
            <div class="form-group">
                <label for="pcode">Postcode:</label>
                <input type="text" id="pcode" name="pcode" pattern= "[0-9]{4}" required>
            </div>
            <br>
            <div class="form-group">
                <label for="email">Email Address:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <br>
            <div class="form-group">
                <label for="pnum">Phone Number:</label>
                <input type="text" id="pnum" name="pnum" pattern="[0-9]{8,12}" placeholder="e.g. 0113456876" required>
            </div>
            <br>

            <fieldset class="form-group skills-fieldset">
                <legend>Skill list:</legend>
                <div class="skill-item">
                    <input type="checkbox" id="skills1" name="skills1" value="programming" checked>
                    <label for="skills1">Programming</label>
                </div>
                <div class="skill-item">
                    <input type="checkbox" id="skills2" name="skills2" value="data-entry">
                    <label for="skills2">Data Entry</label>
                </div>
                <div class="skill-item">
                    <input type="checkbox" id="skills3" name="skills3" value="data-analytics">
                    <label for="skills3">Data Analytics</label>
                </div>
                <div class="skill-item">
                    <input type="checkbox" id="skills4" name="skills4" value="communication">
                    <label for="skills4">Communication</label>
                </div>
                <div class="skill-item">
                    <input type="checkbox" id="skills5" name="skills5" value="teamwork">
                    <label for="skills5">Teamwork</label>
                </div>
                <div class="skill-item">
                    <input type="checkbox" id="skills6" name="skills6" value="time-management">
                    <label for="skills6">Time Management</label>
                </div>
            </fieldset>
            <br>
            <div class="form-group">
                <label for="others">Other skills:</label>
                <textarea id="others" name="others" rows="2"></textarea><br><br>
            </div>
            <br>
            <div class="form-group">
                <input type="submit" value="Submit"><br>
                <input type="reset" value="Reset Form">
            </div>
        </form>
    </main> 

    <footer class="site-footer">
        <div class="footer-container">
            <p>&copy; 2026 Ecopower. All rights reserved.</p>
            <p>
                <a href="https://cos10026group3.atlassian.net/jira/software/projects/SPRINT/boards/2/backlog" target="_blank">Jira Board</a> |
                <a href="https://github.com/ChongYeeSan/COS10026-Web_Technology_Project_Part1.git" target="_blank">Github Repository</a> |
                <a href="mailto:josuahr@ecopower.com">josuahr@ecopower.com</a>
            </p>
        </div>
    </footer>
</body>
</html>