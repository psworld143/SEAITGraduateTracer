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
            <p>Good day! Please complete this GTS questionnaire as accurately and frankly as posible by filling in the
                blank or checking the box corresponding to your response.
                Your answer will be used for research purposes in order to asses graduate employability and eventually,
                improve cource offerings of your Alma Mater and other universities/colleges in the Phillipines.
                Your answers to this survey will be treated with strictest confidentiality.
            </p>
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
                            <td><input type="text" name="degree[]" placeholder="Enter Degree"></td>
                            <td><input type="text" name="college[]" placeholder="Enter College/University"></td>
                            <td><input type="text" name="year[]" placeholder="Enter Year"></td>
                            <td><input type="text" name="honors[]" placeholder="Enter Honors/Awards"></td>
                        </tr>
                        <!-- Add more rows as needed -->
                    </tbody>
                </table>
            </div>

            <div class="form-group">
                <label for="skills">Professional Skills (Please specify)</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control">
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
                            <td><input type="text" name="exam[]" placeholder="Enter Examination Name"></td>
                            <td><input type="date" name="date[]"></td>
                            <td><input type="text" name="rating[]" placeholder="Enter Rating"></td>
                        </tr>
                        <!-- Add more rows as needed -->
                    </tbody>
                </table>
            </div>

            <div class="form-group">
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
                            <td colspan="2"><input type="text" name="other" placeholder="Specify other reasons"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="tab">
            <h2>C. TRAINING(S) AND ADVANCED STUDIES ATTENDED FOR COLLEGE</h2>

            <div class="form-group">
                <label for="training">Please list down all professional or work-related training program(s),
                    including advanced studies, you have attended after college. You may use an extra sheet if
                    needed.</label>
                <table>
                    <thead>
                        <tr>
                            <th>Title of Training or Advanced Study</th>
                            <th>Duration and Credits Earned</th>
                            <th>Name of Training Institution/College/University</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" name="training_title[]" placeholder="Enter Title"></td>
                            <td><input type="text" name="duration_credits[]" placeholder="Enter Duration and Credits">
                            </td>
                            <td><input type="text" name="institution[]"
                                    placeholder="Enter Institution/College/University"></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="training_title[]" placeholder="Enter Title"></td>
                            <td><input type="text" name="duration_credits[]" placeholder="Enter Duration and Credits">
                            </td>
                            <td><input type="text" name="institution[]"
                                    placeholder="Enter Institution/College/University"></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="training_title[]" placeholder="Enter Title"></td>
                            <td><input type="text" name="duration_credits[]" placeholder="Enter Duration and Credits">
                            </td>
                            <td><input type="text" name="institution[]"
                                    placeholder="Enter Institution/College/University"></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="row mb-3">
                <legend class="col-form-label col-sm-2 pt-0">What made you pursue advanced studies?</legend>
                <div class="col-sm-10">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="promotion" name="motivation[]"
                            value="promotion">
                        <label class="form-check-label" for="promotion">
                            For Promotion
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="professional_development"
                            name="motivation[]" value="professional_development" checked>
                        <label class="form-check-label" for="professional_development">
                            For Professional Development
                        </label>
                    </div>

                    <div class="form-group mt-3">
                        <label for="other_motivation">Others, please specify:</label>
                        <input type="text" id="other_motivation" name="other_motivation" class="form-control"
                            placeholder="Specify other motivations">
                    </div>
                </div>
            </div>
        </div>

        <div class="tab">
            <h2>D. EMPLOYMENT DATA </h2>
            <div class="row mb-3">
                <legend class="col-form-label col-sm-2 pt-0">Are you presently employed?</legend>
                <div class="col-sm-10">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="employed-yes" name="employment_status"
                            value="yes">
                        <label class="form-check-label" for="employed-yes">Yes</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="employed-no" name="employment_status"
                            value="no">
                        <label class="form-check-label" for="employed-no">No</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="employed-never" name="employment_status"
                            value="never">
                        <label class="form-check-label" for="employed-never">Never Employed</label>
                    </div>
                    <p>If NO or NEVER EMPLOYED, proceed to Question 18.</p>
                    <p>If YES, proceed to Question 19-23.</p>
                </div>
            </div>

            <div class="row mb-3">
                <legend class="col-form-label col-sm-2 pt-0">Please state reason(s) why you are not yet employed. You
                    may check (✓) more than one answer.</legend>
                <div class="col-sm-10">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="reason-advanced-study"
                            name="reason_not_employed[]" value="advanced_study">
                        <label class="form-check-label" for="reason-advanced-study">Advance or Further Study</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="reason-family" name="reason_not_employed[]"
                            value="family_concern">
                        <label class="form-check-label" for="reason-family">Family Concern and Decided Not to Find a
                            Job</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="reason-health" name="reason_not_employed[]"
                            value="health_related">
                        <label class="form-check-label" for="reason-health">Health Related Reason(s)</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="reason-experience"
                            name="reason_not_employed[]" value="lack_of_experience">
                        <label class="form-check-label" for="reason-experience">Lack of Work Experience</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="reason-no-opportunity"
                            name="reason_not_employed[]" value="no_job_opportunity">
                        <label class="form-check-label" for="reason-no-opportunity">No Job Opportunity</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="reason-did-not-look"
                            name="reason_not_employed[]" value="did_not_look_for_job">
                        <label class="form-check-label" for="reason-did-not-look">Did Not Look for a Job</label>
                    </div>
                    <div class="row mb-3">
                        <label for="other-reasons" class="col-sm-2 col-form-label">Others, please specify:</label>
                        <div class="col-sm-10">
                            <input type="text" id="other-reasons" name="reason_not_employed_other" class="form-control"
                                placeholder="Specify other reasons">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <legend class="col-form-label col-sm-2 pt-0">Present Employment Status</legend>
                <div class="col-sm-10">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="status-regular"
                            name="employment_status_current" value="regular">
                        <label class="form-check-label" for="status-regular">Regular or Permanent</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="status-temporary"
                            name="employment_status_current" value="temporary">
                        <label class="form-check-label" for="status-temporary">Temporary</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="status-casual" name="employment_status_current"
                            value="casual">
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
                        <label class="form-check-label" for="status-self-employed">Self-employed</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="status-unemployed"
                            name="employment_status_current" value="unemployed">
                        <label class="form-check-label" for="status-unemployed">Unemployed</label>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <label for="current-occupation" class="col-sm-2 col-form-label">Present Occupation (e.g., Grade School
                    Teacher, Electrical Engineer, Self-employed)</label>
                <div class="col-sm-10">
                    <input type="text" id="current-occupation" name="current_occupation" class="form-control"
                        placeholder="Enter Occupation">
                </div>
            </div>

            <div class="row mb-3">
                <label for="company-name" class="col-sm-2 col-form-label">Name of Company or Organization Including
                    Address</label>
                <div class="col-sm-10">
                    <input type="text" id="company-name" name="company_name" class="form-control"
                        placeholder="Enter Company Name and Address">
                </div>
            </div>

            <div class="question">
                <label for="place-of-work-local">22. Place of Work:</label>
                <input type="text" id="place-of-work-local" name="place_of_work_local" placeholder="Local">
                <input type="text" id="place-of-work-abroad" name="place_of_work_abroad" placeholder="Abroad">
            </div>

            <div class="question">
                <label>23. Is this your first job after college?</label>
                <div class="checkbox-group">
                    <label><input type="radio" name="first_job" value="yes"> Yes</label>
                    <label><input type="radio" name="first_job" value="no"> No</label>
                </div>
            </div>

            <div class="question">
                <label>24. What are your reason(s) for staying on the job? You may check (✓) more than one
                    answer.</label>
                <div class="checkbox-group">
                    <label><input type="checkbox" name="reason_staying[]" value="salaries"> Salaries and
                        Benefits</label>
                    <label><input type="checkbox" name="reason_staying[]" value="career_challenge"> Career
                        Challenge</label>
                    <label><input type="checkbox" name="reason_staying[]" value="special_skill"> Related to Special
                        Skill</label>
                    <label><input type="checkbox" name="reason_staying[]" value="course_related"> Related to Course or
                        Program of Study</label>
                    <label><input type="checkbox" name="reason_staying[]" value="proximity"> Proximity to
                        Residence</label>
                    <label><input type="checkbox" name="reason_staying[]" value="peer_influence"> Peer Influence</label>
                    <label><input type="checkbox" name="reason_staying[]" value="family_influence"> Family
                        Influence</label>
                    <label><input type="checkbox" name="reason_staying[]" value="other"> Other Reason(s), please
                        specify:</label>
                    <input type="text" name="reason_staying_other" placeholder="Other reason(s)">
                </div>
            </div>

            <div class="question">
                <label>25. Is your first job related to the course you took up in college?</label>
                <div class="checkbox-group">
                    <label><input type="radio" name="job_related_to_course" value="yes"> Yes</label>
                    <label><input type="radio" name="job_related_to_course" value="no"> No</label>
                </div>
            </div>

            <div class="question">
                <label>26. What were your reasons for accepting the job? You may check (✓) more than one answer.</label>
                <div class="checkbox-group">
                    <label><input type="checkbox" name="reason_accepting[]" value="salaries"> Salaries and
                        Benefits</label>
                    <label><input type="checkbox" name="reason_accepting[]" value="career_challenge"> Career
                        Challenge</label>
                    <label><input type="checkbox" name="reason_accepting[]" value="special_skills"> Related to Special
                        Skills</label>
                    <label><input type="checkbox" name="reason_accepting[]" value="proximity"> Proximity to
                        Residence</label>
                    <label><input type="checkbox" name="reason_accepting[]" value="other"> Other Reason(s), please
                        specify:</label>
                    <input type="text" name="reason_accepting_other" placeholder="Other reason(s)">
                </div>
            </div>

            <div class="question">
                <label>27. What were your reasons for changing jobs? You may check (✓) more than one answer.</label>
                <div class="checkbox-group">
                    <label><input type="checkbox" name="reason_changing[]" value="salaries"> Salaries and
                        Benefits</label>
                    <label><input type="checkbox" name="reason_changing[]" value="career_challenge"> Career
                        Challenge</label>
                    <label><input type="checkbox" name="reason_changing[]" value="special_skills"> Related to Special
                        Skills</label>
                    <label><input type="checkbox" name="reason_changing[]" value="proximity"> Proximity to
                        Residence</label>
                    <label><input type="checkbox" name="reason_changing[]" value="other"> Other Reason(s), please
                        specify:</label>
                    <input type="text" name="reason_changing_other" placeholder="Other reason(s)">
                </div>
            </div>

            <div class="question">
                <label>28. How long did you stay in your first job?</label>
                <select name="first_job_duration">
                    <option value="">Select an option</option>
                    <option value="less_than_month">Less than a month</option>
                    <option value="1_6_months">1 to 6 months</option>
                    <option value="7_11_months">7 to 11 months</option>
                    <option value="1_2_years">1 year to less than 2 years</option>
                    <option value="2_3_years">2 years to less than 3 years</option>
                    <option value="3_4_years">3 years to less than 4 years</option>
                    <option value="others">Others, please specify:</option>
                </select>
                <input type="text" name="first_job_duration_other" placeholder="Other duration">
            </div>

            <div class="question">
                <label>29. How did you find your first job?</label>
                <div class="checkbox-group">
                    <label><input type="checkbox" name="job_finding_method[]" value="advertisement"> Response to an
                        Advertisement</label>
                    <label><input type="checkbox" name="job_finding_method[]" value="walk_in"> As Walk-In
                        Applicant</label>
                    <label><input type="checkbox" name="job_finding_method[]" value="recommended"> Recommended by
                        Someone</label>
                    <label><input type="checkbox" name="job_finding_method[]" value="information"> Information from
                        Friends</label>
                    <label><input type="checkbox" name="job_finding_method[]" value="arranged"> Arranged by School's Job
                        Placement Officer</label>
                    <label><input type="checkbox" name="job_finding_method[]" value="family"> Family Business</label>
                    <label><input type="checkbox" name="job_finding_method[]" value="job_fair"> Job Fair or Public
                        Employment Service Office (PESO)</label>
                    <label><input type="checkbox" name="job_finding_method[]" value="others"> Others, please
                        specify:</label>
                    <input type="text" name="job_finding_method_other" placeholder="Other method">
                </div>
            </div>


            <div class="question">
                <label>30. How long did it take you to land your first job?</label>
                <select name="time-to-first-job">
                    <option value="">Select an option</option>
                    <option value="less-than-month">Less than a month</option>
                    <option value="1-6-months">1 to 6 months</option>
                    <option value="7-11-months">7 to 11 months</option>
                    <option value="1-2-years">1 year to less than 2 years</option>
                    <option value="2-3-years">2 years to less than 3 years</option>
                    <option value="3-4-years">3 years to less than 4 years</option>
                    <option value="others">Others, please specify:</option>
                </select>
                <input type="text" name="time-to-first-job-other" placeholder="Other duration">
            </div>

            <div class="question">
                <label>31. Job Position:</label>
                <input type="text" name="first-job" placeholder="First job">
                <input type="text" name="current-job" placeholder="Current or Present Job">
            </div>
            <div class="question">
                <label for="initial-earning">32. What is your initial gross monthly earning in your first job after
                    college?</label>
                <input type="number" id="initial-earning" name="initial-earning" placeholder="Enter amount">
            </div>

            <div class="question">
                <label>33. Was the curriculum you had in college relevant to your first job?</label>
                <div class="checkbox-group">
                    <label><input type="radio" name="curriculum-relevant" value="yes"> Yes</label>
                    <label><input type="radio" name="curriculum-relevant" value="no"> No</label>
                </div>
            </div>

            <div class="question">
                <label>34. If YES, what competencies learned in college did you find very useful in your first job? You
                    may check (✓) more than one answer.</label>
                <div class="checkbox-group">
                    <label><input type="checkbox" name="useful-competencies" value="communication"> Communication
                        skills</label>
                    <label><input type="checkbox" name="useful-competencies" value="human-relations"> Human Relations
                        skills</label>
                    <label><input type="checkbox" name="useful-competencies" value="entrepreneurial"> Entrepreneurial
                        skills</label>
                    <label><input type="checkbox" name="useful-competencies" value="it"> Information Technology
                        skills</label>
                    <label><input type="checkbox" name="useful-competencies" value="problem-solving"> Problem-solving
                        skills</label>
                    <label><input type="checkbox" name="useful-competencies" value="critical-thinking"> Critical
                        Thinking skills</label>
                    <label><input type="checkbox" name="useful-competencies" value="other"> Other reason(s), please
                        specify:</label>
                    <input type="text" name="useful-competencies-other" placeholder="Other competencies">
                </div>
            </div>

            <div class="row mb-3">
                <label for="curriculum-improvement">35. List down suggestions to further improve your course
                    curriculum:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control">
                </div>
            </div>

            <div class="question">
                <label>36. What values did you learn from your Alma Mater that you have been practicing in your life and
                    at work? You may check (✓) more than one answer.</label>
                <div class="checkbox-group">
                    <label><input type="checkbox" name="values-learned" value="family-spirit"> Family spirit</label>
                    <label><input type="checkbox" name="values-learned" value="presence"> Presence</label>
                    <label><input type="checkbox" name="values-learned" value="marian"> Marian</label>
                    <label><input type="checkbox" name="values-learned" value="honesty"> Honesty</label>
                    <label><input type="checkbox" name="values-learned" value="preference"> Preference for the least
                        favored</label>
                    <label><input type="checkbox" name="values-learned" value="respect"> Respect for the integrity of
                        creation</label>
                    <label><input type="checkbox" name="values-learned" value="love-of-work"> Love of work</label>
                    <label><input type="checkbox" name="values-learned" value="simplicity"> Simplicity</label>
                    <label><input type="checkbox" name="values-learned" value="justice-peace"> Justice and Peace</label>
                    <label><input type="checkbox" name="values-learned" value="other"> Others, please specify:</label>
                    <input type="text" name="values-learned-other" placeholder="Other values">
                </div>
            </div>

            <div class="row mb-3">
                <label for="community-services">37. Please cite the services you have rendered to the community after
                    graduation from college (if any):</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control">
                </div>
            </div>

            <div class="question">
                <label>38. Being a SEAIT alumnus/alumna, what do you think is/are the best feature(s) of your Alma
                    Mater? You may check (✓) more than one answer.</label>
                <div class="checkbox-group">
                    <label><input type="checkbox" name="best-features" value="administration"> Administration</label>
                    <label><input type="checkbox" name="best-features" value="library"> Library</label>
                    <label><input type="checkbox" name="best-features" value="community-extension"> Community
                        Extension</label>
                    <label><input type="checkbox" name="best-features" value="faculty"> Faculty</label>
                    <label><input type="checkbox" name="best-features" value="laboratories"> Laboratories</label>
                    <label><input type="checkbox" name="best-features" value="student-services"> Student Services
                        (Student Affairs, Guidance, Clinic, Athletics, Canteen)</label>
                    <label><input type="checkbox" name="best-features" value="instruction"> Instruction</label>
                    <label><input type="checkbox" name="best-features" value="physical-plant"> Physical Plant and
                        Facilities</label>
                    <label><input type="checkbox" name="best-features" value="other"> Others, please specify:</label>
                    <input type="text" name="best-features-other" placeholder="Other features">
                </div>
            </div>

            <div class="question">
                <p>Thank you for taking time out to fill out this questionnaire. Please return this GTS to your
                    institution. Being one of the alumni of South East Asian Institute of Technology (SEAIT), may we
                    request you to list down the names of other SEAIT graduates (AY ____ to AY ____) from your
                    institution including their addresses and contact numbers. Their participation will also be needed
                    to make this study more meaningful and useful.</p>
                <table>
                    <tr>
                        <th>Name</th>
                        <th>Full Address</th>
                        <th>Contact Number</th>
                    </tr>
                    <tr>
                        <td><input type="text" name="alumni-name[]"></td>
                        <td><input type="text" name="alumni-address[]"></td>
                        <td><input type="text" name="alumni-contact[]"></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="alumni-name[]"></td>
                        <td><input type="text" name="alumni-address[]"></td>
                        <td><input type="text" name="alumni-contact[]"></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="alumni-name[]"></td>
                        <td><input type="text" name="alumni-address[]"></td>
                        <td><input type="text" name="alumni-contact[]"></td>
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