FROM alpine:3.14
LABEL Description="Lightweight container with Nginx 1.18 & PHP-FPM 7.4 based on Alpine Linux."

# ~~~~~~~~~ DEV STUFF ~~~~~~~~~~~
# LOCAL TESTING ONLY Set webstore env vars
# For PROD these are set in cloud 

ENV HTTP_DOMAIN="http://localhost:80"
ENV HTTPS_DOMAIN="http://localhost:80"
ENV APP_VERSION="1.0.0"
ENV LOCALTESTFLAG="1"
ENV PHP_OPCACHE_VALIDATE_TIMESTAMPS="1"
ENV STYLESHEETTESTING="1"
ENV MYSQLIP = "82.180.174.205"
ENV DBUSER = "u933272665_oxwilder"
#prod key
#dev key
# ENV Z1_API_KEY="AIzaSyDoyRziS7QkZ4rnqynPX5ZYGYvf0B0aWF4"
# COPY cloud-sql-proxy-creds.json /run/cloud-sql-proxy-creds.json

# ~~~~~~~~~ DEV STUFF ~~~~~~~~~~~

#even though we set this to defaults - cloud build requires args to exists and overwrites them during build process
ARG arg_app_name="LOCALDEV"

# Install packages and remove default server definition
RUN apk --no-cache add php7 php7-fpm php7-opcache php7-mysqli php7-json php7-openssl php7-curl \
    php7-zlib php7-xml php7-simplexml php7-phar php7-intl php7-dom php7-xmlreader php7-ctype php7-session \
    php7-mbstring php7-gd php7-bcmath nginx perl nginx-mod-http-perl supervisor php7-soap gzip bash nano curl bash nano php7-pecl-xdebug
    
# Install composer from the official image
COPY --from=composer /usr/bin/composer /usr/bin/composer
COPY Conf/composer/composer.json /composer.json
  
# Run composer install to install the dependencies (PHP Cloud Storage SDK)
RUN composer install --optimize-autoloader --no-interaction --no-progress


# Configure nginx
COPY Conf/nginx/nginx.conf /etc/nginx/nginx.conf

# Configure PHP-FPM
COPY Conf/php-fpm/www.conf /etc/php7/php-fpm.d/www.conf 
COPY Conf/php-fpm/php.ini /etc/php7/conf.d/custom.ini

# Configure supervisord
COPY Conf/supervisor/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Setup document root
RUN mkdir -p /public_html/
# Folder for socket
RUN mkdir /sock

# Make sure files/folders needed by the processes are accessable when they run under the nobody user
RUN chown -R nobody.nobody /public_html/ && \
    chown -R nobody.nobody /run && \
    chown -R nobody.nobody /sock && \
    chown -R nobody.nobody /var/lib/nginx && \
    chown -R nobody.nobody /var/log/nginx
# Switch to use a non-root user from here on
USER nobody

# Add application
WORKDIR /public_html
COPY --chown=nobody . /public_html/

# Expose the port nginx is reachable on
EXPOSE 8080

# Let supervisord start nginx, php-fpm, & cloudsql proxy
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]

# Configure a healthcheck to validate that everything is up&running
# HEALTHCHECK --timeout=10s CMD curl --silent --fail http://127.0.0.1:8080/nginx-health