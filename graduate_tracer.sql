-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2025 at 05:34 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `graduate_tracer`
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
(1, 'Batch 2020-2021', 2020, 0),
(2, 'Batch 2021-2022', 2021, 0),
(3, 'Batch 2022-2023', 2022, 0);

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
(2, 'Administration', '', 4),
(3, 'Library', '', 4),
(4, 'Faculty', '', 4),
(5, 'Laboratories', '', 4),
(6, 'Instruction', '', 4),
(7, 'Administration', '', 2),
(8, 'Library', '', 2),
(9, 'Faculty', '', 2),
(10, 'Laboratories', '', 2);

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
(2, 'Medical Mission Volunteer', 4),
(3, 'Community Service', 2);

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
(2, 'St. Luke’s Medical Center – Quezon City 279 E Rodriguez Sr. Avenue, Quezon City, Metro Manila, Philippines', 4),
(3, 'Tech Solutions Corp., 123 Main Street, Makati, Philippines', 2);

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
(2, 'Hospital Administrative Officer', 4),
(3, 'Electrical Engineer', 2);

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
(2, 'Include More Hands-On Practicum or Internships', 4),
(3, 'Incorporate More Practical Hands-On Projects', 2);

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
(1, 'yes', 4),
(2, 'yes', 2);

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
(2, 0, 0, '', 4),
(3, 0, 0, '', 2);

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
(5, 'Certification', 'Available for Release', '2024-11-29', 'Please follow these steps to claim your documents:\\r\\n\\r\\nVerify Document Readiness: Ensure the document is ready for release by checking with the registrar\\\'s office via email or phone.\\r\\nBring Required Documents:\\r\\nA valid photo ID (e.g., school ID, driver’s license, or passport).\\r\\nFor third-party claimants, provide:\\r\\nAn authorization letter signed by the document owner.\\r\\nPhotocopies of both the claimant’s and the document owner’s IDs.\\r\\nClaiming Schedule:\\r\\nDocuments can be claimed during office hours (9:00 AM to 4:00 PM, Monday to Friday).\\r\\nIf unable to visit during these hours, contact the office to arrange an alternative.\\r\\nProcessing Fee: Ensure that any processing fees are fully paid. Bring the receipt as proof of payment if required.\\r\\nClaim Deadline: Collect the document within 60 days of the release date to avoid penalties or re-application requirements.\\r\\nFor inquiries, email registrar@schoolname.edu or call (123) 987-6543.'),
(6, 'Transcript', 'Available for Release', '2025-05-30', 'test'),
(7, 'Diploma', 'Available for Release', '2025-05-20', 'testset');

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
(3, 'Bachelor of Science in Hospital Management', 'University of Santo Tomas', '2025-04-01', 'Cum Laude, Best Internship Award', 4),
(4, '', '', '0000-00-00', '', 4),
(5, 'Bachelor of Science in Computer Science', 'South East Asian Institute of Technology', '2025-04-08', 'Cum Laude', 2),
(6, '', '', '0000-00-00', '', 2);

-- --------------------------------------------------------

--
-- Table structure for table `employment_sector`
--

CREATE TABLE `employment_sector` (
  `id` int(11) NOT NULL,
  `sector` enum('Government','Non-Government') NOT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employment_sector`
--

INSERT INTO `employment_sector` (`id`, `sector`, `student_id`) VALUES
(1, 'Government', 4),
(2, 'Government', 2);

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
(2, 'yes', 4),
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
(1, 'yes', 4),
(2, 'no', 2);

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
(1, '7_11_months', '', 2);

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
(1, 'yes', 4);

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
(2, 'Hizel Carom', 'hizelmaycarom0@gmail.com', 'N/A', '09876453287', 'Single', '2025-04-05', 'Region 12 - SOCCSKSARGEN', 'South Cotabato', 'Purok 1, Dumadalig', 'Tantangan', 4),
(3, 'Angelo Salem', 'angelosalem173.30@gmail.com', 'N/A', '09362629063', 'Single', '2025-02-18', 'Region 12 - SOCCSKSARGEN', 'South Cotabato', 'Prk. 8A Subdivission', 'Tupi', 2);

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
(1, 27000.00, 2);

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
(1, 'As Walk-In Applicant', '', 2);

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
(1, 'Junior Software Developer', 'Electrical Engineer', 2);

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
(4, 'Tech Innovators Inc.', NULL, 'New York, NY, USA', 'Software Developer', 'We are seeking a talented and motivated Software Developer to join our dynamic team. The role involves designing, coding, and maintaining software applications, collaborating with cross-functional teams, and contributing to innovative technology projects', 'Bachelor’s degree in Computer Science, Software Engineering, or a related field.\r\nProficiency in programming languages like Python, Java, or C#.\r\nExperience with front-end frameworks (React, Angular, or Vue).\r\nStrong problem-solving skills and attention to detail.\r\nExcellent communication and teamwork abilities.', '2024-11-27', 'hr@techinnovators.com | (123) 456-7890', 'active', '2024-11-27 02:34:25', '2025-04-29 07:21:07'),
(5, 'Green Horizons Environmental Solutions', '../uploads/images-removebg-preview (1).png', 'Los Angeles, CA, USA', 'Environmental Project Manager', 'Green Horizons is looking for an experienced Environmental Project Manager to lead and execute sustainability projects. The candidate will manage environmental compliance, oversee project timelines and budgets, and collaborate with stakeholders to implement green initiatives.', 'Bachelor’s degree in Environmental Science, Engineering, or a related field.\r\nAt least 3 years of experience in project management or environmental consulting.\r\nStrong understanding of environmental regulations and sustainability practices.\r\nExceptional organizational and leadership skills.\r\nProficiency in project management tools like MS Project or Asana.', '2024-11-28', 'careers@greenhorizons.com | (987) 654-3210', 'active', '2024-11-27 02:35:44', '2024-11-27 02:35:44'),
(6, 'Bright Minds Academy', '../uploads/Purple Minimalist Illustrated Night Waterfall Landscape Desktop Wallpaper (11).jpg', 'Austin, TX, USA', 'Elementary School Teacherv', 'Bright Minds Academy is hiring a passionate and dedicated Elementary School Teacher to inspire and educate young learners. The role involves developing lesson plans, fostering a positive classroom environment, and collaborating with parents and staff to support student success.', 'Bachelor’s degree in Education or a related field.\r\nTeaching certification in the state of Texas.\r\nExperience teaching elementary school students is preferred.\r\nStrong interpersonal and communication skills.\r\nCreativity, patience, and a passion for teaching.', '2024-11-29', 'jobs@brightmindsacademy.com | (555) 123-4567', 'active', '2024-11-27 02:36:40', '2024-11-27 02:36:40'),
(8, 'Jollibee Foods Corporation', NULL, 'Davao City, Davao del Sur', 'Service Crew', 'Provide excellent customer service, handle cashier and kitchen duties, maintain cleanliness and assist in daily store operations.', 'High school graduate or college level\r\n\r\nCustomer-oriented and energetic\r\n\r\nWilling to work on shifting schedules\r\n\r\nWith or without experience', '2025-06-15', 'jollibee.hr@jfc.com.ph | (082) 221-1234', 'active', '2025-05-02 00:56:18', '2025-05-02 00:56:18'),
(9, 'Metrobank - Metrobank Foundation Inc.', '../uploads/images.png', 'Makati City', 'Marketing Associate', 'Support marketing campaigns, develop promotional materials, assist in event organization, and coordinate with external partners.', 'Bachelor’s degree in Marketing, Communications, or related fields\r\n\r\nStrong written and verbal communication skills\r\n\r\nProficient in MS Office and Adobe Creative Suite\r\n\r\nAt least 1 year of related experience', '2025-06-07', 'careers@metrobank.com.ph | (02) 8988-0000', 'active', '2025-05-02 00:57:32', '2025-05-02 00:57:32'),
(10, 'PLDT Inc.', '../uploads/download.png', 'Cebu City, Cebu', 'Network Field Technician', 'Responsible for installation, repair, and maintenance of broadband and fiber optic lines.', 'Technical/Vocational graduate in Electronics or IT\r\n\r\nWith knowledge in fiber optics preferred\r\n\r\nMust have a valid driver’s license\r\n\r\nPhysically fit and willing to work on the field', '2025-08-01', 'pldtjobs@pldt.com.ph | (032) 233-7890', 'active', '2025-05-02 00:58:37', '2025-05-02 00:58:37');

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
(2, 'professional_development', NULL, 4),
(3, 'promotion', NULL, 2);

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

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `description`, `image`, `created_at`) VALUES
(11, '𝐀 𝐅𝐔𝐓𝐔𝐑𝐄 𝐂𝐔𝐋𝐓𝐈𝐕𝐀𝐓𝐎𝐑 𝐎𝐅 𝐒𝐔𝐂𝐂𝐄𝐒𝐒  | 𝐒𝐄𝐀𝐈𝐓 𝐀𝐥𝐮𝐦𝐧𝐮𝐬 𝐄𝐦𝐛𝐚𝐫𝐤 𝐨𝐧 𝐏𝐫𝐞𝐬𝐭𝐢𝐠𝐢𝐨𝐮𝐬 𝐈𝐧𝐭𝐞𝐫𝐧𝐬𝐡𝐢𝐩 𝐢𝐧 𝐓𝐚𝐢𝐰𝐚𝐧  ', '<p>An outstanding Mr. Darwin Serenio, an alumnus of SEAIT Batch 2023-2024 from the Department of Agriculture and Fisheries, majoring in Plant Breeding and Genetics, is set to begin his journey as part of the Filipino Young Farmers Internship Program in Taiwan (FYFIPT) Batch Five. Following his successful completion of the Pre-Departure Orientation Course (PDOC), he departed last November 12, 2024, for an 11-month hands-on experience aimed at advancing their agricultural expertise. The internship program, designed to enhance modern farming techniques, equips participants with knowledge in innovative agricultural practices, marketing strategies, and cooperative management. Together with him are Ferlan Donato from Tulunan, Cotabato; Honey Pablo from South Upi, Maguindanao del Sur; and Rennel Linaja from Midsayap, Cotabato, chosen for their exemplary dedication and potential to contribute to the agricultural sector. This opportunity offers a transformative opportunity for Serenio to embrace global standards and implement what they learn back home. By gaining practical experience and exposure in Taiwan\\\'s progressive farming systems, Serenio is expected to serve as catalysts for sustainable development in the community. Writer | Javisah CutayLay-out | John Sumagaysay </p>', '../uploads/674686994fb52-468565802_122226416360018176_2864165550812079597_n.jpg', '2024-11-27 02:40:25'),
(12, '𝐁𝐫𝐢𝐭𝐭𝐚𝐧𝐲 𝐓𝐚𝐦𝐚𝐲𝐨 𝐓𝐫𝐢𝐮𝐦𝐩𝐡𝐬 𝐚𝐭 𝐭𝐡𝐞 𝐌𝐚𝐥𝐚𝐲𝐬𝐢𝐚𝐧 𝐈𝐧𝐭𝐞𝐫𝐧𝐚𝐭𝐢𝐨𝐧𝐚𝐥 𝐉𝐮𝐧𝐢𝐨𝐫 𝐎𝐩𝐞𝐧', '<p>On November 23, a young lady showcased her golfing prowess at the Malaysian International Junior Open held at Tanjong Puteri Resort and Golf Club in Johor, Malaysia. She skillfully recorded six birdies, countered by four bogeys and a double bogey, to finish with an even-par 72.Building on her career-best round of 66 on Saturday, Tamayo finished the 36-hole event with an even-par score, finishing 11 strokes ahead of Indonesia\\\'s Annabelle Leimena and Korea\\\'s Lee Jiyeon in the girls\\\' Class C division.Brittany Tamayo: 138 (66-72). Source: Tribune GolfWriter | Cherlyn Manriquez </p>', '../uploads/674686bf26515-468353928_122226409610018176_3120630246917256199_n.jpg', '2024-11-27 02:41:03'),
(13, '\"𝐅𝐄𝐓𝐀 𝐂𝐨𝐦𝐦𝐞𝐧𝐜𝐞𝐬 𝐄𝐧𝐠𝐥𝐢𝐬𝐡 𝐅𝐞𝐬𝐭 𝐰𝐢𝐭𝐡 𝐭𝐡𝐞 𝐓𝐡𝐞𝐦𝐞: \"𝐄𝐥𝐞𝐦𝐞𝐧𝐭𝐚𝐥 𝐇𝐚𝐫𝐦𝐨𝐧𝐲: 𝐔𝐧𝐢𝐭𝐢𝐧𝐠 𝐭𝐡𝐞 𝐅𝐨𝐫𝐜𝐞𝐬 𝐨𝐟 𝐍𝐚𝐭𝐮𝐫𝐞\"', '<p>The Department of Secondary English Education celebrated their Anglos Day at the SEAIT Gymnasium on November 24, 2024. The event featured the crowning of Mr. and Ms. Anglos and concluded with the announcement of this year\\\'s new overall champions.Students from all year levels showcased their skills and talents in academic contests and socio-cultural events. Future English teachers also participated in a battle of intelligence and wit to claim the prestigious titles of Mr. and Ms. Anglos for this year\\\'s English Fest.By evening, Gentle Air\\\'s Mr. Xander Benz Colol claimed the title of Mr. Anglos, while Ms. Trixie Bigbig from Ferocious Fire won the title of Ms. Anglos. Furthermore, this year\\\'s overall results took an unexpected turn as Ferocious Fire (3rd-year students) emerged as the overall champion, securing the trophy with a score of 3188 points. Last year\\\'s champions, Serene Waters (4th-year students), followed closely with 3088.8 points. Gentle Air (2nd-year students) ranked third with a score of 2982.733 points, while Unshakable Earth (1st-year students) came in last with 2936.733 points.It was a fun and memorable night for the Department of Secondary English Education as they showcased their intellect and proved that they are true future educators.Writer: Princess Cabuguas | Angelie AlbercaPhotos: Norhan Sali | Princess Cabuguas</p>', '../uploads/674686eb86690-468354675_122226262856018176_3772411116372110980_n.jpg', '2024-11-27 02:41:47'),
(15, '𝗕𝗔𝗦𝗘𝗕𝗔𝗟𝗟 𝗙𝗜𝗥𝗘𝗙𝗢𝗫 𝗖𝗟𝗜𝗡𝗖𝗛 𝗧𝗛𝗜𝗥𝗗 𝗦𝗧𝗥𝗔𝗜𝗚𝗛𝗧 𝗡𝗔𝗧𝗜𝗢𝗡𝗔𝗟 𝗧𝗜𝗧𝗟𝗘', 'The baseball team of the South East Asian Institute of Technology, Inc. (SEAIT) secured their third consecutive national championship, marking a 3-peat victory at the Private Schools Athletic Association (PRISAA) National Games held in Tuguegarao City, Cagayan, on April 9.Known for their consistent performance, the team remained undefeated for the third straight year, showcasing steady skill and teamwork. In the final match against Region II, SEAIT delivered strong pitching and clean hitting, resulting in a decisive 9-0 win.The discipline instilled by coaches and trainers played a key role in the team’s success. Their guidance helped the players remain focused and grounded throughout the competition. Determination and preparation translated into results on the field.The SEAIT community takes pride in this accomplishment. With their third straight title, the team continues to bring recognition and honor to the institution.', '../uploads/6813a3a4f1719-489158679_122249808980018176_3708519562385978872_n.jpg', '2025-05-01 16:39:00');

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
(2, 'St. Luke’s Medical Center – Quezon City, Metro Manila, Philippines', '', 4),
(3, 'Nat\'l Highway, Crossing Rubber, Tupi, South Cotabato 9505', '', 2);

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
(2, 'Temporary', 4),
(3, 'Regular or Permanent', 2);

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
(3, 'Civil Service Professional Examination', '2025-04-23', '87.25%', 4),
(4, '', '0000-00-00', '', 4),
(5, 'Certified Information Systems Security Professional (CISSP)', '2025-04-09', '85%', 2),
(6, 'Licensure Examination for Teachers (LET)', '2025-04-08', '90%', 2);

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
(2, 'Inventory & Procurement Management', 4),
(3, 'Database Configuration', 2);

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
(1, 'Salaries and Benefits', NULL, 2),
(2, 'Career Challenge', NULL, 2),
(3, 'Related to Special Skills', NULL, 2),
(4, 'Proximity to Residence', NULL, 2);

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
(1, 'Salaries and Benefits', NULL, 4),
(2, 'Career Challenge', NULL, 4),
(3, 'Related to Special Skill', NULL, 4);

-- --------------------------------------------------------

--
-- Table structure for table `school_years`
--

CREATE TABLE `school_years` (
  `id` int(11) NOT NULL,
  `school_year` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `school_years`
--

INSERT INTO `school_years` (`id`, `school_year`, `created_at`) VALUES
(1, '2020-2021', '2025-04-29 11:13:02'),
(2, '2021-2022', '2025-04-29 12:10:36'),
(3, '2022-2023', '2025-04-29 12:10:48'),
(4, '2023-2024', '2025-05-02 13:10:48');

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
(2, '2021-02894', 'Angelo Salem', 'BS Information Technology (BSIT)', 'CET-710', 'BSIT-289409', 'angelosalem173.30@gmail.com', 1, '2025-04-29 12:30:25', '2025-04-29 12:30:44', NULL, '2025-04-30 14:30:25', 'active', 'student', '$2y$10$j5EUmU7ziQ/C.wg7tEY/T.j/j2CZ24jTsdy4vC2qbgGRbH4enVD.u'),
(4, '2026-98763', 'Hizel Carom', 'Associate in Hospitality Management (AHM)', 'CBM-047', 'AHM-246291', 'hizelmaycarom0@gmail.com', 1, '2025-04-29 13:43:30', '2025-04-29 13:45:09', NULL, '2025-04-30 15:43:30', 'active', 'student', '$2y$10$R9KeiGhU8CMrE1roBGjMze6D1vHaC.zKOoqNJs9DhZFRz9YI/BQ4q'),
(20, '2021-020894', 'Nigga Shit', 'BS Criminology (BSCrim)', 'CPR', 'CPR-4952', 'frapezake@gmail.com', 2, '2025-05-03 03:27:52', '2025-05-03 03:28:19', NULL, '2025-05-04 05:27:52', 'active', 'student', '$2y$10$75OZS1WpHwmrC/2r6V9RCO1.ampnZi/BNaaEJu2ugcYCNRBevvLBm');

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
(1, '1_6_months', '', 2);

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
(4, 'Hospital Quality Management and Accreditation', '3 Days (24 Training Hours)', 'Philippine Hospital Association', 4),
(5, '', '', '', 4),
(6, '', '', '', 4),
(7, 'Data Science Certification', '6 months, 15 credits', 'South East Asian Institute of Technology', 2),
(8, 'Project Management Professional (PMP)', '3 months 12 credits', 'Coursera (offered by Stanford University)', 2),
(9, '', '', '', 2);

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
(1, 'Communication Skills', '', 4),
(2, 'Human Relations Skills', '', 4),
(3, 'Entrepreneurial skills', '', 4),
(4, 'Problem-solving skills', '', 4),
(5, 'Critical Thinking skills', '', 4),
(6, 'Communication Skills', '', 2),
(7, 'Problem-solving skills', '', 2),
(8, 'Critical Thinking skills', '', 2);

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
(2, 'Family Spirit', '', 4),
(3, 'Presence', '', 4),
(4, 'Marian', '', 4),
(5, 'Honesty', '', 4),
(6, 'Love of Work', '', 4),
(7, 'Simplicity', '', 4),
(8, 'Justice and Peace', '', 4),
(9, 'Family Spirit', '', 2),
(10, 'Honesty', '', 2),
(11, 'Love of Work', '', 2),
(12, 'Simplicity', '', 2);

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
-- Indexes for table `employment_sector`
--
ALTER TABLE `employment_sector`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

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
-- Indexes for table `school_years`
--
ALTER TABLE `school_years`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `best_features`
--
ALTER TABLE `best_features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `community_services`
--
ALTER TABLE `community_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `company_information`
--
ALTER TABLE `company_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `current_occupation`
--
ALTER TABLE `current_occupation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `curriculum_improvement`
--
ALTER TABLE `curriculum_improvement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `curriculum_relevance`
--
ALTER TABLE `curriculum_relevance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `degree_reasons`
--
ALTER TABLE `degree_reasons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `educational_attainment`
--
ALTER TABLE `educational_attainment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `employment_sector`
--
ALTER TABLE `employment_sector`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employment_status`
--
ALTER TABLE `employment_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `first_job_after_college`
--
ALTER TABLE `first_job_after_college`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `first_job_duration`
--
ALTER TABLE `first_job_duration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `first_job_related_to_course`
--
ALTER TABLE `first_job_related_to_course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `general_information`
--
ALTER TABLE `general_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `initial_gross_monthly_earning`
--
ALTER TABLE `initial_gross_monthly_earning`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `job_finding_methods`
--
ALTER TABLE `job_finding_methods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `job_positions`
--
ALTER TABLE `job_positions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `job_postings`
--
ALTER TABLE `job_postings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `motivation_for_studies`
--
ALTER TABLE `motivation_for_studies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `place_of_work`
--
ALTER TABLE `place_of_work`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `present_employment_status`
--
ALTER TABLE `present_employment_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `professional_examinations`
--
ALTER TABLE `professional_examinations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `professional_skills`
--
ALTER TABLE `professional_skills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reasons_accepting`
--
ALTER TABLE `reasons_accepting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reasons_changing`
--
ALTER TABLE `reasons_changing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reasons_not_employed`
--
ALTER TABLE `reasons_not_employed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reasons_staying`
--
ALTER TABLE `reasons_staying`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `school_years`
--
ALTER TABLE `school_years`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `time_to_land_first_job`
--
ALTER TABLE `time_to_land_first_job`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `training_and_advanced_studies`
--
ALTER TABLE `training_and_advanced_studies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `useful_competencies`
--
ALTER TABLE `useful_competencies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `values_learned`
--
ALTER TABLE `values_learned`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
