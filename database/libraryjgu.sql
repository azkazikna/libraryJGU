-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 24, 2022 at 04:52 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `libraryjgu`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id_books` int(11) NOT NULL,
  `code_book` varchar(15) NOT NULL,
  `id_user` int(11) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `language` varchar(255) NOT NULL,
  `pages` int(11) NOT NULL,
  `description` text NOT NULL,
  `cover` varchar(255) NOT NULL,
  `total_comment` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id_books`, `code_book`, `id_user`, `slug`, `author`, `title`, `category`, `language`, `pages`, `description`, `cover`, `total_comment`) VALUES
(36, 'BK001', 1, 'marmut-merah-jambu', 'Raditya Dika', 'Marmut Merah Jambu', '17', 'Indonesia', 221, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In volutpat ultricies quam ac aliquet. Donec efficitur, metus at venenatis accumsan, velit nisl aliquet nisl, ac ultrices odio dui vitae augue. Fusce vestibulum neque ut metus rhoncus luctus. Donec non iaculis ipsum. Vivamus non lacus risus. Aliquam est mauris, pretium ornare leo a, placerat rutrum mi. Praesent feugiat iaculis sem, id consectetur sem aliquet id. Nullam et dictum libero. Praesent consectetur rhoncus tellus, at imperdiet nulla viverra quis. Sed quam felis, venenatis eget tempor nec, sagittis ut quam. Mauris aliquet ipsum et mi tristique elementum.', '630499974abdf.jpg', 1),
(37, 'BK037', 1, 'radikus-(makankakus)', 'Raditya Dika', 'RADIKUS (MAKANKAKUS)', '17', 'Indonesia', 232, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In volutpat ultricies quam ac aliquet. Donec efficitur, metus at venenatis accumsan, velit nisl aliquet nisl, ac ultrices odio dui vitae augue. Fusce vestibulum neque ut metus rhoncus luctus. Donec non iaculis ipsum. Vivamus non lacus risus. Aliquam est mauris, pretium ornare leo a, placerat rutrum mi. Praesent feugiat iaculis sem, id consectetur sem aliquet id. Nullam et dictum libero. Praesent consectetur rhoncus tellus, at imperdiet nulla viverra quis. Sed quam felis, venenatis eget tempor nec, sagittis ut quam. Mauris aliquet ipsum et mi tristique elementum. Etiam suscipit nisi ut ex bibendum ultrices. Mauris non leo eget dolor lacinia rhoncus ut quis nisl. Curabitur vel semper ante. Donec at mattis nulla.', '630499c288bf3.jpg', 0),
(38, 'BK038', 1, 'harry-potter-and-the-deathly-hallows', 'J.K Rowling', 'Harry Potter and The Deathly Hallows', '14', 'English', 232, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In volutpat ultricies quam ac aliquet. Donec efficitur, metus at venenatis accumsan, velit nisl aliquet nisl, ac ultrices odio dui vitae augue. Fusce vestibulum neque ut metus rhoncus luctus. Donec non iaculis ipsum. Vivamus non lacus risus. Aliquam est mauris, pretium ornare leo a, placerat rutrum mi. Praesent feugiat iaculis sem, id consectetur sem aliquet id. Nullam et dictum libero. Praesent consectetur rhoncus tellus, at imperdiet nulla viverra quis. Sed quam felis, venenatis eget tempor nec, sagittis ut quam. Mauris aliquet ipsum et mi tristique elementum. Etiam suscipit nisi ut ex bibendum ultrices. Mauris non leo eget dolor lacinia rhoncus ut quis nisl. Curabitur vel semper ante. Donec at mattis nulla.', '630499ff19650.webp', 1),
(39, 'BK039', 1, 'harry-potter-and-the-sorcerer-stone', 'J.K Rowling', 'Harry Potter and The Sorcerer Stone', '14', 'English', 532, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In volutpat ultricies quam ac aliquet. Donec efficitur, metus at venenatis accumsan, velit nisl aliquet nisl, ac ultrices odio dui vitae augue. Fusce vestibulum neque ut metus rhoncus luctus. Donec non iaculis ipsum. Vivamus non lacus risus. Aliquam est mauris, pretium ornare leo a, placerat rutrum mi. Praesent feugiat iaculis sem, id consectetur sem aliquet id. Nullam et dictum libero. Praesent consectetur rhoncus tellus, at imperdiet nulla viverra quis. Sed quam felis, venenatis eget tempor nec, sagittis ut quam. Mauris aliquet ipsum et mi tristique elementum. Etiam suscipit nisi ut ex bibendum ultrices. Mauris non leo eget dolor lacinia rhoncus ut quis nisl. Curabitur vel semper ante. Donec at mattis nulla.', '6304c2e9a4b21.jpg', 0),
(40, 'BK040', 1, 'harry-potter-and-the-philosopher-stone', 'J.K Rowling', 'Harry Potter and The Philosopher Stone', '14', 'English', 232, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In volutpat ultricies quam ac aliquet. Donec efficitur, metus at venenatis accumsan, velit nisl aliquet nisl, ac ultrices odio dui vitae augue. Fusce vestibulum neque ut metus rhoncus luctus. Donec non iaculis ipsum. Vivamus non lacus risus. Aliquam est mauris, pretium ornare leo a, placerat rutrum mi. Praesent feugiat iaculis sem, id consectetur sem aliquet id. Nullam et dictum libero. Praesent consectetur rhoncus tellus, at imperdiet nulla viverra quis. Sed quam felis, venenatis eget tempor nec, sagittis ut quam. Mauris aliquet ipsum et mi tristique elementum. Etiam suscipit nisi ut ex bibendum ultrices. Mauris non leo eget dolor lacinia rhoncus ut quis nisl. Curabitur vel semper ante. Donec at mattis nulla.', '6304c31c0fd84.jpg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id_category` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `img` varchar(255) NOT NULL,
  `total_book` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id_category`, `name`, `slug`, `description`, `img`, `total_book`) VALUES
(14, 'Fantasy', 'fantasy', 'Fantasy is a genre of literature that features magical and supernatural elements that do not exist in the real world.', '63049831a7679.jpeg', 4),
(15, 'Romance', 'romance', 'The books have a central love story and an emotionally satisfying ending.', '630498946e5e3.jpeg', 0),
(16, 'Adventure', 'adventure', 'Books where the protagonist goes on an epic journey, either personally or geographically.', '630498c49c66d.jpg', 0),
(17, 'Comedy', 'comedy', 'Comedy is a genre of fiction that consists of discourses or works intended to be humorous or amusing by inducing laughter, especially in theatre, film.', '63049ac0a77fa.jpg', 2),
(18, 'History', 'history', 'A genre that is defined by its cultural and historical usage, whose features and definition are formulated from the observation of preexisting literary knowledge.', '63049d10bfaff.jpg', 0),
(19, 'Fanfiction', 'fanfiction', 'Fan fiction or fanfiction is fictional writing written in an amateur capacity by fans, unauthorized by, but based on an existing work of fiction.', '6304c188b38a8.webp', 0);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id_comment` int(11) NOT NULL,
  `id_user` int(5) NOT NULL,
  `id_book` int(5) NOT NULL,
  `comment` text NOT NULL,
  `time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id_comment`, `id_user`, `id_book`, `comment`, `time`) VALUES
(60, 1, 38, 'Hai ini tes komen', '2022-08-23 16:22:36'),
(61, 7, 36, 'buku ini sangat seru dan menarik untuk dibaca', '2022-08-23 16:48:16'),
(62, 1, 40, 'Recommended!', '2022-08-23 19:08:44'),
(63, 1, 40, 'Good Book!', '2022-08-23 19:08:51');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id_history` int(11) NOT NULL,
  `code_transaction` varchar(5) NOT NULL,
  `code_member` varchar(5) NOT NULL,
  `code_book` varchar(5) NOT NULL,
  `transaction_date` varchar(255) NOT NULL,
  `return_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id_history`, `code_transaction`, `code_member`, `code_book`, `transaction_date`, `return_date`) VALUES
(12, 'TR001', 'AG002', 'BK001', '2022-08-23', '2022-08-23');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id_transaction` int(11) NOT NULL,
  `code_transaction` varchar(15) NOT NULL,
  `code_member` varchar(15) NOT NULL,
  `code_book` varchar(15) NOT NULL,
  `transaction_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id_transaction`, `code_transaction`, `code_member`, `code_book`, `transaction_date`) VALUES
(13, 'TR001', 'AG008', 'BK038', '2022-08-23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `code_member` varchar(15) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `slug_user` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `birth` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `img_member` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `total_comment` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `code_member`, `fullname`, `slug_user`, `email`, `password`, `birth`, `gender`, `address`, `img_member`, `role`, `total_comment`) VALUES
(1, 'AG001', 'Azkazikna Ageung Laksana', 'azkazikna-ageung-laksana', 'azkazikna.aal@gmail.com', '$2y$10$lIFW23VE/ixg/MvUIqJVbOJyklvXKDm3zkB.ptqdQz8EIq22bUCYi', '', 'Male', 'Griya Bukit Jaya, Gunung Putri, Kab Bogor', 'azkabuktah.png', 'admin', 3),
(7, 'AG002', 'Muhammad Raihan Alfaiz', 'muhammad-raihan-alfaiz', 'raihanalfaiz80@gmail.com', '$2y$10$igqb1joqmsgK9Q7ANhcO1ePpgXfG.OvuMkCustwImmDFoEmUXIdYS', '2004-07-06', 'Female', 'belakang JGU', '6304a0ec16f5c.jpg', 'member', 1),
(8, 'AG008', 'Annaufal Arifa', 'annaufal-arifa', '20annaufalarifa04@gmail.com', '$2y$10$yuGew1KlBeoJduluwAUPvOEiD8RKYmHcOrYtqe7l/Ge2SIL1ioESS', '2004-04-04', 'Female', 'depok tapi gatau depok mananya lupa dipojok keknya', '6304a316acf55.jpg', 'member', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id_books`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_category`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id_comment`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id_history`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id_transaction`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id_books` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id_comment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id_history` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id_transaction` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
