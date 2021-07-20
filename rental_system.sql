-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 19, 2020 at 10:04 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rental_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL,
  `last_login` datetime NOT NULL,
  `date_register` datetime NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `firstname`, `lastname`, `image`, `last_login`, `date_register`, `password`, `email`) VALUES
(1, 'Admin', '', 'avatar5.png', '2020-06-27 17:41:53', '2020-06-27 17:41:53', '21232f297a57a5a743894a0e4a801fc3', 'admin@admin.com');

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `link` text DEFAULT NULL,
  `name` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` text DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `create_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `link`, `name`, `description`, `image`, `status`, `create_date`) VALUES
(1, 'different-car-rental-for-different-people', 'Different Car Rental for Different People', '<p>&nbsp;</p>\r\n<h4 class=\"p1\" style=\"margin: 0px; padding: 0px; border: 0px; font-size: 20px; font-family: Poppins, Helvetica, Arial, sans-serif; vertical-align: baseline; line-height: 1.4em; background-color: #ffffff;\">Refueling</h4>\r\n<p class=\"p2\" style=\"margin: 0px; padding: 0.7em 0px 1.3em; border: 0px; font-size: 15px; font-family: \'Work Sans\', Helvetica, Arial, sans-serif; vertical-align: baseline; color: #222222; background-color: #ffffff;\">Meh synth Schlitz, tempor duis single-origin coffee ea next level ethnic fingerstache fanny pack nostrud. Photo booth anim 8-bit hella, PBR 3 wolf moon beard Helvetica. Salvia esse nihil, flexitarian Truffaut synth art party deep v chillwave. Seitan High Life reprehenderit consectetur cupidatat kogi. Et leggings fanny pack, elit bespoke vinyl art party Pitchfork selfies master cleanse.</p>', 'uploads/blog/1755190736bmw-3-series-sedan-wallpaper-1920x1200-05-700x466.jpg', 0, '2020-06-28 19:29:12');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `name` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `phone` text DEFAULT NULL,
  `pickup_address` text DEFAULT NULL,
  `pickup_date` date DEFAULT NULL,
  `pickup_time` text DEFAULT NULL,
  `dropoff_address` text DEFAULT NULL,
  `dropoff_date` date DEFAULT NULL,
  `dropoff_time` text DEFAULT NULL,
  `book_type` varchar(150) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_tb` text DEFAULT NULL,
  `message` text DEFAULT NULL,
  `published` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `name`, `email`, `phone`, `pickup_address`, `pickup_date`, `pickup_time`, `dropoff_address`, `dropoff_date`, `dropoff_time`, `book_type`, `product_id`, `product_tb`, `message`, `published`) VALUES
(1, 'Asad', 'asad@gmail.com', '12334', 'fsd', '2020-07-01', '8:30', 'fsd', '2020-07-02', '12:00', 'Rent a car', 1, 'rent_a_car', NULL, '2020-07-01 08:09:10'),
(2, 'qamer', 'qamer@gmail.com', '1234', NULL, NULL, NULL, NULL, NULL, NULL, 'Sell a car', 1, 'sell_a_car', 'abc', '2020-07-01 08:31:31'),
(3, 'Waqas', 'waqas@gmail.com', '1234', NULL, NULL, NULL, NULL, NULL, NULL, 'Rent to buy', 1, 'rent_to_buy', 'abc', '2020-07-01 08:40:04'),
(7, 'Javed', 'javed@gmail.com', '12345', NULL, NULL, NULL, NULL, NULL, NULL, 'Rent to buy', 1, 'rent_to_buy', 'abc', '2020-07-05 17:38:11');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `priority` int(3) DEFAULT 0,
  `name` varchar(30) DEFAULT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `priority`, `name`, `image`) VALUES
(1, 0, 'Audi', 'uploads/brand/1799638547Audi-A4-Avant-1.jpg'),
(2, 0, 'BMW', 'uploads/brand/1616792110bmw-3-series-sedan-wallpaper-1920x1200-05.jpg'),
(3, 0, 'Lexus', 'uploads/brand/15531303772016-Lexus-RX-350-BM-01.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `name` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `subject` text DEFAULT NULL,
  `message` text DEFAULT NULL,
  `form_type` text DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `published` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `subject`, `message`, `form_type`, `status`, `published`) VALUES
(1, 'Asad', 'asad@gmail.com', 'test', 'abc', 'About us', 0, '2020-07-01 19:58:04'),
(2, 'Arsh', 'arsh@gmail.com', NULL, 'abc', 'Contact us', 0, '2020-07-01 20:13:39'),
(3, 'Ali', 'ali@gmail.com', 'faqs', 'test', 'FAQs', 0, '2020-07-02 15:54:16');

-- --------------------------------------------------------

--
-- Table structure for table `extension`
--

CREATE TABLE `extension` (
  `extension_id` int(11) NOT NULL,
  `path` varchar(250) NOT NULL,
  `priority` int(11) NOT NULL,
  `name` varchar(68) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `part_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `extension`
--

INSERT INTO `extension` (`extension_id`, `path`, `priority`, `name`, `status`, `part_id`) VALUES
(1, 'home', 0, 'category_module', 1, 1),
(2, 'home', 0, 'latest', 1, 2),
(3, 'all', 0, 'fb', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `gallery_id` int(11) DEFAULT 0,
  `image` text DEFAULT NULL,
  `tb_name` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `gallery_id`, `image`, `tb_name`) VALUES
(4, 1, 'uploads/gallery/audi-q4-sportback-e-tron-concept-exterior-11.jpg', 'rent_a_car'),
(5, 1, 'uploads/gallery/audi-q4-sportback-e-tron-concept-exterior-10.jpg', 'rent_a_car'),
(6, 1, 'uploads/gallery/audi-q4-sportback-e-tron-concept-exterior-6.jpg', 'rent_a_car'),
(7, 1, 'uploads/gallery/audi-q4-sportback-e-tron-concept-exterior-4.jpg', 'rent_a_car'),
(8, 1, 'uploads/gallery/audi-q4-sportback-e-tron-concept-exterior-2.jpg', 'rent_a_car'),
(9, 1, 'uploads/gallery/audi-5.jpg', 'rent_a_car'),
(23, 1, 'uploads/gallery/1109490363-photo-1592222269733-1d44ea5ab43b.jpg', 'rent_to_buy'),
(24, 1, 'uploads/gallery/206842748-photo-1588324163167-551ca7eb4335.jpg', 'rent_to_buy'),
(25, 1, 'uploads/gallery/395261245-audi-q4-sportback-e-tron-concept-exterior-2.jpg', 'rent_to_buy'),
(28, 1, 'uploads/gallery/298067179-photo-1557720706-a974123cea84.jpg', 'rent_to_buy'),
(32, 1, 'uploads/gallery/76379461-download.jpg', 'sell_a_car'),
(33, 1, 'uploads/gallery/1155781235-download (3).jpg', 'sell_a_car'),
(34, 1, 'uploads/gallery/1720523408-download (2).jpg', 'sell_a_car'),
(35, 1, 'uploads/gallery/1530677113-download (1).jpg', 'sell_a_car');

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE `language` (
  `language_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(5) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `sort_order` int(3) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`language_id`, `name`, `code`, `image`, `sort_order`) VALUES
(1, 'english', 'en', NULL, 0),
(2, 'macedonian', 'mk', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `nation`
--

CREATE TABLE `nation` (
  `nation_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `priority` int(11) NOT NULL,
  `type` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nation`
--

INSERT INTO `nation` (`nation_id`, `name`, `priority`, `type`) VALUES
(1, 'nation test', 0, 1),
(2, 'second nation', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `part`
--

CREATE TABLE `part` (
  `part_id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `part`
--

INSERT INTO `part` (`part_id`, `name`) VALUES
(1, 'left'),
(2, 'top'),
(3, 'head');

-- --------------------------------------------------------

--
-- Table structure for table `region`
--

CREATE TABLE `region` (
  `region_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `priority` int(11) NOT NULL,
  `type` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `region`
--

INSERT INTO `region` (`region_id`, `name`, `priority`, `type`) VALUES
(1, 'region 5', 0, 1),
(2, 'region 453', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `rent_a_car`
--

CREATE TABLE `rent_a_car` (
  `id` int(11) NOT NULL,
  `link` text DEFAULT NULL,
  `title` text DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `image` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` float DEFAULT NULL,
  `sp_list` text DEFAULT NULL,
  `list_1` text DEFAULT NULL,
  `list_2` text DEFAULT NULL,
  `car_type` text NOT NULL,
  `status` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rent_a_car`
--

INSERT INTO `rent_a_car` (`id`, `link`, `title`, `category_id`, `image`, `description`, `price`, `sp_list`, `list_1`, `list_2`, `car_type`, `status`) VALUES
(1, 'audi-a4', 'Audi A4', 1, 'uploads/rent_a_car/2065459396bmw-3-series-sedan-wallpaper-1920x1200-05-700x466.jpg', '<h4 class=\"p1\" style=\"margin: 0px; padding: 0px; border: 0px; font-size: 20px; font-family: Poppins, Helvetica, Arial, sans-serif; vertical-align: baseline; line-height: 1.4em; background-color: #ffffff;\">Refueling</h4>\r\n<p class=\"p2\" style=\"margin: 0px; padding: 0.7em 0px 1.3em; border: 0px; font-size: 15px; font-family: \'Work Sans\', Helvetica, Arial, sans-serif; vertical-align: baseline; color: #222222; background-color: #ffffff;\">Meh synth Schlitz, tempor duis single-origin coffee ea next level ethnic fingerstache fanny pack nostrud. Photo booth anim 8-bit hella, PBR 3 wolf moon beard Helvetica. Salvia esse nihil, flexitarian Truffaut synth art party deep v chillwave. Seitan High Life reprehenderit consectetur cupidatat kogi. Et leggings fanny pack, elit bespoke vinyl art party Pitchfork selfies master cleanse.</p>\r\n<h4 class=\"p1\" style=\"margin: 0px; padding: 0px; border: 0px; font-size: 20px; font-family: Poppins, Helvetica, Arial, sans-serif; vertical-align: baseline; line-height: 1.4em; background-color: #ffffff;\">Car Wash</h4>\r\n<p class=\"p2\" style=\"margin: 0px; padding: 0.7em 0px 1.3em; border: 0px; font-size: 15px; font-family: \'Work Sans\', Helvetica, Arial, sans-serif; vertical-align: baseline; color: #222222; background-color: #ffffff;\">Craft beer elit seitan exercitation, photo booth et 8-bit kale chips proident chillwave deep v laborum. Aliquip veniam delectus, Marfa eiusmod Pinterest in do umami readymade swag. Selfies iPhone Kickstarter, drinking vinegar jean vinegar stumptown yr pop-up artisan sunt. Craft beer elit seitan exercitation, photo booth</p>\r\n<h4 class=\"p1\" style=\"margin: 0px; padding: 0px; border: 0px; font-size: 20px; font-family: Poppins, Helvetica, Arial, sans-serif; vertical-align: baseline; line-height: 1.4em; background-color: #ffffff;\">No Smoking</h4>\r\n<p class=\"p2\" style=\"margin: 0px; padding: 0.7em 0px 1.3em; border: 0px; font-size: 15px; font-family: \'Work Sans\', Helvetica, Arial, sans-serif; vertical-align: baseline; color: #222222; background-color: #ffffff;\">See-through delicate embroidered organza blue lining luxury acetate-mix stretch pleat detailing. Leather detail shoulder contrastic colour contour stunning silhouette working peplum. Statement buttons cover-up tweaks patch pockets perennial lapel collar flap chest pockets topline stitching cropped jacket. Effortless comfortable full leather lining eye-catching unique detail to the toe low &lsquo;cut-away&rsquo; sides clean and sleek. Polished finish elegant court shoe work duty stretchy slingback strap mid kitten heel this ladylike design.</p>', 84, NULL, '[\"Audio input\",\"Bluetooth\",\"Heated seats\",\"All Wheel drive\",\"USB input\",\"FM Radio\",\"test\"]', '[\"GPS Navigation\",\"Sunroof\"]', 'rent_a_car', 0);

-- --------------------------------------------------------

--
-- Table structure for table `rent_to_buy`
--

CREATE TABLE `rent_to_buy` (
  `id` int(11) NOT NULL,
  `link` text DEFAULT NULL,
  `title` text DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `image` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` float DEFAULT NULL,
  `sp_list` text DEFAULT NULL,
  `list_1` text DEFAULT NULL,
  `list_2` text DEFAULT NULL,
  `car_type` text NOT NULL,
  `status` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rent_to_buy`
--

INSERT INTO `rent_to_buy` (`id`, `link`, `title`, `category_id`, `image`, `description`, `price`, `sp_list`, `list_1`, `list_2`, `car_type`, `status`) VALUES
(1, 'bmw-3-series', 'BMW 3 Series ', 3, 'uploads/rent_to_buy/20176533682016-MINI-Cooper-S-Clubman-ALL4-700x466.jpg', '<p>abc</p>', 64, NULL, '[\"Audio input\",\"Bluetooth\",\"Heated seats\",\"All Wheel drive\",\"USB input\",\"FM Radio\"]', '[\"GPS Navigation\",\"Sunroof\"]', 'rent_to_buy', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sell_a_car`
--

CREATE TABLE `sell_a_car` (
  `id` int(11) NOT NULL,
  `link` text DEFAULT NULL,
  `title` text DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `image` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` float DEFAULT NULL,
  `sp_list` text DEFAULT NULL,
  `list_1` text DEFAULT NULL,
  `list_2` text DEFAULT NULL,
  `car_type` text NOT NULL,
  `status` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sell_a_car`
--

INSERT INTO `sell_a_car` (`id`, `link`, `title`, `category_id`, `image`, `description`, `price`, `sp_list`, `list_1`, `list_2`, `car_type`, `status`) VALUES
(1, 'mini-countryman', 'MINI Countryman', 2, 'uploads/sell_a_car/1002441557Audi-A4-Avant-1-700x466.jpg', '<p>sgh</p>', 100, NULL, '[\"Audio input\",\"Bluetooth\",\"Heated seats\",\"All Wheel drive\",\"USB input\",\"FM Radio\"]', '[\"GPS Navigation\",\"Sunroof\"]', 'sell_a_car', 0);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `option` varchar(100) DEFAULT NULL,
  `value` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `option`, `value`) VALUES
(1, 'email', 'admin@admin.com'),
(2, 'address', '184 Main Street East 8007'),
(3, 'phone', '1.800.456.6743'),
(4, 'time', 'Mon-Fri 09.00 - 17.00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_group_id` int(11) NOT NULL,
  `firstname` varchar(300) NOT NULL,
  `lastname` varchar(300) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `date_birth` date NOT NULL,
  `gender` tinyint(4) NOT NULL,
  `region_id` int(11) NOT NULL,
  `ip` varchar(40) DEFAULT NULL,
  `email` varchar(96) NOT NULL,
  `date_added` date NOT NULL,
  `password` varchar(32) NOT NULL,
  `nation_id` int(11) NOT NULL,
  `ban` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--

CREATE TABLE `user_group` (
  `user_group_id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_group`
--

INSERT INTO `user_group` (`user_group_id`, `name`) VALUES
(1, 'Default');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `extension`
--
ALTER TABLE `extension`
  ADD PRIMARY KEY (`extension_id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`language_id`);

--
-- Indexes for table `nation`
--
ALTER TABLE `nation`
  ADD PRIMARY KEY (`nation_id`);

--
-- Indexes for table `part`
--
ALTER TABLE `part`
  ADD PRIMARY KEY (`part_id`);

--
-- Indexes for table `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`region_id`);

--
-- Indexes for table `rent_a_car`
--
ALTER TABLE `rent_a_car`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rent_to_buy`
--
ALTER TABLE `rent_to_buy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sell_a_car`
--
ALTER TABLE `sell_a_car`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_group`
--
ALTER TABLE `user_group`
  ADD PRIMARY KEY (`user_group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `extension`
--
ALTER TABLE `extension`
  MODIFY `extension_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
  MODIFY `language_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `nation`
--
ALTER TABLE `nation`
  MODIFY `nation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `part`
--
ALTER TABLE `part`
  MODIFY `part_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `region`
--
ALTER TABLE `region`
  MODIFY `region_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rent_a_car`
--
ALTER TABLE `rent_a_car`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rent_to_buy`
--
ALTER TABLE `rent_to_buy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sell_a_car`
--
ALTER TABLE `sell_a_car`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_group`
--
ALTER TABLE `user_group`
  MODIFY `user_group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
