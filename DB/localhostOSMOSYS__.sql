-- phpMyAdmin SQL Dump
-- version 3.3.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 18, 2012 at 01:05 AM
-- Server version: 5.1.54
-- PHP Version: 5.3.9-ZS5.6.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `osmosys`
--
-- USE `findexam_osmosys`;

-- --------------------------------------------------------

--
-- Table structure for table `bugs`
--

CREATE TABLE IF NOT EXISTS `bugs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `author` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `date` int(11) DEFAULT NULL,
  `url` varchar(250) DEFAULT NULL,
  `description` text,
  `priority` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `bugs`
--

INSERT INTO `bugs` (`id`, `author`, `email`, `date`, `url`, `description`, `priority`, `status`) VALUES
(6, 'jojo', 'jojo@gmail.com', 1335481200, 'http://localhost:10088/bug/submit', 'Well that is wrong ?!', 'low', 'new'),
(8, 'jeanine', 'jeanine@gmail.com', 1335481200, 'http://localhost:10088/bug/submit', 'Well that is funny ?!', 'low', 'new'),
(7, 'jacko', 'jacko@gmail.com', 1335481200, 'http://localhost:10088/bug/submit', 'Well that is weird ?!', 'low', 'new'),
(9, 'jacko', 'jacko@gmail.com', 1335481200, 'http://localhost:10088/bug/submit', 'Well that is dumb ?!', 'low', 'new'),
(10, 'paul', 'paul@gmail.com', 1335481200, 'http://localhost:10088/bug/submit', 'Well that is not good ?!', 'low', 'new'),
(11, 'Julie', 'julie@gmail.com', 1335481200, 'http://localhost:10088/bug/submit', 'Well that is not bad ?!', 'low', 'new'),
(12, 'Mark', 'mark@gmail.com', 1335481200, 'http://localhost:10088/bug/submit', 'Well that is not false ?!', 'low', 'new'),
(13, 'Andrew', 'andrew@gmail.com', 1335481200, 'http://localhost:10088/bug/submit', 'Well that is a fail ?!', 'low', 'new'),
(14, 'Marie', 'marie@gmail.com', 1335481200, 'http://localhost:10088/bug/submit', 'Well that is a ugly ?!', 'low', 'new'),
(15, 'Flo', 'flo@gmail.com', 1335481200, 'http://localhost:10088/bug/submit', 'Well that is a unexpected ?!', 'low', 'new'),
(16, 'Seb', 'seb@gmail.com', 1335481200, 'http://localhost:10088/bug/submit', 'Well that is a chocking ?!', 'low', 'new'),
(17, 'Claudia', 'claudia@gmail.com', 1335481200, 'http://localhost:10088/bug/submit', 'Well that is a awful ?!', 'low', 'new'),
(18, 'Eamon', 'eamon@gmail.com', 1335481200, 'http://localhost:10088/bug/submit', 'Well that is a dreadful ?!', 'low', 'new');

-- --------------------------------------------------------

--
-- Table structure for table `content_nodes`
--

CREATE TABLE IF NOT EXISTS `content_nodes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` int(11) DEFAULT NULL,
  `node` varchar(50) DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `content_nodes`
--

INSERT INTO `content_nodes` (`id`, `page_id`, `node`, `content`) VALUES
(1, 1, 'headline', 'Jazz lesson'),
(2, 1, 'image', '/images/upload/bireli jaco.jpg'),
(3, 1, 'description', 'Free Jazz lesson with Bireli Lagrene & Jaco Pastorius'),
(4, 1, 'content', 'Free Jazz lesson with Bireli Lagrene & Jaco Pastorius'),
(5, 2, 'headline', 'Installing zend server'),
(6, 2, 'image', NULL),
(7, 2, 'description', 'you will manage your database thanks to Zend Framework'),
(8, 2, 'content', 'you will manage your database thanks to Zend Framework'),
(9, 3, 'headline', 'Creating your project with Zend Tool'),
(10, 3, 'image', NULL),
(11, 3, 'description', 'You will create a Zend app'),
(12, 3, 'content', 'You will create blbla Zend');

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE IF NOT EXISTS `menu_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) DEFAULT NULL,
  `label` varchar(250) DEFAULT NULL,
  `page_id` int(11) DEFAULT NULL,
  `link` varchar(250) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`id`, `menu_id`, `label`, `page_id`, `link`, `position`) VALUES
(8, 1, 'Submit bug', 0, '/bug/submit', 4),
(3, 2, 'Manage Content', 0, '/page/list', 1),
(4, 2, 'Manage Menus', 0, '/menu', 2),
(5, 2, 'Manage Users', 0, '/user/list', 3),
(6, 1, 'Profile', 1, NULL, 3),
(7, 2, 'Rebuild Search Index', 0, '/search/build', 4);

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE IF NOT EXISTS `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `access_level` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `access_level`) VALUES
(1, 'main_menu', NULL),
(2, 'admin_menu', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `namespace` varchar(50) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `date_created` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `parent_id`, `namespace`, `name`, `date_created`) VALUES
(1, 0, 'page', 'Jazz lesson ', 1335622294),
(2, 0, 'page', 'Installing zend server', 1336356231),
(3, 0, 'page', 'Create Zend', 1336356262);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `role` varchar(25) DEFAULT NULL,
  `image` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `first_name`, `last_name`, `role`, `image`) VALUES
(1, 'Jojo', '9bc3ebf9c0992ea7041c28620f485237', 'jojo', 'bombardo', 'Administrator', NULL),
(2, 'jacko', '9bc3ebf9c0992ea7041c28620f485237', 'jacko', 'impecabo', 'User', NULL),
(3, 'jacko', '9bc3ebf9c0992ea7041c28620f485237', 'jacko', 'impecabo', 'User', NULL),
(4, 'paul', 'dd41cb18c930753cbecf993f828603dc', 'paul', 'kitch', 'User', NULL),
(5, 'Paul', '6c63212ab48e8401eaf6b59b95d816a9', 'paul', 'paul', 'Administrator', NULL),
(6, 'julie', '16f12f5e8379e22be995e505ebfc1b84', 'julie', 'julie', 'Administrator', NULL),
(7, 'Eamon', '26b8c91ed3058646583b50c916673f68', 'Eamon', 'Dodzey', 'User', NULL),
(8, 'quentin', 'c7f413a4f6f4a658c24f0a437666089e', 'quentin', 'chaille', 'User', NULL),
(9, 'Marie', 'b3725122c9d3bfef5664619e08e31877', 'marie', 'princess', 'User', NULL),
(10, 'Seb', 'f15389363cf66828af65a1d8881e5821', 'seb', 'mich', 'User', NULL),
(11, 'Marie', 'b3725122c9d3bfef5664619e08e31877', 'marie', 'princess', 'User', NULL),
(12, 'Micha', '2f9035542eba57ca0644f2e774dd5819', 'micha', 'miss', 'User', NULL),
(13, 'Geof', '0f47f00e15c8a6e81950fc27ca8e6f54', 'geof', 'roy', 'User', 'Jojo-ExpoTees---2012---250px.jpg'),
(14, 'marie', 'b3725122c9d3bfef5664619e08e31877', 'marie', 'suze', 'Administrator', 'girl5.jpg'),
(15, 'eimer', 'ac5240af429fbc4aecb2cea1f3782065', 'eimer', 'bourke', 'Administrator', 'girl5.jpg');
