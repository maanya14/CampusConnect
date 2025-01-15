CREATE TABLE `feedback` (
  `email` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`email`)
);

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_title` varchar(255) NOT NULL,
  `post_tag` varchar(100) DEFAULT NULL,
  `post_meta` varchar(255) DEFAULT NULL,
  `post_date` date DEFAULT NULL,
  `post_image_url` varchar(255) DEFAULT NULL,
  `post_content` text DEFAULT NULL,
  `likes_count` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`post_id`)
);

CREATE TABLE `students` (
  `name` varchar(255) NOT NULL,
  `enrollment` varchar(50) NOT NULL,
  `gsuitid` varchar(255) NOT NULL,
  `gender` enum('male', 'female', 'other') NOT NULL,
  `dob` date NOT NULL,
  `batch` varchar(50) NOT NULL,
  `branch` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`gsuitid`),
  UNIQUE KEY `enrollment` (`enrollment`)
);

INSERT INTO `students` (`name`, `enrollment`, `gsuitid`, `gender`, `dob`, `batch`, `branch`, `password`, `created_at`) VALUES
('Maanya ', '23103240', '23103240@mail.jiit.ac.in', 'female', '2024-12-28', 'b9', 'cse', '$2y$10$ypHf3/6.eXG7YLCJONbGuuhlwI6vp0MAZ6AjzEqcVtV3dNO7GswUa', '2024-12-27 19:30:22'),
('Rishu', '23103246', '23103246@mamil.jiit.ac.in', 'male', '2024-12-28', 'b9', 'cse', '$2y$10$hjBaSAUwrrlWfqYUH69F9OtmdQSx9gJiepAfGQmA7NuXtG65Pxpc.', '2024-12-27 19:22:13'),
('Maanya Gupta', '23103250', '23103250@gmail.com', 'female', '2024-12-28', 'b9', 'cse', '$2y$10$bJRV9yeacSWBDfQfxxrM7.0/jjDoMPsvG7lCt/d98iJK95OOm2SMG', '2024-12-27 19:21:47'),
('Maanya Gupta', '23103252', '23103252@mail.jiit.ac.in', 'female', '2024-12-28', 'b9', 'cse', '$2y$10$RFKZbRI0ZwyWeyteJ2HmQedZHj.5zG185WC6WZdTkwl5R/wiHPKzm', '2024-12-27 19:25:11'),
('swayam', '23103256', '23103256@mail.jiit.ac.in', 'male', '2024-12-28', 'b9', 'cse', '$2y$10$.JlHbYraDGRFQc3h3oN51O1mA0hSnxWZA5HMoZbkWLJRBCY3S4.pi', '2024-12-27 19:30:42'),
('Maanya Gupta', '23103258', '23103258@gmail.com', 'female', '2024-12-28', 'b9', 'cse', '$2y$10$vqyF.FBiuCo7bQuQF5uO4.3e4qU.sEaRejkquo0nn2.882BE.maPa', '2024-12-27 19:14:37');
