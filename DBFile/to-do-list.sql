CREATE TABLE `user`
(
    `id`   int primary key not null auto_increment,
    `name` varchar(200)    not null,
    `email` varchar(100)    not null,
    `password` varchar(100)    not null,
    `state` int NOT NULL DEFAULT 0

)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `note`
(
    `id`   int primary key not null auto_increment,
    `title` varchar(200)    not null,
    `details`  varchar(200)    not null,
    `date` varchar(100) not null,
    `is_fav`  int(1)  not null DEFAULT 0,

)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `task`
(
    `id`   int primary key not null auto_increment,
    `title` varchar(200)    not null,
    `details`  varchar(200)    not null,
    `createdAt` varchar(100) not null, 
    `start`  varchar(100)    not null,
    `end`  varchar(100)    not null,
    `is_done`  int(1)  not null DEFAULT 0,
    `is_failed`  int(1)  not null DEFAULT 0,
    `is_important`  int(1)  not null DEFAULT 0,
    `is_inprogress`  int(1)  not null DEFAULT 0,
    `is_trash`  int(1)  not null DEFAULT 0,

)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


