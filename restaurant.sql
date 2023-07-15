-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2023 at 11:06 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restaurant`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Admin_ID` varchar(5) NOT NULL,
  `Admin_First_Name` varchar(50) NOT NULL,
  `Admin_Last_Name` varchar(50) NOT NULL,
  `Admin_Gender` varchar(10) NOT NULL,
  `Admin_Email` varchar(50) NOT NULL,
  `Admin_Password` varchar(20) NOT NULL,
  `Admin_Contact_No` varchar(15) NOT NULL,
  `Admin_Address` varchar(255) NOT NULL,
  `Admin_Address_Postcode` int(5) NOT NULL,
  `Admin_Address_City` varchar(50) NOT NULL,
  `Admin_Address_State` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Admin_ID`, `Admin_First_Name`, `Admin_Last_Name`, `Admin_Gender`, `Admin_Email`, `Admin_Password`, `Admin_Contact_No`, `Admin_Address`, `Admin_Address_Postcode`, `Admin_Address_City`, `Admin_Address_State`) VALUES
('A0001', 'Test', 'Test', 'male', 'Test@gmail.com', '1234567', '0189771993', '', 0, '', ''),
('A0005', 'Ayu', 'test', 'female', 'test2@gmail.com', '1234', '0123821123', '', 0, '', ''),
('A0006', 'engku', 'faiz', 'male', 'mdhiyaulnaufal@gmail.com', 'naufal', '0106590352', '', 0, '', ''),
('A0007', 'Hafiz', 'Amir', 'male', 'testtest@gmail.com', '123', '0123456789', '', 0, '', ''),
('A0008', 'Hamdan', 'Zuhairi', 'male', 'test7@gmail.com', 'abc', '0123877608', '', 0, '', ''),
('A0009', 'Kamil', 'Hamid', 'male', 'testst@gmail.com', '12345678', '0123877603', '', 0, '', ''),
('A0012', 'Ayu', 'Mukhriz', 'female', 'testttt@gmail.cp,', 'Abc1234@', '0123821141', 'No 85 Jalan PP 3/11 Taman Putra Perdana', 47100, 'Segamat', 'Johor'),
('A0013', 'Adam', 'Amir', 'male', 'e@g.com', 'Abc1234@', '0123821141', 'melaka', 12345, 'Segamat', 'Terengganu'),
('A0014', 'NUR', 'BINTI IDRIS', 'female', 'z9690@gmail.com', 'F1@', '0123821141', 'no 33', 12345, 'Puchong', 'Selangor');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `Cart_ID` int(10) NOT NULL,
  `Total_Cost` decimal(5,2) NOT NULL,
  `Product_Requirement` varchar(255) NOT NULL,
  `Customer_ID` varchar(5) NOT NULL,
  `Product_ID` varchar(5) NOT NULL,
  `Order_ID` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`Cart_ID`, `Total_Cost`, `Product_Requirement`, `Customer_ID`, `Product_ID`, `Order_ID`) VALUES
(59, '10.90', '-Coca-Cola<br>-Normal<br>-Tomato<br>', 'C0003', 'P0006', 'T0001'),
(60, '6.00', '-100Plus<br>-Normal<br>', 'C0004', 'P0037', 'T0002'),
(61, '6.50', '-Sprite<br>-Large (+RM 0.50)<br>', 'C0004', 'P0037', 'T0003'),
(62, '11.40', '-Coca-Cola<br>-Large (+RM 0.50)<br>', 'C0004', 'P0006', 'T0004'),
(63, '6.00', '-Coca-Cola<br>-Normal<br>', 'C0005', 'P0037', 'T0005'),
(64, '11.40', '-Sprite<br>-Large (+RM 0.50)<br>', 'C0004', 'P0006', 'T0006'),
(65, '11.80', '-100Plus<br>-Extra Large (+RM 0.90)<br>', 'C0004', 'P0006', 'T0007'),
(66, '11.40', '-Sprite<br>-Large (+RM 0.50)<br>', 'C0004', 'P0006', 'T0008'),
(67, '11.40', '-Coca-Cola<br>-Large (+RM 0.50)<br>', 'C0004', 'P0006', 'T0009'),
(68, '11.40', '-Coca-Cola<br>-Large (+RM 0.50)<br>', 'C0004', 'P0006', 'T0010'),
(69, '6.00', '-100Plus<br>-Normal<br>', 'C0004', 'P0037', 'T0011'),
(70, '10.90', '-Sprite<br>-Normal<br>', 'C0004', 'P0006', 'T0012'),
(71, '11.80', '-100Plus<br>-Extra Large (+RM 0.90)<br>', 'C0004', 'P0006', 'T0012'),
(72, '12.70', '-Lipton Tea (+RM 0.90)<br>-Extra Large (+RM 0.90)<br>', 'C0004', 'P0006', 'T0013'),
(73, '15.40', '-Fanta (+RM 3.00)<br>-Large (+RM 1.50)<br>', 'C0004', 'P0006', 'T0014'),
(74, '12.40', '-Coca-Cola<br>-Large (+RM 1.50)<br>', 'C0004', 'P0006', 'T0015'),
(75, '12.40', '-Coca-Cola<br>-Large (+RM 1.50)<br>', 'C0004', 'P0006', 'T0016'),
(76, '7.50', '-Coca-Cola<br>-Large (+RM 1.50)<br>', 'C0004', 'P0037', 'T0016'),
(77, '7.50', '-Sprite<br>-Large (+RM 1.50)<br>', 'C0004', 'P0037', 'T0017'),
(78, '12.40', '-Coca-Cola<br>-Large (+RM 1.50)<br>', 'C0004', 'P0006', 'T0018'),
(79, '15.90', '-Lipton Tea (+RM 3.00)<br>-Extra Large (+RM 2.00)<br>', 'C0007', 'P0006', 'T0019'),
(80, '15.00', '-Sprite<br>-Normal<br>', 'C0007', 'P0038', 'T0020'),
(81, '70.00', '-Coca-Cola<br>-Normal<br>', 'C0007', 'P0042', 'T0021'),
(82, '85.00', '-Fanta (+RM 3.00)<br>-Extra Large (+RM 2.00)<br>', 'C0007', 'P0006', 'T0022'),
(83, '19.00', '-Fanta (+RM 3.00)<br>-Extra Large (+RM 2.00)<br>', 'C0009', 'P0037', 'T0023'),
(84, '17.00', '-Coca-Cola<br>-Extra Large (+RM 2.00)<br>', 'C0010', 'P0043', 'T0024'),
(85, '17.00', '-Sprite<br>-Extra Large (+RM 2.00)<br>', 'C0011', 'P0038', 'T0025'),
(86, '20.00', '-Fanta (+RM 3.00)<br>-Extra Large (+RM 2.00)<br>', 'C0012', 'P0043', 'T0026'),
(87, '81.50', '-Coca-Cola<br>-Large (+RM 1.50)<br>', 'C0012', 'P0006', 'T0027'),
(88, '15.00', '-Fanta (+RM 3.00)<br>-Extra Large (+RM 2.00)<br>', 'C0012', 'P0041', 'T0028'),
(89, '15.00', '-Lipton Tea (+RM 3.00)<br>-Extra Large (+RM 2.00)<br>', 'C0012', 'P0042', 'T0029'),
(90, '11.50', '-Coca-Cola<br>-Large (+RM 1.50)<br>', 'C0013', 'P0041', 'T0030'),
(91, '15.00', '-Lipton Tea (+RM 3.00)<br>-Extra Large (+RM 2.00)<br>', 'C0014', 'P0043', 'T0031'),
(92, '902.40', '-Sprite<br>-Large (+RM 1.50)<br>', 'C0014', 'P0006', 'T0031'),
(93, '15.00', '-Lipton Tea (+RM 3.00)<br>-Extra Large (+RM 2.00)<br>', 'C0014', 'P0040', 'T0032'),
(94, '11.50', '-Sprite<br>-Large (+RM 1.50)<br>', 'C0014', 'P0040', 'T0033');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `Comment_ID` varchar(5) NOT NULL,
  `Comment_Details` varchar(1000) NOT NULL,
  `Post_ID` varchar(5) NOT NULL,
  `Customer_ID` varchar(5) DEFAULT NULL,
  `Admin_ID` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`Comment_ID`, `Comment_Details`, `Post_ID`, `Customer_ID`, `Admin_ID`) VALUES
('F0001', 'test\r\n', 'B0001', 'C0004', NULL),
('F0002', 'test', 'B0001', 'C0010', NULL),
('F0003', 'Very Delicious', 'B0001', 'C0011', NULL),
('F0004', 'Thank you', 'B0001', NULL, 'A0008'),
('F0005', 'hello\r\n', 'B0001', NULL, 'A0014'),
('F0006', 'hai\r\n', 'B0001', 'C0014', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `Customer_ID` varchar(5) NOT NULL,
  `Customer_First_Name` varchar(50) NOT NULL,
  `Customer_Last_Name` varchar(50) NOT NULL,
  `Customer_Email` varchar(50) NOT NULL,
  `Customer_Password` varchar(20) NOT NULL,
  `Customer_Address` varchar(255) NOT NULL,
  `Customer_Address_Postcode` int(5) NOT NULL,
  `Customer_Address_City` varchar(50) NOT NULL,
  `Customer_Address_State` varchar(50) NOT NULL,
  `Customer_Gender` varchar(10) NOT NULL,
  `Customer_Contact_No` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`Customer_ID`, `Customer_First_Name`, `Customer_Last_Name`, `Customer_Email`, `Customer_Password`, `Customer_Address`, `Customer_Address_Postcode`, `Customer_Address_City`, `Customer_Address_State`, `Customer_Gender`, `Customer_Contact_No`) VALUES
('C0003', 'ron', 'cris', 'roncris@gmail.com', '123', '', 0, '', '', 'male', '0123456789'),
('C0004', 'NUR', 'BINTI IDRIS', 'test2@gmail.com', '12345', '', 0, '', '', 'female', '0123821141'),
('C0005', 'test', 'test', 'test@gmail.com', '123', '', 0, '', '', 'female', '0123821141'),
('C0006', 'ron', 'cris', 'hunkmoro7@gmail.com', '1234', '', 0, '', '', 'male', '0123456789'),
('C0007', 'dyaul', 'naufal', 'mdhiyaulnaufal@gmail.com', 'naufal', '', 0, '', '', 'male', '0106590352'),
('C0009', 'NUR', 'BINTI IDRIS', 'test12@gmail.com', '123', '', 0, '', '', 'male', '0123821141'),
('C0010', 'Ayu', 'Azira', 'test6@gmail.com', '1234', '', 0, '', '', 'male', '0123821121'),
('C0011', 'Ayu', 'Azira', 'test3@gmail.com', '1234', '', 0, '', '', 'female', '0123821142'),
('C0012', 'Afif', 'Ikhwan', 'test90@gmail.com', '123456789', '', 0, '', '', 'male', '0173302763'),
('C0013', 'Alif', 'Zuhairi', 'y90@gmail.com', 'Abc1234@', 'No 85 Jalan PP 3/11 Taman Putra Perdana', 12344, 'Af', 'Penang', 'male', '0123821141'),
('C0014', 'T', 'T', '0@gmail.com', 'Abc1234@', 'Test', 12342, 'Kampung', 'Perlis', 'female', '0112393982');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `Invoice_ID` varchar(5) NOT NULL,
  `Invoice_Date` varchar(10) NOT NULL,
  `Amount_Billed` decimal(5,2) NOT NULL,
  `Payment_ID` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`Invoice_ID`, `Invoice_Date`, `Amount_Billed`, `Payment_ID`) VALUES
('I0001', '2023/02/05', '11.40', 'R0004'),
('I0002', '2023/02/05', '6.00', 'R0005'),
('I0003', '2023/02/05', '11.40', 'R0006'),
('I0004', '2023/02/05', '11.80', 'R0007'),
('I0005', '2023/02/05', '11.40', 'R0008'),
('I0006', '2023/02/05', '11.40', 'R0009'),
('I0007', '2023/02/06', '11.40', 'R0010'),
('I0008', '2023/02/06', '6.00', 'R0011'),
('I0009', '2023/02/06', '22.70', 'R0012'),
('I0010', '2023/02/06', '12.70', 'R0013'),
('I0011', '2023/02/06', '15.40', 'R0014'),
('I0012', '2023/02/06', '12.40', 'R0015'),
('I0013', '2023/02/06', '19.90', 'R0016'),
('I0014', '2023/02/07', '7.50', 'R0017'),
('I0015', '2023/02/07', '12.40', 'R0018'),
('I0016', '2023/02/07', '15.90', 'R0019'),
('I0017', '2023/02/08', '15.00', 'R0020'),
('I0018', '2023/02/08', '70.00', 'R0021'),
('I0019', '2023/02/08', '85.00', 'R0022'),
('I0020', '2023/02/10', '19.00', 'R0023'),
('I0021', '2023/02/10', '17.00', 'R0024'),
('I0022', '2023/02/10', '17.00', 'R0025'),
('I0023', '2023/02/11', '20.00', 'R0026'),
('I0024', '2023/02/11', '81.50', 'R0027'),
('I0025', '2023/02/21', '15.00', 'R0028'),
('I0026', '2023/02/21', '15.00', 'R0029'),
('I0027', '2023/07/06', '11.50', 'R0030'),
('I0028', '2023/07/15', '917.40', 'R0031'),
('I0029', '2023/07/15', '15.00', 'R0032'),
('I0030', '2023/07/15', '11.50', 'R0033');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `Message_ID` varchar(5) NOT NULL,
  `Message_Name` varchar(100) NOT NULL,
  `Message_Email` varchar(50) NOT NULL,
  `Message_Phone` varchar(10) NOT NULL,
  `Message_Type` varchar(10) NOT NULL,
  `Message_Detail` varchar(10000) NOT NULL,
  `Message_Status` varchar(10) NOT NULL,
  `Customer_ID` varchar(5) DEFAULT NULL,
  `Admin_ID` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`Message_ID`, `Message_Name`, `Message_Email`, `Message_Phone`, `Message_Type`, `Message_Detail`, `Message_Status`, `Customer_ID`, `Admin_ID`) VALUES
('M0008', 'dyaul', 'mdhiyaulnaufal@gmail.com', '0106590352', 'Other', '**********', 'Replied', 'C0007', 'A0014'),
('M0009', 'dyaul', 'mdhiyaulnaufal@gmail.com', '0106590352', 'Food', 'The food is very delicious!', 'Replied', 'C0007', 'A0014'),
('M0010', 'alif', 'yuz9690@gmail.com', '0123832212', 'Service', 'Service is very good', 'Replied', 'C0010', 'A0014'),
('M0011', 'alif', 'yuz9690@gmail.com', '0123832212', 'Service', 'q', 'Replied', 'C0012', 'A0014'),
('M0012', 'NUR AYU AMIRA BINTI IDRIS', 'yuz9690@gmail.com', '0123821141', 'Service', 'test', 'Replied', 'C0014', 'A0014'),
('M0013', 'NUR AYU AMIRA BINTI IDRIS', 'hunkmoron7@gmail.com', '0123821141', 'Service', 'test', 'Replied', 'C0014', 'A0014'),
('M0014', 'NUR AYU AMIRA BINTI IDRIS', 'yuz9690@gmail.com', '0123821141', 'Service', 'test', 'Replied', 'C0014', 'A0014');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `Order_ID` varchar(5) NOT NULL,
  `Order_Date` varchar(10) NOT NULL,
  `Total_Amount` decimal(5,2) NOT NULL,
  `Order_Status` varchar(15) NOT NULL,
  `Customer_ID` varchar(5) DEFAULT NULL,
  `Admin_ID` varchar(5) DEFAULT NULL,
  `Staff_ID` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`Order_ID`, `Order_Date`, `Total_Amount`, `Order_Status`, `Customer_ID`, `Admin_ID`, `Staff_ID`) VALUES
('T0001', '2022/12/08', '10.90', 'Pickedup', 'C0003', 'A0001', NULL),
('T0002', '2023/02/05', '6.00', 'Pickedup', 'C0004', 'A0005', NULL),
('T0003', '2023/02/05', '6.50', 'Pickedup', 'C0004', 'A0005', NULL),
('T0004', '2023/02/05', '11.40', 'Pickedup', 'C0004', 'A0005', NULL),
('T0005', '2023/02/05', '6.00', 'Pickedup', 'C0005', 'A0005', NULL),
('T0006', '2023/02/05', '11.40', 'Pickedup', 'C0004', 'A0005', NULL),
('T0007', '2023/02/05', '11.80', 'Pickedup', 'C0004', 'A0005', NULL),
('T0008', '2023/02/05', '11.40', 'Pickedup', 'C0004', 'A0005', NULL),
('T0009', '2023/02/05', '11.40', 'Pickedup', 'C0004', 'A0005', NULL),
('T0010', '2023/02/06', '11.40', 'Pickedup', 'C0004', 'A0005', NULL),
('T0011', '2023/02/06', '6.00', 'Pickedup', 'C0004', 'A0005', NULL),
('T0012', '2023/02/06', '22.70', 'Pickedup', 'C0004', 'A0005', NULL),
('T0013', '2023/02/06', '12.70', 'Pickedup', 'C0004', 'A0005', NULL),
('T0014', '2023/02/06', '15.40', 'Pickedup', 'C0004', 'A0005', NULL),
('T0015', '2023/02/06', '12.40', 'Pickedup', 'C0004', 'A0005', NULL),
('T0016', '2023/02/06', '19.90', 'Pickedup', 'C0004', 'A0005', NULL),
('T0017', '2023/02/07', '7.50', 'Pickedup', 'C0004', 'A0005', NULL),
('T0018', '2023/02/07', '12.40', 'Pickedup', 'C0004', 'A0005', NULL),
('T0019', '2023/02/07', '15.90', 'Pickedup', 'C0007', 'A0006', NULL),
('T0020', '2023/02/08', '15.00', 'Pickedup', 'C0007', 'A0006', NULL),
('T0021', '2023/02/08', '70.00', 'Pickedup', 'C0007', 'A0006', NULL),
('T0022', '2023/02/08', '85.00', 'ReadyFood', 'C0007', 'A0006', NULL),
('T0023', '2023/02/10', '19.00', 'Pickedup', 'C0009', 'A0007', NULL),
('T0024', '2023/02/10', '17.00', 'Pickedup', 'C0010', 'A0007', NULL),
('T0025', '2023/02/10', '17.00', 'Pickedup', 'C0011', 'A0008', NULL),
('T0026', '2023/02/11', '20.00', 'Pickedup', 'C0012', 'A0009', NULL),
('T0027', '2023/02/11', '81.50', 'Pickedup', 'C0012', 'A0013', NULL),
('T0028', '2023/02/21', '15.00', 'Pickedup', 'C0012', 'A0013', NULL),
('T0029', '2023/02/21', '15.00', 'Pickedup', 'C0012', 'A0012', NULL),
('T0030', '2023/07/06', '11.50', 'Pickedup', 'C0013', 'A0014', NULL),
('T0031', '2023/07/15', '917.40', 'Pickedup', 'C0014', 'A0014', NULL),
('T0032', '2023/07/15', '15.00', 'Pending', 'C0014', NULL, NULL),
('T0033', '2023/07/15', '11.50', 'Pending', 'C0014', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `Payment_ID` varchar(5) NOT NULL,
  `Payment_Receipt` varchar(255) NOT NULL,
  `Order_ID` varchar(5) NOT NULL,
  `Customer_ID` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`Payment_ID`, `Payment_Receipt`, `Order_ID`, `Customer_ID`) VALUES
('R0001', 'r0001-microsoft-logo.jpg', 'T0001', 'C0003'),
('R0002', 'r0002-bakery-style-chocolate-chip-cookies-9.jpg', 'T0002', 'C0004'),
('R0003', 'r0003-whatsapp_image_2023-02-05_at_12.50.41_am-removebg-preview.png', 'T0003', 'C0004'),
('R0004', 'r0004-bakery-style-chocolate-chip-cookies-9.jpg', 'T0004', 'C0004'),
('R0005', 'r0005-logo.png', 'T0005', 'C0005'),
('R0006', 'r0006-whatsapp_image_2023-02-05_at_12.50.41_am-removebg-preview.png', 'T0006', 'C0004'),
('R0007', 'r0007-whatsapp-image-2023-02-05-at-12.50.40-am.jpeg', 'T0007', 'C0004'),
('R0008', 'r0008-bakery-style-chocolate-chip-cookies-9.jpg', 'T0008', 'C0004'),
('R0009', 'r0009-whatsapp_image_2023-02-05_at_12.50.41_am-removebg-preview.png', 'T0009', 'C0004'),
('R0010', 'r0010-naufal.png', 'T0010', 'C0004'),
('R0011', 'r0011-liang2019.pdf', 'T0011', 'C0004'),
('R0012', 'r0012-naufal.png', 'T0012', 'C0004'),
('R0013', 'r0013-untitled-design-(2).png', 'T0013', 'C0004'),
('R0014', 'r0014-untitled-design-(2).png', 'T0014', 'C0004'),
('R0015', 'r0015-footerbread.png', 'T0015', 'C0004'),
('R0016', 'r0016-image_2023-02-06_212309296-removebg-preview.png', 'T0016', 'C0004'),
('R0017', 'r0017-image_2023-02-06_212309296-removebg-preview.png', 'T0017', 'C0004'),
('R0018', 'r0018-image_2023-02-06_212309296-removebg-preview.png', 'T0018', 'C0004'),
('R0019', 'r0019-saf-11.jpg', 'T0019', 'C0007'),
('R0020', 'r0020-cake2.jpeg', 'T0020', 'C0007'),
('R0021', 'r0021-saf-11.jpg', 'T0021', 'C0007'),
('R0022', 'r0022-saf-10.jpg', 'T0022', 'C0007'),
('R0023', 'r0023-proj3_tt4l_g4_naufal_ayu_daniel_yong.pdf', 'T0023', 'C0009'),
('R0024', 'r0024-elite-leadership-naufal-ayu-nik.pdf', 'T0024', 'C0010'),
('R0025', 'r0025-resit-bank.jpeg', 'T0025', 'C0011'),
('R0026', 'r0026-012996041523_20220531.pdf', 'T0026', 'C0012'),
('R0027', 'r0027-promotion100.jpg', 'T0027', 'C0012'),
('R0028', 'r0028-invoice-8b8664da-draft.pdf', 'T0028', 'C0012'),
('R0029', 'r0029-2215-bcs-dtd.pdf', 'T0029', 'C0012'),
('R0030', 'r0030-therealkiddies-write-up.pdf', 'T0030', 'C0013'),
('R0031', 'r0031-whatsapp-image-2023-07-14-at-13.41.18.jpg', 'T0031', 'C0014'),
('R0032', 'r0032-whatsapp-image-2023-07-14-at-13.41.18.jpg', 'T0032', 'C0014'),
('R0033', '', 'T0033', 'C0014');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `Post_ID` varchar(5) NOT NULL,
  `Post_Picture` varchar(255) NOT NULL,
  `Post_Details` varchar(10000) NOT NULL,
  `Post_Date` varchar(10) NOT NULL,
  `Admin_ID` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`Post_ID`, `Post_Picture`, `Post_Details`, `Post_Date`, `Admin_ID`) VALUES
('B0001', 'b0001-whatsapp-image-2023-07-14-at-13.41.18.jpg', 'testing', '2023/2/7', 'A0014');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `Product_ID` varchar(5) NOT NULL,
  `Product_Name` varchar(40) NOT NULL,
  `Product_Type` varchar(20) NOT NULL,
  `Product_Ingredients` varchar(10000) NOT NULL,
  `Product_Price` decimal(10,2) NOT NULL,
  `Product_Thumbnail` varchar(255) NOT NULL,
  `Product_Status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`Product_ID`, `Product_Name`, `Product_Type`, `Product_Ingredients`, `Product_Price`, `Product_Thumbnail`, `Product_Status`) VALUES
('P0006', 'Classic White Cake', 'Cake', '1 cup white sugar\r\n\r\n½ cup unsalted butter\r\n\r\n2 large eggs\r\n\r\n2 teaspoons vanilla extract\r\n\r\n1 ½ cups all-purpose flour\r\n\r\n1 ¾ teaspoons baking powder\r\n\r\n½ cup milk', '900.90', 'p0006-promotion100.jpg', 'New'),
('P0037', 'Chocolate Chip Cookies (6 Pieces)', 'Cookies', '2 1/4 cups Gold Medal™ all-purpose flour\r\n1 teaspoon baking soda\r\n1/2 teaspoon salt\r\n1 cup butter, softened\r\n3/4 cup granulated sugar\r\n3/4 cup packed brown sugar\r\n1 egg\r\n1 teaspoon vanilla\r\n2 cups semisweet chocolate chips\r\n1 cup coarsely chopped nuts', '10.00', 'p0037-cookies1.jpg', 'New'),
('P0038', 'Submarine Sandwich', 'Bread', '1 loaf (1 pound) French bread\r\n1/4 cup butter or margarine, softened\r\n4 ounces Swiss cheese, sliced\r\n1/2 pound salami, sliced\r\n2 cups shredded lettuce\r\n2 medium tomatoes, thinly sliced\r\n1 medium onion, thinly sliced\r\n1/2 pound fully cooked ham', '10.00', 'p0038-bread1.jpg', 'New'),
('P0039', 'Red velvet', 'Cake', '1 ½ cups white sugar\r\n\r\n½ cup shortening\r\n\r\n2 eggs\r\n\r\n4 tablespoons red food coloring\r\n\r\n2 tablespoons cocoa\r\n\r\n1 cup buttermilk\r\n\r\n1 teaspoon salt\r\n\r\n1 teaspoon vanilla extract\r\n\r\n2 ½ cups sifted all-purpose flour\r\n\r\n1 tablespoon distilled white vinegar\r\n', '80.00', 'p0039-cake2.jpeg', 'New'),
('P0040', 'Chocolate Cake', 'Cake', '2 cups white sugar\r\n\r\n1 ¾ cups all-purpose flour\r\n\r\n¾ cup unsweetened cocoa powder\r\n\r\n1 ½ teaspoons baking powder\r\n\r\n1 ½ teaspoons baking soda\r\n\r\n1 teaspoon salt\r\n\r\n2 eggs\r\n\r\n1 cup milk\r\n\r\n½ cup vegetable oil\r\n\r\n2 teaspoons vanilla extract', '10.00', 'p0040-cake3.jpg', 'New'),
('P0041', 'Cameron Strawberry Cake', 'Cake', '2 cups white sugar\r\n\r\n1 cup butter, softened\r\n\r\n1 (3 ounce) package strawberry flavored Jell-O®\r\n\r\n4 large eggs (room temperature)\r\n\r\n2 ¾ cups sifted cake flour\r\n\r\n2 ½ teaspoons baking powder\r\n\r\n1 cup whole milk, room temperature\r\n\r\n½ cup strawberry puree', '10.00', 'p0041-cake4.jpg', 'New'),
('P0042', 'Bob Burn Cheesecake', 'Cake', '1 tablespoon soft unsalted butter, or as needed\r\n\r\nparchment paper\r\n\r\n3 (8 ounce) packages cream cheese, softened\r\n\r\n1 cup white sugar\r\n\r\n3 tablespoons all-purpose flour\r\n\r\n½ teaspoon fine salt\r\n\r\n½ teaspoon vanilla extract\r\n\r\n4 jumbo eggs, at room temper', '10.00', 'p0042-cake5.jpg', 'New'),
('P0043', 'Club Sandwich', 'Bread', '2 slices bacon\r\n\r\n3 slices bread, toasted\r\n\r\n3 tablespoons mayonnaise\r\n\r\n2 leaves lettuce\r\n\r\n2 (1 ounce) slices cooked deli turkey breast\r\n\r\n2 slices tomato', '10.00', 'p0043-bread2.jpg', 'New'),
('P0044', 'Egg Salad Mayo Sandwich', 'Bread', '8 eggs\r\n\r\n½ cup mayonnaise\r\n\r\n¼ cup chopped green onion\r\n\r\n1 teaspoon prepared yellow mustard\r\n\r\n¼ teaspoon paprika\r\n\r\nsalt and pepper to taste', '10.00', 'p0044-bread3.jpg', 'New'),
('P0045', 'Muffin Sandwich', 'Bread', '2 (12 ounce) packages English muffins\r\n\r\n1 tablespoon butter\r\n\r\n12 large eggs\r\n\r\n12 slices deli ham, warmed\r\n\r\n12 slices Cheddar cheese (Optional)', '10.00', 'p0045-bread4.jpg', 'New'),
('P0047', 'Peanut Butter Cookies (6 Pieces)', 'Cookies', '1 cup unsalted butter\r\n\r\n1 cup crunchy peanut butter\r\n\r\n1 cup white sugar\r\n\r\n1 cup packed brown sugar\r\n\r\n2 large eggs\r\n\r\n2 ½ cups all-purpose flour\r\n\r\n1 ½ teaspoons baking soda\r\n\r\n1 teaspoon baking powder\r\n\r\n½ teaspoon salt', '10.00', 'p0047-cookies2.jpg', 'New'),
('P0048', 'Red Velvet Cookies', 'Cookies', '2 cups all-purpose flour\r\n\r\n½ teaspoon baking soda\r\n\r\n½ teaspoon salt\r\n\r\n2 (1 ounce) squares unsweetened baking chocolate, broken into pieces\r\n\r\n½ cup unsalted butter, softened\r\n\r\n⅔ cup brown sugar, firmly packed\r\n\r\n⅓ cup white sugar\r\n\r\n1 large egg', '10.00', 'p0048-cookies3.jpg', 'New'),
('P0049', 'Coconut White Choc Cookies', 'Cookies', '½ cup butter, softened\r\n\r\n½ cup shortening\r\n\r\n¾ cup white sugar\r\n\r\n1 teaspoon almond extract\r\n\r\n1 teaspoon vanilla extract\r\n\r\n¼ teaspoon salt\r\n\r\n2 ¼ cups all-purpose flour\r\n\r\n1 cup sweetened flaked coconut\r\n\r\n1 cup semisweet chocolate chips', '10.00', 'p0049-cookies4.jpg', 'New'),
('P0051', 'Burger Croissant Sandwich', 'Bread', '2 avocados, peeled and pitted\r\n\r\n½ teaspoon garlic salt\r\n\r\n½ teaspoon lemon juice\r\n\r\n¼ teaspoon dried oregano\r\n\r\n4 croissants, split\r\n\r\n8 slices smoked deli turkey breast\r\n\r\n4 slices Swiss cheese\r\n\r\n8 slices cooked bacon\r\n\r\n8 slices tomato\r\n\r\n4 lettuce ', '10.00', 'p0051-bread5.jpg', 'New'),
('P0052', 'Coffee Toffee Cookies', 'Cookies', '¾ cup blanched slivered almonds\r\n\r\n⅓ cup instant coffee granules\r\n\r\n2 tablespoons hot water\r\n\r\n2 ⅔ cups all-purpose flour\r\n\r\n¾ teaspoon baking soda\r\n\r\n½ teaspoon salt\r\n\r\n½ cup butter, softened\r\n\r\n1 ¼ cups white sugar\r\n\r\n1 teaspoon vanilla extract\r\n\r\n2 egg', '10.00', 'p0052-cookies5.jpg', 'New');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `Staff_ID` varchar(5) NOT NULL,
  `Staff_First_Name` varchar(50) NOT NULL,
  `Staff_Last_Name` varchar(50) NOT NULL,
  `Staff_Gender` varchar(10) NOT NULL,
  `Staff_Email` varchar(50) NOT NULL,
  `Staff_Password` varchar(20) NOT NULL,
  `Staff_Contact_No` varchar(15) NOT NULL,
  `Staff_Address` varchar(255) NOT NULL,
  `Staff_Address_Postcode` int(5) NOT NULL,
  `Staff_Address_City` varchar(50) NOT NULL,
  `Staff_Address_State` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`Staff_ID`, `Staff_First_Name`, `Staff_Last_Name`, `Staff_Gender`, `Staff_Email`, `Staff_Password`, `Staff_Contact_No`, `Staff_Address`, `Staff_Address_Postcode`, `Staff_Address_City`, `Staff_Address_State`) VALUES
('S0001', 'nik', 'a', 'male', 'test@gmail.com', '123', '0123821122', '', 0, '', ''),
('S0003', 'engku', 'faiz', 'male', 'mdhiyaulnaufal@gmail.com', 'faiz', '0106590352', '', 0, '', ''),
('S0004', 'Johan', 'Mukhriz', 'male', 'test0@gmail.com', '123', '0123877609', '', 0, '', ''),
('S0005', 'Ayu', 'Zuhairi', 'female', 'admin@gmail.com', 'Abc1234@', '0123821141', 'No 85 Jalan PP 3/11 Taman Putra Perdana', 12344, 'testqq', 'Sarawak'),
('S0006', 'NUR', 'BINTI IDRIS', 'female', 'yu@gmail.com', 'Fif20', '0123821141', 'no 33', 12345, 'Puchong', 'Selangor');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Admin_ID`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`Cart_ID`),
  ADD KEY `Customer_ID` (`Customer_ID`),
  ADD KEY `Product_ID` (`Product_ID`),
  ADD KEY `Order_ID` (`Order_ID`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`Comment_ID`),
  ADD KEY `Post_ID` (`Post_ID`),
  ADD KEY `Admin_ID` (`Admin_ID`),
  ADD KEY `Customer_ID` (`Customer_ID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`Customer_ID`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`Invoice_ID`),
  ADD KEY `Payment_ID` (`Payment_ID`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`Message_ID`),
  ADD KEY `Customer_ID` (`Customer_ID`),
  ADD KEY `Admin_ID` (`Admin_ID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`Order_ID`),
  ADD KEY `Admin_ID` (`Admin_ID`),
  ADD KEY `Customer_ID` (`Customer_ID`),
  ADD KEY `Staff_ID_fk` (`Staff_ID`) USING BTREE;

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`Payment_ID`),
  ADD KEY `Customer_ID` (`Customer_ID`),
  ADD KEY `Order_ID` (`Order_ID`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`Post_ID`),
  ADD KEY `Admin_ID` (`Admin_ID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`Product_ID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`Staff_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `Cart_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`Customer_ID`) REFERENCES `customer` (`Customer_ID`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`Product_ID`) REFERENCES `product` (`Product_ID`),
  ADD CONSTRAINT `cart_ibfk_3` FOREIGN KEY (`Order_ID`) REFERENCES `orders` (`Order_ID`);

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`Post_ID`) REFERENCES `post` (`Post_ID`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`Admin_ID`) REFERENCES `admin` (`Admin_ID`),
  ADD CONSTRAINT `comment_ibfk_3` FOREIGN KEY (`Customer_ID`) REFERENCES `customer` (`Customer_ID`);

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_ibfk_1` FOREIGN KEY (`Payment_ID`) REFERENCES `payment` (`Payment_ID`);

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`Customer_ID`) REFERENCES `customer` (`Customer_ID`),
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`Admin_ID`) REFERENCES `admin` (`Admin_ID`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`Admin_ID`) REFERENCES `admin` (`Admin_ID`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`Customer_ID`) REFERENCES `customer` (`Customer_ID`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`Customer_ID`) REFERENCES `customer` (`Customer_ID`),
  ADD CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`Order_ID`) REFERENCES `orders` (`Order_ID`);

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`Admin_ID`) REFERENCES `admin` (`Admin_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
