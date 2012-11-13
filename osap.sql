-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 13, 2012 at 05:02 PM
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
  `day` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `course_id`, `title`, `comment`, `commenters_name`, `time`, `day`) VALUES
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
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Email` varchar(255) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `Username`, `Password`, `Email`) VALUES
(1, 'Marius', 'faith', 'name@domain.net'),
(2, 'shane', 'pass1234', 'Shanec132006@hotmail.com'),
(3, 'Warren', 'pass1234', 'warren.clough@gmail.com'),
(4, 'Kenrick', 'password', 'duke-london@hotmail.com'),
(5, 'Dake', 'runaway', 'name@domain.net'),
(6, 'Dake', 'noob', 'name@domain.net'),
(7, 'david', 'kong', 'name@domain.net'),
(8, 'Sabrina', 'number1', 'name@domain.net'),
(9, 'Aldin', 'password', 'the.man.boy.1@gmail.com');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
