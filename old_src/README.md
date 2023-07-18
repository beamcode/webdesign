# webdesign

Webdesign project

# Tree

```sh
├── Dockerfile
├── README.md
├── db
├── docker-compose.yml
└── src
    ├── backend
    ├── assets
    │   ├── fonts
    │   └── images
    ├── components
    ├── index.php
    ├── pages
    └── styles
```

# Note CMD MySQL

## Access to mysql bash

```shell
docker exec -it webdesign-db-1 bash
```

```shell
mysql -u root -p
pwd
```

## Create DB

```shell
CREATE DATABASE IF NOT EXISTS db;
USE db;
```

## Create Table

```shell
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    profile_picture VARCHAR(255),
    UNIQUE (username)
);
```

## Fill Table

```shell
INSERT INTO users (username, email, profile_picture) VALUES ('Michel', 'michel@example.com', 'path/to/profile_picture_of_a_bg.jpg');
```
