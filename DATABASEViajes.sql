-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.4.3 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for viajes_db
CREATE DATABASE IF NOT EXISTS `viajes_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `viajes_db`;

-- Dumping structure for table viajes_db.destinations
CREATE TABLE IF NOT EXISTS `destinations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `duration_days` int DEFAULT '7',
  `travel_type` varchar(50) DEFAULT 'Cultural',
  `language` varchar(50) DEFAULT 'Multilingüe',
  `map_embed_url` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table viajes_db.destinations: ~6 rows (approximately)
INSERT INTO `destinations` (`id`, `name`, `description`, `price`, `image_url`, `duration_days`, `travel_type`, `language`, `map_embed_url`) VALUES
	(1, 'París', 'Descubre la ciudad del amor, visita la Torre Eiffel y disfruta de su exquisita gastronomía.', 1200.00, 'https://media.istockphoto.com/id/1665716741/es/foto/vista-a%C3%A9rea-de-par%C3%ADs-francia-con-vistas-a-la-famosa-torre-eiffel-amanecer-al-fondo.jpg?s=612x612&w=0&k=20&c=4CEI6-yDTYhwkWT2EBuIhpUyjTU4BlOhR0d2dLYisbo=', 5, 'Romántico', 'Francés / Guías en Español', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2624.991625693759!2d2.292292615674396!3d48.85837007928746!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66e2964e34e2d%3A0x8ddca9ee380ef7e0!2sTorre%20Eiffel!5e0!3m2!1ses!2ses!4v1678886500000!5m2!1ses!2ses'),
	(2, 'Roma', 'Explora las ruinas del Imperio Romano, el Coliseo y la Ciudad del Vaticano en un viaje inolvidable.', 1100.50, 'https://cms.w2m.com/dam/Sites/Imagenes-TTOO/EUROPA/Italia/Roma/Roma-58.jpg', 7, 'Histórico', 'Italiano / Guías en Español', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2970.434898236758!2d12.490054715441366!3d41.89021017922205!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x132f61b6532013ad%3A0x28f1c82e90850293!2sColiseo!5e0!3m2!1ses!2ses!4v1678886600000!5m2!1ses!2ses'),
	(3, 'Tokio', 'Sumérgete en la vibrante cultura de Japón, desde sus templos ancestrales hasta la modernidad de Shibuya.', 2500.75, 'https://images.pexels.com/photos/2506923/pexels-photo-2506923.jpeg?cs=srgb&dl=pexels-apasaric-2506923.jpg&fm=jpg', 10, 'Moderno y Cultural', 'Japonés / Guías en Inglés', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3240.828236423985!2d139.7394443152586!3d35.68123618019436!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x60188bf90735e95b%3A0x7d028b03a746a48a!2sPalacio%20Imperial%20de%20Tokio!5e0!3m2!1ses!2ses!4v1678886700000!5m2!1ses!2ses'),
	(4, 'Nueva York', 'La ciudad que nunca duerme te espera. Visita Times Square, Central Park y la Estatua de la Libertad.', 1800.00, 'https://p4.wallpaperbetter.com/wallpaper/614/760/18/new-york-usa-skyscrapers-top-view-wallpaper-preview.jpg', 6, 'Urbano', 'Inglés', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.618693041982!2d-73.98785301542845!3d40.74844047932824!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c259a9b3117469%3A0xd134e199a405a163!2sEmpire%20State%20Building!5e0!3m2!1ses!2ses!4v1678886800000!5m2!1ses!2ses'),
	(5, 'China', 'Explora la majestuosidad de la Gran Muralla, un monumento histórico que serpentea a través de paisajes impresionantes.', 1850.00, 'https://www.todofondos.net/wp-content/uploads/1600x900-China-Wallpaper-Full-HD-Imagen-1600-%C3%97-900-Fondo-de-pantalla-de-China-29-1024x576.jpg', 12, 'Aventura Histórica', 'Mandarín / Guías en Inglés', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3080.395729739504!2d116.56846661536645!3d40.3547789793721!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x35f121d7b3210519%3A0x633a6f113828c46!2sSecci%C3%B3n%20Mutianyu%20de%20la%20Gran%20Muralla!5e0!3m2!1ses!2ses!4v1678886900000!5m2!1ses!2ses'),
	(6, 'Egipto', 'Viaja en el tiempo y descubre los misterios de las Pirámides de Giza, una de las siete maravillas del mundo antiguo.', 2150.50, 'https://wallpapers.com/images/featured/imagenes-de-egipto-34oietpzyqb9thrp.jpg', 10, 'Histórico', 'Árabe / Guías en Español', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3456.28892838381!2d31.13201321511364!3d29.97118368190807!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14584f7de239bbcd%3A0xca73a843a14a144!2sPir%C3%A1mides%20de%20Guiza!5e0!3m2!1ses!2ses!4v1678886400000!5m2!1ses!2ses');

-- Dumping structure for table viajes_db.purchases
CREATE TABLE IF NOT EXISTS `purchases` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uuid` char(36) NOT NULL,
  `user_id` int NOT NULL,
  `destination_id` int NOT NULL,
  `purchase_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(50) NOT NULL DEFAULT 'Confirmado',
  `final_price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uuid` (`uuid`),
  KEY `user_id` (`user_id`),
  KEY `destination_id` (`destination_id`),
  CONSTRAINT `purchases_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `purchases_ibfk_2` FOREIGN KEY (`destination_id`) REFERENCES `destinations` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table viajes_db.purchases: ~1 rows (approximately)
INSERT INTO `purchases` (`id`, `uuid`, `user_id`, `destination_id`, `purchase_date`, `status`, `final_price`) VALUES
	(25, '0095c3e7-673d-11f0-a02b-28d2440c8bc0', 12, 4, '2025-07-22 20:46:54', 'Confirmado', 1800.00),
	(26, '0f997e82-6772-11f0-a02b-28d2440c8bc0', 12, 6, '2025-07-23 03:06:43', 'Confirmado', 1.00);

-- Dumping structure for table viajes_db.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uuid` char(36) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(32) NOT NULL,
  `credit_card_number` varchar(20) DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `reset_token` varchar(32) DEFAULT NULL,
  `reset_token_expiry` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `uuid` (`uuid`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table viajes_db.users: ~10 rows (approximately)
INSERT INTO `users` (`id`, `uuid`, `username`, `email`, `password`, `credit_card_number`, `is_admin`, `reset_token`, `reset_token_expiry`) VALUES
	(1, 'ad3ba59c-6735-11f0-a02b-28d2440c8bc0', 'admin', 'admin@viajesseguros.com', '0192023a7bbd73250516f069df18b500', '4242424242424242', 1, NULL, NULL),
	(2, 'ad3bae09-6735-11f0-a02b-28d2440c8bc0', 'carlos', 'carlos@email.com', '7488f9b178dbfa3140a24e90aef6331b', '5555666677778888', 0, NULL, NULL),
	(3, 'ad3bb03c-6735-11f0-a02b-28d2440c8bc0', 'steven', 'hola123@gmail.com', '014436b6640304b2cfad8a43f4aaad1a', '123123123', 0, NULL, NULL),
	(4, 'ad3bb250-6735-11f0-a02b-28d2440c8bc0', 'ashley', 'ashleycorreo@gmai.com', '81dc9bdb52d04dc20036dbd8313ed055', '656565', 0, NULL, NULL),
	(5, 'ad3bb4ba-6735-11f0-a02b-28d2440c8bc0', 'fany', 'fanycorreo@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '7384753948', 0, NULL, NULL),
	(6, 'ad3bb6d1-6735-11f0-a02b-28d2440c8bc0', 'boris', 'boris@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '7676576', 0, NULL, NULL),
	(7, 'ad3bb8b3-6735-11f0-a02b-28d2440c8bc0', 'prueba', 'steven.e.vallejo@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '843030', 0, NULL, NULL),
	(8, 'ad3bba7c-6735-11f0-a02b-28d2440c8bc0', 'luis', 'luis@gmail.com', '4d186321c1a7f0f354b297e8914ab240', '875927598', 0, NULL, NULL),
	(9, 'ad3bbc40-6735-11f0-a02b-28d2440c8bc0', 'Steven Vallejo', 'steven.e.vallejo@gmail.com', '202cb962ac59075b964b07152d234b70', '989349303', 0, NULL, NULL),
	(12, 'ad3bbe08-6735-11f0-a02b-28d2440c8bc0', 'Eduardo', 'eduardo@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '8795834', 0, NULL, NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
