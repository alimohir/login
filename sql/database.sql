--
-- Database: `dbUsers`
-- user : admin
-- pass : @Dmin7123

-- --------------------------------------------------------

--
-- Table structure for table `registered_users`
--


CREATE TABLE `registered_users` (
  `id` int(8) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  'code' varchar(8) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

