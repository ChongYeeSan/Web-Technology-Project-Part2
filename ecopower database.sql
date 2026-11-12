-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2026 at 07:18 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecopower`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `member_id` int(11) NOT NULL,
  `member_name` varchar(100) NOT NULL,
  `project1_contribution` text NOT NULL,
  `project2_contribution` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`member_id`, `member_name`, `project1_contribution`, `project2_contribution`) VALUES
(1, 'Vishnu', 'Created Index page\r\nHelp with designed the Home page, Website layout, CSS styling', 'Created search.php'),
(2, 'Navya', 'Created Job page\r\nHelp with designed the Home page, Website layout, CSS styling', 'Created manage.php'),
(3, 'Chong Yee San', 'Created Apply page and CSS\r\nCoordinates deadlines, Submit final ZIP files, and Update Jira board', 'Created process_eoi.php'),
(4, 'Tiang Yong Wei', 'Created About page\r\nHelped with CSS styling', 'Created settings.php\r\nCreated Database');

-- --------------------------------------------------------

--
-- Table structure for table `eoi`
--

CREATE TABLE `eoi` (
  `EOInumber` int(11) NOT NULL,
  `job_ref` char(5) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(10) NOT NULL,
  `street_address` varchar(40) NOT NULL,
  `suburb` varchar(40) NOT NULL,
  `state` varchar(10) NOT NULL,
  `postcode` char(4) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `skills` varchar(255) DEFAULT NULL,
  `other_skills` text DEFAULT NULL,
  `status` enum('New','Current','Final') NOT NULL DEFAULT 'New'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eoi`
--

INSERT INTO `eoi` (`EOInumber`, `job_ref`, `first_name`, `last_name`, `dob`, `gender`, `street_address`, `suburb`, `state`, `postcode`, `email`, `phone`, `skills`, `other_skills`, `status`) VALUES
(1, 'RE026', 'John', 'Tan', '2005-05-15', 'Male', '12 Main Street', 'Melbourne', 'victoria', '3000', 'John@gmail.com', '0123456789', 'programming', '', 'New'),
(2, 'SG104', 'Chlease', 'Tan', '2005-05-15', 'Female', '12 Main Street', 'Melbourne', 'victoria', '3000', 'John@gmail.com', '0123456789', 'programming', '', 'New'),
(3, 'RE026', 'Chloe', 'Ling', '2010-10-06', 'Female', '63, Taman Bunga Ros', 'Malaysia', 'Kuala Lump', '4570', 'chloe@gmail.com', '0195869523', 'programming', NULL, 'New');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `job_ref` char(5) NOT NULL,
  `title` varchar(100) NOT NULL,
  `salary` varchar(50) DEFAULT NULL,
  `reports_to` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `responsibilities` text DEFAULT NULL,
  `requirements` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`job_ref`, `title`, `salary`, `reports_to`, `description`, `responsibilities`, `requirements`) VALUES
('RE026', 'Site Supervisor (Renewable Energy)', 'MYR 3,500 - MYR 5,000 per month', 'Project Manager', 'Supervise daily on-site solar engineering installations and civil project milestones. Coordinates subcontractor workflows, enforces workplace health and safety compliance, and reports site performance metrics back to the central tracking network.', 'On-Site Supervision: Oversee day-to-day civil and electrical installation activities of commercial solar photovoltaic (PV) systems.\r\nSafety & Compliance: Enforce workplace health, safety, and environmental protection regulations on-site to maintain zero-incident operations.\r\nProgress Logging: Record Physical installation milestones and submit field metrics to the corporate operations and maintenance tracking system.', 'Education: Diploma or Bachelor\'s Degree in Civil Engineering, Electrical Engineering, or a related field.\r\nExperience: Minimum of 2 years of hands-on experience in on-site construction supervision or solar PV installations.\r\nCertification: Valid CIDB Green Card for site safety compliance in Malaysia.\r\nSkills: Strong familiarity with NET Energy Metering (NEM) guidelines and local grid connection regulations.'),
('SG104', 'Solar Sales Consultant', 'MYR 3,500 - MYR 4,500 per month', 'Sales Manager', 'You will transform company-provided leads into successful closings, owning the end-to-end customer journey from first contact to final handover as a solution consultant for Ecopower.', 'Effectively manage and convert company generated leads that has been assigned daily.\r\nBuild strong customer relationships and ensure satisfaction through follow-ups.\r\nTake full ownership of sales process from lead assignment to final customer handover.', 'Education: Bachelor\'s Degree in Business, Engineering or any related field is preferable.\r\nExperience in Consultative Selling, including identifying customer needs and recommend tailored solutions.\r\nProactive and goal-oriented with ability to meet and exceed sales targets.\r\nFluent in multiple languages like Bahasa Melayu, English, and Chinese.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `eoi`
--
ALTER TABLE `eoi`
  ADD PRIMARY KEY (`EOInumber`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`job_ref`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `eoi`
--
ALTER TABLE `eoi`
  MODIFY `EOInumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
