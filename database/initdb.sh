#!/bin/bash
set -e

cp -r /var/tmp/postgresql/postgresql.conf /var/lib/postgresql/data/postgresql.conf

psql -v ON_ERROR_STOP=1 --username postgres --dbname postgres <<-EOSQL
    CREATE USER root WITH PASSWORD 'jJ2u9YCWH6H5UrS';
    CREATE DATABASE geoglify;
    ALTER USER root WITH SUPERUSER;
    GRANT ALL PRIVILEGES ON DATABASE geoglify TO root;
EOSQL