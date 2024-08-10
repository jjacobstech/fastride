-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 07, 2024 at 06:29 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fastride`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `a_id` int(11) NOT NULL,
  `a_name` varchar(256) NOT NULL,
  `a_email` varchar(100) NOT NULL,
  `a_pwd` varchar(100) DEFAULT NULL,
  `a_created_date` datetime NOT NULL,
  `a_modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`a_id`, `a_name`, `a_email`, `a_pwd`, `a_created_date`, `a_modified_date`) VALUES
(1, 'Mr Admin', 'admin@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2024-02-25 16:38:18', '2024-03-07 17:26:47');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `b_id` int(10) NOT NULL,
  `b_customer_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `b_ride` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `b_date` datetime NOT NULL,
  `b_trip_fromlocation` varchar(255) NOT NULL,
  `b_trip_tolocation` varchar(255) NOT NULL,
  `b_trip_amount` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `b_created_by` varchar(255) NOT NULL,
  `b_created_date` datetime NOT NULL,
  `b_modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`b_id`, `b_customer_name`, `b_ride`, `b_date`, `b_trip_fromlocation`, `b_trip_tolocation`, `b_trip_amount`, `b_created_by`, `b_created_date`, `b_modified_date`) VALUES
(22, 'J maxim', 'Car - Toyota - kja488736xx', '2024-03-07 16:05:00', 'ekosodin', 'Lagos', 'NGN50,000', 'J maxim', '2024-03-07 16:05:00', '2024-03-07 15:05:00'),
(23, 'A maxim', 'Car - Toyota - kja488736xx', '2024-03-07 16:05:48', 'adfafa', 'Lagos', 'NGN50,000', 'A maxim', '2024-03-07 16:05:48', '2024-03-07 15:05:48');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `c_id` int(11) NOT NULL,
  `c_name` varchar(256) NOT NULL,
  `c_pwd` varchar(100) DEFAULT NULL,
  `c_mobile` varchar(15) NOT NULL,
  `c_email` varchar(100) NOT NULL,
  `c_address` varchar(256) NOT NULL,
  `c_created_date` datetime NOT NULL,
  `c_modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`c_id`, `c_name`, `c_pwd`, `c_mobile`, `c_email`, `c_address`, `c_created_date`, `c_modified_date`) VALUES
(4, 'J maxim', '827ccb0eea8a706c4c34a16891f84e7b', '07059579655', 'jmaxim@gmail.com', 'adfafa', '2024-03-07 16:02:45', '2024-03-07 15:23:28');

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `d_id` int(11) NOT NULL,
  `d_name` varchar(100) NOT NULL,
  `d_mobile` varchar(15) NOT NULL,
  `d_address` varchar(250) NOT NULL,
  `d_licenseno` varchar(100) NOT NULL,
  `d_is_active` int(11) NOT NULL DEFAULT 1,
  `d_created_date` datetime NOT NULL,
  `d_modified_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`d_id`, `d_name`, `d_mobile`, `d_address`, `d_licenseno`, `d_is_active`, `d_created_date`, `d_modified_date`) VALUES
(7, 'Driver A', '07059579655', 'ekosodin', 'RX75599jj', 1, '2024-03-05 13:52:55', '2024-03-05 12:52:55'),
(8, 'Driver B', '07059579655', 'ekosodin', 'RX75599jj', 1, '2024-03-05 13:52:55', '2024-03-05 12:52:55'),
(9, 'Driver C', '07059579655', 'ekosodin', 'RX75599jj', 1, '2024-03-05 13:52:55', '2024-03-05 12:52:55');

-- --------------------------------------------------------

--
-- Table structure for table `rides`
--

CREATE TABLE `rides` (
  `r_id` int(10) NOT NULL,
  `r_reg_no` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `r_name` varchar(100) NOT NULL,
  `r_model` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `r_chassis_no` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `r_engine_no` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `r_brand` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `r_type` varchar(100) NOT NULL,
  `r_color` varchar(100) NOT NULL,
  `r_reg_exp_date` varchar(100) NOT NULL,
  `r_created_date` datetime NOT NULL,
  `r_modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `rides`
--

INSERT INTO `rides` (`r_id`, `r_reg_no`, `r_name`, `r_model`, `r_chassis_no`, `r_engine_no`, `r_brand`, `r_type`, `r_color`, `r_reg_exp_date`, `r_created_date`, `r_modified_date`) VALUES
(1, 'kja488736xx', 'Avensis', '2020', 'ki84hh48l9', 'fju98399FF', 'Toyota', 'Car', 'Black', '2024-02-29 00:52:22', '2024-02-29 00:52:22', '2024-02-28 23:52:22'),
(2, 'kja488736xx', 'Avensis', '2020', 'ki84hh48l9', 'fju98399FF', 'Toyota', 'Car', 'Black', '2024-02-29 00:52:22', '2024-02-29 00:52:22', '2024-02-28 23:52:22'),
(3, 'kja488736xx', 'Avensis', '2020', 'ki84hh48l9', 'fju98399FF', 'Toyota', 'Car', 'Black', '2024-02-29 00:52:22', '2024-02-29 00:52:22', '2024-02-28 23:52:22'),
(4, 'kja488736xx', 'Avensis', '2020', 'ki84hh48l9', 'fju98399FF', 'Toyota', 'Car', 'Black', '2024-02-29 00:52:22', '2024-02-29 00:52:22', '2024-02-28 23:52:22'),
(5, 'kja488736xx', 'Avensis', '2020', 'ki84hh48l9', 'fju98399FF', 'Toyota', 'Car', 'Black', '2024-02-29 00:52:22', '2024-02-29 00:52:22', '2024-02-28 23:52:22'),
(6, 'kja488736xx', 'Avensis', '2020', 'ki84hh48l9', 'fju98399FF', 'Toyota', 'Car', 'Black', '2024-02-29 00:52:22', '2024-02-29 00:52:22', '2024-02-28 23:52:22'),
(7, 'kja488736xx', 'Avensis', '2020', 'ki84hh48l9', 'fju98399FF', 'Toyota', 'Car', 'Black', '2024-02-29 00:52:22', '2024-02-29 00:52:22', '2024-02-28 23:52:22'),
(8, 'kja488736xx', 'Avensis', '2020', 'ki84hh48l9', 'fju98399FF', 'Toyota', 'Car', 'Black', '2024-02-29 00:52:22', '2024-02-29 00:52:22', '2024-02-28 23:52:22');

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE `routes` (
  `r_id` int(11) NOT NULL,
  `from` varchar(100) NOT NULL,
  `to` varchar(100) NOT NULL,
  `price` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`r_id`, `from`, `to`, `price`) VALUES
(1, 'Abuja', 'Lagos', 'NGN50,000'),
(2, 'Abuja', 'Ibadan', 'NGN44,000'),
(3, 'Abuja', 'Ibadan', 'NGN44,000'),
(4, 'Benin', 'Ibadan', 'NGN10,900'),
(5, 'Abuja', 'Benin', 'NGN30,000'),
(6, 'Benin', 'Delta', 'NGN44,000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`a_id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`b_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`d_id`);

--
-- Indexes for table `rides`
--
ALTER TABLE `rides`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`r_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `b_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `rides`
--
ALTER TABLE `rides`
  MODIFY `r_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
