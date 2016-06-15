-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 15, 2016 at 10:03 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vidteam_inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `identification` int(11) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(250) NOT NULL,
  `category` varchar(50) NOT NULL,
  `description` varchar(500) NOT NULL DEFAULT 'description will be available soon!',
  `image_name` varchar(200) NOT NULL DEFAULT 'default.svg',
  `quantity` int(11) NOT NULL,
  `available` int(11) NOT NULL,
  `in_use` int(11) NOT NULL DEFAULT '0',
  `lost` int(11) NOT NULL DEFAULT '0',
  `broken` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`identification`, `date_added`, `name`, `category`, `description`, `image_name`, `quantity`, `available`, `in_use`, `lost`, `broken`) VALUES
(1, '2016-06-03 09:59:57', 'Zoom H5 Recorder', 'Audio', 'Description will be available soon!', 'default.svg', 1, 1, 0, 0, 0),
(2, '2016-06-03 10:00:22', 'DR-100 Tascam Recorder', 'Audio', 'Description will be available soon!', 'default.svg', 1, 1, 0, 0, 0),
(3, '2016-06-03 10:01:07', 'Tascam RC-DR100 Remote', 'Audio', 'Description will be available soon!', 'default.svg', 1, 1, 0, 0, 0),
(4, '2016-06-03 10:01:23', 'Audio-Technica AT897 Microphone', 'audio', 'Description will be available soon!', 'default.svg', 1, 1, 0, 0, 0),
(5, '2016-06-03 10:06:29', 'Rycote Windshield', 'Audio', 'Description will be available soon!', 'default.svg', 1, 1, 0, 0, 0),
(6, '2016-06-03 10:09:39', 'Neewer NW-880 Camera Timer Remote', 'audio', 'Description will be available soon!', 'default.svg', 1, 1, 0, 0, 0),
(7, '2016-06-03 10:10:16', 'Aputure Timer Remote Controller', 'audio', 'Description will be available soon!', 'default.svg', 1, 1, 0, 0, 0),
(8, '2016-06-03 10:18:12', 'Pearstone Microphone Hand Grip', 'audio', 'Description will be available soon!', 'default.svg', 1, 1, 0, 0, 0),
(9, '2016-06-03 10:23:29', 'Headphone Jack Adapter', 'audio', 'Description will be available soon!', 'default.svg', 8, 8, 0, 0, 0),
(10, '2016-06-03 10:33:10', 'Microphone Foam â€“ Black Big', 'audio', 'Description will be available soon!', 'default.svg', 1, 1, 0, 0, 0),
(11, '2016-06-03 10:33:32', 'Microphone Foam â€“ Black Small', 'audio', 'Description will be available soon!', 'default.svg', 1, 1, 0, 0, 0),
(12, '2016-06-03 10:46:50', 'Canon 6D Camera', 'cameras', 'Description will be available soon!', 'default.svg', 2, 2, 0, 0, 0),
(13, '2016-06-03 10:47:15', 'Canon Rebel t2i Camera', 'cameras', 'Description will be available soon!', 'default.svg', 2, 2, 0, 0, 0),
(14, '2016-06-03 10:47:36', 'GoPro Hero 4', 'Cameras', 'Description will be available soon!', 'default.svg', 1, 1, 0, 0, 0),
(15, '2016-06-03 10:47:57', 'Logitech QuickCam Pro 9000', 'cameras', 'Description will be available soon\n', 'default.svg', 1, 1, 0, 0, 0),
(16, '2016-06-03 10:48:23', '77mm UV Protector', 'lenses', 'Description will be available soon!', 'default.svg', 3, 3, 0, 0, 0),
(17, '2016-06-03 10:49:10', '67mm Neutral Density 0.6 Filter', 'lenses', 'Description will be available soon!', 'default.svg', 2, 2, 0, 0, 0),
(18, '2016-06-03 10:49:38', '77mm Circular Polarizer Filter', 'lenses', 'Description will be available soon!', 'default.svg', 1, 1, 0, 0, 0),
(19, '2016-06-03 10:50:37', '67mm UV Protector', 'lenses', 'Description will be available soon!', 'default.svg', 2, 2, 0, 0, 0),
(20, '2016-06-03 10:51:24', '58mm-67mm Filter Adapter', 'lenses', 'Description will be available soon!', 'default.svg', 1, 1, 0, 0, 0),
(21, '2016-06-03 10:54:50', '72mm Variable Neutral Density Filter', 'lenses', 'Description will be available soon!', 'default.svg', 1, 1, 0, 0, 0),
(22, '2016-06-03 10:55:00', '77mm Variable Neutral Density Filter', 'lenses', 'Description will be available soon!', 'default.svg', 1, 1, 0, 0, 0),
(23, '2016-06-03 10:55:08', 'Rokinon 24mm T1.5 Cine Lens', 'lenses', 'Description will be available soon!', 'default.svg', 1, 1, 0, 0, 0),
(24, '2016-06-03 10:55:17', 'Rokinon 35mm T1.5 Cine Lens', 'lenses', 'Description will be available soon!', 'default.svg', 1, 1, 0, 0, 0),
(25, '2016-06-03 10:55:26', 'Rokinon 50mm T1.5 Cine Lens', 'lenses', 'Description will be available soon!', 'default.svg', 1, 1, 0, 0, 0),
(26, '2016-06-03 10:55:34', 'Rokinon 85mm T1.5 Cine Lens', 'lenses', 'Description will be available soon!', 'default.svg', 1, 1, 0, 0, 0),
(27, '2016-06-03 10:55:40', 'Tamron 10-24mm F3.5-4.5 Lens', 'lenses', 'Description will be available soon!', 'default.svg', 1, 1, 0, 0, 0),
(28, '2016-06-03 10:55:51', 'Tamron 10-24mm F3.5-4.5 Lens', 'lenses', 'Description will be available soon!', 'default.svg', 1, 1, 0, 0, 0),
(29, '2016-06-03 10:55:59', 'Tamron 28-75mm F2.8 Marco Lenses', 'lenses', 'Description will be available soon!', 'default.svg', 2, 2, 0, 0, 0),
(30, '2016-06-03 10:56:06', '18-55 Canon F4.5-5.6 Lens', 'lenses', 'Description will be available soon!', 'default.svg', 1, 1, 0, 0, 0),
(31, '2016-06-03 10:56:28', 'C-stands', 'gear', 'Description will be available soon!', 'default.svg', 5, 5, 0, 0, 0),
(32, '2016-06-03 10:56:35', 'Sand Bags', 'gear', 'Description will be available soon!', 'default.svg', 5, 5, 0, 0, 0),
(33, '2016-06-03 10:56:42', 'Green Screen', 'gear', 'Description will be available soon!', 'default.svg', 1, 1, 0, 0, 0),
(34, '2016-06-03 10:56:52', 'Tripod Plates', 'gear', 'Description will be available soon!', 'default.svg', 3, 3, 0, 0, 0),
(35, '2016-06-03 10:56:58', 'Grip Clips', 'gear', 'Description will be available soon!', 'default.svg', 4, 4, 0, 0, 0),
(36, '2016-06-03 10:57:11', 'Gaffer Tape Roll', 'gear', 'Description will be available soon!', 'default.svg', 4, 4, 0, 0, 0),
(37, '2016-06-03 10:57:19', 'Painterâ€™s Tape Roll', 'gear', 'Description will be available soon!', 'default.svg', 1, 1, 0, 0, 0),
(38, '2016-06-03 10:57:26', 'Slate', 'gear', 'Description will be available soon!', 'default.svg', 1, 1, 0, 0, 0),
(39, '2016-06-03 10:57:53', 'Gorilla Grip Tripod', 'gear', 'Description will be available soon!', 'default.svg', 1, 1, 0, 0, 0),
(40, '2016-06-03 10:58:00', 'Motorola Radios', 'gear', 'Description will be available soon!', 'default.svg', 3, 3, 0, 0, 0),
(41, '2016-06-03 10:58:26', 'DVD-R Discs', 'gear', 'Description will be available soon!', 'default.svg', 9000, 9000, 0, 0, 0),
(42, '2016-06-03 10:58:36', 'Zip Ties', 'gear', 'Description will be available soon!', 'default.svg', 9999, 9999, 0, 0, 0),
(43, '2016-06-03 10:58:42', 'Ruggard Camera Bag', 'gear', 'Description will be available soon!', 'default.svg', 1, 1, 0, 0, 0),
(44, '2016-06-03 10:58:48', 'Camera Slider', 'gear', 'Description will be available soon!', 'default.svg', 1, 1, 0, 0, 0),
(45, '2016-06-03 10:58:55', 'Revolve Camera Head Mount', 'gear', 'Description will be available soon!', 'default.svg', 1, 1, 0, 0, 0),
(46, '2016-06-03 10:59:01', 'Shoulder Rig', 'gear', 'Description will be available soon!', 'default.svg', 1, 1, 0, 0, 0),
(47, '2016-06-03 10:59:07', 'Oben ACM-2400 Monopod', 'gear', 'Description will be available soon!', 'default.svg', 1, 1, 0, 0, 0),
(48, '2016-06-03 10:59:13', 'Impact Background Support System', 'gear', 'Description will be available soon!', 'default.svg', 1, 1, 0, 0, 0),
(49, '2016-06-03 10:59:31', 'GoPro Flat Adhesive Mounts', 'gear', 'Description will be available soon!', 'default.svg', 2, 2, 0, 0, 0),
(50, '2016-06-03 10:59:38', 'GoPro Removable Mounts', 'gear', 'Description will be available soon!', 'default.svg', 3, 3, 0, 0, 0),
(51, '2016-06-03 10:59:45', 'GoPro Tripod Mounts', 'gear', 'Description will be available soon!', 'default.svg', 2, 2, 0, 0, 0),
(52, '2016-06-03 10:59:52', 'WaterProof Backdoor Housings', 'gear', 'Description will be available soon!', 'default.svg', 2, 2, 0, 0, 0),
(53, '2016-06-03 11:00:02', 'Adjustable GoPro Arm Mount', 'gear', 'Description will be available soon!', 'default.svg', 1, 1, 0, 0, 0),
(54, '2016-06-03 11:00:08', 'Key Clips', 'gear', 'Description will be available soon!', 'default.svg', 2, 2, 0, 0, 0),
(55, '2016-06-03 11:00:13', 'Canon Camera Bag', 'gear', 'Description will be available soon!', 'default.svg', 1, 1, 0, 0, 0),
(56, '2016-06-03 11:00:21', 'Manfrotto Tripod Head', 'gear', 'Description will be available soon!', 'default.svg', 1, 1, 0, 0, 0),
(57, '2016-06-03 11:00:31', 'Manfrotto Tripods', 'gear', 'Description will be available soon!', 'default.svg', 3, 3, 0, 0, 0),
(58, '2016-06-03 11:00:36', 'Pearstone Boom Pole', 'gear', 'Description will be available soon!', 'default.svg', 1, 1, 0, 0, 0),
(59, '2016-06-03 11:00:44', 'Boom Pole Holder', 'gear', 'Description will be available soon!', 'default.svg', 1, 1, 0, 0, 0),
(60, '2016-06-03 11:00:52', 'Intuous Touch Tablet', 'gear', 'Description will be available soon!', 'default.svg', 1, 1, 0, 0, 0),
(61, '2016-06-03 11:00:57', 'Intuous Creative Pen', 'gear', 'Description will be available soon!', 'default.svg', 1, 1, 0, 0, 0),
(62, '2016-06-03 11:01:02', 'CD Envelopes', 'gear', 'Description will be available soon!', 'default.svg', 1, 1, 0, 0, 0),
(63, '2016-06-03 11:01:31', 'Motorized Slider', 'gear', 'Includes: 1 Slider Mounting Block\n2 Slider End Belt Clamps\n1 Motor Clamp Plate\n2 Idler Pins\n2 Mounting Screws\n2 Screw Adapters\n1 Friction Drive Wheel\n1 Dolly Motor Mount\n1 Belt\n1 Pulley\n1 Motor', 'default.svg', 1, 1, 0, 0, 0),
(64, '2016-06-03 11:02:04', 'Kino Kits', 'lighting', 'Description will be available soon!', 'default.svg', 2, 2, 0, 0, 0),
(65, '2016-06-03 11:02:23', '32GB Extreme SanDisk Memory Cards', 'card_readers', 'Description will be available soon!', 'default.svg', 4, 4, 0, 0, 0),
(66, '2016-06-03 11:02:32', '16GB Extreme SanDisk Memory Card', 'card_readers', 'Description will be available soon!', 'default.svg', 2, 2, 0, 0, 0),
(67, '2016-06-03 11:02:39', '32GB Ultra SanDisk Memory Card', 'card_readers', 'Description will be available soon!', 'default.svg', 1, 1, 0, 0, 0),
(68, '2016-06-03 11:02:46', '16GB Ultra SanDisk Memory Card', 'card_readers', 'Description will be available soon!', 'default.svg', 1, 1, 0, 0, 0),
(69, '2016-06-03 11:02:54', '32GB Transcend Memory Card', 'card_readers', 'Description will be available soon!', 'default.svg', 1, 1, 0, 0, 0),
(70, '2016-06-03 11:03:02', '8GB SanDisk Memory Card', 'card_readers', 'Description will be available soon!', 'default.svg', 1, 1, 0, 0, 0),
(71, '2016-06-03 11:03:08', '2GB Micro SD Card', 'card_readers', 'Description will be available soon!', 'default.svg', 1, 1, 0, 0, 0),
(72, '2016-06-03 11:03:17', 'SanDisk MicroSD Converter', 'card_readers', 'Description will be available soon!', 'default.svg', 2, 2, 0, 0, 0),
(73, '2016-06-03 11:03:31', 'Memory Card Holder', 'card_readers', 'Description will be available soon!', 'default.svg', 4, 4, 0, 0, 0),
(74, '2016-06-03 11:03:38', 'Transcend Card Reader', 'card_readers', 'Description will be available soon!', 'default.svg', 1, 1, 0, 0, 0),
(75, '2016-06-03 11:03:50', 'LP-E6 Batteries', 'batteries', 'Description will be available soon!', 'default.svg', 6, 6, 0, 0, 0),
(76, '2016-06-03 11:03:58', 'LP-E6 Battery Charger', 'batteries', 'Description will be available soon!', 'default.svg', 6, 6, 0, 0, 0),
(77, '2016-06-03 11:04:08', 'LP-E8 Battery', 'batteries', 'Description will be available soon!', 'default.svg', 3, 3, 0, 0, 0),
(78, '2016-06-03 11:04:17', 'LP-E8 Battery Charger', 'batteries', 'Description will be available soon!', 'default.svg', 1, 1, 0, 0, 0),
(79, '2016-06-03 11:04:24', 'LP-E8 Battery Cases', 'batteries', 'Description will be available soon!', 'default.svg', 3, 3, 0, 0, 0),
(80, '2016-06-03 11:04:32', 'BN-VF823U Data Battery', 'batteries', 'Description will be available soon!', 'default.svg', 1, 1, 0, 0, 0),
(81, '2016-06-03 11:04:40', 'Duracell AA Batteries', 'batteries', 'Description will be available soon!', 'default.svg', 9999, 9999, 0, 0, 0),
(82, '2016-06-03 11:04:47', 'Watson B-2303 Batteries', 'batteries', 'Description will be available soon!', 'default.svg', 2, 2, 0, 0, 0),
(83, '2016-06-03 11:04:56', 'Watson Mini Duo Battery Charger', 'batteries', 'Description will be available soon!', 'default.svg', 1, 1, 0, 0, 0),
(84, '2016-06-03 11:05:06', 'Walk taking Battery', 'batteries', 'Description will be available soon!', 'default.svg', 1, 1, 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`identification`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `identification` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
