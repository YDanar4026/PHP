SELECT * FROM `todolist`;


SELECT * FROM `users`;


SHOW CREATE TABLE todolist;

CREATE TABLE `todolist` (
  `todo_id` int(7) NOT NULL AUTO_INCREMENT,
  `todo` varchar(255) NOT NULL,
  `todostatus` int(10) NOT NULL,
  `id` int(7) NOT NULL,
  PRIMARY KEY (`todo_id`)
) 


SHOW CREATE TABLE users;

CREATE TABLE `users` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) 