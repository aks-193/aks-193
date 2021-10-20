CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `service_name` varchar(10) NOT NULL,
  `cost` decimal(4,2) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp()
);

ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

INSERT INTO `services` (`id`, `service_name`, `cost`, `created_date`) VALUES
(1, 'Painting', '20.00', '2021-10-17 22:35:24'),
(2, 'Drywall', '45.00', '2021-10-17 22:35:24'),
(3, 'Sheetrock', '33.05', '2021-10-17 22:35:59');

