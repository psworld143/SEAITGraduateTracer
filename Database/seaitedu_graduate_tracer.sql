-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 08, 2025 at 06:50 PM
-- Server version: 10.5.29-MariaDB-cll-lve
-- PHP Version: 8.3.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `seaitedu_graduate_tracer`
--

-- --------------------------------------------------------

--
-- Table structure for table `batches`
--

CREATE TABLE `batches` (
  `id` int(11) NOT NULL,
  `batch_name` varchar(255) NOT NULL,
  `year_graduated` int(11) NOT NULL,
  `is_archived` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `batches`
--

INSERT INTO `batches` (`id`, `batch_name`, `year_graduated`, `is_archived`) VALUES
(2, 'Batch 2020-2021', 2020, 0),
(3, 'Batch 2021-2022', 2021, 0),
(4, 'Batch 2022-2023', 2022, 0),
(5, 'Batch 2023-2024', 2023, 0);

-- --------------------------------------------------------

--
-- Table structure for table `best_features`
--

CREATE TABLE `best_features` (
  `id` int(11) NOT NULL,
  `best_features` enum('Administration','Library','Community Extension','Faculty','Laboratories','Student Services (Student Affairs, Guidance, Clinic, Athletics, Canteen)','Instruction','Physical Plant and Facilities','Others') NOT NULL,
  `other_feature` varchar(255) DEFAULT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `best_features`
--

INSERT INTO `best_features` (`id`, `best_features`, `other_feature`, `student_id`) VALUES
(1, 'Administration', '', 1),
(2, 'Library', '', 1),
(3, 'Community Extension', '', 1),
(8, 'Administration', '', 2);

-- --------------------------------------------------------

--
-- Table structure for table `community_services`
--

CREATE TABLE `community_services` (
  `id` int(11) NOT NULL,
  `services` text NOT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `community_services`
--

INSERT INTO `community_services` (`id`, `services`, `student_id`) VALUES
(1, 'Community Service', 1),
(3, 'ascasc', 2);

-- --------------------------------------------------------

--
-- Table structure for table `company_information`
--

CREATE TABLE `company_information` (
  `id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company_information`
--

INSERT INTO `company_information` (`id`, `company_name`, `student_id`) VALUES
(1, 'Tech Solutions Corp., 123 Main Street, Makati, Philippines', 1),
(3, '', 2),
(4, 'sdvsd', 2);

-- --------------------------------------------------------

--
-- Table structure for table `current_occupation`
--

CREATE TABLE `current_occupation` (
  `id` int(11) NOT NULL,
  `current_occupation` varchar(255) NOT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `current_occupation`
--

INSERT INTO `current_occupation` (`id`, `current_occupation`, `student_id`) VALUES
(1, 'Electrical Engineer', 1),
(3, '', 2),
(4, 'vsdv', 2);

-- --------------------------------------------------------

--
-- Table structure for table `curriculum_improvement`
--

CREATE TABLE `curriculum_improvement` (
  `id` int(11) NOT NULL,
  `suggestions` text NOT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `curriculum_improvement`
--

INSERT INTO `curriculum_improvement` (`id`, `suggestions`, `student_id`) VALUES
(1, 'Incorporate More Practical Hands-On Projects', 1),
(3, 'casca', 2);

-- --------------------------------------------------------

--
-- Table structure for table `curriculum_relevance`
--

CREATE TABLE `curriculum_relevance` (
  `id` int(11) NOT NULL,
  `is_relevant` enum('yes','no') NOT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `curriculum_relevance`
--

INSERT INTO `curriculum_relevance` (`id`, `is_relevant`, `student_id`) VALUES
(1, 'yes', 1),
(3, 'yes', 2);

-- --------------------------------------------------------

--
-- Table structure for table `degree_reasons`
--

CREATE TABLE `degree_reasons` (
  `id` int(11) NOT NULL,
  `undergrad_high_grades` tinyint(1) DEFAULT 0,
  `grad_high_grades` tinyint(1) DEFAULT 0,
  `other_reason` varchar(255) DEFAULT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `degree_reasons`
--

INSERT INTO `degree_reasons` (`id`, `undergrad_high_grades`, `grad_high_grades`, `other_reason`, `student_id`) VALUES
(1, 0, 0, '', 1),
(3, 0, 0, '', 2),
(4, 0, 0, '', 2);

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(11) NOT NULL,
  `document_type` varchar(100) NOT NULL,
  `availability_status` varchar(50) NOT NULL,
  `release_date` date NOT NULL,
  `additional_instructions` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `document_type`, `availability_status`, `release_date`, `additional_instructions`) VALUES
(3, 'Transcript', 'Available for Release', '2024-11-27', 'To claim your document, please follow these steps:\r\n\r\nEnsure all outstanding fees with the institution are cleared. Payment receipts must be presented if applicable.\r\nBring a valid government-issued ID or your school ID for verification.\r\nIf someone is claiming the document on your behalf, provide a signed authorization letter and a copy of your valid ID along with the representative\'s ID.\r\nClaim the document on or after the release date during office hours (8:00 AM to 5:00 PM, Monday to Friday).\r\nContact the registrar’s office in advance to confirm document availability before visiting.'),
(4, 'Diploma', 'Available for Release', '2024-11-28', 'To ensure a smooth document release process, please adhere to the following guidelines:\r\n\r\nVerify the release date and ensure you visit the office only on or after this date.\r\nBring two valid forms of identification (e.g., passport, driver’s license, school ID) for verification.\r\nIf you are unable to personally claim the document, authorize a representative by providing:\r\nA signed authorization letter.\r\nA photocopy of your ID and the representative’s ID.\r\nFor expedited processing or special requests, contact the registrar\'s office at least 3 days in advance.\r\nDocuments unclaimed within 30 days of the release date may be subject to additional fees or may require re-application.\r\nFor further assistance, you can reach out to the registrar\'s office via email at registrar@schoolname.edu or call (123) 456-7890.'),
(5, 'Certification', 'Available for Release', '2024-11-29', 'Please follow these steps to claim your document:\r\n\r\nVerify Document Readiness: Ensure the document is ready for release by checking with the registrar\'s office via email or phone.\r\nBring Required Documents:\r\nA valid photo ID (e.g., school ID, driver’s license, or passport).\r\nFor third-party claimants, provide:\r\nAn authorization letter signed by the document owner.\r\nPhotocopies of both the claimant’s and the document owner’s IDs.\r\nClaiming Schedule:\r\nDocuments can be claimed during office hours (9:00 AM to 4:00 PM, Monday to Friday).\r\nIf unable to visit during these hours, contact the office to arrange an alternative.\r\nProcessing Fee: Ensure that any processing fees are fully paid. Bring the receipt as proof of payment if required.\r\nClaim Deadline: Collect the document within 60 days of the release date to avoid penalties or re-application requirements.\r\nFor inquiries, email registrar@schoolname.edu or call (123) 987-6543.');

-- --------------------------------------------------------

--
-- Table structure for table `educational_attainment`
--

CREATE TABLE `educational_attainment` (
  `id` int(11) NOT NULL,
  `degree` varchar(255) NOT NULL,
  `college_university` varchar(255) NOT NULL,
  `year_graduated` date DEFAULT NULL,
  `honors_awards` varchar(255) DEFAULT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `educational_attainment`
--

INSERT INTO `educational_attainment` (`id`, `degree`, `college_university`, `year_graduated`, `honors_awards`, `student_id`) VALUES
(1, 'Bachelor of Science in Computer Science', 'University of Technology', '2024-10-30', 'Dean\'s List, Outstanding Student Award', 1),
(2, 'Bachelor of Arts in Psychology', 'State College of Arts', '2024-10-29', 'Cum Laude, Best Thesis Award', 1),
(5, 'Degree1', 'SKSU', '2024-10-27', 'First Honor', 2),
(6, 'Degree', 'UAAP', '2024-10-28', 'Second Honor', 2),
(7, 'sdvs', 'sdvsdvsdv', '2024-11-04', 'sdv', 2),
(8, 'dvsdv', 'sdvsdv', '2024-10-30', 'sdvsd', 2);

-- --------------------------------------------------------

--
-- Table structure for table `employment_status`
--

CREATE TABLE `employment_status` (
  `id` int(11) NOT NULL,
  `status` enum('yes','no','never') NOT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employment_status`
--

INSERT INTO `employment_status` (`id`, `status`, `student_id`) VALUES
(1, 'yes', 1),
(3, 'yes', 2);

-- --------------------------------------------------------

--
-- Table structure for table `first_job_after_college`
--

CREATE TABLE `first_job_after_college` (
  `id` int(11) NOT NULL,
  `is_first_job` enum('yes','no') NOT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `first_job_after_college`
--

INSERT INTO `first_job_after_college` (`id`, `is_first_job`, `student_id`) VALUES
(1, 'yes', 1),
(3, 'yes', 2);

-- --------------------------------------------------------

--
-- Table structure for table `first_job_duration`
--

CREATE TABLE `first_job_duration` (
  `id` int(11) NOT NULL,
  `first_job_duration` enum('less_than_month','1_6_months','7_11_months','1_2_years','2_3_years','3_4_years','others') NOT NULL,
  `other_duration` varchar(255) DEFAULT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `first_job_duration`
--

INSERT INTO `first_job_duration` (`id`, `first_job_duration`, `other_duration`, `student_id`) VALUES
(1, '1_2_years', '', 1),
(3, 'less_than_month', '', 2);

-- --------------------------------------------------------

--
-- Table structure for table `first_job_related_to_course`
--

CREATE TABLE `first_job_related_to_course` (
  `id` int(11) NOT NULL,
  `is_related` enum('yes','no') NOT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `first_job_related_to_course`
--

INSERT INTO `first_job_related_to_course` (`id`, `is_related`, `student_id`) VALUES
(1, 'yes', 1),
(3, 'yes', 2);

-- --------------------------------------------------------

--
-- Table structure for table `general_information`
--

CREATE TABLE `general_information` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `telephone_contact` varchar(15) DEFAULT NULL,
  `mobile_phone_number` varchar(15) DEFAULT NULL,
  `civil_status` enum('Single','Married','Separated','Single Parent','Widow or Widower') DEFAULT NULL,
  `date` date DEFAULT NULL,
  `region_of_origin` enum('Region 1 - Ilocos Region','Region 2 - Cagayan Valley','Region 3 - Central Luzon','Region 4A - CALABARZON','Region 4B - MIMAROPA','Region 5 - Bicol Region','Region 6 - Western Visayas','Region 7 - Central Visayas','Region 8 - Eastern Visayas','Region 9 - Zamboanga Peninsula','Region 10 - Northern Mindanao','Region 11 - Davao Region','Region 12 - SOCCSKSARGEN','Region 13 - Caraga','BARMM - Bangsamoro Autonomous Region in Muslim Mindanao','NCR - National Capital Region') DEFAULT NULL,
  `province_of_origin` varchar(255) DEFAULT NULL,
  `location_of_residence` varchar(255) DEFAULT NULL,
  `municipalities` varchar(255) DEFAULT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `general_information`
--

INSERT INTO `general_information` (`id`, `name`, `email_address`, `telephone_contact`, `mobile_phone_number`, `civil_status`, `date`, `region_of_origin`, `province_of_origin`, `location_of_residence`, `municipalities`, `student_id`) VALUES
(1, 'Angelo Salem', 'angelosalem173.30@gmail.com', '+897-345', '09876545672', 'Single', '2024-11-11', 'Region 12 - SOCCSKSARGEN', 'South Cotabato', 'Prk. 8A Subdivission', 'Tupi', 1),
(6, 'as', 'as@gmail.com', '+0987678', '09876567222', 'Single Parent', '0000-00-00', 'NCR - National Capital Region', 'sdvsdvs', 'dvsdv', 'vsdv', 2);

-- --------------------------------------------------------

--
-- Table structure for table `initial_gross_monthly_earning`
--

CREATE TABLE `initial_gross_monthly_earning` (
  `id` int(11) NOT NULL,
  `initial_earning` decimal(10,2) NOT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `initial_gross_monthly_earning`
--

INSERT INTO `initial_gross_monthly_earning` (`id`, `initial_earning`, `student_id`) VALUES
(1, 10000.00, 1),
(3, 2345.00, 2);

-- --------------------------------------------------------

--
-- Table structure for table `job_finding_methods`
--

CREATE TABLE `job_finding_methods` (
  `id` int(11) NOT NULL,
  `job_finding_method` enum('Response to an Advertisement','As Walk-In Applicant','Recommended by Someone','Information from Friends','Arranged by School Job Placement Officer','Family Business','Job Fair or Public Employment Service Office (PESO)','Others') NOT NULL,
  `other_method` varchar(255) DEFAULT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job_finding_methods`
--

INSERT INTO `job_finding_methods` (`id`, `job_finding_method`, `other_method`, `student_id`) VALUES
(1, 'Response to an Advertisement', '', 1),
(2, 'As Walk-In Applicant', '', 1),
(4, 'Response to an Advertisement', '', 2);

-- --------------------------------------------------------

--
-- Table structure for table `job_positions`
--

CREATE TABLE `job_positions` (
  `id` int(11) NOT NULL,
  `first_job` varchar(255) NOT NULL,
  `current_job` varchar(255) DEFAULT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job_positions`
--

INSERT INTO `job_positions` (`id`, `first_job`, `current_job`, `student_id`) VALUES
(1, 'Junior Software Developer', 'Senior Software Developer', 1),
(3, 'qwd', 'qwdqw', 2);

-- --------------------------------------------------------

--
-- Table structure for table `job_postings`
--

CREATE TABLE `job_postings` (
  `id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `company_logo` varchar(255) DEFAULT NULL,
  `job_location` varchar(255) NOT NULL,
  `job_title` varchar(255) NOT NULL,
  `job_description` text NOT NULL,
  `qualifications` text NOT NULL,
  `application_deadline` date NOT NULL,
  `contact_info` varchar(255) NOT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job_postings`
--

INSERT INTO `job_postings` (`id`, `company_name`, `company_logo`, `job_location`, `job_title`, `job_description`, `qualifications`, `application_deadline`, `contact_info`, `status`, `created_at`, `updated_at`) VALUES
(4, 'Tech Innovators Inc.', NULL, 'New York, NY, USA', 'Software Developer', 'We are seeking a talented and motivated Software Developer to join our dynamic team. The role involves designing, coding, and maintaining software applications, collaborating with cross-functional teams, and contributing to innovative technology projects', 'Bachelor’s degree in Computer Science, Software Engineering, or a related field.\r\nProficiency in programming languages like Python, Java, or C#.\r\nExperience with front-end frameworks (React, Angular, or Vue).\r\nStrong problem-solving skills and attention to detail.\r\nExcellent communication and teamwork abilities.', '2024-11-27', 'hr@techinnovators.com | (123) 456-7890', 'active', '2024-11-27 02:34:25', '2024-11-27 02:34:25'),
(5, 'Green Horizons Environmental Solutions', '../uploads/images-removebg-preview (1).png', 'Los Angeles, CA, USA', 'Environmental Project Manager', 'Green Horizons is looking for an experienced Environmental Project Manager to lead and execute sustainability projects. The candidate will manage environmental compliance, oversee project timelines and budgets, and collaborate with stakeholders to implement green initiatives.', 'Bachelor’s degree in Environmental Science, Engineering, or a related field.\r\nAt least 3 years of experience in project management or environmental consulting.\r\nStrong understanding of environmental regulations and sustainability practices.\r\nExceptional organizational and leadership skills.\r\nProficiency in project management tools like MS Project or Asana.', '2024-11-28', 'careers@greenhorizons.com | (987) 654-3210', 'active', '2024-11-27 02:35:44', '2024-11-27 02:35:44'),
(6, 'Bright Minds Academy', '../uploads/Purple Minimalist Illustrated Night Waterfall Landscape Desktop Wallpaper (11).jpg', 'Austin, TX, USA', 'Elementary School Teacherv', 'Bright Minds Academy is hiring a passionate and dedicated Elementary School Teacher to inspire and educate young learners. The role involves developing lesson plans, fostering a positive classroom environment, and collaborating with parents and staff to support student success.', 'Bachelor’s degree in Education or a related field.\r\nTeaching certification in the state of Texas.\r\nExperience teaching elementary school students is preferred.\r\nStrong interpersonal and communication skills.\r\nCreativity, patience, and a passion for teaching.', '2024-11-29', 'jobs@brightmindsacademy.com | (555) 123-4567', 'active', '2024-11-27 02:36:40', '2024-11-27 02:36:40');

-- --------------------------------------------------------

--
-- Table structure for table `motivation_for_studies`
--

CREATE TABLE `motivation_for_studies` (
  `id` int(11) NOT NULL,
  `motivation` enum('promotion','professional_development','other') NOT NULL,
  `other_motivation` varchar(255) DEFAULT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `motivation_for_studies`
--

INSERT INTO `motivation_for_studies` (`id`, `motivation`, `other_motivation`, `student_id`) VALUES
(1, 'promotion', NULL, 1),
(3, 'other', NULL, 2),
(4, 'professional_development', NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `place_of_work`
--

CREATE TABLE `place_of_work` (
  `id` int(11) NOT NULL,
  `local_place` varchar(255) DEFAULT NULL,
  `abroad_place` varchar(255) DEFAULT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `place_of_work`
--

INSERT INTO `place_of_work` (`id`, `local_place`, `abroad_place`, `student_id`) VALUES
(1, 'Seait', 'New York', 1),
(3, '', '', 2),
(4, 'vsdv', 'sdv', 2);

-- --------------------------------------------------------

--
-- Table structure for table `present_employment_status`
--

CREATE TABLE `present_employment_status` (
  `id` int(11) NOT NULL,
  `employment_status_current` enum('Regular or Permanent','Temporary','Casual','Contractual','Self-employed','Unemployed') NOT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `present_employment_status`
--

INSERT INTO `present_employment_status` (`id`, `employment_status_current`, `student_id`) VALUES
(1, 'Regular or Permanent', 1),
(3, 'Unemployed', 2);

-- --------------------------------------------------------

--
-- Table structure for table `professional_examinations`
--

CREATE TABLE `professional_examinations` (
  `id` int(11) NOT NULL,
  `exam_name` varchar(255) NOT NULL,
  `date_taken` date DEFAULT NULL,
  `rating` varchar(50) DEFAULT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `professional_examinations`
--

INSERT INTO `professional_examinations` (`id`, `exam_name`, `date_taken`, `rating`, `student_id`) VALUES
(1, 'Civil Engineering Licensure Exam', '0000-00-00', '85%', 1),
(2, 'Licensed Teacher Examination', '0000-00-00', '90%', 1),
(5, 'Exam1', '0000-00-00', '90', 2),
(6, 'Exam2', '0000-00-00', '', 2),
(7, 'sdvsd', '2024-11-05', 'vsdv', 2),
(8, 'vsdvsd', '2024-10-29', 'sdvsd', 2);

-- --------------------------------------------------------

--
-- Table structure for table `professional_skills`
--

CREATE TABLE `professional_skills` (
  `id` int(11) NOT NULL,
  `skill` varchar(255) NOT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `professional_skills`
--

INSERT INTO `professional_skills` (`id`, `skill`, `student_id`) VALUES
(1, 'Java', 1),
(3, 'Nothing Special', 2),
(4, 'sdvsdv', 2);

-- --------------------------------------------------------

--
-- Table structure for table `reasons_accepting`
--

CREATE TABLE `reasons_accepting` (
  `id` int(11) NOT NULL,
  `reason_accepting` enum('Salaries and Benefits','Career Challenge','Related to Special Skills','Proximity to Residence','Other Reason(s)') NOT NULL,
  `other_reason` varchar(255) DEFAULT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reasons_accepting`
--

INSERT INTO `reasons_accepting` (`id`, `reason_accepting`, `other_reason`, `student_id`) VALUES
(1, 'Related to Special Skills', NULL, 1),
(2, 'Proximity to Residence', NULL, 1),
(5, 'Salaries and Benefits', NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `reasons_changing`
--

CREATE TABLE `reasons_changing` (
  `id` int(11) NOT NULL,
  `reason_changing` enum('Salaries and Benefits','Career Challenge','Related to Special Skills','Proximity to Residence','Other Reason(s)') NOT NULL,
  `other_reason` varchar(255) DEFAULT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reasons_changing`
--

INSERT INTO `reasons_changing` (`id`, `reason_changing`, `other_reason`, `student_id`) VALUES
(1, 'Career Challenge', NULL, 1),
(2, 'Related to Special Skills', NULL, 1),
(4, 'Salaries and Benefits', NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `reasons_not_employed`
--

CREATE TABLE `reasons_not_employed` (
  `id` int(11) NOT NULL,
  `reason_not_employed` enum('Advance or Further Study','Family Concern and Decided Not to Find a Job','Health Related Reason(s)','Lack of Work Experience','No Job Opportunity','Did Not Look for a Job','Other Reason(s)') NOT NULL,
  `other_reason` varchar(255) DEFAULT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reasons_staying`
--

CREATE TABLE `reasons_staying` (
  `id` int(11) NOT NULL,
  `reason_staying` enum('Salaries and Benefits','Career Challenge','Related to Special Skill','Related to Course or Program of Study','Proximity to Residence','Peer Influence','Family Influence','Other Reason(s)') NOT NULL,
  `other_reason` varchar(255) DEFAULT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reasons_staying`
--

INSERT INTO `reasons_staying` (`id`, `reason_staying`, `other_reason`, `student_id`) VALUES
(1, 'Salaries and Benefits', NULL, 1),
(2, 'Career Challenge', NULL, 1),
(6, 'Salaries and Benefits', NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `school_id` varchar(50) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `department_code` varchar(50) NOT NULL,
  `control_code` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `activation_token` varchar(64) DEFAULT NULL,
  `token_expiration` datetime DEFAULT NULL,
  `account_status` enum('pending','active','inactive','suspended') DEFAULT 'pending',
  `role` varchar(20) DEFAULT 'student',
  `password_hash` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `school_id`, `full_name`, `course`, `department_code`, `control_code`, `email`, `batch_id`, `created_at`, `updated_at`, `activation_token`, `token_expiration`, `account_status`, `role`, `password_hash`) VALUES
(1, '2021-02892', 'Angelo Salem', 'BS Business Administration Major in Marketing Management (BSBA)', 'CBM-607', 'BSBA-746952', 'angelosalem173.30@gmail.com', 2, '2024-11-11 13:47:08', '2024-11-11 13:47:52', NULL, '2024-11-12 14:47:08', 'active', 'student', '$2y$10$jnr4WcCmWT/z/T3Ue0QNcOTmp5IHM/uBYhzsD87PYbdlDimb97nTC'),
(2, '2022-08976', 'Testing Shesh', 'BS Information Technology (BSIT)', 'CET-977', 'BSIT-903448', 'frapezake@gmail.com', 3, '2024-11-12 00:40:05', '2024-11-12 00:40:23', NULL, '2024-11-13 01:40:05', 'active', 'student', '$2y$10$F9xNBjqy8fBEpqKp6Kn6Q.wGnPE/m1AJq7iyEc7izZHkMaNqXZGAu');

-- --------------------------------------------------------

--
-- Table structure for table `time_to_land_first_job`
--

CREATE TABLE `time_to_land_first_job` (
  `id` int(11) NOT NULL,
  `time_to_first_job` enum('less_than_month','1_6_months','7_11_months','1_2_years','2_3_years','3_4_years','others') NOT NULL,
  `other_time` varchar(255) DEFAULT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `time_to_land_first_job`
--

INSERT INTO `time_to_land_first_job` (`id`, `time_to_first_job`, `other_time`, `student_id`) VALUES
(1, '7_11_months', '', 1),
(3, 'less_than_month', '', 2);

-- --------------------------------------------------------

--
-- Table structure for table `training_and_advanced_studies`
--

CREATE TABLE `training_and_advanced_studies` (
  `id` int(11) NOT NULL,
  `training_title` varchar(255) NOT NULL,
  `duration_and_credits` varchar(255) NOT NULL,
  `institution` varchar(255) NOT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `training_and_advanced_studies`
--

INSERT INTO `training_and_advanced_studies` (`id`, `training_title`, `duration_and_credits`, `institution`, `student_id`) VALUES
(1, 'Data Science Certification', '6 months, 15 credits', 'Tech Institute of Innovation', 1),
(2, 'Advanced Project Management', '3 months, 10 credits', 'Business College of Excellence', 1),
(3, 'Leadership Development Program', '1 year, 30 credits', 'University of Global Leadership', 1),
(7, '', '', '', 2),
(8, '', '', '', 2),
(9, '', '', '', 2),
(10, 'sdv', 'sdvs', 'dvsd', 2),
(11, 'sdv', 'sdv', 'vsd', 2),
(12, 'sdv', 'sdv', 'vsdv', 2);

-- --------------------------------------------------------

--
-- Table structure for table `useful_competencies`
--

CREATE TABLE `useful_competencies` (
  `id` int(11) NOT NULL,
  `useful_competencies` enum('Communication Skills','Human Relations Skills','Entrepreneurial skills','Information Technology Skills','Problem-solving skills','Critical Thinking skills','Other Reason(s)') NOT NULL,
  `other_competency` varchar(255) DEFAULT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `useful_competencies`
--

INSERT INTO `useful_competencies` (`id`, `useful_competencies`, `other_competency`, `student_id`) VALUES
(1, 'Communication Skills', '', 1),
(2, 'Human Relations Skills', '', 1),
(3, 'Entrepreneurial skills', '', 1),
(9, 'Communication Skills', '', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `user_type` enum('admin','student') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `middlename`, `lastname`, `username`, `password`, `created_at`, `user_type`) VALUES
(1, 'John', 'Doe', 'Dela Cruz', 'admin', '$2y$10$ycpH1NRlv8f9eGPAaEllX.2XqdvWPUlpdxBd38RXW5PxEJuDuHuUW', '2024-11-11 13:46:34', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `values_learned`
--

CREATE TABLE `values_learned` (
  `id` int(11) NOT NULL,
  `values_learned` enum('Family Spirit','Presence','Marian','Honesty','Preference for the Least Favored','Respect for the Integrity of Creation','Love of Work','Simplicity','Justice and Peace','Others') NOT NULL,
  `other_value` varchar(255) DEFAULT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `values_learned`
--

INSERT INTO `values_learned` (`id`, `values_learned`, `other_value`, `student_id`) VALUES
(1, 'Family Spirit', '', 1),
(2, 'Presence', '', 1),
(3, 'Marian', '', 1),
(7, 'Family Spirit', '', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `batches`
--
ALTER TABLE `batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `best_features`
--
ALTER TABLE `best_features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `community_services`
--
ALTER TABLE `community_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_information`
--
ALTER TABLE `company_information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `current_occupation`
--
ALTER TABLE `current_occupation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `curriculum_improvement`
--
ALTER TABLE `curriculum_improvement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `curriculum_relevance`
--
ALTER TABLE `curriculum_relevance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `degree_reasons`
--
ALTER TABLE `degree_reasons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `educational_attainment`
--
ALTER TABLE `educational_attainment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employment_status`
--
ALTER TABLE `employment_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `first_job_after_college`
--
ALTER TABLE `first_job_after_college`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `first_job_duration`
--
ALTER TABLE `first_job_duration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `first_job_related_to_course`
--
ALTER TABLE `first_job_related_to_course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general_information`
--
ALTER TABLE `general_information`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_address` (`email_address`);

--
-- Indexes for table `initial_gross_monthly_earning`
--
ALTER TABLE `initial_gross_monthly_earning`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_finding_methods`
--
ALTER TABLE `job_finding_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_positions`
--
ALTER TABLE `job_positions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_postings`
--
ALTER TABLE `job_postings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `motivation_for_studies`
--
ALTER TABLE `motivation_for_studies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `place_of_work`
--
ALTER TABLE `place_of_work`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `present_employment_status`
--
ALTER TABLE `present_employment_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `professional_examinations`
--
ALTER TABLE `professional_examinations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `professional_skills`
--
ALTER TABLE `professional_skills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reasons_accepting`
--
ALTER TABLE `reasons_accepting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reasons_changing`
--
ALTER TABLE `reasons_changing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reasons_not_employed`
--
ALTER TABLE `reasons_not_employed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reasons_staying`
--
ALTER TABLE `reasons_staying`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `time_to_land_first_job`
--
ALTER TABLE `time_to_land_first_job`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `training_and_advanced_studies`
--
ALTER TABLE `training_and_advanced_studies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `useful_competencies`
--
ALTER TABLE `useful_competencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `values_learned`
--
ALTER TABLE `values_learned`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `batches`
--
ALTER TABLE `batches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `best_features`
--
ALTER TABLE `best_features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `community_services`
--
ALTER TABLE `community_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `company_information`
--
ALTER TABLE `company_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `current_occupation`
--
ALTER TABLE `current_occupation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `curriculum_improvement`
--
ALTER TABLE `curriculum_improvement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `curriculum_relevance`
--
ALTER TABLE `curriculum_relevance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `degree_reasons`
--
ALTER TABLE `degree_reasons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `educational_attainment`
--
ALTER TABLE `educational_attainment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `employment_status`
--
ALTER TABLE `employment_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `first_job_after_college`
--
ALTER TABLE `first_job_after_college`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `first_job_duration`
--
ALTER TABLE `first_job_duration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `first_job_related_to_course`
--
ALTER TABLE `first_job_related_to_course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `general_information`
--
ALTER TABLE `general_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `initial_gross_monthly_earning`
--
ALTER TABLE `initial_gross_monthly_earning`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `job_finding_methods`
--
ALTER TABLE `job_finding_methods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `job_positions`
--
ALTER TABLE `job_positions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `job_postings`
--
ALTER TABLE `job_postings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `motivation_for_studies`
--
ALTER TABLE `motivation_for_studies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `place_of_work`
--
ALTER TABLE `place_of_work`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `present_employment_status`
--
ALTER TABLE `present_employment_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `professional_examinations`
--
ALTER TABLE `professional_examinations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `professional_skills`
--
ALTER TABLE `professional_skills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reasons_accepting`
--
ALTER TABLE `reasons_accepting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reasons_changing`
--
ALTER TABLE `reasons_changing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reasons_not_employed`
--
ALTER TABLE `reasons_not_employed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reasons_staying`
--
ALTER TABLE `reasons_staying`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `time_to_land_first_job`
--
ALTER TABLE `time_to_land_first_job`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `training_and_advanced_studies`
--
ALTER TABLE `training_and_advanced_studies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `useful_competencies`
--
ALTER TABLE `useful_competencies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `values_learned`
--
ALTER TABLE `values_learned`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
