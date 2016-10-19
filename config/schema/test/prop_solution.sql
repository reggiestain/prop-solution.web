-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2016 at 09:45 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `prop_solution`
--

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE IF NOT EXISTS `banks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `code` varchar(10) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`id`, `name`, `code`, `created`, `modified`) VALUES
(1, 'ABSA Bank', '632005', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Bidvest Bank', '462005', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Bank of Athens', '410506', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Capitec Bank', '470010', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'FNB ', '254005', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'Investec Private Ban', '580105', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'Nedbank', '198765', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'SA Post Bank (Post Office)', '460005', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'Standard Bank', '051001', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE IF NOT EXISTS `city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `created` datetime NOT NULL,
  `Modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `name`, `created`, `Modified`) VALUES
(1, 'Gauteng', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Free State', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Kwa-Zulu Natal', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Eastern Cape', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Western Cape', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'Other', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE IF NOT EXISTS `complaints` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `tenant_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `complaint_type` varchar(50) NOT NULL,
  `priority` varchar(20) NOT NULL,
  `complaint` text NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Pending',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`id`, `user_id`, `tenant_id`, `property_id`, `complaint_type`, `priority`, `complaint`, `status`, `created`, `modified`) VALUES
(7, 7, 4, 2, 'Plumbing', 'Medium', 'Testing', 'Pending', '2016-10-05 00:14:49', '2016-10-05 00:14:49');

-- --------------------------------------------------------

--
-- Table structure for table `complaint_comments`
--

CREATE TABLE IF NOT EXISTS `complaint_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tenant_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `complaint_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `type` varchar(20) NOT NULL,
  `rating` varchar(20) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `complaint_comments`
--

INSERT INTO `complaint_comments` (`id`, `tenant_id`, `user_id`, `complaint_id`, `comment`, `type`, `rating`, `created`) VALUES
(5, 4, 0, 5, 'c', 'Reply', '', '2016-10-05 16:51:35'),
(6, 4, 0, 6, 'comment', 'Reply', '', '2016-10-05 16:52:55'),
(7, 4, 0, 5, 'n bjnbb', 'Reply', '', '2016-10-05 16:54:19');

-- --------------------------------------------------------

--
-- Table structure for table `ledger`
--

CREATE TABLE IF NOT EXISTS `ledger` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `manager_id` int(11) NOT NULL,
  `account_name` varchar(30) NOT NULL,
  `account_number` varchar(12) NOT NULL,
  `account_type` varchar(15) NOT NULL,
  `bank_id` int(11) NOT NULL,
  `address` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `ledger`
--

INSERT INTO `ledger` (`id`, `user_id`, `manager_id`, `account_name`, `account_number`, `account_type`, `bank_id`, `address`, `city`, `created`, `modified`) VALUES
(2, 2, 1, 'Lizile Xulu', '12345678', 'Cheque', 2, '18 panorama road', 'Pretoria', '2016-08-31 16:49:19', '2016-08-31 16:49:19');

-- --------------------------------------------------------

--
-- Table structure for table `maintenance`
--

CREATE TABLE IF NOT EXISTS `maintenance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `desc` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `maintenance`
--

INSERT INTO `maintenance` (`id`, `name`, `desc`, `created`, `modified`) VALUES
(1, 'Electrician', 'Electrician', '2016-09-04 00:00:00', '2016-09-04 00:00:00'),
(2, 'Plumber', 'Plumber', '2016-09-04 00:00:00', '2016-09-04 00:00:00'),
(3, 'Cleaning Service', 'Cleaning Service', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Painter', 'Painter', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'General handyman', 'General handyman', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'Garden/Pool Service', 'Garden/Pool Service', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'Lock Smith', 'Lock Smith', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'Roofers', 'Roofers', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'Pest Control', 'Pest Control', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'Property Lawyer', 'Property Lawyer', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 'Electric Fencing', 'Electric Fencing', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 'Alarm Company', 'Alarm Company', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `managers`
--

CREATE TABLE IF NOT EXISTS `managers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `type` varchar(20) NOT NULL,
  `phone1` varchar(10) NOT NULL,
  `phone2` varchar(10) NOT NULL,
  `address` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL,
  `province_id` int(11) NOT NULL,
  `company_name` varchar(50) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `managers`
--

INSERT INTO `managers` (`id`, `user_id`, `firstname`, `surname`, `email`, `type`, `phone1`, `phone2`, `address`, `city`, `province_id`, `company_name`, `created`, `modified`) VALUES
(1, 5, 'Reginald', 'Bossman', 'reggiestain@gmail.com', 'Owner', '0781304587', '', '93 hornbill avenue', 'Pretoria', 1, '', '2016-08-31 15:00:12', '2016-08-31 15:00:12');

-- --------------------------------------------------------

--
-- Table structure for table `property`
--

CREATE TABLE IF NOT EXISTS `property` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `address` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `province_id` int(11) NOT NULL,
  `area_code` varchar(10) NOT NULL,
  `ledger_id` int(11) NOT NULL,
  `manager_id` int(11) NOT NULL,
  `purchase_price` float NOT NULL,
  `purchase_date` varchar(12) NOT NULL,
  `current_value` float NOT NULL,
  `lender_name` varchar(50) NOT NULL,
  `current_balance` float NOT NULL,
  `monthly_payment` float NOT NULL,
  `interest_rate` varchar(5) NOT NULL,
  `schedule_rent` double NOT NULL,
  `flat_fee` float NOT NULL,
  `start_date` varchar(10) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `property`
--

INSERT INTO `property` (`id`, `user_id`, `address`, `city`, `province_id`, `area_code`, `ledger_id`, `manager_id`, `purchase_price`, `purchase_date`, `current_value`, `lender_name`, `current_balance`, `monthly_payment`, `interest_rate`, `schedule_rent`, `flat_fee`, `start_date`, `created`, `modified`) VALUES
(2, 5, '18 panorama road', 'Centurion', 1, '0157', 2, 1, 80000, '07/04/2016', 2000000, 'ABSA Bank', 40000, 5000, '40', 3000, 1000, '08/22/2016', '2016-08-31 17:15:26', '2016-08-31 17:15:26');

-- --------------------------------------------------------

--
-- Table structure for table `province`
--

CREATE TABLE IF NOT EXISTS `province` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `created` datetime NOT NULL,
  `Modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `province`
--

INSERT INTO `province` (`id`, `name`, `created`, `Modified`) VALUES
(1, 'Gauteng', '2016-08-31 00:00:00', '2016-08-31 00:00:00'),
(2, 'Freestate', '2016-08-31 00:00:00', '2016-08-31 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(40) NOT NULL DEFAULT '',
  `data` text,
  `expires` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `data`, `expires`) VALUES
('1oufa8mc32dldkec8b60n0npp7', 'Config|a:1:{s:4:"time";i:1475662862;}Auth|a:1:{s:4:"User";a:9:{s:2:"id";i:7;s:5:"group";s:6:"tenant";s:4:"name";s:0:"";s:5:"email";s:18:"lipteaza@gmail.com";s:12:"confirm_pass";s:6:"194474";s:11:"property_id";i:2;s:9:"tenant_id";i:4;s:6:"status";s:6:"active";s:7:"created";O:14:"Cake\\I18n\\Time":3:{s:4:"date";s:19:"2016-10-04 15:36:04";s:13:"timezone_type";i:3;s:8:"timezone";s:13:"Africa/Harare";}}}', 1475922063),
('5laa1as5lunrgpv9g63b34hl67', 'Config|a:1:{s:4:"time";i:1475445422;}Auth|a:1:{s:4:"User";a:7:{s:2:"id";i:5;s:5:"group";s:5:"admin";s:4:"name";s:0:"";s:5:"email";s:21:"reggiestain@gmail.com";s:12:"confirm_pass";s:6:"123456";s:6:"status";s:6:"active";s:7:"created";O:14:"Cake\\I18n\\Time":3:{s:4:"date";s:19:"2016-08-26 20:09:44";s:13:"timezone_type";i:3;s:8:"timezone";s:13:"Africa/Harare";}}}', 1475704622),
('5o0du5i8ntef6dkp94ug848i30', 'Config|a:1:{s:4:"time";i:1475521046;}Auth|a:1:{s:4:"User";a:7:{s:2:"id";i:5;s:5:"group";s:5:"admin";s:4:"name";s:0:"";s:5:"email";s:21:"reggiestain@gmail.com";s:12:"confirm_pass";s:6:"123456";s:6:"status";s:6:"active";s:7:"created";O:14:"Cake\\I18n\\Time":3:{s:4:"date";s:19:"2016-08-26 20:09:44";s:13:"timezone_type";i:3;s:8:"timezone";s:13:"Africa/Harare";}}}', 1475780246),
('71pbuu100h4gvaehs9tcoo96c3', 'Config|a:1:{s:4:"time";i:1475619016;}Auth|a:1:{s:4:"User";a:9:{s:2:"id";i:7;s:5:"group";s:6:"tenant";s:4:"name";s:0:"";s:5:"email";s:18:"lipteaza@gmail.com";s:12:"confirm_pass";s:6:"194474";s:11:"property_id";i:2;s:9:"tenant_id";i:4;s:6:"status";s:6:"active";s:7:"created";O:14:"Cake\\I18n\\Time":3:{s:4:"date";s:19:"2016-10-04 15:36:04";s:13:"timezone_type";i:3;s:8:"timezone";s:13:"Africa/Harare";}}}', 1475878217),
('bj9offqpu3gl2de6drrkp2chj4', 'Config|a:1:{s:4:"time";i:1475679560;}Auth|a:1:{s:4:"User";a:9:{s:2:"id";i:7;s:5:"group";s:6:"tenant";s:4:"name";s:0:"";s:5:"email";s:18:"lipteaza@gmail.com";s:12:"confirm_pass";s:6:"194474";s:11:"property_id";i:2;s:9:"tenant_id";i:4;s:6:"status";s:6:"active";s:7:"created";O:14:"Cake\\I18n\\Time":3:{s:4:"date";s:19:"2016-10-04 15:36:04";s:13:"timezone_type";i:3;s:8:"timezone";s:13:"Africa/Harare";}}}', 1475938761),
('c2ggmliskuplhv5b67jj90ale1', 'Config|a:1:{s:4:"time";i:1476123887;}Auth|a:1:{s:4:"User";a:9:{s:2:"id";i:5;s:5:"group";s:5:"admin";s:4:"name";s:0:"";s:5:"email";s:21:"reggiestain@gmail.com";s:12:"confirm_pass";s:6:"123456";s:11:"property_id";i:0;s:9:"tenant_id";i:0;s:6:"status";s:6:"active";s:7:"created";O:14:"Cake\\I18n\\Time":3:{s:4:"date";s:19:"2016-08-26 20:09:44";s:13:"timezone_type";i:3;s:8:"timezone";s:13:"Africa/Harare";}}}Flash|a:0:{}', 1476383087),
('el1rljsebl6vr5qn67ssgat760', 'Config|a:1:{s:4:"time";i:1475502005;}Auth|a:1:{s:4:"User";a:7:{s:2:"id";i:5;s:5:"group";s:5:"admin";s:4:"name";s:0:"";s:5:"email";s:21:"reggiestain@gmail.com";s:12:"confirm_pass";s:6:"123456";s:6:"status";s:6:"active";s:7:"created";O:14:"Cake\\I18n\\Time":3:{s:4:"date";s:19:"2016-08-26 20:09:44";s:13:"timezone_type";i:3;s:8:"timezone";s:13:"Africa/Harare";}}}', 1475761206),
('g14ting078kf11b1p5stt634t4', 'Config|a:1:{s:4:"time";i:1475595992;}Auth|a:1:{s:4:"User";a:9:{s:2:"id";i:7;s:5:"group";s:6:"tenant";s:4:"name";s:0:"";s:5:"email";s:18:"lipteaza@gmail.com";s:12:"confirm_pass";s:6:"194474";s:11:"property_id";i:2;s:9:"tenant_id";i:4;s:6:"status";s:6:"active";s:7:"created";O:14:"Cake\\I18n\\Time":3:{s:4:"date";s:19:"2016-10-04 15:36:04";s:13:"timezone_type";i:3;s:8:"timezone";s:13:"Africa/Harare";}}}Flash|a:0:{}', 1475855193),
('i7fed7livgj1dl4qh26bjj92t7', 'Config|a:1:{s:4:"time";i:1475840594;}Auth|a:1:{s:4:"User";a:9:{s:2:"id";i:5;s:5:"group";s:5:"admin";s:4:"name";s:0:"";s:5:"email";s:21:"reggiestain@gmail.com";s:12:"confirm_pass";s:6:"123456";s:11:"property_id";i:0;s:9:"tenant_id";i:0;s:6:"status";s:6:"active";s:7:"created";O:14:"Cake\\I18n\\Time":3:{s:4:"date";s:19:"2016-08-26 20:09:44";s:13:"timezone_type";i:3;s:8:"timezone";s:13:"Africa/Harare";}}}Flash|a:0:{}', 1476099795),
('irkvf6q8qhibj571pok84i5o22', 'Config|a:1:{s:4:"time";i:1476626333;}Auth|a:1:{s:4:"User";a:9:{s:2:"id";i:5;s:5:"group";s:5:"admin";s:4:"name";s:0:"";s:5:"email";s:21:"reggiestain@gmail.com";s:12:"confirm_pass";s:6:"123456";s:11:"property_id";i:0;s:9:"tenant_id";i:0;s:6:"status";s:6:"active";s:7:"created";O:14:"Cake\\I18n\\Time":3:{s:4:"date";s:19:"2016-08-26 20:09:44";s:13:"timezone_type";i:3;s:8:"timezone";s:13:"Africa/Harare";}}}Flash|a:0:{}', 1476885533),
('k6072uc4r80olt0pstv5kh1ju3', 'Config|a:1:{s:4:"time";i:1475622363;}Auth|a:1:{s:4:"User";a:9:{s:2:"id";i:7;s:5:"group";s:6:"tenant";s:4:"name";s:0:"";s:5:"email";s:18:"lipteaza@gmail.com";s:12:"confirm_pass";s:6:"194474";s:11:"property_id";i:2;s:9:"tenant_id";i:4;s:6:"status";s:6:"active";s:7:"created";O:14:"Cake\\I18n\\Time":3:{s:4:"date";s:19:"2016-10-04 15:36:04";s:13:"timezone_type";i:3;s:8:"timezone";s:13:"Africa/Harare";}}}', 1475881565),
('o45bv6tm97f3foap5hj4rj8fc4', 'Config|a:1:{s:4:"time";i:1475532137;}Auth|a:1:{s:4:"User";a:9:{s:2:"id";i:5;s:5:"group";s:5:"admin";s:4:"name";s:0:"";s:5:"email";s:21:"reggiestain@gmail.com";s:12:"confirm_pass";s:6:"123456";s:11:"property_id";i:0;s:9:"tenant_id";i:0;s:6:"status";s:6:"active";s:7:"created";O:14:"Cake\\I18n\\Time":3:{s:4:"date";s:19:"2016-08-26 20:09:44";s:13:"timezone_type";i:3;s:8:"timezone";s:13:"Africa/Harare";}}}Flash|a:0:{}', 1475791337),
('o4n0p2fo2gfnea34udm3frv8u5', 'Config|a:1:{s:4:"time";i:1475700324;}Auth|a:1:{s:4:"User";a:9:{s:2:"id";i:7;s:5:"group";s:6:"tenant";s:4:"name";s:0:"";s:5:"email";s:18:"lipteaza@gmail.com";s:12:"confirm_pass";s:6:"194474";s:11:"property_id";i:2;s:9:"tenant_id";i:4;s:6:"status";s:6:"active";s:7:"created";O:14:"Cake\\I18n\\Time":3:{s:4:"date";s:19:"2016-10-04 15:36:04";s:13:"timezone_type";i:3;s:8:"timezone";s:13:"Africa/Harare";}}}', 1475959525),
('osn14le2t73388p67snpfn03b6', 'Config|a:1:{s:4:"time";i:1475796224;}Auth|a:1:{s:4:"User";a:9:{s:2:"id";i:5;s:5:"group";s:5:"admin";s:4:"name";s:0:"";s:5:"email";s:21:"reggiestain@gmail.com";s:12:"confirm_pass";s:6:"123456";s:11:"property_id";i:0;s:9:"tenant_id";i:0;s:6:"status";s:6:"active";s:7:"created";O:14:"Cake\\I18n\\Time":3:{s:4:"date";s:19:"2016-08-26 20:09:44";s:13:"timezone_type";i:3;s:8:"timezone";s:13:"Africa/Harare";}}}Flash|a:0:{}', 1476055425),
('qfc1qknns2eh8pbs9v4kf6jjf2', 'Config|a:1:{s:4:"time";i:1476299566;}Auth|a:1:{s:4:"User";a:9:{s:2:"id";i:5;s:5:"group";s:5:"admin";s:4:"name";s:0:"";s:5:"email";s:21:"reggiestain@gmail.com";s:12:"confirm_pass";s:6:"123456";s:11:"property_id";i:0;s:9:"tenant_id";i:0;s:6:"status";s:6:"active";s:7:"created";O:14:"Cake\\I18n\\Time":3:{s:4:"date";s:19:"2016-08-26 20:09:44";s:13:"timezone_type";i:3;s:8:"timezone";s:13:"Africa/Harare";}}}Flash|a:0:{}', 1476558767),
('r8shbu3u3i1n3nfsa4ivsv0p82', 'Config|a:1:{s:4:"time";i:1475583312;}Auth|a:1:{s:4:"User";a:9:{s:2:"id";i:5;s:5:"group";s:5:"admin";s:4:"name";s:0:"";s:5:"email";s:21:"reggiestain@gmail.com";s:12:"confirm_pass";s:6:"123456";s:11:"property_id";i:0;s:9:"tenant_id";i:0;s:6:"status";s:6:"active";s:7:"created";O:14:"Cake\\I18n\\Time":3:{s:4:"date";s:19:"2016-08-26 20:09:44";s:13:"timezone_type";i:3;s:8:"timezone";s:13:"Africa/Harare";}}}', 1475842512),
('rp0rjtc8ou17sgumqoh32ft5o6', 'Config|a:1:{s:4:"time";i:1475662054;}Auth|a:1:{s:4:"User";a:9:{s:2:"id";i:7;s:5:"group";s:6:"tenant";s:4:"name";s:0:"";s:5:"email";s:18:"lipteaza@gmail.com";s:12:"confirm_pass";s:6:"194474";s:11:"property_id";i:2;s:9:"tenant_id";i:4;s:6:"status";s:6:"active";s:7:"created";O:14:"Cake\\I18n\\Time":3:{s:4:"date";s:19:"2016-10-04 15:36:04";s:13:"timezone_type";i:3;s:8:"timezone";s:13:"Africa/Harare";}}}', 1475921255),
('uokqq13pe7q2bve566noumt1l6', 'Config|a:1:{s:4:"time";i:1475763173;}Auth|a:1:{s:4:"User";a:9:{s:2:"id";i:5;s:5:"group";s:5:"admin";s:4:"name";s:0:"";s:5:"email";s:21:"reggiestain@gmail.com";s:12:"confirm_pass";s:6:"123456";s:11:"property_id";i:0;s:9:"tenant_id";i:0;s:6:"status";s:6:"active";s:7:"created";O:14:"Cake\\I18n\\Time":3:{s:4:"date";s:19:"2016-08-26 20:09:44";s:13:"timezone_type";i:3;s:8:"timezone";s:13:"Africa/Harare";}}}Flash|a:0:{}', 1476022374),
('ussk79ecb581ubq5hhmovvbde4', 'Config|a:1:{s:4:"time";i:1475679521;}Auth|a:1:{s:4:"User";a:9:{s:2:"id";i:7;s:5:"group";s:6:"tenant";s:4:"name";s:0:"";s:5:"email";s:18:"lipteaza@gmail.com";s:12:"confirm_pass";s:6:"194474";s:11:"property_id";i:2;s:9:"tenant_id";i:4;s:6:"status";s:6:"active";s:7:"created";O:14:"Cake\\I18n\\Time":3:{s:4:"date";s:19:"2016-10-04 15:36:04";s:13:"timezone_type";i:3;s:8:"timezone";s:13:"Africa/Harare";}}}', 1475938722),
('vms06gnddumuu0e32gf1fk9ao1', 'Config|a:1:{s:4:"time";i:1475596087;}Auth|a:1:{s:4:"User";a:9:{s:2:"id";i:7;s:5:"group";s:6:"tenant";s:4:"name";s:0:"";s:5:"email";s:18:"lipteaza@gmail.com";s:12:"confirm_pass";s:6:"194474";s:11:"property_id";i:2;s:9:"tenant_id";i:4;s:6:"status";s:6:"active";s:7:"created";O:14:"Cake\\I18n\\Time":3:{s:4:"date";s:19:"2016-10-04 15:36:04";s:13:"timezone_type";i:3;s:8:"timezone";s:13:"Africa/Harare";}}}', 1475855288);

-- --------------------------------------------------------

--
-- Table structure for table `tenants`
--

CREATE TABLE IF NOT EXISTS `tenants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `ID_number` varchar(13) NOT NULL,
  `property_id` int(11) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `ledger_id` int(11) NOT NULL,
  `company_name` varchar(30) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `birthdate` varchar(12) NOT NULL,
  `phone1` varchar(10) NOT NULL,
  `phone2` varchar(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `address_type` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `lease_type` varchar(50) NOT NULL,
  `lease_start` varchar(12) NOT NULL,
  `lease_end` varchar(12) NOT NULL,
  `frequency` varchar(20) NOT NULL,
  `rent_amount` float NOT NULL,
  `deposit` float NOT NULL,
  `move_in_date` varchar(12) NOT NULL,
  `restrictions` text NOT NULL,
  `conditions` text NOT NULL,
  `recurring_rent` varchar(5) NOT NULL,
  `re_frequency` varchar(20) NOT NULL,
  `re_start` varchar(12) NOT NULL,
  `re_end` varchar(12) NOT NULL,
  `re_amount` float NOT NULL,
  `pets` varchar(5) NOT NULL,
  `smoking` varchar(5) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tenants`
--

INSERT INTO `tenants` (`id`, `user_id`, `ID_number`, `property_id`, `unit`, `ledger_id`, `company_name`, `firstname`, `surname`, `birthdate`, `phone1`, `phone2`, `email`, `address_type`, `address`, `lease_type`, `lease_start`, `lease_end`, `frequency`, `rent_amount`, `deposit`, `move_in_date`, `restrictions`, `conditions`, `recurring_rent`, `re_frequency`, `re_start`, `re_end`, `re_amount`, `pets`, `smoking`, `created`, `modified`) VALUES
(3, 5, 'H2080646', 2, '5', 2, '', 'Reginald', 'Bossman', '12/28/2015', '0781304587', '0784450830', 'reggiestain@gmail.com', 'Work', '76 bompass road\r\nrosebank\r\nJohannesburg', 'Month-to-Month', '09/06/2016', '', 'Cash', 0, 3000, '09/01/2016', '<p>No conditions</p>', '', '0', 'Once', '09/01/2016', '', 2400, '', '', '2016-09-05 12:13:12', '2016-10-12 12:12:46'),
(4, 0, '', 2, '7', 2, '', 'Luthando', 'Thagane', '10/17/2016', '0634514881', '', 'lipteaza@gmail.com', 'Work', '', 'Month-to-Month', '10/12/2016', '10/28/2016', 'EFT', 0, 4000, '10/13/2016', '<p><strong>Enter restriction..</strong></p>', '<p><strong>Enter condition..</strong></p>', 'Yes', 'Once', '10/12/2016', '10/26/2016', 2500, '', '', '2016-10-04 15:36:04', '2016-10-04 15:36:04');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group` varchar(20) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(120) NOT NULL,
  `confirm_pass` varchar(12) NOT NULL,
  `property_id` int(11) NOT NULL,
  `tenant_id` int(11) NOT NULL,
  `status` varchar(12) DEFAULT 'active',
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `group`, `name`, `email`, `password`, `confirm_pass`, `property_id`, `tenant_id`, `status`, `created`) VALUES
(5, 'admin', '', 'reggiestain@gmail.com', '$2y$10$8zvh3o.7mU/z9iEr5OI1uO02BXHgXsLifpHyK7BhzOiPALmQBBQ.i', '123456', 0, 0, 'active', '2016-08-26 20:09:44'),
(6, 'admin', '', 'murasiet@gmail.com', '$2y$10$nSZmoEJjZ0bYzv0m2tmwz.R9DsAmMHOc9TffTxBc4ZzkOXNZLBAua', 'Nasley12', 0, 0, 'active', '2016-09-08 21:48:25'),
(7, 'tenant', '', 'lipteaza@gmail.com', '$2y$10$Veo97FSQrlJ6bsKYXhlfE.y9MQ.E7ryC2ILdPpk.q/2PEVR604l6C', '194474', 2, 4, 'active', '2016-10-04 15:36:04');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE IF NOT EXISTS `vendors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `trade_name` varchar(50) NOT NULL,
  `reg_name` varchar(50) NOT NULL,
  `title` varchar(5) NOT NULL,
  `cell` varchar(10) NOT NULL,
  `location` varchar(50) NOT NULL,
  `province_id` int(11) NOT NULL,
  `city` varchar(50) NOT NULL,
  `suburb` varchar(50) NOT NULL,
  `post_address` text NOT NULL,
  `private_bag` varchar(10) NOT NULL,
  `post_city` varchar(30) NOT NULL,
  `post_code` varchar(5) NOT NULL,
  `tel_no` varchar(10) NOT NULL,
  `alt_tel_no` varchar(10) NOT NULL,
  `business_fax` varchar(10) NOT NULL,
  `clerk_fax` varchar(10) NOT NULL,
  `business_email` varchar(30) NOT NULL,
  `tax_no` varchar(15) NOT NULL,
  `vat_no` varchar(15) NOT NULL,
  `area_code` varchar(6) NOT NULL,
  `references` text NOT NULL,
  `insolvent` text NOT NULL,
  `speciality` text NOT NULL,
  `QM` varchar(5) NOT NULL,
  `HnS` varchar(5) NOT NULL,
  `compensation_fund` varchar(5) NOT NULL,
  `incident` varchar(5) NOT NULL,
  `incident_details` text NOT NULL,
  `non_conformance` varchar(5) NOT NULL,
  `conformance_details` text NOT NULL,
  `integrity` varchar(5) NOT NULL,
  `integrity_details` text NOT NULL,
  `EM` varchar(5) NOT NULL,
  `part_time_emp` varchar(10) NOT NULL,
  `full_time_emp` varchar(10) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=50 ;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `user_id`, `name`, `surname`, `trade_name`, `reg_name`, `title`, `cell`, `location`, `province_id`, `city`, `suburb`, `post_address`, `private_bag`, `post_city`, `post_code`, `tel_no`, `alt_tel_no`, `business_fax`, `clerk_fax`, `business_email`, `tax_no`, `vat_no`, `area_code`, `references`, `insolvent`, `speciality`, `QM`, `HnS`, `compensation_fund`, `incident`, `incident_details`, `non_conformance`, `conformance_details`, `integrity`, `integrity_details`, `EM`, `part_time_emp`, `full_time_emp`, `created`, `modified`) VALUES
(49, 5, 'Reginald', 'Bossman', 'name of business', 'Registered name of business', 'Dr', '084450830', 'Building / complex name:', 1, 'erwrw', 'dfsf', 'Post net address:', 'PO Box / P', 'City / Town', '033', '0781304587', '0781304587', '0781304587', '0781304587', 'reggiestain@gmail.com', '0781304587', '0781304587', '0157', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '2016-10-07 01:23:39', '2016-10-12 21:12:42');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_city`
--

CREATE TABLE IF NOT EXISTS `vendor_city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vendor_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=164 ;

--
-- Dumping data for table `vendor_city`
--

INSERT INTO `vendor_city` (`id`, `vendor_id`, `city_id`, `created`, `modified`) VALUES
(9, 49, 0, '2016-10-12 15:01:47', '2016-10-12 15:01:47'),
(10, 49, 0, '2016-10-12 15:42:26', '2016-10-12 15:42:26'),
(11, 49, 0, '2016-10-12 15:45:01', '2016-10-12 15:45:01'),
(12, 49, 0, '2016-10-12 16:16:14', '2016-10-12 16:16:14'),
(13, 49, 0, '2016-10-12 16:17:36', '2016-10-12 16:17:36'),
(14, 49, 0, '2016-10-12 16:19:05', '2016-10-12 16:19:05'),
(15, 49, 0, '2016-10-12 16:24:21', '2016-10-12 16:24:21'),
(16, 49, 0, '2016-10-12 16:25:16', '2016-10-12 16:25:16'),
(17, 49, 0, '2016-10-12 16:27:11', '2016-10-12 16:27:11'),
(18, 49, 0, '2016-10-12 16:30:32', '2016-10-12 16:30:32'),
(19, 49, 0, '2016-10-12 16:32:37', '2016-10-12 16:32:37'),
(20, 49, 0, '2016-10-12 16:33:33', '2016-10-12 16:33:33'),
(21, 49, 0, '2016-10-12 16:38:17', '2016-10-12 16:38:17'),
(22, 49, 0, '2016-10-12 16:40:32', '2016-10-12 16:40:32'),
(23, 49, 0, '2016-10-12 16:43:10', '2016-10-12 16:43:10'),
(24, 49, 0, '2016-10-12 16:52:11', '2016-10-12 16:52:11'),
(25, 49, 0, '2016-10-12 17:13:19', '2016-10-12 17:13:19'),
(26, 49, 0, '2016-10-12 17:14:34', '2016-10-12 17:14:34'),
(27, 49, 0, '2016-10-12 17:20:24', '2016-10-12 17:20:24'),
(28, 49, 0, '2016-10-12 17:23:24', '2016-10-12 17:23:24'),
(29, 49, 0, '2016-10-12 17:24:19', '2016-10-12 17:24:19'),
(30, 49, 0, '2016-10-12 17:30:55', '2016-10-12 17:30:55'),
(31, 49, 0, '2016-10-12 17:32:34', '2016-10-12 17:32:34'),
(32, 49, 0, '2016-10-12 17:33:54', '2016-10-12 17:33:54'),
(33, 49, 0, '2016-10-12 17:35:22', '2016-10-12 17:35:22'),
(34, 49, 0, '2016-10-12 17:36:30', '2016-10-12 17:36:30'),
(35, 49, 0, '2016-10-12 17:37:59', '2016-10-12 17:37:59'),
(36, 49, 0, '2016-10-12 17:39:06', '2016-10-12 17:39:06'),
(37, 49, 0, '2016-10-12 17:41:52', '2016-10-12 17:41:52'),
(38, 49, 0, '2016-10-12 17:42:31', '2016-10-12 17:42:31'),
(39, 49, 0, '2016-10-12 17:44:34', '2016-10-12 17:44:34'),
(40, 49, 0, '2016-10-12 17:52:01', '2016-10-12 17:52:01'),
(41, 49, 0, '2016-10-12 17:54:33', '2016-10-12 17:54:33'),
(42, 49, 0, '2016-10-12 17:55:09', '2016-10-12 17:55:09'),
(43, 49, 0, '2016-10-12 17:59:16', '2016-10-12 17:59:16'),
(44, 49, 0, '2016-10-12 17:59:54', '2016-10-12 17:59:54'),
(45, 49, 0, '2016-10-12 18:01:08', '2016-10-12 18:01:08'),
(46, 49, 0, '2016-10-12 18:01:33', '2016-10-12 18:01:33'),
(47, 49, 0, '2016-10-12 18:01:59', '2016-10-12 18:01:59'),
(48, 49, 0, '2016-10-12 18:05:26', '2016-10-12 18:05:26'),
(49, 49, 0, '2016-10-12 18:06:53', '2016-10-12 18:06:53'),
(50, 49, 0, '2016-10-12 18:09:25', '2016-10-12 18:09:25'),
(51, 49, 0, '2016-10-12 18:14:38', '2016-10-12 18:14:38'),
(52, 49, 0, '2016-10-12 18:15:35', '2016-10-12 18:15:35'),
(53, 49, 0, '2016-10-12 18:16:48', '2016-10-12 18:16:48'),
(54, 49, 0, '2016-10-12 18:18:40', '2016-10-12 18:18:40'),
(55, 49, 0, '2016-10-12 18:19:30', '2016-10-12 18:19:30'),
(56, 49, 0, '2016-10-12 18:21:01', '2016-10-12 18:21:01'),
(57, 49, 0, '2016-10-12 18:21:47', '2016-10-12 18:21:47'),
(58, 49, 0, '2016-10-12 18:23:56', '2016-10-12 18:23:56'),
(59, 49, 0, '2016-10-12 18:24:55', '2016-10-12 18:24:55'),
(60, 49, 0, '2016-10-12 18:25:44', '2016-10-12 18:25:44'),
(61, 49, 0, '2016-10-12 18:27:16', '2016-10-12 18:27:16'),
(62, 49, 0, '2016-10-12 18:37:06', '2016-10-12 18:37:06'),
(63, 49, 0, '2016-10-12 18:39:38', '2016-10-12 18:39:38'),
(64, 49, 0, '2016-10-12 18:40:19', '2016-10-12 18:40:19'),
(65, 49, 0, '2016-10-12 18:41:51', '2016-10-12 18:41:51'),
(66, 49, 0, '2016-10-12 18:42:24', '2016-10-12 18:42:24'),
(67, 49, 0, '2016-10-12 18:44:36', '2016-10-12 18:44:36'),
(68, 49, 0, '2016-10-12 18:45:10', '2016-10-12 18:45:10'),
(69, 49, 0, '2016-10-12 18:45:59', '2016-10-12 18:45:59'),
(70, 49, 0, '2016-10-12 18:46:28', '2016-10-12 18:46:28'),
(71, 49, 0, '2016-10-12 18:49:55', '2016-10-12 18:49:55'),
(72, 49, 0, '2016-10-12 18:53:11', '2016-10-12 18:53:11'),
(73, 49, 0, '2016-10-12 18:53:52', '2016-10-12 18:53:52'),
(74, 49, 0, '2016-10-12 18:56:31', '2016-10-12 18:56:31'),
(75, 49, 0, '2016-10-12 18:59:07', '2016-10-12 18:59:07'),
(76, 49, 0, '2016-10-12 18:59:48', '2016-10-12 18:59:48'),
(77, 49, 0, '2016-10-12 19:01:03', '2016-10-12 19:01:03'),
(78, 49, 0, '2016-10-12 19:01:38', '2016-10-12 19:01:38'),
(79, 49, 0, '2016-10-12 19:02:24', '2016-10-12 19:02:24'),
(80, 49, 0, '2016-10-12 19:02:45', '2016-10-12 19:02:45'),
(81, 49, 0, '2016-10-12 19:06:35', '2016-10-12 19:06:35'),
(82, 49, 0, '2016-10-12 19:09:03', '2016-10-12 19:09:03'),
(83, 49, 0, '2016-10-12 19:11:47', '2016-10-12 19:11:47'),
(84, 49, 0, '2016-10-12 19:12:46', '2016-10-12 19:12:46'),
(85, 49, 0, '2016-10-12 19:13:21', '2016-10-12 19:13:21'),
(86, 49, 0, '2016-10-12 19:14:00', '2016-10-12 19:14:00'),
(87, 49, 0, '2016-10-12 19:15:14', '2016-10-12 19:15:14'),
(88, 49, 0, '2016-10-12 19:18:42', '2016-10-12 19:18:42'),
(89, 49, 0, '2016-10-12 19:19:10', '2016-10-12 19:19:10'),
(90, 49, 0, '2016-10-12 19:19:31', '2016-10-12 19:19:31'),
(91, 49, 0, '2016-10-12 19:20:12', '2016-10-12 19:20:12'),
(92, 49, 0, '2016-10-12 19:20:52', '2016-10-12 19:20:52'),
(93, 49, 0, '2016-10-12 19:21:38', '2016-10-12 19:21:38'),
(94, 49, 0, '2016-10-12 19:22:01', '2016-10-12 19:22:01'),
(95, 49, 0, '2016-10-12 19:23:29', '2016-10-12 19:23:29'),
(96, 49, 0, '2016-10-12 19:23:41', '2016-10-12 19:23:41'),
(97, 49, 0, '2016-10-12 19:25:41', '2016-10-12 19:25:41'),
(98, 49, 0, '2016-10-12 19:26:23', '2016-10-12 19:26:23'),
(99, 49, 0, '2016-10-12 19:26:41', '2016-10-12 19:26:41'),
(100, 49, 0, '2016-10-12 19:27:40', '2016-10-12 19:27:40'),
(101, 49, 0, '2016-10-12 19:27:54', '2016-10-12 19:27:54'),
(102, 49, 0, '2016-10-12 19:28:59', '2016-10-12 19:28:59'),
(103, 49, 0, '2016-10-12 19:29:55', '2016-10-12 19:29:55'),
(104, 49, 0, '2016-10-12 19:29:59', '2016-10-12 19:29:59'),
(105, 49, 0, '2016-10-12 19:30:20', '2016-10-12 19:30:20'),
(106, 49, 0, '2016-10-12 19:33:35', '2016-10-12 19:33:35'),
(107, 49, 0, '2016-10-12 19:34:17', '2016-10-12 19:34:17'),
(108, 49, 0, '2016-10-12 19:34:40', '2016-10-12 19:34:40'),
(109, 49, 0, '2016-10-12 19:35:14', '2016-10-12 19:35:14'),
(110, 49, 0, '2016-10-12 19:39:23', '2016-10-12 19:39:23'),
(111, 49, 0, '2016-10-12 19:39:52', '2016-10-12 19:39:52'),
(112, 49, 0, '2016-10-12 19:40:30', '2016-10-12 19:40:30'),
(113, 49, 0, '2016-10-12 19:45:43', '2016-10-12 19:45:43'),
(114, 49, 0, '2016-10-12 19:46:41', '2016-10-12 19:46:41'),
(115, 49, 0, '2016-10-12 19:49:30', '2016-10-12 19:49:30'),
(116, 49, 0, '2016-10-12 19:52:52', '2016-10-12 19:52:52'),
(117, 49, 0, '2016-10-12 19:55:14', '2016-10-12 19:55:14'),
(118, 49, 0, '2016-10-12 19:55:46', '2016-10-12 19:55:46'),
(119, 49, 0, '2016-10-12 19:56:47', '2016-10-12 19:56:47'),
(120, 49, 0, '2016-10-12 19:57:23', '2016-10-12 19:57:23'),
(121, 49, 0, '2016-10-12 19:57:45', '2016-10-12 19:57:45'),
(122, 49, 0, '2016-10-12 19:58:34', '2016-10-12 19:58:34'),
(123, 49, 0, '2016-10-12 19:58:55', '2016-10-12 19:58:55'),
(124, 49, 0, '2016-10-12 19:59:27', '2016-10-12 19:59:27'),
(125, 49, 0, '2016-10-12 20:03:35', '2016-10-12 20:03:35'),
(126, 49, 0, '2016-10-12 20:14:05', '2016-10-12 20:14:05'),
(127, 49, 0, '2016-10-12 20:14:24', '2016-10-12 20:14:24'),
(128, 49, 0, '2016-10-12 20:16:05', '2016-10-12 20:16:05'),
(129, 49, 0, '2016-10-12 20:19:09', '2016-10-12 20:19:09'),
(130, 49, 0, '2016-10-12 20:20:05', '2016-10-12 20:20:05'),
(131, 49, 0, '2016-10-12 20:22:29', '2016-10-12 20:22:29'),
(132, 49, 0, '2016-10-12 20:23:04', '2016-10-12 20:23:04'),
(133, 49, 0, '2016-10-12 20:23:50', '2016-10-12 20:23:50'),
(134, 49, 0, '2016-10-12 20:24:21', '2016-10-12 20:24:21'),
(135, 49, 0, '2016-10-12 20:24:40', '2016-10-12 20:24:40'),
(136, 49, 0, '2016-10-12 20:27:14', '2016-10-12 20:27:14'),
(137, 49, 0, '2016-10-12 20:28:15', '2016-10-12 20:28:15'),
(138, 49, 0, '2016-10-12 20:28:52', '2016-10-12 20:28:52'),
(139, 49, 0, '2016-10-12 20:30:18', '2016-10-12 20:30:18'),
(140, 49, 0, '2016-10-12 20:30:23', '2016-10-12 20:30:23'),
(141, 49, 0, '2016-10-12 20:31:58', '2016-10-12 20:31:58'),
(142, 49, 0, '2016-10-12 20:33:00', '2016-10-12 20:33:00'),
(143, 49, 0, '2016-10-12 20:41:47', '2016-10-12 20:41:47'),
(144, 49, 0, '2016-10-12 20:42:26', '2016-10-12 20:42:26'),
(145, 49, 0, '2016-10-12 20:43:16', '2016-10-12 20:43:16'),
(146, 49, 0, '2016-10-12 20:49:04', '2016-10-12 20:49:04'),
(147, 49, 0, '2016-10-12 20:49:17', '2016-10-12 20:49:17'),
(148, 49, 0, '2016-10-12 20:49:47', '2016-10-12 20:49:47'),
(149, 49, 0, '2016-10-12 20:50:46', '2016-10-12 20:50:46'),
(150, 49, 0, '2016-10-12 20:51:54', '2016-10-12 20:51:54'),
(151, 49, 0, '2016-10-12 20:53:16', '2016-10-12 20:53:16'),
(152, 49, 0, '2016-10-12 20:54:19', '2016-10-12 20:54:19'),
(153, 49, 0, '2016-10-12 20:55:03', '2016-10-12 20:55:03'),
(154, 49, 0, '2016-10-12 20:56:24', '2016-10-12 20:56:24'),
(155, 49, 0, '2016-10-12 20:56:28', '2016-10-12 20:56:28'),
(156, 49, 0, '2016-10-12 20:57:15', '2016-10-12 20:57:15'),
(157, 49, 0, '2016-10-12 21:05:20', '2016-10-12 21:05:20'),
(158, 49, 0, '2016-10-12 21:05:42', '2016-10-12 21:05:42'),
(159, 49, 0, '2016-10-12 21:06:59', '2016-10-12 21:06:59'),
(160, 49, 0, '2016-10-12 21:07:14', '2016-10-12 21:07:14'),
(161, 49, 0, '2016-10-12 21:11:48', '2016-10-12 21:11:48'),
(162, 49, 0, '2016-10-12 21:12:07', '2016-10-12 21:12:07'),
(163, 49, 0, '2016-10-12 21:12:42', '2016-10-12 21:12:42');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_maintenance`
--

CREATE TABLE IF NOT EXISTS `vendor_maintenance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `maintenance_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=114 ;

--
-- Dumping data for table `vendor_maintenance`
--

INSERT INTO `vendor_maintenance` (`id`, `maintenance_id`, `vendor_id`, `created`, `modified`) VALUES
(111, 1, 49, '2016-10-12 21:12:42', '2016-10-12 21:12:42'),
(112, 2, 49, '2016-10-12 21:12:42', '2016-10-12 21:12:42'),
(113, 3, 49, '2016-10-12 21:12:42', '2016-10-12 21:12:42');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
