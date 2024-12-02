-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 02, 2024 at 03:23 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pasta_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_account`
--

CREATE TABLE `tbl_account` (
  `account_id` int(11) NOT NULL,
  `ac_username` varchar(255) NOT NULL,
  `ac_email` varchar(255) NOT NULL,
  `ac_password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `account_status_id` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_account`
--

INSERT INTO `tbl_account` (`account_id`, `ac_username`, `ac_email`, `ac_password`, `role_id`, `account_status_id`) VALUES
(1, 'jcdavid', 'jcdavid@gmail.com', '$2y$10$y6w0SL2woRHiuQ4rniKMrewKIcajYOQXtUV1XqeizStrKmN5Pq27q', 1, 1),
(2, 'golden', 'golden@gmail.com', '$2y$10$92lKJT/9e9JSzuGmEZ1N8.cPldvOQexUuU2k97F5GykS0rP4l5tqq', 1, 1),
(3, 'john erick', 'johnerick@gmail.com', '$2y$10$OZIIZnjXfRrVNX5G389R3.emX0dGaTb35PIQAbOqKhEB6qYWnoAuC', 2, 1),
(4, 'lugo', 'lugo@gmail.com', '$2y$10$m5gg4RhBizZnqOJXR6IFIemRMw/0bex4eY4mxCNpgys2aQDRr.auq', 2, 1),
(6, 'admin', 'sarah@gmail.com', '$2y$10$t3.cWIceqWE/cDo9lNYXAuK2fSFiRplX6QHlbuTR8TlGJU1cRtkA6', 2, 1),
(7, 'jose', 'cashier@gmail.com', '$2y$10$oxj3kjSVZEBHBEFS5EkT8OgwTkRezxKytLTgdov6Vs8qhCmOPPe9K', 2, 1),
(8, 'jhyra', 'cashier2@gmail.com', '$2y$10$kxW2vsZVDHzuZg.oHujg7OQUWUrr77JZ9tDMhY1GYojPNliEi3cnC', 2, 1),
(9, 'lugs', 'lugs@gmail.com', '$2y$10$Sgyb8CATbHXkScwxoZmHtOMypd5SCn/fB1jgZ/elykNOe02fN/X0m', 1, 1),
(10, 'user', 'jc.david@gmail.com', '$2y$10$eKvm9s4xRRAbAG4y56SMSu7azbQi9.Qk5gNnFpIBA5QlTF1qof1vO', 1, 1),
(12, 'lugolulu', 'lugo1@gmail.com', '$2y$10$Pt1K6WUN3iQGlXB7uRqU1Ox6FR.MUc4PKYH6HtPCr4ZRzfNJ1hA4e', 1, 1),
(13, 'admin2', 'admin2@gmail.com', '$2y$10$qL6T6wxFLrgDbjE5nOwAfOpM63z6aDGHjzRS9cau.e1quB/VKswUC', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_account_details`
--

CREATE TABLE `tbl_account_details` (
  `account_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_account_details`
--

INSERT INTO `tbl_account_details` (`account_id`, `first_name`, `middle_name`, `last_name`, `contact`, `gender`, `address`) VALUES
(1, 'Jc', 'Domingo', 'David', '09565535401', 'Male', 'Montecillo subd'),
(2, 'Golden', '', 'Miral', '09565535401', 'Male', 'Bayan Glori'),
(3, 'John Erick', '', 'Llanita', '09565535401', 'Male', 'Quezon City'),
(4, 'Christian', '', 'Lugo', '09512847442', 'Male', 'Bayan Glori'),
(6, 'Sarah', '', 'Campos', '09565535401', 'Male', 'Caloocan'),
(7, 'Joses Marie', '', 'Octavio', '09565535401', 'Male', 'Fairview'),
(8, 'jhy', '', 'mariano', '09512847442', 'Female', 'Bayan Glori'),
(9, 'Christian', '', 'Lugo', '09565535401', 'Male', 'Bayan Glori'),
(10, 'Juan Carlo', 'Domingo', 'David', '09565535401', 'Male', 'Montecillo subd'),
(12, 'Christian', '', 'Lugo', '09565535401', 'on', 'Montecillo subd'),
(13, 'Josh', '', 'Ivan', '09565535401', 'Male', 'Bayan');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_account_status`
--

CREATE TABLE `tbl_account_status` (
  `account_status_id` int(11) NOT NULL,
  `account_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_account_status`
--

INSERT INTO `tbl_account_status` (`account_status_id`, `account_status`) VALUES
(1, 'Active'),
(2, 'Deactivated');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_audit_log`
--

CREATE TABLE `tbl_audit_log` (
  `log_user_id` int(11) DEFAULT NULL,
  `log_username` varchar(50) DEFAULT NULL,
  `log_user_type` varchar(50) DEFAULT NULL,
  `log_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_audit_log`
--

INSERT INTO `tbl_audit_log` (`log_user_id`, `log_username`, `log_user_type`, `log_date`) VALUES
(6, 'admin', '2', '2024-12-01 07:41:48'),
(1, 'jcdavid', '1', '2024-12-01 09:00:19'),
(1, 'jcdavid', '1', '2024-12-01 09:04:50'),
(1, 'jcdavid', '1', '2024-12-01 12:51:14'),
(6, 'admin', '2', '2024-12-01 12:58:11'),
(6, 'admin', '2', '2024-12-01 13:29:45'),
(1, 'jcdavid', '1', '2024-12-01 13:29:54'),
(6, 'admin', '2', '2024-12-02 13:10:11'),
(1, 'jcdavid', '1', '2024-12-02 13:55:26');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_audit_trail`
--

CREATE TABLE `tbl_audit_trail` (
  `trail_user_id` int(11) DEFAULT NULL,
  `trail_username` varchar(50) DEFAULT NULL,
  `trail_activity` varchar(50) DEFAULT NULL,
  `trail_user_type` varchar(50) DEFAULT NULL,
  `trail_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_audit_trail`
--

INSERT INTO `tbl_audit_trail` (`trail_user_id`, `trail_username`, `trail_activity`, `trail_user_type`, `trail_date`) VALUES
(6, 'admin', 'Updated Driver Details for Item ID: 28', 'Admin', '2024-12-01 13:11:17'),
(6, 'admin', 'Updated Driver Details for Item ID: 28', 'Admin', '2024-12-01 13:11:47'),
(6, 'admin', 'Updated Driver Details for Item ID: 28', 'Admin', '2024-12-01 13:13:18'),
(6, 'admin', 'Updated Driver Details for Item ID: 28', 'Admin', '2024-12-01 13:20:41'),
(6, 'admin', 'Updated Driver Details for Item ID: 28', 'Admin', '2024-12-01 13:29:35'),
(6, 'admin', 'Updated Driver Details for Item ID: 27', 'Admin', '2024-12-02 13:35:51'),
(6, 'admin', 'Updated Driver Details for Item ID: 28', 'Admin', '2024-12-02 13:35:59'),
(6, 'admin', 'Updated Driver Details for Item ID: 27', 'Admin', '2024-12-02 13:37:29'),
(6, 'admin', 'Updated Driver Details for Item ID: 28', 'Admin', '2024-12-02 13:37:35'),
(6, 'admin', 'Updated Driver Details for Item ID: 27', 'Admin', '2024-12-02 13:42:38'),
(6, 'admin', 'Updated Driver Details for Item ID: 28', 'Admin', '2024-12-02 13:42:45'),
(6, 'admin', 'Updated Driver Details for Item ID: 27', 'Admin', '2024-12-02 13:44:44'),
(6, 'admin', 'Updated Driver Details for Item ID: 28', 'Admin', '2024-12-02 13:44:51'),
(6, 'admin', 'Updated Product ID: 1', 'Admin', '2024-12-02 13:53:36'),
(6, 'admin', 'Updated Product ID: 1', 'Admin', '2024-12-02 13:55:10');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `item_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `prod_qnty` int(11) NOT NULL,
  `prod_size` varchar(50) NOT NULL,
  `order_date` date DEFAULT NULL,
  `claim_date` date DEFAULT NULL,
  `status_id` int(11) NOT NULL DEFAULT 1,
  `order_remarks` varchar(255) DEFAULT 'No remarks',
  `cancel_remarks` varchar(255) DEFAULT 'No remarks',
  `account_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`item_id`, `prod_id`, `prod_qnty`, `prod_size`, `order_date`, `claim_date`, `status_id`, `order_remarks`, `cancel_remarks`, `account_id`) VALUES
(27, 1, 1, 'large', '2024-12-02', '2024-12-16', 2, 'No remarks', 'No remarks', 1),
(28, 5, 2, 'large', '2024-12-02', '2024-12-16', 2, 'No order remarks', 'No remarks', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_delivered_orders`
--

CREATE TABLE `tbl_delivered_orders` (
  `item_id` int(11) NOT NULL,
  `prod_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_delivered_orders`
--

INSERT INTO `tbl_delivered_orders` (`item_id`, `prod_price`) VALUES
(28, 800),
(27, 800);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item_feedback`
--

CREATE TABLE `tbl_item_feedback` (
  `fd_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `fd_comment` varchar(255) NOT NULL,
  `fd_date` date NOT NULL,
  `account_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_type`
--

CREATE TABLE `tbl_order_type` (
  `order_type_id` int(11) NOT NULL,
  `order_type_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_order_type`
--

INSERT INTO `tbl_order_type` (`order_type_id`, `order_type_name`) VALUES
(1, 'Deliver'),
(2, 'Reserve');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_products`
--

CREATE TABLE `tbl_products` (
  `prod_id` int(11) NOT NULL,
  `prod_name` varchar(255) NOT NULL,
  `prod_price_small` int(11) NOT NULL,
  `prod_price_medium` int(11) NOT NULL,
  `prod_price_large` int(11) NOT NULL,
  `prod_description` varchar(255) NOT NULL DEFAULT 'No description yet',
  `prod_type` int(11) NOT NULL,
  `prod_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_products`
--

INSERT INTO `tbl_products` (`prod_id`, `prod_name`, `prod_price_small`, `prod_price_medium`, `prod_price_large`, `prod_description`, `prod_type`, `prod_img`) VALUES
(1, 'Product - 1', 500, 700, 800, 'No description yet', 1, 'palabok.png'),
(2, 'item-2', 500, 700, 800, 'No description yet', 1, 'bihon.png'),
(3, 'item-3', 500, 700, 800, 'No description yet', 1, 'pancit-2.png'),
(4, 'item-4', 500, 700, 800, 'No Description Yet', 1, 'pancit-3.png'),
(5, 'Spaghetti', 500, 700, 800, 'No description yet', 2, 'prod-1.jpg'),
(6, 'Maha-biko', 500, 700, 800, 'No description yet', 3, 'maha-biko.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_type`
--

CREATE TABLE `tbl_product_type` (
  `prod_type_id` int(11) NOT NULL,
  `prod_type_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_product_type`
--

INSERT INTO `tbl_product_type` (`prod_type_id`, `prod_type_name`) VALUES
(1, 'Pancit'),
(2, 'Pasta'),
(3, 'Desert');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_receipt`
--

CREATE TABLE `tbl_receipt` (
  `receipt_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `receipt_img` varchar(255) NOT NULL,
  `receipt_number` varchar(50) NOT NULL,
  `deposit_amount` int(11) NOT NULL,
  `uploaded_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_receipt`
--

INSERT INTO `tbl_receipt` (`receipt_id`, `account_id`, `receipt_img`, `receipt_number`, `deposit_amount`, `uploaded_date`) VALUES
(35, 1, '674c11548549b.jpeg', '3212313131313', 800, '2024-12-01'),
(36, 1, '674c11de415cb.jpeg', '3212313131313', 1600, '2024-12-01');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reports`
--

CREATE TABLE `tbl_reports` (
  `report_id` int(11) NOT NULL,
  `rp_name` varchar(50) NOT NULL,
  `rp_email` varchar(150) NOT NULL,
  `rp_message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_reports`
--

INSERT INTO `tbl_reports` (`report_id`, `rp_name`, `rp_email`, `rp_message`) VALUES
(1, 'Jc David', 'jcdavid123c@gmail.com', 'magandaaa'),
(2, 'Jc David', 'jcdavid123c@gmail.com', 'bulok');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rider_details`
--

CREATE TABLE `tbl_rider_details` (
  `rider_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `rider_name` varchar(255) DEFAULT 'No rider name yet',
  `rider_contact` varchar(50) DEFAULT 'No contact yet',
  `rider_remarks` varchar(255) DEFAULT 'No remarks'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_rider_details`
--

INSERT INTO `tbl_rider_details` (`rider_id`, `item_id`, `rider_name`, `rider_contact`, `rider_remarks`) VALUES
(16, 27, 'JuanDavid', '09565535401', 'None'),
(17, 28, 'JuanDavid', '09565535401', 'None');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_role`
--

CREATE TABLE `tbl_role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_role`
--

INSERT INTO `tbl_role` (`role_id`, `role_name`) VALUES
(1, 'user'),
(2, 'admin'),
(3, 'cashier');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_status`
--

CREATE TABLE `tbl_status` (
  `status_id` int(11) NOT NULL,
  `status_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_status`
--

INSERT INTO `tbl_status` (`status_id`, `status_name`) VALUES
(1, 'PENDING'),
(2, 'DELIVERED'),
(3, 'PROCESS'),
(4, 'OUT FOR DELIVERY'),
(5, 'CANCELED'),
(6, 'RESERVE');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transactions`
--

CREATE TABLE `tbl_transactions` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_type` varchar(50) NOT NULL,
  `user_activity` varchar(100) NOT NULL,
  `activity_date` date NOT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_transactions`
--

INSERT INTO `tbl_transactions` (`user_id`, `user_name`, `user_type`, `user_activity`, `activity_date`, `item_id`) VALUES
(6, 'admin', '2', 'Claimed item ', '2024-12-01', 28),
(6, 'admin', '2', 'Claimed item ', '2024-12-02', 28),
(6, 'admin', '2', 'Claimed item ', '2024-12-02', 27);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_account`
--
ALTER TABLE `tbl_account`
  ADD PRIMARY KEY (`account_id`);

--
-- Indexes for table `tbl_account_status`
--
ALTER TABLE `tbl_account_status`
  ADD PRIMARY KEY (`account_status_id`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `tbl_item_feedback`
--
ALTER TABLE `tbl_item_feedback`
  ADD PRIMARY KEY (`fd_id`);

--
-- Indexes for table `tbl_order_type`
--
ALTER TABLE `tbl_order_type`
  ADD PRIMARY KEY (`order_type_id`);

--
-- Indexes for table `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD PRIMARY KEY (`prod_id`);

--
-- Indexes for table `tbl_product_type`
--
ALTER TABLE `tbl_product_type`
  ADD PRIMARY KEY (`prod_type_id`);

--
-- Indexes for table `tbl_receipt`
--
ALTER TABLE `tbl_receipt`
  ADD PRIMARY KEY (`receipt_id`);

--
-- Indexes for table `tbl_reports`
--
ALTER TABLE `tbl_reports`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `tbl_rider_details`
--
ALTER TABLE `tbl_rider_details`
  ADD PRIMARY KEY (`rider_id`);

--
-- Indexes for table `tbl_role`
--
ALTER TABLE `tbl_role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `tbl_status`
--
ALTER TABLE `tbl_status`
  ADD PRIMARY KEY (`status_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_account`
--
ALTER TABLE `tbl_account`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_account_status`
--
ALTER TABLE `tbl_account_status`
  MODIFY `account_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tbl_item_feedback`
--
ALTER TABLE `tbl_item_feedback`
  MODIFY `fd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_order_type`
--
ALTER TABLE `tbl_order_type`
  MODIFY `order_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_products`
--
ALTER TABLE `tbl_products`
  MODIFY `prod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_product_type`
--
ALTER TABLE `tbl_product_type`
  MODIFY `prod_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_receipt`
--
ALTER TABLE `tbl_receipt`
  MODIFY `receipt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tbl_reports`
--
ALTER TABLE `tbl_reports`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_rider_details`
--
ALTER TABLE `tbl_rider_details`
  MODIFY `rider_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_role`
--
ALTER TABLE `tbl_role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_status`
--
ALTER TABLE `tbl_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
