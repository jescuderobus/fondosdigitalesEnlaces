# fondosdigitalesEnlaces
Aplicación para la redirección de enlaces que están impresos en libros de la biblioteca

Hay que hacer una serie de pasos para que todo esto funcione.

### PASO 1. Quedarnos en un servidor con el dominio sin uso
En nuestro caso es http://fondosdigitales.us.es

### PASO 2. 
En apache creamos un VirtualHost para servir páginas

'''httpd
<VirtualHost fondosdigitales.us.es:80>
    ServerAdmin jescudero@us.es
    DocumentRoot /var/www/html/fondosdigitales/http
    ServerName fondosdigitales.us.es
    ServerAlias fondosdigitales.us.es
        <Directory /var/www/html/fondosdigitales/http>
                Options FollowSymLinks Indexes
                AllowOverride All
        </Directory>
        CustomLog /var/log/httpd/fondosdigitales.us.es-access.log combined
        ErrorLog /var/log/httpd/fondosdigitales.us.es-error.log
        LogLevel warn
</VirtualHost>
'''

### PASO 3. Tenemos un htaccess que trata las peticiones

'''htaccess
RewriteEngine on
  Options -Indexes
  ErrorDocument 404 http://fondosdigitales.us.es/404.php

  RewriteRule ^fondos/libros/?.+$ info.php [L]
'''

### PASO 4. Este repositorio

(Este repositorio contiene el codigo para hacer las redirecciones)


## PASO 5. Testeo del redireccionamiento

http://fondosdigitales.us.es/fondos/libros/8517/ --> https://archive.org/details/A10909922

http://fondosdigitales.us.es/fondos/libros/4372 --> https://archive.org/details/A080161







