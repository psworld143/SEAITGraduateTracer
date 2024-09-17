<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">

<!-- Template Main CSS File -->
<link href="assets/css/survey.css" rel="stylesheet">

<body>

    <form id="regForm" action="/action_page.php">
        <h1>SEAITGraduateTracer</h1>

        <div>
            <p>Dear Graduate:</p>
            <p>Good ady! Please complete this GTS questionnaire as accurately and frankly as posible by filling in the
                blank or checking the box corresponding to your response.
                Your answer will be used for research purposes in order to asses graduate employability and eventually,
                improve cource offerings of your Alma Mater and other universities/colleges in the Phillipines.
                Your answers to this survey will be treated with strictest confidentiality.</p>
        </div>
        <!-- One "tab" for each step in the form: -->
        <div class="tab">
            <h2>A. GENERAL INFORMATION </h2>
            <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Name:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Permanent Address:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Email Address:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Telephone/Contact:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Mobile Phone Number:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Civil Status</label>
                <div class="col-sm-10">
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Status</option>
                        <option value="1">Single</option>
                        <option value="2">Married</option>
                        <option value="3">Separated</option>
                        <option value="4">Single Parent </option>
                        <option value="5">Widow or Widower</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputDate" class="col-sm-2 col-form-label">Date</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Region of Origin</label>
                <div class="col-sm-10">
                    <select class="form-select" aria-label="Region of Origin">
                        <option selected>Select Region</option>
                        <option value="1">Region 1 - Ilocos Region</option>
                        <option value="2">Region 2 - Cagayan Valley</option>
                        <option value="3">Region 3 - Central Luzon</option>
                        <option value="4">Region 4A - CALABARZON</option>
                        <option value="5">Region 4B - MIMAROPA</option>
                        <option value="6">Region 5 - Bicol Region</option>
                        <option value="7">Region 6 - Western Visayas</option>
                        <option value="8">Region 7 - Central Visayas</option>
                        <option value="9">Region 8 - Eastern Visayas</option>
                        <option value="10">Region 9 - Zamboanga Peninsula</option>
                        <option value="11">Region 10 - Northern Mindanao</option>
                        <option value="12">Region 11 - Davao Region</option>
                        <option value="13">Region 12 - SOCCSKSARGEN</option>
                        <option value="14">Region 13 - Caraga</option>
                        <option value="15">BARMM - Bangsamoro Autonomous Region in Muslim Mindanao</option>
                        <option value="16">NCR - National Capital Region</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Province of Origin:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Location of Residendence:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Municipalities:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control">
                </div>
            </div>



        </div>
        <div class="tab">
            <h2>B. EDUCATIONAL BACKGROUND </h2>
            <div class="form-group">
                <label for="education">12. Educational Attainment (Baccalaureate Degree only)</label>
                <table>
                    <thead>
                        <tr>
                            <th>Degree(s) & Specialization</th>
                            <th>College or University</th>
                            <th>Year Graduated</th>
                            <th>Honor(s) or Award(s) Received</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" name="degree[]"></td>
                            <td><input type="text" name="college[]"></td>
                            <td><input type="text" name="year[]"></td>
                            <td><input type="text" name="honors[]"></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="degree[]"></td>
                            <td><input type="text" name="college[]"></td>
                            <td><input type="text" name="year[]"></td>
                            <td><input type="text" name="honors[]"></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="degree[]"></td>
                            <td><input type="text" name="college[]"></td>
                            <td><input type="text" name="year[]"></td>
                            <td><input type="text" name="honors[]"></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="form-group">
                <label for="skills">13. Professional Skills (Please specify)</label>
                <textarea id="skills" name="skills" rows="4"></textarea>
            </div>

            <div class="form-group">
                <label for="examinations">14. Professional Examination(s) Passed</label>
                <table>
                    <thead>
                        <tr>
                            <th>Name of Examination</th>
                            <th>Date Taken</th>
                            <th>Rating</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" name="exam[]"></td>
                            <td><input type="date" name="date[]"></td>
                            <td><input type="text" name="rating[]"></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="exam[]"></td>
                            <td><input type="date" name="date[]"></td>
                            <td><input type="text" name="rating[]"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                <label for="examinations">15. Reason(s) for having taken the course(s) or having pursued degree(s). You
                    may check (✓) more than one answer.</label>

                <table>
                    <thead>
                        <tr>
                            <th>Reason</th>
                            <th>Undergraduate/AB/BS</th>
                            <th>Graduate/MS/MA/PhD</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>High grades in the course or subject area(s) related to the course</td>
                            <td><input type="checkbox" name="undergrad_high_grades"></td>
                            <td><input type="checkbox" name="grad_high_grades"></td>
                        </tr>
                        <tr>
                            <td>Good grades in high school</td>
                            <td><input type="checkbox" name="undergrad_good_grades"></td>
                            <td><input type="checkbox" name="grad_good_grades"></td>
                        </tr>
                        <tr>
                            <td>Influence of parents or relatives</td>
                            <td><input type="checkbox" name="undergrad_parent_influence"></td>
                            <td><input type="checkbox" name="grad_parent_influence"></td>
                        </tr>
                        <tr>
                            <td>Peer influence</td>
                            <td><input type="checkbox" name="undergrad_peer_influence"></td>
                            <td><input type="checkbox" name="grad_peer_influence"></td>
                        </tr>
                        <tr>
                            <td>Inspired by a role model</td>
                            <td><input type="checkbox" name="undergrad_role_model"></td>
                            <td><input type="checkbox" name="grad_role_model"></td>
                        </tr>
                        <tr>
                            <td>Strong passion for the profession</td>
                            <td><input type="checkbox" name="undergrad_passion"></td>
                            <td><input type="checkbox" name="grad_passion"></td>
                        </tr>
                        <tr>
                            <td>Prospect for immediate employment</td>
                            <td><input type="checkbox" name="undergrad_employment"></td>
                            <td><input type="checkbox" name="grad_employment"></td>
                        </tr>
                        <tr>
                            <td>Status or prestige of the profession</td>
                            <td><input type="checkbox" name="undergrad_prestige"></td>
                            <td><input type="checkbox" name="grad_prestige"></td>
                        </tr>
                        <tr>
                            <td>Availability of course offering in chosen institution</td>
                            <td><input type="checkbox" name="undergrad_availability"></td>
                            <td><input type="checkbox" name="grad_availability"></td>
                        </tr>
                        <tr>
                            <td>Prospect of career advancement</td>
                            <td><input type="checkbox" name="undergrad_advancement"></td>
                            <td><input type="checkbox" name="grad_advancement"></td>
                        </tr>
                        <tr>
                            <td>Affordable for the family</td>
                            <td><input type="checkbox" name="undergrad_affordable"></td>
                            <td><input type="checkbox" name="grad_affordable"></td>
                        </tr>
                        <tr>
                            <td>Prospect of attractive compensation</td>
                            <td><input type="checkbox" name="undergrad_compensation"></td>
                            <td><input type="checkbox" name="grad_compensation"></td>
                        </tr>
                        <tr>
                            <td>Opportunity for employment abroad</td>
                            <td><input type="checkbox" name="undergrad_abroad"></td>
                            <td><input type="checkbox" name="grad_abroad"></td>
                        </tr>
                        <tr>
                            <td>No particular choice or no better idea</td>
                            <td><input type="checkbox" name="undergrad_no_choice"></td>
                            <td><input type="checkbox" name="grad_no_choice"></td>
                        </tr>
                        <tr>
                            <td>Others, please specify:</td>
                            <td><input type="text" name="other"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tab">
            <h2>C. TRAINING(S) ADVANCE STUDIES ATTENDED FOR COLLEGE</h2>
            <div class="form-group">
                <label for="education">12. Please list down all professional or work related training program(s)
                    including advance studies you have attended after college. You may use extra sheet if
                    needed.</label>
                <table>
                    <thead>
                        <tr>
                            <th>Title of Training or Advance Study</th>
                            <th>Duration and Credits Earned</th>
                            <th>Name of Training Institution/College/Univercity</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" name="degree[]"></td>
                            <td><input type="text" name="college[]"></td>
                            <td><input type="text" name="year[]"></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="degree[]"></td>
                            <td><input type="text" name="college[]"></td>
                            <td><input type="text" name="year[]"></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="degree[]"></td>
                            <td><input type="text" name="college[]"></td>
                            <td><input type="text" name="year[]"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="row mb-3">
                <legend class="col-form-label col-sm-2 pt-0">What made you pursue advnace studies?</legend>
                <div class="col-sm-10">

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck1">
                        <label class="form-check-label" for="gridCheck1">
                            For Promotion
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck2" checked>
                        <label class="form-check-label" for="gridCheck2">
                            For professional development
                        </label>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Others, please specify:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control">
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="tab">
            <h2>D. EMPLOYMENT DATA </h2>

        </div>
        <div style="overflow:auto;">
            <div style="float:right;">
                <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
            </div>
        </div>
        <!-- Circles which indicates the steps of the form: -->
        <div style="text-align:center;margin-top:40px;">
            <span class="step"></span>
            <span class="step"></span>
            <span class="step"></span>
            <span class="step"></span>
        </div>
    </form>

    <script>
    var currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the current tab

    function showTab(n) {
        // This function will display the specified tab of the form...
        var x = document.getElementsByClassName("tab");
        x[n].style.display = "block";
        //... and fix the Previous/Next buttons:
        if (n == 0) {
            document.getElementById("prevBtn").style.display = "none";
        } else {
            document.getElementById("prevBtn").style.display = "inline";
        }
        if (n == (x.length - 1)) {
            document.getElementById("nextBtn").innerHTML = "Submit";
        } else {
            document.getElementById("nextBtn").innerHTML = "Next";
        }
        //... and run a function that will display the correct step indicator:
        fixStepIndicator(n)
    }

    function nextPrev(n) {
        // This function will figure out which tab to display
        var x = document.getElementsByClassName("tab");
        // Exit the function if any field in the current tab is invalid:
        if (n == 1 && !validateForm()) return false;
        // Hide the current tab:
        x[currentTab].style.display = "none";
        // Increase or decrease the current tab by 1:
        currentTab = currentTab + n;
        // if you have reached the end of the form...
        if (currentTab >= x.length) {
            // ... the form gets submitted:
            document.getElementById("regForm").submit();
            return false;
        }
        // Otherwise, display the correct tab:
        showTab(currentTab);
    }

    function validateForm() {
        // This function deals with validation of the form fields
        var x, y, i, valid = true;
        x = document.getElementsByClassName("tab");
        y = x[currentTab].getElementsByTagName("input");
        // A loop that checks every input field in the current tab:
        for (i = 0; i < y.length; i++) {
            // If a field is empty...
            if (y[i].value == "") {
                // add an "invalid" class to the field:
                y[i].className += " invalid";
                // and set the current valid status to false
                valid = false;
            }
        }
        // If the valid status is true, mark the step as finished and valid:
        if (valid) {
            document.getElementsByClassName("step")[currentTab].className += " finish";
        }
        return valid; // return the valid status
    }

    function fixStepIndicator(n) {
        // This function removes the "active" class of all steps...
        var i, x = document.getElementsByClassName("step");
        for (i = 0; i < x.length; i++) {
            x[i].className = x[i].className.replace(" active", "");
        }
        //... and adds the "active" class on the current step:
        x[n].className += " active";
    }
    </script>

</body>

</html>