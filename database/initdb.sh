#!/bin/bash
set -e

# 📋 复制配置文件:将暂存区的配置覆盖到 PostgreSQL 容器的实际目录中
cp -r /var/tmp/postgresql/postgresql.conf /var/lib/postgresql/18/docker/postgresql.conf

# 🐘 登录数据库:以管理员身份连接 Postgres，并开启“遇错即停”模式
psql -v ON_ERROR_STOP=1 --username postgres --dbname postgres <<-EOSQL
    # 🔑 创建新用户:建立名为 root 的数据库用户并设置高强度密码
    CREATE USER root WITH PASSWORD 'jJ2u9YCWH6H5UrS';
    # 🗄️ 创建数据库:新建一个名为 geoglify 的数据仓库
    CREATE DATABASE geoglify;
    # 👑 提升权限:将 root 用户升级为拥有最高控制权的超级管理员
    ALTER USER root WITH SUPERUSER;
    # 🔓 赋予完全访问权:允许 root 用户对 geoglify 数据库进行任何操作
    GRANT ALL PRIVILEGES ON DATABASE geoglify TO root;
EOSQL
