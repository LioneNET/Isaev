FROM php:8.3-fpm

EXPOSE 9000

WORKDIR /var/www/laravel_docker

# Установка необходимых зависимостей для расширений PHP
RUN apt-get update && \
    apt-get install -y --no-install-recommends \
        libicu-dev \
        libpq-dev \
        libzip-dev \
        zlib1g-dev \
        libpng-dev && \
    docker-php-ext-install \
        intl \
        pcntl \
        zip \
        gd \
        opcache \
        pdo \
        pdo_pgsql \
        pgsql > /dev/null && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
ADD . /var/www/laravel_docker

# Создание пользователя с UID/GID из аргументов сборки
ARG USER_ID=1000
ARG GROUP_ID=1000

# Создание группы с нужным GID (если не совпадает со стандартным www-data)
RUN groupadd --gid $GROUP_ID appgroup
RUN useradd --uid $USER_ID --gid $GROUP_ID --shell /bin/bash --create-home appuser

# Добавление пользователя в группу www-data (обычно GID 33 в Ubuntu/Debian)
RUN usermod -aG www-data appuser
RUN su appuser
CMD ["php-fpm"]
