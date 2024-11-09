<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Survey Form</title>
    <meta content="About SEAIT, history, mission, and vision" name="description">
    <meta content="SEAIT, education, history" name="keywords">

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
        <form id="regForm" onsubmit="submitForm(event)">
            <div class="title-card">
                <div class="title">
                    <h1>SEAIT Graduate Tracer</h1>
                    <p>Dear Graduate:</p>
                    <p>Good day! Please complete this GTS questionnaire as accurately and frankly as possible by filling
                        in the blank or checking the box corresponding to your response.
                        Your answer will be used for research purposes in order to assess graduate employability and
                        eventually, improve course offerings of your Alma Mater and other universities/colleges in the
                        Philippines.
                        Your answers to this survey will be treated with the strictest confidentiality.
                    </p>
                </div>
            </div>

            <!-- A -->
            <h2>A. GENERAL INFORMATION</h2>

            <div class="col-md-12 ">
                <label for="name" class="form-label">Name:</label>
                <div class="col-sm-12">
                    <input type="text" id="name" name="name" class="form-control" placeholder="Enter your full name"
                        required>
                </div>
            </div>

            <div class="col-md-12 ">
                <label for="email_address" class="form-label">Email Address:</label>
                <div class="col-sm-12">
                    <input type="email" id="email_address" name="email_address" class="form-control"
                        placeholder="Enter your email address" required aria-describedby="emailHelp">
                </div>
            </div>


            <div class="col-md-12 ">
                <label for="telephone_contact" class="form-label">Telephone/Contact:</label>
                <div class="col-sm-12">
                    <input type="text" id="telephone_contact" name="telephone_contact" class="form-control"
                        placeholder="Enter your telephone number" maxlength="15" required>
                </div>
            </div>


            <div class="col-md-12 ">
                <label for="mobile_phone_number" class="form-label">Mobile Phone Number:</label>
                <div class="col-sm-12">
                    <input type="text" id="mobile_phone_number" name="mobile_phone_number" class="form-control"
                        placeholder="Enter your mobile phone number">
                </div>
            </div>

            <div class="col-md-12 ">
                <label for="civil_status" class="form-label">Civil Status:</label>
                <div class="col-sm-12">
                    <select id="civil_status" name="civil_status" class="form-select" aria-label="Civil Status">
                        <option selected>Select Status</option>
                        <option value="Single">Single</option>
                        <option value="Married">Married</option>
                        <option value="Separated">Separated</option>
                        <option value="Single Parent">Single Parent</option>
                        <option value="Widow or Widower">Widow or Widower</option>
                    </select>
                </div>
            </div>

            <div class="col-md-12 ">
                <label for="date" class="form-label">Date:</label>
                <div class="col-sm-12">
                    <input type="date" id="date" name="date" class="form-control">
                </div>
            </div>

            <div class="col-md-12 ">
                <label for="region_of_origin" class="form-label">Region of Origin:</label>
                <div class="col-sm-12">
                    <select id="region_of_origin" name="region_of_origin" class="form-select"
                        aria-label="Region of Origin">
                        <option selected>Select Region</option>
                        <option value="Region 1 - Ilocos Region">Region 1 - Ilocos Region</option>
                        <option value="Region 2 - Cagayan Valley">Region 2 - Cagayan Valley</option>
                        <option value="Region 3 - Central Luzon">Region 3 - Central Luzon</option>
                        <option value="Region 4A - CALABARZON">Region 4A - CALABARZON</option>
                        <option value="Region 4B - MIMAROPA">Region 4B - MIMAROPA</option>
                        <option value="Region 5 - Bicol Region">Region 5 - Bicol Region</option>
                        <option value="Region 6 - Western Visayas">Region 6 - Western Visayas</option>
                        <option value="Region 7 - Central Visayas">Region 7 - Central Visayas</option>
                        <option value="Region 8 - Eastern Visayas">Region 8 - Eastern Visayas</option>
                        <option value="Region 9 - Zamboanga Peninsula">Region 9 - Zamboanga Peninsula</option>
                        <option value="Region 10 - Northern Mindanao">Region 10 - Northern Mindanao</option>
                        <option value="Region 11 - Davao Region">Region 11 - Davao Region</option>
                        <option value="Region 12 - SOCCSKSARGEN">Region 12 - SOCCSKSARGEN</option>
                        <option value="Region 13 - Caraga">Region 13 - Caraga</option>
                        <option value="BARMM - Bangsamoro Autonomous Region in Muslim Mindanao">BARMM - Bangsamoro
                            Autonomous Region in Muslim Mindanao</option>
                        <option value="NCR - National Capital Region">NCR - National Capital Region</option>
                    </select>
                </div>
            </div>

            <div class="col-md-12 ">
                <label for="province_of_origin" class="form-label">Province of Origin:</label>
                <div class="col-sm-12">
                    <input type="text" id="province_of_origin" name="province_of_origin" class="form-control"
                        placeholder="Enter your province of origin">
                </div>
            </div>

            <div class="col-md-12 ">
                <label for="location_of_residence" class="form-label">Location of Residence:</label>
                <div class="col-12">
                    <input type="text" id="location_of_residence" name="location_of_residence" class="form-control"
                        placeholder="Enter your location of residence">
                </div>
            </div>

            <div class="col-md-12">
                <label for="municipalities" class="form-label">Municipalities:</label>
                <div class="col-sm-12">
                    <input type="text" id="municipalities" name="municipalities" class="form-control"
                        placeholder="Enter your municipality">
                </div>
            </div>

            <!-- B -->
            <h2>B. EDUCATIONAL BACKGROUND</h2>

            <div class="col-md-12">
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
                            <td><input type="text" id="degree1" name="degree[]" placeholder="Enter Degree"
                                    aria-label="Degree or Specialization 1"></td>
                            <td><input type="text" id="college1" name="college_university[]"
                                    placeholder="Enter College/University" aria-label="College or University 1">
                            </td>
                            <td><input type="date" id="year1" name="year_graduated[]" placeholder="Enter Year"
                                    aria-label="Year Graduated 1"></td>
                            <td><input type="text" id="honors1" name="honors_awards[]" placeholder="Enter Honors/Awards"
                                    aria-label="Honors or Awards 1"></td>
                        </tr>
                        <tr>
                            <td><input type="text" id="degree2" name="degree[]" placeholder="Enter Degree"
                                    aria-label="Degree or Specialization 2"></td>
                            <td><input type="text" id="college2" name="college_university[]"
                                    placeholder="Enter College/University" aria-label="College or University 2">
                            </td>
                            <td><input type="date" id="year2" name="year_graduated[]" placeholder="Enter Year"
                                    aria-label="Year Graduated 2"></td>
                            <td><input type="text" id="honors2" name="honors_awards[]" placeholder="Enter Honors/Awards"
                                    aria-label="Honors or Awards 2"></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="col-md-12">
                <label for="skill">Professional Skills (Please specify)</label>
                <div class="col-sm-12">
                    <input type="text" id="skill" name="skill" class="form-control" aria-label="Professional Skills">
                </div>
            </div>

            <div class="col-md-12">
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
                            <td><input type="text" id="exam1" name="exam_name[]" placeholder="Enter Examination Name"
                                    aria-label="Examination Name 1"></td>
                            <td><input type="date" id="date1" name="date_taken[]" aria-label="Date Taken 1"></td>
                            <td><input type="text" id="rating1" name="rating[]" placeholder="Enter Rating"
                                    aria-label="Rating 1"></td>
                        </tr>
                        <tr>
                            <td><input type="text" id="exam2" name="exam_name[]" placeholder="Enter Examination Name"
                                    aria-label="Examination Name 2"></td>
                            <td><input type="date" id="date2" name="date_taken[]" aria-label="Date Taken 2"></td>
                            <td><input type="text" id="rating2" name="rating[]" placeholder="Enter Rating"
                                    aria-label="Rating 2"></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="col-md-12">
                <label for="reasons">Reason(s) for having taken the course(s) or having pursued degree(s). You may
                    check (✓) more than one answer.</label>

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
                            <td><input type="checkbox" id="undergrad_high_grades" name="undergrad_high_grades"
                                    aria-label="Undergraduate High Grades"></td>
                            <td><input type="checkbox" id="grad_high_grades" name="grad_high_grades"
                                    aria-label="Graduate High Grades"></td>
                        </tr>
                        <tr>
                            <td>Good grades in high school</td>
                            <td><input type="checkbox" id="undergrad_good_grades" name="undergrad_good_grades"
                                    aria-label="Undergraduate Good Grades"></td>
                            <td><input type="checkbox" id="grad_good_grades" name="grad_good_grades"
                                    aria-label="Graduate Good Grades"></td>
                        </tr>
                        <tr>
                            <td>Influence of parents or relatives</td>
                            <td><input type="checkbox" id="undergrad_parent_influence" name="undergrad_parent_influence"
                                    aria-label="Undergraduate Parent Influence">
                            </td>
                            <td><input type="checkbox" id="grad_parent_influence" name="grad_parent_influence"
                                    aria-label="Graduate Parent Influence"></td>
                        </tr>
                        <tr>
                            <td>Peer influence</td>
                            <td><input type="checkbox" id="undergrad_peer_influence" name="undergrad_peer_influence"
                                    aria-label="Undergraduate Peer Influence"></td>
                            <td><input type="checkbox" id="grad_peer_influence" name="grad_peer_influence"
                                    aria-label="Graduate Peer Influence"></td>
                        </tr>
                        <tr>
                            <td>Inspired by a role model</td>
                            <td><input type="checkbox" id="undergrad_role_model" name="undergrad_role_model"
                                    aria-label="Undergraduate Role Model"></td>
                            <td><input type="checkbox" id="grad_role_model" name="grad_role_model"
                                    aria-label="Graduate Role Model"></td>
                        </tr>
                        <tr>
                            <td>Strong passion for the profession</td>
                            <td><input type="checkbox" id="undergrad_passion" name="undergrad_passion"
                                    aria-label="Undergraduate Passion"></td>
                            <td><input type="checkbox" id="grad_passion" name="grad_passion"
                                    aria-label="Graduate Passion"></td>
                        </tr>
                        <tr>
                            <td>Prospect for immediate employment</td>
                            <td><input type="checkbox" id="undergrad_employment" name="undergrad_employment"
                                    aria-label="Undergraduate Employment"></td>
                            <td><input type="checkbox" id="grad_employment" name="grad_employment"
                                    aria-label="Graduate Employment"></td>
                        </tr>
                        <tr>
                            <td>Status or prestige of the profession</td>
                            <td><input type="checkbox" id="undergrad_prestige" name="undergrad_prestige"
                                    aria-label="Undergraduate Prestige"></td>
                            <td><input type="checkbox" id="grad_prestige" name="grad_prestige"
                                    aria-label="Graduate Prestige"></td>
                        </tr>
                        <tr>
                            <td>Availability of course offering in chosen institution</td>
                            <td><input type="checkbox" id="undergrad_availability" name="undergrad_availability"
                                    aria-label="Undergraduate Availability"></td>
                            <td><input type="checkbox" id="grad_availability" name="grad_availability"
                                    aria-label="Graduate Availability"></td>
                        </tr>
                        <tr>
                            <td>Prospect of career advancement</td>
                            <td><input type="checkbox" id="undergrad_advancement" name="undergrad_advancement"
                                    aria-label="Undergraduate Advancement"></td>
                            <td><input type="checkbox" id="grad_advancement" name="grad_advancement"
                                    aria-label="Graduate Advancement"></td>
                        </tr>
                    </tbody>
                </table>
                <div class="col-md-12">
                    <label for="other_reason">If others, please specify:</label>
                    <input type="text" id="other_reason" name="other_reason" class="form-control"
                        aria-label="Other Reasons">
                </div>
            </div>

            <h2>C. TRAINING(S) AND ADVANCED STUDIES ATTENDED FOR COLLEGE</h2>
            <div class="col-md-12">
                <label for="training_table">Please list down all professional or work-related training
                    program(s),
                    including advanced studies, you have attended after college. You may use an extra sheet if
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

            <div class="col-md-12">
                <legend class="col-form-label">What made you pursue advanced studies?</legend>
                <div class="col-sm-10">
                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="promotion" name="motivation"
                                value="promotion">
                            <label class="form-check-label" for="promotion">For promotion</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="professional_development" name="motivation"
                                value="professional_development">
                            <label class="form-check-label" for="professional_development">For professional
                                development</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="other" name="motivation" value="other">
                            <label class="form-check-label" for="other">Others, please specify:</label>
                            <input type="text" id="other_motivation" name="other_motivation" class="form-control"
                                placeholder="Specify other motivations">
                        </div>
                    </div>
                </div>
            </div>

            <h2>D. EMPLOYMENT DATA</h2>

            <div class="col-md-12">
                <label class="form-label">Are you presently employed?</label>
                <div class="col-sm-10">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="yes" name="employment_status" value="yes">
                        <label class="form-check-label" for="yes">Yes</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="no" name="employment_status" value="no">
                        <label class="form-check-label" for="no">No</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="never" name="employment_status" value="never">
                        <label class="form-check-label" for="never">Never Employed</label>
                    </div>
                    <p>If NO or NEVER EMPLOYED, proceed to Question 18.</p>
                    <p>If YES, proceed to Questions 19-23.</p>
                </div>
            </div>

            <div class="col-md-12">
                <label>Please state reason(s) why you are not yet employed. You may check (✓) more than one
                    answer.</label>
                <div class="checkbox-group">
                    <label><input type="checkbox" name="reason_not_employed[]" value="advanced_study"> Advance or
                        Further Study</label>
                    <label><input type="checkbox" name="reason_not_employed[]" value="family_concern"> Family
                        Concern
                        and Decided Not to Find a Job</label>
                    <label><input type="checkbox" name="reason_not_employed[]" value="health_related"> Health
                        Related
                        Reason(s)</label>
                    <label><input type="checkbox" name="reason_not_employed[]" value="lack_of_experience"> Lack of
                        Work
                        Experience</label>
                    <label><input type="checkbox" name="reason_not_employed[]" value="no_job_opportunity"> No Job
                        Opportunity</label>
                    <label><input type="checkbox" name="reason_not_employed[]" value="did_not_look_for_job"> Did Not
                        Look for a Job</label>
                    <label><input type="checkbox" name="reason_not_employed[]" value="other"> Other Reason(s),
                        please
                        specify:</label>
                    <input type="text" id="other_reason" name="other_reason" placeholder="Specify other reasons">
                </div>
            </div>

            <div class="col-md-12">
                <legend class="form-label">Present Employment Status</legend>
                <div class="col-sm-10">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="regular" name="employment_status_current"
                            value="regular">
                        <label class="form-check-label" for="status-regular">Regular or Permanent</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="temporary" name="employment_status_current"
                            value="temporary">
                        <label class="form-check-label" for="temporary">Temporary</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="casual" name="employment_status_current"
                            value="casual">
                        <label class="form-check-label" for="casual">Casual</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="contractual" name="employment_status_current"
                            value="contractual">
                        <label class="form-check-label" for="contractual">Contractual</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="self-employed" name="employment_status_current"
                            value="self_employed">
                        <label class="form-check-label" for="self-employed">Self-employed</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="unemployed" name="employment_status_current"
                            value="unemployed">
                        <label class="form-check-label" for="unemployed">Unemployed</label>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <label for="current_occupation" class="form-label">Present Occupation (e.g., Grade
                    School Teacher, Electrical Engineer, Self-employed)</label>
                <div class="col-sm-12">
                    <input type="text" id="current_occupation" name="current_occupation" class="form-control"
                        placeholder="Enter Occupation">
                </div>
            </div>

            <div class="col-md-12">
                <label for="company_name" class="form-label">Name of Company or Organization Including
                    Address</label>
                <div class="col-sm-12">
                    <input type="text" id="company_name" name="company_name" class="form-control"
                        placeholder="Enter Company Name and Address">
                </div>
            </div>

            <div class="col-md-12">
                <label for="place-of-work">Place of Work:</label>
                <input type="text" id="local_place" name="local_place" placeholder="Local">
                <input type="text" id="abroad_place" name="abroad_place" placeholder="Abroad">
            </div>

            <div class="col-md-12">
                <label>Is this your first job after college?</label>
                <div class="col-sm-10">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="yes" name="is_first_job" value="yes">
                        <label class="form-check-label" for="yes">Yes</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="no" name="is_first_job" value="no">
                        <label class="form-check-label" for="no">No</label>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <label>What are your reason(s) for staying on the job? You may check (✓) more than one
                    answer.</label>
                <div class="checkbox-group">
                    <label><input type="checkbox" name="reason_staying[]" value="salaries"> Salaries and
                        Benefits</label>
                    <label><input type="checkbox" name="reason_staying[]" value="career_challenge"> Career
                        Challenge</label>
                    <label><input type="checkbox" name="reason_staying[]" value="special_skill"> Related to Special
                        Skill</label>
                    <label><input type="checkbox" name="reason_staying[]" value="course_related"> Related to Course
                        or
                        Program of Study</label>
                    <label><input type="checkbox" name="reason_staying[]" value="proximity"> Proximity to
                        Residence</label>
                    <label><input type="checkbox" name="reason_staying[]" value="peer_influence"> Peer
                        Influence</label>
                    <label><input type="checkbox" name="reason_staying[]" value="family_influence"> Family
                        Influence</label>
                    <label><input type="checkbox" name="reason_staying[]" value="other"> Other Reason(s), please
                        specify:</label>
                    <input type="text" id="other_reason" name="other_reason" placeholder="Other reason(s)">
                </div>
            </div>

            <div class="col-md-12">
                <label>Is your first job related to the course you took up in college?</label>
                <div class="col-sm-10">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="yes" name="is_related" value="yes">
                        <label class="form-check-label" for="yes">Yes</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="no" name="is_related" value="no">
                        <label class="form-check-label" for="no">No</label>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <label>What were your reasons for accepting the job? You may check (✓) more than one answer.</label>
                <div class="checkbox-group">
                    <label><input type="checkbox" name="reason_accepting[]" value="salaries"> Salaries and
                        Benefits</label>
                    <label><input type="checkbox" name="reason_accepting[]" value="career_challenge"> Career
                        Challenge</label>
                    <label><input type="checkbox" name="reason_accepting[]" value="special_skills"> Related to
                        Special
                        Skills</label>
                    <label><input type="checkbox" name="reason_accepting[]" value="proximity"> Proximity to
                        Residence</label>
                    <label><input type="checkbox" name="reason_accepting[]" value="other"> Other Reason(s), please
                        specify:</label>
                    <input type="text" id="other" name="other_reason" placeholder="Other reason(s)">
                </div>
            </div>

            <div class="col-md-12">
                <label>What were your reasons for changing jobs? You may check (✓) more than one answer.</label>
                <div class="checkbox-group">
                    <label><input type="checkbox" name="reason_changing[]" value="salaries"> Salaries and
                        Benefits</label>
                    <label><input type="checkbox" name="reason_changing[]" value="career_challenge"> Career
                        Challenge</label>
                    <label><input type="checkbox" name="reason_changing[]" value="special_skills"> Related to
                        Special
                        Skills</label>
                    <label><input type="checkbox" name="reason_changing[]" value="proximity"> Proximity to
                        Residence</label>
                    <label><input type="checkbox" name="reason_changing[]" value="other"> Other Reason(s), please
                        specify:</label>
                    <input type="text" id="other" name="other_reason" placeholder="Other reason(s)">
                </div>
            </div>

            <!-- Half -->

            <div class="col-md-12">
                <label for="first-job-duration">How long did you stay in your first job?</label>
                <select id="first-job-duration" name="first_job_duration">
                    <option value="">Select an option</option>
                    <option value="less_than_month">Less than a month</option>
                    <option value="1_6_months">1 to 6 months</option>
                    <option value="7_11_months">7 to 11 months</option>
                    <option value="1_2_years">1 year to less than 2 years</option>
                    <option value="2_3_years">2 years to less than 3 years</option>
                    <option value="3_4_years">3 years to less than 4 years</option>
                    <option value="other_duration">Others, please specify:</option>
                </select>
                <input type="text" id="other_duration" name="other_duration" placeholder="Other duration">
            </div>

            <div class="col-md-12">
                <label>How did you find your first job?</label>
                <div class="checkbox-group">
                    <label for="job-finding-advertisement"><input type="checkbox" id="job-finding-advertisement"
                            name="job_finding_method[]" value="advertisement"> Response to an Advertisement</label>
                    <label for="job-finding-walk-in"><input type="checkbox" id="job-finding-walk-in"
                            name="job_finding_method[]" value="walk_in"> As Walk-In Applicant</label>
                    <label for="job-finding-recommended"><input type="checkbox" id="job-finding-recommended"
                            name="job_finding_method[]" value="recommended"> Recommended by Someone</label>
                    <label for="job-finding-information"><input type="checkbox" id="job-finding-information"
                            name="job_finding_method[]" value="information"> Information from Friends</label>
                    <label for="job-finding-arranged"><input type="checkbox" id="job-finding-arranged"
                            name="job_finding_method[]" value="arranged"> Arranged by School's Job Placement
                        Officer</label>
                    <label for="job-finding-family"><input type="checkbox" id="job-finding-family"
                            name="job_finding_method[]" value="family"> Family Business</label>
                    <label for="job-finding-job-fair"><input type="checkbox" id="job-finding-job-fair"
                            name="job_finding_method[]" value="job_fair"> Job Fair or Public Employment Service
                        Office
                        (PESO)</label>
                    <label for="job-finding-others"><input type="checkbox" id="job-finding-others"
                            name="job_finding_method[]" value="other_method"> Others, please specify:</label>
                    <input type="text" id="other_method" name="other_method" placeholder="Other method">
                </div>
            </div>

            <div class="col-md-12">
                <label for="time-to-first-job">How long did it take you to land your first job?</label>
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
                <input type="text" id="other_time" name="other_time" placeholder="Other duration">
            </div>

            <div class="col-md-12">
                <label for="first-job">Job Position:</label>
                <input type="text" id="first-job" name="first_job" placeholder="First job">
                <input type="text" id="current-job" name="current_job" placeholder="Current or Present Job">
            </div>

            <div class="col-md-12">
                <label for="initial-earning">32. What is your initial gross monthly earning in your first job after
                    college?</label>
                <input type="number" id="initial-earning" name="initial_earning" placeholder="Enter amount">
            </div>

            <div class="col-md-12">
                <label>Was the curriculum you had in college relevant to your first job?</label>
                <div class="col-sm-10">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="yes" name="is_relevant" value="yes">
                        <label class="form-check-label" for="yes">Yes</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="no" name="is_relevant" value="no">
                        <label class="form-check-label" for="no">No</label>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <label>If YES, what competencies learned in college did you find very useful in your first job? You
                    may check (✓) more than one answer.</label>
                <div class="checkbox-group">
                    <label for="competencies-communication"><input type="checkbox" id="competencies-communication"
                            name="useful_competencies[]" value="communication"> Communication skills</label>
                    <label for="competencies-human-relations"><input type="checkbox" id="competencies-human-relations"
                            name="useful_competencies[]" value="human_relations">
                        Human Relations skills</label>
                    <label for="competencies-entrepreneurial"><input type="checkbox" id="competencies-entrepreneurial"
                            name="useful_competencies[]" value="entrepreneurial">
                        Entrepreneurial skills</label>
                    <label for="competencies-it"><input type="checkbox" id="competencies-it"
                            name="useful_competencies[]" value="it"> Information Technology skills</label>
                    <label for="competencies-problem-solving"><input type="checkbox" id="competencies-problem-solving"
                            name="useful_competencies[]" value="problem_solving">
                        Problem-solving skills</label>
                    <label for="competencies-critical-thinking"><input type="checkbox"
                            id="competencies-critical-thinking" name="useful_competencies[]" value="critical_thinking">
                        Critical Thinking skills</label>
                    <label for="competencies-other"><input type="checkbox" id="competencies-other"
                            name="useful_competencies[]" value="other"> Other reason(s), please specify:</label>
                    <input type="text" id="other_competency" name="other_competency" placeholder="Other competencies">
                </div>
            </div>

            <div class="col-md-12">
                <label for="suggestions">List down suggestions to further improve your course
                    curriculum:</label>
                <div class="col-sm-12">
                    <input type="text" id="suggestions" name="suggestions" class="form-control">
                </div>
            </div>

            <div class="col-md-12">
                <label>What values did you learn from your Alma Mater that you have been practicing in your life and
                    at work? You may check (✓) more than one answer.</label>
                <div class="checkbox-group">
                    <label for="values-family-spirit"><input type="checkbox" id="values-family-spirit"
                            name="values_learned[]" value="family_spirit"> Family spirit</label>
                    <label for="values-presence"><input type="checkbox" id="values-presence" name="values_learned[]"
                            value="presence"> Presence</label>
                    <label for="values-marian"><input type="checkbox" id="values-marian" name="values_learned[]"
                            value="marian"> Marian</label>
                    <label for="values-honesty"><input type="checkbox" id="values-honesty" name="values_learned[]"
                            value="honesty"> Honesty</label>
                    <label for="values-preference"><input type="checkbox" id="values-preference" name="values_learned[]"
                            value="preference"> Preference for the least favored</label>
                    <label for="values-respect"><input type="checkbox" id="values-respect" name="values_learned[]"
                            value="respect"> Respect for the integrity of creation</label>
                    <label for="values-love-of-work"><input type="checkbox" id="values-love-of-work"
                            name="values_learned[]" value="love_of_work"> Love of work</label>
                    <label for="values-simplicity"><input type="checkbox" id="values-simplicity" name="values_learned[]"
                            value="simplicity"> Simplicity</label>
                    <label for="values-justice-peace"><input type="checkbox" id="values-justice-peace"
                            name="values_learned[]" value="justice_peace"> Justice and Peace</label>
                    <label for="values-other"><input type="checkbox" id="values-other" name="values_learned[]"
                            value="other"> Others, please specify:</label>
                    <input type="text" id="other_value" name="other_value" placeholder="Other values">
                </div>
            </div>

            <div class="col-md-12">
                <label for="services">Please cite the services you have rendered to the community after
                    graduation from college (if any):</label>
                <div class="col-sm-12">
                    <input type="text" id="services" name="services" class="form-control">
                </div>
            </div>

            <div class="col-md-12">
                <label>Being a SEAIT alumnus/alumna, what do you think is/are the best feature(s) of your Alma
                    Mater? You may check (✓) more than one answer.</label>
                <div class="checkbox-group">
                    <label for="best-features-administration"><input type="checkbox" id="best-features-administration"
                            name="best_features[]" value="administration">
                        Administration</label>
                    <label for="best-features-library"><input type="checkbox" id="best-features-library"
                            name="best_features[]" value="library"> Library</label>
                    <label for="best-features-community-extension"><input type="checkbox"
                            id="best-features-community-extension" name="best_features[]" value="community_extension">
                        Community Extension</label>
                    <label for="best-features-faculty"><input type="checkbox" id="best-features-faculty"
                            name="best_features[]" value="faculty"> Faculty</label>
                    <label for="best-features-laboratories"><input type="checkbox" id="best-features-laboratories"
                            name="best_features[]" value="laboratories"> Laboratories</label>
                    <label for="best-features-student-services"><input type="checkbox"
                            id="best-features-student-services" name="best_features[]" value="student_services">
                        Student
                        Services (Student Affairs, Guidance, Clinic, Athletics, Canteen)</label>
                    <label for="best-features-instruction"><input type="checkbox" id="best-features-instruction"
                            name="best_features[]" value="instruction"> Instruction</label>
                    <label for="best-features-physical-plant"><input type="checkbox" id="best-features-physical-plant"
                            name="best_features[]" value="physical_plant">
                        Physical Plant and Facilities</label>
                    <label for="best-features-other"><input type="checkbox" id="best-features-other"
                            name="best_features[]" value="other"> Others, please specify:</label>
                    <input type="text" id="other_feature" name="other_feature" placeholder="Other features">
                </div>
            </div>
            <div class="question">
                <p>Thank you for taking time out to fill out this questionnaire. Please return this GTS to your
                    institution.</p>
            </div>

            <!-- Submit Button -->
            <div class="form-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </main>
    <script>
    // Function to handle form submission
    function submitForm(event) {
        event.preventDefault(); // Prevent the default form submission to stay on the page

        // Validate form data
        if (!validateForm()) {
            return; // If validation fails, do not proceed
        }

        // Gather form data using FormData API
        const formData = new FormData(document.getElementById('regForm'));

        // Example: Log form data to the console (for debugging)
        console.log("Form Submitted with data:");
        for (let [name, value] of formData.entries()) {
            console.log(name + ": " + value);
        }

        // Send data to the server (using fetch API)
        fetch('backend/save_question.php', {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json()) // Parse JSON response from the server
            .then(data => {
                if (data.success) {
                    alert('Form submitted successfully!');
                    // Optionally, you can clear the form fields or redirect
                    document.getElementById('regForm').reset();
                } else {
                    alert('Error submitting form: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('There was an error submitting the form.');
            });
    }

    // Function to validate the form data
    function validateForm() {
        const name = document.getElementById('name').value;
        const email = document.getElementById('email_address').value;
        const phone = document.getElementById('telephone_contact').value;
        const mobile = document.getElementById('mobile_phone_number').value;
        const civilStatus = document.getElementById('civil_status').value;

        // Check if required fields are filled
        if (!name || !email || !phone || !mobile || civilStatus === 'Select Status') {
            alert("Please fill in all required fields.");
            return false;
        }

        // Additional email validation
        if (!validateEmail(email)) {
            alert("Please enter a valid email address.");
            return false;
        }

        return true;
    }

    // Function to validate email format
    function validateEmail(email) {
        const regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        return regex.test(email);
    }
    </script>
</body>

</html>