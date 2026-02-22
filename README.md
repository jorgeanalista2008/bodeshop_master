🛒 BodeShop Master - Plataforma de Comercio Integral
https://img.shields.io/badge/Licencia-MIT-blue.svg
https://img.shields.io/badge/PHP-7.4%252B-purple
https://img.shields.io/badge/Estado-En%2520Desarrollo-yellow

BodeShop Master es una plataforma de comercio electrónico y punto de venta (TPV/POS) todo-en-uno. Diseñada para gestionar de principio a fin un negocio, permite administrar un catálogo de productos en línea, procesar pedidos con un carrito de compras y operar de manera presencial con un sistema de punto de venta (POS). También incluye módulos para el seguimiento de envíos, la gestión de facturas y el control de compras a proveedores.

✨ Características Principales
Catálogo de Productos: Muestra dinámica de productos con imágenes, precios y stock.

Carrito de Compras: Experiencia de compra fluida para clientes en la tienda online.

Punto de Venta (POS): Interfaz táctil y rápida para ventas en local, optimizada para mostrador.

Gestión de Facturación: Generación automática de facturas, tickets y notas de crédito.

Seguimiento de Envíos (Tracking): Actualización del estado del pedido para el cliente y el administrador.

Módulo de Compras: Control de inventario y registro de órdenes de compra a proveedores.

Panel de Administración: Gestión centralizada de usuarios, productos, pedidos y configuración del negocio.

🛠️ Tecnologías Utilizadas
Backend: PHP (56.7%)

Frontend: JavaScript (24.2%), CSS (12.9%), SCSS (3.4%)

Base de Datos: MySQL (inferido por la naturaleza del proyecto)

Otros: HTML (0.2%), Hack (2.6%)

Entorno: Servidor Apache (compatible con .htaccess)

📁 Estructura del Proyecto
plaintext
bodeshop_master/
├── app/                # Lógica principal de la aplicación (controladores, modelos)
├── assets/             # Archivos estáticos (CSS, JavaScript, imágenes)
├── files/              # Almacenamiento de archivos generados (facturas PDF, etc.)
├── servicio/           # Módulos de servicios externos o APIs
├── soporte/            # Archivos de soporte, helpers o librerías internas
├── st/                 # (Posiblemente) Archivos para el módulo de Stock/Inventario
├── system/             # Núcleo del sistema, configuraciones globales
├── tasa/               # Gestión de tasas, impuestos o tipos de cambio
├── themes/             # Plantillas y temas visuales de la tienda
├── vendor/             # Dependencias de terceros (Composer)
├── wp-includes/        # (Potencial integración o herencia de WordPress)
├── .htaccess           # Configuración para servidor Apache (URLs amigables, seguridad)
└── index.php           # Punto de entrada principal de la aplicación
⚙️ Instalación y Configuración
Sigue estos pasos para poner en marcha BodeShop Master en tu entorno local o servidor.

Prerrequisitos
Servidor Web: Apache (recomendado) o Nginx.

PHP: Versión 7.4 o superior.

Base de Datos: MySQL 5.7+ o MariaDB.

Composer (Opcional, para gestionar dependencias PHP).

Node.js / npm (Opcional, si se desea compilar assets SCSS/JS).

Pasos de Instalación
Clonar el repositorio

bash
git clone https://github.com/jorgeanalista2008/bodeshop_master.git
cd bodeshop_master
Configurar la Base de Datos

Crea una base de datos vacía en MySQL (ej. bodeshop_db).

Importa el archivo SQL que debe encontrarse en la raíz o en la carpeta files/ (normalmente database.sql o bodeshop.sql). Nota: Si no se incluye, revisa la documentación interna en /soporte.

Configurar el Entorno

Renombra o copia el archivo de configuración de ejemplo (si existe, ej. config.php.example a config.php).

Edita config.php o el archivo de configuración correspondiente (posiblemente en /system) con los datos de tu base de datos y la URL de tu sitio.

php
// Ejemplo hipotético
define('DB_HOST', 'localhost');
define('DB_USER', 'tu_usuario');
define('DB_PASS', 'tu_contraseña');
define('DB_NAME', 'bodeshop_db');
Establecer Permisos

Asegúrate de que las carpetas files/ y assets/ tengan permisos de escritura por el servidor web (ej. chmod -R 775 files/).

Acceder a la Plataforma

Tienda/Usuario final: http://tudominio.com/bodeshop_master/

Panel de Administración/POS: http://tudominio.com/bodeshop_master/admin (o la ruta definida, posiblemente /st o /servicio).

Las credenciales por defecto suelen ser admin / admin o admin / 123456. Cámbialas inmediatamente después del primer acceso.

🚀 Uso
Para Clientes: Navega por el catálogo, agrega productos al carrito y completa el proceso de compra.

Para Administradores/Cajeros: Accede al POS (Punto de Venta) para registrar ventas rápidas. Utiliza el panel para gestionar productos, ver pedidos y generar facturas.

Para Gestión de Inventario: Utiliza el módulo de compras para registrar la entrada de nuevos productos y mantener el stock actualizado.

🗺️ Roadmap (Ideas de Desarrollo Futuro)
Implementación de pasarelas de pago (PayPal, Stripe, transferencia bancaria).

Módulo de informes y estadísticas avanzadas.

Integración con APIs de envío para cálculo automático de costos.

App móvil básica (PWA).

Soporte multi-idioma.

🤝 Contribuciones
¡Las contribuciones son bienvenidas! Si tienes ideas para mejorar la plataforma, por favor:

Haz un Fork del proyecto.

Crea tu rama de características (git checkout -b feature/AmazingFeature).

Haz commit de tus cambios (git commit -m 'Add some AmazingFeature').

Haz Push a la rama (git push origin feature/AmazingFeature).

Abre un Pull Request.

📝 Licencia
Este proyecto está bajo la Licencia MIT. Consulta el archivo LICENSE para más detalles.

📞 Contacto
Desarrollador: jorgeanalista2008

Enlace del Proyecto: https://github.com/jorgeanalista2008/bodeshop_master

¡Gracias por usar BodeShop Master! Si encuentras útil este proyecto, no olvides darle una ⭐ en GitHub.
