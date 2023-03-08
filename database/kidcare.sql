-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2023 at 11:40 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kidcare`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `birthday` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `admin_img` varchar(250) NOT NULL DEFAULT 'default.png',
  `address` varchar(250) NOT NULL,
  `city` varchar(250) NOT NULL,
  `zip` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`, `firstname`, `lastname`, `gender`, `birthday`, `email`, `contact`, `admin_img`, `address`, `city`, `zip`) VALUES
(1, 'mahfuza', '123456', 'Mahfuza', 'Lima', 'Female', '1998-08-01', 'mahfuza123@gmail.com', '+880121212121', 'admin.jpg', 'Mohammadpur', 'Dhaka', '1207');

-- --------------------------------------------------------

--
-- Table structure for table `baby`
--

CREATE TABLE `baby` (
  `baby_id` int(11) NOT NULL,
  `baby_name` varchar(250) NOT NULL,
  `baby_img` varchar(250) NOT NULL DEFAULT 'default.png',
  `age` int(11) NOT NULL,
  `about` varchar(250) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `baby`
--

INSERT INTO `baby` (`baby_id`, `baby_name`, `baby_img`, `age`, `about`, `user_id`) VALUES
(4, 'Rohan', 'baby1.jpg', 8, 'very well behaved boy.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `babysitter`
--

CREATE TABLE `babysitter` (
  `sitter_id` int(11) NOT NULL,
  `sitter_image` varchar(250) NOT NULL DEFAULT 'default.png',
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `nid_image` varchar(250) NOT NULL,
  `birthday` varchar(250) NOT NULL,
  `experience` varchar(50) NOT NULL,
  `about_me` varchar(500) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL,
  `zip` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `join_date` varchar(50) NOT NULL,
  `verification_status` int(11) NOT NULL DEFAULT 0,
  `rate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `babysitter`
--

INSERT INTO `babysitter` (`sitter_id`, `sitter_image`, `firstname`, `lastname`, `nid_image`, `birthday`, `experience`, `about_me`, `gender`, `contact`, `address`, `city`, `zip`, `username`, `email`, `password`, `join_date`, `verification_status`, `rate`) VALUES
(1, 'admin.jpg', 'Sadia', 'Afrin', 'id.jpg', '2006-09-11', '2 Years', 'I love to take care of babies', 'Female', '01924034918', 'Dhanmondi', 'Dhaka', '1209', 'sadia', 'sadiaafrin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2022-10-03', 1, 200),
(6, '23.jpg', 'Jannatul', 'Ferdous', '', '2022-10-03', '', '', 'Female', '01624034918', 'Mohammadpur', 'Dhaka', '1207', 'janntul', 'jannat@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2022-10-06', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `babysitter_ratings`
--

CREATE TABLE `babysitter_ratings` (
  `rating_id` int(11) NOT NULL,
  `hire_id` int(11) NOT NULL,
  `babysitter_id` int(11) NOT NULL,
  `babysitter_img` varchar(250) NOT NULL,
  `babysitter_name` varchar(250) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(250) NOT NULL,
  `user_img` varchar(250) NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `babysitter_ratings`
--

INSERT INTO `babysitter_ratings` (`rating_id`, `hire_id`, `babysitter_id`, `babysitter_img`, `babysitter_name`, `user_id`, `user_name`, `user_img`, `rating`, `comment`) VALUES
(2, 6, 1, '21.jpg', 'Sadia Afrin', 1, 'lima', '24.jpg', 4, 'good'),
(4, 8, 1, '21.jpg', 'Sadia Afrin', 1, 'lima', '24.jpg', 4, 'grate service');

-- --------------------------------------------------------

--
-- Table structure for table `daycare`
--

CREATE TABLE `daycare` (
  `daycare_id` int(11) NOT NULL,
  `image` varchar(250) NOT NULL,
  `daycare_name` varchar(50) NOT NULL,
  `daycare_reg` varchar(250) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL,
  `zip` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(100) NOT NULL,
  `join_date` varchar(50) NOT NULL,
  `verification_status` int(11) NOT NULL DEFAULT 0,
  `rate` int(11) NOT NULL,
  `about` varchar(250) NOT NULL,
  `established` varchar(10) NOT NULL,
  `dropoff_time` varchar(250) NOT NULL,
  `pickup_time` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `daycare`
--

INSERT INTO `daycare` (`daycare_id`, `image`, `daycare_name`, `daycare_reg`, `contact`, `address`, `city`, `zip`, `email`, `username`, `password`, `join_date`, `verification_status`, `rate`, `about`, `established`, `dropoff_time`, `pickup_time`) VALUES
(1, 'daycare-1knyn4u.jpg', 'Ali Daycare', 'licence.jpg', '2345678911', 'Bosila, Mohammadpur', 'Dhaka', '1207', 'alidaycare@gmail.com', 'ali-daycare', 'e10adc3949ba59abbe56e057f20f883e', '2022-10-03', 1, 3000, 'A place where your childeren can learn and be taken care of while you are away.', '2015-02-03', '09:00', '21:00');

-- --------------------------------------------------------

--
-- Table structure for table `daycare_ratings`
--

CREATE TABLE `daycare_ratings` (
  `rating_id` int(11) NOT NULL,
  `hire_id` int(11) NOT NULL,
  `daycare_id` int(11) NOT NULL,
  `daycare_img` varchar(250) NOT NULL,
  `daycare_name` varchar(250) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(250) NOT NULL,
  `user_img` varchar(250) NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `hire_babysitter`
--

CREATE TABLE `hire_babysitter` (
  `hire_id` int(11) NOT NULL,
  `babysitter_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `baby_id` int(11) NOT NULL,
  `babysitter_name` varchar(250) NOT NULL,
  `user_name` varchar(250) NOT NULL,
  `baby_name` varchar(250) NOT NULL,
  `user_img` varchar(250) NOT NULL,
  `baby_img` varchar(250) NOT NULL,
  `babysitter_img` varchar(250) NOT NULL,
  `hire_from` varchar(250) NOT NULL,
  `hire_to` varchar(250) NOT NULL,
  `total_amount` int(11) NOT NULL,
  `message` varchar(250) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `incare` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hire_babysitter`
--

INSERT INTO `hire_babysitter` (`hire_id`, `babysitter_id`, `user_id`, `baby_id`, `babysitter_name`, `user_name`, `baby_name`, `user_img`, `baby_img`, `babysitter_img`, `hire_from`, `hire_to`, `total_amount`, `message`, `contact`, `incare`, `status`) VALUES
(8, 1, 1, 4, 'Sadia Afrin', 'lima', 'Rohan', '24.jpg', 'baby1.jpg', '21.jpg', '2022-10-06 22:00', '2022-10-05 14:00', 6400, 'i need someone to take cate of my child', '2345678911', 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `hire_daycare`
--

CREATE TABLE `hire_daycare` (
  `hire_id` int(11) NOT NULL,
  `daycare_id` int(11) NOT NULL,
  `daycare_name` varchar(250) NOT NULL,
  `daycare_img` varchar(250) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(250) NOT NULL,
  `user_img` varchar(250) NOT NULL,
  `baby_id` int(11) NOT NULL,
  `baby_img` varchar(250) NOT NULL,
  `baby_name` varchar(250) NOT NULL,
  `age` int(11) NOT NULL,
  `message` varchar(250) NOT NULL,
  `contact` varchar(250) NOT NULL,
  `total_amount` int(11) NOT NULL,
  `day` int(11) NOT NULL DEFAULT 30,
  `incare` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hire_daycare`
--

INSERT INTO `hire_daycare` (`hire_id`, `daycare_id`, `daycare_name`, `daycare_img`, `user_id`, `user_name`, `user_img`, `baby_id`, `baby_img`, `baby_name`, `age`, `message`, `contact`, `total_amount`, `day`, `incare`, `status`) VALUES
(1, 1, 'Ali Daycare', 'daycare-1knyn4u.jpg', 1, 'lima', '24.jpg', 4, 'baby1.jpg', 'Rohan', 8, 'he is a very well behaived boy', '2345678911', 3000, 29, 2, 0),
(3, 1, 'Ali Daycare', 'daycare-1knyn4u.jpg', 1, 'lima', '24.jpg', 4, 'baby1.jpg', 'Rohan', 8, 'i am a working women i need a place where my child can learn and play', '2345678911', 3000, 30, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `latest_users`
--

CREATE TABLE `latest_users` (
  `id` int(11) NOT NULL,
  `image` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `role` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `latest_users`
--

INSERT INTO `latest_users` (`id`, `image`, `name`, `role`) VALUES
(1, '24.jpg', 'lima', 'User'),
(2, '24.jpg', 'lima', 'User'),
(3, '24.jpg', 'lima', 'User'),
(4, 'admin.jpg', 'mahfuza', 'Admin'),
(5, 'admin.jpg', 'mahfuza', 'Admin'),
(6, 'admin.jpg', 'mahfuza', 'Admin'),
(7, 'admin.jpg', 'mahfuza', 'Admin'),
(8, 'admin.jpg', 'mahfuza', 'Admin'),
(9, '24.jpg', 'lima', 'User'),
(10, '24.jpg', 'lima', 'User'),
(11, 'admin.jpg', 'sadia', 'Babysitter'),
(12, '24.jpg', 'lima', 'User'),
(13, 'admin.jpg', 'sadia', 'Babysitter'),
(14, '24.jpg', 'lima', 'User'),
(15, 'admin.jpg', 'sadia', 'Babysitter'),
(16, 'daycare-1knyn4u.jpg', 'ali-daycare', 'Daycare'),
(17, 'daycare-1knyn4u.jpg', 'ali-daycare', 'Daycare'),
(18, 'admin.jpg', 'sadia', 'Babysitter'),
(19, 'daycare-1knyn4u.jpg', 'ali-daycare', 'Daycare'),
(20, 'admin.jpg', 'sadia', 'Babysitter'),
(21, 'daycare-1knyn4u.jpg', 'ali-daycare', 'Daycare'),
(22, 'admin.jpg', 'sadia', 'Babysitter'),
(23, 'daycare-1knyn4u.jpg', 'ali-daycare', 'Daycare'),
(24, 'admin.jpg', 'sadia', 'Babysitter'),
(25, 'daycare-1knyn4u.jpg', 'ali-daycare', 'Daycare'),
(26, 'admin.jpg', 'sadia', 'Babysitter'),
(27, '24.jpg', 'lima', 'User'),
(28, 'admin.jpg', 'sadia', 'Babysitter'),
(29, 'daycare-1knyn4u.jpg', 'ali-daycare', 'Daycare'),
(30, 'daycare-1knyn4u.jpg', 'ali-daycare', 'Daycare'),
(31, '24.jpg', 'lima', 'User'),
(32, '24.jpg', 'lima', 'User'),
(33, 'admin.jpg', 'mahfuza', 'Admin'),
(34, '24.jpg', 'lima', 'User'),
(35, 'admin.jpg', 'sadia', 'Babysitter'),
(36, 'admin.jpg', 'sunny56', 'Babysitter'),
(37, 'admin.jpg', 'mahfuza', 'Admin'),
(38, 'admin.jpg', 'mahfuza', 'Admin'),
(39, '24.jpg', 'lima', 'User'),
(40, '24.jpg', 'lima', 'User'),
(41, '24.jpg', 'lima', 'User');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_img` varchar(250) NOT NULL DEFAULT 'default.png',
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(250) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `birthday` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `zip` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_img`, `firstname`, `lastname`, `username`, `email`, `password`, `gender`, `birthday`, `contact`, `address`, `city`, `zip`) VALUES
(1, '24.jpg', 'Mahfuza', 'Lima', 'lima', 'lima@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Female', '2022-08-02', '2345678911', 'mohammadpur', 'Dhaka', '1207');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `baby`
--
ALTER TABLE `baby`
  ADD PRIMARY KEY (`baby_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `babysitter`
--
ALTER TABLE `babysitter`
  ADD PRIMARY KEY (`sitter_id`);

--
-- Indexes for table `babysitter_ratings`
--
ALTER TABLE `babysitter_ratings`
  ADD PRIMARY KEY (`rating_id`),
  ADD KEY `babysitter_id` (`babysitter_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `daycare`
--
ALTER TABLE `daycare`
  ADD PRIMARY KEY (`daycare_id`);

--
-- Indexes for table `daycare_ratings`
--
ALTER TABLE `daycare_ratings`
  ADD PRIMARY KEY (`rating_id`),
  ADD KEY `hire_id` (`hire_id`),
  ADD KEY `daycare_id` (`daycare_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `hire_babysitter`
--
ALTER TABLE `hire_babysitter`
  ADD PRIMARY KEY (`hire_id`),
  ADD KEY `babysitter_id` (`babysitter_id`),
  ADD KEY `baby_id` (`baby_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `hire_daycare`
--
ALTER TABLE `hire_daycare`
  ADD PRIMARY KEY (`hire_id`),
  ADD KEY `baby_id` (`baby_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `daycare_id` (`daycare_id`);

--
-- Indexes for table `latest_users`
--
ALTER TABLE `latest_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `baby`
--
ALTER TABLE `baby`
  MODIFY `baby_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `babysitter`
--
ALTER TABLE `babysitter`
  MODIFY `sitter_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `babysitter_ratings`
--
ALTER TABLE `babysitter_ratings`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `daycare`
--
ALTER TABLE `daycare`
  MODIFY `daycare_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `daycare_ratings`
--
ALTER TABLE `daycare_ratings`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hire_babysitter`
--
ALTER TABLE `hire_babysitter`
  MODIFY `hire_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `hire_daycare`
--
ALTER TABLE `hire_daycare`
  MODIFY `hire_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `latest_users`
--
ALTER TABLE `latest_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `baby`
--
ALTER TABLE `baby`
  ADD CONSTRAINT `baby_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `babysitter_ratings`
--
ALTER TABLE `babysitter_ratings`
  ADD CONSTRAINT `babysitter_ratings_ibfk_1` FOREIGN KEY (`babysitter_id`) REFERENCES `babysitter` (`sitter_id`),
  ADD CONSTRAINT `babysitter_ratings_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `daycare_ratings`
--
ALTER TABLE `daycare_ratings`
  ADD CONSTRAINT `daycare_ratings_ibfk_1` FOREIGN KEY (`hire_id`) REFERENCES `hire_daycare` (`hire_id`),
  ADD CONSTRAINT `daycare_ratings_ibfk_2` FOREIGN KEY (`daycare_id`) REFERENCES `daycare` (`daycare_id`),
  ADD CONSTRAINT `daycare_ratings_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `hire_babysitter`
--
ALTER TABLE `hire_babysitter`
  ADD CONSTRAINT `hire_babysitter_ibfk_1` FOREIGN KEY (`babysitter_id`) REFERENCES `babysitter` (`sitter_id`),
  ADD CONSTRAINT `hire_babysitter_ibfk_2` FOREIGN KEY (`baby_id`) REFERENCES `baby` (`baby_id`),
  ADD CONSTRAINT `hire_babysitter_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `hire_daycare`
--
ALTER TABLE `hire_daycare`
  ADD CONSTRAINT `hire_daycare_ibfk_1` FOREIGN KEY (`baby_id`) REFERENCES `baby` (`baby_id`),
  ADD CONSTRAINT `hire_daycare_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `hire_daycare_ibfk_3` FOREIGN KEY (`daycare_id`) REFERENCES `daycare` (`daycare_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
