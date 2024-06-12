CREATE DATABASE IF NOT EXISTS AniFLicks;
USE AniFlicks;

CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    profile_image VARCHAR(255) DEFAULT '../assets/images/user_profiles/default_profile.png'
);

CREATE TABLE titles (
    title_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    rating INT,
    release_date DATE,
    genre VARCHAR(100),
    writer VARCHAR(255),
    studio VARCHAR(255),
    poster_path VARCHAR(255),
    trailer_link VARCHAR(255),
    sinopsis TEXT
);

CREATE TABLE characters (
    character_id INT AUTO_INCREMENT PRIMARY KEY,
    title_id INT,
    name VARCHAR(255) NOT NULL,
    image_path VARCHAR(255),
    FOREIGN KEY (title_id) REFERENCES titles(title_id)
);

CREATE TABLE reviews (
    review_id INT AUTO_INCREMENT PRIMARY KEY,
    title_id INT,
    user_id INT,
    rating INT,
    comment TEXT,
    FOREIGN KEY (title_id) REFERENCES titles(title_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

CREATE TABLE watchlist (
    watchlist_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    title_id INT,
    watched ENUM('Sedang Ditonton', 'Akan Ditonton', 'Ditahan', 'Selesai Ditonton') DEFAULT 'Akan Ditonton',
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (title_id) REFERENCES titles(title_id)
);

INSERT INTO titles (name, rating, release_date, genre, writer, studio, poster_path, trailer_link, sinopsis) VALUES
('Attack on Titan', 9, '2013-04-07', 'Action, Drama, Fantasy', 'Hajime Isayama', 'Wit Studio', '../assets/images/posters/attack_on_titan.jpg', 'link_to_youtube', 'In a world where giant humanoid Titans prey on humans, Eren Yeager vows to destroy the Titans after his hometown is destroyed.'),
('Naruto', 8, '2002-10-03', 'Action, Adventure, Fantasy', 'Masashi Kishimoto', 'Pierrot', '../assets/images/posters/naruto.jpg', 'link_to_youtube', 'Naruto Uzumaki, a mischievous adolescent ninja, struggles as he searches for recognition and dreams of becoming the Hokage, the village\'s leader and strongest ninja.'),
('One Piece', 9, '1999-10-20', 'Action, Adventure, Comedy', 'Eiichiro Oda', 'Toei Animation', '../assets/images/posters/one_piece.jpg', 'link_to_youtube', 'Follows the adventures of Monkey D. Luffy and his pirate crew in order to find the greatest treasure ever left by the legendary Pirate, Gold Roger.');

INSERT INTO titles (name, rating, release_date, genre, writer, studio, poster_path, trailer_link, sinopsis) VALUES
('Inception', 9, '2010-07-16', 'Action, Sci-Fi, Thriller', 'Christopher Nolan', 'Warner Bros', '../assets/images/posters/inception.jpg', 'link_to_youtube', 'A thief who steals corporate secrets through the use of dream-sharing technology is given the inverse task of planting an idea into the mind of a CEO.'),
('Interstellar', 9, '2014-11-07', 'Adventure, Drama, Sci-Fi', 'Christopher Nolan', 'Paramount Pictures', '../assets/images/posters/interstellar.jpg', 'link_to_youtube', 'A team of explorers travel through a wormhole in space in an attempt to ensure humanity\'s survival.'),
('The Matrix', 9, '1999-03-31', 'Action, Sci-Fi', 'Lana Wachowski, Lilly Wachowski', 'Warner Bros', '../assets/images/posters/the_matrix.jpg', 'link_to_youtube', 'A computer hacker learns from mysterious rebels about the true nature of his reality and his role in the war against its controllers.');

INSERT INTO titles (name, rating, release_date, genre, writer, studio, poster_path, trailer_link, sinopsis) VALUES
('Parasite', 9, '2019-05-30', 'Drama, Thriller', 'Bong Joon-ho', 'Barunson E&A', '../assets/images/posters/parasite.jpg', 'link_to_youtube', 'Greed and class discrimination threaten the newly formed symbiotic relationship between the wealthy Park family and the destitute Kim clan.'),
('Train to Busan', 8, '2016-07-20', 'Action, Horror, Thriller', 'Park Joo-suk', 'Next Entertainment World', '../assets/images/posters/train_to_busan.jpg', 'link_to_youtube', 'While a zombie virus breaks out in South Korea, passengers struggle to survive on the train from Seoul to Busan.'),
('Oldboy', 8, '2003-11-21', 'Action, Drama, Mystery', 'Park Chan-wook', 'Show East', '../assets/images/posters/oldboy.jpg', 'link_to_youtube', 'After being kidnapped and imprisoned for fifteen years, Oh Dae-Su is released, only to find that he must find his captor in five days.');

