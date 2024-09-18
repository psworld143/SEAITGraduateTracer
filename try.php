<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">

<!-- Template Main CSS File -->
<link href="assets/css/survey.css" rel="stylesheet">

<body>

    <form id="regForm" action="/action_page.php">
        <div class="title-card">
            <div class="title">
                <h1>SEAITGraduateTracer</h1>
                <p>Dear Graduate:</p>
                <p>Good day! Please complete this GTS questionnaire as accurately and frankly as posible by filling in
                    the
                    blank or checking the box corresponding to your response.
                    Your answer will be used for research purposes in order to asses graduate employability and
                    eventually,
                    improve cource offerings of your Alma Mater and other universities/colleges in the Phillipines.
                    Your answers to this survey will be treated with strictest confidentiality.
                </p>
            </div>
        </div>

        <!-- A -->
        <div class="tab">
            <h2>A. GENERAL INFORMATION</h2>

            <div class="row mb-3">
                <label for="name" class="col-sm-2 col-form-label">Question:</label>
                <div class="col-sm-10">
                    <input type="text" id="name" class="form-control" placeholder=" ">
                </div>
            </div>

        </div>

        <!-- B -->
        <div class="tab">
            <h2>B. EDUCATIONAL BACKGROUND</h2>

            <div class="row mb-3">
                <label for="name" class="col-sm-2 col-form-label">Question:</label>
                <div class="col-sm-10">
                    <input type="text" id="name" class="form-control" placeholder=" ">
                </div>
            </div>

        </div>

        <!-- C -->
        <div class="tab">
            <h2>C. TRAINING(S) AND ADVANCED STUDIES ATTENDED FOR COLLEGE</h2>

            <div class="row mb-3">
                <label for="name" class="col-sm-2 col-form-label">Question:</label>
                <div class="col-sm-10">
                    <input type="text" id="name" class="form-control" placeholder=" ">
                </div>
            </div>

        </div>

        <!-- D -->
        <div class="tab">
            <h2>D. EMPLOYMENT DATA</h2>

            <div class="row mb-3">
                <label for="name" class="col-sm-2 col-form-label">Question:</label>
                <div class="col-sm-10">
                    <input type="text" id="name" class="form-control" placeholder=" ">
                </div>
            </div>

        </div>

        <!-- END -->
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