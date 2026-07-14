-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-06-2026 a las 22:10:23
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12
SET
  SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

START TRANSACTION;

SET
  time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;

/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;

/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;

/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `place_bsd`
--
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `gateway_ordenes`
--
CREATE TABLE
  `gateway_ordenes` (
    `id` int (11) NOT NULL,
    `producto` varchar(100) NOT NULL,
    `precio` decimal(10, 2) NOT NULL,
    `nombre` varchar(100) NOT NULL,
    `correo` varchar(100) NOT NULL,
    `telefono` varchar(20) NOT NULL,
    `tipo_doc` varchar(10) NOT NULL,
    `num_doc` varchar(20) NOT NULL,
    `estado` varchar(20) NOT NULL,
    `request_id` varchar(100) NOT NULL,
    `created_at` timestamp NOT NULL DEFAULT current_timestamp()
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `gateway_ordenes`
--
INSERT INTO
  `gateway_ordenes` (
    `id`,
    `producto`,
    `precio`,
    `nombre`,
    `correo`,
    `telefono`,
    `tipo_doc`,
    `num_doc`,
    `estado`,
    `request_id`,
    `created_at`
  )
VALUES
  (
    28,
    '360 Gold',
    19900.00,
    '12345678',
    'velixidepg3d@gmail.com',
    '30111111111',
    'CC',
    '12345678',
    'cancelada',
    'GW-DEMO-5F743C50',
    '2026-05-31 14:55:11'
  ),
  (
    29,
    '1800 UC Points',
    99900.00,
    'Jair Stiven Martinez',
    'velixidepg3d@gmail.com',
    '3011111111111',
    'CC',
    '12345678',
    'cancelada',
    'GW-DEMO-1FCC4C28',
    '2026-06-01 00:01:24'
  ),
  (
    30,
    '60 UC Points',
    4900.00,
    'Jair Stiven Martinez Palacios',
    'velixidepg3d@gmail.com',
    '300123456',
    'CC',
    '12345678',
    'cancelada',
    'GW-DEMO-BDBF320E',
    '2026-06-01 15:09:58'
  ),
  (
    31,
    '325 UC Points',
    21900.00,
    'Jair stiven martinez',
    'jeoestiven@gmail.com',
    '3001111111111',
    'TI',
    'los que son',
    'cancelada',
    'GW-DEMO-87F7BD8D',
    '2026-06-03 20:51:39'
  ),
  (
    32,
    '325 UC Points',
    21900.00,
    '234241414',
    'jeoestiven@gmail.com',
    'holaxd',
    'TI',
    'dadadadada',
    'aprobada',
    'GW-DEMO-3EB220DC',
    '2026-06-03 21:21:01'
  ),
  (
    33,
    '360 Gold',
    19900.00,
    'jair palacios',
    'jeoestiven@gmail.com',
    '300112121212',
    'CC',
    '12345678',
    'aprobada',
    'GW-DEMO-F6DD2832',
    '2026-06-05 14:11:11'
  ),
  (
    34,
    '325 UC Points',
    21900.00,
    'Valencie asimov',
    'velixidepg3d@gmail.com',
    '30011222313',
    'TI',
    '123456789',
    'aprobada',
    'GW-DEMO-96652187',
    '2026-06-05 16:56:32'
  ),
  (
    35,
    '325 UC Points',
    21900.00,
    'Valencie asimov',
    'velixidepg3d@gmail.com',
    '31111111111',
    'TI',
    '123456789',
    'cancelada',
    'GW-DEMO-77687AE2',
    '2026-06-05 16:59:48'
  ),
  (
    36,
    '360 Gold',
    19900.00,
    'Valencie asimov',
    'velixidepg3d@gmail.com',
    '3131313131331',
    'CC',
    '12345678',
    'aprobada',
    'GW-DEMO-A2078EBE',
    '2026-06-05 20:41:31'
  ),
  (
    37,
    '325 UC Points',
    21900.00,
    'Valencie asimov',
    'velixidepg3d@gmail.com',
    '311111111111111',
    'TI',
    '123456789',
    'cancelada',
    'GW-DEMO-3A1444F2',
    '2026-06-07 15:49:31'
  ),
  (
    38,
    '60 UC Points',
    4900.00,
    'Jair!',
    'mjairstiven@gmail.com',
    '311212121212',
    'TI',
    '123456789',
    'cancelada',
    'GW-DEMO-4B1F41FD',
    '2026-06-10 13:03:56'
  ),
  (
    39,
    '1120 Gold',
    54900.00,
    'Jair Stiven Martinez Palacios',
    'mjairstiven@gmail.com',
    '300000000',
    'CC',
    '23223232323',
    'aprobada',
    'GW-DEMO-F0D768E4',
    '2026-06-10 15:19:33'
  ),
  (
    40,
    '2240 Gold',
    99900.00,
    'V A L E N C I E',
    'velixidepg3d@gmail.com',
    '32111111111',
    'CC',
    '123456789',
    'aprobada',
    'GW-DEMO-7A769A2D',
    '2026-06-10 19:19:33'
  ),
  (
    41,
    '325 UC Points',
    21900.00,
    'Jair!',
    'mjairstiven@gmail.com',
    '301111111111',
    'TI',
    '12345678',
    'aprobada',
    'GW-DEMO-740F92D7',
    '2026-06-10 20:14:50'
  ),
  (
    42,
    '325 UC Points',
    21900.00,
    'jair stiven martinez',
    'mjairstiven@gmail.com',
    '3131313131',
    'TI',
    '121314145',
    'rechazada',
    'GW-DEMO-A35FA5AA',
    '2026-06-10 20:17:20'
  ),
  (
    43,
    '80 Gold',
    4900.00,
    'jair stiven martinez paalcios',
    'mjairstiven@gmail.com',
    '3001111111',
    'CC',
    '12345678',
    'aprobada',
    'GW-BS-F918F8A1',
    '2026-06-12 20:29:04'
  ),
  (
    44,
    '360 Gold',
    19900.00,
    'jair papi maroi',
    'mjairstiven@gmail.com',
    '300123456',
    'CC',
    '12345678',
    'rechazada',
    'GW-BS-01449C92',
    '2026-06-12 20:31:06'
  ),
  (
    45,
    '360 Gold',
    19900.00,
    'Jair',
    'mjairstiven@gmail.com',
    '313131313131',
    'CC',
    '212121211212',
    'aprobada',
    'GW-BS-2707374B',
    '2026-06-12 20:33:20'
  ),
  (
    46,
    '325 UC Points',
    21900.00,
    'Jair!',
    'mjairstiven@gmail.com',
    '3131313131313',
    'TI',
    '111111111',
    'rechazada',
    'GW-BS-7C1DB17E',
    '2026-06-12 20:36:56'
  ),
  (
    47,
    '360 Gold',
    19900.00,
    'jair palacios',
    'mjairstiven@gmail.com',
    '3131341453153',
    'CC',
    '13145566',
    'aprobada',
    'GW-BS-F9F9FBA7',
    '2026-06-12 20:38:04'
  ),
  (
    48,
    '325 UC Points',
    21900.00,
    'Jairsito',
    'mjairstiven@gmail.com',
    '30112121212212',
    'TI',
    '1111111',
    'rechazada',
    'GW-BS-A16CBC1F',
    '2026-06-13 19:39:01'
  ),
  (
    49,
    '325 UC Points',
    21900.00,
    'Jair!',
    'mjairstiven@gmail.com',
    '3141414144141',
    'TI',
    '1212121212',
    'aprobada',
    'GW-BS-F0B866D0',
    '2026-06-13 19:40:01'
  ),
  (
    50,
    '325 UC Points',
    21900.00,
    'jair stiven martines',
    'mjairstiven@gmail.com',
    '3121212131313',
    'TI',
    '1311313133',
    'rechazada',
    'GW-BS-B48772AC',
    '2026-06-13 19:41:06'
  ),
  (
    51,
    '325 UC Points',
    21900.00,
    'Jair!',
    'mjairstiven@gmail.com',
    '131313131313',
    'TI',
    '1111111111',
    'rechazada',
    'GW-BS-FA5D2506',
    '2026-06-15 04:14:40'
  ),
  (
    52,
    '360 Gold',
    19900.00,
    'jAFfSF',
    'mjairstiven@gmail.com',
    '3131313131',
    'CC',
    '25789241',
    'rechazada',
    'GW-BS-A89239E5',
    '2026-06-15 04:16:10'
  ),
  (
    53,
    '360 Gold',
    19900.00,
    'Jairsito',
    'mjairstiven@gmail.com',
    '313131313134',
    'CC',
    '12345678',
    'rechazada',
    'GW-BS-E54EB12D',
    '2026-06-15 18:28:22'
  ),
  (
    54,
    '360 Gold',
    19900.00,
    'Jair',
    'mjairstiven@gmail.com',
    '333311313131',
    'CC',
    '123456789',
    'rechazada',
    'GW-BS-1B573EAA',
    '2026-06-15 18:29:51'
  ),
  (
    55,
    '325 UC Points',
    21900.00,
    'Jair!',
    'mjairstiven@gmail.com',
    '1231453457',
    'TI',
    '12345678',
    'rechazada',
    'GW-BS-8580ECE1',
    '2026-06-15 18:38:16'
  ),
  (
    56,
    '325 UC Points',
    21900.00,
    'Jair!',
    'mjairstiven@gmail.com',
    '21415256',
    'CC',
    '12345678',
    'aprobada',
    'GW-BS-72CF9B3C',
    '2026-06-15 18:57:48'
  ),
  (
    57,
    '360 Gold',
    19900.00,
    'Jair',
    'mjairstiven@gmail.com',
    '323333333',
    'CC',
    '12345678',
    'cancelada',
    'GW-BS-31083992',
    '2026-06-15 19:00:47'
  ),
  (
    58,
    '360 Gold',
    19900.00,
    'jair palacios',
    'mjairstiven@gmail.com',
    '31111111111111',
    'CC',
    '1313131345',
    'aprobada',
    'GW-BS-13C09A30',
    '2026-06-15 19:34:49'
  ),
  (
    59,
    '660 UC Points',
    39900.00,
    'Valencie asimov',
    'velixidepg3d@gmail.com',
    '3001234678',
    'CC',
    '123456778',
    'aprobada',
    'GW-BS-34477F8E',
    '2026-06-16 15:11:34'
  ),
  (
    60,
    '360 Gold',
    19900.00,
    'jairsito',
    'velixidepg3d@gmail.com',
    '3000001231',
    'CC',
    '1234567890',
    'cancelada',
    'GW-BS-674FB405',
    '2026-06-16 15:15:06'
  );

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `gateway_suscripciones`
--
CREATE TABLE
  `gateway_suscripciones` (
    `id` int (11) NOT NULL,
    `servicio` varchar(50) NOT NULL,
    `plan` varchar(50) NOT NULL,
    `precio` decimal(10, 2) NOT NULL,
    `nombre` varchar(100) NOT NULL,
    `correo` varchar(100) NOT NULL,
    `telefono` varchar(20) NOT NULL,
    `tipo_doc` varchar(10) NOT NULL,
    `num_doc` varchar(20) NOT NULL,
    `estado` varchar(20) NOT NULL,
    `token` varchar(255) NOT NULL,
    `request_id` varchar(100) NOT NULL,
    `created_at` timestamp NOT NULL DEFAULT current_timestamp()
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `gateway_suscripciones`
--
INSERT INTO
  `gateway_suscripciones` (
    `id`,
    `servicio`,
    `plan`,
    `precio`,
    `nombre`,
    `correo`,
    `telefono`,
    `tipo_doc`,
    `num_doc`,
    `estado`,
    `token`,
    `request_id`,
    `created_at`
  )
VALUES
  (
    2,
    'Netflix',
    'Estándar con anuncios',
    14900.00,
    'jair stiven martinez',
    'mjairstiven@gmail.com',
    '30111111111',
    'CC',
    '123456678',
    'aprobada',
    '',
    'GWSUB-472773F6',
    '2026-05-20 20:43:11'
  ),
  (
    3,
    'Netflix',
    'Estándar',
    26900.00,
    'jair stiven martinez',
    'mjairstiven@gmail.com',
    '111111111111',
    'CC',
    '11111111111',
    'aprobada',
    '',
    'GWSUB-8457381C',
    '2026-05-20 21:55:55'
  ),
  (
    4,
    'Netflix',
    'Estándar con anuncios',
    14900.00,
    'jair stiven',
    'velixidepg3d@gmail.com',
    '3111111111',
    'CC',
    '123456789',
    'aprobada',
    '',
    'GWSUB-E58D5F32',
    '2026-05-22 03:19:09'
  ),
  (
    5,
    'Paramount+',
    'Essential',
    12900.00,
    'valencie asimov',
    'velixidepg3d@gmail.com',
    '31111111111',
    'CC',
    '987654321',
    'aprobada',
    'TOK-B6EEF55FDA5CC23F',
    'GWSUB-7A3BFD68',
    '2026-05-22 03:19:55'
  ),
  (
    6,
    'Netflix',
    'Estándar con anuncios',
    14900.00,
    'jair stiven martinez',
    'jeoestiven@gmail.com',
    '3218920112',
    'CC',
    '12346789',
    'aprobada',
    '',
    'GWSUB-AC6A9188',
    '2026-05-22 19:23:26'
  ),
  (
    7,
    'Netflix',
    'Premium',
    36900.00,
    'Valencia asimov priet',
    'velixidepg3d@gmail.com',
    '31111111111',
    'CC',
    '123456789',
    'aprobada',
    '',
    'GWSUB-81FF7BE6',
    '2026-05-26 05:42:15'
  ),
  (
    8,
    'Netflix',
    'Estándar',
    26900.00,
    'jair palacios',
    'velixidepg3d@gmail.com',
    '30111113131',
    'CC',
    '123456789',
    'aprobada',
    '',
    'GWSUB-CA1CEC14',
    '2026-06-01 00:27:42'
  ),
  (
    9,
    'Netflix',
    'Estándar con anuncios',
    14900.00,
    'Jair stiven martinez palacios',
    'mjairstiven@gmail.com',
    '30011111212',
    'CC',
    '12345678',
    'aprobada',
    'TOK-83C4D64AF28CE826',
    'GWSUB-69EE8F72',
    '2026-06-02 21:21:44'
  ),
  (
    10,
    'Netflix',
    'Estándar',
    26900.00,
    'Valecia asimaev priet',
    'mjairstiven@gmail.com',
    '30111111111111',
    'CC',
    '123456789',
    'aprobada',
    '',
    'GWSUB-A11A5EDF',
    '2026-06-02 21:22:48'
  ),
  (
    11,
    'Netflix',
    'Estándar',
    26900.00,
    'Valencie asimov prieta',
    'velixidepg3d@gmail.com',
    '311113131311',
    'CC',
    '123456789',
    'aprobada',
    'TOK-65C743E3F33FEEBD',
    'GWSUB-69612405',
    '2026-06-02 21:26:17'
  ),
  (
    12,
    'DAZN',
    'Estándar',
    19900.00,
    'Jairsito',
    'mjairstiven@gmail.com',
    '30011111111',
    'CC',
    '123456789',
    'aprobada',
    'TOK-180BCC75465A5C41',
    'GWSUB-D00F53CF',
    '2026-06-10 15:54:48'
  ),
  (
    13,
    'Netflix',
    'Estándar',
    26900.00,
    'Jair sito',
    'mjairstiven@gmail.com',
    '3121212121212',
    'CC',
    '12456778',
    'rechazada',
    '',
    'GWSUB-AB854A58',
    '2026-06-15 01:46:43'
  ),
  (
    14,
    'Netflix',
    'Premium',
    36900.00,
    'jairsito',
    'mjairstiven@gmail.com',
    '121314145',
    'CC',
    '142141515',
    'rechazada',
    '',
    'GWSUB-39719CA9',
    '2026-06-15 01:48:47'
  ),
  (
    15,
    'Netflix',
    'Estándar',
    26900.00,
    'agvdsgas',
    'mjairstiven@gmail.com',
    '24152525',
    'CC',
    '1|4151516',
    'aprobada',
    '',
    'GWSUB-D19A1B12',
    '2026-06-15 01:56:17'
  ),
  (
    16,
    'Netflix',
    'Estándar',
    26900.00,
    'agasgsagd',
    'mjairstiven@gmail.com',
    '1123562356',
    'CC',
    '14146457548',
    'rechazada',
    '',
    'GWSUB-D8287CA2',
    '2026-06-15 01:57:59'
  ),
  (
    17,
    'Netflix',
    'Estándar',
    26900.00,
    'Jair stiven',
    'mjairstiven@gmail.com',
    '13131313131',
    'CC',
    '1321451556',
    'rechazada',
    '',
    'GWSUB-6F05C3BF',
    '2026-06-15 04:14:05'
  ),
  (
    18,
    'Netflix',
    'Estándar',
    26900.00,
    'hqhqgeg',
    'mjairstiven@gmail.com',
    '3121212131',
    'CC',
    '41413121452',
    'rechazada',
    '',
    'GWSUB-0EEB5E8A',
    '2026-06-15 04:15:12'
  ),
  (
    19,
    'Netflix',
    'Estándar',
    26900.00,
    'el jair',
    'mjairstiven@gmail.com',
    '31213311441',
    'CC',
    '3121345656',
    'rechazada',
    '',
    'GWSUB-DC9F67E7',
    '2026-06-15 18:26:13'
  ),
  (
    20,
    'Netflix',
    'Estándar',
    26900.00,
    'jairsito',
    'mjairstiven@gmail.com',
    '312121212313',
    'CC',
    '12345678',
    'rechazada',
    '',
    'GWSUB-1685F8FC',
    '2026-06-15 18:30:53'
  ),
  (
    21,
    'Netflix',
    'Estándar',
    26900.00,
    'jairsitobv',
    'mjairstiven@gmail.com',
    '4313131313',
    'CC',
    '134674746',
    'pendiente',
    '',
    'GWSUB-6588C590',
    '2026-06-15 19:11:47'
  ),
  (
    22,
    'Netflix',
    'Estándar',
    26900.00,
    'jairsito',
    'mjairstiven@gmail.com',
    '35689012145',
    'CC',
    '1234567890',
    'aprobada',
    'TOK-07DC041DD9B09391',
    'GWSUB-5A159804',
    '2026-06-15 19:25:44'
  ),
  (
    23,
    'Netflix',
    'Estándar',
    26900.00,
    'jair palacios',
    'mjairstiven@gmail.com',
    '3131313412',
    'CC',
    '12345678910',
    'rechazada',
    '',
    'GWSUB-26C30796',
    '2026-06-15 19:26:19'
  ),
  (
    24,
    'Netflix',
    'Estándar',
    26900.00,
    'jairsitro',
    'mjairstiven@gmail.com',
    '31313131313',
    'CC',
    '123455678',
    'pendiente',
    '',
    'GWSUB-9853F3F8',
    '2026-06-15 19:36:14'
  );

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `gateway_suscription`
--
CREATE TABLE
  `gateway_suscription` (
    `id` int (11) NOT NULL,
    `servicio` varchar(50) NOT NULL,
    `plan` varchar(50) NOT NULL,
    `precio` decimal(10, 2) NOT NULL,
    `nombre` varchar(100) NOT NULL,
    `correo` varchar(100) NOT NULL,
    `telefono` varchar(20) NOT NULL,
    `tipo_doc` varchar(10) NOT NULL,
    `num_doc` varchar(20) NOT NULL,
    `estado` varchar(20) NOT NULL,
    `token` varchar(225) NOT NULL,
    `request_id` varchar(100) NOT NULL,
    `created_at` timestamp NOT NULL DEFAULT current_timestamp()
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `gateway_suscription`
--
INSERT INTO
  `gateway_suscription` (
    `id`,
    `servicio`,
    `plan`,
    `precio`,
    `nombre`,
    `correo`,
    `telefono`,
    `tipo_doc`,
    `num_doc`,
    `estado`,
    `token`,
    `request_id`,
    `created_at`
  )
VALUES
  (
    1,
    'Spotify',
    'Individual',
    14900.00,
    'jair stiven martinez',
    'velixidepg3d@gmail.com',
    '3331111111',
    'CC',
    '12345678',
    'aprobada',
    'TOK-AB18FD04E4924CC6',
    'GWMUS-40C83E5C',
    '2026-05-21 19:16:15'
  ),
  (
    2,
    'Deezer',
    'Premium',
    12900.00,
    'Jair stiven',
    'velixidepg3d@gmail.com',
    '3011111111111',
    'CC',
    '123456789',
    'aprobada',
    'TOK-FDAD3E9E10736763',
    'GWMUS-AA52A7EB',
    '2026-05-22 19:05:50'
  ),
  (
    3,
    'Spotify',
    'Individual',
    14900.00,
    'Jair Stiven',
    'mjairstiven@gmail.com',
    '311111111111',
    'CC',
    '12345678',
    'aprobada',
    'TOK-F8C11614B590E6C7',
    'GWMUS-FED2629F',
    '2026-05-25 06:27:16'
  ),
  (
    4,
    'Spotify',
    'Individual',
    14900.00,
    'jair stiven martinez',
    'mjairstiven@gmail.com',
    '310110101',
    'CC',
    '12345678',
    'aprobada',
    'TOK-361C28C187A3C199',
    'GWMUS-2177357F',
    '2026-05-25 15:13:36'
  ),
  (
    5,
    'Spotify',
    'Individual',
    14900.00,
    'Jair stiven martinez paalcios',
    'jeoestiven@gmail.com',
    '311111111111',
    'CC',
    '1234567789',
    'aprobada',
    'TOK-764D8560131DEDC4',
    'GWMUS-A40A7EDB',
    '2026-05-25 19:47:10'
  ),
  (
    6,
    'Spotify',
    'Individual',
    14900.00,
    'Jair Stiven martnez palacios',
    'jeoestiven@gmail.com',
    '31111111111',
    'CC',
    '12345678',
    'aprobada',
    'TOK-7D71368CE27BC134',
    'GWMUS-F5BC3811',
    '2026-05-25 20:39:46'
  ),
  (
    7,
    'Spotify',
    'Familiar',
    24900.00,
    'Jair Stiven martinez',
    'jeoestiven@gmail.com',
    '300111111111',
    'CC',
    '12345678',
    'cancelada',
    '',
    'GWMUS-48A6C5D2',
    '2026-06-05 13:26:22'
  ),
  (
    8,
    'Spotify',
    'Individual',
    14900.00,
    'Jair Stiven Martinez Palacios',
    'jeoestiven@gmail.com',
    '3092222222',
    'CC',
    '12121212121',
    'aprobada',
    'TOK-6DB54B04DCCC4DDD',
    'GWMUS-34E7B442',
    '2026-06-05 21:12:29'
  ),
  (
    9,
    'Deezer',
    'Familia',
    19900.00,
    'jairsito',
    'mjairstiven@gmail.com',
    '31111111111',
    'CC',
    '121114415r6',
    'aprobada',
    '',
    'GWMUS-3901A733',
    '2026-06-15 01:54:05'
  ),
  (
    10,
    'Deezer',
    'Premium',
    12900.00,
    'Jairsito',
    'mjairstiven@gmail.com',
    '313113131414',
    'CC',
    '12456789',
    'aprobada',
    '',
    'GWMUS-3081B3E7',
    '2026-06-15 01:55:46'
  ),
  (
    11,
    'Spotify',
    'Individual',
    14900.00,
    'sdgvsgvas',
    'mjairstiven@gmail.com',
    '31111111111',
    'CC',
    '12132131314',
    'rechazada',
    '',
    'GWMUS-EA05E268',
    '2026-06-15 02:02:00'
  ),
  (
    12,
    'Spotify',
    'Duo',
    19900.00,
    'dabdabdb',
    'mjairstiven@gmail.com',
    '3111111111111',
    'CC',
    '23425252f',
    'rechazada',
    '',
    'GWMUS-3DFF349A',
    '2026-06-15 02:02:52'
  ),
  (
    13,
    'Spotify',
    'Individual',
    14900.00,
    'Jair stiven martinez palacios',
    'mjairstiven@gmail.com',
    '31414141414',
    'CC',
    '1234565789',
    'rechazada',
    '',
    'GWMUS-E6C2044F',
    '2026-06-15 04:13:35'
  ),
  (
    14,
    'Spotify',
    'Duo',
    19900.00,
    'jairsito',
    'mjairstiven@gmail.com',
    '3131313131',
    'CC',
    '123456677',
    'aprobada',
    '',
    'GWMUS-846E943A',
    '2026-06-15 19:10:01'
  ),
  (
    15,
    'Spotify',
    'Individual',
    14900.00,
    '121212122121212121',
    'mjairstiven@gmail.com',
    '111111111111',
    'CC',
    '121212131456',
    'rechazada',
    '',
    'GWMUS-DA32A1AD',
    '2026-06-15 19:27:05'
  );

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `ordenes`
--
CREATE TABLE
  `ordenes` (
    `id` int (11) NOT NULL,
    `request_id` int (100) NOT NULL,
    `producto` varchar(100) NOT NULL,
    `precio` decimal(10, 2) NOT NULL,
    `jugador_id` varchar(100) NOT NULL,
    `estado` varchar(50) NOT NULL,
    `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ordenes`
--
INSERT INTO
  `ordenes` (
    `id`,
    `request_id`,
    `producto`,
    `precio`,
    `jugador_id`,
    `estado`,
    `created_at`
  )
VALUES
  (
    76,
    3703145,
    '2400 CP',
    29921.00,
    '123456789',
    'aprobada',
    '2026-05-11 19:52:09'
  ),
  (
    77,
    3703150,
    '520 Diamantes',
    19800.00,
    '1122334455',
    'cancelada',
    '2026-05-11 20:46:31'
  ),
  (
    78,
    3703680,
    '310 Diamantes',
    11900.00,
    '21345687109',
    'aprobada',
    '2026-05-12 14:46:49'
  ),
  (
    79,
    3703729,
    '300 Monedas',
    10500.00,
    'ADWF-234-112-965',
    'aprobada',
    '2026-05-12 15:12:31'
  ),
  (
    80,
    3706496,
    '2400 CP',
    29921.00,
    '11122233300',
    'aprobada',
    '2026-05-15 19:25:56'
  ),
  (
    81,
    3707150,
    '100 Diamantes',
    4500.00,
    '78512315',
    'reversada',
    '2026-05-22 19:11:09'
  ),
  (
    82,
    3707152,
    '460 CP',
    12927.00,
    '121313145',
    'aprobada',
    '2026-05-18 03:13:37'
  ),
  (
    83,
    3707469,
    '1100 FC',
    25500.00,
    '1224346787',
    'aprobada',
    '2026-05-18 17:10:49'
  ),
  (
    84,
    3707476,
    '120 Monedas',
    5000.00,
    'ABCD-122-444-555',
    'aprobada',
    '2026-05-18 17:27:38'
  ),
  (
    85,
    3709862,
    '460 CP',
    12927.00,
    '24567675484',
    'aprobada',
    '2026-05-20 22:05:36'
  ),
  (
    86,
    3709952,
    '5000 FC',
    42500.00,
    '11111111111',
    'rechazada',
    '2026-05-21 03:17:19'
  ),
  (
    87,
    3711223,
    '460 CP',
    12927.00,
    '11233345678',
    'aprobada',
    '2026-05-22 19:10:39'
  ),
  (
    88,
    3711345,
    '520 Diamantes',
    19800.00,
    '112435687',
    'aprobada',
    '2026-05-22 19:19:44'
  ),
  (
    89,
    3711398,
    '5000 FC',
    42500.00,
    '123456789',
    'reversada',
    '2026-06-05 23:03:34'
  ),
  (
    90,
    3711406,
    '660 Monedas',
    21000.00,
    'SDFG-123-321-231',
    'rechazada',
    '2026-05-22 21:42:10'
  ),
  (
    91,
    3715693,
    '26000 CP',
    262066.00,
    '123456789',
    'aprobada',
    '2026-05-29 15:35:27'
  ),
  (
    92,
    3715901,
    '1100 FC',
    25500.00,
    '123456789',
    'aprobada',
    '2026-05-29 19:45:59'
  ),
  (
    93,
    3715912,
    '300 Monedas',
    10500.00,
    'ASAS-212-123-121',
    'aprobada',
    '2026-05-29 19:56:00'
  ),
  (
    94,
    3715925,
    '1060 Diamantes',
    38500.00,
    '123456789',
    'aprobada',
    '2026-05-29 20:18:30'
  ),
  (
    95,
    3716064,
    '460 CP',
    12927.00,
    '12121212121212',
    'aprobada',
    '2026-05-29 22:44:29'
  ),
  (
    96,
    3716613,
    '460 CP',
    12927.00,
    '012345678',
    'aprobada',
    '2026-06-01 15:06:00'
  ),
  (
    97,
    3716899,
    'Star Pass',
    18500.00,
    '0011123456',
    'aprobada',
    '2026-06-01 19:42:54'
  ),
  (
    98,
    3746733,
    '88 CP',
    7000.00,
    '123456789',
    'rechazada',
    '2026-06-05 13:00:54'
  ),
  (
    99,
    3776352,
    'Battle Pass',
    24000.00,
    '9061535156',
    'reversada',
    '2026-06-10 16:29:28'
  ),
  (
    100,
    3778555,
    '310 Diamantes',
    11900.00,
    '121345326234',
    'aprobada',
    '2026-06-10 16:45:45'
  ),
  (
    101,
    3778559,
    '300 Monedas',
    10500.00,
    'ASAS-444-111-222',
    'reversada',
    '2026-06-10 16:49:35'
  ),
  (
    102,
    3778650,
    '500 FC',
    14000.00,
    '00123455667',
    'aprobada',
    '2026-06-10 19:11:57'
  ),
  (
    103,
    3778658,
    '500 FC',
    14000.00,
    '123456789',
    'aprobada',
    '2026-06-10 19:16:40'
  ),
  (
    104,
    3778710,
    '1100 CP',
    26233.00,
    '12345678910',
    'aprobada',
    '2026-06-10 20:11:31'
  ),
  (
    105,
    3779260,
    '100 FC',
    6500.00,
    '1234567890',
    'aprobada',
    '2026-06-11 13:49:15'
  ),
  (
    106,
    3779324,
    '520 Diamantes',
    19800.00,
    '56565656565',
    'aprobada',
    '2026-06-11 14:53:49'
  ),
  (
    107,
    3780483,
    '88 CP',
    7000.00,
    '1121212121',
    'aprobada',
    '2026-06-15 03:50:14'
  ),
  (
    108,
    3782835,
    '500 FC',
    14000.00,
    '552143612',
    'aprobada',
    '2026-06-16 19:48:08'
  ),
  (
    109,
    3782836,
    '660 Monedas',
    21000.00,
    'ASSD-131-131-111',
    'aprobada',
    '2026-06-16 19:49:34'
  ),
  (
    110,
    3782838,
    '100 FC',
    6500.00,
    '11111111111',
    'aprobada',
    '2026-06-16 19:51:13'
  );

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `payment_link`
--
CREATE TABLE
  `payment_link` (
    `id` int (11) NOT NULL,
    `producto` varchar(100) NOT NULL,
    `precio` decimal(10, 2) NOT NULL,
    `link_id` varchar(100) DEFAULT NULL,
    `link_url` text DEFAULT NULL,
    `referencia` varchar(100) NOT NULL,
    `descripcion` varchar(200) NOT NULL,
    `estado` varchar(20) DEFAULT 'activo',
    `pagos_usados` int (11) DEFAULT 0,
    `expiracion` datetime NOT NULL,
    `correo` varchar(100) DEFAULT NULL,
    `created_at` timestamp NOT NULL DEFAULT current_timestamp()
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `payment_link`
--
INSERT INTO
  `payment_link` (
    `id`,
    `producto`,
    `precio`,
    `link_id`,
    `link_url`,
    `referencia`,
    `descripcion`,
    `estado`,
    `pagos_usados`,
    `expiracion`,
    `correo`,
    `created_at`
  )
VALUES
  (
    1,
    'Kit Arsenal FC',
    50000.00,
    '819866',
    'https://sites-test.placetopay.com/link/show?genid=819866&code=b2ddedb08f9010393301a1fcc93ef7097a1c85e01f0f77c4d093aac05e2daf11',
    'PL-2EDFB73E',
    'Kit deportivo: Kit Arsenal FC',
    'activo',
    0,
    '2026-06-12 19:40:18',
    'jeoestiven@gmail.com',
    '2026-06-11 17:40:19'
  );

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `recurrencias`
--
CREATE TABLE
  `recurrencias` (
    `id` int (11) NOT NULL,
    `servicio` varchar(50) NOT NULL,
    `plan` varchar(50) NOT NULL,
    `precio` decimal(10, 2) NOT NULL,
    `usuario_id` varchar(100) NOT NULL,
    `estado` varchar(20) NOT NULL,
    `request_id` varchar(100) DEFAULT NULL,
    `periodicidad` varchar(5) NOT NULL,
    `next_payment` date DEFAULT NULL,
    `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
    `fecha_fin` date DEFAULT NULL
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `recurrencias`
--
INSERT INTO
  `recurrencias` (
    `id`,
    `servicio`,
    `plan`,
    `precio`,
    `usuario_id`,
    `estado`,
    `request_id`,
    `periodicidad`,
    `next_payment`,
    `created_at`,
    `fecha_fin`
  )
VALUES
  (
    22,
    'Twitter Verificado',
    'Basic',
    14900.00,
    'mjairstiven@gmail.com',
    'rechazada',
    '3699490',
    'M',
    '2026-06-05',
    '2026-05-05 19:33:11',
    '2027-05-05'
  ),
  (
    23,
    'YouTube Premium',
    'Familiar',
    29900.00,
    'mjairstiven@gmail.com',
    'aprobada',
    '3699530',
    'M',
    '2026-06-05',
    '2026-05-05 20:06:14',
    '2027-05-05'
  ),
  (
    24,
    'Meta Verified',
    'Instagram',
    24900.00,
    'mjairstiven@gmail.com',
    'rechazada',
    '3699534',
    'M',
    '2026-06-05',
    '2026-05-05 20:08:15',
    '2027-05-05'
  ),
  (
    25,
    'Twitter Verificado',
    'Basic',
    14900.00,
    'jeoestiven@gmail.com',
    'aprobada',
    '3700322',
    'M',
    '2026-06-06',
    '2026-05-06 19:48:22',
    '2027-05-06'
  ),
  (
    26,
    'YouTube Premium',
    'Familiar',
    29900.00,
    'mjairstiven@gmail.com',
    'cancelada',
    '3702038',
    'M',
    '2026-06-08',
    '2026-05-08 21:16:14',
    '2027-05-08'
  ),
  (
    27,
    'YouTube Premium',
    'Familiar',
    29900.00,
    'mjairstiven@gmail.com',
    'rechazada',
    '3702069',
    'M',
    '2026-06-09',
    '2026-05-08 22:00:32',
    '2027-05-09'
  ),
  (
    28,
    'YouTube Premium',
    'Familiar',
    29900.00,
    'mjairstiven@gmail.com',
    'reversada',
    '3702070',
    'M',
    '2026-06-09',
    '2026-05-08 22:00:33',
    '2027-05-09'
  ),
  (
    29,
    'Twitter Verificado',
    'Basic',
    14900.00,
    'jeoestiven@gmail.com',
    'cancelada',
    '3702075',
    'M',
    '2026-06-09',
    '2026-05-08 22:09:46',
    '2027-05-09'
  ),
  (
    30,
    'Twitter Verificado',
    'Premium',
    32900.00,
    'jeoestiven@gmail.com',
    'rechazada',
    '3702084',
    'M',
    '2026-06-09',
    '2026-05-08 22:29:06',
    '2027-05-09'
  ),
  (
    31,
    'YouTube Premium',
    'Familiar',
    29900.00,
    'jeoestiven@gmail.com',
    'aprobada',
    '3703815',
    'M',
    '2026-06-12',
    '2026-05-12 16:13:43',
    '2027-05-12'
  ),
  (
    32,
    'Twitter Verificado',
    'Premium',
    32900.00,
    'velixidepg3d@gmail.com',
    'aprobada',
    '3706010',
    'M',
    '2026-06-15',
    '2026-05-15 04:43:38',
    '2027-05-15'
  ),
  (
    33,
    'Meta Verified',
    'Instagram',
    24900.00,
    'jeoestiven@gmail.com',
    'aprobada',
    '3707162',
    'M',
    '2026-06-18',
    '2026-05-18 03:41:05',
    '2027-05-18'
  ),
  (
    34,
    'YouTube Premium',
    'Familiar',
    29900.00,
    'jeoestiven@gmail.com',
    'aprobada',
    '3707165',
    'M',
    '2026-06-18',
    '2026-05-18 03:58:15',
    '2027-05-18'
  ),
  (
    35,
    'Meta Verified',
    'Facebook',
    24900.00,
    'mjairstiven@gmail.com',
    'aprobada',
    '3707185',
    'M',
    '2026-06-18',
    '2026-05-18 04:31:17',
    '2027-05-18'
  ),
  (
    36,
    'Twitter Verificado',
    'Basic',
    14900.00,
    'mjairstiven@gmail.com',
    'aprobada',
    '3707484',
    'M',
    '2026-06-18',
    '2026-05-18 17:36:08',
    '2027-05-18'
  ),
  (
    37,
    'Twitter Verificado',
    'Basic',
    14900.00,
    'mjairstiven@gmail.com',
    'aprobada',
    '3708504',
    'M',
    '2026-06-19',
    '2026-05-19 20:26:21',
    '2027-05-19'
  ),
  (
    38,
    'YouTube Premium',
    'Familiar',
    29900.00,
    'velixidepg3d@gmail.com',
    'aprobada',
    '3711211',
    'M',
    '2026-06-22',
    '2026-05-22 16:54:30',
    '2027-05-22'
  ),
  (
    39,
    'Meta Verified',
    'Instagram',
    24900.00,
    'mjairstiven@gmail.com',
    'aprobada',
    '3711388',
    'M',
    '2026-06-22',
    '2026-05-22 20:07:26',
    '2027-05-22'
  ),
  (
    40,
    'Meta Verified',
    'Facebook',
    24900.00,
    'velixidepg3d@gmail.com',
    'rechazada',
    '3715945',
    'M',
    '2026-06-29',
    '2026-05-29 20:41:24',
    '2027-05-29'
  ),
  (
    41,
    'Twitter Verificado',
    'Premium+',
    49900.00,
    'jeoestiven@gmail.com',
    'aprobada',
    '3776458',
    'M',
    '2026-07-06',
    '2026-06-05 22:43:19',
    '2027-06-06'
  ),
  (
    42,
    'Twitter Verificado',
    'Basic',
    14900.00,
    'jeoestiven@gmail.com',
    'aprobada',
    '3776459',
    'M',
    '2026-07-06',
    '2026-06-05 22:45:01',
    '2027-06-06'
  ),
  (
    43,
    'Twitter Verificado',
    'Premium',
    32900.00,
    'mjairstiven@gmail.com',
    'aprobada',
    '3778405',
    'M',
    '2026-07-10',
    '2026-06-10 15:21:44',
    '2027-06-10'
  ),
  (
    44,
    'YouTube Premium',
    'Individual',
    19900.00,
    'mjairstiven@gmail.com',
    'aprobada',
    '3778688',
    'M',
    '2026-07-10',
    '2026-06-10 19:53:39',
    '2027-06-10'
  );

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `suscripciones`
--
CREATE TABLE
  `suscripciones` (
    `id` int (11) NOT NULL,
    `request_id` varchar(100) NOT NULL,
    `token` varchar(255) NOT NULL,
    `plataforma` varchar(50) NOT NULL,
    `plan` varchar(50) NOT NULL,
    `precio` decimal(10, 2) NOT NULL,
    `usuario_id` varchar(100) NOT NULL,
    `estado` varchar(20) NOT NULL,
    `created_at` timestamp NOT NULL DEFAULT current_timestamp()
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `suscripciones`
--
INSERT INTO
  `suscripciones` (
    `id`,
    `request_id`,
    `token`,
    `plataforma`,
    `plan`,
    `precio`,
    `usuario_id`,
    `estado`,
    `created_at`
  )
VALUES
  (
    53,
    '3693870',
    'b51d3d2e666e042dc34886158ecc352ab31d6c3e7f90b6c9bfe749df1c0d76be',
    'HBO Max',
    'Básico',
    19900.00,
    'jeoestiven@gmail.com',
    'aprobada',
    '2026-04-28 04:36:51'
  ),
  (
    54,
    '3693872',
    '',
    'Disney+',
    'Estándar',
    16900.00,
    'jeoestiven@gmail.com',
    'aprobada',
    '2026-04-28 04:41:02'
  ),
  (
    55,
    '3694222',
    'a0c5a153da858197868b6fb350616ea3ca653315ae9bdc6d448f12b30c5e333d',
    'Netflix',
    'Premium',
    36900.00,
    'velixidepg3d@gmail.com',
    'aprobada',
    '2026-04-28 15:30:48'
  ),
  (
    56,
    '3694267',
    '5481fd6e6c73fd63d17b87662dfcb85b064a8432aa4327f46e310fd647bb4e48',
    'Disney+',
    'Premium',
    28900.00,
    'mjairstiven@gmail.com',
    'aprobada',
    '2026-04-28 16:04:08'
  ),
  (
    57,
    '3694273',
    '',
    'Disney+',
    'Duo Premium',
    38900.00,
    'mjairstiven@gmail.com',
    'aprobada',
    '2026-04-28 16:06:21'
  ),
  (
    58,
    '3694298',
    '7e229e4eee2ced9e9ee332929748940ab4d34b2f08d3661d1ae6014016b81d06',
    'Netflix',
    'Premium',
    36900.00,
    'jeoestiven@gmail.com',
    'aprobada',
    '2026-04-28 16:15:48'
  ),
  (
    59,
    '3699488',
    '',
    'HBO Max',
    'Estándar',
    29900.00,
    'mjairstiven@gmail.com',
    'rechazada',
    '2026-05-05 19:31:11'
  ),
  (
    60,
    '3701604',
    'ffeb5984a437e431b566dea37e9eb6889346a686cd9c42578d7003ccaff3dc22',
    'HBO Max',
    'Básico',
    19900.00,
    'jeoestiven@gmail.com',
    'aprobada',
    '2026-05-08 13:08:54'
  ),
  (
    61,
    '3701623',
    '',
    'Netflix',
    'Estándar',
    26900.00,
    'jeoestiven@gmail.com',
    'aprobada',
    '2026-05-08 13:18:27'
  ),
  (
    62,
    '3701722',
    '',
    'Disney+',
    'Duo Premium',
    38900.00,
    'jeoestiven@gmail.com',
    'aprobada',
    '2026-05-08 15:18:27'
  ),
  (
    63,
    '3701753',
    '',
    'HBO Max',
    'Básico',
    19900.00,
    'velixidepg3d@gmail.com',
    'reversada',
    '2026-05-08 15:53:11'
  ),
  (
    64,
    '3702003',
    '28207f908ddb05905d38ec834a1f7f7044325e29df97379e72aa24811bb813f5',
    'Netflix',
    'Estándar',
    26900.00,
    'mjairstiven@gmail.com',
    'aprobada',
    '2026-05-08 20:47:53'
  ),
  (
    65,
    '3702013',
    '',
    'Disney+',
    'Duo Premium',
    38900.00,
    'mjairstiven@gmail.com',
    'aprobada',
    '2026-05-08 20:52:34'
  ),
  (
    66,
    '3702017',
    '',
    'Netflix',
    'Premium',
    36900.00,
    'mjairstiven@gmail.com',
    'aprobada',
    '2026-05-08 20:58:38'
  ),
  (
    67,
    '3702032',
    'a5c7417a21fdc822bff230042d7ca35efca6c4be48e4314af9b6e593a4cb997b',
    'Netflix',
    'Estándar con Anuncios',
    17900.00,
    'mjairstiven@gmail.com',
    'aprobada',
    '2026-05-08 21:10:56'
  ),
  (
    68,
    '3702080',
    '',
    'Disney+',
    'Estándar',
    16900.00,
    'jeoestiven@gmail.com',
    'aprobada',
    '2026-05-08 22:21:44'
  ),
  (
    69,
    '3702605',
    '',
    'Netflix',
    'Estándar con Anuncios',
    17900.00,
    'mjairstiven@gmail.com',
    'rechazada',
    '2026-05-11 07:15:26'
  ),
  (
    70,
    '3703683',
    '',
    'Netflix',
    'Estándar',
    26900.00,
    'jeoestiven@gmail.com',
    'rechazada',
    '2026-05-12 14:48:48'
  ),
  (
    71,
    '3707159',
    '',
    'HBO Max',
    'Básico',
    19900.00,
    'jeoestiven@gmail.com',
    'aprobada',
    '2026-05-18 03:37:02'
  ),
  (
    72,
    '3707167',
    '',
    'Netflix',
    'Estándar con Anuncios',
    17900.00,
    'jeoestiven@gmail.com',
    'aprobada',
    '2026-05-18 04:00:36'
  ),
  (
    73,
    '3707169',
    '',
    'Disney+',
    'Premium',
    28900.00,
    'mjairstiven@gmail.com',
    'aprobada',
    '2026-05-18 04:05:37'
  ),
  (
    74,
    '',
    '',
    'HBO Max',
    'Estándar',
    29900.00,
    'velixidepg3d@gmail.com',
    'pendiente',
    '2026-05-18 17:30:26'
  ),
  (
    75,
    '3711393',
    '',
    'HBO Max',
    'Básico',
    19900.00,
    'mjairstiven@gmail.com',
    'rechazada',
    '2026-05-22 20:10:51'
  ),
  (
    76,
    '3715930',
    '',
    'Netflix',
    'Estándar con Anuncios',
    17900.00,
    'velixidepg3d@gmail.com',
    'aprobada',
    '2026-05-29 20:16:18'
  ),
  (
    77,
    '3716429',
    '',
    'HBO Max',
    'Básico',
    19900.00,
    'velixidepg3d@gmail.com',
    'aprobada',
    '2026-05-31 14:56:34'
  ),
  (
    78,
    '3746663',
    '',
    'HBO Max',
    'Básico',
    19900.00,
    'jeoestiven@gmail.com',
    'aprobada',
    '2026-06-03 19:37:26'
  ),
  (
    79,
    '3746666',
    '',
    'HBO Max',
    'Ultimate',
    39900.00,
    'jeoestiven@gmail.com',
    'rechazada',
    '2026-06-03 19:40:24'
  ),
  (
    80,
    '3778387',
    '8b47785f51bd46f3d6da6538aaa7f7a7c0a54e713c0ad37120a7a8563ca0f64b',
    'Netflix',
    'Premium',
    36900.00,
    'mjairstiven@gmail.com',
    'aprobada',
    '2026-06-10 15:11:27'
  ),
  (
    81,
    '3778727',
    '88cbae152049b3fe195e606aa8793528b55153562b3bf274543beac58a9d981c',
    'Netflix',
    'Estándar con Anuncios',
    17900.00,
    'mjairstiven@gmail.com',
    'reversada',
    '2026-06-10 20:18:29'
  ),
  (
    82,
    '3779398',
    '462500bd5f326220ebd364f2bd28a964e54a44a0a4fb75cd2c6e71d01b37f222',
    'Netflix',
    'Estándar',
    26900.00,
    'mjairstiven@gmail.com',
    'aprobada',
    '2026-06-11 15:54:58'
  ),
  (
    83,
    '3781945',
    '',
    'HBO Max',
    'Básico',
    19900.00,
    'mjairstiven@gmail.com',
    'pendiente',
    '2026-06-15 19:10:14'
  ),
  (
    84,
    '3781946',
    '',
    'HBO Max',
    'Básico',
    19900.00,
    'mjairstiven@gmail.com',
    'pendiente',
    '2026-06-15 19:10:17'
  ),
  (
    85,
    '3781947',
    '',
    'HBO Max',
    'Básico',
    19900.00,
    'mjairstiven@gmail.com',
    'pendiente',
    '2026-06-15 19:10:21'
  ),
  (
    86,
    '3781948',
    '',
    'HBO Max',
    'Básico',
    19900.00,
    'mjairstiven@gmail.com',
    'aprobada',
    '2026-06-15 19:10:23'
  );

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `suscription`
--
CREATE TABLE
  `suscription` (
    `id` int (11) NOT NULL,
    `servicio` varchar(50) NOT NULL,
    `plan` varchar(50) NOT NULL,
    `precio` decimal(10, 2) NOT NULL,
    `usuario_id` varchar(100) NOT NULL,
    `estado` varchar(20) NOT NULL,
    `request_id` varchar(100) NOT NULL,
    `token` varchar(225) NOT NULL,
    `created_at` timestamp NOT NULL DEFAULT current_timestamp()
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `suscription`
--
INSERT INTO
  `suscription` (
    `id`,
    `servicio`,
    `plan`,
    `precio`,
    `usuario_id`,
    `estado`,
    `request_id`,
    `token`,
    `created_at`
  )
VALUES
  (
    2,
    'Amazon Prime',
    'Mensual',
    9900.00,
    'velixidepg3d@gmail.com',
    'aprobada',
    '3704239',
    '6eb3a3e99ccf8b4d84d70280be768f78758aade4ae46c55081367d9ccf27cd91',
    '2026-05-13 01:38:04'
  ),
  (
    3,
    'Crunchyroll',
    'Fan',
    12900.00,
    'velixidepg3d@gmail.com',
    'aprobada',
    '3704768',
    'd6179bd9935641901c53a9c813d0a0207c42b3fd1c3e53d3b16d56f632409576',
    '2026-05-13 15:25:04'
  ),
  (
    4,
    'Crunchyroll',
    'Fan',
    12900.00,
    'velixidepg3d@gmail.com',
    'aprobada',
    '3706148',
    'fc60885341168e0a403f3d480f47f3dde9eadb71a59331f2c54a4a999cf0b67b',
    '2026-05-15 12:53:19'
  ),
  (
    5,
    'Crunchyroll',
    'Mega Fan',
    19900.00,
    'jeoestiven@gmail.com',
    'aprobada',
    '3707164',
    '384df647624bfad6bba8c1dd52ae6a5fcc27fad273d89c470b21aca1c4971f9b',
    '2026-05-18 03:51:29'
  ),
  (
    6,
    'Amazon Prime',
    'Mensual',
    9900.00,
    'velixidepg3d@gmail.com',
    'aprobada',
    '3707471',
    '9fd21341c5504a89e5a2d81439b509ec18b0c6453e7e28b1d43e64441ff00125',
    '2026-05-18 17:11:22'
  ),
  (
    7,
    'Star+',
    'Estándar',
    19900.00,
    'velixidepg3d@gmail.com',
    'aprobada',
    '3715875',
    '615706a0f83161c0d3af2018dfd2344b9890fcaa6add3378ddd3f5e96dba526c',
    '2026-05-29 19:20:08'
  ),
  (
    8,
    'Amazon Prime',
    'Mensual',
    9900.00,
    'jeoestiven@gmail.com',
    'aprobada',
    '3746668',
    'e37163c49fc68d3e43d9762b216bdc1a4f2094ba961336f974273bb273d15c76',
    '2026-06-03 19:46:31'
  ),
  (
    9,
    'Star+',
    'Estándar',
    19900.00,
    'jeoestiven@gmail.com',
    'aprobada',
    '3746671',
    '0f8ad44411e03141de9b3210c3c97f1e0dc297dc7a79aed628432bbc097d4d94',
    '2026-06-03 19:52:48'
  ),
  (
    10,
    'Crunchyroll',
    'Fan',
    12900.00,
    'mjairstiven@gmail.com',
    'aprobada',
    '3778410',
    'f45452f0efdd2372c647906423861898b5d2c72936272ec932fb7e269325e9ac',
    '2026-06-10 15:23:37'
  ),
  (
    11,
    'Amazon Prime',
    'Mensual',
    9900.00,
    'mjairstiven@gmail.com',
    'aprobada',
    '3778734',
    'c4709e229290ce0e84cfc2da03a73266a18d2510388f4a8009127ebef4d4d9b2',
    '2026-06-10 20:22:19'
  ),
  (
    12,
    'Crunchyroll',
    'Fan',
    12900.00,
    'mjairstiven@gmail.com',
    'pendiente',
    '3778737',
    '',
    '2026-06-10 20:23:26'
  );

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `suscription_rec`
--
CREATE TABLE
  `suscription_rec` (
    `id` int (11) NOT NULL,
    `servicio` varchar(50) NOT NULL,
    `plan` varchar(50) NOT NULL,
    `precio` decimal(10, 2) NOT NULL,
    `usuario_id` varchar(100) NOT NULL,
    `estado` varchar(20) NOT NULL,
    `request_id` varchar(100) NOT NULL,
    `periodicidad` varchar(5) NOT NULL,
    `next_payment` date NOT NULL,
    `fecha_fin` date NOT NULL,
    `created_at` timestamp NOT NULL DEFAULT current_timestamp()
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `suscription_rec`
--
INSERT INTO
  `suscription_rec` (
    `id`,
    `servicio`,
    `plan`,
    `precio`,
    `usuario_id`,
    `estado`,
    `request_id`,
    `periodicidad`,
    `next_payment`,
    `fecha_fin`,
    `created_at`
  )
VALUES
  (
    1,
    'Claude',
    'Pro',
    22900.00,
    'velixidepg3d@gmail.com',
    'aprobada',
    '3704347',
    'M',
    '2026-06-13',
    '2027-05-13',
    '2026-05-13 06:33:44'
  ),
  (
    2,
    'ChatGPT',
    'Pro',
    219000.00,
    'velixidepg3d@gmail.com',
    'aprobada',
    '3706516',
    'M',
    '2026-06-15',
    '2027-05-15',
    '2026-05-15 19:40:39'
  ),
  (
    3,
    'Claude',
    'Pro',
    22900.00,
    'velixidepg3d@gmail.com',
    'pendiente',
    '3716434',
    'M',
    '2026-07-01',
    '2027-05-31',
    '2026-05-31 15:39:33'
  ),
  (
    4,
    'Claude',
    'Pro',
    22900.00,
    'jeoestiven@gmail.com',
    'rechazada',
    '3746646',
    'M',
    '2026-07-03',
    '2027-06-03',
    '2026-06-03 19:24:40'
  ),
  (
    5,
    'Claude',
    'Pro',
    22900.00,
    'jeoestiven@gmail.com',
    'aprobada',
    '3776462',
    'M',
    '2026-07-06',
    '2027-06-06',
    '2026-06-05 22:51:44'
  ),
  (
    6,
    'Claude',
    'Max',
    109000.00,
    'mjairstiven@gmail.com',
    'aprobada',
    '3778408',
    'M',
    '2026-07-10',
    '2027-06-10',
    '2026-06-10 15:22:47'
  ),
  (
    7,
    'ChatGPT',
    'Go',
    8900.00,
    'mjairstiven@gmail.com',
    'pendiente',
    '3778697',
    'M',
    '2026-07-10',
    '2027-06-10',
    '2026-06-10 20:01:22'
  ),
  (
    8,
    'Claude',
    'Pro',
    22900.00,
    'mjairstiven@gmail.com',
    'aprobada',
    '3778740',
    'M',
    '2026-07-10',
    '2027-06-10',
    '2026-06-10 20:24:18'
  ),
  (
    9,
    'ChatGPT',
    'Go',
    89000.00,
    'velixidepg3d@gmail.com',
    'aprobada',
    '3782846',
    'Y',
    '2027-06-16',
    '2027-06-16',
    '2026-06-16 19:53:33'
  );

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `users`
--
CREATE TABLE
  `users` (
    `id` int (11) NOT NULL,
    `nombre` varchar(30) NOT NULL,
    `correo` varchar(50) NOT NULL,
    `usuario` varchar(20) NOT NULL,
    `contraseña` varchar(155) NOT NULL,
    `profile_image` varchar(255) NOT NULL,
    `location` varchar(100) NOT NULL,
    `bio` text NOT NULL
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--
INSERT INTO
  `users` (
    `id`,
    `nombre`,
    `correo`,
    `usuario`,
    `contraseña`,
    `profile_image`,
    `location`,
    `bio`
  )
VALUES
  (
    21,
    'Jair Stiven Martinez Palacios',
    'mjairstiven@gmail.com',
    'Jair!',
    '$2y$10$rOxyr7oLjJdn7sq/zC/6eOqKFPeuTuUi6v8CTJJZATAvGb/RrNwQK',
    'avatar_21_1776653522.jpg',
    'Medellin - Colombia',
    'Delusions keep me going Illusions keep me hoping Parachute woven from broken down Men are from Mars, but there\'s nothing but cold Grow up all alone No fam, no home'
  ),
  (
    22,
    'valencie esimov',
    'velixidepg3d@gmail.com',
    'Valencie asimov',
    '$2y$10$LncnsD6tEIpngrEI.J4XEuYOmqAAiDTrmWR6azA7nY7fD2tjps7Ue',
    'avatar_22_1779467590.jpeg',
    'Argentina',
    'That motherfucker in your window coming to terrorize\r\nCold sweat on your flesh, running down your spine'
  ),
  (
    23,
    'Jeo Stiven Martinez',
    'jeoestiven@gmail.com',
    'Jair Stiven',
    '$2y$10$dKGi6AbogDmDXPLjy5uvw.vzKrU.WhrPk5ZzkluJZyjw3DPeR4XDi',
    'avatar_23_1776625606.jpeg',
    'Medellin - Colombia',
    'ᴛᴜʀɴᴛ ʙᴏʏ, ɪ\'ᴍ ʙᴏᴏᴛᴇᴅ (ɴᴏʀᴛʜ) ɢʀᴇʏ, ᴡᴇ ᴛʜᴇ ᴜɴɪᴛ (ꜱɪᴅᴇ)ᴄʜᴏᴘᴘᴇʀ ɪɴ ᴛʜᴇ ᴘɪᴄᴋᴜᴘ ʟɪᴋᴇ ᴀ ᴍᴏᴛʜᴇʀꜰᴜᴄᴋɪɴ\' ʜᴏᴜᴛʜɪ ᴄʜʀɪꜱᴛ ʀ?'
  );

--
-- Índices para tablas volcadas
--
--
-- Indices de la tabla `gateway_ordenes`
--
ALTER TABLE `gateway_ordenes` ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `gateway_suscripciones`
--
ALTER TABLE `gateway_suscripciones` ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `gateway_suscription`
--
ALTER TABLE `gateway_suscription` ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ordenes`
--
ALTER TABLE `ordenes` ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `payment_link`
--
ALTER TABLE `payment_link` ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `recurrencias`
--
ALTER TABLE `recurrencias` ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `suscripciones`
--
ALTER TABLE `suscripciones` ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `suscription`
--
ALTER TABLE `suscription` ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `suscription_rec`
--
ALTER TABLE `suscription_rec` ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users` ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--
--
-- AUTO_INCREMENT de la tabla `gateway_ordenes`
--
ALTER TABLE `gateway_ordenes` MODIFY `id` int (11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 61;

--
-- AUTO_INCREMENT de la tabla `gateway_suscripciones`
--
ALTER TABLE `gateway_suscripciones` MODIFY `id` int (11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 25;

--
-- AUTO_INCREMENT de la tabla `gateway_suscription`
--
ALTER TABLE `gateway_suscription` MODIFY `id` int (11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 16;

--
-- AUTO_INCREMENT de la tabla `ordenes`
--
ALTER TABLE `ordenes` MODIFY `id` int (11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 111;

--
-- AUTO_INCREMENT de la tabla `payment_link`
--
ALTER TABLE `payment_link` MODIFY `id` int (11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 2;

--
-- AUTO_INCREMENT de la tabla `recurrencias`
--
ALTER TABLE `recurrencias` MODIFY `id` int (11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 45;

--
-- AUTO_INCREMENT de la tabla `suscripciones`
--
ALTER TABLE `suscripciones` MODIFY `id` int (11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 87;

--
-- AUTO_INCREMENT de la tabla `suscription`
--
ALTER TABLE `suscription` MODIFY `id` int (11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 13;

--
-- AUTO_INCREMENT de la tabla `suscription_rec`
--
ALTER TABLE `suscription_rec` MODIFY `id` int (11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 10;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;

/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;