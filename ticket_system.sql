-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 15, 2018 at 11:32 PM
-- Server version: 5.7.22-0ubuntu18.04.1
-- PHP Version: 7.2.7-1+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ticket_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `ts_employees`
--

CREATE TABLE `ts_employees` (
  `employee_id` int(11) NOT NULL,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `password` varchar(500) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `hash` varchar(500) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ts_employees`
--

INSERT INTO `ts_employees` (`employee_id`, `first_name`, `last_name`, `email`, `password`, `status_id`, `hash`, `date_created`) VALUES
(1, 'luis', 'cruz', 'admin@mail.com', 'e10adc3949ba59abbe56e057f20f883e', 1, '94e93c3f7e2b610fc108acea1460dfd8', '2018-07-10 22:31:53'),
(4, 'jose', 'perez', 'jose@mail.com', 'e10adc3949ba59abbe56e057f20f883e', 1, NULL, '2018-07-16 02:48:56'),
(5, 'richard', 'gomez', 'richard@mail.com', 'e10adc3949ba59abbe56e057f20f883e', 1, NULL, '2018-07-16 02:49:23');

-- --------------------------------------------------------

--
-- Table structure for table `ts_note_ticket_employee`
--

CREATE TABLE `ts_note_ticket_employee` (
  `note_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `date_from` datetime NOT NULL,
  `date_to` datetime NOT NULL,
  `note` text NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ts_note_ticket_employee`
--

INSERT INTO `ts_note_ticket_employee` (`note_id`, `employee_id`, `ticket_id`, `date_from`, `date_to`, `note`, `created_on`) VALUES
(15, 5, 13, '2018-07-15 02:00:00', '2018-07-15 04:00:00', 'Ready, change the ram.', '2018-07-16 03:12:14'),
(16, 1, 12, '2018-07-15 11:12:00', '2018-07-15 11:13:00', 'Jose will complete the task.', '2018-07-16 03:13:34');

-- --------------------------------------------------------

--
-- Table structure for table `ts_status`
--

CREATE TABLE `ts_status` (
  `status_id` int(11) NOT NULL,
  `description` varchar(45) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  `color` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ts_status`
--

INSERT INTO `ts_status` (`status_id`, `description`, `type`, `color`) VALUES
(1, 'Enabled', 'employees', 'green-lbl'),
(2, 'Disabled', 'employees', 'red-lbl'),
(3, 'Open', 'tickets', 'green-lbl'),
(4, 'Close', 'tickets', 'red-lbl');

-- --------------------------------------------------------

--
-- Table structure for table `ts_tickets`
--

CREATE TABLE `ts_tickets` (
  `ticket_id` int(11) NOT NULL,
  `ticket_num` varchar(15) DEFAULT NULL,
  `subject` varchar(45) NOT NULL,
  `description` text NOT NULL,
  `date` date NOT NULL,
  `status_id` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ts_tickets`
--

INSERT INTO `ts_tickets` (`ticket_id`, `ticket_num`, `subject`, `description`, `date`, `status_id`, `created_on`) VALUES
(12, '0001', 'Change headset', 'My headset not working', '2018-07-15', 3, '2018-07-16 02:51:13'),
(13, '0002', 'My computer not working', 'Tried to turn it on but it does not work.', '2018-07-14', 4, '2018-07-16 02:56:28');

-- --------------------------------------------------------

--
-- Table structure for table `ts_tickets_employees`
--

CREATE TABLE `ts_tickets_employees` (
  `ticket_employee_id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ts_tickets_employees`
--

INSERT INTO `ts_tickets_employees` (`ticket_employee_id`, `ticket_id`, `employee_id`) VALUES
(32, 13, 5),
(33, 12, 1),
(34, 12, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ts_employees`
--
ALTER TABLE `ts_employees`
  ADD PRIMARY KEY (`employee_id`),
  ADD KEY `fk_ts_employees_1_idx` (`status_id`);

--
-- Indexes for table `ts_note_ticket_employee`
--
ALTER TABLE `ts_note_ticket_employee`
  ADD PRIMARY KEY (`note_id`),
  ADD KEY `fk_ts_note_ticket_employee_1_idx` (`employee_id`),
  ADD KEY `fk_ts_note_ticket_employee_2_idx` (`ticket_id`);

--
-- Indexes for table `ts_status`
--
ALTER TABLE `ts_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `ts_tickets`
--
ALTER TABLE `ts_tickets`
  ADD PRIMARY KEY (`ticket_id`),
  ADD KEY `fk_ts_tickets_1_idx` (`status_id`);

--
-- Indexes for table `ts_tickets_employees`
--
ALTER TABLE `ts_tickets_employees`
  ADD PRIMARY KEY (`ticket_employee_id`),
  ADD KEY `fk_ls_tickets_employees_1_idx` (`employee_id`),
  ADD KEY `fk_ls_tickets_employees_2_idx` (`ticket_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ts_employees`
--
ALTER TABLE `ts_employees`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `ts_note_ticket_employee`
--
ALTER TABLE `ts_note_ticket_employee`
  MODIFY `note_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `ts_status`
--
ALTER TABLE `ts_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ts_tickets`
--
ALTER TABLE `ts_tickets`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `ts_tickets_employees`
--
ALTER TABLE `ts_tickets_employees`
  MODIFY `ticket_employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `ts_employees`
--
ALTER TABLE `ts_employees`
  ADD CONSTRAINT `fk_ts_employees_1` FOREIGN KEY (`status_id`) REFERENCES `ts_status` (`status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ts_note_ticket_employee`
--
ALTER TABLE `ts_note_ticket_employee`
  ADD CONSTRAINT `fk_ts_note_ticket_employee_1` FOREIGN KEY (`employee_id`) REFERENCES `ts_tickets_employees` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ts_note_ticket_employee_2` FOREIGN KEY (`ticket_id`) REFERENCES `ts_tickets` (`ticket_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ts_tickets`
--
ALTER TABLE `ts_tickets`
  ADD CONSTRAINT `fk_ts_tickets_1` FOREIGN KEY (`status_id`) REFERENCES `ts_status` (`status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ts_tickets_employees`
--
ALTER TABLE `ts_tickets_employees`
  ADD CONSTRAINT `fk_ls_tickets_employees_1` FOREIGN KEY (`employee_id`) REFERENCES `ts_employees` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ls_tickets_employees_2` FOREIGN KEY (`ticket_id`) REFERENCES `ts_tickets` (`ticket_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
