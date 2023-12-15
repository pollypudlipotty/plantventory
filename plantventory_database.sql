
--
-- Database: `plantventory`
--
CREATE DATABASE IF NOT EXISTS `plantventory` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `plantventory`;

-- --------------------------------------------------------

--
-- Table structure for table `extensions`
--

CREATE TABLE `extensions` (
  `id` int(11) NOT NULL,
  `name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `extensions`
--

INSERT INTO `extensions` (`id`, `name`) VALUES
(1, '.jpg'),
(2, '.jpeg'),
(3, '.png');

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `id` int(11) NOT NULL,
  `friend1_id` int(11) NOT NULL,
  `friend2_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`id`, `friend1_id`, `friend2_id`, `status`) VALUES
(2, 1, 25, 1),
(3, 2, 1, 1),
(4, 2, 15, 0),
(5, 13, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `picture_data`
--

CREATE TABLE `picture_data` (
  `id` int(11) NOT NULL,
  `plant_id` int(11) NOT NULL,
  `caption` varchar(150) NOT NULL,
  `main` tinyint(1) NOT NULL,
  `extension_id` int(11) NOT NULL,
  `uploaded_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `picture_data`
--

-- --------------------------------------------------------

--
-- Table structure for table `plants`
--

CREATE TABLE `plants` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `since` date NOT NULL,
  `name` varchar(30) NOT NULL,
  `notes` tinytext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
--
-- --------------------------------------------------------

--
-- Table structure for table `plant_types`
--

CREATE TABLE `plant_types` (
  `id` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `water` tinyint(4) NOT NULL,
  `light` tinyint(4) NOT NULL,
  `difficulty` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plant_types`
--

INSERT INTO `plant_types` (`id`, `name`, `water`, `light`, `difficulty`) VALUES
(1, 'Zamioculcas', 1, 2, 1),
(2, 'Aglaonema Chartreuse Pretty', 2, 2, 2),
(3, 'Aglaonema Prestige', 2, 2, 2),
(4, 'Aglaonema Salmon Fantasy', 2, 2, 2),
(5, 'Aglaonema Star Orange', 2, 2, 2),
(6, 'Aglaonema Star Pink', 2, 2, 2),
(7, 'Aglaonema Star Red', 2, 2, 2),
(8, 'Alocasia Frydek', 2, 2, 2),
(9, 'Alocasia Frydek Variegata', 2, 2, 2),
(10, 'Alocasia Heterophylla', 3, 3, 3),
(11, 'Alocasia Macrorrhiza Splash', 3, 3, 3),
(12, 'Alocasia Pink Dragon', 2, 2, 2),
(13, 'Alocasia Polly', 2, 2, 2),
(14, 'Alocasia Red Grey', 2, 2, 2),
(15, 'Alocasia Regal Shield', 2, 2, 3),
(16, 'Alocasia Siberian Tiger', 2, 2, 3),
(17, 'Alocasia Silver Dragon', 2, 2, 2),
(18, 'Alocasia Tigrina Superba', 2, 2, 2),
(19, 'Aloe Desert Diamon', 2, 1, 2),
(20, 'Aloe Paradisicum', 2, 1, 2),
(21, 'Aloe Tribal', 2, 1, 2),
(22, 'Aloe Vera', 2, 1, 2),
(23, 'Amorphorfallus Atroviridis', 1, 2, 3),
(24, 'Amydrium Medium Silver', 2, 2, 2),
(25, 'Anacampseros Rufescens', 2, 1, 1),
(26, 'Anthurium Crystallinum', 2, 2, 3),
(27, 'Anthurium Lilli', 2, 2, 2),
(28, 'Anthurium Plowmanii', 2, 2, 2),
(29, 'Anthurium Silver Blush', 2, 2, 2),
(30, 'Anthurium Zizou', 2, 2, 2),
(31, 'Areca Lutescens', 3, 2, 2),
(32, 'Asplenium Crissie', 2, 2, 2),
(33, 'Asplenium Nidus', 3, 3, 2),
(34, 'Asplenium Osaka', 2, 3, 2),
(35, 'Astrophytum Asterias', 1, 3, 1),
(36, 'Begonia Amphioxus', 2, 3, 2),
(37, 'Begonia Cleopatraea', 2, 3, 2),
(38, 'Begonia Ferox', 2, 3, 2),
(39, 'Begonia Gryphon', 3, 3, 2),
(40, 'Begonia Listrada', 3, 3, 2),
(71, 'Begonia Venosa', 3, 3, 2),
(72, 'Calathea Beauty Star', 3, 2, 2),
(73, 'Calathea Freddie', 3, 2, 2),
(74, 'Calathea Lancifolia', 3, 2, 2),
(75, 'Calathea Makoyana', 3, 2, 2),
(76, 'Calathea Marion', 3, 2, 2),
(77, 'Corokia Cotoneaster', 3, 1, 2),
(78, 'Crassula Hottentot', 3, 1, 1),
(79, 'Calathea Network', 3, 2, 2),
(80, 'Calathea Confusion Electric Shock', 2, 2, 2),
(81, 'Calathea Peacock', 2, 2, 2),
(82, 'Calathea Roseopicta Dottie', 2, 2, 2),
(83, 'Calathea Vittata', 2, 2, 2),
(84, 'Calathea White Star', 2, 2, 2),
(85, 'Callisia Rosato', 2, 1, 3),
(86, 'Ceropegia Woodii', 2, 2, 3),
(87, 'Crassula Perforata', 2, 2, 3),
(88, 'Crassula Swaziensis Vari', 3, 1, 2),
(89, 'Crassula Tarantula', 2, 1, 2),
(90, 'Ctenanthe Amabilis', 2, 2, 3),
(91, 'Ctenanthe Amagris', 2, 2, 3),
(92, 'Ctenanthe Golden Mosaic', 2, 2, 3),
(93, 'Cyperus Alternifolius', 3, 3, 2),
(94, 'Dieffenbachia Mars', 2, 2, 2),
(95, 'Dieffenbachia Vesuvius', 2, 2, 2),
(96, 'Epipremnum Global Green', 3, 2, 2),
(97, 'Epipremnum Marble Green', 3, 2, 2),
(98, 'Epipremnum Marble Queen', 3, 2, 2),
(99, 'Epipremnum N’Joy', 3, 2, 2),
(100, 'Epipremnum N’Joy Gold', 2, 2, 1),
(101, 'Epipremnum Pinnatum', 2, 2, 2),
(102, 'Epipremnum Pinnatum Variegata', 2, 2, 2),
(103, 'Epipremnum Aureum', 3, 2, 1),
(104, 'Epipremnum Cebu Blue', 2, 2, 1),
(105, 'Epipremnum Happy Leaf', 2, 2, 2),
(106, 'Epipremnum Neon', 3, 2, 2),
(107, 'Eulychnia castanea Varispiralis', 3, 2, 1),
(108, 'Euphorbia Cristata ', 2, 1, 1),
(109, 'Ficus Elastica Ruby', 2, 2, 2),
(110, 'Ficus elastica Tineke', 3, 2, 2),
(111, 'Ficus Lyrata', 2, 2, 2),
(112, 'Fittonia', 2, 3, 1),
(113, 'Geogenanthus Midnight Pearl', 2, 2, 3),
(114, 'Gymnocalycium Mihanovichii Variegata ', 2, 1, 1),
(115, 'Gynura', 3, 2, 2),
(116, 'Hoya Australis Lisa', 2, 1, 2),
(117, 'Hoya Burtoniae Variegata', 3, 2, 3),
(118, 'Hoya Carnosa Tricolor', 3, 2, 2),
(119, 'Hoya Curtisii', 3, 2, 3),
(120, 'Hoya Flamingo Dream', 3, 2, 2),
(121, 'Hoya Heuschekeliana Variegata', 3, 2, 3),
(122, 'Hoya Kerrii', 2, 2, 1),
(123, 'Hoya Kerrii Reserse', 2, 1, 1),
(124, 'Hoya Kerrii Splash', 2, 2, 1),
(125, 'Hoya Kerrii Variegata', 2, 2, 1),
(126, 'Hoya Rosita', 3, 2, 2),
(127, 'Hydnophytum Papuanum', 3, 2, 1),
(128, 'Hylocereus Undatus', 3, 2, 1),
(129, 'Ludisia Discolor', 2, 3, 2),
(130, 'Maranta Fascinator', 1, 3, 3),
(131, 'Maranta Kerchoveana Variegata', 1, 3, 2),
(132, 'Maranta Lemon Lime', 1, 3, 2),
(133, 'Maranta Light Veins', 1, 3, 2),
(134, 'Hoya Wayetii', 2, 1, 2),
(135, 'Hoya Wayetii Tricolor', 2, 1, 2),
(136, 'Microsorum Crocodyllus', 2, 3, 2),
(137, 'Monstera Adansonii Monkey Leaf ', 2, 2, 2),
(138, 'Monstera Adansonii', 2, 2, 2),
(139, 'Monstera Deliciosa', 2, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nick` varchar(20) NOT NULL,
  `password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
--
-- Indexes for dumped tables
--

--
-- Indexes for table `extensions`
--
ALTER TABLE `extensions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`),
  ADD KEY `friend1_id` (`friend1_id`),
  ADD KEY `friend2_id` (`friend2_id`);

--
-- Indexes for table `picture_data`
--
ALTER TABLE `picture_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `extension_id` (`extension_id`),
  ADD KEY `plant_id` (`plant_id`);

--
-- Indexes for table `plants`
--
ALTER TABLE `plants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `type_id` (`type_id`);

--
-- Indexes for table `plant_types`
--
ALTER TABLE `plant_types`
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
-- AUTO_INCREMENT for table `extensions`
--
ALTER TABLE `extensions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `picture_data`
--
ALTER TABLE `picture_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `plants`
--
ALTER TABLE `plants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `plant_types`
--
ALTER TABLE `plant_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `friends`
--
ALTER TABLE `friends`
  ADD CONSTRAINT `friend1_id` FOREIGN KEY (`friend1_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `friend2_id` FOREIGN KEY (`friend2_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `picture_data`
--
ALTER TABLE `picture_data`
  ADD CONSTRAINT `picture_data_ibfk_1` FOREIGN KEY (`extension_id`) REFERENCES `extensions` (`id`),
  ADD CONSTRAINT `picture_data_ibfk_2` FOREIGN KEY (`plant_id`) REFERENCES `plants` (`id`);

--
-- Constraints for table `plants`
--
ALTER TABLE `plants`
  ADD CONSTRAINT `plants_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `plants_ibfk_2` FOREIGN KEY (`type_id`) REFERENCES `plant_types` (`id`);
COMMIT;

