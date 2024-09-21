# Usamos una imagen de Apache como base
FROM httpd:latest

# Actualizamos el sistema y instalamos los paquetes necesarios
RUN apt-get update && apt-get install -y \
    php \
    libapache2-mod-php \
    php-mysql \
    mysql-client \
 && rm -rf /var/lib/apt/lists/*

# Copiamos los archivos de la página web al directorio del servidor Apache 234
COPY ./mi_pagina_web/ /usr/local/apache2/htdocs/

# Copiamos el archivo de inicialización de la base de datos MySQL
COPY ./init.sql /docker-entrypoint-initdb.d/

# Exponemos el puerto 80 para acceder a la página web
EXPOSE 80
