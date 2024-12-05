-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 05, 2024 at 03:53 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `turismo`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `obtener_paquetes` ()   BEGIN
	SELECT P.id,D.nombre, D.coordenadas, D.departamento, TP.nombre as tipo_paquete, P.precio_total, P.descripcion, D.imagenes
	FROM paquete P
	INNER JOIN destino D ON P.destino_id = D.id
	INNER JOIN tipo_paquete TP ON P.id_tipo_paquete = TP.id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `obtener_ventas` ()   BEGIN
    SELECT
		V.id,
        U.usuario AS usuario,
        TP.nombre AS tipo_paquete,
        D.destino AS destino,
        D.alojamiento AS alojamiento,
        D.transporte AS transporte,
        D.precio AS precio,
        V.codigo_secreto AS codigo_secreto
    FROM venta V
    INNER JOIN detalle_venta D ON V.id = D.venta_id
    INNER JOIN usuarios U ON V.usuario_id = U.id_usuario
    INNER JOIN paquete P ON V.paquete_id = P.id
    INNER JOIN tipo_paquete TP ON P.id_tipo_paquete = TP.id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `oi_paquete` (IN `paquete_id` INT)   BEGIN
    SELECT     
        D.id,
		P.id as paquete_id,
		P.duracion as p_duracion,
		P.precio_total as p_precio_total,
        TP.nombre AS tp_paquete,
        D.nombre AS d_nombre,
        D.descripcion as d_descripcion,
        D.departamento AS d_departamento,
        D.ubicacion,
        D.coordenadas AS d_coordenadas,
        D.imagenes AS d_imagenes,
        D.clima,
        D.restricciones,
        D.atracciones,
        A.nombre AS a_nombre,
        A.tipo AS a_tipo,
        A.url_maps AS a_url_maps,
        A.ubicacion AS a_ubicacion,
        A.servicios AS a_servicios,
        A.descripcion AS a_descripcion,
        A.imagenes,
        T.tipo AS t_tipo,
        T.codigo AS t_codigo
    FROM paquete P
    INNER JOIN destino D ON P.destino_id = D.id
    INNER JOIN tipo_paquete TP ON P.id_tipo_paquete = TP.id
    INNER JOIN alojamiento A ON P.alojamiento_id = A.id
    INNER JOIN transporte T ON P.transporte_salida = T.id 
    WHERE P.id = paquete_id;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `alojamiento`
--

CREATE TABLE `alojamiento` (
  `id` int NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `departamento` varchar(100) DEFAULT NULL,
  `url_maps` varchar(100) NOT NULL,
  `ubicacion` varchar(255) NOT NULL,
  `capacidad` int NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `calificacion` decimal(3,2) DEFAULT '0.00',
  `servicios` text,
  `disponibilidad` enum('DISPONIBLE','RESERVADO','MANTENIMIENTO','NUEVO') DEFAULT (_utf8mb4'NUEVO'),
  `descripcion` text,
  `imagenes` json DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_actualizacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `alojamiento`
--

INSERT INTO `alojamiento` (`id`, `nombre`, `tipo`, `departamento`, `url_maps`, `ubicacion`, `capacidad`, `precio`, `calificacion`, `servicios`, `disponibilidad`, `descripcion`, `imagenes`, `fecha_creacion`, `fecha_actualizacion`) VALUES
(1, 'Europa', 'HOTEL', 'LA PAZ', 'https://maps.app.goo.gl/bbq7LCRuUYbgFjp46', 'Calle 16 de Julio, Zona Central', 150, '350.00', '0.00', 'Wi-Fi gratuito, gimnasio, restaurante, estacionamiento, servicio de habitaciones, centro de negocios.\r\n\r\n', 'NUEVO', 'Ubicado en el corazón de La Paz, el Hotel Europa ofrece un ambiente cómodo y moderno con vistas panorámicas a la ciudad. Ideal para viajeros de negocios y turismo.', '\"[\\\"35924317.jpg\\\",\\\"169472657.jpg\\\",\\\"202039010.jpg\\\",\\\"0dd71de1-32f4-4b55-91c4-af952f4d4255.webp\\\"]\"', '2024-12-02 00:06:31', '2024-12-02 00:06:31'),
(2, 'Hotel Presidente', 'HOTEL', 'LA PAZ', 'https://maps.app.goo.gl/vpNyWA2XheB1vE2h8', 'Calle Potosí N° 920, esquina con Calle Ayacucho, Zona Central', 200, '400.00', '0.00', 'Piscina cubierta, spa, gimnasio, Wi-Fi gratuito, restaurante internacional, bar panorámico, estacionamiento privado, salones de eventos.', 'NUEVO', 'Elegante y moderno, el Hotel Presidente se encuentra en el centro de La Paz, ofreciendo una estadía de lujo con fácil acceso a los principales atractivos de la ciudad.\r\nTipo: Hotel', '\"[\\\"Hotel-Presidente-Buenos-Aires-Exterior.jpg\\\",\\\"ban_big4.jpg\\\",\\\"DSC_1330-1024x683.jpg\\\"]\"', '2024-12-02 00:35:09', '2024-12-02 00:35:09'),
(3, 'Naira', 'HOSTAL', 'LA PAZ', 'https://maps.app.goo.gl/xnrd1MGbfHATXRtN6', 'Calle Potosí N° 920, esquina con Calle Ayacucho, Zona Central', 150, '80.00', '0.00', ' Wi-Fi gratuito, gimnasio, restaurante, estacionamiento, servicio de habitaciones, centro de negocios.', 'NUEVO', 'Elegante y moderno, el Hotel Presidente se encuentra en el centro de La Paz, ofreciendo una estadía de lujo con fácil acceso a los principales atractivos de la ciudad.', '\"[\\\"310571669.jpg\\\",\\\"c4d3d50a32e4d50110c3bcec4a430cb1.jpg\\\",\\\"image-la-paz-hostal-naira-27.jpg\\\"]\"', '2024-12-02 00:39:02', '2024-12-02 00:39:02'),
(4, 'Ecolodge Cabañas Lago Titicaca', 'CABAÑA', 'LA PAZ', 'https://maps.app.goo.gl/GpvBRpkbe3Sbvgk56', 'Calle 16 de Julio, Zona Central', 100, '150.00', '0.00', 'Wi-Fi gratuito, gimnasio, restaurante, estacionamiento, servicio de habitaciones, centro de negocios.', 'NUEVO', 'Ubicado en el corazón de La Paz, el Hotel Europa ofrece un ambiente cómodo y moderno con vistas panorámicas a la ciudad. Ideal para viajeros de negocios y turismo.', '\"[\\\"486361831.jpg\\\",\\\"486175946.jpg\\\",\\\"images.jpg\\\"]\"', '2024-12-02 00:41:56', '2024-12-02 00:41:56'),
(5, 'Gran Hotel Cochabamba', 'HOTEL', 'COCHABAMBA', 'https://maps.app.goo.gl/boAQZh1mq4AwNiW7A', ' Av. Pando N° 1271, Zona Recoleta', 300, '500.00', '0.00', 'Piscina al aire libre, spa, gimnasio, restaurante gourmet, bar, Wi-Fi gratuito, salones de eventos, estacionamiento, servicio de lavandería.', 'NUEVO', 'Un elegante hotel cinco estrellas con amplias instalaciones, rodeado de hermosos jardines, ideal para viajeros que buscan lujo y confort en Cochabamba.', '\"[\\\"portada-web.jpg\\\",\\\"215366094.jpg\\\",\\\"images.jpg\\\"]\"', '2024-12-02 00:44:21', '2024-12-02 00:44:21'),
(6, 'El Jardin', 'HOSTAL', 'TARIJA', 'https://maps.app.goo.gl/XEaemLwNaQa7q1cp6', 'Calle Bolívar N° 672, Zona Central', 40, '100.00', '0.00', 'Jardines, Wi-Fi gratuito, desayuno incluido, estacionamiento, recepción 24 horas, servicio de lavandería, información turística.', 'NUEVO', 'Un acogedor hostal con un ambiente tranquilo y rodeado de áreas verdes, perfecto para descansar mientras se explora la ciudad de Tarija.', '\"[\\\"79480753.jpg\\\",\\\"images.jpg\\\",\\\"DSC01639.jpg\\\"]\"', '2024-12-02 00:47:34', '2024-12-02 00:47:34'),
(7, 'Los Tajibos Hotel & Convention Center', 'HOTEL', 'SANTA CRUZ', 'https://maps.app.goo.gl/Pb8moyU2TnpkW22W7', 'Av. San Martín N° 455, Equipetrol', 500, '800.00', '0.00', 'Piscina al aire libre, spa, gimnasio, restaurantes, bar, centro de convenciones, Wi-Fi gratuito, transporte al aeropuerto, servicio de habitaciones, club infantil.', 'NUEVO', 'Un exclusivo hotel cinco estrellas con modernas instalaciones y amplios jardines tropicales, ideal para viajeros de negocios y turistas en Santa Cruz.', '\"[\\\"463649496.jpg\\\",\\\"Los_Tajibos_-_Lobby.jpg\\\",\\\"jadin-asia.jpg\\\"]\"', '2024-12-02 00:49:49', '2024-12-02 00:49:49'),
(8, 'Jodanga Backpackers ', 'HOTEL', 'SANTA CRUZ', 'https://maps.app.goo.gl/TaA9QGA1eBLQYCpz8', ' Calle El Fuerte N° 1380, Barrio Los Choferes', 60, '80.00', '0.00', 'Piscina, Wi-Fi gratuito, desayuno incluido, cocina compartida, bar, áreas comunes, alquiler de bicicletas, recepción 24 horas, información turística.', 'NUEVO', 'Un hostal moderno y vibrante, diseñado para mochileros que buscan un ambiente relajado con excelentes instalaciones en Santa Cruz.', '\"[\\\"image-santa-cruz-de-la-sierra-jodanga-backpackers-hostel-1.jpg\\\",\\\"image-santa-cruz-de-la-sierra-jodanga-backpackers-hostel-6.jpg\\\",\\\"Jodanga-Backpackers-Hostel-Santa-Cruz-de-La-Sierra-Room.jpg\\\"]\"', '2024-12-02 00:52:04', '2024-12-02 00:52:04'),
(9, 'El Edén', 'HOTEL', 'LA PAZ', 'https://maps.app.goo.gl/g7H8GifU75eqa4nk9', 'Calle Bolívar N° 777, Zona Central', 150, '400.00', '0.00', ' Piscina cubierta, spa, gimnasio, Wi-Fi gratuito, restaurante, bar, salones para eventos, servicio de habitaciones, estacionamiento privado.', 'NUEVO', 'Un icónico hotel en Oruro que combina lujo y tradición, ideal para turistas y viajeros de negocios que visitan la ciudad.', '\"[\\\"2020-11-2-19.1.42.203_CircuitoFoto.jpg\\\",\\\"1200px-Eden_Hotel_-_La_Falda_-_2010_(1).jpg\\\",\\\"60db901de9633.jpg\\\"]\"', '2024-12-02 00:53:52', '2024-12-02 00:53:52'),
(10, 'Cabañas Colchani', 'HOTEL', 'POTOSI', '', 'Calle Bolívar N° 777, Zona Central', 140, '400.00', '0.00', 'Piscina cubierta, spa, gimnasio, Wi-Fi gratuito, restaurante, bar, salones para eventos, servicio de habitaciones, estacionamiento privado.', 'NUEVO', 'Un icónico hotel en Oruro que combina lujo y tradición, ideal para turistas y viajeros de negocios que visitan la ciudad.', '\"[\\\"166686837.jpg\\\",\\\"331431170.jpg\\\",\\\"331431201.jpg\\\",\\\"nightshots3jaychen.jpg\\\"]\"', '2024-12-02 00:56:39', '2024-12-02 00:56:39'),
(11, 'Cabañas del Río Ibare', 'CABAÑA', 'BENI', 'https://maps.app.goo.gl/VygkLpFPNFTnn9x6A', 'Comunidad de Santa Ana, Río Ibare', 25, '180.00', '0.00', 'Actividades acuáticas, Wi-Fi en áreas comunes, restaurante con comida local, transporte al río, áreas de fogata, senderismo, guías turísticos.', 'NUEVO', 'Un refugio tranquilo y natural, ubicado junto al río Ibare, ideal para aquellos que buscan una escapatoria relajante rodeada de naturaleza en el departamento de Beni.', '\"[\\\"Hotel-Rio-Ibare-Trinidad-Exterior.jpg\\\",\\\"719593828.jpg\\\"]\"', '2024-12-02 01:00:14', '2024-12-02 01:00:14'),
(12, 'Hostal Flor de Moxos', 'HOSTAL', 'BENI', 'https://maps.app.goo.gl/7mnS5FZ1Xm585sXo9', 'Calle Sucre N° 123, Zona Central', 40, '100.00', '0.00', 'Wi-Fi gratuito, desayuno incluido, aire acondicionado, servicio de lavandería, recepción 24 horas, información turística, estacionamiento.', 'NUEVO', 'https://maps.app.goo.gl/7mnS5FZ1Xm585sXo9', '\"[\\\"images.jpg\\\",\\\"images.jpg\\\"]\"', '2024-12-02 01:02:12', '2024-12-02 01:02:12'),
(13, 'Hotel Vaca Diez', 'ALOJAMIENTO', 'PANDO', 'https://maps.app.goo.gl/JzC7KfZTKgHAAoKC8', 'Comunidad Puerto Maldonado, a orillas del Río Madre de Dios', 45, '230.00', '0.00', 'Excursiones en la selva, Wi-Fi en áreas comunes, restaurante con comida local, actividades de pesca y senderismo, transporte desde Puerto Maldonado, guía turístico.', 'NUEVO', 'Un destino perfecto para los amantes de la naturaleza, ubicado cerca de la selva amazónica, ofreciendo una experiencia única de ecoturismo en el corazón de Bolivia.', '\"[\\\"caption.jpg\\\",\\\"caption.jpg\\\"]\"', '2024-12-02 01:06:36', '2024-12-02 01:06:36'),
(14, 'Cabañas Valle de los Cóndores', 'CABAÑA', 'TARIJA', '', 'Valle de los Cóndores, 15 km de la ciudad de Cochabamba', 60, '280.00', '0.00', 'Senderismo, avistamiento de cóndores, Wi-Fi en áreas comunes, restaurante con comida típica, transporte desde Cochabamba, área de fogata, guías turísticos.', 'NUEVO', 'Situadas en un paisaje montañoso y rodeadas de naturaleza, estas cabañas ofrecen una experiencia única de ecoturismo en el Valle de los Cóndores, ideal para desconectar y disfrutar de la tranquilidad.', '\"[\\\"images.jpg\\\",\\\"los-condores.jpg\\\",\\\"los-condores.jpg\\\"]\"', '2024-12-02 01:08:56', '2024-12-02 01:08:56'),
(15, 'Parador Santa María la Real', 'HOTEL', 'CHUQUISACA', 'https://maps.app.goo.gl/xvAES7ae7eA4hGKq6', 'Calle Santa María N° 42, Zona Central, Sucre', 60, '350.00', '0.00', ' Wi-Fi gratuito, restaurante gourmet, bar, desayuno incluido, estacionamiento, servicio de habitaciones, guía turístico, patio interno.', 'NUEVO', 'Un encantador parador histórico ubicado en el corazón de Sucre, que combina arquitectura colonial con comodidades modernas, ofreciendo una estancia única.', '\"[\\\"82251330.jpg\\\",\\\"images.jpg\\\",\\\"Parador-HDR-13-1024x683.jpg\\\"]\"', '2024-12-02 01:13:16', '2024-12-02 01:13:16');

-- --------------------------------------------------------

--
-- Table structure for table `destino`
--

CREATE TABLE `destino` (
  `id` int NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text,
  `ubicacion` varchar(255) DEFAULT NULL,
  `departamento` varchar(100) DEFAULT NULL,
  `coordenadas` varchar(100) DEFAULT NULL,
  `popularidad` int DEFAULT '0',
  `imagenes` json DEFAULT NULL,
  `clima` varchar(50) DEFAULT NULL,
  `temporada_recomendada` varchar(50) DEFAULT NULL,
  `restricciones` text,
  `atracciones` text,
  `fecha_creacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_actualizacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `destino`
--

INSERT INTO `destino` (`id`, `nombre`, `descripcion`, `ubicacion`, `departamento`, `coordenadas`, `popularidad`, `imagenes`, `clima`, `temporada_recomendada`, `restricciones`, `atracciones`, `fecha_creacion`, `fecha_actualizacion`) VALUES
(1, 'Tiquina', 'dsafdsfsadfs', 'San Pedro', 'LA PAZ', 'https://maps.app.goo.gl/zcDdU4kjCDqiUmts8', 0, '\"[\\\"OIP.jpg\\\",\\\"OIP.jpg\\\"]\"', 'CALIDO', '30/11/2024 - 30/11/2024', 'mascostas\r\n', 'VAlle luna', '2024-12-01 02:24:31', '2024-12-01 02:24:31'),
(2, 'xxxxx', 'dsfdsfds', 'fgghfhfg', 'LA PAZ', 'dsfsdfadfasdfas', 0, '\"[\\\"OIP.jpg\\\"]\"', 'CALIDO', '01/12/2024 - 22/12/2024', 'dsfsdfdsfds', 'dfsdfdsf', '2024-12-01 02:30:11', '2024-12-01 18:08:30'),
(3, 'xxxxx', 'asdfadsf', 'dfd', 'LA PAZ', 'dsfsdfadfasdfas', 0, '\"[\\\"ILLIMANI.JPG\\\"]\"', 'CALIDO', '30/11/2024 - 30/11/2024', 'asdfasdf', 'adfadsf', '2024-12-01 02:34:11', '2024-12-01 02:34:11'),
(6, 'Camino De La Muerte', 'El Camino de la Muerte, conocido oficialmente como el Camino a los Yungas, es una de las rutas más emocionantes y desafiantes del mundo. Rodeado de impresionantes paisajes, este destino ofrece adrenalina, historia y naturaleza, ideal para los amantes de la aventura.', 'Conecta la ciudad de La Paz con la región subtropical de los Yungas.', 'LA PAZ', 'https://maps.app.goo.gl/SdFPh5NoaEGA6PAk9', 0, '\"[\\\"from-la-paz-3-day-biking-tour-death-road-uyuni-salt-flats-1429322.jpg\\\",\\\"Bolivia-Death-Road-Photo-credit-Gravity-Bolivia-1-1043x1570.jpg\\\",\\\"Hero-Bolivia-death-road-Photo-credit-Shutterstock-Mezzotint.jpg\\\",\\\"IMG_3261.jpg\\\",\\\"Bolivia-Death-Road-7.jpg\\\"]\"', 'CALIDO', '04/09/2024 - 31/10/2024', 'Actividad no apta para personas con vértigo extremo o problemas cardíacos.\r\nSe requiere equipo de seguridad adecuado y guía certificado para realizar el recorrido.', 'Descenso en bicicleta: Una experiencia única que combina aventura y paisajes espectaculares.\r\nVistas panorámicas: Paisajes que van desde la montaña nevada hasta la selva tropical.\r\nFauna y flora: Avistamiento de especies exóticas en el recorrido.\r\n', '2024-12-01 19:33:47', '2024-12-01 19:33:47'),
(7, 'Illimani', 'El Illimani, con su imponente altura de 6.462 metros, es el guardián de La Paz y un sueño para los amantes del montañismo. Con sus picos cubiertos de nieve eterna, es el lugar perfecto para quienes buscan superar retos y conectarse con la majestuosidad de los Andes.', 'Cordillera Real de los Andes, a unos 70 km al sureste de la ciudad de La Paz.', 'LA PAZ', 'https://maps.app.goo.gl/t1BoMzUm5Gtaz9XR8', 0, '\"[\\\"ab-south-face-illimani-bolivia.jpg\\\",\\\"Iliimani-Andean-Destinations-5.jpg\\\"]\"', 'CALIDO', '10/10/2024 - 14/11/2024', 'Actividad apta únicamente para escaladores con experiencia o acompañados de guías certificados.\r\nSe requiere equipo especializado de montañismo.\r\nNo recomendado para personas con condiciones médicas delicadas o problemas de altura.', 'Cumbres majestuosas: La oportunidad de conquistar la \"cumbre sur\", el punto más alto del Illimani.\r\nVistas inigualables: Panorámicas de los Andes, la ciudad de La Paz y el altiplano boliviano.\r\nRiqueza cultural: Interacción con comunidades locales que viven en las faldas de la montaña.', '2024-12-01 19:49:44', '2024-12-01 19:49:44'),
(8, 'Cerro Tunari Valle Central', 'El Cerro Tunari, el punto más alto de Cochabamba con 5.035 metros, ofrece paisajes impresionantes y condiciones ideales para el parapente. Volar sobre el Valle Central es una experiencia inolvidable que combina adrenalina y belleza natural.', 'Valle Central, a unos 30 km al noroeste de la ciudad de Cochabamba.', 'COCHABAMBA', 'https://maps.app.goo.gl/ETVJ2BwSdhbhLcpG6', 0, '\"[\\\"images.jpg\\\",\\\"images.jpg\\\",\\\"images.jpg\\\"]\"', 'CALIDO', '03/04/2024 - 22/05/2024', 'Actividad no recomendada para personas con vértigo o miedo a las alturas.\r\nSe requiere un instructor certificado para vuelos de principiantes.\r\nEvitar volar en días de vientos fuertes o condiciones climáticas adversas.', 'Vuelo en parapente: La sensación de libertad al sobrevolar montañas y valles.\r\nVistas panorámicas: Impresionantes paisajes del Valle Central, el altiplano y la ciudad de Cochabamba.\r\nContacto con la naturaleza: Flora y fauna andinas en su hábitat natural.', '2024-12-01 20:11:30', '2024-12-01 20:11:30'),
(9, 'Cordillera Real-Illimani', 'La Cordillera Real, hogar del majestuoso Illimani, ofrece paisajes de ensueño y condiciones excepcionales para el parapente. Volar desde esta imponente cadena montañosa te permitirá disfrutar de vistas inigualables de glaciares, valles y la ciudad de La Paz, combinando adrenalina y naturaleza.', 'Cordillera Real, al sureste de la ciudad de La Paz.', 'LA PAZ', 'https://maps.app.goo.gl/VzVKARnRxRWaoMwK8', 0, '\"[\\\"send-phone-59171598293.jpg\\\",\\\"parapente-magndalena.jpg\\\",\\\"images.jpg\\\",\\\"images.jpg\\\"]\"', 'FRIO', '05/12/2024 - 21/01/2025', 'Actividad no apta para personas con vértigo o problemas respiratorios debido a la altura.\r\nRequiere guía o instructor certificado para vuelos seguros.\r\nEvitar realizar la actividad en días de clima inestable o vientos fuertes.', 'Vuelo en parapente: Una experiencia única sobre las montañas y glaciares de la Cordillera Real.\r\nVistas impresionantes: Panorámicas del Illimani, La Paz y el altiplano boliviano.\r\nNaturaleza andina: Avistamiento de fauna local y paisajes únicos.', '2024-12-01 20:15:53', '2024-12-01 20:15:53'),
(10, 'Sajama', 'El majestuoso Nevado Sajama, la montaña más alta de Bolivia con 6.542 metros, es un destino único para practicar snowboard y esquí extremo. Sus laderas nevadas ofrecen una experiencia emocionante para los aventureros que buscan desafiar los límites en un entorno natural impresionante.\r\n\r\n', 'Parque Nacional Sajama, al oeste de Bolivia, cerca de la frontera con Chile.', 'ORURO', 'https://maps.app.goo.gl/nXH5kMMFhXaMJZqy7', 0, '\"[\\\"ab-ski-volcanos-boliva-payachatas.jpg\\\",\\\"andes-brothers-ski-bolivia.jpg\\\",\\\"andes-brothers-ski-bolivia-volcano.jpg\\\",\\\"andes-brothers-ski-boliviaa.jpg\\\"]\"', 'FRIO', '05/12/2024 - 20/01/2025', 'Actividad apta solo para personas con experiencia previa en snowboard o esquí extremo.\r\nRequiere equipo especializado y guía certificado para garantizar la seguridad.\r\nNo apto para personas con problemas respiratorios o cardíacos debido a la altitud extrema.', 'Snowboard y esquí extremo: Descensos emocionantes desde las laderas del Sajama.\r\nPaisajes únicos: Vista de glaciares, valles y la fauna característica del altiplano.\r\nRutas adicionales: Exploración de senderos cercanos y áreas de montaña.', '2024-12-01 20:19:48', '2024-12-01 21:43:22'),
(11, 'Dunas de Lomas de Arena', 'Las Dunas de Lomas de Arena son un paraíso natural que combina paisajes desérticos con vegetación tropical, creando un entorno perfecto para la práctica de sandboarding. Este destino ofrece diversión y aventura para quienes buscan deslizarse sobre inmensas dunas de arena bajo un cielo despejado.', 'A unos 12 km al sur de la ciudad de Santa Cruz de la Sierra, en la Reserva Natural Lomas de Arena.', 'SANTA CRUZ', 'https://maps.app.goo.gl/n1kUeBVoLn8unpaX6', 0, '\"[\\\"lomas-2-1024x678-1.jpg\\\",\\\"Dunas-del-Nihuil-Mendoza-PH-overlandexperience.jpg\\\",\\\"images.jpg\\\"]\"', 'TEMPLADO', '04/09/2024 - 01/10/2024', 'No apto para personas con problemas de movilidad.\r\nSe recomienda llevar protección solar, agua y equipo adecuado para la actividad.\r\nAcceso limitado en temporada de lluvias debido a caminos inundados.', 'Sandboarding: Deslízate por las dunas más altas y disfruta de una experiencia emocionante.\r\nPaisajes únicos: Vista de lagunas temporales, bosques y fauna local.\r\nCaminatas: Exploración de los senderos naturales de la reserva.', '2024-12-01 20:24:00', '2024-12-01 20:24:00'),
(12, 'Coroico-Zongo', 'Coroico y Zongo, ubicados en el corazón de los Yungas, ofrecen algunos de los mejores ríos para practicar rafting y kayak en Bolivia. Rodeados de montañas y selvas tropicales, sus aguas rápidas y caudalosas brindan una experiencia de aventura extrema en medio de un entorno natural espectacular.', 'A aproximadamente 1 hora en coche desde La Paz, en la región de los Yungas.', 'LA PAZ', 'https://maps.app.goo.gl/nXH5kMMFhXaMJZqy7', 0, '\"[\\\"getlstd-property-photo.jpg\\\",\\\"reaf2.jpg\\\",\\\"3raft.jpg\\\",\\\"images.jpg\\\"]\"', 'CALIDO', '05/09/2024 - 08/10/2024', 'Actividad no recomendada para personas con problemas de corazón o movilidad limitada.\r\nRequiere guías expertos y equipo adecuado para la seguridad en los rápidos.\r\nNo apto para personas sin experiencia previa en deportes acuáticos extremos.', 'Rafting: Descensos emocionantes por rápidos de diferentes niveles, ideales tanto para principiantes como para expertos.\r\nKayak: Recorrido por las aguas turbulentas de los ríos Zongo y Coroico en kayak, con vistas impresionantes de los valles y montañas.\r\nPaisajes naturales: Disfruta de la flora y fauna tropical de los Yungas mientras navegas por los ríos.', '2024-12-01 20:28:04', '2024-12-01 21:43:38'),
(13, 'Salar de Uyuni', 'El Salar de Uyuni es el mayor desierto de sal continuo en el mundo, una extensión fascinante de más de 10,000 km² de sal cristalizada que crea un paisaje surrealista. Durante la temporada de lluvias, el salar se convierte en un gigantesco espejo natural, reflejando el cielo de manera impresionante. Este destino es un lugar mágico que atrae a viajeros de todo el mundo para disfrutar de su belleza única y paisajes deslumbrantes.', 'Ubicado en el suroeste de Bolivia, en el altiplano andino.', 'POTOSI', 'https://maps.app.goo.gl/pdpkjNMhf8nKLj4h7', 0, '\"[\\\"visitar-salar-uyuni-4.jpg\\\",\\\"SALAR_1.jpg\\\",\\\"salar-de-uyuni-3-dias-san-pedro-de-atacama-a-uyuni-id209-2-es.jpg\\\",\\\"salar-de-Uyuni-3.jpg\\\"]\"', 'FRIO', '03/10/2024 - 12/11/2024', 'Se recomienda protección solar, gafas y sombrero debido a la exposición al sol reflejado.\r\nLas condiciones de acceso pueden ser difíciles en temporada de lluvias, por lo que es mejor viajar con un guía experimentado.\r\nNo apto para personas con problemas respiratorios, debido a la altitud.', 'Paisajes únicos: Deslumbra con la vastedad y el blanco inmaculado del salar.\r\nIsla Incahuasi: Una isla en medio del salar, famosa por sus enormes cactus y vistas panorámicas.\r\nLagunas y geiseres: Cercanos al salar, las lagunas de colores y los geiseres de Sol de Mañana son un atractivo adicional.', '2024-12-01 20:40:38', '2024-12-01 20:40:38'),
(14, 'Laguna Colorada', 'La Laguna Colorada es una de las joyas naturales de Bolivia, ubicada en la Reserva Nacional de Fauna Andina Eduardo Avaroa. Su agua de color rojo brillante, rodeada de montañas y desiertos, crea un paisaje impresionante. Esta laguna es famosa por ser un hábitat vital para varias especies de flamencos andinos, especialmente el flamenco de James, el flamenco chileno y el flamenco andino. Un lugar único para la observación de fauna y la fotografía en un entorno', 'Ubicada en el suroeste de Bolivia, cerca de la frontera con Chile, en el Altiplano boliviano.', 'POTOSI', 'https://maps.app.goo.gl/3s4TxQz7KDiTxEcv6', 0, '\"[\\\"Laguna_Roja_2.jpg\\\",\\\"LAGUNA-COLORADA-DE-BOLIVIA-1.jpg\\\",\\\"6030819859692969.jpg\\\"]\"', 'FRIO', '15/08/2024 - 10/09/2024', 'Debido a la altitud (más de 4,000 m), se recomienda aclimatarse antes de visitar para evitar el mal de altura.\r\nEl acceso puede ser complicado durante la temporada de lluvias, por lo que se recomienda viajar con guías locales.\r\nNo se permite la cercanía excesiva a los flamencos para evitar alterarlos.', 'Flamencos andinos: La Laguna Colorada es hogar de diversas especies de flamencos, que son el principal atractivo del lugar.\r\nPaisajes sobrecogedores: El contraste entre el agua roja de la laguna y las montañas nevadas es un espectáculo visual impresionante.\r\nExploración natural: Recorridos por el entorno, disfrutando de la flora y fauna autóctona, además de los miradores para avistamiento de aves.', '2024-12-01 20:45:10', '2024-12-01 21:41:31'),
(15, 'Parque Nacional Amboró', 'El Parque Nacional Amboró es uno de los destinos más biodiversos de Bolivia, ubicado en la región de los Yungas y el Chaco. Este parque combina bosques tropicales, montañas, ríos y cascadas, creando un ecosistema único en la región. Con una gran diversidad de flora y fauna, Amboró es un paraíso para los amantes del ecoturismo y la aventura. Es ideal para quienes disfrutan de caminatas, observación de aves, y exploración en la selva.', 'Ubicado en el sureste de Santa Cruz, limitando con los departamentos de Cochabamba y Beni.', 'SANTA CRUZ', 'https://maps.app.goo.gl/8ssRzc4Je57jbZKB7', 0, '\"[\\\"JARDIN-DE-LAS-DELICIAS-1024x692.jpg\\\",\\\"Waterfall_Amboro-National-Park-para-web.jpg\\\",\\\"amboro-national-park-river-guide-trip.jpg\\\",\\\"images.jpg\\\"]\"', 'TEMPLADO', '09/08/2024 - 09/09/2024', 'Se recomienda contratar guías locales para recorrer el parque, debido a su complejidad y biodiversidad.\r\nLas rutas pueden ser difíciles de acceder durante la temporada de lluvias, por lo que es mejor planificar el viaje durante la temporada seca.\r\nNo está permitido el ingreso a ciertas áreas protegidas sin permiso del parque.', 'Observación de flora y fauna: Más de 800 especies de aves y una gran variedad de mamíferos, reptiles y plantas.\r\nCascadas: Diversas cascadas en el parque, como la famosa \"Cascada El Encanto\".\r\nSenderismo y trekking: Varios senderos dentro del parque permiten explorar su increíble biodiversidad', '2024-12-01 20:48:36', '2024-12-01 21:42:37'),
(16, 'Cueva de Murcielagos', 'La Cueva de Murciélagos es un fascinante sistema de cavernas ubicado en la región de Santa Cruz. Esta cueva es famosa por ser hogar de miles de murciélagos que habitan en su interior, creando un espectáculo natural al caer la noche. Además de la colonia de murciélagos, la cueva ofrece formaciones rocosas impresionantes, estalactitas y estalagmitas, lo que la convierte en un destino ideal para los amantes de la espeleología y la aventura.', 'Se encuentra en el municipio de Cuevas, en la provincia de Vallegrande, al sureste de Santa Cruz.', 'SANTA CRUZ', '', 0, '\"[\\\"p1010561.jpg\\\",\\\"26659584Master.jpg\\\",\\\"cuevas-santa-2.jpg\\\",\\\"foto16.jpg\\\",\\\"desde-el-mirador.jpg\\\",\\\"p1010555.jpg\\\"]\"', 'CALIDO', '11/10/2024 - 05/11/2024', 'Se recomienda llevar ropa adecuada para el trekking y linternas para explorar la cueva.\r\nDebido a la presencia de murciélagos, no se recomienda ingresar sin guía o sin las precauciones necesarias.\r\nEl acceso puede ser limitado durante la temporada de lluvias, ya que las rutas pueden volverse difíciles de transitar.', 'Observación de murciélagos: Cada noche, los murciélagos salen en grandes cantidades al anochecer, creando un espectáculo natural impresionante.\r\nFormaciones rocosas: La cueva cuenta con diversas estalactitas y estalagmitas que fascinan a los visitantes.\r\nSenderismo: Rutas de trekking alrededor de la zona para explorar el paisaje montañoso y disfrutar de vistas panorámicas.', '2024-12-01 20:51:53', '2024-12-01 20:51:53'),
(17, 'Parque Nacional Tunari', 'El Parque Nacional Tunari es un impresionante espacio natural ubicado en la cordillera oriental de los Andes, cerca de la ciudad de Cochabamba. Este parque ofrece una combinación única de montañas, valles, bosques y ecosistemas andinos, siendo un lugar ideal para el ecoturismo, senderismo y la observación de flora y fauna. Con diversas rutas de trekking, miradores panorámicos y una rica biodiversidad, el Parque Tunari es un destino perfecto para los aventureros y amantes de la naturaleza.', 'Ubicado al este de la ciudad de Cochabamba, limitando con el municipio de Quillacollo.', 'COCHABAMBA', '', 0, '\"[\\\"osito-2.webp\\\",\\\"parque-nacional-tunari.jpg\\\",\\\"1694464336tunari.jpg\\\"]\"', 'TEMPLADO', '20/10/2024 - 05/11/2024', 'Se recomienda llevar ropa adecuada para trekking y protección solar.\r\nEl parque tiene áreas restringidas para preservar su ecosistema, por lo que es mejor acceder con un guía local.\r\nEn época de lluvias, algunos senderos pueden volverse resbaladizos, por lo que se debe tener precaución.', 'Trekking y senderismo: Varios senderos que permiten explorar el parque y disfrutar de su biodiversidad.\r\nMiradores panorámicos: Vistas espectaculares de la ciudad de Cochabamba y la cordillera del Tunari.\r\nFlora y fauna: Gran diversidad de especies, incluyendo flora andina, aves, mamíferos y reptiles.', '2024-12-01 20:57:01', '2024-12-01 20:57:01'),
(18, 'Parque Nacional Tunari ', 'El Parque Nacional Tunari es un impresionante espacio natural ubicado en la cordillera oriental de los Andes, cerca de la ciudad de Cochabamba. Este parque ofrece una combinación única de montañas, valles, bosques y ecosistemas andinos, siendo un lugar ideal para el ecoturismo, senderismo y la observación de flora y fauna. Con diversas rutas de trekking, miradores panorámicos y una rica biodiversidad, el Parque Tunari es un destino perfecto para los aventureros y amantes de la naturaleza.', 'Ubicado al este de la ciudad de Cochabamba, limitando con el municipio de Quillacollo.', 'COCHABAMBA', 'https://maps.app.goo.gl/RtZTT2YcVoF4PmM16', 0, '\"[\\\"96b5bd_01178367a81149afad5a10fb06d8b041~mv2.webp\\\",\\\"parque-nacional-tunari.jpg\\\",\\\"tunari.jpg\\\",\\\"osito-2.webp\\\"]\"', 'TEMPLADO', '18/10/2024 - 21/11/2024', 'Se recomienda llevar ropa adecuada para trekking y protección solar.\r\nEl parque tiene áreas restringidas para preservar su ecosistema, por lo que es mejor acceder con un guía local.\r\nEn época de lluvias, algunos senderos pueden volverse resbaladizos, por lo que se debe tener precaución.', 'Trekking y senderismo: Varios senderos que permiten explorar el parque y disfrutar de su biodiversidad.\r\nMiradores panorámicos: Vistas espectaculares de la ciudad de Cochabamba y la cordillera del Tunari.\r\nFlora y fauna: Gran diversidad de especies, incluyendo flora andina, aves, mamíferos y reptiles.', '2024-12-01 21:00:29', '2024-12-01 21:00:29'),
(19, 'Parque Nacional Carrasco', 'El Parque Nacional Carrasco es uno de los parques más grandes y biodiversos de Bolivia, ubicado en la vertiente oriental de los Andes. Este parque abarca diversas zonas ecológicas, desde los valles subtropicales hasta las cumbres de las montañas, ofreciendo un paisaje único de selvas y bosques. Es un lugar ideal para el ecoturismo, la observación de fauna y flora, y actividades como el senderismo. En su interior, se pueden encontrar especies endémicas y una rica variedad de ecosistemas.', 'Se encuentra al este de Cochabamba, abarcando también parte del departamento de Santa Cruz.', 'COCHABAMBA', 'https://maps.app.goo.gl/xYvFN3g4m24YQMb8A', 0, '\"[\\\"carrasco.jpg\\\",\\\"parque-carrasco-1.jpg\\\",\\\"Portadas-Amazonas-Parque-Nacional-Carrasco.jpg\\\",\\\"images.jpg\\\",\\\"Captura-de-Pantalla-2020-10-29-a-las-19.20.34.webp\\\"]\"', 'CALIDO', '18/10/2024 - 21/11/2024', 'Se recomienda contratar guías locales para recorrer el parque debido a su tamaño y la complejidad de sus senderos.\r\nEl acceso a algunas áreas puede estar restringido para proteger la biodiversidad.\r\nEs importante llevar ropa adecuada para las caminatas, así como repelente de insectos y protección solar.', 'Biodiversidad natural: Es un paraíso para la observación de flora y fauna, con más de 800 especies de plantas y una gran variedad de animales, incluidos monos, jaguares y osos de anteojos.\r\nSenderismo y trekking: El parque cuenta con varios senderos que permiten explorar las selvas y bosques tropicales.\r\nCascadas y ríos: Hermosas cascadas como la \"Cascada de la Chonta\" y ríos cristalinos que atraviesan el parque.', '2024-12-01 21:05:08', '2024-12-01 21:05:08'),
(20, 'Cerro Rico', 'El Cerro Rico de Potosí es uno de los destinos turísticos más emblemáticos de Bolivia, famoso por su historia minera y su riqueza cultural. Durante siglos, el cerro ha sido una fuente de recursos minerales, especialmente plata, lo que le otorgó una gran importancia durante la época colonial. Hoy en día, el cerro sigue siendo un sitio de gran valor histórico y cultural, con visitas guiadas que permiten conocer las minas que aún se explotan. Además, es un excelente lugar para aprender sobre la historia de Potosí, un sitio Patrimonio de la Humanidad de la UNESCO.', 'Ubicado en la ciudad de Potosí, al sur de Bolivia, a unos 4.070 metros sobre el nivel del mar.', 'POTOSI', 'https://maps.app.goo.gl/rxGgecbgeGvoUFKL7', 0, '\"[\\\"Cerro_ricco.jpg\\\",\\\"vista-cel-cerro-dai-tetti.jpg\\\",\\\"Minas-Cerro-Rico-Potosí..jpg\\\",\\\"Minas-de-Potosi-Bolivia-3.jpg\\\",\\\"IMG_20190929_123835.jpg\\\"]\"', 'SECO', '09/10/2024 - 31/10/2024', 'Debido a las condiciones de trabajo en las minas, se recomienda tomar precauciones, como llevar ropa adecuada, botas y equipo de protección que generalmente es proporcionado en los tours.\r\nNo se recomienda la visita a las minas para personas con problemas respiratorios o cardíacos debido a la altura y las condiciones dentro de las minas.\r\nEs importante seguir las indicaciones de los guías para garantizar la seguridad durante la visita.', 'Turismo en las minas: Visitas guiadas a las minas de plata del Cerro Rico, donde los turistas pueden explorar las galerías y conocer de cerca el proceso minero tradicional.\r\nVista panorámica de la ciudad de Potosí: Desde la cima del cerro se pueden obtener impresionantes vistas de la ciudad y el valle circundante.\r\nHistoria y cultura de Potosí: El cerro es un símbolo de la historia de Bolivia y su contribución a la economía mundial durante la época colonial.\r\n', '2024-12-01 21:09:28', '2024-12-01 21:09:28'),
(21, 'Reserva Nacional de Fauna Andina Eduardo Avaroa.', 'La Reserva Nacional de Fauna Andina Eduardo Avaroa es un paraíso natural ubicado en el altiplano boliviano, conocida por su impresionante biodiversidad y paisajes sobrecogedores. Este parque es famoso por ser hogar de especies endémicas de fauna andina, como la vicuña, el flamenco andino y el suri. Además, el paisaje es una mezcla única de altiplanos, lagunas salinas, géiseres y formaciones rocosas que parecen sacadas de otro mundo. Es uno de los destinos más visitados en Bolivia por los amantes de la naturaleza y la fotografía.', 'Ubicada en el suroeste de Bolivia, cerca de la frontera con Chile, en la región de los Andes.', 'POTOSI', 'https://maps.app.goo.gl/G6fhR9DZacKV8m5B9', 0, '\"[\\\"Laguna_Verde_from_Licancabur.jpg\\\",\\\"vicuna-02.jpg\\\",\\\"laguna-verde-fototeca-rea-1-1-scaled.jpg\\\",\\\"WhatsApp-Image-2021-11-12-at-10.01.57.jpg\\\",\\\"eb6db459c26cde2d236dcfd5b06cb843.webp\\\",\\\"arbol-de-piedra-fototeca-REA-1-scaled.jpg\\\"]\"', 'SECO', '09/10/2024 - 31/10/2024', 'Se recomienda llevar ropa de abrigo y protección solar debido a las condiciones extremas de temperatura y radiación.\r\nAlgunas áreas son de difícil acceso y solo pueden ser visitadas con guías locales.\r\nEl acceso está restringido durante la temporada de lluvias, cuando las rutas pueden volverse intransitables.', 'Flamencos y fauna andina: La reserva es un santuario para varias especies de flamencos, y también alberga vicuñas, guanacos, zorros y más.\r\nEl Volcán Licancabur: Situado cerca de la Laguna Verde, este volcán es uno de los puntos más altos de la región y una vista impresionante.\r\nFormaciones geológicas: El parque es hogar de extrañas y bellas formaciones rocosas, como el Árbol de Piedra y las rocas esculpidas por el viento en el Desierto de Siloli.', '2024-12-01 21:13:42', '2024-12-01 21:13:42'),
(22, 'Parque Nacional Madidi', 'El Parque Nacional Madidi es uno de los parques más biodiversos del mundo, ubicado en la región amazónica de Bolivia, en el departamento de Beni. Con una extensión que abarca desde los Andes hasta la cuenca del Amazonas, este parque es hogar de miles de especies de flora y fauna, muchas de las cuales son endémicas. Es un destino ideal para los amantes de la naturaleza, el ecoturismo y la observación de vida silvestre, ofreciendo una experiencia única de inmersión en uno de los ecosistemas más prístinos del planeta.', 'Ubicado en el norte del departamento de Beni, en la región amazónica de Bolivia, entre las cuencas de los ríos Tuichi, Beni y Tahuamanu.', 'BENI', 'https://maps.app.goo.gl/BvQpcz8tw3ugbyWo9', 0, '\"[\\\"Parque-Nacional-Madidi-min.jpg\\\",\\\"2023080420063164162.jpg\\\",\\\"madidiZ22.jpg\\\",\\\"New-P-Madidi-4.jpg\\\",\\\"rure.jpg\\\",\\\"images.jpg\\\"]\"', 'CALIDO', '', 'Las visitas deben ser guiadas por expertos locales debido a las complejidades del terreno y la biodiversidad del parque.\r\nEl acceso es más difícil durante la temporada de lluvias, ya que algunas rutas se vuelven intransitables.\r\nSe recomienda llevar ropa ligera, repelente de insectos, protección solar y calzado adecuado para caminatas en la selva.', 'Ubicado en el norte del departamento de Beni, en la región amazónica de Bolivia, entre las cuencas de los ríos Tuichi, Beni y Tahuamanu.\r\nSenderismo en la selva: Los visitantes pueden realizar caminatas guiadas para explorar la exuberante selva tropical y sus ecosistemas.', '2024-12-01 21:18:15', '2024-12-01 21:18:15'),
(23, 'Rurrenabaque', 'Rurrenabaque es una pequeña ciudad ubicada en el corazón de la región amazónica de Bolivia, conocida por su acceso a la biodiversidad única de la zona. Es un destino ideal para quienes buscan una experiencia cercana a la naturaleza, con la oportunidad de interactuar con la fauna local. En Rurrenabaque, los turistas pueden visitar áreas protegidas donde se permite alimentar a algunos animales en su hábitat natural y participar en actividades de ecoturismo. Es un lugar perfecto para quienes buscan explorar la jungla tropical, observar la fauna y disfrutar de la tranquilidad de la Amazonía.', 'Situada en el norte del departamento de Beni, en la región amazónica de Bolivia, Rurrenabaque está a orillas del río Beni.', 'BENI', 'https://maps.app.goo.gl/tZbjTTSYZBwaCi1Q9', 0, '\"[\\\"madidi.jpg\\\",\\\"rurrenabaque-02.jpg\\\",\\\"Rurrenabaque-5-850x566.jpg\\\",\\\"7d1f7598a891b56073a85a572e153133.webp\\\",\\\"015.jpg\\\",\\\"images.jpg\\\"]\"', 'CALIDO', '09/10/2024 - 31/10/2024', 'Algunas actividades de interacción con la fauna están sujetas a regulaciones locales para evitar el daño a los ecosistemas y el bienestar de los animales.\r\nSe recomienda siempre ser acompañado por guías locales, quienes conocen las costumbres y normas del lugar.\r\nDebido al clima tropical, es esencial llevar ropa adecuada, repelente de insectos y protección solar.', 'Observación de fauna amazónica: Los turistas pueden disfrutar de una experiencia única al acercarse a animales como monos, tucanes, caimanes, delfines de río y más. En algunas zonas, se permite interactuar y alimentar a ciertos animales, siempre respetando el entorno natural.\r\nExcursiones en bote: Navegar por el río Beni y otros cuerpos de agua cercanos permite observar la fauna local en su hábitat natural.\r\nSenderismo en la selva: Las caminatas guiadas por la jungla amazónica ofrecen una oportunidad para ver de cerca la biodiversidad, incluyendo plantas medicinales, insectos, aves y mamíferos.', '2024-12-01 21:25:41', '2024-12-01 21:25:41'),
(24, 'Ruta del Vino', 'La Ruta del Vino de Tarija es un recorrido único por una de las regiones vinícolas más importantes de Bolivia. Esta ruta ofrece a los visitantes la oportunidad de explorar los viñedos, bodegas y paisajes espectaculares de Tarija, donde se produce una variedad de vinos de renombre. A lo largo de este recorrido, los turistas pueden disfrutar de catas de vino, aprender sobre el proceso de vinificación y sumergirse en la rica cultura y tradiciones de la zona. La región es conocida por su clima favorable, que permite la producción de vinos de alta calidad.', 'La Ruta del Vino recorre las zonas vinícolas en los alrededores de la ciudad de Tarija, ubicada en el sur de Bolivia, incluyendo las áreas de Valle de la Concepción, Valle de los Cintis y otros valles cercanos.', 'TARIJA', 'https://maps.app.goo.gl/YrkHEQH6HqqnMqdx9', 0, '\"[\\\"c0471770aea935c157a9b76ba384b7ad_XL.jpg\\\",\\\"caption.jpg\\\",\\\"images.jpg\\\",\\\"CASA-MUSEO-DE-EUSTAQUI-MÉNDEZ-TARIJA.jpg\\\",\\\"b9QdEhHSvBxHshPGAJbn.jpg\\\",\\\"rutaRiojaAlta.jpg\\\"]\"', 'TEMPLADO', '04/11/2024 - 21/11/2024', 'Algunas bodegas pueden requerir reservas previas para las visitas y catas.\r\nEs importante beber con moderación y respetar las costumbres locales.\r\nDurante la temporada de cosecha, algunas áreas pueden estar más concurridas debido a los turistas que asisten al Festival de la Vendimia.', 'Visita a las bodegas: Recorrido por varias bodegas familiares y grandes productores para conocer el proceso de vinificación y degustar diferentes tipos de vinos.\r\nCatas de vino: Oportunidad de probar los vinos locales, como el vino Tarija, conocido por su calidad y su sabor afrutado.\r\nPaisajes de viñedos: Disfrute de los hermosos paisajes de los valles andinos y sus plantaciones de uvas, rodeados de montañas y naturaleza.', '2024-12-01 21:33:42', '2024-12-01 21:33:42'),
(25, 'Copacabana ', 'Copacabana es una pintoresca ciudad ubicada a orillas del Lago Titicaca, considerada uno de los destinos turísticos más importantes de Bolivia. Con su mezcla de belleza natural, espiritualidad y cultura, Copacabana es conocida por ser un lugar de peregrinaje, especialmente debido a la famosa Virgen de Copacabana, patrona de Bolivia. Además de su ambiente tranquilo y sereno, los turistas pueden disfrutar de actividades como paseos en bote, caminatas, y exploraciones de islas cercanas, como la Isla del Sol, un sitio lleno de historia y leyendas.', 'Situada en la orilla sur del Lago Titicaca, en el departamento de La Paz, Copacabana está a aproximadamente 158 km de la ciudad de La Paz.', 'LA PAZ', 'https://maps.app.goo.gl/BcDrE2dt7BDfnm1PA', 0, '\"[\\\"Copacabana,_Bolivia_at_sunset.jpg\\\",\\\"unnamed.jpg\\\",\\\"Copacabana-bolivia.jpg\\\",\\\"Santuario_de_Copacabana.jpg\\\",\\\"images.jpg\\\",\\\"images.jpg\\\"]\"', 'FRIO', '04/11/2024 - 21/11/2024', 'Debido a la altitud (aproximadamente 3,800 metros sobre el nivel del mar), algunos visitantes pueden experimentar mal de altura.\r\nEl acceso a las islas del Lago Titicaca se realiza principalmente por bote, por lo que los horarios y las rutas pueden estar sujetos a condiciones meteorológicas.\r\nSe recomienda llevar ropa ligera pero abrigada para las variaciones de temperatura, además de protección solar para el día.', 'Virgen de Copacabana: El santuario dedicado a la Virgen de Copacabana es un sitio de devoción y un destino espiritual para los turistas que buscan conocer más sobre la cultura y la religión local.\r\nLago Titicaca: Se pueden realizar paseos en bote por el lago, visitando la Isla del Sol y la Isla de la Luna, donde se pueden explorar ruinas preincaicas y disfrutar de paisajes impresionantes.\r\nMirador de Copacabana: Un mirador natural ofrece una vista panorámica espectacular del Lago Titicaca y la ciudad de Copacabana.', '2024-12-01 21:39:46', '2024-12-01 21:39:46'),
(26, 'Mirador de los Sueños', 'El Mirador de los Sueños es un espectacular punto de vista ubicado en Tarija, desde donde se puede observar toda la ciudad y sus alrededores. Este mirador es famoso por sus impresionantes panorámicas del Valle de Tarija, las montañas y los viñedos de la región. Además de su belleza natural, el lugar es conocido por su ambiente tranquilo y relajante, siendo ideal para una caminata ligera, disfrutar del atardecer o simplemente contemplar el paisaje. El Mirador de los Sueños es un lugar perfecto para aquellos que buscan un espacio de conexión con la naturaleza y una vista privilegiada del valle y la ciudad.', 'Se encuentra a unos pocos kilómetros del centro de la ciudad de Tarija, en la zona alta, desde donde se tienen vistas panorámicas del valle de Tarija y sus alrededores.', 'TARIJA', 'https://maps.app.goo.gl/XHKfQkFwZSWeEHvc8', 0, '\"[\\\"images.jpg\\\",\\\"1c140722-4878-4026-a387-05c1cf086d5e.jpg\\\"]\"', 'TEMPLADO', '01/02/2024 - 25/02/2024', 'El acceso al mirador puede ser algo empinado, por lo que se recomienda tener buen calzado si se va a realizar una caminata hacia el lugar.\r\nDurante la temporada de lluvias (noviembre a marzo), las condiciones del camino pueden volverse resbaladizas, por lo que es importante tener precaución.', 'Vistas panorámicas: El Mirador de los Sueños es ideal para disfrutar de las vistas de la ciudad de Tarija, los viñedos y los paisajes montañosos circundantes.\r\nCaminatas y senderismo: Se pueden realizar caminatas hacia el mirador, disfrutando de la naturaleza y de la tranquilidad del lugar.\r\nFotografía de paisajes: El mirador es un excelente punto para los amantes de la fotografía, especialmente durante el atardecer, cuando los colores del cielo se reflejan en las montañas.', '2024-12-01 22:03:56', '2024-12-01 22:03:56'),
(27, 'Viñedos Aranjuez', 'Los Viñedos Aranjuez son una de las principales bodegas de vino en la región de Tarija, reconocida por producir vinos de alta calidad. Situados en el Valle de la Concepción, esta bodega ofrece una experiencia completa para los amantes del vino, combinando tradición, innovación y un entorno natural impresionante. Los viñedos cuentan con una variedad de uvas que dan lugar a vinos reconocidos, y los visitantes pueden disfrutar de recorridos guiados donde aprenderán sobre el proceso de vinificación, además de degustar diferentes tipos de vino mientras disfrutan de las hermosas vistas de los viñedos y las montañas que rodean la zona.', 'El Viñedo Aranjuez se encuentra en el Valle de la Concepción, a unos 20 minutos en coche de la ciudad de Tarija.', 'TARIJA', 'https://maps.app.goo.gl/18bMrUVJVBnQfvp96', 0, '\"[\\\"Enoturismo-Tarija-Vinos-Aranjuez-025.jpg\\\",\\\"Enoturismo-Tarija-Vinos-Aranjuez-028.jpg\\\",\\\"bg-body-2.jpg\\\",\\\"images.jpg\\\"]\"', 'TEMPLADO', '03/04/2025 - 27/04/2025', 'Se recomienda hacer reservas previas para las visitas guiadas y catas, especialmente durante la temporada alta de turismo.\r\nDebido a la altitud (aproximadamente 1,800 metros sobre el nivel del mar), algunas personas pueden experimentar mal de altura si no están acostumbradas.\r\nDurante la temporada de lluvias (noviembre a marzo), las condiciones climáticas pueden afectar las rutas hacia los viñedos.', 'Recorrido por los viñedos: Los visitantes pueden hacer un recorrido guiado por los viñedos, conociendo los diferentes tipos de uvas que se cultivan y el proceso de producción del vino.\r\nCata de vinos: La bodega ofrece catas de vino, donde los turistas pueden degustar varios tipos de vino, desde los más suaves hasta los más robustos.\r\nPaisajes naturales: La zona cuenta con impresionantes vistas del Valle de la Concepción y de las montañas circundantes, ideales para relajarse y disfrutar del paisaje.', '2024-12-01 22:08:54', '2024-12-01 22:08:54'),
(28, 'Castillo Azul', 'El Castillo Azul es una joya arquitectónica ubicada en las afueras de la ciudad de Tarija. Conocido por su estilo único y sus hermosos jardines, este castillo es uno de los principales atractivos turísticos de la región. El castillo fue construido a principios del siglo XX y está rodeado de una historia fascinante que involucra leyendas y su uso como un centro cultural. Los visitantes pueden explorar su estructura y admirar su diseño, que fusiona elementos de arquitectura europea con toques locales. El Castillo Azul es un lugar ideal para aquellos que buscan conocer un poco más de la historia de Tarija mientras disfrutan de un entorno tranquilo y pintoresco.', 'A unos 10 kilómetros al este de la ciudad de Tarija, en la zona de San Lorenzo.', 'TARIJA', 'https://maps.app.goo.gl/gn6RRcffatK6maUD7', 0, '\"[\\\"Castillo_Azul_Tarija_Bolivia.jpg\\\",\\\"CASA-AZUL.jpg\\\"]\"', 'TEMPLADO', '06/05/2025 - 30/05/2025', 'Se recomienda realizar una visita guiada, ya que el acceso al interior del castillo es limitado y las historias detrás de cada espacio son fascinantes.\r\nEn épocas de lluvia, el acceso a los jardines puede verse afectado por el barro y las condiciones del terreno.\r\nAlgunas áreas del castillo pueden no ser accesibles para personas con movilidad reducida debido a la antigüedad de la estructura.', 'Recorrido por el castillo: Los visitantes pueden explorar el interior del Castillo Azul, conociendo su historia, sus habitaciones decoradas y su arquitectura única.\r\nJardines del castillo: El castillo cuenta con amplios jardines donde se pueden disfrutar vistas panorámicas del Valle de Tarija y relajarse en un entorno natural.\r\nEventos culturales: En el Castillo Azul se realizan eventos culturales, conciertos y exposiciones, lo que lo convierte en un centro de arte en la región.', '2024-12-01 22:12:03', '2024-12-01 22:12:03'),
(29, 'Casa Dorada', 'La Casa Dorada es un emblemático edificio de la ciudad de Tarija, conocido por su llamativa arquitectura colonial y su característico color dorado. Situada en pleno centro histórico de la ciudad, la Casa Dorada es un lugar de interés tanto histórico como cultural. En su interior se pueden observar detalles arquitectónicos de la época, con una mezcla de influencias coloniales y modernas. La casa es un testimonio de la rica historia de Tarija, y su restauración ha permitido preservar una pieza importante del patrimonio de la ciudad. Actualmente, se utiliza para eventos culturales, exposiciones de arte y actividades turísticas, siendo uno de los atractivos más importantes de Tarija.', 'Ubicada en el centro histórico de la ciudad de Tarija, cerca de la Plaza Principal.', 'TARIJA', 'https://maps.app.goo.gl/d4JWwXPZMuyyzbJ48', 0, '\"[\\\"2024080120420424478.jpg\\\",\\\"La_casa_dorada_en_una_hermosa_tarde.jpg\\\"]\"', 'TEMPLADO', '06/05/2025 - 30/05/2025', 'Se recomienda verificar el horario de apertura de la casa, ya que en ocasiones se realizan actividades privadas o eventos especiales.\r\nEl acceso a algunas áreas de la casa puede ser limitado dependiendo de las actividades que se estén realizando en ese momento.\r\nDurante la temporada de lluvias, algunas calles cercanas pueden volverse resbaladizas, por lo que se debe tener precaución al caminar por la zona.', 'Recorrido arquitectónico: Los visitantes pueden recorrer la Casa Dorada y admirar su arquitectura colonial restaurada, así como conocer la historia del edificio.\r\nEventos culturales: La Casa Dorada alberga eventos culturales, como exposiciones de arte, conciertos y actividades sociales.\r\nPlaza Principal: La Casa Dorada está ubicada cerca de la Plaza Principal de Tarija, un lugar ideal para pasear, disfrutar de cafés y explorar otros puntos históricos.', '2024-12-01 22:14:53', '2024-12-01 22:14:53'),
(30, ' Cascadas de Coimata', 'Las Cascadas de Coimata son un impresionante conjunto de cascadas ubicadas en las montañas cercanas a Tarija. Este destino es ideal para los amantes de la naturaleza y el ecoturismo, ofreciendo una combinación perfecta de paisajes naturales, tranquilidad y belleza. Las cascadas están rodeadas por un frondoso bosque y ofrecen la oportunidad de realizar caminatas por senderos bien marcados, además de disfrutar de la fresca agua que cae de las alturas. Este es un lugar perfecto para relajarse, hacer picnic o disfrutar de un baño en sus pozas naturales. Las Cascadas de Coimata se han convertido en un atractivo turístico importante para aquellos que buscan escapar del bullicio de la ciudad y conectar con la naturaleza.', 'A unos 30 kilómetros de la ciudad de Tarija, en el municipio de San Lorenzo.', 'TARIJA', 'https://maps.app.goo.gl/UK8sPwrbvxHkndtV7', 0, '\"[\\\"images.jpg\\\",\\\"images.jpg\\\",\\\"images.jpg\\\"]\"', 'CALIDO', '06/05/2025 - 30/05/2025', 'Se recomienda llevar ropa y calzado adecuado para caminar, ya que el terreno puede ser resbaladizo o empinado en algunas partes del sendero.\r\nEs importante llevar suficiente agua y protección solar, ya que no hay muchas áreas de sombra en la ruta hacia las cascadas.\r\nDurante la temporada de lluvias, algunas áreas del camino pueden ser intransitables debido al barro o deslizamientos de tierra, por lo que es mejor consultar las condiciones antes de planificar la visita.', 'Senderismo: Se pueden realizar caminatas guiadas a través de los senderos que llevan hasta las cascadas, disfrutando de la flora y fauna local.\r\nBaños naturales: Las pozas que se forman debajo de las cascadas son ideales para nadar y relajarse.\r\nFotografía de naturaleza: El paisaje es perfecto para tomar fotos, con el contraste del agua cayendo y la vegetación circundante.', '2024-12-01 22:17:00', '2024-12-01 22:17:00'),
(31, 'Parque Cretacico', 'El Parque Cretácico de Chuquisaca es uno de los destinos más fascinantes para los amantes de la paleontología y la historia natural. Este parque se encuentra en el municipio de Yotala, cerca de la ciudad de Sucre, y es conocido por albergar huellas fósiles de dinosaurios que datan de más de 68 millones de años. Es uno de los sitios más importantes de Sudamérica para el estudio de estos reptiles prehistóricos. En el parque, los visitantes pueden caminar por senderos donde se observan huellas fosilizadas, aprender sobre las especies de dinosaurios que habitaron la región, y disfrutar de una experiencia educativa única. El parque también cuenta con un museo interactivo que presenta una colección de fósiles y reconstrucciones de dinosaurios a escala real, lo que lo convierte en una parada imprescindible para quienes visitan Sucre y sus alrededores.', 'A unos 10 kilómetros de la ciudad de Sucre, en el municipio de Yotala.', 'CHUQUISACA', 'https://maps.app.goo.gl/uCvFRMEWgSZRg1FV6', 0, '\"[\\\"Parque-Cretácico-3-1024x683.jpg\\\",\\\"Parque_Cretácico_-_Cal_Orko_-_Sucre_-_Bolivia.jpg\\\",\\\"visual1.jpg\\\",\\\"Parque-Cretácico-6-1024x683.jpg\\\",\\\"PARQUE-CRETACICO.jpg\\\",\\\"DINO-6.jpg\\\"]\"', 'TEMPLADO', '10/12/2024 - 10/12/2024', 'El parque puede ser difícil de recorrer en días lluviosos debido al barro y las condiciones del terreno. Se recomienda visitar durante la temporada seca para una experiencia más cómoda.\r\nNo se permite tocar o alterar las huellas fósiles, ya que son delicadas y están protegidas para su conservación.\r\nEs aconsejable llevar ropa cómoda y protector solar, ya que las áreas del parque no cuentan con sombra y la exposición al sol puede ser intensa.', 'Huellas fosilizadas: El atractivo principal son las impresionantes huellas de dinosaurios, algunas de las cuales miden hasta un metro de largo.\r\nExhibición de dinosaurios: La exposición en el museo cuenta con modelos a escala real de diferentes especies de dinosaurios que habitaron la región, incluidos los más famosos como el Tyrannosaurus rex y el Triceratops.\r\nFósiles de gran valor: El parque alberga una gran cantidad de fósiles de diferentes especies que fueron encontrados en la región, ofreciendo una experiencia educativa fascinante.', '2024-12-01 22:28:12', '2024-12-01 22:28:12'),
(32, 'Cañon del Icla', 'El Cañón del Icla es una impresionante formación geológica ubicada en el departamento de Chuquisaca, conocida por su belleza natural y paisajes únicos. Este cañón se encuentra en la provincia de Oropeza, cerca del municipio de Icla, y es uno de los destinos más atractivos para los amantes de la naturaleza y el ecoturismo. La zona ofrece vistas panorámicas de formaciones rocosas, valles profundos y una vegetación diversa. El cañón es ideal para los viajeros que disfrutan del senderismo, el avistamiento de fauna y flora, y la tranquilidad de la naturaleza. Su impresionante paisaje, junto con las aguas del río que atraviesa el cañón, lo convierte en un lugar perfecto para la aventura y la relajación.', 'A unos 90 kilómetros de la ciudad de Sucre, en la provincia de Oropeza, municipio de Icla.', 'CHUQUISACA', 'https://maps.app.goo.gl/icK9KxuGpuu4RmjX9', 0, '\"[\\\"canon-de-icla-un-lugar.jpg\\\",\\\"images.jpg\\\",\\\"a4.jpg\\\",\\\"images.jpg\\\"]\"', 'HUMEDO', '10/12/2024 - 10/12/2024', 'El acceso al cañón puede ser complicado durante la temporada de lluvias debido al aumento del caudal del río y el barro en los caminos.\r\nSe recomienda llevar calzado adecuado para caminatas y ropa cómoda, ya que el terreno puede ser irregular.\r\nNo se permite el acceso a algunas áreas protegidas sin la presencia de guías locales, ya que se requiere conocimiento sobre la seguridad y conservación del lugar.', 'Senderismo y caminatas: El Cañón del Icla cuenta con varios senderos que permiten a los visitantes explorar sus formaciones rocosas, su fauna y flora, y disfrutar de vistas espectaculares del cañón y el río.\r\nAvistamiento de fauna y flora: El cañón es hogar de diversas especies de flora y fauna, incluyendo aves, mamíferos pequeños y una vegetación típica de la región semiárida.\r\nFotografía de paisajes: Las formaciones rocosas y los valles ofrecen excelentes oportunidades para la fotografía de paisajes, especialmente al atardecer.', '2024-12-01 22:32:40', '2024-12-01 22:32:40'),
(33, 'Las 7 Cascadas', 'Las 7 Cascadas, ubicadas en la provincia de Luis Calvo, en el departamento de Chuquisaca, es uno de los destinos naturales más fascinantes de la región. Este lugar se caracteriza por una serie de impresionantes caídas de agua, que forman un paisaje único en medio de un entorno selvático. Las cascadas, rodeadas de vegetación exuberante y fauna diversa, son el atractivo principal de la zona, ideal para los amantes de la naturaleza y el ecoturismo. El sitio ofrece diversas actividades como senderismo, baños en las pozas naturales y avistamiento de aves, convirtiéndolo en un lugar perfecto para una aventura refrescante y tranquila. Las cascadas están formadas por un conjunto de saltos de agua, que caen en hermosos pozos de agua cristalina, brindando un espectáculo natural impresionante.', 'En la provincia de Luis Calvo, a unas 120 km de la ciudad de Sucre.', 'CHUQUISACA', 'https://maps.app.goo.gl/WNjn2PHHU76mf3YL8', 0, '\"[\\\"7-cascadas.jpg\\\",\\\"images.jpg\\\",\\\"9999_20170811E3Sye1.jpg\\\",\\\"0710-2019-053595816824182041158-1024x576.jpg\\\",\\\"images.jpg\\\"]\"', 'HUMEDO', '07/01/2025 - 24/01/2025', 'No se recomienda visitar durante la temporada de lluvias si no se cuenta con guías locales, debido al aumento del caudal de agua y las condiciones resbaladizas de los senderos.\r\nSe debe tener precaución al acercarse a las pozas, ya que las rocas pueden ser resbaladizas.\r\nEs importante llevar ropa adecuada para el senderismo y protector solar.', 'Senderismo: Los visitantes pueden recorrer los senderos que rodean las cascadas, disfrutando de la flora y fauna local, así como de las vistas panorámicas del paisaje.\r\nBaños naturales: Las pozas formadas por las caídas de agua ofrecen la oportunidad de disfrutar de baños refrescantes en un entorno natural impresionante.\r\nFotografía de naturaleza: El lugar es ideal para los amantes de la fotografía, con sus paisajes selváticos y las aguas cristalinas de las cascadas.', '2024-12-01 22:35:42', '2024-12-01 22:35:42'),
(34, 'Casa de la Moneda ', 'La Casa de la Moneda de Potosí es un monumento histórico y cultural de gran relevancia, ubicada en el corazón de la ciudad de Potosí. Este majestuoso edificio colonial, que data de 1758, fue originalmente la Casa Real de la Moneda, donde se acuñaba la moneda del Virreinato del Río de la Plata. Hoy en día, la Casa de la Moneda alberga un museo que permite a los visitantes conocer la historia de la minería en Potosí, la producción de monedas, y el impacto de la plata en la economía mundial durante la época colonial. Con su arquitectura imponente y su colección de objetos históricos, la Casa de la Moneda es un importante símbolo del legado cultural y la riqueza histórica de la ciudad de Potosí, declarada Patrimonio de la Humanidad por la UNESCO.', 'Centro histórico de la ciudad de Potosí, sobre la Plaza 10 de Noviembre.', 'POTOSI', 'https://maps.app.goo.gl/YQjU9ts4FhSghJkL6', 0, '\"[\\\"Casa_de_la_Moneda_de_Potosí_(Bolivia).jpg\\\",\\\"CasaNacionalDeMoneda51123.jpg\\\",\\\"images.jpg\\\"]\"', 'SECO', '07/01/2025 - 24/01/2025', 'El museo no cuenta con acceso para personas con movilidad reducida en todos sus niveles.\r\nEs recomendable realizar las visitas con un guía local para entender en profundidad la historia del lugar y sus exposiciones.\r\nDurante las festividades locales o eventos especiales, la Casa de la Moneda puede estar más concurrida, por lo que se recomienda reservar con anticipación para evitar largas filas.', 'Museo de la Casa de la Moneda: Un recorrido fascinante por la historia de la acuñación de monedas, los procesos de extracción de plata, y la influencia de Potosí en la economía global.\r\nColección de arte colonial: El museo alberga una impresionante colección de arte colonial, incluyendo pinturas, esculturas y mobiliario antiguo.\r\nArquitectura histórica: La Casa de la Moneda es un ejemplo excelente de la arquitectura colonial española, con detalles ornamentales en su fachada y un interior bien conservado.', '2024-12-01 22:38:57', '2024-12-01 22:38:57');
INSERT INTO `destino` (`id`, `nombre`, `descripcion`, `ubicacion`, `departamento`, `coordenadas`, `popularidad`, `imagenes`, `clima`, `temporada_recomendada`, `restricciones`, `atracciones`, `fecha_creacion`, `fecha_actualizacion`) VALUES
(35, 'Parque Nacional Toro Toro', 'El Parque Nacional Toro Toro, ubicado en el departamento de Potosí, es un tesoro natural que destaca por su biodiversidad, geografía única y sitios arqueológicos. Con una extensión de más de 6,000 kilómetros cuadrados, este parque es ideal para los amantes del ecoturismo y la aventura. Toro Toro es famoso por sus formaciones rocosas, cañones, cavernas, huellas de dinosaurios y una flora y fauna impresionantes. Los visitantes pueden explorar impresionantes rutas de senderismo, conocer las huellas fósiles de dinosaurios en la zona de la \"Piedra del Sol\", y disfrutar de las maravillas naturales como el Cañón de Toro Toro y la Cueva de Umajalanta. Es un lugar perfecto para aquellos que buscan una mezcla de aventura, naturaleza y cultura.', 'Al norte de la ciudad de Potosí, aproximadamente a 150 km.', 'POTOSI', 'https://maps.app.goo.gl/cQSuYs7L9LfEL2UZ6', 0, '\"[\\\"Canyon_of_Torotoro.jpg\\\",\\\"WhatsApp-Image-2020-07-26-at-13.27.28.jpg\\\",\\\"WhatsApp-Image-2020-07-26-at-13.24.54.jpg\\\",\\\"vergel-cascada-de-agua.jpg\\\"]\"', 'FRIO', '07/01/2025 - 24/01/2025', 'El parque no es completamente accesible para personas con movilidad reducida, especialmente en áreas de senderismo y exploración de cuevas.\r\nDurante la temporada de lluvias, algunas rutas pueden ser inaccesibles o peligrosas debido a las lluvias intensas.\r\nSe recomienda realizar las visitas con un guía local, especialmente para explorar las cuevas y el cañón. Además, se debe tener precaución en las áreas con huellas de dinosaurios para no dañar el patrimonio fósil.', 'Huella de Dinosaurios: El parque alberga algunas de las huellas de dinosaurios más grandes de Sudamérica, en lugares como la \"Piedra del Sol\" y las \"Huella de Toro Toro\".\r\nCueva de Umajalanta: Una impresionante cueva con estalactitas y estalagmitas que se puede explorar con guías locales.\r\nCañón de Toro Toro: Un espectacular cañón que ofrece rutas de senderismo con vistas panorámicas impresionantes de las formaciones rocosas.\r\nLas Cataratas de Toro Toro: Hermosas cascadas rodeadas de un entorno natural exuberante, ideales para hacer senderismo y disfrutar de un baño refrescante.', '2024-12-01 22:44:38', '2024-12-01 22:44:38'),
(36, 'Laguna Suarez', 'La Laguna Suárez es un hermoso cuerpo de agua ubicado en el departamento del Beni, en la región amazónica de Bolivia. Este destino es conocido por su biodiversidad, tranquilos paisajes naturales y la posibilidad de realizar diversas actividades al aire libre. La laguna forma parte del sistema de humedales de la región y es un lugar ideal para los amantes del ecoturismo y la observación de fauna. Sus aguas cristalinas, rodeadas de bosques tropicales y fauna silvestre, la convierten en un lugar perfecto para realizar paseos en bote, pesca deportiva y observación de aves. Además, la zona es rica en flora, con una gran variedad de plantas acuáticas y árboles nativos que complementan el paisaje.', 'Al sur de la ciudad de Trinidad, en el departamento de Beni, aproximadamente a 90 km de la capital.', 'BENI', 'https://maps.app.goo.gl/mbEE7WKRjwFx4TjB8', 0, '\"[\\\"laguna-suarez.jpg\\\",\\\"LAGUNA-SUAREZ.jpg\\\",\\\"images.jpg\\\",\\\"images.jpg\\\",\\\"Laguna-Suarez-Trinidad-Bolivia.jpg\\\",\\\"6686287715_2a1e8df6ee_b.jpg\\\"]\"', 'CALIDO', '07/01/2025 - 24/01/2025', 'No se recomienda el acceso en temporada de lluvias debido a la crecida de las aguas y las dificultades para acceder a la laguna por caminos inundados.\r\nSe debe respetar el entorno natural y la fauna local, evitando perturbar los hábitats de los animales.\r\nLa región no cuenta con muchos servicios turísticos, por lo que se recomienda organizar el viaje con anticipación y llevar suministros adecuados.', 'Paseos en bote: Los visitantes pueden disfrutar de tranquilos paseos en bote por la laguna, rodeados de naturaleza y fauna silvestre.\r\nObservación de fauna: La laguna es hogar de una rica diversidad de especies, incluidas aves, mamíferos y reptiles, como el caimán negro y varias especies de aves migratorias.\r\nPesca deportiva: La pesca en la laguna es una de las actividades más populares, permitiendo a los turistas disfrutar de la tranquilidad del lugar mientras prueban suerte con la pesca.\r\nSenderismo y exploración de la selva: En los alrededores de la laguna, los visitantes pueden realizar caminatas por la selva, explorando la flora y fauna local.', '2024-12-01 22:47:55', '2024-12-01 22:47:55'),
(37, 'San Ignacio De Moxos', 'San Ignacio de Moxos es una pintoresca localidad situada en el corazón de la región amazónica del Beni, famosa por su rica historia cultural, especialmente en el ámbito de las misiones jesuíticas. Fundada en el siglo XVIII, este pueblo ofrece a los visitantes una combinación única de historia colonial, arquitectura religiosa y una vibrante vida local. Rodeado de naturaleza, es ideal para quienes buscan experimentar la cultura y la belleza de la región tropical. San Ignacio de Moxos se encuentra cerca de importantes ríos y tiene una conexión profunda con las tradiciones indígenas y el mundo natural, lo que la convierte en un excelente punto de partida para explorar la biodiversidad del Beni.', 'Situado en la provincia de Moxos, aproximadamente a 220 km al norte de Trinidad, la capital del Beni.', 'BENI', 'https://maps.app.goo.gl/vD9ftXndCiQSi9Ds7', 0, '\"[\\\"Templo_Misional_San_Iganacio_de_Moxos.jpg\\\",\\\"images.jpg\\\",\\\"cq5dam.thumbnail.cropped.1500.844.jpg\\\",\\\"363360482_768002635329278_774702557654122611_n-e1690560008441.jpg\\\"]\"', 'HUMEDO', '15/12/2024 - 21/01/2025', 'Algunas rutas hacia San Ignacio de Moxos pueden estar en mal estado durante la temporada de lluvias, lo que puede dificultar el acceso.\r\nLas visitas a la zona requieren de cierta preparación, ya que los servicios turísticos no son tan abundantes como en otras áreas más urbanizadas.\r\nEs importante tener en cuenta que la región puede ser calurosa y húmeda, por lo que es recomendable llevar ropa adecuada y protección solar.', 'Misiones Jesuíticas: San Ignacio de Moxos forma parte de las Misiones Jesuíticas de Chiquitos, declaradas Patrimonio de la Humanidad por la UNESCO. La iglesia de la misión es uno de los principales atractivos, con su arquitectura colonial y sus bellos detalles en madera tallada.\r\nCultura Moxeña: Los visitantes pueden explorar la rica herencia cultural de los pueblos indígenas moxeños a través de sus festividades, música y danza.\r\nRío Mamoré: San Ignacio de Moxos está ubicado cerca del río Mamoré, ideal para realizar actividades como paseos en bote y pesca.\r\nSenderismo y Naturaleza: La región está rodeada de selvas y bosques, lo que permite realizar caminatas y explorar la flora y fauna local.', '2024-12-01 22:50:47', '2024-12-01 22:50:47'),
(38, 'Parque Nacional De Sajama', 'El Parque Nacional Sajama es una joya natural ubicada en el departamento de Oruro, al oeste de Bolivia, en la cordillera Occidental de los Andes. Este parque es famoso por su imponente paisaje de montañas, géiseres, lagunas y la majestuosa presencia del Nevado Sajama, el pico más alto de Bolivia, que alcanza los 6.542 metros sobre el nivel del mar. El parque es un refugio de biodiversidad, hogar de especies únicas como el cóndor andino, la vicuña y el flamenco, además de contar con fuentes termales que atraen a los turistas en busca de relajación. Su ubicación remota, rodeada de paisajes desérticos y montañosos, convierte al parque en un destino ideal para el ecoturismo, el trekking, el montañismo y la observación de fauna.', 'Se encuentra al suroeste de la ciudad de Oruro, cerca de la frontera con Chile, en la región andina de Bolivia.', 'ORURO', 'https://maps.app.goo.gl/zEjUsxmgWt1MvpUL8', 0, '\"[\\\"WhatsApp-Image-2020-08-02-at-13.35.16.jpg\\\",\\\"sajama-01.jpg\\\",\\\"Parque_Nacional_Sajama_-_Nevado_Sajama_-_Oruro_-_Bolivia.jpg\\\",\\\"WhatsApp-Image-2020-08-02-at-13.35.16-1.jpg\\\",\\\"pn2.jpg\\\"]\"', 'TEMPLADO', '06/05/2025 - 30/05/2025', 'La altitud en el parque puede ser un reto para los visitantes, por lo que se recomienda aclimatarse adecuadamente antes de realizar actividades como el trekking o la escalada.\r\nDebido a las condiciones del terreno, algunas áreas pueden ser inaccesibles durante la temporada de lluvias.\r\nEs recomendable llevar equipo adecuado para el clima frío y la alta montaña. Además, los servicios turísticos en la zona son limitados, por lo que es importante planificar con anticipación.', 'Nevado Sajama: La atracción principal del parque, el Nevado Sajama, es un destino popular para los montañistas. Su cima, la más alta de Bolivia, es un desafío para los expertos en escalada.\r\nTermas de Sajama: El parque alberga varias fuentes termales, que son perfectas para relajarse después de una caminata o excursión en el parque.\r\nLagunas de alta montaña: El parque cuenta con hermosas lagunas como la Laguna Sajama, que son ideales para el avistamiento de aves y actividades fotográficas.\r\nGeiseres: El área de los géiseres de Sajama es una de las más impresionantes, con vapor y agua caliente que emergen del suelo, creando un paisaje surrealista.\r\nObservación de fauna: El parque es hogar de varias especies andinas, incluyendo vicuñas, flamencos, y el cóndor andino.', '2024-12-01 22:53:22', '2024-12-01 22:53:22'),
(39, 'Iglesia De San Gerardo', 'La Iglesia de San Gerardo es uno de los principales puntos de interés histórico y arquitectónico de la ciudad de Oruro, Bolivia. Esta iglesia, de estilo barroco, fue construida en el siglo XVIII y ha sido testigo de la evolución de la ciudad a lo largo de los siglos. Es conocida por su imponente fachada y sus detalles ornamentales, que combinan influencias coloniales con características propias de la región andina. La iglesia está dedicada a San Gerardo, un santo italiano del siglo XIX, y se ha convertido en un centro de fe y devoción para los habitantes de Oruro. Además de su valor religioso, la iglesia es un importante atractivo turístico por su arquitectura y su ubicación en el corazón de la ciudad.', 'Centro histórico de la ciudad de Oruro, cerca de la Plaza 10 de Febrero.', 'ORURO', 'https://maps.app.goo.gl/dKh3j5Vd7WDNGFzp8', 0, '\"[\\\"images.jpg\\\",\\\"images.jpg\\\"]\"', 'HUMEDO', '06/05/2025 - 30/05/2025', 'La iglesia está abierta al público en horarios específicos, por lo que se recomienda verificar los horarios antes de planificar la visita.\r\nLas áreas internas de la iglesia están reservadas para la oración y actividades religiosas, por lo que se debe respetar el ambiente de recogimiento y paz.\r\nDurante las festividades del Carnaval, la zona puede estar bastante concurrida, por lo que es importante tener en cuenta el aumento de visitantes en esas fechas.', 'Arquitectura Barroca: La iglesia es un excelente ejemplo de la arquitectura colonial barroca, con detalles en su fachada, altar y en los muros interiores.\r\nPlaza 10 de Febrero: A pocos metros de la iglesia se encuentra esta plaza, un espacio emblemático de Oruro, donde se realizan diversas actividades culturales y festivas.\r\nReligiosidad y Tradición: La iglesia es un centro importante para la celebración de festividades religiosas, especialmente durante la Fiesta de la Virgen del Socavón, en el Carnaval de Oruro.\r\nMuseos cercanos: En los alrededores se encuentran varios museos que cuentan la historia de la ciudad y sus tradiciones, como el Museo del Carnaval.', '2024-12-01 22:56:26', '2024-12-01 22:56:26'),
(40, 'Reserva de vida Silvestre Manuripi', 'La Reserva de Vida Silvestre Manuripi, ubicada en el departamento de Pando, es una de las áreas protegidas más importantes de la región amazónica boliviana. Con una extensión de más de 1.5 millones de hectáreas, esta reserva alberga una biodiversidad única y es un refugio para muchas especies de flora y fauna endémica. El Manuripi es un paraíso para los ecoturistas y los observadores de aves, ya que es hogar de especies como jaguares, pumas, tapires, caimanes, y una gran cantidad de aves tropicales. Su entorno selvático, cubierto por bosques tropicales y atravesado por ríos y lagunas, es ideal para quienes buscan un contacto cercano con la naturaleza y disfrutar de actividades como el senderismo, la pesca deportiva, y los paseos en bote. Además, la reserva es un importante espacio de conservación de especies en peligro de extinción y un punto de conexión con las comunidades indígenas locales.', 'El Manuripi se encuentra en el norte de Bolivia, en la región amazónica del país, cerca de la frontera con Brasil, en el departamento de Pando.', 'PANDO', 'https://maps.app.goo.gl/QZrUqPd7uYbmRaXUA', 0, '\"[\\\"AAG2645-2-1-scaled.jpg\\\",\\\"AAG2606-2-scaled.jpg\\\",\\\"40-image-7-reserva-nacional-de-vida-silvestre-amazo-nica-manuripi_huge.jpg\\\",\\\"CrónicasManuripi0810.jpg\\\",\\\"los-5-mejores-lugares-turisticos-de-pando-699588.jpg\\\"]\"', 'HUMEDO', '16/04/2025 - 26/04/2025', 'La accesibilidad a la reserva puede ser limitada debido a su ubicación remota en la selva amazónica.\r\nDurante la temporada de lluvias, algunas áreas pueden volverse inaccesibles, por lo que se recomienda viajar durante la temporada seca.\r\nEs importante seguir las normativas de conservación y respetar el medio ambiente, ya que la reserva protege especies en peligro de extinción y su ecosistema único.', 'Fauna Exuberante: La reserva alberga una rica biodiversidad de especies animales y vegetales, siendo uno de los mejores lugares para la observación de vida silvestre en Bolivia.\r\nLagunas y Ríos: Los paseos en bote por los ríos y lagunas del Manuripi son una excelente manera de explorar el ecosistema y disfrutar de la serenidad del entorno.\r\nSenderismo y Ecoturismo: La reserva ofrece rutas para caminatas guiadas, donde los turistas pueden aprender sobre la flora y fauna de la región y disfrutar de su belleza natural.\r\nComunidades Indígenas: La reserva está cerca de comunidades indígenas que conservan sus tradiciones y que a menudo ofrecen tours culturales para los visitantes.', '2024-12-01 23:01:35', '2024-12-01 23:01:35'),
(41, 'Paseo Por Pando', 'Pando es uno de los departamentos menos conocidos pero con un encanto natural impresionante en Bolivia. Ubicado al norte del país, Pando es un paraíso para los amantes de la naturaleza, con exuberantes bosques tropicales, ríos caudalosos y una biodiversidad única. Este destino es perfecto para quienes buscan una escapatoria tranquila, alejada del bullicio urbano, y desean explorar la fauna y flora amazónica de Bolivia. Además de su belleza natural, Pando ofrece la posibilidad de conocer comunidades indígenas, y disfrutar de su hospitalidad y tradiciones. Ideal para el ecoturismo, el senderismo y la observación de fauna, es un lugar para conectar con la naturaleza en su estado más puro.', 'Pando se encuentra en el extremo norte de Bolivia, limitando con Brasil y Perú, en la región amazónica del país. La capital del departamento es Cobija.', 'PANDO', 'https://maps.app.goo.gl/3jKMiqfkDFrryf6w5', 0, '\"[\\\"6.png\\\",\\\"Turismo-en-Bolivia-Pando.jpg\\\",\\\"Barracas_Manchester_Hiroshima_Turismo_Pando (1).jpg\\\"]\"', 'CALIDO', '16/04/2025 - 26/04/2025', 'La accesibilidad a algunas zonas remotas de Pando puede ser limitada debido a las condiciones de la selva y las rutas de acceso.\r\nDurante la temporada de lluvias, algunas áreas pueden volverse inaccesibles, por lo que se recomienda planificar el viaje durante la temporada seca.\r\nLos turistas deben respetar las costumbres locales y las normativas ambientales para preservar la biodiversidad de la región.', 'Reserva Biológica del Beni: Un área de conservación que alberga una rica biodiversidad, ideal para los amantes de la naturaleza y la observación de fauna.\r\nParque Nacional Madidi (zona de Pando): Aunque principalmente se encuentra en el departamento de La Paz, su parte norte se extiende hacia Pando, siendo un destino de ecoturismo por su increíble diversidad biológica.\r\nRío Acre: Este río es perfecto para los amantes del turismo de aventura, especialmente para realizar paseos en bote o kayak, rodeados de la selva amazónica.\r\nComunidades Indígenas: Pando es hogar de varias comunidades indígenas que mantienen sus costumbres y tradiciones vivas, ofreciendo experiencias culturales únicas a los turistas.', '2024-12-01 23:04:06', '2024-12-01 23:04:06');

-- --------------------------------------------------------

--
-- Table structure for table `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `id` int NOT NULL,
  `destino` varchar(100) DEFAULT NULL,
  `alojamiento` varchar(100) DEFAULT NULL,
  `transporte` varchar(100) DEFAULT NULL,
  `venta_id` int NOT NULL,
  `cantidad_personas` int NOT NULL,
  `precio` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `detalle_venta`
--

INSERT INTO `detalle_venta` (`id`, `destino`, `alojamiento`, `transporte`, `venta_id`, `cantidad_personas`, `precio`) VALUES
(1, 'Camino De La Muerte', 'Hotel Presidente', 'AUTOBUS', 3, 5, '200.00'),
(2, 'Parque Nacional Amboró', 'Los Tajibos Hotel & Convention Center', 'AUTOBUS', 6, 5, '100.00');

-- --------------------------------------------------------

--
-- Table structure for table `paquete`
--

CREATE TABLE `paquete` (
  `id` int NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text,
  `departamento_origen` varchar(100) DEFAULT NULL,
  `lugar_salida` varchar(100) DEFAULT NULL,
  `destino_id` int NOT NULL,
  `transporte_salida` int NOT NULL,
  `transporte_regreso` int NOT NULL,
  `alojamiento_id` int NOT NULL,
  `id_tipo_paquete` int NOT NULL,
  `precio_total` decimal(10,2) NOT NULL,
  `duracion` text NOT NULL,
  `estado` enum('DISPONIBLE','RESERVADO','CANCELADO','PROMOCION') DEFAULT 'DISPONIBLE',
  `plaza_disponible` int NOT NULL,
  `informacion_adicional` text,
  `fecha_creacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_actualizacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `paquete`
--

INSERT INTO `paquete` (`id`, `nombre`, `descripcion`, `departamento_origen`, `lugar_salida`, `destino_id`, `transporte_salida`, `transporte_regreso`, `alojamiento_id`, `id_tipo_paquete`, `precio_total`, `duracion`, `estado`, `plaza_disponible`, `informacion_adicional`, `fecha_creacion`, `fecha_actualizacion`) VALUES
(1, 'DUKO', 'asfdsfasdf', 'LA PAZ', 'sfgsdfg', 6, 1, 1, 2, 2, '200.00', '2024-12-01 - 2024-12-08', 'DISPONIBLE', 100, 'adfadsfasdfadsfs', '2024-12-02 03:39:56', '2024-12-02 03:39:56'),
(2, 'asdfasdf', 'afdasdfasdf', 'BENI', 'dfsgfsdfg{', 15, 7, 2, 8, 3, '1000.00', '2024-12-01 - 2024-12-01', 'DISPONIBLE', 50, 'dfgasdfsdfa', '2024-12-02 03:43:08', '2024-12-02 03:43:08'),
(3, 'asdfsfasdfsdf', 'adsfasdfasdfasd', 'SANTA CRUZ', 'sfgsdfg', 6, 2, 1, 1, 2, '22.00', '2024-12-01 - 2024-12-15', 'DISPONIBLE', 34, 'erfgdsfgsdf', '2024-12-02 03:46:32', '2024-12-02 03:46:32'),
(4, 'asfasdf', 'adfasdf', 'LA PAZ', '3242342', 15, 1, 2, 8, 1, '100.00', '2024-12-01 - 2024-12-08', 'DISPONIBLE', 35, 'dfsdfsdfsd', '2024-12-02 03:54:56', '2024-12-02 03:54:56'),
(5, 'asfasdf', 'adfasdf', 'LA PAZ', '3242342', 15, 1, 2, 8, 1, '100.00', '2024-12-01 - 2024-12-08', 'DISPONIBLE', 35, 'dfsdfsdfsd', '2024-12-02 03:55:50', '2024-12-02 03:55:50'),
(6, 'asfasdf', 'adfasdf', 'LA PAZ', '3242342', 15, 1, 2, 8, 1, '100.00', '2024-12-01 - 2024-12-08', 'DISPONIBLE', 35, 'dfsdfsdfsd', '2024-12-02 03:55:52', '2024-12-02 03:55:52'),
(7, 'asfasdf', 'dghdfgh', 'LA PAZ', 'dfgdfg', 15, 1, 2, 7, 2, '100.00', '2024-12-01 - 2024-12-08', 'DISPONIBLE', 40, 'dfghdfghdfghdfgh', '2024-12-02 03:57:44', '2024-12-02 03:57:44'),
(8, 'gsdgsdf', 'sfgfdg', 'LA PAZ', 'dsgdfg', 36, 1, 7, 11, 2, '100.00', '2024-12-08 - 2025-01-21', 'DISPONIBLE', 40, 'asfsdfasdf', '2024-12-02 04:05:13', '2024-12-02 04:05:13'),
(9, 'adsfasdf', 'asdfsdf', 'LA PAZ', 'dfsgfsdfg', 15, 1, 2, 7, 1, '100.00', '2024-12-02 - 2024-12-02', 'DISPONIBLE', 10, 'asdfsdfasdf', '2024-12-02 04:06:34', '2024-12-02 04:06:34'),
(10, 'dfasfsdf', 'adfsdfa', 'SANTA CRUZ', 'adsfasdf', 15, 2, 2, 8, 1, '1000.00', '2024-12-07 - 2025-01-21', 'DISPONIBLE', 100, 'dfgdfgdfg', '2024-12-02 04:07:28', '2024-12-02 04:07:28');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id_rol` int NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` text,
  `fecha_creacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id_rol`, `nombre`, `descripcion`, `fecha_creacion`) VALUES
(1, 'ADMIN', 'Tiene acceso completo al sistema', '2024-11-28 02:50:09'),
(2, 'USUARIO', 'Usuario estándar con permisos limitados', '2024-11-28 02:50:09'),
(3, 'MODERADOR', 'Puede moderar el contenido del sistema', '2024-11-28 02:50:09');

-- --------------------------------------------------------

--
-- Table structure for table `tipo_paquete`
--

CREATE TABLE `tipo_paquete` (
  `id` int NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tipo_paquete`
--

INSERT INTO `tipo_paquete` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Culturales e Historia', 'Explora sitios históricos y culturales destacados.'),
(2, 'Aventura Extrema', 'Tours para los amantes de la adrenalina y la aventura.'),
(3, 'Naturaleza y Relajación', 'Disfruta de paisajes naturales y momentos de relajación.'),
(4, 'Paquetes familiares', 'Experiencias diseñadas para toda la familia.'),
(5, 'Paquetes Duo (Parejas)', 'Paquetes románticos para disfrutar en pareja.'),
(6, 'Paquetes Personalizados', 'Diseña tours según tus intereses y preferencias.');

-- --------------------------------------------------------

--
-- Table structure for table `transporte`
--

CREATE TABLE `transporte` (
  `id` int NOT NULL,
  `tipo` enum('AUTOBUS','AVION','BARCO','MINIBUS','TAXI') DEFAULT NULL,
  `codigo` varchar(20) DEFAULT NULL,
  `estado` enum('DISPONIBLE','RESERVADO','MANTENIMIENTO','NUEVO') DEFAULT 'NUEVO',
  `capacidad` int NOT NULL,
  `imagenes` json DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_actualizacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `departamento` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transporte`
--

INSERT INTO `transporte` (`id`, `tipo`, `codigo`, `estado`, `capacidad`, `imagenes`, `fecha_creacion`, `fecha_actualizacion`, `departamento`) VALUES
(1, 'AUTOBUS', 'tx_001023', 'DISPONIBLE', 20000, '[\"taxi-icon-yellow-checkered-cab-260nw-2090678698.webp\"]', '2024-12-01 01:28:24', '2024-12-01 22:47:29', 'LA PAZ'),
(2, 'AVION', '200dsf', 'RESERVADO', 2100, '\"[\\\"download.jpg\\\"]\"', '2024-12-01 01:31:21', '2024-12-01 22:47:29', 'SANTA CRUZ'),
(3, 'AVION', '100u', 'RESERVADO', 1000, '\"[\\\"OIP.jpg\\\"]\"', '2024-12-01 01:41:22', '2024-12-01 22:47:29', 'COCHABAMBA'),
(7, 'TAXI', 'xxxxxsddsbnvbn', 'DISPONIBLE', 2000, '\"[\\\"ford-taxis-promo.jpg\\\",\\\"taxistas.jpg\\\"]\"', '2024-12-01 02:57:01', '2024-12-01 22:47:29', 'BENI');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `usuario` varchar(20) DEFAULT NULL,
  `password_hash` varchar(255) NOT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `direccion` text,
  `id_rol` int NOT NULL,
  `fecha_creacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_actualizacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `activo` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `apellido`, `email`, `usuario`, `password_hash`, `telefono`, `direccion`, `id_rol`, `fecha_creacion`, `fecha_actualizacion`, `activo`) VALUES
(1, 'Miguel Angel', 'Quispe Gutierrez', 'miguel.040.net@gmail.com', 'admin', '$argon2id$v=19$m=65536,t=4,p=1$UGJEWEh0WnJwTHI4TWwzSg$gAbX3IP8mZ39Urut535XfmF/iQSJHvdVbVDa5YZynNo', '73054178', '', 1, '2024-11-28 03:28:50', '2024-11-28 03:28:50', 1),
(2, 'david', 'mamani', 'xxxx@gmai.com', 'dev', '$argon2id$v=19$m=65536,t=4,p=1$WWEyTUk0aW9oUE9iYTNaNw$mITSttfl+fMjV8kcPlxHhc9BzX9PVDccoCp5kcUKkZk', '475125', 'Av. sdfasdf', 2, '2024-12-04 02:05:39', '2024-12-04 02:05:39', 1);

-- --------------------------------------------------------

--
-- Table structure for table `venta`
--

CREATE TABLE `venta` (
  `id` int NOT NULL,
  `usuario_id` int NOT NULL,
  `paquete_id` int NOT NULL,
  `codigo_secreto` varchar(100) NOT NULL,
  `fecha_venta` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `venta`
--

INSERT INTO `venta` (`id`, `usuario_id`, `paquete_id`, `codigo_secreto`, `fecha_venta`) VALUES
(1, 2, 6, 'LP2GANCv1g', '2024-12-05 02:09:48'),
(2, 2, 6, 'hq2WeKUcbU', '2024-12-05 02:13:10'),
(3, 2, 6, 'eTYZ4poqnF', '2024-12-05 02:14:19'),
(6, 2, 7, '1KQcKhs2ED', '2024-12-05 02:56:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alojamiento`
--
ALTER TABLE `alojamiento`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `destino`
--
ALTER TABLE `destino`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `venta_id` (`venta_id`);

--
-- Indexes for table `paquete`
--
ALTER TABLE `paquete`
  ADD PRIMARY KEY (`id`),
  ADD KEY `destino_id` (`destino_id`),
  ADD KEY `alojamiento_id` (`alojamiento_id`),
  ADD KEY `id_tipo_paquete` (`id_tipo_paquete`),
  ADD KEY `transporte_salida` (`transporte_salida`),
  ADD KEY `transporte_regreso` (`transporte_regreso`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indexes for table `tipo_paquete`
--
ALTER TABLE `tipo_paquete`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indexes for table `transporte`
--
ALTER TABLE `transporte`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo` (`codigo`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD KEY `id_rol` (`id_rol`);

--
-- Indexes for table `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_USUARIO` (`usuario_id`),
  ADD KEY `FK_PAQUETE` (`paquete_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alojamiento`
--
ALTER TABLE `alojamiento`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `destino`
--
ALTER TABLE `destino`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `detalle_venta`
--
ALTER TABLE `detalle_venta`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `paquete`
--
ALTER TABLE `paquete`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tipo_paquete`
--
ALTER TABLE `tipo_paquete`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transporte`
--
ALTER TABLE `transporte`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `venta`
--
ALTER TABLE `venta`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD CONSTRAINT `detalle_venta_ibfk_1` FOREIGN KEY (`venta_id`) REFERENCES `venta` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `paquete`
--
ALTER TABLE `paquete`
  ADD CONSTRAINT `paquete_ibfk_1` FOREIGN KEY (`destino_id`) REFERENCES `destino` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `paquete_ibfk_2` FOREIGN KEY (`alojamiento_id`) REFERENCES `alojamiento` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `paquete_ibfk_3` FOREIGN KEY (`id_tipo_paquete`) REFERENCES `tipo_paquete` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `paquete_ibfk_4` FOREIGN KEY (`transporte_salida`) REFERENCES `transporte` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `paquete_ibfk_5` FOREIGN KEY (`transporte_regreso`) REFERENCES `transporte` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`) ON DELETE CASCADE;

--
-- Constraints for table `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `FK_PAQUETE` FOREIGN KEY (`paquete_id`) REFERENCES `paquete` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_USUARIO` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
