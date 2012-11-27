-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 26, 2012 at 08:14 PM
-- Server version: 5.5.20
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `osap`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `title` varchar(30) DEFAULT NULL,
  `comment` varchar(500) NOT NULL,
  `commenters_name` varchar(20) DEFAULT NULL,
  `time` time NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `course_id`, `title`, `comment`, `commenters_name`, `time`, `date`) VALUES
(1, 1, 'First Comment', 'Mechanics is a fairly easy course if you apply most of the concepts. The teachers are great and labs are not as difficult as most other courses that you may come accross at UWI. I love mechanic and i would encourage anyone to do the this subject.', 'Warren Clough', '04:00:00', '2012-11-13'),
(2, 1, 'Worst Subject', 'For me mechanic was difficult and I could not grasp most of the concepts. The subject is not really difficult but if I had applied myself I would have been a lot easier.', 'Random Person', '04:48:00', '2012-11-11');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(30) NOT NULL,
  `subject` varchar(30) NOT NULL,
  `type` varchar(30) NOT NULL,
  `code` varchar(10) NOT NULL,
  `faculty` varchar(30) NOT NULL,
  `simester` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `credit` int(11) NOT NULL,
  `description` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `title`, `subject`, `type`, `code`, `faculty`, `simester`, `level`, `credit`, `description`) VALUES
(1, 'Mechanics', 'Physics', 'Theory', 'PHY140A', 'Pure and Applied Sciences', 1, 1, 3, 'Mechanics is the branch of Physics dealing with the study of motion. No matter what your interest in science or engineering, mechanics will be important for you - motion is a fundamental idea in all of science.  Mechanics can be divided into 2 areas - kinematics, dealing with describing motions, and dynamics, dealing with the causes of motion.'),
(2, 'Electricity and Magnetism', 'Physics', 'Theory', 'PHY1421A', 'Pure and Applied Sciences', 2, 1, 3, 'To explain some phenomena, such as interference and diffraction of light, it is necessary to go beyond geometrical optics.');

-- --------------------------------------------------------

--
-- Table structure for table `course_grades`
--

CREATE TABLE IF NOT EXISTS `course_grades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `course_grade` double NOT NULL,
  `exam_grade` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `course_grades`
--

INSERT INTO `course_grades` (`id`, `course_id`, `student_id`, `course_grade`, `exam_grade`) VALUES
(1, 1, 1, 33.1, 53.2);

-- --------------------------------------------------------

--
-- Table structure for table `course_requirements`
--

CREATE TABLE IF NOT EXISTS `course_requirements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `labs` int(11) NOT NULL,
  `lectures` int(11) NOT NULL,
  `tutorial` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `course_requirements`
--

INSERT INTO `course_requirements` (`id`, `course_id`, `labs`, `lectures`, `tutorial`) VALUES
(1, 1, 1, 3, 1),
(2, 2, 1, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `lecturer`
--

CREATE TABLE IF NOT EXISTS `lecturer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lecturer_name` varchar(30) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `lecturer`
--

INSERT INTO `lecturer` (`id`, `lecturer_name`, `email`) VALUES
(1, 'VICTOR DOUSE', 'douce.victor@edu.jm'),
(2, 'Cherri-Ann C. Scarlett ', 'scarlett_cherri-ann@edu.jm'),
(3, 'Javian C. Malcom', 'malcom.javian@edu.jm'),
(4, 'Kimberly A. Stephenson', 'stephenson@kimberly@edu.jm'),
(5, 'Stacyann Nelson', 'nelson.stacyann@edu.jm');

-- --------------------------------------------------------

--
-- Table structure for table `lecture_map`
--

CREATE TABLE IF NOT EXISTS `lecture_map` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `schedule_id` int(11) NOT NULL,
  `lecturer_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `lecture_map`
--

INSERT INTO `lecture_map` (`id`, `schedule_id`, `lecturer_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 4, 1),
(4, 3, 2),
(5, 3, 3),
(6, 5, 4),
(7, 6, 4),
(8, 7, 5);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `senders_id` int(11) NOT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `receiver_username` varchar(30) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `message` text NOT NULL,
  `sent_date` date NOT NULL,
  `attachments` blob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `prerequisite`
--

CREATE TABLE IF NOT EXISTS `prerequisite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_title` varchar(30) NOT NULL,
  `grade` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `registered_courses`
--

CREATE TABLE IF NOT EXISTS `registered_courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `registered_courses`
--

INSERT INTO `registered_courses` (`id`, `student_id`, `schedule_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE IF NOT EXISTS `schedule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `crn` int(11) NOT NULL,
  `capacity` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `day` varchar(20) DEFAULT NULL,
  `time` time NOT NULL,
  `room` varchar(30) NOT NULL,
  `type` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `crn` (`crn`),
  UNIQUE KEY `crn_2` (`crn`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`id`, `crn`, `capacity`, `course_id`, `day`, `time`, `room`, `type`) VALUES
(1, 6564, 150, 1, 'Mon', '08:00:00', 'PHYS CHEM LECTURE THEATER', 'Lecture'),
(2, 6567, 150, 1, 'THUR', '10:00:00', 'PHYS CHEM LECTURE THEATER', 'Lecture'),
(3, 4454, 50, 1, 'Tue', '09:00:00', 'P14 LAB', 'Lab'),
(4, 1289, 150, 1, 'Fri', '10:00:00', 'PHYS CHEM LECTURE THEATER', 'Lecture'),
(5, 293, 150, 2, 'Wend', '17:00:00', 'P04 Lecture Theater A', 'Lecture'),
(6, 8943, 150, 2, 'Tue', '15:00:00', 'P04 Lecture Theater A', 'Lecture'),
(7, 87263, 20, 2, 'Fri', '11:00:00', 'Room 2121', 'Tutorial');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `registered_faculty` varchar(30) NOT NULL,
  `major_1` varchar(30) NOT NULL,
  `major_2` varchar(30) DEFAULT NULL,
  `minor_1` varchar(30) DEFAULT NULL,
  `minor_2` varchar(30) DEFAULT NULL,
  `year_of_study` int(11) NOT NULL,
  `credit_count` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `user_id`, `registered_faculty`, `major_1`, `major_2`, `minor_1`, `minor_2`, `year_of_study`, `credit_count`) VALUES
(1, 2, 'Pure and Applied', 'Computer Science', NULL, 'Physics', NULL, 2, 50);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(20) DEFAULT NULL,
  `password` varchar(20) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `middle_name` varchar(20) NOT NULL,
  `date_of_birth` date NOT NULL,
  `email` varchar(50) NOT NULL,
  `type` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `password`, `first_name`, `last_name`, `middle_name`, `date_of_birth`, `email`, `type`) VALUES
(1, 'shane', 'pass1234', 'Shane ', 'Campbell', 'c', '1992-11-08', 'shane.campbell.779@facebook.com', 'student'),
(2, 'warrenax', 'pass123', 'Warren', 'Clough', 'Gareth Alexander', '1992-02-12', 'clough_waren@hotmail.com', 'student'),
(3, 'sabrina', 'pass1234', 'Sabrina', 'Anderson', 'k', '1991-07-23', 'prettykera@hotmail.com ', 'student'),
(4, 'demoy', 'pass1234', 'Demoy', 'Blake', 'k', '1992-11-01', 'demoyb@gmail.com ', 'student');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
