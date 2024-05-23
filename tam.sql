

CREATE TABLE `basket` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `img` varchar(200) NOT NULL,
  `name` varchar(60) NOT NULL,
  `description` varchar(500) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `products` (`id`, `img`, `name`, `description`, `price`) VALUES
(2, '62b5d3ab6b4cd.jpeg', 'Tamagotchi Original', 'Le jouet original des années 90 est de retour : l\'animal de compagnie virtuel Tamagotchi et mascotte de votre enfance est de retour dans son format original.', 20),
(3, '62b608fd188f0.jpeg', 'Tamagotchi Original', 'Le jouet original des années 90 est de retour : l\'animal de compagnie virtuel Tamagotchi et mascotte de votre enfance est de retour dans son format original.', 30),
(4, '62b615285f3ff.jpeg', 'Tamagotchi Original', 'Le jouet original des années 90 est de retour : l\'animal de compagnie virtuel Tamagotchi et mascotte de votre enfance est de retour dans son format original.', 12),
(5, '62b5d3905f99f.jpeg', 'Tamagotchi Original', 'Le jouet original des années 90 est de retour : l\'animal de compagnie virtuel Tamagotchi et mascotte de votre enfance est de retour dans son format original.', 20);




CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role` varchar(16) DEFAULT 'user',
  `firstName` varchar(60) DEFAULT NULL,
  `lastName` varchar(60) DEFAULT NULL,
  `email` varchar(60) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `codePostal` varchar(35) DEFAULT NULL,
  `city` varchar(60) DEFAULT NULL,
  `password` varchar(500) NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



INSERT INTO `users` (`id`, `role`, `firstName`, `lastName`, `email`, `address`, `codePostal`, `city`, `password`, `createdAt`) VALUES

(9, 'admin', NULL, NULL, 'admin@gmail.com', NULL, NULL, NULL, '$argon2id$v=19$m=65536,t=4,p=1$TDdPNVhjTngzUWFGRlBzTg$F4D1vbymH4nUzwVDDpqnTJiOqonKK4nL/GQ+FRYPKcg', '2022-06-24 13:15:59'),
(22, 'user', NULL, NULL, 'test@gmail.com', NULL, NULL, NULL, '$argon2id$v=19$m=65536,t=4,p=1$Nks0cHUvWkx4US43aTEzMA$zkJasKqRO9nU5aZahO9pMsT6Z7sbxh05Rjw2kbO++T0', '2024-05-23 10:41:12');

ALTER TABLE `basket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `basket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;


ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

ALTER TABLE `basket`
  ADD CONSTRAINT `product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

