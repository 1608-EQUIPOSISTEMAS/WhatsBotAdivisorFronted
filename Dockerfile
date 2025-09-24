FROM ghcr.io/library/ubuntu:22.04

# Evitar preguntas durante la instalación
ENV DEBIAN_FRONTEND=noninteractive

# Actualizar e instalar dependencias
RUN apt-get update && apt-get install -y \
    apache2 \
    php8.1 \
    php8.1-mysql \
    php8.1-mysqli \
    php8.1-pdo \
    libapache2-mod-php8.1 \
    && rm -rf /var/lib/apt/lists/*

# El resto igual...
RUN a2enmod rewrite
RUN a2enmod php8.1
WORKDIR /var/www/html
COPY . .
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html

RUN echo '<Directory /var/www/html>\n\
    Options Indexes FollowSymLinks\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' > /etc/apache2/conf-available/project.conf

RUN a2enconf project
EXPOSE 80
CMD ["apache2ctl", "-D", "FOREGROUND"]