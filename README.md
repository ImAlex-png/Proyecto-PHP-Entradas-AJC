# Sistema de Gestión de Entradas

Este proyecto permite gestionar la compra de entradas de cine mediante selección de asientos, generación de códigos QR, descarga en PDF y envío por correo electrónico.

## Descripción general

El usuario se autentica con nombre, contraseña y email. Selecciona un cine y asiento disponible. Recibe un QR que enlaza con entrada.php. Puede descargar la entrada en PDF o enviarla por correo.

## Requisitos

- PHP 7.4+ con extensión GD.
- Composer para gestionar dependencias.
- Acceso SMTP (Gmail) para envío por PHPMailer.

## Instalación

1. Clonar el repositorio en tu servidor web.
2. Ejecutar `composer install` en la raíz del proyecto.
3. Ajustar permisos de escritura en la carpeta de la librería de códigos QR.
4. Configurar credenciales SMTP en `codigoCorreo.php`.

## Uso

1. Accede a `inicio.php` para iniciar sesión.
2. Selecciona cine y asiento en `asientos.php`.
3. Genera el QR en `codigo.php`.
4. Descarga PDF con `codigoPdf.php` o envía email con `codigoCorreo.php`.
5. Valida tu entrada escaneando el QR en `entrada.php`.

## Librerías externas

- **phpqrcode** (carpeta `lib/phpqrcode`): generación de códigos QR.
- **FPDF** (carpeta `lib/fpdf186`): creación de documentos PDF.
- **PHPMailer** (carpeta `vendor/phpmailer` a través de Composer): envío de correos vía SMTP.

## Estructura de archivos

### `inicio.php`
Presenta el formulario de login y muestra mensajes de error almacenados en sesión.  
Inicia la sesión para poder leer y mostrar mensajes. Muestra campos para usuario, contraseña, email y selección de cine. Envía los datos mediante el método POST al archivo `validacion.php` para validarlos.

### `validacion.php`
Valida credenciales y correo, y utiliza sesiones y cookies para mantener el estado.  
Compara usuario y contraseña con una lista interna de usuarios permitidos. Sanea y valida el email con filtros de PHP y usa excepciones para errores de formato. Guarda en sesión el usuario y el email, crea una cookie con el cine elegido y redirige a `asientos.php`. En caso de error, guarda el mensaje en sesión y redirige a `inicio.php`.

### `asientos.php`
Muestra una tabla sencilla con los asientos disponibles para elegir.  
Inicia sesión para poder mantener el contexto del usuario. Presenta una tabla HTML con enlaces a `codigo.php` pasando el número de asiento por la URL. Cada asiento disponible se representa como un enlace individual.

### `codigo.php`
Genera el código QR que representa la información completa de la entrada.  
Recupera de la sesión el usuario y del cookie el cine seleccionado. Toma el número de asiento desde los parámetros de la URL. Construye una URL que apunta a `entrada.php` con los datos de usuario, asiento y cine. Utiliza la librería de la carpeta `lib/phpqrcode` para generar una imagen PNG del QR y la guarda en el servidor. Muestra el QR en pantalla y ofrece enlaces para descargar la entrada en PDF o enviarla por correo.

### `codigoPdf.php`
Crea un documento PDF con la información de la entrada utilizando la librería FPDF.  
Inicia sesión y recupera usuario, cine y asiento guardados previamente. Crea un nuevo documento PDF, agrega una página y configura la tipografía. Escribe en el PDF los datos del usuario, el cine y el asiento. Inserta la imagen del código QR previamente generado (`codigo.png`) dentro del PDF. Envía el PDF resultante al navegador para que el usuario lo descargue o lo visualice.

### `codigoCorreo.php`
Envía la entrada por correo electrónico usando la librería PHPMailer cargada desde vendor.  
Inicia sesión y recupera usuario, cine, asiento y email almacenados en la sesión y cookie. Carga el autoloader de Composer desde la carpeta vendor para obtener PHPMailer. Configura una conexión SMTP (por ejemplo, Gmail) incluyendo host, puerto, usuario y contraseña. Define remitente, destinatario, asunto y cuerpo del correo en formato HTML con los datos de la entrada. Adjunta la imagen del QR (`codigo.png`) al correo, lo envía y, si todo va bien, redirige a `entrada.php`.

### `entrada.php`
Valida la entrada cuando se accede a ella desde el QR.  
Recupera de la URL los parámetros de usuario, asiento y cine. Compara esos datos con una lista de entradas válidas definida en el propio archivo. Marca la entrada como válida o no según coincidan los datos con la lista. Si considera la entrada no válida, guarda un mensaje de error en sesión y redirige a `inicio.php`. Si la entrada es válida, muestra en pantalla los datos de usuario, asiento y cine como confirmación.

### `composer.json`
Define las dependencias del proyecto que Composer debe instalar.  
Indica que el proyecto requiere la librería `phpmailer/phpmailer` en una versión 7.0 o superior. Permite a Composer descargar y gestionar la librería en la carpeta vendor.

### `composer.lock`
Bloquea las versiones exactas de las librerías instaladas para garantizar consistencia entre instalaciones.  
Contiene la información detallada de la versión específica de `phpmailer/phpmailer` que se ha instalado. Asegura que todos los desarrolladores y entornos usen las mismas versiones de las dependencias.
