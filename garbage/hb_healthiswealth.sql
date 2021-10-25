-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2021 at 10:09 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hb_healthiswealth`
--

-- --------------------------------------------------------

--
-- Table structure for table `doctorarea`
--

CREATE TABLE `doctorarea` (
  `doctor_ID` int(11) NOT NULL,
  `doctor_AadharNo` varchar(255) NOT NULL,
  `doctor_FirstName` varchar(50) NOT NULL,
  `doctor_LastName` varchar(50) NOT NULL,
  `doctor_DOB` date NOT NULL,
  `doctor_Gender` enum('male','female','other') NOT NULL,
  `doctor_ContactNu` varchar(11) NOT NULL,
  `doctor_WhatsAppNo` enum('yes','no') NOT NULL,
  `doctor_houseNo` varchar(50) NOT NULL,
  `doctor_Landmark` varchar(50) NOT NULL,
  `doctor_At` varchar(50) NOT NULL,
  `doctor_Post` varchar(50) NOT NULL,
  `doctor_Tah` varchar(50) NOT NULL,
  `doctor_Dist` varchar(50) NOT NULL,
  `doctor_pinCode` int(11) NOT NULL,
  `doctor_HealthInsurance` enum('yes','no') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctorarea`
--

INSERT INTO `doctorarea` (`doctor_ID`, `doctor_AadharNo`, `doctor_FirstName`, `doctor_LastName`, `doctor_DOB`, `doctor_Gender`, `doctor_ContactNu`, `doctor_WhatsAppNo`, `doctor_houseNo`, `doctor_Landmark`, `doctor_At`, `doctor_Post`, `doctor_Tah`, `doctor_Dist`, `doctor_pinCode`, `doctor_HealthInsurance`) VALUES
(1, '410128972834', 'Pradip', 'Jula', '1989-12-28', 'male', '8275297725', 'yes', '402', 'Near, Bhoot Wada', 'Dongargaon', 'Chichgarh', 'Deori', 'Gondia', 441901, 'no'),
(2, '410128972854', 'Umesh', 'Netam', '1991-12-12', 'male', '9403123453', 'yes', '', '', 'Deori', '', '', '', 441901, 'yes'),
(3, '410128972888', 'Khushal', 'Nikode', '1985-10-12', 'male', '9403120655', 'yes', '', '', '', '', 'Deori', 'Gondia', 441901, 'yes'),
(4, '410128972888', 'Naresh', 'Yerne', '1981-10-27', 'male', '9403123456', 'yes', '', '', '', '', 'Deori', 'Gondia', 441901, 'yes'),
(5, '410128972345', 'Pramilabai', 'Roshan', '1975-10-20', 'female', '9434455667', 'yes', '', '', '', '', 'Deori', 'Gondia', 441901, 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `doctorhospital`
--

CREATE TABLE `doctorhospital` (
  `doctorHospitalID` int(11) NOT NULL,
  `doctor_ID` int(11) NOT NULL,
  `hospital_ID` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctorhospital`
--

INSERT INTO `doctorhospital` (`doctorHospitalID`, `doctor_ID`, `hospital_ID`, `status`) VALUES
(1, 1, 1, 1),
(2, 2, 1, 1),
(3, 3, 2, 1),
(4, 4, 3, 1),
(5, 5, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hospitalarea`
--

CREATE TABLE `hospitalarea` (
  `hospitalID` int(11) NOT NULL,
  `hospitalName` varchar(200) NOT NULL,
  `hospitalPhone` varchar(200) NOT NULL,
  `hospitalAddress` varchar(200) NOT NULL,
  `hospitalPinCode` int(11) NOT NULL,
  `fees` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hospitalarea`
--

INSERT INTO `hospitalarea` (`hospitalID`, `hospitalName`, `hospitalPhone`, `hospitalAddress`, `hospitalPinCode`, `fees`) VALUES
(1, 'Navodaya Hospital', '9403148108', 'Deori', 441901, 100),
(2, 'Nikode Hospital', '9403148100', 'Deori', 441901, 150),
(3, 'Yerne Hospital', '9403148111', 'Deori', 441901, 200),
(4, 'PHC Chichgarh', '0712233445', 'Chichgarh', 441901, 10);

-- --------------------------------------------------------

--
-- Table structure for table `patientarea`
--

CREATE TABLE `patientarea` (
  `patient_ID` int(11) NOT NULL,
  `patient_AadharNo` varchar(255) NOT NULL,
  `patient_FirstName` varchar(50) NOT NULL,
  `patient_LastName` varchar(50) NOT NULL,
  `patient_DOB` date NOT NULL,
  `patient_Gender` enum('male','female','other') NOT NULL,
  `patient_ContactNu` varchar(11) NOT NULL,
  `patient_WhatsAppNo` enum('yes','no') NOT NULL,
  `patient_houseNo` varchar(50) NOT NULL,
  `patient_Landmark` varchar(50) NOT NULL,
  `patient_At` varchar(50) NOT NULL,
  `patient_Post` varchar(50) NOT NULL,
  `patient_Tah` varchar(50) NOT NULL,
  `patient_Dist` varchar(50) NOT NULL,
  `patient_pinCode` int(11) NOT NULL,
  `patient_HealthInsurance` enum('yes','no') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patientarea`
--

INSERT INTO `patientarea` (`patient_ID`, `patient_AadharNo`, `patient_FirstName`, `patient_LastName`, `patient_DOB`, `patient_Gender`, `patient_ContactNu`, `patient_WhatsAppNo`, `patient_houseNo`, `patient_Landmark`, `patient_At`, `patient_Post`, `patient_Tah`, `patient_Dist`, `patient_pinCode`, `patient_HealthInsurance`) VALUES
(1, '410128972860', 'Pravinkumar', 'Raut', '1991-12-28', 'male', '9403148108', 'yes', '402', 'Near, Bhoot Wada', 'Dewalgaon', 'Chichgarh', 'Deori', 'Gondia', 441901, 'no'),
(2, '', 'Raj', 'Raut', '1987-12-12', 'male', '9403148109', 'yes', '', '', 'Dewalgaon', '', '', '', 441901, 'yes'),
(3, '', 'Manoj', 'Raut', '1998-02-14', 'male', '9403148107', 'yes', '', '', 'Dewalgaon', '', '', '', 441901, 'yes'),
(4, '410128972860', 'Nandini', 'Raut', '2005-11-26', 'female', '9403148106', 'yes', '', '', 'Dewalgaon', '', '', '', 441901, 'yes'),
(5, '410128972860', 'Sanvi', 'Raut', '2014-12-12', 'female', '9403148105', 'yes', '', '', 'Dewalgaon', '', '', '', 441901, 'yes'),
(6, '410128972860', 'Aarohi', 'Raut', '2010-12-06', 'female', '9403148104', 'yes', '', '', 'Dewalgaon', '', '', '', 441901, 'yes'),
(7, '410128972878', 'Shwet', 'Raut', '2009-02-15', 'male', '9403148189 ', 'yes', '', '', 'Dewalgaon, Deori', '', '', '', 441901, 'yes'),
(8, '410128972867', 'Dilip', 'Dhangaye', '1991-06-13', 'male', '9637361050 ', 'yes', '', '', 'Dewalgaon', '', '', '', 441901, 'yes'),
(9, '410128972856', 'Test', '', '2019-12-01', 'female', '9637361051 ', 'yes', '', '', 'Dewalgaon', '', '', '', 441901, 'yes'),
(10, '410128972811', 'Test2', '', '1991-01-01', 'female', '9637361052 ', 'yes', '', '', 'Dewalgaon', '', '', '', 441901, 'yes'),
(11, '410128974565', 'Ashutosh', 'Mishra', '1992-04-24', 'male', '8982635875 ', 'yes', '', '', 'Ward no. 7 Indra Nagar Mauganj Riva', '', '', '', 486331, 'yes'),
(12, '410128972899', 'Jayesh', 'Ambade', '1998-06-18', 'male', '9579205523', 'yes', '', '', 'Dewalgaon, Chichgarh, Deori', '', '', '', 441901, 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `patienthospital`
--

CREATE TABLE `patienthospital` (
  `patientHospitalID` int(11) NOT NULL,
  `doctor_ID` int(11) NOT NULL,
  `hospitalID` int(11) NOT NULL,
  `patient_ID` int(11) NOT NULL,
  `allowedTime` datetime NOT NULL,
  `book_flag` tinyint(3) NOT NULL,
  `token_no` int(11) NOT NULL,
  `reason` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patienthospital`
--

INSERT INTO `patienthospital` (`patientHospitalID`, `doctor_ID`, `hospitalID`, `patient_ID`, `allowedTime`, `book_flag`, `token_no`, `reason`) VALUES
(1, 2, 1, 1, '2021-10-24 09:00:00', 2, 1, 'Cancelled booking'),
(2, 1, 1, 2, '2021-10-24 09:00:00', 1, 1, ''),
(3, 3, 2, 3, '2021-10-24 09:00:00', 1, 1, ''),
(4, 4, 3, 4, '2021-10-24 09:00:00', 1, 1, ''),
(5, 5, 4, 5, '2021-10-24 09:00:00', 1, 1, ''),
(228, 2, 1, 7, '2021-10-24 09:00:00', 1, 2, ''),
(229, 2, 1, 1, '2021-10-24 09:15:00', 1, 3, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doctorhospital`
--
ALTER TABLE `doctorhospital`
  ADD PRIMARY KEY (`doctorHospitalID`);

--
-- Indexes for table `hospitalarea`
--
ALTER TABLE `hospitalarea`
  ADD PRIMARY KEY (`hospitalID`);

--
-- Indexes for table `patientarea`
--
ALTER TABLE `patientarea`
  ADD PRIMARY KEY (`patient_ID`);

--
-- Indexes for table `patienthospital`
--
ALTER TABLE `patienthospital`
  ADD PRIMARY KEY (`patientHospitalID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `doctorhospital`
--
ALTER TABLE `doctorhospital`
  MODIFY `doctorHospitalID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hospitalarea`
--
ALTER TABLE `hospitalarea`
  MODIFY `hospitalID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `patientarea`
--
ALTER TABLE `patientarea`
  MODIFY `patient_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `patienthospital`
--
ALTER TABLE `patienthospital`
  MODIFY `patientHospitalID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=230;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
