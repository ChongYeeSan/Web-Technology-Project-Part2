    <?php
    $title = "Apply";
    $body_class = "apply-page";
    include ('inc/header.inc');

    ?>

    <main>

        <h2 style="margin-bottom: 4px;">Submit Your Application</h2>
        <h2>Start Your Career in Sustainable Energy</h2>

        <br>
        <form id="application-form" class="form-group" action="process_eoi.php" method="post" novalidate>
            <div class="form-group">
                <label for="jrefer">Job reference number:</label>
                <input type="text" id="jrefer" name="jrefer">
            </div>
            <br>
            <div class="form-group">
                <label for="fname">First name:</label>
                <input type="text" id="fname" name="fname">
            </div>
            <br>
            <div class="form-group">
                <label for="lname">Last name:</label>
                <input type="text" id="lname" name="lname">
            </div>
            <br>
            <div class="form-group">
                <label for="dob">Date of Birth:</label>
                <input type="text" id="dob" name="dob" placeholder="dd/mm/yyyy">
            </div>
            <br>

            <fieldset class="gender-fieldset">
                <legend>Gender:</legend>
                <div class="skill-item">
                    <input type="radio" id="male" name="gender" value="Male">
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
                <input type="text" id="address" name="address">
            </div>
            <br>
            <div class="form-group">
                <label for="suburb-town">Suburb/Town:</label>
                <input type="text" id="suburb-town" name="suburb-town">
            </div>
            <br>
            <div class="form-group">
                <label for="state">State:</label>
                <select name="states" id="state">
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
                <input type="text" id="pcode" name="pcode">
            </div>
            <br>
            <div class="form-group">
                <label for="email">Email Address:</label>
                <input type="text" id="email" name="email">
            </div>
            <br>
            <div class="form-group">
                <label for="pnum">Phone Number:</label>
                <input type="text" id="pnum" name="pnum" placeholder="e.g. 0113456876">
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

    <?php 
    include ('inc/footer.inc'); 
    ?>