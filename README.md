# **💳 Plance — Plataforma de pagos con PlaceToPay**

---

## 🛠️ Stack tecnológico y Arquitectura

![PHP](https://img.shields.io/badge/PHP-8.5-777BB4?logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-Database-4479A1?logo=mysql&logoColor=white)
![Composer](https://img.shields.io/badge/Composer-PSR--4-885630?logo=composer&logoColor=white)
![PHPUnit](https://img.shields.io/badge/PHPUnit-Tests-3C9CD7?logo=php&logoColor=white)
![PlaceToPay](https://img.shields.io/badge/PlaceToPay-Web%20Checkout%20%2F%20Gateway%20%2F%20Links-FF6C0C)
![Architecture](https://img.shields.io/badge/Architecture-Layered%20(Repository%20%2F%20Service%20%2F%20Controller)-blue)
![GitHub repo size](https://img.shields.io/github/repo-size/Jonathand77/plance)
![GitHub last commit](https://img.shields.io/github/last-commit/Jonathand77/plance)
![Languages](https://img.shields.io/github/languages/count/Jonathand77/plance)

## 👤 Autor

| 👨‍💻 Nombre | 📧 Correo | 🏫 Link directo al repositorio | 🐙 Usuario GitHub |
|---|---|---|---|
| **Jonathan David Fernandez Vargas** | jonathanfdez62@gmail.com | [LinkRepositorio](https://github.com/Jonathand77/plance) | [jonathand77](https://github.com/jonathand77) |

**Aplicación PHP de e-commerce/pagos que integra las tres APIs de PlaceToPay (Web Checkout, API Gateway y Payment Links) para vender productos digitales, gestionar suscripciones/recurrencias, dispersar pagos y reservar servicios.**

---

## 1. 🔍 Introducción

Plance es una tienda demo que centraliza distintos flujos de cobro sobre la pasarela **PlaceToPay (sandbox)**: compras puntuales (juegos, plataformas, textil), pagos mixtos (abono + saldo restante), suscripciones y recurrencias con tokenización, dispersión de pagos, preautorizaciones de reserva y links de pago. Cada dominio de negocio vive en su propia capa de **Repository → Service → Controller**, con los puntos de entrada físicos en `public/` delegando toda la lógica a `src/`.

El proyecto nació como un monolito PHP sin capas (HTML, SQL y lógica mezclados en el mismo archivo) y fue refactorizado de forma incremental — módulo por módulo, sin framework — hacia esta arquitectura, sin dejar de funcionar en ningún paso intermedio.

## 2. ⚙️ Requisitos Previos

Antes de comenzar, asegúrate de contar con:
- Git
- PHP 8.1 o superior (probado con PHP 8.5), con las extensiones `pdo_mysql`, `openssl`, `mbstring` y `curl` habilitadas
- [Composer](https://getcomposer.org/)
- MySQL Server 8.0 o superior, corriendo localmente
- Un navegador web (Chrome, Edge, Firefox, etc.)
- Un editor de código como Visual Studio Code (opcional)

## 📦 Estructura del Proyecto

```
plance/
├── public/                       # Document root — único código servido por el navegador
│   ├── index.php, login.php, sesiones.php
│   ├── retorno_*.php             # 14 callbacks de retorno de la pasarela (uno por flujo)
│   ├── games/ · plataformas/ · textil/      # Catálogos de producto por dominio
│   ├── dispersiones/ · reservasiones/       # Dispersión de pagos y reservas
│   ├── historial/ · profile/ · settings/ · guias/
│   ├── php/                      # Entry points de proceso (login, notify, crear_*)
│   ├── assets/
│   │   ├── css/{estilos.css, pages/, components/}
│   │   ├── js/{pages/, components/}
│   │   └── mockup-dev-placetopay/   # Payment API Explorer (Guía Developer)
│   └── uploads/
│
├── views/                        # HTML de cada página, espeja la ruta de public/
│
├── src/                          # PSR-4 Plance\
│   ├── Config/                   # Env (.env) y Database (PDO)
│   ├── Repositories/             # Acceso a datos — PDO + prepared statements
│   │   └── Contracts/            # Interfaces (inversión de dependencias)
│   ├── Services/                 # Lógica de negocio + integración PlaceToPay
│   │   └── Auth, Ordenes, Dispersiones, Reservaciones,
│   │       Suscripciones, PaymentLinks, Payments, Historial, Profile
│   ├── Controllers/             # Orquestan Request -> Service -> vista
│   └── Support/                  # EstadoMapper, SafeRedirect, Migrator
│
├── database/
│   ├── migrate.php               # Runner de migraciones (CLI)
│   └── migrations/               # 12 migraciones versionadas, una por tabla
│
├── tests/                        # PHPUnit (Repositories, Services)
├── .env.example
├── composer.json
├── phpcs.xml                     # PSR-12 sobre src/ y tests/
└── phpunit.xml
```

---

## 3. 🖥️ Guía Paso a Paso para Levantar el Proyecto

### 3.1 Clonar el repositorio

```bash
git clone https://github.com/Jonathand77/plance.git
cd plance
```

### 3.2 Instalar dependencias

```bash
composer install
```

### 3.3 Configurar variables de entorno

```bash
copy .env.example .env    # en Windows (o: cp .env.example .env)
```

Edita `.env` con:
- Credenciales de tu MySQL local (`DB_HOST`, `DB_PORT`, `DB_NAME`, `DB_USER`, `DB_PASS`).
- Credenciales de sandbox de PlaceToPay (`P2P_LOGIN_ESTANDAR` / `P2P_SECRET_ESTANDAR`, y opcionalmente `P2P_LOGIN_DISPERSION` / `P2P_LOGIN_RESERVACIONES` con sus respectivos secrets).
- `APP_BASE_URL`, ajustada a cómo vayas a servir el proyecto (por ejemplo `http://localhost:8000` si usas el servidor embebido de PHP en el paso 3.5).

### 3.4 Levantar la Base de Datos

**⚠️ Nota:** Este proyecto no requiere Docker, se conecta contra un MySQL local ya instalado.

Crea la base de datos vacía (el nombre debe coincidir con `DB_NAME` en tu `.env`):

```bash
mysql -u root -p -e "CREATE DATABASE place_bsd CHARACTER SET utf8mb4;"
```

Y corre las migraciones:

```bash
php database/migrate.php
```

**Esto creará** las 12 tablas del proyecto (`users`, `ordenes`, `dispersiones`, `reservaciones`, `recurrencias`, `suscripciones`, `suscription`, `suscription_rec`, `payment_link`, `gateway_ordenes`, `gateway_suscripciones`, `gateway_suscription`) y una tabla `migrations` que registra qué scripts ya se aplicaron, para que `migrate.php` sea seguro de correr de nuevo.

### 3.5 Ejecutar el proyecto

```bash
php -S localhost:8000 -t public
```

**Ya puedes abrir en el navegador y utilizar la aplicación:**
`http://localhost:8000`

---

## 4. 🗄️ Modelo de Datos y Buenas Prácticas

### 4.1 Tablas principales

| Tabla | Dominio |
|---|---|
| `users` | Autenticación y perfil |
| `ordenes` | Compras puntuales y pagos mixtos (juegos, plataformas, textil) |
| `dispersiones` | Dispersión de pagos a terceros |
| `reservaciones` | Reservas con preautorización |
| `recurrencias` | Cobros recurrentes simples |
| `suscripciones` / `suscription` | Suscripción + tokenización de tarjeta (dos catálogos independientes) |
| `suscription_rec` | Suscripción con recurrencia programada |
| `payment_link` | Links de pago (PlaceToPay Payment Links) |
| `gateway_ordenes` / `gateway_suscripciones` / `gateway_suscription` | Mismos flujos anteriores, procesados vía API Gateway en vez de Web Checkout |

### 4.2 Buenas Prácticas y Arquitectura
- **Separación de responsabilidades**: `Repositories/` (acceso a datos), `Services/` (reglas de negocio e integración con PlaceToPay), `Controllers/` (orquestación delgada), `views/` (presentación).
- **Seguridad**: todas las consultas usan PDO con sentencias preparadas; sin credenciales hardcodeadas (todo vía `.env`); redirecciones externas validadas (`Support/SafeRedirect`); verificación de propiedad de recursos antes de mostrarlos o modificarlos.
- **Webhook de PlaceToPay** (`public/php/notify.php`): valida la firma `X-Signature`, ubica la transacción por su `request_id` (no por texto de referencia) y actualiza el estado correcto entre los 11 tipos de transacción soportados.
- **Mapeo de estados centralizado** (`Support/EstadoMapper`): traduce los estados de PlaceToPay (`APPROVED`/`REJECTED`/`PENDING`) al estado persistido en BD.
- **Migraciones versionadas**: cada tabla tiene su propio script en `database/migrations/`, aplicado una sola vez y registrado en la tabla `migrations`.
- **Tests**: `vendor/bin/phpunit` sobre `tests/`; `vendor/bin/phpcs` valida PSR-12 en `src/` y `tests/`.

## 5. 💳 Integración con PlaceToPay

| API | Uso en el proyecto | Endpoint sandbox |
|---|---|---|
| **Web Checkout** | Sesión de pago redirigida (compras, suscripciones, pagos mixtos) | `checkout-test.placetopay.com/api/session` |
| **API Gateway** | Cobro directo desde el backend (variantes "gateway" de cada dominio) | `api-test.placetopay.com/rest/gateway/process` |
| **Payment Links** | Generación de links de pago para envío directo al cliente | `sites-test.placetopay.com/api/payment-link` |

Cada tipo de credencial (`estandar`, `dispersion`, `reservaciones`) se resuelve por separado desde `.env` vía `PlaceToPayCredentials`, y toda la comunicación con la pasarela pasa por `Services/Payments/PlaceToPayClient`.

## 6. 🧭 Módulos de la aplicación

- **Autenticación**: registro/login opcional, sesiones.
- **Catálogos** (`games/`, `plataformas/`, `textil/`): compra puntual vía Web Checkout o API Gateway.
- **Dispersiones**: envío de pagos a un destinatario.
- **Reservaciones**: reserva de servicios con preautorización.
- **Suscripciones y recurrencias**: alta, tokenización de tarjeta y cobro recurrente automático.
- **Historial**: consulta de transacciones por usuario, separado por tipo.
- **Perfil y ajustes**: datos de cuenta y calendario de actividad.
- **Guía Developer — Payment API Explorer**: explorador interactivo (`guias/guia-developer.php`) para probar las tres APIs de PlaceToPay desde el navegador.

---
## **Fin de la guía y manual de usuario.**
---
