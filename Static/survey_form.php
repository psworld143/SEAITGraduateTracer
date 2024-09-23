<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>About Us - SEAIT</title>
    <meta content="About SEAIT, history, mission, and vision" name="description">
    <meta content="SEAIT, education, history" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600|Poppins:300,400,500,600" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/static.css" rel="stylesheet">
    <link href="assets/css/alumni.css" rel="stylesheet">



</head>

<body>
    <?php include('inc/header.php'); ?>
    <main>
        <div class="container-sm">

        </div>

                        <form id="regForm" action="/action_page.php">
                            <div class="title-card">
                                <div class="title">
                                    <h1>SEAITGraduateTracer</h1>
                                    <p>Dear Graduate:</p>
                                    <p>Good day! Please complete this GTS questionnaire as accurately and frankly as
                                        posible by filling in
                                        the
                                        blank or checking the box corresponding to your response.
                                        Your answer will be used for research purposes in order to asses graduate
                                        employability and
                                        eventually,
                                        improve cource offerings of your Alma Mater and other universities/colleges in
                                        the Phillipines.
                                        Your answers to this survey will be treated with strictest confidentiality.
                                    </p>
                                </div>
                            </div>

                            <!-- A -->
                            <div class="tab">
                                <h2>A. GENERAL INFORMATION</h2>

                                <div class="row mb-3">
                                    <label for="name" class="col-sm-2 col-form-label">Name:</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="name" class="form-control"
                                            placeholder="Enter your full name">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="permanentAddress" class="col-sm-2 col-form-label">Permanent
                                        Address:</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="permanentAddress" class="form-control"
                                            placeholder="Enter your permanent address">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="emailAddress" class="col-sm-2 col-form-label">Email Address:</label>
                                    <div class="col-sm-10">
                                        <input type="email" id="emailAddress" class="form-control"
                                            placeholder="Enter your email address">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="telephoneContact"
                                        class="col-sm-2 col-form-label">Telephone/Contact:</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="telephoneContact" class="form-control"
                                            placeholder="Enter your telephone number">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="mobilePhoneNumber" class="col-sm-2 col-form-label">Mobile Phone
                                        Number:</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="mobilePhoneNumber" class="form-control"
                                            placeholder="Enter your mobile phone number">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="civilStatus" class="col-sm-2 col-form-label">Civil Status:</label>
                                    <div class="col-sm-10">
                                        <select id="civilStatus" class="form-select" aria-label="Civil Status">
                                            <option selected>Select Status</option>
                                            <option value="1">Single</option>
                                            <option value="2">Married</option>
                                            <option value="3">Separated</option>
                                            <option value="4">Single Parent</option>
                                            <option value="5">Widow or Widower</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="date" class="col-sm-2 col-form-label">Date:</label>
                                    <div class="col-sm-10">
                                        <input type="date" id="date" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="regionOfOrigin" class="col-sm-2 col-form-label">Region of
                                        Origin:</label>
                                    <div class="col-sm-10">
                                        <select id="regionOfOrigin" class="form-select" aria-label="Region of Origin">
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
                                            <option value="15">BARMM - Bangsamoro Autonomous Region in Muslim Mindanao
                                            </option>
                                            <option value="16">NCR - National Capital Region</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="provinceOfOrigin" class="col-sm-2 col-form-label">Province of
                                        Origin:</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="provinceOfOrigin" class="form-control"
                                            placeholder="Enter your province of origin">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="locationOfResidence" class="col-sm-2 col-form-label">Location of
                                        Residence:</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="locationOfResidence" class="form-control"
                                            placeholder="Enter your location of residence">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="municipalities" class="col-sm-2 col-form-label">Municipalities:</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="municipalities" class="form-control"
                                            placeholder="Enter your municipality">
                                    </div>
                                </div>
                            </div>



                            <!-- B -->
                            <div class="tab">
                                <h2>B. EDUCATIONAL BACKGROUND</h2>

                                <div class="form-group">
                                    <label for="education">Educational Attainment (Baccalaureate Degree only)</label>

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
                                                <td><input type="text" id="degree1" name="degree[]"
                                                        placeholder="Enter Degree"></td>
                                                <td><input type="text" id="college1" name="college[]"
                                                        placeholder="Enter College/University"></td>
                                                <td><input type="text" id="year1" name="year[]"
                                                        placeholder="Enter Year"></td>
                                                <td><input type="text" id="honors1" name="honors[]"
                                                        placeholder="Enter Honors/Awards"></td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" id="degree2" name="degree[]"
                                                        placeholder="Enter Degree"></td>
                                                <td><input type="text" id="college2" name="college[]"
                                                        placeholder="Enter College/University"></td>
                                                <td><input type="text" id="year2" name="year[]"
                                                        placeholder="Enter Year"></td>
                                                <td><input type="text" id="honors2" name="honors[]"
                                                        placeholder="Enter Honors/Awards"></td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" id="degree3" name="degree[]"
                                                        placeholder="Enter Degree"></td>
                                                <td><input type="text" id="college3" name="college[]"
                                                        placeholder="Enter College/University"></td>
                                                <td><input type="text" id="year3" name="year[]"
                                                        placeholder="Enter Year"></td>
                                                <td><input type="text" id="honors3" name="honors[]"
                                                        placeholder="Enter Honors/Awards"></td>
                                            </tr>
                                            <!-- Add more rows as needed -->
                                        </tbody>
                                    </table>
                                </div>

                                <div class="form-group">
                                    <label for="skills">Professional Skills (Please specify)</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="skills" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="examinations">Professional Examination(s) Passed</label>
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
                                                <td><input type="text" id="exam1" name="exam[]"
                                                        placeholder="Enter Examination Name"></td>
                                                <td><input type="date" id="date1" name="date[]"></td>
                                                <td><input type="text" id="rating1" name="rating[]"
                                                        placeholder="Enter Rating"></td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" id="exam2" name="exam[]"
                                                        placeholder="Enter Examination Name"></td>
                                                <td><input type="date" id="date2" name="date[]"></td>
                                                <td><input type="text" id="rating2" name="rating[]"
                                                        placeholder="Enter Rating"></td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" id="exam3" name="exam[]"
                                                        placeholder="Enter Examination Name"></td>
                                                <td><input type="date" id="date3" name="date[]"></td>
                                                <td><input type="text" id="rating3" name="rating[]"
                                                        placeholder="Enter Rating"></td>
                                            </tr>
                                            <!-- Add more rows as needed -->
                                        </tbody>
                                    </table>
                                </div>

                                <div class="form-group">
                                    <label for="reasons">Reason(s) for having taken the course(s) or having pursued
                                        degree(s). You may check
                                        (✓) more than one answer.</label>

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
                                                <td>High grades in the course or subject area(s) related to the course
                                                </td>
                                                <td><input type="checkbox" id="undergrad_high_grades"
                                                        name="undergrad_high_grades"></td>
                                                <td><input type="checkbox" id="grad_high_grades"
                                                        name="grad_high_grades"></td>
                                            </tr>
                                            <tr>
                                                <td>Good grades in high school</td>
                                                <td><input type="checkbox" id="undergrad_good_grades"
                                                        name="undergrad_good_grades"></td>
                                                <td><input type="checkbox" id="grad_good_grades"
                                                        name="grad_good_grades"></td>
                                            </tr>
                                            <tr>
                                                <td>Influence of parents or relatives</td>
                                                <td><input type="checkbox" id="undergrad_parent_influence"
                                                        name="undergrad_parent_influence"></td>
                                                <td><input type="checkbox" id="grad_parent_influence"
                                                        name="grad_parent_influence"></td>
                                            </tr>
                                            <tr>
                                                <td>Peer influence</td>
                                                <td><input type="checkbox" id="undergrad_peer_influence"
                                                        name="undergrad_peer_influence">
                                                </td>
                                                <td><input type="checkbox" id="grad_peer_influence"
                                                        name="grad_peer_influence"></td>
                                            </tr>
                                            <tr>
                                                <td>Inspired by a role model</td>
                                                <td><input type="checkbox" id="undergrad_role_model"
                                                        name="undergrad_role_model"></td>
                                                <td><input type="checkbox" id="grad_role_model" name="grad_role_model">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Strong passion for the profession</td>
                                                <td><input type="checkbox" id="undergrad_passion"
                                                        name="undergrad_passion"></td>
                                                <td><input type="checkbox" id="grad_passion" name="grad_passion"></td>
                                            </tr>
                                            <tr>
                                                <td>Prospect for immediate employment</td>
                                                <td><input type="checkbox" id="undergrad_employment"
                                                        name="undergrad_employment"></td>
                                                <td><input type="checkbox" id="grad_employment" name="grad_employment">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Status or prestige of the profession</td>
                                                <td><input type="checkbox" id="undergrad_prestige"
                                                        name="undergrad_prestige"></td>
                                                <td><input type="checkbox" id="grad_prestige" name="grad_prestige"></td>
                                            </tr>
                                            <tr>
                                                <td>Availability of course offering in chosen institution</td>
                                                <td><input type="checkbox" id="undergrad_availability"
                                                        name="undergrad_availability"></td>
                                                <td><input type="checkbox" id="grad_availability"
                                                        name="grad_availability"></td>
                                            </tr>
                                            <tr>
                                                <td>Prospect of career advancement</td>
                                                <td><input type="checkbox" id="undergrad_advancement"
                                                        name="undergrad_advancement"></td>
                                                <td><input type="checkbox" id="grad_advancement"
                                                        name="grad_advancement"></td>
                                            </tr>
                                            <tr>
                                                <td>Affordable for the family</td>
                                                <td><input type="checkbox" id="undergrad_affordable"
                                                        name="undergrad_affordable"></td>
                                                <td><input type="checkbox" id="grad_affordable" name="grad_affordable">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Prospect of attractive compensation</td>
                                                <td><input type="checkbox" id="undergrad_compensation"
                                                        name="undergrad_compensation"></td>
                                                <td><input type="checkbox" id="grad_compensation"
                                                        name="grad_compensation"></td>
                                            </tr>
                                            <tr>
                                                <td>Opportunity for employment abroad</td>
                                                <td><input type="checkbox" id="undergrad_abroad"
                                                        name="undergrad_abroad"></td>
                                                <td><input type="checkbox" id="grad_abroad" name="grad_abroad"></td>
                                            </tr>
                                            <tr>
                                                <td>No particular choice or no better idea</td>
                                                <td><input type="checkbox" id="undergrad_no_choice"
                                                        name="undergrad_no_choice"></td>
                                                <td><input type="checkbox" id="grad_no_choice" name="grad_no_choice">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Others, please specify:</td>
                                                <td colspan="2"><input type="text" id="other_reasons" name="other"
                                                        placeholder="Specify other reasons"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>


                            <!-- C -->
                            <div class="tab">
                                <h2>C. TRAINING(S) AND ADVANCED STUDIES ATTENDED FOR COLLEGE</h2>

                                <div class="form-group">
                                    <label for="training_table">Please list down all professional or work-related
                                        training program(s),
                                        including advanced studies, you have attended after college. You may use an
                                        extra sheet if
                                        needed.</label>
                                    <table id="training_table">
                                        <thead>
                                            <tr>
                                                <th>Title of Training or Advanced Study</th>
                                                <th>Duration and Credits Earned</th>
                                                <th>Name of Training Institution/College/University</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><input type="text" id="training_title1" name="training_title[]"
                                                        placeholder="Enter Title"></td>
                                                <td><input type="text" id="duration_credits1" name="duration_credits[]"
                                                        placeholder="Enter Duration and Credits"></td>
                                                <td><input type="text" id="institution1" name="institution[]"
                                                        placeholder="Enter Institution/College/University"></td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" id="training_title2" name="training_title[]"
                                                        placeholder="Enter Title"></td>
                                                <td><input type="text" id="duration_credits2" name="duration_credits[]"
                                                        placeholder="Enter Duration and Credits"></td>
                                                <td><input type="text" id="institution2" name="institution[]"
                                                        placeholder="Enter Institution/College/University"></td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" id="training_title3" name="training_title[]"
                                                        placeholder="Enter Title"></td>
                                                <td><input type="text" id="duration_credits3" name="duration_credits[]"
                                                        placeholder="Enter Duration and Credits"></td>
                                                <td><input type="text" id="institution3" name="institution[]"
                                                        placeholder="Enter Institution/College/University"></td>
                                            </tr>
                                            <!-- Add more rows as needed -->
                                        </tbody>
                                    </table>
                                </div>

                                <div class="row mb-3">
                                    <legend class="col-form-label">What made you pursue advanced studies?</legend>
                                    <div class="col-sm-10">
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" id="promotion"
                                                    name="motivation" value="promotion">
                                                <label class="form-check-label" for="promotion">For promotion</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio"
                                                    id="professional_development" name="motivation"
                                                    value="professional_development">
                                                <label class="form-check-label" for="professional_development">For
                                                    professional
                                                    development</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" id="other"
                                                    name="motivation" value="other">
                                                <label class="form-check-label" for="other">Others, please
                                                    specify:</label>
                                                <input type="text" id="other_motivation" name="other_motivation"
                                                    class="form-control" placeholder="Specify other motivations">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>


                            <!-- D -->
                            <div class="tab">
                                <h2>D. EMPLOYMENT DATA</h2>

                                <div class="row mb-3">
                                    <legend class="col-form-label col-sm-2 pt-0">Are you presently employed?</legend>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="employed-yes"
                                                name="employment_status" value="yes">
                                            <label class="form-check-label" for="employed-yes">Yes</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="employed-no"
                                                name="employment_status" value="no">
                                            <label class="form-check-label" for="employed-no">No</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="employed-never"
                                                name="employment_status" value="never">
                                            <label class="form-check-label" for="employed-never">Never Employed</label>
                                        </div>
                                        <p>If NO or NEVER EMPLOYED, proceed to Question 18.</p>
                                        <p>If YES, proceed to Question 19-23.</p>
                                    </div>
                                </div>
                                <br>
                                <div class="question">
                                    <label>Please state reason(s) why you are not yet employed. You may check (✓) more
                                        than one
                                        answer.</label>
                                    <div class="checkbox-group">
                                        <label><input type="checkbox" name="reason_not_employed[]"
                                                value="advanced_study"> Advance or
                                            Further Study</label>
                                        <label><input type="checkbox" name="reason_not_employed[]"
                                                value="family_concern"> Family Concern
                                            and Decided Not to Find a Job</label>
                                        <label><input type="checkbox" name="reason_not_employed[]"
                                                value="health_related"> Health Related
                                            Reason(s)</label>
                                        <label><input type="checkbox" name="reason_not_employed[]"
                                                value="lack_of_experience"> Lack of Work
                                            Experience</label>
                                        <label><input type="checkbox" name="reason_not_employed[]"
                                                value="no_job_opportunity"> No Job
                                            Opportunity</label>
                                        <label><input type="checkbox" name="reason_not_employed[]"
                                                value="did_not_look_for_job"> Did Not
                                            Look for a Job</label>
                                        <label><input type="checkbox" name="reason_not_employed[]" value="other"> Other
                                            Reason(s), please
                                            specify:</label>
                                        <input type="text" name="reason_not_employed_other"
                                            placeholder="Specify other reasons">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <legend class="col-form-label col-sm-2 pt-0">Present Employment Status</legend>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="status-regular"
                                                name="employment_status_current" value="regular">
                                            <label class="form-check-label" for="status-regular">Regular or
                                                Permanent</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="status-temporary"
                                                name="employment_status_current" value="temporary">
                                            <label class="form-check-label" for="status-temporary">Temporary</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="status-casual"
                                                name="employment_status_current" value="casual">
                                            <label class="form-check-label" for="status-casual">Casual</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="status-contractual"
                                                name="employment_status_current" value="contractual">
                                            <label class="form-check-label" for="status-contractual">Contractual</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="status-self-employed"
                                                name="employment_status_current" value="self_employed">
                                            <label class="form-check-label"
                                                for="status-self-employed">Self-employed</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="status-unemployed"
                                                name="employment_status_current" value="unemployed">
                                            <label class="form-check-label" for="status-unemployed">Unemployed</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="current-occupation" class="col-sm-2 col-form-label">Present Occupation
                                        (e.g., Grade School
                                        Teacher, Electrical Engineer, Self-employed)</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="current-occupation" name="current_occupation"
                                            class="form-control" placeholder="Enter Occupation">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="company-name" class="col-sm-2 col-form-label">Name of Company or
                                        Organization Including
                                        Address</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="company-name" name="company_name" class="form-control"
                                            placeholder="Enter Company Name and Address">
                                    </div>
                                </div>

                                <div class="question">
                                    <label for="place-of-work-local">Place of Work:</label>
                                    <input type="text" id="place-of-work-local" name="place_of_work_local"
                                        placeholder="Local">
                                    <input type="text" id="place-of-work-abroad" name="place_of_work_abroad"
                                        placeholder="Abroad">
                                </div>

                                <div class="row mb-3">
                                    <label>Is this your first job after college?</label>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="yes" name="yes"
                                                value="regular">
                                            <label class="form-check-label" for="yes">Yes</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="no" name="no"
                                                value="temporary">
                                            <label class="form-check-label" for="no">No</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="question">
                                    <label>What are your reason(s) for staying on the job? You may check (✓) more than
                                        one
                                        answer.</label>
                                    <div class="checkbox-group">
                                        <label><input type="checkbox" name="reason_staying[]" value="salaries"> Salaries
                                            and
                                            Benefits</label>
                                        <label><input type="checkbox" name="reason_staying[]" value="career_challenge">
                                            Career
                                            Challenge</label>
                                        <label><input type="checkbox" name="reason_staying[]" value="special_skill">
                                            Related to Special
                                            Skill</label>
                                        <label><input type="checkbox" name="reason_staying[]" value="course_related">
                                            Related to Course or
                                            Program of Study</label>
                                        <label><input type="checkbox" name="reason_staying[]" value="proximity">
                                            Proximity to
                                            Residence</label>
                                        <label><input type="checkbox" name="reason_staying[]" value="peer_influence">
                                            Peer Influence</label>
                                        <label><input type="checkbox" name="reason_staying[]" value="family_influence">
                                            Family
                                            Influence</label>
                                        <label><input type="checkbox" name="reason_staying[]" value="other"> Other
                                            Reason(s), please
                                            specify:</label>
                                        <input type="text" name="reason_staying_other" placeholder="Other reason(s)">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label>Is your first job related to the course you took up in college?</label>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="yes" name="yes"
                                                value="regular">
                                            <label class="form-check-label" for="yes">Yes</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="no" name="no"
                                                value="temporary">
                                            <label class="form-check-label" for="no">No</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="question">
                                    <label>What were your reasons for accepting the job? You may check (✓) more than one
                                        answer.</label>
                                    <div class="checkbox-group">
                                        <label><input type="checkbox" name="reason_accepting[]" value="salaries">
                                            Salaries and
                                            Benefits</label>
                                        <label><input type="checkbox" name="reason_accepting[]"
                                                value="career_challenge"> Career
                                            Challenge</label>
                                        <label><input type="checkbox" name="reason_accepting[]" value="special_skills">
                                            Related to Special
                                            Skills</label>
                                        <label><input type="checkbox" name="reason_accepting[]" value="proximity">
                                            Proximity to
                                            Residence</label>
                                        <label><input type="checkbox" name="reason_accepting[]" value="other"> Other
                                            Reason(s), please
                                            specify:</label>
                                        <input type="text" name="reason_accepting_other" placeholder="Other reason(s)">
                                    </div>
                                </div>

                                <div class="question">
                                    <label>What were your reasons for changing jobs? You may check (✓) more than one
                                        answer.</label>
                                    <div class="checkbox-group">
                                        <label><input type="checkbox" name="reason_changing[]" value="salaries">
                                            Salaries and
                                            Benefits</label>
                                        <label><input type="checkbox" name="reason_changing[]" value="career_challenge">
                                            Career
                                            Challenge</label>
                                        <label><input type="checkbox" name="reason_changing[]" value="special_skills">
                                            Related to Special
                                            Skills</label>
                                        <label><input type="checkbox" name="reason_changing[]" value="proximity">
                                            Proximity to
                                            Residence</label>
                                        <label><input type="checkbox" name="reason_changing[]" value="other"> Other
                                            Reason(s), please
                                            specify:</label>
                                        <input type="text" name="reason_changing_other" placeholder="Other reason(s)">
                                    </div>
                                </div>

                                <div class="question">
                                    <label for="first-job-duration">How long did you stay in your first job?</label>
                                    <select id="first-job-duration" name="first_job_duration">
                                        <option value="">Select an option</option>
                                        <option value="less_than_month">Less than a month</option>
                                        <option value="1_6_months">1 to 6 months</option>
                                        <option value="7_11_months">7 to 11 months</option>
                                        <option value="1_2_years">1 year to less than 2 years</option>
                                        <option value="2_3_years">2 years to less than 3 years</option>
                                        <option value="3_4_years">3 years to less than 4 years</option>
                                        <option value="others">Others, please specify:</option>
                                    </select>
                                    <input type="text" id="first-job-duration-other" name="first_job_duration_other"
                                        placeholder="Other duration">
                                </div>

                                <div class="question">
                                    <label>How did you find your first job?</label>
                                    <div class="checkbox-group">
                                        <label for="job-finding-advertisement"><input type="checkbox"
                                                id="job-finding-advertisement" name="job_finding_method[]"
                                                value="advertisement"> Response to an Advertisement</label>
                                        <label for="job-finding-walk-in"><input type="checkbox" id="job-finding-walk-in"
                                                name="job_finding_method[]" value="walk_in"> As Walk-In
                                            Applicant</label>
                                        <label for="job-finding-recommended"><input type="checkbox"
                                                id="job-finding-recommended" name="job_finding_method[]"
                                                value="recommended"> Recommended by Someone</label>
                                        <label for="job-finding-information"><input type="checkbox"
                                                id="job-finding-information" name="job_finding_method[]"
                                                value="information"> Information from Friends</label>
                                        <label for="job-finding-arranged"><input type="checkbox"
                                                id="job-finding-arranged" name="job_finding_method[]" value="arranged">
                                            Arranged by School's Job Placement
                                            Officer</label>
                                        <label for="job-finding-family"><input type="checkbox" id="job-finding-family"
                                                name="job_finding_method[]" value="family"> Family Business</label>
                                        <label for="job-finding-job-fair"><input type="checkbox"
                                                id="job-finding-job-fair" name="job_finding_method[]" value="job_fair">
                                            Job Fair or Public Employment Service Office
                                            (PESO)</label>
                                        <label for="job-finding-others"><input type="checkbox" id="job-finding-others"
                                                name="job_finding_method[]" value="others"> Others, please
                                            specify:</label>
                                        <input type="text" id="job-finding-method-other" name="job_finding_method_other"
                                            placeholder="Other method">
                                    </div>
                                </div>

                                <div class="question">
                                    <label for="time-to-first-job">How long did it take you to land your first
                                        job?</label>
                                    <select id="time-to-first-job" name="time_to_first_job">
                                        <option value="">Select an option</option>
                                        <option value="less_than_month">Less than a month</option>
                                        <option value="1_6_months">1 to 6 months</option>
                                        <option value="7_11_months">7 to 11 months</option>
                                        <option value="1_2_years">1 year to less than 2 years</option>
                                        <option value="2_3_years">2 years to less than 3 years</option>
                                        <option value="3_4_years">3 years to less than 4 years</option>
                                        <option value="others">Others, please specify:</option>
                                    </select>
                                    <input type="text" id="time-to-first-job-other" name="time_to_first_job_other"
                                        placeholder="Other duration">
                                </div>

                                <div class="question">
                                    <label for="first-job">Job Position:</label>
                                    <input type="text" id="first-job" name="first_job" placeholder="First job">
                                    <input type="text" id="current-job" name="current_job"
                                        placeholder="Current or Present Job">
                                </div>

                                <div class="question">
                                    <label for="initial-earning">32. What is your initial gross monthly earning in your
                                        first job after
                                        college?</label>
                                    <input type="number" id="initial-earning" name="initial_earning"
                                        placeholder="Enter amount">
                                </div>

                                <div class="row mb-3">
                                    <label>Was the curriculum you had in college relevant to your first job?</label>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="yes" name="yes"
                                                value="regular">
                                            <label class="form-check-label" for="yes">Yes</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="no" name="no"
                                                value="temporary">
                                            <label class="form-check-label" for="no">No</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="question">
                                    <label>If YES, what competencies learned in college did you find very useful in your
                                        first job? You
                                        may check (✓) more than one answer.</label>
                                    <div class="checkbox-group">
                                        <label for="competencies-communication"><input type="checkbox"
                                                id="competencies-communication" name="useful_competencies[]"
                                                value="communication"> Communication skills</label>
                                        <label for="competencies-human-relations"><input type="checkbox"
                                                id="competencies-human-relations" name="useful_competencies[]"
                                                value="human_relations"> Human Relations skills</label>
                                        <label for="competencies-entrepreneurial"><input type="checkbox"
                                                id="competencies-entrepreneurial" name="useful_competencies[]"
                                                value="entrepreneurial"> Entrepreneurial skills</label>
                                        <label for="competencies-it"><input type="checkbox" id="competencies-it"
                                                name="useful_competencies[]" value="it"> Information Technology
                                            skills</label>
                                        <label for="competencies-problem-solving"><input type="checkbox"
                                                id="competencies-problem-solving" name="useful_competencies[]"
                                                value="problem_solving"> Problem-solving skills</label>
                                        <label for="competencies-critical-thinking"><input type="checkbox"
                                                id="competencies-critical-thinking" name="useful_competencies[]"
                                                value="critical_thinking">
                                            Critical Thinking skills</label>
                                        <label for="competencies-other"><input type="checkbox" id="competencies-other"
                                                name="useful_competencies[]" value="other"> Other reason(s), please
                                            specify:</label>
                                        <input type="text" id="useful-competencies-other"
                                            name="useful_competencies_other" placeholder="Other competencies">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="curriculum-improvement">List down suggestions to further improve your
                                        course
                                        curriculum:</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="curriculum-improvement" class="form-control">
                                    </div>
                                </div>

                                <div class="question">
                                    <label>What values did you learn from your Alma Mater that you have been practicing
                                        in your life and
                                        at work? You may check (✓) more than one answer.</label>
                                    <div class="checkbox-group">
                                        <label for="values-family-spirit"><input type="checkbox"
                                                id="values-family-spirit" name="values_learned[]" value="family_spirit">
                                            Family spirit</label>
                                        <label for="values-presence"><input type="checkbox" id="values-presence"
                                                name="values_learned[]" value="presence"> Presence</label>
                                        <label for="values-marian"><input type="checkbox" id="values-marian"
                                                name="values_learned[]" value="marian"> Marian</label>
                                        <label for="values-honesty"><input type="checkbox" id="values-honesty"
                                                name="values_learned[]" value="honesty"> Honesty</label>
                                        <label for="values-preference"><input type="checkbox" id="values-preference"
                                                name="values_learned[]" value="preference"> Preference for the least
                                            favored</label>
                                        <label for="values-respect"><input type="checkbox" id="values-respect"
                                                name="values_learned[]" value="respect"> Respect for the integrity of
                                            creation</label>
                                        <label for="values-love-of-work"><input type="checkbox" id="values-love-of-work"
                                                name="values_learned[]" value="love_of_work"> Love of work</label>
                                        <label for="values-simplicity"><input type="checkbox" id="values-simplicity"
                                                name="values_learned[]" value="simplicity"> Simplicity</label>
                                        <label for="values-justice-peace"><input type="checkbox"
                                                id="values-justice-peace" name="values_learned[]" value="justice_peace">
                                            Justice and Peace</label>
                                        <label for="values-other"><input type="checkbox" id="values-other"
                                                name="values_learned[]" value="other"> Others, please specify:</label>
                                        <input type="text" id="values-learned-other" name="values_learned_other"
                                            placeholder="Other values">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="community-services">Please cite the services you have rendered to the
                                        community after
                                        graduation from college (if any):</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="community-services" class="form-control">
                                    </div>
                                </div>

                                <div class="question">
                                    <label>Being a SEAIT alumnus/alumna, what do you think is/are the best feature(s) of
                                        your Alma
                                        Mater? You may check (✓) more than one answer.</label>
                                    <div class="checkbox-group">
                                        <label for="best-features-administration"><input type="checkbox"
                                                id="best-features-administration" name="best_features[]"
                                                value="administration"> Administration</label>
                                        <label for="best-features-library"><input type="checkbox"
                                                id="best-features-library" name="best_features[]" value="library">
                                            Library</label>
                                        <label for="best-features-community-extension"><input type="checkbox"
                                                id="best-features-community-extension" name="best_features[]"
                                                value="community_extension">
                                            Community Extension</label>
                                        <label for="best-features-faculty"><input type="checkbox"
                                                id="best-features-faculty" name="best_features[]" value="faculty">
                                            Faculty</label>
                                        <label for="best-features-laboratories"><input type="checkbox"
                                                id="best-features-laboratories" name="best_features[]"
                                                value="laboratories"> Laboratories</label>
                                        <label for="best-features-student-services"><input type="checkbox"
                                                id="best-features-student-services" name="best_features[]"
                                                value="student_services"> Student
                                            Services (Student Affairs, Guidance, Clinic, Athletics, Canteen)</label>
                                        <label for="best-features-instruction"><input type="checkbox"
                                                id="best-features-instruction" name="best_features[]"
                                                value="instruction"> Instruction</label>
                                        <label for="best-features-physical-plant"><input type="checkbox"
                                                id="best-features-physical-plant" name="best_features[]"
                                                value="physical_plant"> Physical Plant and Facilities</label>
                                        <label for="best-features-other"><input type="checkbox" id="best-features-other"
                                                name="best_features[]" value="other"> Others, please specify:</label>
                                        <input type="text" id="best-features-other" name="best_features_other"
                                            placeholder="Other features">
                                    </div>
                                </div>


                                <div class="question">
                                    <p>Thank you for taking time out to fill out this questionnaire. Please return this
                                        GTS to your
                                        institution. Being one of the alumni of South East Asian Institute of Technology
                                        (SEAIT), may we
                                        request you to list down the names of other SEAIT graduates (AY ____ to AY ____)
                                        from your
                                        institution including their addresses and contact numbers. Their participation
                                        will also be needed
                                        to make this study more meaningful and useful.</p>
                                    <table>
                                        <tr>
                                            <th>Name</th>
                                            <th>Full Address</th>
                                            <th>Contact Number</th>
                                        </tr>
                                        <tr>
                                            <td><input type="text" name="alumni_name[]"></td>
                                            <td><input type="text" name="alumni_address[]"></td>
                                            <td><input type="text" name="alumni_contact[]"></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" name="alumni_name[]"></td>
                                            <td><input type="text" name="alumni_address[]"></td>
                                            <td><input type="text" name="alumni_contact[]"></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" name="alumni_name[]"></td>
                                            <td><input type="text" name="alumni_address[]"></td>
                                            <td><input type="text" name="alumni_contact[]"></td>
                                        </tr>
                                    </table>
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

    </main><!-- End #main -->

    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
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