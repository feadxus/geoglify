# =================================------------------------
# 阶段 1:引入对应目标架构的 Node.js 22 官方镜像作为基底
# =================================------------------------
FROM node:22-alpine AS node_base

# =================================------------------------
# 阶段 2:构建最终的 PHP 8.4 + Node.js 22 双架构(amd64 / arm64)运行镜像
# =================================------------------------
FROM php:8.4-fpm-alpine

# Set working directory
WORKDIR /var/www/webapp

# 🚀 精准从 node_base 阶段复制对应架构的 Node.js 22 二进制文件与 npm
COPY --from=node_base /usr/local/bin/node /usr/local/bin/node
COPY --from=node_base /usr/local/lib/node_modules /usr/local/lib/node_modules
RUN ln -s /usr/local/lib/node_modules/npm/bin/npm-cli.js /usr/local/bin/npm

# 1️⃣ 安装系统基础软件(Chromium, Nginx, Supervisor, 图形库, Postgres 依赖等)
RUN apk --no-cache add \
    chromium \
    nginx \
    supervisor \
    libpng-dev \
    postgresql-dev \
    && docker-php-ext-enable opcache

# 2️⃣ 安装 PHP 常用扩展
RUN docker-php-ext-install pdo pdo_pgsql gd

# 3️⃣ 安装 Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# 4️⃣ 拷贝配置文件
COPY conf.d/nginx/default.conf /etc/nginx/nginx.conf
COPY conf.d/php-fpm/php-fpm.conf /usr/local/etc/php-fpm.d/www.conf
COPY conf.d/php/php.ini /usr/local/etc/php/conf.d/php.ini
COPY conf.d/php/opcache.ini /usr/local/etc/php/conf.d/opcache.ini
COPY conf.d/supervisor/supervisord.conf /etc/supervisord.conf
COPY conf.d/supervisor/supervisord-dev.conf /etc/supervisord-dev.conf

# 5️⃣ 🚀 [性能优化] 先拷贝依赖文件并安装依赖(充分利用 Docker Layer 缓存)
COPY composer.json composer.lock ./
RUN composer install --no-interaction --no-scripts --no-autoloader

COPY package.json package-lock.json* ./
RUN npm install

# 6️⃣ 拷贝项目其余全部源码
COPY . /var/www/webapp

# 7️⃣ 执行 Composer autoloader 优化与前端构建
RUN composer dump-autoload --optimize \
    && npm run build

# 8️⃣ 设置目录权限
RUN chown -R www-data:www-data /var/www/webapp \
    && chmod -R 755 /var/www/webapp/storage \
    && chmod -R ugo+rw /var/www/webapp/storage

# 9️⃣ 定时任务 Cron 设置
RUN touch /var/log/cron.log \
    && echo "* * * * * /usr/local/bin/php /var/www/webapp/artisan schedule:run >> /var/log/cron.log 2>&1" | crontab -

# 🔟 配置 Puppeteer / Chromium 路径与入口脚本
ENV PUPPETEER_EXECUTABLE_PATH=/usr/bin/chromium-browser

ADD entrypoint.sh /root/entrypoint.sh
RUN chmod +x /root/entrypoint.sh

EXPOSE 80

ENTRYPOINT ["sh", "/root/entrypoint.sh"]
