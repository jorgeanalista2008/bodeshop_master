# 💎 Shop Master - Cristalería Latinoamericana
> Plataforma de Comercio Electrónico, Catálogo Digital y Gestión Integral de Ventas (E-Commerce + POS + ERP)

[![PHP Version](https://img.shields.io/badge/PHP-8.0%20%7C%208.1-777BB4?style=flat-square&logo=php&logoColor=white)](https://php.net)
[![Framework](https://img.shields.io/badge/Framework-CodeIgniter%203-EE4326?style=flat-square&logo=codeigniter&logoColor=white)](https://codeigniter.com)
[![Database](https://img.shields.io/badge/Database-MySQL%20%7C%20MariaDB-4479A1?style=flat-square&logo=mysql&logoColor=white)](https://mysql.com)
[![Status](https://img.shields.io/badge/Status-Production%20Ready-success?style=flat-square)](#)
[![License](https://img.shields.io/badge/License-Proprietary-blue?style=flat-square)](#)

---

## 📖 Descripción General

**Shop Master** es una solución integral de comercio electrónico y gestión empresarial optimizada para el sector de cristalería, aluminios, accesorios y ferretería técnica. Combina una moderna experiencia de compra para el cliente con un potente backoffice para inventarios, ventas físicas en mostrador (POS), cotizaciones, facturación y reportes analíticos.

---

## ✨ Características Principales

### 🛍️ Tienda Virtual y Experiencia de Usuario (Storefront)
- **Vitrina Dinámica de Productos**: Grid responsivo con estilo moderno inspirado en MercadoLibre, tarjetas de producto con badges de marca, precios formateados y etiquetas de envío disponible.
- **Modo Luz / Modo Dark (Dual Theme)**: Selector segmentado en pie de página y acceso rápido en la cabecera superior. Persistencia en `localStorage` con script anti-FOUC (cero parpadeos en blanco).
- **Ficha de Producto de Alta Conversión**:
  - Galería multimedia con soporte para modal lightbox.
  - Caja de precios en tiempo real con soporte para ofertas y descuentos porcentuales.
  - Selector de cantidades y selección de variantes/medidas.
  - Pestañas técnicas: descripción detallada, especificaciones y políticas de embalaje seguro.
- **Botón Inteligente de WhatsApp**: Botón flotante pulsante con enlace directo prellenado con el producto seleccionado para atención personalizada.
- **Páginas Institucionales y Servicios**: Páginas CMS rediseñadas con banner hero, mapa interactivo integrado de Google Maps y accesos directos de contacto.
- **Autenticación con Google**: Especificación y arquitectura lista para inicio de sesión en un solo clic mediante Google OAuth 2.0 / OpenID Connect.

### 💼 Backoffice Administrativo y POS
- **Panel de Control Centralizado**: Métricas en tiempo real de ventas, compras, clientes y nivel de stock.
- **Punto de Venta (POS)**: Interfaz táctil y rápida para ventas en mostrador, compatible con impresoras térmicas y lectores de códigos de barras.
- **Inventario y Almacenes**: Múltiples almacenes, transferencias, ajustes, conteos de inventario y alertas automáticas de existencias bajas.
- **Gestión Financiera**: Control de compras a proveedores, gastos operativos, pagos parciales y reportes de ganancias y pérdidas.
- **Login Administrativo Moderno**: Nueva pantalla de acceso profesional con diseño mesh gradient, tarjeta glassmorphism y visor de contraseña.

---

## 🛠️ Stack Tecnológico

- **Backend**: PHP 8.0+ / CodeIgniter 3 (Arquitectura MVC).
- **Base de Datos**: MySQL 5.7+ / MariaDB 10.3+.
- **Frontend**: HTML5 Semántico, CSS3 con Custom Properties (Variables), JavaScript (ES6+), jQuery, Bootstrap 3 adaptado con Flexbox.
- **Tipografía**: *Plus Jakarta Sans* (Google Fonts).
- **Autenticación**: Ion Auth integrado con soporte de proveedores sociales.
- **Generación de Documentos**: Dompdf (exportación de facturas, cotizaciones y reportes PDF).

---

## 📁 Estructura del Repositorio

```plaintext
shop_master/
├── app/                        # Núcleo de la aplicación CodeIgniter
│   ├── config/                 # Configuración (rutas, base de datos, sesiones)
│   ├── controllers/            # Controladores (Tienda, Admin, API REST, POS)
│   │   ├── admin/              # Módulos del panel administrativo
│   │   ├── api/v1/             # Endpoints REST API
│   │   └── shop/               # Lógica del escaparate virtual y carrito
│   ├── models/                 # Modelos de consulta a base de datos
│   └── views/                  # Vistas del sistema
├── assets/                     # Recursos estáticos globales
│   ├── custom/                 # CSS y JS personalizados (shop.css, shop.js, etc.)
│   └── uploads/                # Imágenes de productos, categorías y logos
├── files/                      # Archivos generados (PDFs, temporales)
├── themes/                     # Plantillas visuales
│   └── default/
│       ├── admin/              # Vistas del tema administrativo
│       └── shop/               # Vistas del escaparate (header, footer, lobby, PDP)
├── vendor/                     # Dependencias gestionadas por Composer
├── .gitignore                  # Reglas de exclusión de archivos grandes y temporales
├── .htaccess                   # Reglas de reescritura y seguridad Apache
├── index.php                   # Punto de entrada de la aplicación
├── MODULO_REGISTRO_LOGIN_GOOGLE.md # Especificación técnica del login con Google
└── README.md                   # Documentación oficial del proyecto
```

---

## 🚀 Guía de Instalación y Despliegue

### 1. Requisitos del Servidor
- Servidor Web Apache con módulo `mod_rewrite` habilitado.
- PHP 8.0 o PHP 8.1 con las siguientes extensiones:
  - `php-mysqli` / `php-pdo`
  - `php-mbstring`
  - `php-curl`
  - `php-gd`
  - `php-zip`
  - `php-intl`
- Base de datos MySQL 5.7+ o MariaDB.

### 2. Clonación del Repositorio
```bash
git clone https://github.com/jorgeanalista2008/shop_master.git
cd shop_master
```

### 3. Configuración de Base de Datos
1. Crea una base de datos vacía en tu servidor (ej. `shop_master_db`).
2. Importa el archivo de estructura `.sql` inicial mediante phpMyAdmin o consola MySQL:
   ```bash
   mysql -u usuario -p shop_master_db < u646234231_cristal_gus.sql
   ```
3. Edita el archivo `app/config/database.php` con tus credenciales:
   ```php
   $db['default']['hostname'] = 'localhost';
   $db['default']['username'] = 'tu_usuario_bd';
   $db['default']['password'] = 'tu_clave_bd';
   $db['default']['database'] = 'shop_master_db';
   ```

### 4. Configuración de la URL Base
Edita el archivo `app/config/config.php` indicando la URL donde se aloja el proyecto:
```php
$config['base_url'] = 'https://tudominio.com/'; // En producción
// o en entorno local:
// $config['base_url'] = 'http://localhost:8081/wwww/cristaleria/';
```

### 5. Permisos de Carpetas
Asegúrate de otorgar permisos de escritura a los siguientes directorios para la subida de imágenes y generación de archivos:
```bash
chmod -R 775 assets/uploads/
chmod -R 775 files/
chmod -R 775 app/cache/
```

---

## 🌐 Despliegue en Hostinger

1. En el panel de **Hostinger (hPanel)** ve a: **Avanzado > Git**.
2. Conecta tu repositorio de GitHub:
   - **Repositorio**: `https://github.com/jorgeanalista2008/shop_master`
   - **Rama**: `main`
   - **Directorio de instalación**: `/public_html` (o el subdominio elegido).
3. Haz clic en **Crear / Desplegar**.
4. En **Bases de Datos MySQL**:
   - Crea tu base de datos y usuario.
   - Accede a phpMyAdmin e importa la base de datos `.sql`.
5. En el **Administrador de Archivos**:
   - Ajusta las credenciales en `app/config/database.php`.
   - Verifica el `base_url` en `app/config/config.php`.
6. En **Configuración de PHP**, selecciona **PHP 8.0** o **PHP 8.1**.

---

## 🔐 Accesos Predeterminados (Admin)

- **URL de Acceso Administrativo**: `/admin/login`
- **Usuario**: `admin@shop.com` (o el correo administrativo configurado en tu base de datos)
- **Rol**: Owner / Administrador General

---

## 👨‍💻 Autor y Mantenimiento

- **Desarrollador / Propietario**: Jorge Rafa ([@jorgeanalista2008](https://github.com/jorgeanalista2008))
- **Proyecto**: Shop Master - Cristalería Latinoamericana

---
*Documentación generada para control de versiones y despliegue continuo en Hostinger y servidores Apache.*
