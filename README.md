# webdesign

Webdesign project

# Tree

```sh
.
├── assets
│   └── mushroom.png
├── controllers
│   ├── getHighscores.js
│   ├── getMessages.js
│   ├── profile.js
│   ├── sendMessage.js
│   ├── signin.js
│   ├── signup.js
│   ├── signupFormValidator.js
│   └── togglePassword.js
├── form.css
├── index.php
├── models
│   ├── ExceptionWithField.php
│   ├── database.php
│   ├── highscores.php
│   ├── messageSystem.php
│   ├── refreshUserData.php
│   ├── signin.php
│   └── signup.php
├── profile.css
├── script.js
├── style.css
├── theme.css
└── views
    ├── assets
    │   ├── fonts
    │   │   └── SuperMarioBrosWii.otf
    │   ├── icons
    │   │   ├── chat.svg
    │   │   ├── cross.svg
    │   │   ├── cup.svg
    │   │   ├── gameboy.svg
    │   │   ├── games.svg
    │   │   ├── home-simple.svg
    │   │   ├── logout.svg
    │   │   ├── menu.svg
    │   │   ├── message-text.svg
    │   │   ├── profile.svg
    │   │   ├── shop.svg
    │   │   ├── store.svg
    │   │   └── user.svg
    │   ├── images
    │   │   ├── block.png
    │   │   ├── boo.png
    │   │   ├── default_banner.png
    │   │   ├── default_profile.png
    │   │   ├── earth.png
    │   │   ├── flag.png
    │   │   ├── goomba.png
    │   │   ├── ground.png
    │   │   ├── heart.png
    │   │   ├── koopa.png
    │   │   ├── lava.png
    │   │   ├── score.png
    │   │   ├── shell.png
    │   │   ├── skin0.png
    │   │   ├── skin1.png
    │   │   ├── skin2.png
    │   │   ├── skin3.png
    │   │   ├── skin4.png
    │   │   ├── skin5.png
    │   │   ├── skin6.png
    │   │   ├── star.png
    │   │   ├── surprise.png
    │   │   └── wall.png
    │   ├── maps
    │   │   ├── lol.txt
    │   │   ├── map1 copy 2.txt
    │   │   ├── map1 copy.txt
    │   │   ├── map1.txt
    │   │   ├── map2.txt
    │   │   ├── map3.txt
    │   │   └── map4.txt
    │   └── uploads
    │       ├── banner
    │       │   └── default_banner.png
    │       └── profile
    │           └── default_profile.png
    ├── components
    │   ├── anchor.php
    │   ├── button.php
    │   ├── chatbox.php
    │   ├── footer.php
    │   ├── game.php
    │   ├── header.php
    │   ├── input.php
    │   ├── menu.php
    │   └── sidebar.php
    ├── game
    │   ├── Display.js
    │   ├── Entities.js
    │   ├── Game.js
    │   ├── Level.js
    │   ├── ScreenManager.js
    │   ├── Vector.js
    │   ├── game.css
    │   ├── index.html
    │   └── script.js
    ├── game.php
    ├── home.php
    ├── icons
    │   ├── chat-icon.php
    │   ├── close-icon.php
    │   ├── game-icon.php
    │   ├── home-icon.php
    │   ├── logout-icon.php
    │   ├── menu-icon.php
    │   ├── profile-icon.php
    │   ├── score-icon.php
    │   ├── search-icon.php
    │   ├── send-icon.php
    │   └── shop-icon.php
    ├── layout.php
    ├── profile.php
    ├── score.php
    ├── shop.php
    ├── signin.php
    └── signup.php
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
