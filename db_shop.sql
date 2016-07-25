-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2016 at 06:04 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `adminId` int(11) NOT NULL AUTO_INCREMENT,
  `adminName` varchar(255) NOT NULL,
  `adminUser` varchar(255) NOT NULL,
  `adminEmail` varchar(255) NOT NULL,
  `adminPass` varchar(32) NOT NULL,
  `level` tinyint(4) NOT NULL,
  PRIMARY KEY (`adminId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`adminId`, `adminName`, `adminUser`, `adminEmail`, `adminPass`, `level`) VALUES
(1, 'sajan', 'admin', 'admin@gmail.com', '202cb962ac59075b964b07152d234b70', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brand`
--

CREATE TABLE IF NOT EXISTS `tbl_brand` (
  `brandid` int(11) NOT NULL AUTO_INCREMENT,
  `brandname` varchar(255) NOT NULL,
  PRIMARY KEY (`brandid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_brand`
--

INSERT INTO `tbl_brand` (`brandid`, `brandname`) VALUES
(1, 'LG'),
(2, 'micromax'),
(3, 'motorolla');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE IF NOT EXISTS `tbl_cart` (
  `cartid` int(11) NOT NULL AUTO_INCREMENT,
  `sid` varchar(255) NOT NULL,
  `productid` int(11) NOT NULL,
  `productname` varchar(255) NOT NULL,
  `price` float(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`cartid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`cartid`, `sid`, `productid`, `productname`, `price`, `quantity`, `image`) VALUES
(2, 'hvnlfbnos8d1nsm9keagtoqio4', 7, 'mb', 450.00, 2, 'upload/349323af89.png'),
(3, 'hvnlfbnos8d1nsm9keagtoqio4', 4, 'b24', 345.67, 1, 'upload/d827821e74.jpg'),
(4, 'hvnlfbnos8d1nsm9keagtoqio4', 4, 'b24', 345.67, 3, 'upload/d827821e74.jpg'),
(5, 'hvnlfbnos8d1nsm9keagtoqio4', 7, 'mb', 450.00, 1, 'upload/349323af89.png'),
(22, 'ounaua1d2igbr4vp624qvnkga0', 5, 'b24', 345.67, 2, 'upload/0a34e0cccb.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE IF NOT EXISTS `tbl_category` (
  `catid` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(255) NOT NULL,
  PRIMARY KEY (`catid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`catid`, `cat_name`) VALUES
(1, 'mobile'),
(2, 'ecommerce');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE IF NOT EXISTS `tbl_customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  `zip` varchar(30) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`id`, `name`, `address`, `city`, `country`, `zip`, `phone`, `email`, `pass`) VALUES
(2, 'sajan poddar', 'laxmipur', 'laxmipur', 'BANGLADESH', '3700', '01723264311', 'sajanpoddar98@gmail.com', '202cb962ac59075b964b07152d234b70'),
(3, 'Rishat Saha', 'dfaafd', 'Feni', 'bd', '2204', '01672777351', 'saharishat@ymail.com', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE IF NOT EXISTS `tbl_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cmrid` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `productname` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `cmrid`, `productid`, `productname`, `quantity`, `price`, `image`, `datetime`) VALUES
(12, 2, 4, 'b24', 2, 691.34, 'upload/d827821e74.jpg', '2016-06-19 14:36:38');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE IF NOT EXISTS `tbl_product` (
  `productid` int(11) NOT NULL AUTO_INCREMENT,
  `productname` varchar(255) NOT NULL,
  `catid` int(11) NOT NULL,
  `brandid` int(11) NOT NULL,
  `body` text NOT NULL,
  `price` float NOT NULL,
  `image` varchar(255) NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`productid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`productid`, `productname`, `catid`, `brandid`, `body`, `price`, `image`, `type`) VALUES
(8, 'symphonyp6', 1, 3, '<p>one of the</p>', 120, 'upload/6d65335817.png', 0),
(3, 'dsfs', 1, 3, '<p>df fssdaf fssd</p>', 2000, 'upload/6283df68bd.jpg', 1),
(4, 'b24', 1, 2, '<p>asfd sdfa</p>', 345.67, 'upload/d827821e74.jpg', 0),
(5, 'b24', 2, 3, '<p>asfd sdfa</p>', 345.67, 'upload/0a34e0cccb.png', 1),
(7, 'mb', 1, 3, '<p>adsf kj kjdskj kjasdk jkadsj kjdsak jdskf jiweuf jdkfji fjhdk sdjfi</p>', 450, 'upload/349323af89.png', 0),
(9, 'dffgghg', 2, 3, '<p>rtrtryty</p>', 345, 'upload/9cff287df2.jpg', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
