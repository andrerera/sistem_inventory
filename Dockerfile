# Gunakan image dasar dengan Node.js dan PHP
FROM node:16-alpine

# Instal PHP dan ekstensi yang diperlukan
RUN apk add --no-cache php81 php81-pdo_pgsql apache2-utils \
    && ln -s /usr/bin/php81 /usr/bin/php

# Instal dependensi Node.js
COPY package*.json ./
RUN npm install

# Salin file proyek
COPY . /app
WORKDIR /app

# Expose port
EXPOSE 3000

# Jalankan server Node.js
CMD ["node", "server.js"]