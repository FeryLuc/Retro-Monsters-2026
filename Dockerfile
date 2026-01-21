FROM richarvey/nginx-php-fpm:3.1.6

# ⚠️ FORCER le bon dossier
# WORKDIR /var/www/html

COPY . .

# Créer les dossiers runtime Laravel et corriger les permissions
# RUN mkdir -p storage/framework/{cache,sessions,views} storage/logs \
#     && chown -R www-data:www-data storage bootstrap/cache \
#     && chmod -R 775 storage bootstrap/cache

# Image config
ENV SKIP_COMPOSER 1
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1

# Laravel config
ENV APP_ENV production
ENV APP_DEBUG false
ENV LOG_CHANNEL stderr

# Allow composer to run as root
ENV COMPOSER_ALLOW_SUPERUSER 1

CMD ["/start.sh"]
