# 🎨 Artfolia

Artfolia is a web platform built for artists to upload, showcase, and share their art — inspired by platforms like DeviantArt. It’s designed to foster creativity and build a community where artists can interact, receive feedback, and gain exposure.

## 🚀 Features

- User authentication and registration
- Art upload with image previews and captions
- Artist profile pages
- Community gallery with sorting and filtering
- Comment and like system for engagement
- Responsive front-end built with HTML/CSS

## 🧠 Motivation

As someone who loves creativity and visual expression, I wanted to build a space where artists could connect, similar to how developers use GitHub or designers use Dribbble. Artfolia blends my interests in software engineering and user-centered design into a meaningful, community-driven project. I was inspired by the platform, DeviantART, and wanted to recreate something similar, while also potentially adding and enhancing features of it as someone who used to participate in this space and community as an artist myself.

## 🛠️ Built With

- **Frontend**: HTML, CSS
- **Backend**: PHP
- **Database**: MySQL
- **Dev Tools:** XAMPP, phpMyAdmin

![Top Langs](https://github-readme-stats.vercel.app/api/top-langs/?username=summ3rngo&repo=ArtfoliaProject&layout=compact)

---

## 🧪 Getting Started (Local Setup)

To run Artfolia on your local machine:

### 1. Clone the Repository

```bash
git clone https://github.com/yourusername/artfolia.git
```
2. Move the cloned folder into your XAMPP htdocs folder:
```
C:\xampp\htdocs\artfolia
```
3. Start Apache & MySQL
Open XAMPP Control Panel, then:

Start Apache

Start MySQL

4. Create the Database
Go to http://localhost/phpmyadmin

Create a new database called artfolia

Run the SQL below to create required tables:
```sql
-- Users Table
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Tags Table
CREATE TABLE tags (
    tags_id INT AUTO_INCREMENT PRIMARY KEY,
    tag_name VARCHAR(100) NOT NULL UNIQUE
);

-- Posts Table
CREATE TABLE posts (
    post_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(255),
    description TEXT,
    filename VARCHAR(255),
    filepath VARCHAR(500),
    date DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

-- Post_Tags Table
CREATE TABLE post_tags (
    post_id INT,
    tags_id INT,
    PRIMARY KEY (post_id, tags_id),
    FOREIGN KEY (post_id) REFERENCES posts(post_id),
    FOREIGN KEY (tags_id) REFERENCES tags(tags_id)
);
```
6. Go To:
http://localhost/artfolia

---
## Credits
Inspired by the platform https://www.deviantart.com/
