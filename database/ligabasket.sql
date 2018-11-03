-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 23, 2018 at 10:40 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ligabasket`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank_accounts`
--

CREATE TABLE `bank_accounts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bank_name` varchar(10) NOT NULL,
  `account_no` varchar(20) NOT NULL,
  `account_name` varchar(100) NOT NULL,
  `created_on` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bank_accounts`
--

INSERT INTO `bank_accounts` (`id`, `user_id`, `bank_name`, `account_no`, `account_name`, `created_on`) VALUES
(1, 1, 'bca', '8380081297', 'Elen Young Jaya', 1527557768),
(2, 2, 'danamon', '003601287018', 'Rayhan Sentosa', 1527557953),
(3, 3, 'bni', '00213098901', 'Heriyanto', 1527558131),
(4, 1005, 'bni', '', 'Grantentef', 1533634053);

-- --------------------------------------------------------

--
-- Table structure for table `broadcasts`
--

CREATE TABLE `broadcasts` (
  `id` mediumint(9) NOT NULL,
  `team_id` mediumint(8) UNSIGNED NOT NULL,
  `message` text NOT NULL,
  `created_on` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `broadcasts`
--

INSERT INTO `broadcasts` (`id`, `team_id`, `message`, `created_on`) VALUES
(15, 13, 'ayoo tanding yoo', 1527831059),
(39, 13, 'Hallo teman-temann saya membutuhkan lawan tanding untuk menguji kemampuan tim saya,  jika ada yang ingin tanding silahkan invite saya ya, thanks', 1530321797),
(40, 13, 'hallo siapa aja yang mau tanding lawan kita boleh invite aja ya.. ', 1533130778);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `vendor_id` mediumint(8) UNSIGNED NOT NULL,
  `user_id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` mediumint(8) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `event_date` date NOT NULL,
  `description` text NOT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `status` varchar(20) DEFAULT 'archive',
  `latitude` double NOT NULL DEFAULT '0',
  `longitude` double NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `vendor_id`, `user_id`, `name`, `price`, `image`, `event_date`, `description`, `created_on`, `status`, `latitude`, `longitude`) VALUES
(16, 1, 999, 'UNIV CUP KEMERDEKAAN 2018', 73000, '1534244367.jpg', '2018-08-17', 'UNIV CUP KEMERDEKAAN 2018', 1534244367, 'archive', -7.4242782, 109.23963660000004);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'vendor', 'Pengusaha Lapang'),
(3, 'team', 'Team Member'),
(4, 'commite', 'Panitia Event');

-- --------------------------------------------------------

--
-- Table structure for table `halls`
--

CREATE TABLE `halls` (
  `id` int(11) NOT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `rent_price` mediumint(8) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT '1',
  `image` varchar(255) DEFAULT NULL,
  `latitude` double NOT NULL DEFAULT '0',
  `longitude` double NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `halls`
--

INSERT INTO `halls` (`id`, `vendor_id`, `name`, `created_on`, `rent_price`, `active`, `image`, `latitude`, `longitude`) VALUES
(1, 1, 'Lapangan A', 1527558281, 85000, 1, '1527558865.jpg', -6.9226151, 107.58792930000004),
(2, 1, 'Lapangan B', 1527558319, 85000, 1, '1527558319.jpg', -6.9226151, 107.58792930000004),
(3, 2, 'Lapangan 1', 1527558865, 90000, 1, '1527558281.jpg ', -6.9226151, 107.58792930000004),
(4, 2, 'Lapangan 2', 1527558926, 90000, 1, '1527558926.jpg', -6.9226151, 107.58792930000004);

-- --------------------------------------------------------

--
-- Table structure for table `halls_schedules`
--

CREATE TABLE `halls_schedules` (
  `id` int(11) NOT NULL,
  `hall_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `created_on` int(11) UNSIGNED NOT NULL DEFAULT '1525009658',
  `active` tinyint(1) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `halls_schedules`
--

INSERT INTO `halls_schedules` (`id`, `hall_id`, `date`, `schedule_id`, `created_on`, `active`) VALUES
(3, 2, '2018-08-22', 1, 1534905314, 1),
(4, 2, '2018-08-22', 2, 1534905314, 1),
(5, 2, '2018-08-22', 3, 1534905314, 1),
(17, 1, '2018-08-22', 1, 1534918623, 1),
(18, 1, '2018-08-22', 2, 1534918623, 1),
(19, 1, '2018-08-22', 8, 1534918623, 1),
(20, 1, '2018-08-22', 9, 1534918623, 1),
(21, 1, '2018-08-22', 10, 1534918623, 1);

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` varchar(5) NOT NULL,
  `team_id` mediumint(8) UNSIGNED NOT NULL,
  `hall_id` mediumint(8) UNSIGNED NOT NULL,
  `bank_account_id` int(10) UNSIGNED NOT NULL,
  `hall_schedule_ids` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'order',
  `customer` varchar(100) NOT NULL,
  `rent_hour` tinyint(2) UNSIGNED NOT NULL,
  `message` text NOT NULL,
  `receipt_of_transfer` varchar(255) NOT NULL,
  `order_date` date NOT NULL,
  `bank_name` varchar(100) NOT NULL,
  `bank_account_name` varchar(100) NOT NULL,
  `bank_account_number` varchar(100) NOT NULL,
  `total_bill` mediumint(8) UNSIGNED NOT NULL,
  `confirm_datetime` int(11) UNSIGNED NOT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `image_raw` longblob,
  `pic_latitude` double NOT NULL DEFAULT '0',
  `pic_longitude` double NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `team_id`, `hall_id`, `bank_account_id`, `hall_schedule_ids`, `status`, `customer`, `rent_hour`, `message`, `receipt_of_transfer`, `order_date`, `bank_name`, `bank_account_name`, `bank_account_number`, `total_bill`, `confirm_datetime`, `created_on`, `image_raw`, `pic_latitude`, `pic_longitude`) VALUES
('27GPT', 13, 4, 2, '10', 'order', 'Sheptian', 1, '', '', '2018-07-24', '', '', '', 90000, 0, 1530310463, NULL, -6.9226151, 107.58792930000004),
('A6RCQ', 13, 1, 1, '8', 'accepted', 'Sheptian', 1, '', '', '2018-08-22', '', '', '', 85000, 0, 1530303327, NULL, -6.9226151, 107.58792930000004),
('FO4WR', 13, 3, 2, '8', 'order', 'tian', 1, '', '', '2018-08-01', '', '', '', 90000, 0, 1533130827, NULL, -6.9226151, 107.58792930000004),
('KEASC', 13, 3, 2, '4', 'order', 'Sheptian', 1, '', '', '2018-07-26', '', '', '', 90000, 0, 1530305385, NULL, -6.9226151, 107.58792930000004),
('LB0KR', 13, 1, 1, '1,2,3,4', 'paid', '', 1, '', 'hhz', '2018-08-23', 'hhz', 'zz', 'xx', 85000, 0, 1534918652, 0xffd8ffe000104a46494600010100000100010000ffdb0043000d090a0b0a080d0b0a0b0e0e0d0f13201513121213271c1e17202e2931302e292d2c333a4a3e333646372c2d405741464c4e525352323e5a615a50604a51524fffdb0043010e0e0e131113261515264f352d354f4f4f4f4f4f4f4f4f4f4f4f4f4f4f4f4f4f4f4f4f4f4f4f4f4f4f4f4f4f4f4f4f4f4f4f4f4f4f4f4f4f4f4f4f4f4f4f4f4fffc000110800a0005a03012200021101031101ffc4001f0000010501010101010100000000000000000102030405060708090a0bffc400b5100002010303020403050504040000017d01020300041105122131410613516107227114328191a1082342b1c11552d1f02433627282090a161718191a25262728292a3435363738393a434445464748494a535455565758595a636465666768696a737475767778797a838485868788898a92939495969798999aa2a3a4a5a6a7a8a9aab2b3b4b5b6b7b8b9bac2c3c4c5c6c7c8c9cad2d3d4d5d6d7d8d9dae1e2e3e4e5e6e7e8e9eaf1f2f3f4f5f6f7f8f9faffc4001f0100030101010101010101010000000000000102030405060708090a0bffc400b51100020102040403040705040400010277000102031104052131061241510761711322328108144291a1b1c109233352f0156272d10a162434e125f11718191a262728292a35363738393a434445464748494a535455565758595a636465666768696a737475767778797a82838485868788898a92939495969798999aa2a3a4a5a6a7a8a9aab2b3b4b5b6b7b8b9bac2c3c4c5c6c7c8c9cad2d3d4d5d6d7d8d9dae2e3e4e5e6e7e8e9eaf2f3f4f5f6f7f8f9faffda000c03010002110311003f00f4ea290107a1a323d69085a29372fa8a4dcbfde1f9d1601d4526e1ea29a6441d58516184876c6c7d0572ba8c9966adbd46f55612a87ad72d7536e63cd5ad1148a372fd6b3256abd31ce6a9c8849f6acdb0657209a6ec6f7a9c640c633473e953720edd75323f8a90ea87fbc6b99379ef4c3787d6ba6e3b1d3ff691fef527f689cfdeae645ef14e17bef4ae33a61a89c7dea69d409fe2ae73ed9c75a0de1a5719ad75765875aa29fbe936d527bb278ab5a66e9653cb271c11deb39bd009fec593f377a1b4d565c01cd5d05918ab39761d828e2a44370483e4823bfd2b91ce4377b6c631d31c1ea3147f67aff78fe55b8d019db21808c761d697ecb1fbd42a8d9095f5383fb4fbd21b8f7acc12d3bcd5dbd4939f4af446680b8a7098f6aa2afcf39fc2a40c72700d202f2ca4d4884b1e6a9a39238439fad5b80b16c05ddf4349b15cb70c018826b56dd36805783eb546dd2407e74da3b735a11702a1937352d0a6c0768f7fad5c46553c0e0ff3aceb197cb7dac0156eb9abc45b9ced7da7df915c73567a9aa9dc596dd243b94947f55a83ecd37fcfd3d590ae1320075fef29c8a664fa7eb5087caa478e0627b1fca9eaedd306a24948523613918e474e734f5248385af4cccb2a1c755c1ebc9ab111919c63682c71d715591e4c15d9d7ae4d4e85f008da181ef480bb1f9fd37000fb9ab50c6eac98650cdc74aa9019d8800a7e46af88e4588b3b80410410bd2908d282da61cbca303b00055b41c557b7b69ca82676c7a8502ad04f2fe52493ea7bd43112a53a60500707834d4e2a42049198cf39e47d6b392b950766363986e0f14cd1c9df1d0d58fb5deff7a23ee57ad6661812b8c5283363a9ac5c11b382679a0942861bf00f519a9124567e3bf600d3540393fe7ad5ab793cb07e446cf7619aed311d1cc61770109cf1f733fcea48dd89e227fd052f98642090a31e800ab11ed1d48145c092d5e753f242467fdbc569c2269be4911029ea77127a7d2aa417504790648b918f988e2aec7a85a310865400f1f2293fca908bb662f1e318921c038cec24f1c7ad5f4826505e5943e3a00b8aa76574b6ece1e298ef21d422138c8e47d739fceb492ede753b6caedb3c7200feb50c4316a4151fceb8dea55bb8f4a035202d06509bb68dc3da93ce8cf3b054024e0d418e7fd601f81ac6503a6124d6a799c4a73966c8f402a458c127e79064f63ffd6a747222a63cb05b3d493fca95465411fde031f9d75980e8e242392e47bb1ab76f6b0f98aad1af519c8cd538a54545cba838f5ab31dec45c96919dcf7c124d0059867b4b765f39523ca2b0c2fad69dbeb16230a91cae7fd94cd66c6c15d24fb3bb820a8014654678ce6b52daf2e14858ec7a1eaeeabfcb34988d5d2eef76a109292c6b2164db20c1c901871f8115d744108ed5c4335c4ede63f9713aecf2f6b17c1049e781eb8abab77a89c7fa5a27aec8bfc49a86ae23635585565122e086183f51fe7f4acca8cc92bb299aea590039da70067a7403de9db81a4805cfad378ff2690b53777fb5401e72b6ebfc4ee7fe0553c5046872abcfb9a60fad4aa71d6b42891218c1c845cffbb56a222ab29e2a78cd005e89ba77ab91371df359f1be3f1ab3139ff22908d08db03bf153ab5508e43838352acbc0f5a405c0fc53bccec6aa79bcf3d68f373907a521168b8a6799ee7f2aac64fca9be6fb1fce8b01c70e99cd3d7d7dea307f5e2a45e7f9d5944aa7818a990e3afd6a05fba39a9538f4e9401651c01938a991b8e7f1aac0f38248c63fcff009fd2a55f51c73c71480b8ae48ffeb54a9210793d2a9ab640e4134f0c719a045c593de8dfc557df8e46280f8348098bf14bbeabefcf1d69bf37a1a00e7947152a8cfd29a80e462a68d3a63ad5140abf2ff4a99539e7a55cb2d327b93f221c7a9ae8ec7c388b869b93e952e490d45b39886de57e11189ec47d69ef0bc476c8bb4f6cd77c6c62b4b7caa0c9e95cd6b913940fb738350aa5d94e9e97310371ef8029e1b9e3b1e86a2e808ff2280dd39e3b568664e1876cfd28df8f7150e471cfe546e1fe1408977f1d4fd69724f3cd43bb146e1fed50057b4b396e1c2c684fe15d5697e1d45c3cfc9f4f4ad6b1d3e1b58c2a2818abc0e07158ca77d8e88c0486de28140550314edff360546efda985b68c8eb59dcd546c89eea6de02f61597751acb1b291c1156413825aa073d685a16a3a58e32f2130dc3a63a1e38a83776cd6aebf1e1c482b13775ed8ae98bba38a71b3b136eee3f4a4ddc75a8b7e00fd282c3d7f3a641286ebc8c5271e95106e719fc69327d07e5401fffd9, -7.443793, 109.2402553),
('SGA5T', 13, 3, 2, '11', 'accepted', 'Sheptian', 1, '', '', '2018-07-02', '', '', '', 90000, 0, 1530302888, NULL, -6.9226151, 107.58792930000004),
('UUBPR', 13, 4, 2, '8,9', 'order', 'Sheptian', 1, '', '', '2018-07-12', '', '', '', 90000, 0, 1530303415, NULL, -6.9226151, 107.58792930000004);

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `ip_address` varchar(16) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `match_histories`
--

CREATE TABLE `match_histories` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `team_id` mediumint(8) UNSIGNED NOT NULL,
  `rival_id` mediumint(8) UNSIGNED NOT NULL,
  `team_score` mediumint(8) UNSIGNED NOT NULL,
  `rival_score` mediumint(8) UNSIGNED NOT NULL,
  `match_date` date NOT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `status` varchar(20) DEFAULT 'waiting'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `match_histories`
--

INSERT INTO `match_histories` (`id`, `team_id`, `rival_id`, `team_score`, `rival_score`, `match_date`, `created_on`, `status`) VALUES
(107, 3, 4, 58, 63, '2018-07-07', 1530912463, 'waiting'),
(108, 17, 5, 45, 57, '2018-07-07', 1530912529, 'waiting'),
(109, 13, 12, 75, 60, '2018-07-07', 1530912574, 'waiting'),
(110, 14, 16, 44, 41, '2018-07-07', 1530912618, 'waiting'),
(111, 18, 20, 60, 46, '2018-07-07', 1530912650, 'waiting');

-- --------------------------------------------------------

--
-- Table structure for table `match_invitations`
--

CREATE TABLE `match_invitations` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `team_id` mediumint(8) UNSIGNED NOT NULL,
  `rival_id` mediumint(8) UNSIGNED NOT NULL,
  `hall_id` mediumint(8) UNSIGNED NOT NULL,
  `match_date` date NOT NULL,
  `message` text NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'sent',
  `created_on` int(11) UNSIGNED NOT NULL,
  `contact_number` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `match_invitations`
--

INSERT INTO `match_invitations` (`id`, `team_id`, `rival_id`, `hall_id`, `match_date`, `message`, `status`, `created_on`, `contact_number`) VALUES
(114, 3, 4, 3, '2018-07-07', 'ayoo maen gan lawan kita', 'accept', 1530911805, '087825312231'),
(115, 17, 5, 2, '2018-07-07', 'latih tanding yuu gann..', 'accept', 1530911928, '089652553266'),
(116, 13, 12, 4, '2018-07-07', 'zall ayo maen sama tim urang nanti di gor meteorr,  wa aja ya ', 'accept', 1530912011, '087824392239'),
(117, 14, 16, 1, '2018-07-07', 'ayoo maenn', 'accept', 1530912128, '08782233665'),
(118, 18, 20, 2, '2018-07-07', 'maenn yu, bosen maen sendiri mulu hehe', 'accept', 1530912304, '085233326652'),
(119, 13, 3, 3, '2018-08-01', 'battle yu broo..', 'sent', 1533130802, '087824392239');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `version` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`version`) VALUES
(20180520225539);

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `rating_from` mediumint(8) UNSIGNED NOT NULL,
  `team_id` mediumint(8) UNSIGNED NOT NULL,
  `sportsmanship` tinyint(5) UNSIGNED NOT NULL,
  `teamwork` tinyint(5) UNSIGNED NOT NULL,
  `ability` tinyint(5) UNSIGNED NOT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `dayatahan` int(11) NOT NULL DEFAULT '0',
  `strategi` int(11) NOT NULL DEFAULT '0',
  `keterampilan` int(11) NOT NULL DEFAULT '0',
  `kecepatan` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `rating_from`, `team_id`, `sportsmanship`, `teamwork`, `ability`, `created_on`, `dayatahan`, `strategi`, `keterampilan`, `kecepatan`) VALUES
(16, 13, 3, 30, 20, 20, 4294967295, 20, 10, 30, 20),
(17, 13, 4, 10, 10, 30, 4294967295, 10, 30, 20, 30),
(18, 14, 5, 40, 30, 20, 4294967295, 30, 50, 30, 50),
(19, 15, 20, 20, 30, 50, 4294967295, 30, 20, 50, 50),
(20, 16, 16, 50, 20, 20, 4294967295, 20, 30, 30, 20),
(21, 17, 14, 20, 20, 50, 4294967295, 50, 50, 30, 20),
(22, 18, 16, 10, 10, 20, 4294967295, 30, 20, 10, 20),
(23, 19, 17, 30, 20, 10, 4294967295, 20, 30, 20, 20),
(24, 20, 18, 40, 50, 30, 4294967295, 30, 30, 50, 30),
(25, 21, 12, 50, 50, 30, 4294967295, 50, 30, 30, 30);

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` int(11) NOT NULL,
  `range_time` varchar(100) NOT NULL,
  `active` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `created_on` int(11) UNSIGNED NOT NULL DEFAULT '1525009658'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `range_time`, `active`, `created_on`) VALUES
(1, 'Jam 08.00 - 09.00', 1, 1525009658),
(2, 'Jam 09.00 - 10.00', 1, 1525009658),
(3, 'Jam 10.00 - 11.00', 1, 1525009658),
(4, 'Jam 11.00 - 12.00', 1, 1525009658),
(5, 'Jam 12.00 - 13.00', 1, 1525009658),
(6, 'Jam 13.00 - 14.00', 1, 1525009658),
(7, 'Jam 14.00 - 15.00', 1, 1525009658),
(8, 'Jam 15.00 - 16.00', 1, 1525009658),
(9, 'Jam 16.00 - 17.00', 1, 1525009658),
(10, 'Jam 17.00 - 18.00', 1, 1525009658),
(11, 'Jam 18.00 - 19.00', 1, 1525009658),
(12, 'Jam 19.00 - 20.00', 1, 1525009658),
(13, 'Jam 20.00 - 21.00', 1, 1525009658),
(14, 'Jam 21.00 - 22.00', 1, 1525009658);

-- --------------------------------------------------------

--
-- Table structure for table `standings`
--

CREATE TABLE `standings` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `team_id` mediumint(8) UNSIGNED NOT NULL,
  `mp` int(11) NOT NULL DEFAULT '0',
  `w` int(11) NOT NULL DEFAULT '0',
  `wo` int(11) NOT NULL DEFAULT '0',
  `lo` int(11) NOT NULL DEFAULT '0',
  `l` int(11) NOT NULL DEFAULT '0',
  `pts` float NOT NULL DEFAULT '0',
  `ptc` float NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `standings`
--

INSERT INTO `standings` (`id`, `team_id`, `mp`, `w`, `wo`, `lo`, `l`, `pts`, `ptc`) VALUES
(3, 3, 1, 0, 0, 0, 1, 1, 0),
(4, 4, 1, 1, 0, 0, 0, 2, 1),
(5, 5, 1, 1, 0, 0, 0, 2, 1),
(12, 12, 1, 1, 0, 0, 0, 2, 1),
(13, 13, 1, 0, 0, 0, 1, 1, 0),
(14, 14, 1, 1, 0, 0, 0, 2, 1),
(16, 16, 1, 0, 0, 0, 1, 1, 0),
(17, 17, 1, 0, 0, 0, 1, 1, 0),
(18, 18, 1, 1, 0, 0, 0, 2, 1),
(20, 20, 1, 0, 0, 0, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `user_id` mediumint(8) UNSIGNED NOT NULL,
  `active` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `image` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `description` text NOT NULL,
  `image_raw` longblob,
  `address` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `user_id`, `active`, `image`, `name`, `created_on`, `description`, `image_raw`, `address`) VALUES
(3, 6, 1, '1527559906.png', 'BandungRaptors', 1527559906, 'Basketball Team Bandung', NULL, 'Jalan Andir'),
(4, 7, 1, '1527560077.png', 'BimaBasket', 1527560077, 'Basketball Team Bandung', NULL, 'Jalan Astana Anyar'),
(5, 8, 1, '1527560339.png', 'BPJ', 1527560339, 'Basketball Team Bandung', NULL, 'Jalan Aksan'),
(12, 15, 1, '1527560785.png', 'HolisBC', 1527560785, 'Basketball Team Bandung', NULL, 'Jalan Soekarno Hatta'),
(13, 16, 1, '1527560848.png', 'JamikaBC', 1527560848, 'Basketball Team Bandung', NULL, 'Jalan Jamika'),
(14, 17, 1, '1527560904.png', 'KartikaRaya BC', 1527560904, 'Basketball Team Bandung', NULL, 'Jalan Pagarsih'),
(16, 19, 1, '1527561006.png', 'OS CeleresBC', 1527561006, 'Basketball Team Bandung', NULL, 'Jalan Cibadak'),
(17, 20, 1, '1527561056.png', 'PagarsihBC', 1527561056, 'Basketball Team Bandung', NULL, 'Jalan Pagarsih'),
(18, 21, 1, '1527561108.png', 'ParahiyanganBC', 1527561108, 'Basketball Team Bandung', NULL, 'Jalan Merdeka'),
(20, 23, 1, '1527561229.png', 'RatmajaBC', 1527561229, 'Basketball Team Bandung', NULL, 'Jalan Pagarsih');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `ip_address` varchar(16) DEFAULT NULL,
  `password` varchar(80) NOT NULL,
  `salt` varchar(40) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `name` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `addedByAdmin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `password`, `salt`, `username`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `name`, `phone`, `addedByAdmin`) VALUES
(1, '61.5.85.108', '$2y$08$zwJEvbISv6vHHGJkpNtRbuTdzP5U7yzplxMI6lSHMY0lA4nqs/uRa', '', 'gortunas', 'gortunas05@gmail.com', NULL, NULL, NULL, NULL, 1527557768, 1533677251, 1, 'Elen Young Jaya', '(022) 6022221', 0),
(2, '61.5.85.108', '$2y$08$zwJEvbISv6vHHGJkpNtRbuTdzP5U7yzplxMI6lSHMY0lA4nqs/uRa', '', '', 'meteorbasket21@gmail.com', NULL, NULL, NULL, NULL, 1527557953, 1528915008, 1, 'Rayhan Sentosa', '(022) 70200789', 0),
(6, '61.5.85.108', '$2y$08$zwJEvbISv6vHHGJkpNtRbuTdzP5U7yzplxMI6lSHMY0lA4nqs/uRa', '', '', 'ranggajaya15@gmail.com', NULL, NULL, NULL, NULL, 1527559906, 1530912792, 1, 'BandungRaptors', '081546826292', 0),
(7, '61.5.85.108', '$2y$08$zwJEvbISv6vHHGJkpNtRbuTdzP5U7yzplxMI6lSHMY0lA4nqs/uRa', '', '', 'yudisupriatna17@gmail.com', NULL, NULL, NULL, NULL, 1527560077, 1530912457, 1, 'BimaBasket', '081563462249', 0),
(8, '61.5.85.108', '$2y$08$zwJEvbISv6vHHGJkpNtRbuTdzP5U7yzplxMI6lSHMY0lA4nqs/uRa', '', '', 'ilhamjulian10@gmail.com', NULL, NULL, NULL, NULL, 1527560339, 1530912519, 1, 'BPJ', '081572216848', 0),
(15, '61.5.85.108', '$2y$08$zwJEvbISv6vHHGJkpNtRbuTdzP5U7yzplxMI6lSHMY0lA4nqs/uRa', '', '', 'adegunawan889@gmail.com', NULL, NULL, NULL, NULL, 1527560785, 1533479295, 1, 'HolisBC', '089655731381\n', 0),
(16, '61.5.85.108', '$2y$08$zwJEvbISv6vHHGJkpNtRbuTdzP5U7yzplxMI6lSHMY0lA4nqs/uRa', '', '', 'sheptian96@gmail.com', NULL, NULL, NULL, NULL, 1527560848, 1534918477, 1, 'JamikaBC', '087824392239\n', 0),
(17, '61.5.85.108', '$2y$08$zwJEvbISv6vHHGJkpNtRbuTdzP5U7yzplxMI6lSHMY0lA4nqs/uRa', '', '', 'franssurya117@gmail.com', NULL, NULL, NULL, NULL, 1527560904, 1530913092, 1, 'Kartika RayaBC', '089663688809\n', 0),
(19, '61.5.85.108', '$2y$08$zwJEvbISv6vHHGJkpNtRbuTdzP5U7yzplxMI6lSHMY0lA4nqs/uRa', '', '', 'aldoramdan348@gmail.com', NULL, NULL, NULL, NULL, 1527561006, 1530913147, 1, 'OS CeleresBC', '083821229233\n', 0),
(20, '61.5.85.108', '$2y$08$zwJEvbISv6vHHGJkpNtRbuTdzP5U7yzplxMI6lSHMY0lA4nqs/uRa', '', '', 'alvianahjawijaya977@gmail.com', NULL, NULL, NULL, NULL, 1527561056, 1530912871, 1, 'PagarsihBC', '087824440909\n', 0),
(21, '61.5.85.108', '$2y$08$zwJEvbISv6vHHGJkpNtRbuTdzP5U7yzplxMI6lSHMY0lA4nqs/uRa', '', '', 'thariqhidayatullah@gmail.com', NULL, NULL, NULL, NULL, 1527561108, 1530913243, 1, 'ParahiyanganBC', '085720097937\n', 0),
(23, '61.5.85.108', '$2y$08$zwJEvbISv6vHHGJkpNtRbuTdzP5U7yzplxMI6lSHMY0lA4nqs/uRa', '', '', 'gungunawanriyan@gmail.com', NULL, NULL, NULL, NULL, 1527561229, 1530912643, 1, 'RatmajaBC', '082262368997\n', 0),
(999, '61.5.85.108', '$2y$08$zwJEvbISv6vHHGJkpNtRbuTdzP5U7yzplxMI6lSHMY0lA4nqs/uRa', '', '', 'admin@admin.com', NULL, NULL, NULL, NULL, 0, 1534904052, 1, 'Administrator', '000000000', 0),
(1004, '180.246.31.203', '$2y$08$zwJEvbISv6vHHGJkpNtRbuTdzP5U7yzplxMI6lSHMY0lA4nqs/uRa', '', '', 'daudrahmat@gmail.com', NULL, NULL, NULL, NULL, 1527864297, 1534222717, 1, 'daudrahmat', '087824392239', 0),
(1005, '84.240.9.6', '$2y$08$pfcT9AEX6fHLxyz..uN0u.J9VqIS6HhiNnSQ3NRKlGOYkP9kLZtAm', '', '', 'mariio_81@op.pl', NULL, NULL, NULL, NULL, 1533634053, 1533634055, 1, 'Grantentef', '85386612548', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `user_id` mediumint(8) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 2),
(2, 2, 2),
(3, 3, 2),
(4, 4, 3),
(5, 5, 3),
(6, 6, 3),
(7, 7, 3),
(8, 8, 3),
(9, 9, 3),
(10, 10, 3),
(11, 11, 3),
(12, 12, 3),
(13, 13, 3),
(14, 14, 3),
(15, 15, 3),
(16, 16, 3),
(17, 17, 3),
(18, 18, 3),
(19, 19, 3),
(20, 20, 3),
(21, 21, 3),
(22, 22, 3),
(23, 23, 3),
(24, 24, 3),
(25, 25, 3),
(26, 26, 3),
(999, 999, 1),
(1000, 1000, 3),
(1001, 1001, 3),
(1002, 1002, 3),
(1003, 1003, 3),
(1004, 1004, 4),
(1005, 1005, 3),
(1006, 1005, 2);

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address` text NOT NULL,
  `latitude` decimal(10,6) DEFAULT NULL,
  `longitude` decimal(10,6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `name`, `user_id`, `address`, `latitude`, `longitude`) VALUES
(1, 'Gor Tunas Basket', 1, 'Jalan Cibadak, Nyi Empok 40211\r\nKota Bandung', '-6.921345', '107.593028'),
(2, 'Gor Meteor Basket', 2, 'Jl. Peta, Suka Asih Kota Bandung\r\nJawa Barat 40233', '-6.929580', '107.588057'),
(3, 'Grantentef', 1005, 'Piran', '0.000000', '0.000000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `account_no` (`account_no`);

--
-- Indexes for table `broadcasts`
--
ALTER TABLE `broadcasts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `halls`
--
ALTER TABLE `halls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `halls_schedules`
--
ALTER TABLE `halls_schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `match_histories`
--
ALTER TABLE `match_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `match_invitations`
--
ALTER TABLE `match_invitations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `standings`
--
ALTER TABLE `standings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `broadcasts`
--
ALTER TABLE `broadcasts`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `halls`
--
ALTER TABLE `halls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `halls_schedules`
--
ALTER TABLE `halls_schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `match_histories`
--
ALTER TABLE `match_histories`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `match_invitations`
--
ALTER TABLE `match_invitations`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `standings`
--
ALTER TABLE `standings`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1006;

--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1007;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
