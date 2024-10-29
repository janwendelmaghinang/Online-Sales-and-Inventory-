-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 19, 2022 at 07:35 AM
-- Server version: 10.5.13-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u763346244_hpzEbikeDb1`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_us`
--

CREATE TABLE `about_us` (
  `id` int(11) NOT NULL,
  `text` text NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bank_account`
--

CREATE TABLE `bank_account` (
  `id` int(11) NOT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qrcode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bank_account`
--

INSERT INTO `bank_account` (`id`, `bank_name`, `account_name`, `account_number`, `qrcode`, `status`, `active`) VALUES
(1, 'Gcash', 'Wendel', '09154040863', 'uploads/qrcode/qr1645947886574.png', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `chasis_number`
--

CREATE TABLE `chasis_number` (
  `id` int(11) NOT NULL,
  `parts_id` int(11) NOT NULL,
  `model_id` varchar(255) NOT NULL,
  `chasis_number` text NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chasis_number`
--

INSERT INTO `chasis_number` (`id`, `parts_id`, `model_id`, `chasis_number`, `status`) VALUES
(102, 455, '99', '0001', '0'),
(103, 455, '99', '0002', '0'),
(104, 455, '99', '0003', '1'),
(105, 455, '99', '0004', '1'),
(106, 455, '99', '0005', '1'),
(107, 455, '99', '0006', '1'),
(108, 455, '99', '0007', '1'),
(109, 455, '99', '0008', '1'),
(110, 455, '99', '0009', '1'),
(111, 455, '99', '0010', '1'),
(112, 456, '100', '0011', '1'),
(113, 456, '100', '0012', '1'),
(114, 456, '100', '0013', '1'),
(115, 456, '100', '0014', '1'),
(116, 456, '100', '0015', '1'),
(117, 456, '100', '0016', '1'),
(118, 456, '100', '0017', '1'),
(119, 456, '100', '0018', '1'),
(120, 456, '100', '0019', '1'),
(121, 456, '100', '0020', '1');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `service_charge_value` varchar(255) NOT NULL,
  `vat_charge_value` varchar(255) NOT NULL,
  `warehouse` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `currency` varchar(255) NOT NULL,
  `logo` text NOT NULL,
  `street` varchar(255) NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `company_name`, `service_charge_value`, `vat_charge_value`, `warehouse`, `phone`, `email`, `currency`, `logo`, `street`, `barangay`, `city`, `province`) VALUES
(1, 'HPZ ECO-BIKE TRADING COMPANY', '10', '12', 'Warehouse#27', '09123212321', 'hpzecobike@gmail.com', 'php', '', 'Silvergate Compound, Maligaya Street', 'Patubig', 'Marilao', 'Bulacan');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `text` text NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customer_tbl`
--

CREATE TABLE `customer_tbl` (
  `id` int(11) NOT NULL,
  `customer_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `verification_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `verified_email` int(11) NOT NULL COMMENT 'verified 1',
  `customer_firstname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_lastname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_middle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_contact` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_street` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_subdivision` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_barangay` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_city` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_province` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_valid_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idType` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `primary_credential` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `secondary_credential` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_tbl`
--

INSERT INTO `customer_tbl` (`id`, `customer_email`, `customer_password`, `verification_code`, `verified_email`, `customer_firstname`, `customer_lastname`, `customer_middle`, `customer_contact`, `customer_street`, `customer_subdivision`, `customer_barangay`, `customer_city`, `customer_province`, `customer_valid_id`, `idType`, `primary_credential`, `secondary_credential`, `image`, `active`) VALUES
(145, 'janwendelmaghinang@gmail.com', '3c326bd16bcf8d2104b08126339c6eb8', '364048', 1, 'jan wendel', 'maghinang', 'margallo', '09154040863', 'Block 10 Lot 21', 'Marilao Grand Villas', 'Loma De Gato', 'Marilao', 'Bulacan', '', '', '', '', '', 0),
(146, 'eraldhalasan@gmail.com', '4b0a289bd3ce6f85595696cf1c8444b0', '793000', 1, 'Customer', 'User', '', '', '123', 'Subd. ', 'Brgy', 'City', 'Prov', '', '', '', '', '', 0),
(147, 'dex00888@gmail.com', '', '', 0, 'Dex', 'Trinidad', 'Lim', '09074259451', 'Ra 38', 'Caneville', 'Tabing ilog', 'Marilao', 'Bulacan', '', '', '', '', '', 1),
(148, 'rechelledroa@gmail.com', '1471f9cd73d1a22ac067eac24275a94c', '244270', 1, 'Rechelle', 'Roa', 'D', '09661828887', 'McArthur Hway', 'Luisa Paraiso', 'Saog', 'Marilao', 'Bulacan', '', '', '', '', '', 0),
(152, 'joshuaramos2888@gmail.com', '557eb209ad8c596e5c84604d08568c53', '968636', 1, 'Joshua', 'Ramos', 'C', '09465748574', 'Lot 11 Block 1 Door 2', 'San Vicente Subd', 'San Vicente', 'Santa Maria', 'Bulacan', '', '', '', '', '', 0),
(153, 'eraldhalasan@gmail.com', 'a0ca5fa09b35a816f2030daba1728a5a', '832461', 1, 'Eloisa', 'Halasan', '', '', 'B11 L13', 'Mary Grace Subdivision', 'Santa Rosa 1', 'Marilao', 'Bulacan', '', '', '', '', '', 0),
(154, 'rechelledroa@gmail.com', '', '', 0, 'Rechelle', 'Roa', 'D', '09661828887', 'McArthur Hway', 'Luisa Paraiso', 'Saog', 'Marilao', 'Bulacan', '', '', '', '', '', 1),
(155, 'markcalilong.mac@gmail.com', '242bdc1d9d8038ba4233a93710fdf1f8', '308823', 0, 'Mark Anthony', 'Calilong', '', '', '', '237 Sarmiento Homes', 'Abangan Norte', 'MARILAO', 'BULACAN', '', '', '', '', '', 0),
(156, 'markcalilong.mac@gmail.com', '242bdc1d9d8038ba4233a93710fdf1f8', '579729', 1, 'Mark Anthony', 'Calilong', '', '', '', '237 Sarmiento Homes', 'Abangan Norte', 'MARILAO', 'BULACAN', '', '', '', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ebike_application_tbl`
--

CREATE TABLE `ebike_application_tbl` (
  `id` int(11) NOT NULL,
  `customer_id` varchar(255) NOT NULL,
  `ebike_id` varchar(255) NOT NULL,
  `ebike_name` varchar(255) NOT NULL,
  `color_id` varchar(255) NOT NULL,
  `ebike_color` varchar(255) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `pob` varchar(255) NOT NULL,
  `application_form` varchar(255) NOT NULL,
  `date_apply` varchar(255) NOT NULL,
  `date_approved` varchar(255) NOT NULL,
  `date_disapproved` varchar(255) NOT NULL,
  `disapproved_on_ci` varchar(255) NOT NULL COMMENT 'disapprovedOnCI == 1',
  `motor_number` varchar(255) NOT NULL,
  `chasis_number` varchar(255) NOT NULL,
  `motor_warranty_year` varchar(255) NOT NULL,
  `motor_warranty_month` varchar(255) NOT NULL,
  `service_warranty_year` varchar(255) NOT NULL,
  `service_warranty_month` varchar(255) NOT NULL,
  `warranty_start` varchar(255) NOT NULL,
  `motor_warranty_end` varchar(255) NOT NULL,
  `service_warranty_end` varchar(255) NOT NULL,
  `terms` varchar(255) NOT NULL,
  `interest_percentage` varchar(255) NOT NULL,
  `interest` decimal(8,2) NOT NULL,
  `downpayment` decimal(8,2) NOT NULL,
  `monthly` decimal(8,2) NOT NULL,
  `due_date` varchar(255) NOT NULL,
  `cancelled` int(11) NOT NULL,
  `status` varchar(255) NOT NULL COMMENT 'pending == 1, approved == 2, released == 3, disapproved == 4',
  `paid_status` varchar(255) NOT NULL COMMENT 'fully = 1, paying = 2, past due == 3, pull = 4',
  `pullout_status` varchar(255) NOT NULL COMMENT 'pending 1, completed 2, cancelled 3'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ebike_color_tbl`
--

CREATE TABLE `ebike_color_tbl` (
  `id` int(11) NOT NULL,
  `color_name` varchar(20) NOT NULL,
  `color_description` varchar(30) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ebike_color_tbl`
--

INSERT INTO `ebike_color_tbl` (`id`, `color_name`, `color_description`, `active`) VALUES
(238, 'Yellow', '', 1),
(239, 'Red', '', 1),
(241, 'Black', '', 1),
(242, 'Green', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ebike_deliver_tbl`
--

CREATE TABLE `ebike_deliver_tbl` (
  `id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ebike_model_tbl`
--

CREATE TABLE `ebike_model_tbl` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `stock_critical` int(11) NOT NULL,
  `set_model` int(11) NOT NULL,
  `stored_at` text NOT NULL,
  `image` text NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ebike_model_tbl`
--

INSERT INTO `ebike_model_tbl` (`id`, `name`, `price`, `stock_critical`, `set_model`, `stored_at`, `image`, `active`) VALUES
(99, 'Amore', '45000.00', 5, 1, 'warehouse', 'uploads/ebike/model1644968979107.png', 1),
(100, 'Heroine', '50000.00', 5, 1, 'warehouse', 'uploads/ebike/model1644969084941.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ebike_needed_parts_tbl`
--

CREATE TABLE `ebike_needed_parts_tbl` (
  `id` int(11) NOT NULL,
  `parts_id` int(11) NOT NULL,
  `model_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ebike_needed_parts_tbl`
--

INSERT INTO `ebike_needed_parts_tbl` (`id`, `parts_id`, `model_id`) VALUES
(147, 455, 99),
(148, 459, 99),
(149, 457, 99),
(150, 456, 100),
(151, 462, 100),
(152, 457, 100),
(153, 456, 100),
(154, 461, 100),
(155, 462, 100),
(156, 457, 100),
(157, 456, 100),
(158, 462, 100),
(159, 463, 100);

-- --------------------------------------------------------

--
-- Table structure for table `ebike_parts_tbl`
--

CREATE TABLE `ebike_parts_tbl` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `serial_number` text NOT NULL,
  `stock_critical` int(11) NOT NULL,
  `supplier_price` decimal(8,2) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `markup` decimal(8,2) NOT NULL,
  `description` text NOT NULL,
  `model_id` int(11) NOT NULL,
  `qty_per_ebike` text NOT NULL,
  `specification` varchar(255) NOT NULL,
  `active` int(11) NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ebike_parts_tbl`
--

INSERT INTO `ebike_parts_tbl` (`id`, `name`, `serial_number`, `stock_critical`, `supplier_price`, `price`, `markup`, `description`, `model_id`, `qty_per_ebike`, `specification`, `active`, `image`) VALUES
(455, 'Chassis', '1', 5, '2500.00', '3000.00', '500.00', '', 99, '1', '', 1, 'uploads/spareparts/parts1644969316817.png'),
(456, 'Chassis', '1', 5, '2500.00', '3000.00', '500.00', '', 100, '1', '', 1, 'uploads/spareparts/parts1644969394682.png'),
(459, 'Motor', '1', 5, '2500.00', '3000.00', '500.00', '', 99, '1', '', 1, 'uploads/spareparts/parts1644972662075.png'),
(460, 'Wheel', '2', 5, '1000.00', '1200.00', '200.00', 'Original', 99, '1', '', 1, 'uploads/spareparts/parts1646005350205.png'),
(462, 'motor', '1', 5, '2500.00', '3000.00', '500.00', '', 100, '1', '', 1, 'uploads/spareparts/parts1645614830844.png'),
(463, 'Wheel', '2', 5, '350.00', '430.00', '80.00', '', 100, '3', '', 1, 'uploads/spareparts/parts1645616632168.png');

-- --------------------------------------------------------

--
-- Table structure for table `ebike_production_items`
--

CREATE TABLE `ebike_production_items` (
  `id` int(11) NOT NULL,
  `production_id` text NOT NULL,
  `ebike_stock_id` varchar(255) NOT NULL,
  `chasis_number` text NOT NULL,
  `motor_number` text NOT NULL,
  `set_serial` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ebike_production_items`
--

INSERT INTO `ebike_production_items` (`id`, `production_id`, `ebike_stock_id`, `chasis_number`, `motor_number`, `set_serial`) VALUES
(81, '284', '34', '0001', '0011', 1),
(82, '284', '34', '0002', '0012', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ebike_production_tbl`
--

CREATE TABLE `ebike_production_tbl` (
  `id` int(11) NOT NULL,
  `ebike_stock_id` varchar(255) NOT NULL,
  `model_id` varchar(255) NOT NULL,
  `color_id` varchar(255) NOT NULL,
  `technician` varchar(255) NOT NULL,
  `stored_at` varchar(255) NOT NULL DEFAULT '',
  `start_date` varchar(255) NOT NULL,
  `date_finished` varchar(255) NOT NULL,
  `set_serial` text NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ebike_production_tbl`
--

INSERT INTO `ebike_production_tbl` (`id`, `ebike_stock_id`, `model_id`, `color_id`, `technician`, `stored_at`, `start_date`, `date_finished`, `set_serial`, `status`) VALUES
(284, '34', '99', '241', 'Techram', 'warehouse', 'Feb 28, 2022', 'Feb 28, 2022', '1', '2');

-- --------------------------------------------------------

--
-- Table structure for table `ebike_specification_tbl`
--

CREATE TABLE `ebike_specification_tbl` (
  `id` int(11) NOT NULL,
  `model_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `motor_type` text NOT NULL,
  `rated_voltage` text NOT NULL,
  `max_speed` text NOT NULL,
  `distance_full` text NOT NULL,
  `charging_time` text NOT NULL,
  `max_load` text NOT NULL,
  `others` text NOT NULL,
  `color` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ebike_specification_tbl`
--

INSERT INTO `ebike_specification_tbl` (`id`, `model_id`, `description`, `motor_type`, `rated_voltage`, `max_speed`, `distance_full`, `charging_time`, `max_load`, `others`, `color`) VALUES
(46, 99, '', '60', '45', '60', '60', '6', '110', '', ''),
(47, 100, '', '60', '45', '60', '60', '6', '110', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `ebike_stock_items`
--

CREATE TABLE `ebike_stock_items` (
  `id` int(11) NOT NULL,
  `ebike_stock_id` text NOT NULL,
  `chasis_number` text NOT NULL,
  `motor_number` text NOT NULL,
  `status` varchar(255) NOT NULL COMMENT 'in_stock == 1 and released == 2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ebike_stock_items`
--

INSERT INTO `ebike_stock_items` (`id`, `ebike_stock_id`, `chasis_number`, `motor_number`, `status`) VALUES
(39, '34', '0001', '0011', '1'),
(40, '34', '0002', '0012', '1');

-- --------------------------------------------------------

--
-- Table structure for table `ebike_stock_tbl`
--

CREATE TABLE `ebike_stock_tbl` (
  `id` int(11) NOT NULL,
  `model_id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `stored_at` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ebike_stock_tbl`
--

INSERT INTO `ebike_stock_tbl` (`id`, `model_id`, `color_id`, `image`, `stored_at`, `active`) VALUES
(28, 99, 238, 'uploads/ebike/model1644973407294.png', '', 1),
(32, 100, 241, 'uploads/ebike/model1645616873024.png', '', 1),
(33, 99, 239, 'uploads/ebike/model1646006241671.png', '', 1),
(34, 99, 241, 'uploads/ebike/model1646006394271.png', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ebike_store_stock_tbl`
--

CREATE TABLE `ebike_store_stock_tbl` (
  `id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `stock_critical` int(11) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `footer`
--

CREATE TABLE `footer` (
  `id` int(11) NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `footer`
--

INSERT INTO `footer` (`id`, `text`) VALUES
(1, '© Copyright 2021 Hpz Eco-Bike - All Rights Reserved');

-- --------------------------------------------------------

--
-- Table structure for table `inquiry_form`
--

CREATE TABLE `inquiry_form` (
  `id` int(11) NOT NULL,
  `customer_lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_middle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_street` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_subdivision` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_barangay` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_province` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_contact` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `store_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_option` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_inquiry` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_approved` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_completed` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_cancelled` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'pending 1, responded 2, completed 3, cancelled 4'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inquiry_form`
--

INSERT INTO `inquiry_form` (`id`, `customer_lastname`, `customer_firstname`, `customer_middle`, `customer_street`, `customer_subdivision`, `customer_barangay`, `customer_city`, `customer_province`, `customer_contact`, `customer_email`, `store_id`, `payment_option`, `model_id`, `color_id`, `date_of_inquiry`, `date_approved`, `date_completed`, `date_cancelled`, `status`) VALUES
(18, 'Roa', 'Rechelle', 'D', 'McArthur Hway', 'Luisa Paraiso', 'Saog', 'Marilao', 'Bulacan', '09661828887', 'rechelledroa@gmail.com', '35', '1', '99', '238', 'Mar 01, 2022', 'Mar 01, 2022', '', '', '2'),
(19, 'Calilong', 'Mark Anthony', '', '', '237 Sarmiento Homes', 'Abangan Norte', 'MARILAO', 'BULACAN', '', 'markcalilong.mac@gmail.com', '35', '1', '100', '238', 'Mar 03, 2022', '', '', '', '1');

-- --------------------------------------------------------

--
-- Table structure for table `interest`
--

CREATE TABLE `interest` (
  `id` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `interest` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `interest`
--

INSERT INTO `interest` (`id`, `month`, `interest`) VALUES
(1, 3, 10),
(2, 6, 15),
(3, 9, 20),
(4, 12, 25);

-- --------------------------------------------------------

--
-- Table structure for table `loan_payment_schedule`
--

CREATE TABLE `loan_payment_schedule` (
  `id` int(11) NOT NULL,
  `customer_id` varchar(255) NOT NULL,
  `application_id` varchar(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `date_paid` varchar(255) NOT NULL,
  `total_payment` decimal(8,2) NOT NULL,
  `total_payment_due` decimal(8,2) NOT NULL,
  `advanced_payment` decimal(8,2) NOT NULL,
  `interest` decimal(8,2) NOT NULL,
  `principal` decimal(8,2) NOT NULL,
  `penalty` decimal(8,2) NOT NULL,
  `beginning_balance` decimal(8,2) NOT NULL,
  `ending_balance` decimal(8,2) NOT NULL,
  `due_date` int(11) NOT NULL COMMENT 'due date == 1, past due == 2',
  `paid` int(11) NOT NULL COMMENT 'yes = 1',
  `fully_paid` int(11) NOT NULL COMMENT 'fully 1',
  `payBtn` int(11) NOT NULL COMMENT 'activated = 1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `motor_number`
--

CREATE TABLE `motor_number` (
  `id` int(11) NOT NULL,
  `parts_id` int(11) NOT NULL,
  `motor_number` text NOT NULL,
  `model_id` text NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `motor_number`
--

INSERT INTO `motor_number` (`id`, `parts_id`, `motor_number`, `model_id`, `status`) VALUES
(68, 462, '0001', '100', '1'),
(69, 462, '0002', '100', '1'),
(70, 462, '0003', '100', '1'),
(71, 462, '0004', '100', '1'),
(72, 462, '0005', '100', '1'),
(73, 462, '0006', '100', '1'),
(74, 462, '0007', '100', '1'),
(75, 462, '0008', '100', '1'),
(76, 462, '0009', '100', '1'),
(77, 462, '0010', '100', '1'),
(78, 459, '0011', '99', '0'),
(79, 459, '0012', '99', '0'),
(80, 459, '0013', '99', '1'),
(81, 459, '0014', '99', '1'),
(82, 459, '0015', '99', '1'),
(83, 459, '0016', '99', '1'),
(84, 459, '0017', '99', '1'),
(85, 459, '0018', '99', '1'),
(86, 459, '0019', '99', '1'),
(87, 459, '0020', '99', '1');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `date_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items_ebike_tbl`
--

CREATE TABLE `order_items_ebike_tbl` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `order_or_sales` varchar(255) NOT NULL COMMENT 'order==1 and sales==2',
  `order_subtotal` float NOT NULL,
  `ebike_stock_id` varchar(255) NOT NULL,
  `motor_number` varchar(255) NOT NULL,
  `chasis_number` varchar(255) NOT NULL,
  `warranty_start` varchar(255) NOT NULL,
  `motor_warranty_end` varchar(255) NOT NULL,
  `service_warranty_end` varchar(255) NOT NULL,
  `registration` varchar(255) NOT NULL COMMENT 'registered == 1 and not == 0',
  `claim` varchar(255) NOT NULL COMMENT 'claimed == 1 and unclaimed == 0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order_items_parts_tbl`
--

CREATE TABLE `order_items_parts_tbl` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `color` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `order_or_sales` varchar(255) NOT NULL COMMENT 'order==1 and sales==2',
  `order_quantity` int(11) NOT NULL,
  `order_subtotal` float NOT NULL,
  `motor_number` varchar(255) NOT NULL,
  `chasis_number` varchar(255) NOT NULL,
  `warranty_start` varchar(255) NOT NULL,
  `warranty_end` varchar(255) NOT NULL,
  `warranty_day` varchar(255) NOT NULL,
  `warranty_month` varchar(255) NOT NULL,
  `warranty_year` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_items_parts_tbl`
--

INSERT INTO `order_items_parts_tbl` (`id`, `order_id`, `product_id`, `product_name`, `price`, `color`, `image`, `order_or_sales`, `order_quantity`, `order_subtotal`, `motor_number`, `chasis_number`, `warranty_start`, `warranty_end`, `warranty_day`, `warranty_month`, `warranty_year`) VALUES
(52, 149, 460, 'headlight', '1200.00', 'Black', 'uploads/spareparts/parts1645106434895.png', '', 1, 1200, '', '', '', '', '', '', ''),
(53, 150, 460, 'headlight', '1200.00', 'Generic', 'uploads/spareparts/parts1645106434895.png', '', 1, 1200, '', '', '', '', '', '', ''),
(55, 276, 81, 'Headlight', '1200.00', '', '', '2', 1, 1200, '', '', '', '', '', '', ''),
(56, 277, 81, 'Headlight', '1200.00', '', '', '2', 2, 2400, '', '', '', '', '', '', ''),
(57, 151, 81, 'Headlight', '1200.00', 'Black', 'uploads/spareparts/parts1645106434895.png', '', 1, 1200, '', '', '', '', '', '', ''),
(58, 279, 81, 'Wheel', '1200.00', '', '', '2', 1, 1200, '', '', '', '', '', '', ''),
(59, 152, 81, 'Wheel', '1200.00', 'Black', 'uploads/spareparts/parts1646005350205.png', '', 2, 2400, '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `order_tbl`
--

CREATE TABLE `order_tbl` (
  `id` int(11) NOT NULL,
  `ref_no` varchar(255) NOT NULL,
  `sales_id` varchar(255) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `order_date` varchar(255) NOT NULL,
  `order_date_completed` varchar(255) NOT NULL,
  `order_date_cancelled` varchar(255) NOT NULL,
  `order_type` varchar(255) NOT NULL COMMENT 'online==1 and walkin==2',
  `vatable` decimal(8,2) NOT NULL,
  `total_products` varchar(255) NOT NULL,
  `order_total` varchar(255) NOT NULL,
  `service_charge_rate` varchar(255) NOT NULL,
  `service_charge` varchar(255) NOT NULL,
  `vat_charge_rate` varchar(255) NOT NULL,
  `vat_charge` varchar(255) NOT NULL,
  `total_amount` varchar(255) NOT NULL,
  `discount` varchar(255) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `payment_receipt` text NOT NULL,
  `status` varchar(11) NOT NULL COMMENT 'preparing 1, ready 2, completed 3, cancelled 4'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_tbl`
--

INSERT INTO `order_tbl` (`id`, `ref_no`, `sales_id`, `customer_id`, `store_id`, `customer_name`, `customer_email`, `order_date`, `order_date_completed`, `order_date_cancelled`, `order_type`, `vatable`, `total_products`, `order_total`, `service_charge_rate`, `service_charge`, `vat_charge_rate`, `vat_charge`, `total_amount`, `discount`, `payment_method`, `payment_receipt`, `status`) VALUES
(149, '179691', '273', 145, 38, 'jan wendel maghinang', 'janwendelmaghinang@gmail.com', 'Feb 27, 2022', '', '', '1', '0.00', '1', '1200', '', '', '', '', '', '', 'Landbank', 'uploads/payment_receipt/receipt1645959791846.png', '1'),
(150, '426472', '274', 145, 38, 'jan wendel maghinang', 'janwendelmaghinang@gmail.com', 'Feb 27, 2022', '', '', '1', '0.00', '1', '1200', '', '', '', '', '', '', 'Landbank', 'uploads/payment_receipt/receipt1645959978182.png', '1'),
(151, '578957', '278', 145, 38, 'jan wendel maghinang', 'janwendelmaghinang@gmail.com', 'Feb 28, 2022', '', '', '1', '0.00', '1', '1200', '', '', '', '', '', '', 'Landbank', 'uploads/payment_receipt/receipt1645980124112.png', '1'),
(152, '428861', '280', 153, 35, 'Eloisa Halasan', 'eraldhalasan@gmail.com', 'Feb 28, 2022', '', '', '1', '0.00', '1', '2400', '', '', '', '', '', '', 'Landbank', 'uploads/payment_receipt/receipt1646013639881.png', '1');

-- --------------------------------------------------------

--
-- Table structure for table `page_content`
--

CREATE TABLE `page_content` (
  `id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `page_content`
--

INSERT INTO `page_content` (`id`, `page_id`, `active`, `description`) VALUES
(1, 1, 1, 'footer'),
(2, 2, 1, 'slider');

-- --------------------------------------------------------

--
-- Table structure for table `parts_stock_tbl`
--

CREATE TABLE `parts_stock_tbl` (
  `id` int(11) NOT NULL,
  `parts_id` varchar(255) NOT NULL,
  `color_id` int(11) NOT NULL,
  `model_id` int(11) NOT NULL,
  `stored_at` varchar(255) NOT NULL,
  `qty` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `parts_stock_tbl`
--

INSERT INTO `parts_stock_tbl` (`id`, `parts_id`, `color_id`, `model_id`, `stored_at`, `qty`, `image`, `active`) VALUES
(78, '459', 0, 99, '', '8', '', 1),
(79, '455', 0, 99, '', '8', '', 1),
(81, '460', 241, 99, '', '5', 'uploads/spareparts/parts1646005286065.png', 1),
(82, '462', 0, 100, '', '10', '', 1),
(83, '456', 0, 100, '', '10', '', 1),
(84, '463', 0, 100, '', '10', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `penalty_tbl`
--

CREATE TABLE `penalty_tbl` (
  `id` int(11) NOT NULL,
  `months_delay` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penalty_percentage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penalty_tbl`
--

INSERT INTO `penalty_tbl` (`id`, `months_delay`, `penalty_percentage`, `status`, `active`) VALUES
(1, '3', '5', '1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sales_tbl`
--

CREATE TABLE `sales_tbl` (
  `id` int(11) NOT NULL,
  `ref_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sales_from` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'walkin==1 and online==2',
  `sales_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'parts == 1 and ebike == 2',
  `loan_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `loan` int(11) NOT NULL COMMENT 'loan == 1 and not == 0',
  `total_products` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gross_amount` decimal(8,2) NOT NULL,
  `vatable` decimal(8,2) NOT NULL,
  `vat_charge_rate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vat_charge` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` decimal(8,2) NOT NULL,
  `total_amount` decimal(8,2) NOT NULL,
  `amount_tentered` decimal(8,2) NOT NULL,
  `amount_change` decimal(8,2) NOT NULL,
  `sales_date` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `purchase_form` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `store_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales_tbl`
--

INSERT INTO `sales_tbl` (`id`, `ref_no`, `customer_id`, `sales_from`, `sales_type`, `loan_id`, `loan`, `total_products`, `gross_amount`, `vatable`, `vat_charge_rate`, `vat_charge`, `discount`, `total_amount`, `amount_tentered`, `amount_change`, `sales_date`, `purchase_form`, `user_id`, `store_id`) VALUES
(273, '179691', '145', '2', '1', '', 0, '1', '0.00', '0.00', '', '', '0.00', '1200.00', '1200.00', '0.00', 'Feb 27, 2022', '', '', ''),
(274, '426472', '145', '2', '1', '', 0, '1', '0.00', '0.00', '', '', '0.00', '1200.00', '1200.00', '0.00', 'Feb 27, 2022', '', '', ''),
(276, '798607', '147', '1', '1', '', 0, '1', '1200.00', '1071.43', '12', '128.57', '0.00', '1200.00', '1200.00', '0.00', 'Feb 27, 2022', '', '1', ''),
(277, '245077', '152', '1', '1', '', 0, '1', '2400.00', '2142.86', '12', '257.14', '0.00', '2400.00', '3000.00', '600.00', 'Feb 27, 2022', '', '1', ''),
(278, '578957', '145', '2', '1', '', 0, '1', '0.00', '0.00', '', '', '0.00', '1200.00', '1200.00', '0.00', 'Feb 28, 2022', '', '', ''),
(279, '668035', '147', '1', '1', '', 0, '1', '1200.00', '1071.43', '12', '128.57', '0.00', '1200.00', '1200.00', '0.00', 'Feb 28, 2022', '', '1', ''),
(280, '428861', '153', '2', '1', '', 0, '1', '0.00', '0.00', '', '', '0.00', '2400.00', '2400.00', '0.00', 'Feb 28, 2022', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `id` int(11) NOT NULL,
  `text` text NOT NULL,
  `links` text NOT NULL,
  `active` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `store_tbl`
--

CREATE TABLE `store_tbl` (
  `store_id` int(11) NOT NULL,
  `store_name` varchar(50) NOT NULL,
  `store_contact` varchar(15) NOT NULL,
  `store_street` varchar(50) NOT NULL,
  `store_subdivision` varchar(50) NOT NULL,
  `store_barangay` varchar(50) NOT NULL,
  `store_city` varchar(50) NOT NULL,
  `store_province` varchar(50) NOT NULL,
  `m_firstname` varchar(255) NOT NULL,
  `m_middlename` varchar(255) NOT NULL,
  `m_lastname` varchar(255) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `store_tbl`
--

INSERT INTO `store_tbl` (`store_id`, `store_name`, `store_contact`, `store_street`, `store_subdivision`, `store_barangay`, `store_city`, `store_province`, `m_firstname`, `m_middlename`, `m_lastname`, `active`) VALUES
(35, 'jan\'s Store', '09154040863', '123street', 'grand villas', 'marilao', 'bulacan', 'bulacan', 'janwendel', 'margallo', 'maghinang', 1),
(38, 'wendy\'s store', '091234231323', '#123', 'grand villas', 'loma de gato', 'marilao', 'bulacan', 'Wendy', 'M.', 'Maghinang', 1);

-- --------------------------------------------------------

--
-- Table structure for table `system_logs`
--

CREATE TABLE `system_logs` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `user` varchar(255) NOT NULL,
  `activity` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_logs`
--

INSERT INTO `system_logs` (`id`, `user_id`, `user`, `activity`, `date`, `time`) VALUES
(662, '1', 'admin', 'login', 'Jan Sat, 2022', '10:31:03pm'),
(663, '1', 'admin', 'login', 'Jan Sun, 2022', '12:40:33pm'),
(664, '1', 'admin', 'login', 'Jan Sun, 2022', '06:23:56pm'),
(665, '1', 'admin', 'login', 'Jan Mon, 2022', '02:12:23pm'),
(666, '1', 'admin', 'login', 'Jan Mon, 2022', '08:17:21pm'),
(667, '1', 'admin', 'login', 'Feb Tue, 2022', '02:35:27pm'),
(668, '1', 'admin', 'login', 'Feb Tue, 2022', '08:35:06pm'),
(669, '1', 'admin', 'login', 'Feb Wed, 2022', '11:10:15pm'),
(670, '1', 'admin', 'Update Color \"blue\" to \"blue\"', 'Feb Wed, 2022', '11:18:34pm'),
(671, '1', 'admin', 'Update Color \"blue\" to \"blue\"', 'Feb Wed, 2022', '11:18:41pm'),
(672, '1', 'admin', 'Update Color \"blue\" to \"blues\"', 'Feb Wed, 2022', '11:18:46pm'),
(673, '1', 'admin', 'Update Color \"blues\" to \"blue\"', 'Feb Wed, 2022', '11:18:52pm'),
(674, '1', 'admin', 'Update Color \"blue\" to \"blue\"', 'Feb Wed, 2022', '11:19:00pm'),
(675, '1', 'admin', 'Update Color \"blue\" to \"blue\"', 'Feb Wed, 2022', '11:19:05pm'),
(676, '1', 'admin', 'login', 'Feb Thu, 2022', '08:48:59pm'),
(677, '1', 'admin', 'login', 'Feb Fri, 2022', '03:25:25pm'),
(678, '1', 'admin', 'login', 'Feb Fri, 2022', '08:24:48pm'),
(679, '1', 'admin', 'login', 'Feb Sat, 2022', '05:21:14pm'),
(680, '1', 'admin', 'login', 'Feb Sun, 2022', '12:18:39am'),
(681, '1', 'admin', 'login', 'Feb Sun, 2022', '05:26:13pm'),
(682, '1', 'admin', 'login', 'Feb Mon, 2022', '03:00:46pm'),
(683, '1', 'admin', 'login', 'Feb Tue, 2022', '12:32:53pm'),
(684, '1', 'admin', 'login', 'Feb Tue, 2022', '06:52:05pm'),
(685, '1', 'admin', 'login', 'Feb Wed, 2022', '07:17:18pm'),
(686, '1', 'admin', 'Add Model \"thunder\"', 'Feb Wed, 2022', '10:32:12pm'),
(687, '1', 'admin', 'login', 'Feb Thu, 2022', '11:49:51am'),
(688, '1', 'admin', 'update Model \"heroine\"', 'Feb Thu, 2022', '11:51:44am'),
(689, '1', 'admin', 'update Model \"j3\"', 'Feb Thu, 2022', '11:52:41am'),
(690, '1', 'admin', 'login', 'Feb Fri, 2022', '02:56:23pm'),
(691, '1', 'admin', 'login', 'Feb Fri, 2022', '06:38:25pm'),
(692, '1', 'admin', 'logout', 'Feb Fri, 2022', '09:08:50pm'),
(693, '1', 'admin', 'login', 'Feb Fri, 2022', '09:18:30pm'),
(694, '1', 'admin', 'login', 'Feb Sat, 2022', '11:45:08pm'),
(695, '1', 'admin', 'login', 'Feb Sun, 2022', '11:04:30am'),
(696, '1', 'admin', 'login', 'Feb Sun, 2022', '06:09:53pm'),
(697, '1', 'admin', 'Update Store \"jan\'s Store\" to \"\"', 'Feb Sun, 2022', '11:50:29pm'),
(698, '1', 'admin', 'login', 'Feb Mon, 2022', '12:01:27am'),
(699, '1', 'admin', 'login', 'Feb Mon, 2022', '04:36:13pm'),
(700, '1', 'admin', 'login', 'Feb Tue, 2022', '10:31:42pm'),
(701, '1', 'admin', 'login', 'Feb Tue, 2022', '10:45:55pm'),
(702, '1', 'admin', 'login', 'Feb Wed, 2022', '07:19:16am'),
(703, '1', 'admin', 'Update Color \"red\" to \"Red\"', 'Feb Wed, 2022', '07:29:58am'),
(704, '1', 'admin', 'Update Color \"blue\" to \"Blue\"', 'Feb Wed, 2022', '07:30:06am'),
(705, '1', 'admin', 'Update Color \"Blue\" to \"Blue\"', 'Feb Wed, 2022', '07:30:07am'),
(706, '1', 'admin', 'Delete Color \"orange\"', 'Feb Wed, 2022', '07:30:09am'),
(707, '1', 'admin', 'Add Color \"Green\"', 'Feb Wed, 2022', '07:30:18am'),
(708, '1', 'admin', 'Update Color \"Blue\" to \"Yellow\"', 'Feb Wed, 2022', '07:37:32am'),
(709, '1', 'admin', 'Update Color \"Green\" to \"Black\"', 'Feb Wed, 2022', '07:37:39am'),
(710, '1', 'admin', 'Add Model \"Amore\"', 'Feb Wed, 2022', '07:49:39am'),
(711, '1', 'admin', 'Add Model \"Heroine\"', 'Feb Wed, 2022', '07:51:24am'),
(712, '1', 'admin', 'login', 'Feb Wed, 2022', '08:08:51am'),
(713, '1', 'admin', 'login', 'Feb Wed, 2022', '08:20:54am'),
(714, '1', 'admin', 'logout', 'Feb Wed, 2022', '08:45:09am'),
(715, '1', 'admin', 'login', 'Feb Wed, 2022', '08:45:15am'),
(716, '1', 'admin', 'logout', 'Feb Wed, 2022', '08:46:23am'),
(717, '1', 'admin', 'login', 'Feb Wed, 2022', '08:46:33am'),
(718, '1', 'admin', 'Delete Parts \"Motor\"', 'Feb Wed, 2022', '08:50:27am'),
(719, '1', 'admin', 'login', 'Feb Wed, 2022', '03:12:14pm'),
(720, '1', 'admin', 'login', 'Feb Thu, 2022', '10:29:01am'),
(721, '1', 'admin', 'login', 'Feb Thu, 2022', '10:35:48am'),
(722, '1', 'admin', 'login', 'Feb Thu, 2022', '04:56:53pm'),
(723, '1', 'admin', 'login', 'Feb Thu, 2022', '09:38:20pm'),
(724, '1', 'admin', 'login', 'Feb Fri, 2022', '11:50:06am'),
(725, '1', 'admin', 'login', 'Feb Fri, 2022', '02:25:48pm'),
(726, '1', 'admin', 'login', 'Feb Fri, 2022', '03:24:14pm'),
(727, '1', 'admin', 'login', 'Feb Sun, 2022', '10:43:30pm'),
(728, '1', 'admin', 'login', 'Feb Mon, 2022', '01:46:42am'),
(729, '1', 'admin', 'login', 'Feb Mon, 2022', '11:40:24am'),
(730, '1', 'admin', 'login', 'Feb Mon, 2022', '10:55:15pm'),
(731, '1', 'admin', 'login', 'Feb Mon, 2022', '11:10:48pm'),
(732, '1', 'admin', 'login', 'Feb Tue, 2022', '11:47:11am'),
(733, '1', 'admin', 'login', 'Feb Tue, 2022', '02:18:56pm'),
(734, '1', 'admin', 'login', 'Feb Tue, 2022', '02:43:16pm'),
(735, '1', 'admin', 'login', 'Feb Tue, 2022', '08:32:13pm'),
(736, '1', 'admin', 'login', 'Feb Tue, 2022', '08:50:09pm'),
(737, '1', 'admin', 'login', 'Feb Tue, 2022', '09:37:19pm'),
(738, '1', 'admin', 'login', 'Feb Wed, 2022', '11:54:23am'),
(739, '1', 'admin', 'login', 'Feb Wed, 2022', '04:23:45pm'),
(740, '1', 'admin', 'logout', 'Feb Wed, 2022', '04:46:58pm'),
(741, '1', 'admin', 'login', 'Feb Wed, 2022', '04:58:28pm'),
(742, '1', 'admin', 'login', 'Feb Wed, 2022', '06:42:15pm'),
(743, '1', 'admin', 'Delete Parts \"Wheel\"', 'Feb Wed, 2022', '07:18:54pm'),
(744, '1', 'admin', 'Delete Parts \"Wheel\"', 'Feb Wed, 2022', '07:43:22pm'),
(745, '1', 'admin', 'logout', 'Feb Wed, 2022', '08:27:07pm'),
(746, '1', 'admin', 'login', 'Feb Wed, 2022', '08:27:41pm'),
(747, '1', 'admin', 'login', 'Feb Thu, 2022', '01:55:40pm'),
(748, '1', 'admin', 'login', 'Feb Thu, 2022', '03:51:29pm'),
(749, '1', 'admin', 'login', 'Feb Thu, 2022', '10:22:03pm'),
(750, '1', 'admin', 'login', 'Feb Fri, 2022', '09:43:24am'),
(751, '1', 'admin', 'login', 'Feb Fri, 2022', '12:32:46pm'),
(752, '1', 'admin', 'login', 'Feb Fri, 2022', '06:29:01pm'),
(753, '1', 'admin', 'login', 'Feb Sat, 2022', '12:18:08am'),
(754, '1', 'admin', 'login', 'Feb Sat, 2022', '10:56:53am'),
(755, '1', 'admin', 'login', 'Feb Sat, 2022', '03:10:13pm'),
(756, '1', 'admin', 'login', 'Feb Sat, 2022', '03:47:11pm'),
(757, '1', 'admin', 'logout', 'Feb Sat, 2022', '05:44:55pm'),
(758, '1', 'admin', 'login', 'Feb Sat, 2022', '07:56:32pm'),
(759, '1', 'admin', 'login', 'Feb Sun, 2022', '12:05:44am'),
(760, '1', 'admin', 'login', 'Feb Sun, 2022', '10:34:42am'),
(761, '1', 'admin', 'login', 'Feb Sun, 2022', '03:07:39pm'),
(762, '1', 'admin', 'login', 'Feb Sun, 2022', '06:35:42pm'),
(763, '1', 'admin', 'login', 'Feb Sun, 2022', '06:56:18pm'),
(764, '1', 'admin', 'login', 'Feb Mon, 2022', '12:42:15am'),
(765, '1', 'admin', 'login', 'Feb Mon, 2022', '03:46:26am'),
(766, '1', 'admin', 'login', 'Feb Mon, 2022', '07:32:13am'),
(767, '1', 'admin', 'login', 'Feb Mon, 2022', '08:18:04am'),
(768, '1', 'admin', 'login', 'Feb Mon, 2022', '09:31:16am'),
(769, '1', 'admin', 'login', 'Feb Mon, 2022', '05:04:33pm'),
(770, '1', 'admin', 'login', 'Feb Mon, 2022', '11:21:33pm'),
(771, '1', 'admin', 'login', 'Mar Tue, 2022', '12:40:59pm'),
(772, '1', 'admin', 'login', 'Mar Tue, 2022', '02:31:13pm'),
(773, '1', 'admin', 'logout', 'Mar Tue, 2022', '03:44:36pm'),
(774, '1', 'admin', 'login', 'Mar Tue, 2022', '03:44:43pm'),
(775, '1', 'admin', 'logout', 'Mar Tue, 2022', '04:00:20pm'),
(776, '1', 'admin', 'login', 'Mar Tue, 2022', '06:30:38pm'),
(777, '1', 'admin', 'login', 'Mar Wed, 2022', '09:45:09am'),
(778, '1', 'admin', 'login', 'Mar Thu, 2022', '08:18:34am'),
(779, '1', 'admin', 'Add user \"John\"', 'Mar Thu, 2022', '08:29:12am'),
(780, '1', 'admin', 'login', 'Mar Thu, 2022', '12:39:36pm'),
(781, '1', 'admin', 'login', 'Mar Thu, 2022', '02:52:15pm'),
(782, '1', 'admin', 'login', 'Mar Thu, 2022', '06:42:04pm'),
(783, '1', 'admin', 'login', 'Mar Thu, 2022', '11:30:49pm'),
(784, '1', 'admin', 'login', 'Mar Sat, 2022', '04:22:28pm'),
(785, '1', 'admin', 'login', 'Mar Sat, 2022', '05:45:55pm'),
(786, '1', 'admin', 'logout', 'Mar Sat, 2022', '06:25:19pm'),
(787, '1', 'admin', 'login', 'Mar Sat, 2022', '06:31:02pm'),
(788, '1', 'admin', 'login', 'Mar Sat, 2022', '09:12:09pm'),
(789, '1', 'admin', 'login', 'Mar Sat, 2022', '11:34:21pm'),
(790, '1', 'admin', 'Add Color \"Green\"', 'Mar Sat, 2022', '11:37:52pm'),
(791, '1', 'admin', 'login', 'Mar Sun, 2022', '12:18:10am'),
(792, '1', 'admin', 'login', 'Mar Mon, 2022', '12:19:21am'),
(793, '1', 'admin', 'login', 'Mar Mon, 2022', '08:51:19am'),
(794, '1', 'admin', 'login', 'Mar Mon, 2022', '03:21:54pm'),
(795, '1', 'admin', 'login', 'Mar Tue, 2022', '01:06:24am'),
(796, '1', 'admin', 'login', 'Mar Tue, 2022', '02:12:07pm'),
(797, '1', 'admin', 'login', 'Mar Tue, 2022', '04:29:18pm'),
(798, '1', 'admin', 'login', 'Mar Tue, 2022', '10:25:25pm'),
(799, '1', 'admin', 'login', 'Mar Wed, 2022', '12:34:29am'),
(800, '1', 'admin', 'login', 'Mar Wed, 2022', '09:25:21am'),
(801, '1', 'admin', 'login', 'Mar Wed, 2022', '11:24:28am'),
(802, '1', 'admin', 'login', 'Mar Wed, 2022', '12:30:10pm'),
(803, '1', 'admin', 'login', 'Mar Thu, 2022', '12:12:43am'),
(804, '1', 'admin', 'login', 'Mar Thu, 2022', '11:04:11am'),
(805, '1', 'admin', 'login', 'Mar Mon, 2022', '01:52:03am'),
(806, '1', 'admin', 'login', 'Mar Mon, 2022', '10:44:57am'),
(807, '1', 'admin', 'login', 'Mar Tue, 2022', '01:27:27pm'),
(808, '1', 'admin', 'logout', 'Mar Tue, 2022', '01:30:08pm'),
(809, '1', 'admin', 'login', 'Mar Mon, 2022', '11:13:10am');

-- --------------------------------------------------------

--
-- Table structure for table `users_tbl`
--

CREATE TABLE `users_tbl` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `middle` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `subdivision` varchar(255) NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `usertype` varchar(255) NOT NULL,
  `store` varchar(255) NOT NULL,
  `active` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_tbl`
--

INSERT INTO `users_tbl` (`id`, `firstname`, `lastname`, `middle`, `email`, `contact`, `username`, `password`, `street`, `subdivision`, `barangay`, `city`, `province`, `image`, `usertype`, `store`, `active`) VALUES
(1, 'Gerald', 'Halasan', 'N', 'janwendelmaghinang@gmail.com', '09351100123', 'admin', 'password', '123', 'marygrace', 'santarosa 2', 'marilao', 'Bulacan', 'uploads/profile/profile1646642726039.png', '1', '', '1'),
(2, 'Rechelle', 'Roa', '', 'roarechelle@gmail.com', '', 'manager2', 'password', '', '', '', '', '', '', '2', '', '0'),
(3, 'John', 'Doe', '', 'markcalilong@yahoo.com', '', 'JDManager', 'JDmanager123@', '', '', '', '', '', '', '2', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_us`
--
ALTER TABLE `about_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_account`
--
ALTER TABLE `bank_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chasis_number`
--
ALTER TABLE `chasis_number`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_tbl`
--
ALTER TABLE `customer_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ebike_application_tbl`
--
ALTER TABLE `ebike_application_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ebike_color_tbl`
--
ALTER TABLE `ebike_color_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ebike_deliver_tbl`
--
ALTER TABLE `ebike_deliver_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ebike_model_tbl`
--
ALTER TABLE `ebike_model_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ebike_needed_parts_tbl`
--
ALTER TABLE `ebike_needed_parts_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ebike_parts_tbl`
--
ALTER TABLE `ebike_parts_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ebike_production_items`
--
ALTER TABLE `ebike_production_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ebike_production_tbl`
--
ALTER TABLE `ebike_production_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ebike_specification_tbl`
--
ALTER TABLE `ebike_specification_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ebike_stock_items`
--
ALTER TABLE `ebike_stock_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ebike_stock_tbl`
--
ALTER TABLE `ebike_stock_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ebike_store_stock_tbl`
--
ALTER TABLE `ebike_store_stock_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `footer`
--
ALTER TABLE `footer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inquiry_form`
--
ALTER TABLE `inquiry_form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `interest`
--
ALTER TABLE `interest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_payment_schedule`
--
ALTER TABLE `loan_payment_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `motor_number`
--
ALTER TABLE `motor_number`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items_ebike_tbl`
--
ALTER TABLE `order_items_ebike_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items_parts_tbl`
--
ALTER TABLE `order_items_parts_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_tbl`
--
ALTER TABLE `order_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page_content`
--
ALTER TABLE `page_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parts_stock_tbl`
--
ALTER TABLE `parts_stock_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penalty_tbl`
--
ALTER TABLE `penalty_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_tbl`
--
ALTER TABLE `sales_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store_tbl`
--
ALTER TABLE `store_tbl`
  ADD PRIMARY KEY (`store_id`);

--
-- Indexes for table `system_logs`
--
ALTER TABLE `system_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_tbl`
--
ALTER TABLE `users_tbl`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_us`
--
ALTER TABLE `about_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bank_account`
--
ALTER TABLE `bank_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `chasis_number`
--
ALTER TABLE `chasis_number`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_tbl`
--
ALTER TABLE `customer_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- AUTO_INCREMENT for table `ebike_application_tbl`
--
ALTER TABLE `ebike_application_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `ebike_color_tbl`
--
ALTER TABLE `ebike_color_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=243;

--
-- AUTO_INCREMENT for table `ebike_deliver_tbl`
--
ALTER TABLE `ebike_deliver_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ebike_model_tbl`
--
ALTER TABLE `ebike_model_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `ebike_needed_parts_tbl`
--
ALTER TABLE `ebike_needed_parts_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;

--
-- AUTO_INCREMENT for table `ebike_parts_tbl`
--
ALTER TABLE `ebike_parts_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=464;

--
-- AUTO_INCREMENT for table `ebike_production_items`
--
ALTER TABLE `ebike_production_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `ebike_production_tbl`
--
ALTER TABLE `ebike_production_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=285;

--
-- AUTO_INCREMENT for table `ebike_specification_tbl`
--
ALTER TABLE `ebike_specification_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `ebike_stock_items`
--
ALTER TABLE `ebike_stock_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `ebike_stock_tbl`
--
ALTER TABLE `ebike_stock_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `ebike_store_stock_tbl`
--
ALTER TABLE `ebike_store_stock_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `footer`
--
ALTER TABLE `footer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `inquiry_form`
--
ALTER TABLE `inquiry_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `interest`
--
ALTER TABLE `interest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `loan_payment_schedule`
--
ALTER TABLE `loan_payment_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=266;

--
-- AUTO_INCREMENT for table `motor_number`
--
ALTER TABLE `motor_number`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items_ebike_tbl`
--
ALTER TABLE `order_items_ebike_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `order_items_parts_tbl`
--
ALTER TABLE `order_items_parts_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `order_tbl`
--
ALTER TABLE `order_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT for table `page_content`
--
ALTER TABLE `page_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `parts_stock_tbl`
--
ALTER TABLE `parts_stock_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `penalty_tbl`
--
ALTER TABLE `penalty_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sales_tbl`
--
ALTER TABLE `sales_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=281;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `store_tbl`
--
ALTER TABLE `store_tbl`
  MODIFY `store_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `system_logs`
--
ALTER TABLE `system_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=810;

--
-- AUTO_INCREMENT for table `users_tbl`
--
ALTER TABLE `users_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
