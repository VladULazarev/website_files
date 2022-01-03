-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 03, 2022 at 05:34 PM
-- Server version: 5.7.29
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `template`
--

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `id` int(8) NOT NULL,
  `address` varchar(255) NOT NULL,
  `www_address` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `contact_email` varchar(50) NOT NULL,
  `outgoing_mail_server` varchar(50) NOT NULL,
  `mail_box_from_host` varchar(50) NOT NULL,
  `mail_box_password` varchar(50) NOT NULL,
  `smtp` varchar(25) NOT NULL,
  `port` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`id`, `address`, `www_address`, `company_name`, `contact_email`, `outgoing_mail_server`, `mail_box_from_host`, `mail_box_password`, `smtp`, `port`) VALUES
(1, 'Enter full address of your domain like this: \r\nhttps://domain.com or https://www.domain.com\r\nif there is www in your address', 'Enter full address for the header of your mail templates: \r\nwww.domain.com', 'Company Name', 'Contact email, example: admin@domain.com', 'Outgoing Mail Server from your hosting', 'Mail box from your hosting', 'Password for your mail box on hosting', 'ssl', '465');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `user_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `user_ip` varchar(25) DEFAULT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `main_links`
--

CREATE TABLE `main_links` (
  `id` int(10) UNSIGNED NOT NULL,
  `link_url_name` varchar(255) NOT NULL,
  `link_page_name` varchar(255) NOT NULL,
  `link_h1` varchar(255) NOT NULL,
  `link_content` text NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_descr` text NOT NULL,
  `site_map` tinyint(1) DEFAULT '0',
  `last_mods` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `main_links`
--

INSERT INTO `main_links` (`id`, `link_url_name`, `link_page_name`, `link_h1`, `link_content`, `meta_title`, `meta_descr`, `site_map`, `last_mods`) VALUES
(1, 'home', 'Home', 'Welcome!', '', 'Meta title of the home page | Your Domain', 'Meta description of the home page ', 1, '2021-12-27'),
(2, 'contact-us', 'Contact Us', 'Contact Us', '', 'Meta title of the contact page | Your Domain', 'Meta description of the contact page', 1, '2021-12-27'),
(3, 'privacy-policy', 'Privacy Policy', 'Privacy Policy', '', 'Meta title of the privacy policy page | Your Domain', 'Meta description of the privacy policy page', 1, '2021-12-27'),
(4, 'site-map', 'Site Map', 'Site Map', '', 'Meta title of the site map page | Your Domain', 'Meta description of the privacy policy page', 0, '2021-12-27'),
(5, 'subscription-confirmed', 'Subscription Confirmed', 'Subscription Confirmed', '', 'Subscription Confirmed | Your Domain', 'Subscription Confirmed ', 0, '2021-12-27'),
(6, 'already-registered', 'Already registered', 'Already registered', '', 'Already registered | Your Domain', 'Already registered', 0, '2021-12-27'),
(7, 'already-unsubscribed', 'Already Unsubscribed', 'Already Unsubscribed', '', 'Already Unsubscribed | Your Domain', 'Already Unsubscribed', 0, '2021-12-27'),
(8, 'you-unsubscribed', 'You Unsubscribed', 'You Unsubscribed', '', 'You Unsubscribed | Your Domain', 'You Unsubscribed', 0, '2021-12-27'),
(9, 'blog', 'Blog', 'Your Blog', '', 'YourBlog | Your Domain', 'Your Blog', 1, '2021-12-27'),
(10, 'buyer-protection', 'Buyer protection', 'Buyer Protection', '', 'Buyer Protection | Your Domain', 'Buyer Protection', 1, '2021-12-27'),
(11, 'delivery-options', 'Delivery options', 'Delivery Options', '', 'Delivery Options | Your Domain', 'Delivery Options', 1, '2021-12-27'),
(12, 'register', 'Register', 'Register', '', 'Register | Your Domain', 'Register your account and get full access to the site content', 1, '2021-12-27'),
(13, 'sign-in', 'Sign In', 'Sign In', '', 'Sign In | Your Domain', 'Sign in ', 0, '2021-12-27'),
(14, 'already-registered', 'Already registered', 'Already registered', '', 'Already registered | Your Domain', 'Already registered', 0, '2021-12-27'),
(15, 'your-unsubscribed', 'Your unsubscribed', 'Your unsubscribed', '', 'Your unsubscribed | Your Domain', 'Your unsubscribed', 0, '2021-12-27'),
(16, 'registration-confirmed', 'Registration confirmed', 'Registration confirmed', '', 'Registration confirmed | Your Domain', 'Registration confirmed', 0, '2021-12-27'),
(17, 'account', 'Account', 'Your account', '', 'Your Account on | Your Domain', 'Account', 0, '2021-12-27');

-- --------------------------------------------------------

--
-- Table structure for table `reset`
--

CREATE TABLE `reset` (
  `id` int(8) NOT NULL,
  `user_id` tinyint(1) NOT NULL DEFAULT '0',
  `user_login` tinyint(1) NOT NULL DEFAULT '0',
  `user_email` tinyint(1) NOT NULL DEFAULT '0',
  `user_pw` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(8) NOT NULL,
  `login` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `password` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `main_links`
--
ALTER TABLE `main_links`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `id_2` (`id`);

--
-- Indexes for table `reset`
--
ALTER TABLE `reset`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `main_links`
--
ALTER TABLE `main_links`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `reset`
--
ALTER TABLE `reset`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
