-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2024 at 05:38 PM
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
-- Database: `hotel_website`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `sr_no` int(11) NOT NULL,
  `admin_name` varchar(50) NOT NULL,
  `admin_pass` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`sr_no`, `admin_name`, `admin_pass`) VALUES
(1, 'phuongahihi', '13032004');

-- --------------------------------------------------------

--
-- Table structure for table `booking_details`
--

CREATE TABLE `booking_details` (
  `sr_no` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `room_name` varchar(250) NOT NULL,
  `price` int(11) NOT NULL,
  `total_pay` int(11) NOT NULL,
  `room_no` int(11) DEFAULT NULL,
  `user_name` varchar(150) NOT NULL,
  `phonenum` varchar(100) NOT NULL,
  `address` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking_details`
--

INSERT INTO `booking_details` (`sr_no`, `booking_id`, `room_name`, `price`, `total_pay`, `room_no`, `user_name`, `phonenum`, `address`) VALUES
(1, 1, 'Phòng Phổ Thông', 700000, 3500000, 101, 'Hoàng Gia Minh', '0363943004', 'thôn 1, xã Ninh Sơn, thị xã Ninh Hòa, Khánh Hòa'),
(2, 2, 'Phòng Junior Suite', 2900000, 11600000, NULL, 'Võ Nhất Phương', '0365486141', 'Thị xã Ninh Hòa, Tỉnh Khánh Hòa'),
(3, 3, 'Phòng Gia Đình Cao Cấp', 1800000, 9000000, 301, 'Nguyễn Nhật Minh', '0373973754', 'Vinhome grandpark, đường Nguyễn Xiễn, phường Long Thạnh Mỹ, thành phố Thủ Đức'),
(4, 4, 'Phòng Executive Family', 2000000, 4000000, NULL, 'Võ Nhất Phương', '0355428433', 'thôn Lạc Bình, xã Ninh Thọ, thị xã Ninh Hòa, Khánh Hòa'),
(5, 5, 'Phòng Kết Nối', 2400000, 4800000, NULL, 'Triệu Viễn Châu', '0981938932', 'KTX Khu B, Đông Hòa, Dĩ An, Bình Dương'),
(6, 6, 'Phòng Executive Triple Balcony', 3000000, 3000000, NULL, 'Hoàng Gia Minh', '0363943004', 'thôn 1, xã Ninh Sơn, thị xã Ninh Hòa, Khánh Hòa'),
(7, 7, 'Phòng Senior Suite', 3500000, 7000000, NULL, 'Võ Nhất Phương', '0365486141', 'Thị xã Ninh Hòa, Tỉnh Khánh Hòa'),
(8, 8, 'Phòng Cao Cấp Deluxe', 1500000, 7500000, 304, 'Nguyễn Nhật Minh', '0373973754', 'Vinhome grandpark, đường Nguyễn Xiễn, phường Long Thạnh Mỹ, thành phố Thủ Đức'),
(9, 9, 'Phòng Penthouse', 4000000, 8000000, 501, 'Võ Nhất Phương', '0355428433', 'thôn Lạc Bình, xã Ninh Thọ, thị xã Ninh Hòa, Khánh Hòa'),
(10, 10, 'Phòng Cao Cấp', 1000000, 5000000, NULL, 'Triệu Viễn Châu', '0981938932', 'KTX Khu B, Đông Hòa, Dĩ An, Bình Dương'),
(11, 11, 'Phòng Junior Suite', 2900000, 11600000, 110, 'Hoàng Gia Minh', '0363943004', 'thôn 1, xã Ninh Sơn, thị xã Ninh Hòa, Khánh Hòa'),
(12, 12, 'Phòng Gia Đình Cao Cấp', 1800000, 9000000, 302, 'Võ Nhất Phương', '0365486141', 'Thị xã Ninh Hòa, Tỉnh Khánh Hòa'),
(13, 13, 'Phòng Executive Triple Balcony', 3000000, 9000000, NULL, 'Nguyễn Nhật Minh', '0373973754', 'Vinhome grandpark, đường Nguyễn Xiễn, phường Long Thạnh Mỹ, thành phố Thủ Đức'),
(14, 14, 'Phòng Phổ Thông', 700000, 3500000, 102, 'Võ Nhất Phương', '0355428433', 'thôn Lạc Bình, xã Ninh Thọ, thị xã Ninh Hòa, Khánh Hòa'),
(15, 15, 'Phòng Penthouse', 4000000, 20000000, 502, 'Triệu Viễn Châu', '0981938932', 'KTX Khu B, Đông Hòa, Dĩ An, Bình Dương'),
(16, 16, 'Phòng Kết Nối', 2400000, 12000000, 209, 'Hoàng Gia Minh', '0363943004', 'thôn 1, xã Ninh Sơn, thị xã Ninh Hòa, Khánh Hòa'),
(17, 17, 'Phòng Executive Family', 2000000, 10000000, 401, 'Võ Nhất Phương', '0365486141', 'Thị xã Ninh Hòa, Tỉnh Khánh Hòa'),
(18, 18, 'Phòng Senior Suite', 3500000, 10500000, 406, 'Nguyễn Nhật Minh', '0373973754', 'Vinhome grandpark, đường Nguyễn Xiễn, phường Long Thạnh Mỹ, thành phố Thủ Đức'),
(19, 19, 'Phòng Cao Cấp Deluxe', 1500000, 9000000, 306, 'Võ Nhất Phương', '0355428433', 'thôn Lạc Bình, xã Ninh Thọ, thị xã Ninh Hòa, Khánh Hòa'),
(20, 20, 'Phòng Executive Triple Balcony', 3000000, 12000000, 108, 'Triệu Viễn Châu', '0981938932', 'KTX Khu B, Đông Hòa, Dĩ An, Bình Dương'),
(21, 21, 'Phòng Cao Cấp', 1000000, 5000000, 202, 'Hoàng Gia Minh', '0363943004', 'thôn 1, xã Ninh Sơn, thị xã Ninh Hòa, Khánh Hòa'),
(22, 22, 'Phòng Penthouse', 4000000, 12000000, 502, 'Võ Nhất Phương', '0365486141', 'Thị xã Ninh Hòa, Tỉnh Khánh Hòa'),
(23, 23, 'Phòng Junior Suite', 2900000, 14500000, 405, 'Nguyễn Nhật Minh', '0373973754', 'Vinhome grandpark, đường Nguyễn Xiễn, phường Long Thạnh Mỹ, thành phố Thủ Đức'),
(24, 24, 'Phòng Executive Family', 2000000, 12000000, 404, 'Võ Nhất Phương', '0355428433', 'thôn Lạc Bình, xã Ninh Thọ, thị xã Ninh Hòa, Khánh Hòa'),
(25, 25, 'Phòng Senior Suite', 3500000, 17500000, 407, 'Triệu Viễn Châu', '0981938932', 'KTX Khu B, Đông Hòa, Dĩ An, Bình Dương'),
(26, 26, 'Phòng Gia Đình Cao Cấp', 1800000, 7200000, NULL, 'Hoàng Gia Minh', '0363943004', 'thôn 1, xã Ninh Sơn, thị xã Ninh Hòa, Khánh Hòa'),
(27, 27, 'Phòng Kết Nối', 2400000, 9600000, 210, 'Võ Nhất Phương', '0365486141', 'Thị xã Ninh Hòa, Tỉnh Khánh Hòa'),
(28, 28, 'Phòng Phổ Thông', 700000, 3500000, 307, 'Nguyễn Nhật Minh', '0373973754', 'Vinhome grandpark, đường Nguyễn Xiễn, phường Long Thạnh Mỹ, thành phố Thủ Đức'),
(29, 29, 'Phòng Executive Triple Balcony', 3000000, 3000000, NULL, 'Võ Nhất Phương', '0355428433', 'thôn Lạc Bình, xã Ninh Thọ, thị xã Ninh Hòa, Khánh Hòa'),
(30, 30, 'Phòng Cao Cấp Deluxe', 1500000, 7500000, 305, 'Triệu Viễn Châu', '0981938932', 'KTX Khu B, Đông Hòa, Dĩ An, Bình Dương'),
(31, 31, 'Phòng Executive Family', 2000000, 8000000, 403, 'Hoàng Gia Minh', '0363943004', 'thôn 1, xã Ninh Sơn, thị xã Ninh Hòa, Khánh Hòa'),
(32, 32, 'Phòng Senior Suite', 3500000, 17500000, 406, 'Võ Nhất Phương', '0365486141', 'Thị xã Ninh Hòa, Tỉnh Khánh Hòa'),
(33, 33, 'Phòng Penthouse', 4000000, 21000000, NULL, 'Nguyễn Nhật Minh', '0373973754', 'Vinhome grandpark, đường Nguyễn Xiễn, phường Long Thạnh Mỹ, thành phố Thủ Đức'),
(34, 34, 'Phòng Kết Nối', 2400000, 4800000, 210, 'Võ Nhất Phương', '0355428433', 'thôn Lạc Bình, xã Ninh Thọ, thị xã Ninh Hòa, Khánh Hòa'),
(35, 35, 'Phòng Junior Suite', 2900000, 11600000, 110, 'Triệu Viễn Châu', '0981938932', 'KTX Khu B, Đông Hòa, Dĩ An, Bình Dương'),
(36, 36, 'Phòng Cao Cấp Deluxe', 1500000, 7500000, 305, 'Hoàng Gia Minh', '0363943004', 'thôn 1, xã Ninh Sơn, thị xã Ninh Hòa, Khánh Hòa'),
(37, 37, 'Phòng Phổ Thông', 700000, 3500000, 106, 'Võ Nhất Phương', '0365486141', 'Thị xã Ninh Hòa, Tỉnh Khánh Hòa'),
(38, 38, 'Phòng Executive Triple Balcony', 3000000, 12000000, NULL, 'Nguyễn Nhật Minh', '0373973754', 'Vinhome grandpark, đường Nguyễn Xiễn, phường Long Thạnh Mỹ, thành phố Thủ Đức'),
(39, 39, 'Phòng Gia Đình Cao Cấp', 1800000, 9000000, 302, 'Võ Nhất Phương', '0355428433', 'thôn Lạc Bình, xã Ninh Thọ, thị xã Ninh Hòa, Khánh Hòa'),
(40, 40, 'Phòng Cao Cấp', 1000000, 5000000, NULL, 'Triệu Viễn Châu', '0981938932', 'KTX Khu B, Đông Hòa, Dĩ An, Bình Dương'),
(41, 41, 'Phòng Kết Nối', 2400000, 7200000, 208, 'Hoàng Gia Minh', '0363943004', 'thôn 1, xã Ninh Sơn, thị xã Ninh Hòa, Khánh Hòa'),
(42, 42, 'Phòng Executive Family', 2000000, 10000000, 402, 'Võ Nhất Phương', '0365486141', 'Thị xã Ninh Hòa, Tỉnh Khánh Hòa'),
(43, 43, 'Phòng Senior Suite', 3500000, 10500000, 407, 'Nguyễn Nhật Minh', '0373973754', 'Vinhome grandpark, đường Nguyễn Xiễn, phường Long Thạnh Mỹ, thành phố Thủ Đức'),
(44, 44, 'Phòng Junior Suite', 2900000, 5800000, 110, 'Võ Nhất Phương', '0355428433', 'thôn Lạc Bình, xã Ninh Thọ, thị xã Ninh Hòa, Khánh Hòa'),
(45, 45, 'Phòng Penthouse', 4000000, 20000000, 502, 'Triệu Viễn Châu', '0981938932', 'KTX Khu B, Đông Hòa, Dĩ An, Bình Dương'),
(46, 46, 'Phòng Gia Đình Cao Cấp', 1800000, 9000000, 301, 'Hoàng Gia Minh', '0363943004', 'thôn 1, xã Ninh Sơn, thị xã Ninh Hòa, Khánh Hòa'),
(47, 47, 'Phòng Executive Triple Balcony', 3000000, 6000000, NULL, 'Võ Nhất Phương', '0365486141', 'Thị xã Ninh Hòa, Tỉnh Khánh Hòa'),
(48, 48, 'Phòng Cao Cấp Deluxe', 1500000, 4500000, 305, 'Nguyễn Nhật Minh', '0373973754', 'Vinhome grandpark, đường Nguyễn Xiễn, phường Long Thạnh Mỹ, thành phố Thủ Đức'),
(49, 49, 'Phòng Cao Cấp', 1000000, 5000000, 206, 'Võ Nhất Phương', '0355428433', 'thôn Lạc Bình, xã Ninh Thọ, thị xã Ninh Hòa, Khánh Hòa'),
(50, 50, 'Phòng Senior Suite', 3500000, 14000000, 407, 'Triệu Viễn Châu', '0981938932', 'KTX Khu B, Đông Hòa, Dĩ An, Bình Dương'),
(51, 51, 'Phòng Senior Suite', 3500000, 3500000, NULL, 'Võ Nhất Phương', '0365486141', 'Thị xã Ninh Hòa, Tỉnh Khánh Hòa'),
(52, 52, 'Phòng Senior Suite', 3500000, 3500000, NULL, 'Hoàng Gia Minh', '0363943004', 'thôn 1, xã Ninh Sơn, thị xã Ninh Hòa, Khánh Hòa');

-- --------------------------------------------------------

--
-- Table structure for table `booking_order`
--

CREATE TABLE `booking_order` (
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `arrival` int(11) NOT NULL DEFAULT 0,
  `refund` int(11) DEFAULT NULL,
  `booking_status` varchar(100) NOT NULL DEFAULT 'pending',
  `order_id` varchar(150) NOT NULL,
  `trans_amt` int(11) NOT NULL,
  `rate_review` int(11) DEFAULT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking_order`
--

INSERT INTO `booking_order` (`booking_id`, `user_id`, `room_id`, `check_in`, `check_out`, `arrival`, `refund`, `booking_status`, `order_id`, `trans_amt`, `rate_review`, `datetime`) VALUES
(1, 3, 5, '2024-11-10', '2024-11-15', 1, 0, 'booked', 'ORD_257693', 3500000, 1, '2024-11-05 10:30:00'),
(2, 1, 8, '2024-12-20', '2024-12-22', 0, NULL, 'pending', 'ORD_257694', 11600000, NULL, '2024-12-06 14:45:00'),
(3, 4, 3, '2024-10-15', '2024-10-20', 1, 0, 'cancelled', 'ORD_257695', 9000000, 0, '2024-10-10 09:00:00'),
(4, 2, 7, '2024-12-21', '2024-12-23', 0, NULL, 'pending', 'ORD_257696', 4000000, NULL, '2024-12-07 16:20:00'),
(5, 5, 2, '2024-12-29', '2024-12-31', 0, NULL, 'pending', 'ORD_257697', 4800000, NULL, '2024-12-10 11:10:00'),
(6, 3, 6, '2024-12-22', '2024-12-23', 0, NULL, 'pending', 'ORD_257698', 3000000, NULL, '2024-12-11 13:25:00'),
(7, 1, 10, '2025-01-01', '2025-01-03', 0, NULL, 'pending', 'ORD_257699', 7000000, NULL, '2024-11-29 17:30:00'),
(8, 4, 4, '2023-05-15', '2023-05-20', 1, 0, 'booked', 'ORD_257700', 7500000, 1, '2023-05-10 12:00:00'),
(9, 2, 9, '2023-04-25', '2023-04-27', 1, 0, 'booked', 'ORD_257701', 8000000, 1, '2023-04-20 14:50:00'),
(10, 5, 1, '2023-03-05', '2023-03-10', 0, 1, 'cancelled', 'ORD_257702', 5000000, 0, '2023-03-01 09:35:00'),
(11, 3, 8, '2023-02-10', '2023-02-14', 1, 1, 'cancelled', 'ORD_257703', 11600000, 0, '2023-02-05 11:40:00'),
(12, 1, 3, '2023-01-15', '2023-01-20', 1, 0, 'booked', 'ORD_257704', 9000000, 1, '2023-01-10 16:25:00'),
(13, 4, 6, '2022-12-20', '2022-12-23', 0, 1, 'cancelled', 'ORD_257705', 9000000, 0, '2022-12-15 08:15:00'),
(14, 2, 5, '2022-11-10', '2022-11-15', 1, 0, 'booked', 'ORD_257706', 3500000, 1, '2022-11-05 14:00:00'),
(15, 5, 9, '2022-10-05', '2022-10-10', 1, 0, 'booked', 'ORD_257707', 20000000, 1, '2022-10-01 10:10:00'),
(16, 3, 2, '2022-09-15', '2022-09-20', 1, 0, 'booked', 'ORD_257708', 12000000, 1, '2022-09-10 12:30:00'),
(17, 1, 7, '2022-08-20', '2022-08-25', 1, 0, 'booked', 'ORD_257709', 10000000, 1, '2022-08-15 13:45:00'),
(18, 4, 10, '2022-07-10', '2022-07-13', 1, 0, 'booked', 'ORD_257710', 10500000, 1, '2022-07-05 11:50:00'),
(19, 2, 4, '2022-06-15', '2022-06-21', 1, 0, 'booked', 'ORD_257711', 9000000, 1, '2022-06-10 14:05:00'),
(20, 5, 6, '2022-05-01', '2022-05-05', 1, 1, 'cancelled', 'ORD_257712', 12000000, 0, '2022-04-25 09:25:00'),
(21, 3, 1, '2022-04-10', '2022-04-15', 1, 0, 'booked', 'ORD_257713', 5000000, 1, '2022-04-05 17:15:00'),
(22, 1, 9, '2022-03-05', '2022-03-08', 1, 0, 'booked', 'ORD_257714', 12000000, 1, '2022-03-01 14:40:00'),
(23, 4, 8, '2022-02-15', '2022-02-20', 1, 1, 'cancelled', 'ORD_257715', 14500000, 0, '2022-02-10 13:00:00'),
(24, 2, 7, '2022-01-25', '2022-01-31', 1, 0, 'booked', 'ORD_257716', 12000000, 1, '2022-01-20 15:35:00'),
(25, 5, 10, '2021-12-10', '2021-12-15', 1, 0, 'booked', 'ORD_257717', 17500000, 0, '2021-12-05 11:00:00'),
(26, 3, 3, '2021-11-16', '2021-11-20', 0, 1, 'cancelled', 'ORD_257718', 7200000, 0, '2021-11-10 09:20:00'),
(27, 1, 2, '2021-10-01', '2021-10-05', 1, 0, 'booked', 'ORD_257719', 9600000, 1, '2021-09-25 16:45:00'),
(28, 4, 5, '2021-09-10', '2021-09-15', 1, 0, 'booked', 'ORD_257720', 3500000, 1, '2021-09-05 10:30:00'),
(29, 2, 6, '2021-08-06', '2021-08-07', 0, 1, 'cancelled', 'ORD_257721', 3000000, 0, '2021-08-01 12:10:00'),
(30, 5, 4, '2021-07-15', '2021-07-20', 1, 0, 'booked', 'ORD_257722', 7500000, 1, '2021-07-10 15:55:00'),
(31, 3, 7, '2021-06-26', '2021-06-30', 1, 0, 'booked', 'ORD_257723', 8000000, 1, '2021-06-20 09:40:00'),
(32, 1, 10, '2021-05-05', '2021-05-10', 1, 0, 'booked', 'ORD_257724', 17500000, 0, '2021-05-01 14:00:00'),
(33, 4, 9, '2021-04-02', '2021-04-09', 0, 1, 'cancelled', 'ORD_257725', 21000000, 0, '2021-04-05 17:30:00'),
(34, 2, 2, '2021-03-15', '2021-03-17', 1, 0, 'booked', 'ORD_257726', 4800000, 1, '2021-03-10 10:25:00'),
(35, 5, 8, '2021-02-25', '2021-03-01', 1, 0, 'booked', 'ORD_257727', 11600000, 1, '2021-02-20 12:15:00'),
(36, 3, 4, '2021-01-10', '2021-01-15', 1, 0, 'booked', 'ORD_257728', 7500000, 1, '2021-01-05 13:00:00'),
(37, 1, 5, '2020-12-05', '2020-12-10', 1, 0, 'booked', 'ORD_257729', 3500000, 1, '2020-12-01 16:00:00'),
(38, 4, 6, '2020-11-15', '2020-11-19', 0, 1, 'cancelled', 'ORD_257730', 12000000, 0, '2020-11-10 09:40:00'),
(39, 2, 3, '2020-10-20', '2020-10-25', 1, 0, 'booked', 'ORD_257731', 9000000, 1, '2020-10-15 11:30:00'),
(40, 5, 1, '2020-09-05', '2020-09-10', 0, 1, 'cancelled', 'ORD_257732', 5000000, 0, '2020-09-01 13:20:00'),
(41, 3, 2, '2020-08-08', '2020-08-11', 1, 0, 'booked', 'ORD_257733', 7200000, 1, '2020-08-05 15:00:00'),
(42, 1, 7, '2020-07-25', '2020-07-30', 1, 0, 'booked', 'ORD_257734', 10000000, 1, '2020-07-20 14:10:00'),
(43, 4, 10, '2020-06-01', '2020-06-04', 1, 0, 'cancelled', 'ORD_257735', 10500000, 0, '2020-06-01 10:40:00'),
(44, 2, 8, '2020-05-11', '2020-05-13', 1, 0, 'booked', 'ORD_257736', 5800000, 1, '2020-05-10 12:30:00'),
(45, 5, 9, '2020-04-22', '2020-04-27', 1, 0, 'booked', 'ORD_257737', 20000000, 1, '2020-04-05 13:15:00'),
(46, 3, 3, '2020-03-05', '2020-03-10', 1, 0, 'booked', 'ORD_257738', 9000000, 1, '2020-03-01 14:00:00'),
(47, 1, 6, '2020-02-09', '2020-02-11', 0, 1, 'cancelled', 'ORD_257739', 6000000, 0, '2020-02-10 11:50:00'),
(48, 4, 4, '2020-01-12', '2020-01-15', 1, 0, 'booked', 'ORD_257740', 4500000, 1, '2020-01-05 13:25:00'),
(49, 2, 1, '2019-12-25', '2019-12-30', 1, 0, 'booked', 'ORD_257741', 5000000, 1, '2019-12-20 16:40:00'),
(50, 5, 10, '2019-11-18', '2019-11-22', 1, 0, 'booked', 'ORD_257742', 14000000, 1, '2019-11-05 11:30:00'),
(51, 1, 10, '2024-12-12', '2024-12-13', 0, 0, 'booked', 'ORD_257743', 3500000, NULL, '2024-12-11 14:20:33'),
(52, 3, 10, '2024-12-12', '2024-12-13', 0, 0, 'booked', 'ORD_257744', 3500000, NULL, '2024-12-11 14:20:33');

-- --------------------------------------------------------

--
-- Table structure for table `carousel`
--

CREATE TABLE `carousel` (
  `sr_no` int(11) NOT NULL,
  `image` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carousel`
--

INSERT INTO `carousel` (`sr_no`, `image`) VALUES
(20, 'IMG_1029.png'),
(21, 'IMG_7918.png'),
(22, 'IMG_6478.png'),
(23, 'IMG_8954.png'),
(24, 'IMG_6061.png'),
(25, 'IMG_2562.png');

-- --------------------------------------------------------

--
-- Table structure for table `contact_details`
--

CREATE TABLE `contact_details` (
  `sr_no` int(11) NOT NULL,
  `address` varchar(100) NOT NULL,
  `gmap` varchar(100) NOT NULL,
  `pn1` varchar(30) NOT NULL,
  `pn2` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fb` varchar(100) NOT NULL,
  `insta` varchar(100) NOT NULL,
  `tw` varchar(100) NOT NULL,
  `iframe` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_details`
--

INSERT INTO `contact_details` (`sr_no`, `address`, `gmap`, `pn1`, `pn2`, `email`, `fb`, `insta`, `tw`, `iframe`) VALUES
(1, 'Khách sạn Mường Thanh, 261C Đ. Nguyễn Văn Trỗi, Phường 10, Phú Nhuận, TP. Hồ Chí Minh 700000', 'https://maps.app.goo.gl/5krry61WQzK7eX5W9', '0906480043', '0363943004', 'vonhatphuongahihi@gmail.com', 'https://www.facebook.com/phuong.vonhat.tuhy/', 'https://www.instagram.com/tuhy.sapoche.99/', 'https://x.com/home', 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7860643.062727983!2d101.7134817!3d15.8458393!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3175294e1f81bde7:0x2a8eeb556a2cd1c7!2zS2jDoWNoIHPhuqFuIE3GsOG7nW5nIFRoYW5oIEx1eHVyeSBTw6BpIEfDsm4!5e0!3m2!1svi!2s!4v1727456631837!5m2!1svi!2s');

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE `facilities` (
  `id` int(11) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`id`, `icon`, `name`, `description`) VALUES
(13, 'IMG_25498.svg', 'Điện', 'Điện áp 220V'),
(14, 'IMG_65897.svg', 'Điện thoại bàn', 'Điện thoại cố định dùng để kết nối với lễ tân, dịch vụ phòng hoặc gọi ra ngoài'),
(15, 'IMG_73852.svg', 'Ấm đun nước', 'Ấm đun nước siêu tốc'),
(16, 'IMG_95279.svg', 'Két sắt', 'Két sắt dùng để chứa các vật dụng quan trọng'),
(17, 'IMG_34488.svg', 'Tủ lạnh mini', 'Tủ lạnh chứa đồ uống'),
(18, 'IMG_11642.svg', 'Wifi', 'Wifi tốc độ cao, ổn định và miễn phí'),
(19, 'IMG_64850.svg', 'Tivi', 'Tivi màn hình phẳng, tích hợp truyền hình cáp, có kết nối mạng'),
(20, 'IMG_11697.svg', 'Máy lạnh', 'Máy lạnh hiện đại, làm lạnh nhanh, êm ái và cho phép tự điều chỉnh nhiệt độ'),
(21, 'IMG_29264.svg', 'Máy sấy tóc', 'Máy sấy tóc hiệu suất cao'),
(22, 'IMG_75990.svg', 'Giường đơn', 'Giường đủ cho 1 người nằm'),
(23, 'IMG_64814.svg', 'Giường đôi', 'Giường đủ cho 2 người nằm'),
(24, 'IMG_40785.svg', 'Tủ đầu giường', 'Tủ đầu giường đựng các vật dụng nhỏ gọn');

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`id`, `name`) VALUES
(11, 'Phòng ngủ'),
(12, 'Phòng tắm'),
(13, 'Khu vực tiếp khách'),
(14, 'Ban công'),
(15, 'Phòng bếp'),
(16, 'Không gian làm việc');

-- --------------------------------------------------------

--
-- Table structure for table `rating_review`
--

CREATE TABLE `rating_review` (
  `sr_no` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `review` varchar(200) NOT NULL,
  `seen` int(11) NOT NULL DEFAULT 0,
  `datentime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rating_review`
--

INSERT INTO `rating_review` (`sr_no`, `booking_id`, `room_id`, `user_id`, `rating`, `review`, `seen`, `datentime`) VALUES
(1, 1, 5, 3, 5, 'Phòng rất đẹp, sạch sẽ, view thoáng, giá hợp lý, nhân viên thân thiện. Sẽ quay lại lần sau!', 0, '2024-11-16 10:50:05'),
(2, 8, 4, 4, 4, 'Nội thất đẹp, hiện đại, dịch vụ tốt. Tuy nhiên, phòng hơi nhỏ so với mong đợi.', 0, '2023-05-21 23:57:39'),
(3, 9, 9, 2, 5, 'Phòng sạch, tiện nghi cơ bản đủ dùng. Dịch vụ tốt, giá cả hợp lý.', 0, '2023-04-28 08:20:43'),
(4, 12, 3, 1, 4, 'Vị trí thuận tiện, nhân viên thân thiện, nhưng cách âm kém, hơi ồn.', 0, '2023-01-22 09:01:24'),
(5, 14, 5, 2, 3, 'Nội thất cũ, phòng không sạch như kỳ vọng', 0, '2022-11-16 13:15:09'),
(6, 15, 9, 5, 5, 'Vị trí đẹp, phòng rộng rãi, sạch sẽ. Dịch vụ tốt, rất đáng tiền.', 0, '2022-10-12 07:05:55'),
(7, 16, 2, 3, 5, 'Nội thất hiện đại, phòng sạch, nhân viên chu đáo. Sẽ quay lại lần sau!', 0, '2022-09-21 15:45:42'),
(8, 17, 7, 1, 5, 'Phòng rất thoáng, giường êm, view đẹp. Bữa sáng khá đa dạng, rất hài lòng.', 0, '2022-08-26 14:11:22'),
(9, 18, 10, 4, 4, 'Nhân viên nhiệt tình, vị trí gần trung tâm. Tuy nhiên, wifi hơi yếu.', 0, '2022-07-15 08:26:49'),
(10, 19, 4, 2, 5, 'Phòng rộng, sạch, view đẹp, nhân viên thân thiện.', 0, '2022-06-22 17:55:27'),
(11, 21, 1, 3, 5, 'Dịch vụ tốt, nhân viên thân thiện. Phòng đẹp như quảng cáo.', 0, '2022-04-16 19:18:40'),
(12, 22, 9, 1, 5, 'Giá cả hợp lý, chất lượng vượt mong đợi. Rất hài lòng!', 0, '2021-03-09 10:20:05'),
(13, 24, 7, 2, 5, 'Không gian thoải mái, nội thất cao cấp. Rất hài lòng!', 0, '2022-02-02 18:25:16'),
(14, 27, 2, 1, 4, 'Phòng ổn, dịch vụ tốt, giá hợp lý. Nhưng nội thất hơi cũ, cần sửa chữa.', 0, '2021-10-06 22:22:27'),
(15, 28, 5, 4, 5, 'Phòng đẹp, tiện nghi đầy đủ. Dịch vụ xuất sắc, đáng trải nghiệm.', 0, '2021-09-16 12:24:22'),
(16, 30, 4, 5, 5, 'Mọi thứ hoàn hảo từ phòng ốc đến dịch vụ. Rất đáng tiền!', 0, '2021-07-21 11:26:13'),
(17, 31, 7, 3, 5, 'Dịch vụ chuyên nghiệp, không gian sang trọng. Rất đáng để quay lại.', 0, '2021-07-02 19:27:26'),
(18, 34, 2, 2, 5, 'Phòng đẹp, view biển tuyệt vời. Nhân viên chu đáo, nhiệt tình.', 0, '2021-03-18 15:28:28'),
(19, 35, 8, 5, 5, 'Nhân viên dễ thương, phòng sạch đẹp. Chất lượng vượt kỳ vọng.', 0, '2021-03-02 21:29:41'),
(20, 36, 4, 3, 5, 'Khách sạn sang trọng, vị trí trung tâm. Tiện nghi và dịch vụ hoàn hảo.', 0, '2021-01-16 18:30:43'),
(21, 37, 5, 1, 5, 'Phòng sạch, yên tĩnh, giá hợp lý. Tuy nhiên, wifi yếu, không ổn định.', 0, '2020-12-11 18:32:59'),
(22, 39, 3, 2, 5, 'Vị trí đắc địa, phòng rộng rãi. Giá cả rất hợp lý.', 0, '2020-10-26 17:33:56'),
(23, 41, 2, 3, 5, 'Giường êm ái, view đẹp, nội thất tinh tế. Dịch vụ rất tốt!', 1, '2020-08-12 11:36:09'),
(24, 42, 7, 1, 5, 'Nội thất cao cấp, phòng thoáng. Không gian rất thoải mái và thư giãn.', 1, '2020-08-02 11:37:34'),
(25, 44, 8, 2, 5, 'Không gian ấm cúng, dịch vụ tốt. Đáng để trải nghiệm.', 1, '2020-05-15 07:38:50'),
(26, 45, 9, 5, 5, 'Khách sạn mới, nội thất hiện đại. Phòng thoáng và cực kỳ sạch sẽ.', 1, '2020-04-28 19:39:59'),
(27, 46, 3, 3, 4, 'Khách sạn ổn, nhân viên thân thiện. Nhưng phòng hơi cũ, cần nâng cấp.', 1, '2020-03-11 23:41:02'),
(28, 48, 4, 4, 5, 'Khách sạn mới, phòng sạch đẹp. Nhân viên rất nhiệt tình.', 1, '2020-01-16 19:42:56'),
(29, 49, 1, 2, 5, 'Dịch vụ chuyên nghiệp, không gian sang trọng. Rất đáng để quay lại.', 1, '2020-01-01 19:44:17'),
(30, 50, 10, 5, 5, 'Phòng đẹp, dịch vụ tốt, nhân viên chu đáo. Rất hài lòng với kỳ nghỉ.', 1, '2019-11-23 22:45:16');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `area` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `adult` int(11) NOT NULL,
  `children` int(11) NOT NULL,
  `description` varchar(400) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `removed` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `area`, `price`, `quantity`, `adult`, `children`, `description`, `status`, `removed`) VALUES
(1, 'Phòng Cao Cấp', 23, 1000000, 7, 2, 1, 'Nếu bạn muốn có một phòng ngủ ấm cúng, tiện nghi và hợp túi tiền, Phòng Cao cấp là sự lựa chọn dành cho bạn. Phòng có không gian rộng rãi 23 m² và có giường đôi . Phòng còn có tivi LCD, minibar và phòng tắm riêng với đầy đủ tiện nghi.', 1, 0),
(2, 'Phòng Kết Nối', 53, 2400000, 3, 4, 2, 'Phòng Kết Nối là lựa chọn lý tưởng cho gia đình hoặc nhóm bạn khi đến với StayHub. Phòng gồm hai phòng ngủ riêng biệt, mỗi phòng có giường đôi hoặc hai giường đơn, tivi LCD, minibar, két sắt và phòng tắm riêng. Phòng có ban công rộng rãi hướng ra biển, cho bạn cảm giác thư thái và hòa mình vào thiên nhiên.', 1, 0),
(3, 'Phòng Gia Đình Cao Cấp', 32, 1800000, 3, 3, 1, 'Phòng Gia Đình Cao Cấp là lựa chọn hoàn hảo cho gia đình có trẻ nhỏ khi đến với StayHub. Phòng có diện tích 32 m², gồm một giường đôi và một giường đơn. Phòng được thiết kế hiện đại và ấm cúng, có tivi LCD, minibar và phòng tắm riêng với đầy đủ tiện nghi. Phòng có ban công rộng rãi hướng ra biển, cho bạn cảm giác thư thái và hòa mình vào thiên nhiên', 1, 0),
(4, 'Phòng Cao Cấp Deluxe', 25, 1500000, 3, 2, 1, 'Phòng Cao Cấp Deluxe là lựa chọn tuyệt vời cho du khách muốn tận hưởng khung cảnh biển thật trọn vẹn. Phòng có diện tích 25 m², được trang bị đầy đủ tiện nghi như hai giường đơn, tivi LCD, minibar, két sắt và phòng tắm riêng. Phòng có ban công rộng rãi hướng ra biển, cho bạn cảm giác thư thái và hòa mình vào thiên nhiên', 1, 0),
(5, 'Phòng Phổ Thông', 20, 700000, 10, 1, 1, 'Phòng Phổ Thông là lựa chọn thích hợp cho du khách có ngân sách hạn chế. Phòng có diện tích 20 m², được trang bị một số tiện nghi cơ bản như giường đơn, ấm đun nước, tivi LCD và phòng tắm riêng.', 1, 0),
(6, 'Phòng Executive Triple Balcony', 60, 3000000, 2, 4, 2, 'Phòng Executive Triple Balcony là lựa chọn hiện đại và tiện lợi cho du khách. Phòng có diện tích 60 m², được trang bị đầy đủ tiện nghi như  tivi LCD, minibar, két sắt và phòng tắm riêng. Phòng có ban công nhỏ hướng ra thành phố, cho bạn cảm giác sôi động và năng động.', 1, 0),
(7, 'Phòng Executive Family', 42, 2000000, 4, 2, 1, 'Phòng Executive Family là lựa chọn thích hợp cho các gia đình khi du lịch. Phòng có diện tích 42 m², được trang bị đầy đủ tiện nghi như giường đôi, tivi LCD, minibar và phòng tắm riêng. Phòng có ban công nhỏ hướng ra thành phố, cho bạn cảm giác sôi động và năng động.', 1, 0),
(8, 'Phòng Junior Suite', 60, 2900000, 2, 2, 1, 'Phòng Junior Suite là lựa chọn sang trọng và đẳng cấp cho du khách muốn tận hưởng khung cảnh biển tuyệt đẹp. Phòng có diện tích 60 m², gồm một phòng ngủ rộng rãi với giường đôi, phòng khách và phòng tắm riêng. Phòng được trang bị đầy đủ tiện nghi như tivi LCD, minibar và két sắt. Phòng có ban công rộng rãi cho bạn cảm giác thư thái và hòa mình vào thiên nhiên', 1, 0),
(9, 'Phòng Penthouse', 80, 4000000, 3, 3, 1, 'Phòng Penthouse là lựa chọn cao cấp và độc đáo cho du khách muốn tận hưởng sự sang trọng và khung cảnh biển tuyệt đẹp. Phòng có diện tích 80 m², gồm hai phòng ngủ riêng biệt, mỗi phòng có giường đôi, tivi LCD, minibar, két sắt và phòng tắm riêng. Phòng còn có phòng khách rộng rãi, một căn bếp nhỏ và ban công rộng rãi hướng ra biển', 1, 0),
(10, 'Phòng Senior Suite', 75, 3500000, 2, 3, 2, 'Phòng Senior Suite là lựa chọn sang trọng và đẳng cấp cho du khách muốn tận hưởng khung cảnh biển tuyệt đẹp. Phòng có diện tích 75 m², gồm hai phòng ngủ với giường đôi và giường đơn, phòng khách và phòng tắm riêng. Phòng được trang bị đầy đủ tiện nghi như tivi LCD, minibar và két sắt. Phòng có ban công rộng rãi cho bạn cảm giác thư thái và hòa mình vào thiên nhiên', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `room_facilities`
--

CREATE TABLE `room_facilities` (
  `sr_no` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `facilities_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_facilities`
--

INSERT INTO `room_facilities` (`sr_no`, `room_id`, `facilities_id`) VALUES
(11, 2, 13),
(12, 2, 14),
(13, 2, 15),
(14, 2, 16),
(15, 2, 17),
(16, 2, 18),
(17, 2, 19),
(18, 2, 20),
(19, 2, 21),
(20, 2, 22),
(21, 2, 23),
(22, 2, 24),
(23, 3, 13),
(24, 3, 14),
(25, 3, 15),
(26, 3, 16),
(27, 3, 18),
(28, 3, 19),
(29, 3, 20),
(30, 3, 22),
(31, 3, 23),
(32, 4, 13),
(33, 4, 14),
(34, 4, 15),
(35, 4, 16),
(36, 4, 17),
(37, 4, 18),
(38, 4, 19),
(39, 4, 20),
(40, 4, 22),
(41, 4, 24),
(42, 5, 13),
(43, 5, 14),
(44, 5, 15),
(45, 5, 19),
(46, 5, 20),
(47, 5, 22),
(48, 6, 13),
(49, 6, 14),
(50, 6, 15),
(51, 6, 16),
(52, 6, 17),
(53, 6, 18),
(54, 6, 19),
(55, 6, 20),
(56, 6, 21),
(57, 6, 22),
(58, 6, 24),
(59, 7, 13),
(60, 7, 14),
(61, 7, 15),
(62, 7, 16),
(63, 7, 18),
(64, 7, 19),
(65, 7, 20),
(66, 7, 22),
(67, 7, 23),
(68, 8, 13),
(69, 8, 14),
(70, 8, 15),
(71, 8, 16),
(72, 8, 17),
(73, 8, 18),
(74, 8, 19),
(75, 8, 20),
(76, 8, 21),
(77, 8, 23),
(78, 8, 24),
(79, 9, 13),
(80, 9, 14),
(81, 9, 15),
(82, 9, 16),
(83, 9, 17),
(84, 9, 18),
(85, 9, 19),
(86, 9, 20),
(87, 9, 21),
(88, 9, 23),
(89, 9, 24),
(90, 10, 13),
(91, 10, 14),
(92, 10, 15),
(93, 10, 16),
(94, 10, 17),
(95, 10, 18),
(96, 10, 19),
(97, 10, 20),
(98, 10, 21),
(99, 10, 22),
(100, 10, 23),
(101, 10, 24),
(113, 1, 13),
(114, 1, 14),
(115, 1, 15),
(116, 1, 17),
(117, 1, 18),
(118, 1, 19),
(119, 1, 20),
(120, 1, 21),
(121, 1, 23),
(122, 1, 24);

-- --------------------------------------------------------

--
-- Table structure for table `room_features`
--

CREATE TABLE `room_features` (
  `sr_no` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `features_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_features`
--

INSERT INTO `room_features` (`sr_no`, `room_id`, `features_id`) VALUES
(4, 2, 11),
(5, 2, 12),
(6, 2, 14),
(7, 2, 15),
(8, 3, 11),
(9, 3, 12),
(10, 3, 14),
(11, 4, 11),
(12, 4, 12),
(13, 4, 14),
(14, 5, 11),
(15, 5, 12),
(16, 6, 11),
(17, 6, 12),
(18, 6, 14),
(19, 7, 11),
(20, 7, 12),
(21, 7, 14),
(22, 8, 11),
(23, 8, 12),
(24, 8, 13),
(25, 8, 14),
(26, 9, 11),
(27, 9, 12),
(28, 9, 13),
(29, 9, 14),
(30, 9, 15),
(31, 9, 16),
(32, 10, 11),
(33, 10, 12),
(34, 10, 13),
(35, 10, 14),
(40, 1, 11),
(41, 1, 12),
(42, 1, 14);

-- --------------------------------------------------------

--
-- Table structure for table `room_images`
--

CREATE TABLE `room_images` (
  `sr_no` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `image` varchar(150) NOT NULL,
  `thumb` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_images`
--

INSERT INTO `room_images` (`sr_no`, `room_id`, `image`, `thumb`) VALUES
(24, 1, 'IMG_1528.jpg', 1),
(30, 1, 'IMG_8258.jpg', 0),
(31, 1, 'IMG_5994.jpg', 0),
(32, 2, 'IMG_5423.jpg', 1),
(33, 2, 'IMG_8740.jpg', 0),
(34, 2, 'IMG_1413.jpg', 0),
(35, 3, 'IMG_9998.jpg', 1),
(36, 3, 'IMG_1147.jpg', 0),
(37, 4, 'IMG_1875.jpg', 1),
(38, 4, 'IMG_6385.jpg', 0),
(39, 4, 'IMG_4746.jpg', 0),
(40, 5, 'IMG_8136.jpg', 0),
(41, 5, 'IMG_1436.jpg', 1),
(42, 5, 'IMG_1554.jpg', 0),
(43, 6, 'IMG_2418.jpg', 1),
(44, 6, 'IMG_2023.jpg', 0),
(45, 6, 'IMG_9170.jpg', 0),
(46, 7, 'IMG_7299.jpg', 1),
(47, 7, 'IMG_6171.jpg', 0),
(48, 7, 'IMG_4341.jpg', 0),
(49, 8, 'IMG_2383.jpg', 1),
(50, 8, 'IMG_3713.jpg', 0),
(51, 8, 'IMG_3137.jpg', 0),
(52, 9, 'IMG_8029.jpg', 1),
(53, 9, 'IMG_2662.jpg', 0),
(54, 9, 'IMG_6742.jpg', 0),
(55, 10, 'IMG_1508.jpg', 1),
(56, 10, 'IMG_8528.jpg', 0),
(57, 10, 'IMG_6861.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `sr_no` int(11) NOT NULL,
  `site_title` varchar(50) NOT NULL,
  `site_about` varchar(500) NOT NULL,
  `shutdown` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`sr_no`, `site_title`, `site_about`, `shutdown`) VALUES
(1, 'StayHub', 'StayHub là nền tảng đặt phòng khách sạn trực tuyến, giúp bạn tìm kiếm và đặt chỗ ở lý tưởng cho mọi chuyến đi. Với giao diện thân thiện, bộ lọc thông minh và hàng ngàn lựa chọn từ các khách sạn uy tín, StayHub cam kết mang đến trải nghiệm đặt phòng nhanh chóng, minh bạch và giá cả cạnh tranh. Khám phá các ưu đãi đặc biệt, đọc đánh giá thực tế từ khách hàng và tận hưởng dịch vụ hỗ trợ 24/7 để chuyến đi của bạn thêm trọn vẹn.', 0);

-- --------------------------------------------------------

--
-- Table structure for table `team_details`
--

CREATE TABLE `team_details` (
  `sr_no` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `picture` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `team_details`
--

INSERT INTO `team_details` (`sr_no`, `name`, `picture`) VALUES
(1, 'Võ Nhất Phương', 'IMG_9933.jpg'),
(2, 'Hoàng Gia Minh', 'IMG_5569.jpg'),
(3, 'Trần Hữu Hoàng Minh', 'IMG_8846.jpg'),
(4, 'Nguyễn Nhật Minh', 'IMG_3226.png');

-- --------------------------------------------------------

--
-- Table structure for table `user_cred`
--

CREATE TABLE `user_cred` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `address` varchar(250) NOT NULL,
  `phonenum` varchar(11) NOT NULL,
  `pincode` int(11) NOT NULL,
  `dob` date NOT NULL,
  `profile` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `is_verified` int(11) NOT NULL DEFAULT 0,
  `token` varchar(100) DEFAULT NULL,
  `t_expire` date DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `datentime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_cred`
--

INSERT INTO `user_cred` (`id`, `name`, `email`, `address`, `phonenum`, `pincode`, `dob`, `profile`, `password`, `is_verified`, `token`, `t_expire`, `status`, `datentime`) VALUES
(1, 'Võ Nhất Phương', 'vonhatphuongahihi@gmail.com', 'Thị xã Ninh Hòa, Tỉnh Khánh Hòa', '0365486141', 777777, '2004-03-13', 'IMG_49300.jpeg', '$2y$10$GevVdFst7FvR09FiAXorI.c6ybYVhhAXe6iYJUbeZoffqNtPySWyq', 1, '27ece964f3eb5ffa1c440c922d7ba6ee', '2024-11-25', 1, '2024-11-01 16:28:47'),
(2, 'Võ Nhất Phương', '22521172@gm.uit.edu.vn', 'thôn Lạc Bình, xã Ninh Thọ, thị xã Ninh Hòa, Khánh Hòa', '0355428433', 777777, '2004-03-13', 'IMG_95082.jpeg', '$2y$10$YFza5GfbEQiy1rHLr87PY.m9H9X6YUunC8Jj0Lwu3D4oqcPirj7Ai', 1, '51b650c1b4e686cf33ed278ad50363c9', NULL, 1, '2024-12-05 15:39:54'),
(3, 'Hoàng Gia Minh', 'hoanggiaminh27012004@gmail.com', 'thôn 1, xã Ninh Sơn, thị xã Ninh Hòa, Khánh Hòa', '0363943004', 777777, '2004-01-27', 'IMG_42013.jpeg', '$2y$10$2r2pPrX6aBFDiFFoF70r5eCvHrIkR7FjEPU6FhrQKf5CL.bPDrTRG', 1, '7fbbbdb53543327f309b1094e2efba06', NULL, 1, '2024-12-05 16:01:38'),
(4, 'Nguyễn Nhật Minh', '22520876@gm.uit.edu.vn', 'Vinhome grandpark, đường Nguyễn Xiễn, phường Long Thạnh Mỹ, thành phố Thủ Đức', '0373973754', 700000, '2004-01-10', 'IMG_26152.jpeg', '$2y$10$jCW.oGgL.hLD307FIY.8uO5t7tg1OF5yZpigffurJaajXHrqiA96m', 1, 'd839a4357ebbf71d067226d14ca63285', NULL, 1, '2024-12-05 16:13:21'),
(5, 'Triệu Viễn Châu', 'vonhatphuongcolen@gmail.com', 'KTX Khu B, Đông Hòa, Dĩ An, Bình Dương', '0981938932', 75000, '2004-10-10', 'IMG_77963.jpeg', '$2y$10$w/6UbPstDbcyaPt5pJbXguDirUJOnvjgNVRYc33wj5k9TsXxchDNi', 1, 'c2448b1c239b14a02d98a847326b5662', NULL, 1, '2024-12-05 16:17:29');

-- --------------------------------------------------------

--
-- Table structure for table `user_queries`
--

CREATE TABLE `user_queries` (
  `sr_no` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `message` varchar(500) NOT NULL,
  `datentime` datetime NOT NULL DEFAULT current_timestamp(),
  `seen` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_queries`
--

INSERT INTO `user_queries` (`sr_no`, `name`, `email`, `subject`, `message`, `datentime`, `seen`) VALUES
(12, 'Hoàng Gia Minh', 'hoanggiaminh27012004@gmail.com', 'Đặt phòng', 'Nếu tôi đặt phòng thành công nhưng sau đó muốn đổi lại phòng khác thì có được không ? Và nếu được thì thực hiện như thế nào', '2024-12-05 16:40:56', 0),
(13, 'Võ Nhất Phương', 'vonhatphuongahihi@gmail.com', 'Tài khoản người dùng', 'Tôi có thể xóa tài khoản không?', '2024-12-05 16:44:36', 0),
(14, 'Nguyễn Nhật Minh', '22520876@gm.uit.edu.vn', 'Đặt phòng khách sạn', 'Tôi có thể thanh toán bằng các phương thức nào?', '2024-12-05 16:46:07', 0),
(15, 'Võ Nhất Phương', '22521172@gm.uit.edu.vn', 'Dịch vụ hỗ trợ', 'Tôi có thể liên hệ với bộ phận hỗ trợ bằng cách nào?', '2024-12-05 16:48:02', 0),
(16, 'Triệu Viễn Châu', 'vonhatphuongcolen@gmail.com', 'Vấn đề kỹ thuật', 'Tại sao tôi không thể thanh toán?', '2024-12-05 16:49:43', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `booking_details`
--
ALTER TABLE `booking_details`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `booking_id` (`booking_id`);

--
-- Indexes for table `booking_order`
--
ALTER TABLE `booking_order`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `carousel`
--
ALTER TABLE `carousel`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `contact_details`
--
ALTER TABLE `contact_details`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rating_review`
--
ALTER TABLE `rating_review`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `booking_id` (`booking_id`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_facilities`
--
ALTER TABLE `room_facilities`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `facilities id` (`facilities_id`),
  ADD KEY `room id` (`room_id`);

--
-- Indexes for table `room_features`
--
ALTER TABLE `room_features`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `features id` (`features_id`),
  ADD KEY `rm id` (`room_id`);

--
-- Indexes for table `room_images`
--
ALTER TABLE `room_images`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `team_details`
--
ALTER TABLE `team_details`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `user_cred`
--
ALTER TABLE `user_cred`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_queries`
--
ALTER TABLE `user_queries`
  ADD PRIMARY KEY (`sr_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking_details`
--
ALTER TABLE `booking_details`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `booking_order`
--
ALTER TABLE `booking_order`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `carousel`
--
ALTER TABLE `carousel`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `contact_details`
--
ALTER TABLE `contact_details`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `rating_review`
--
ALTER TABLE `rating_review`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `room_facilities`
--
ALTER TABLE `room_facilities`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `room_features`
--
ALTER TABLE `room_features`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `room_images`
--
ALTER TABLE `room_images`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `team_details`
--
ALTER TABLE `team_details`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user_cred`
--
ALTER TABLE `user_cred`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `user_queries`
--
ALTER TABLE `user_queries`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking_details`
--
ALTER TABLE `booking_details`
  ADD CONSTRAINT `booking_details_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `booking_order` (`booking_id`);

--
-- Constraints for table `booking_order`
--
ALTER TABLE `booking_order`
  ADD CONSTRAINT `booking_order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_cred` (`id`),
  ADD CONSTRAINT `booking_order_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);

--
-- Constraints for table `rating_review`
--
ALTER TABLE `rating_review`
  ADD CONSTRAINT `rating_review_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `booking_order` (`booking_id`),
  ADD CONSTRAINT `rating_review_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`),
  ADD CONSTRAINT `rating_review_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user_cred` (`id`);

--
-- Constraints for table `room_facilities`
--
ALTER TABLE `room_facilities`
  ADD CONSTRAINT `facilities id` FOREIGN KEY (`facilities_id`) REFERENCES `facilities` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `room id` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `room_features`
--
ALTER TABLE `room_features`
  ADD CONSTRAINT `features id` FOREIGN KEY (`features_id`) REFERENCES `features` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `rm id` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `room_images`
--
ALTER TABLE `room_images`
  ADD CONSTRAINT `room_images_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
