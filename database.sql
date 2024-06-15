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
    rating DECIMAL(3,2),
    release_date DATE,
    genre VARCHAR(100),
    writer VARCHAR(255),
    studio VARCHAR(255),
    poster_path VARCHAR(255),
    background_path VARCHAR(255),
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

-- Masukkan data anime
INSERT INTO titles (name, rating, release_date, genre, writer, studio, poster_path, background_path, trailer_link, sinopsis) VALUES
('Attack on Titan', 9.00, '2013-04-07', 'Action, Drama, Fantasy', 'Hajime Isayama', 'Wit Studio', '../assets/images/posters/attack_on_titan.jpg', '../assets/images/backgrounds/attack_on_titan_bg.jpg', 'link_to_youtube', 'In a world where giant humanoid Titans prey on humans, Eren Yeager vows to destroy the Titans after his hometown is destroyed.'),
('Naruto', 8.00, '2002-10-03', 'Action, Adventure, Fantasy', 'Masashi Kishimoto', 'Pierrot', '../assets/images/posters/naruto.jpg', '../assets/images/backgrounds/naruto_bg.jpg', 'link_to_youtube', 'Naruto Uzumaki, a mischievous adolescent ninja, struggles as he searches for recognition and dreams of becoming the Hokage, the village\'s leader and strongest ninja.'),
('One Piece', 9.00, '1999-10-20', 'Action, Adventure, Comedy', 'Eiichiro Oda', 'Toei Animation', '../assets/images/posters/one_piece.jpg', '../assets/images/backgrounds/one_piece_bg.jpg', 'link_to_youtube', 'Follows the adventures of Monkey D. Luffy and his pirate crew in order to find the greatest treasure ever left by the legendary Pirate, Gold Roger.'),
('Demon Slayer', 8.50, '2019-04-06', 'Action, Adventure, Fantasy', 'Koyoharu Gotouge', 'Ufotable', '../assets/images/posters/demon_slayer.jpg', '../assets/images/backgrounds/demon_slayer_bg.jpg', 'link_to_youtube', 'A family is attacked by demons and only two members survive - Tanjiro and his sister Nezuko, who is turning into a demon slowly. Tanjiro sets out to become a demon slayer to avenge his family and cure his sister.'),
('My Hero Academia', 8.40, '2016-04-03', 'Action, Adventure, Superhero', 'Kohei Horikoshi', 'Bones', '../assets/images/posters/my_hero_academia.jpg', '../assets/images/backgrounds/my_hero_academia_bg.jpg', 'link_to_youtube', 'A superhero-loving boy without any powers is determined to enroll in a prestigious hero academy and learn what it really means to be a hero.');

-- Masukkan data film
INSERT INTO titles (name, rating, release_date, genre, writer, studio, poster_path, background_path, trailer_link, sinopsis) VALUES
('Inception', 9.00, '2010-07-16', 'Action, Sci-Fi, Thriller', 'Christopher Nolan', 'Warner Bros', '../assets/images/posters/inception.jpg', '../assets/images/backgrounds/inception_bg.jpg', 'link_to_youtube', 'A thief who steals corporate secrets through the use of dream-sharing technology is given the inverse task of planting an idea into the mind of a CEO.'),
('Interstellar', 9.00, '2014-11-07', 'Adventure, Drama, Sci-Fi', 'Christopher Nolan', 'Paramount Pictures', '../assets/images/posters/interstellar.jpg', '../assets/images/backgrounds/interstellar_bg.jpg', 'link_to_youtube', 'A team of explorers travel through a wormhole in space in an attempt to ensure humanity\'s survival.'),
('The Matrix', 9.00, '1999-03-31', 'Action, Sci-Fi', 'Lana Wachowski, Lilly Wachowski', 'Warner Bros', '../assets/images/posters/the_matrix.jpg', '../assets/images/backgrounds/the_matrix_bg.jpg', 'link_to_youtube', 'A computer hacker learns from mysterious rebels about the true nature of his reality and his role in the war against its controllers.'),
('The Dark Knight', 9.00, '2008-07-18', 'Action, Crime, Drama', 'Jonathan Nolan, Christopher Nolan', 'Warner Bros', '../assets/images/posters/the_dark_knight.jpg', '../assets/images/backgrounds/the_dark_knight_bg.jpg', 'link_to_youtube', 'When the menace known as the Joker emerges from his mysterious past, he wreaks havoc and chaos on the people of Gotham. The Dark Knight must accept one of the greatest psychological and physical tests of his ability to fight injustice.'),
('Pulp Fiction', 8.90, '1994-10-14', 'Crime, Drama', 'Quentin Tarantino, Roger Avary', 'Miramax', '../assets/images/posters/pulp_fiction.jpg', '../assets/images/backgrounds/pulp_fiction_bg.jpg', 'link_to_youtube', 'The lives of two mob hitmen, a boxer, a gangster and his wife, and a pair of diner bandits intertwine in four tales of violence and redemption.');

-- Masukkan data film Korea
INSERT INTO titles (name, rating, release_date, genre, writer, studio, poster_path, background_path, trailer_link, sinopsis) VALUES
('Parasite', 9.00, '2019-05-30', 'Drama, Thriller', 'Bong Joon-ho', 'Barunson E&A', '../assets/images/posters/parasite.jpg', '../assets/images/backgrounds/parasite_bg.jpg', 'link_to_youtube', 'Greed and class discrimination threaten the newly formed symbiotic relationship between the wealthy Park family and the destitute Kim clan.'),
('Train to Busan', 8.00, '2016-07-20', 'Action, Horror, Thriller', 'Park Joo-suk', 'Next Entertainment World', '../assets/images/posters/train_to_busan.jpg', '../assets/images/backgrounds/train_to_busan_bg.jpg', 'link_to_youtube', 'While a zombie virus breaks out in South Korea, passengers struggle to survive on the train from Seoul to Busan.'),
('Oldboy', 8.00, '2003-11-21', 'Action, Drama, Mystery', 'Park Chan-wook', 'Show East', '../assets/images/posters/oldboy.jpg', '../assets/images/backgrounds/oldboy_bg.jpg', 'link_to_youtube', 'After being kidnapped and imprisoned for fifteen years, Oh Dae-Su is released, only to find that he must find his captor in five days.'),
('The Host', 8.50, '2006-07-27', 'Action, Drama, Horror', 'Bong Joon-ho', 'Showbox', '../assets/images/posters/the_host.jpg', '../assets/images/backgrounds/the_host_bg.jpg', 'link_to_youtube', 'A monster emerges from Seoul\'s Han River and begins attacking people. One victim\'s loving family does what it can to rescue her from its clutches.'),
('Snowpiercer', 8.60, '2013-08-01', 'Action, Drama, Sci-Fi', 'Bong Joon-ho', 'CJ Entertainment', '../assets/images/posters/snowpiercer.jpg', '../assets/images/backgrounds/snowpiercer_bg.jpg', 'link_to_youtube', 'In a future where a failed climate-change experiment has killed all life except for the survivors who boarded the Snowpiercer, a train that travels around the globe, a new class system emerges.');

-- Masukkan data karakter untuk anime
INSERT INTO characters (title_id, name, image_path) VALUES
(1, 'Eren Yeager', '../assets/images/characters/eren_yeager.jpg'),
(1, 'Mikasa Ackerman', '../assets/images/characters/mikasa_ackerman.jpg'),
(2, 'Naruto Uzumaki', '../assets/images/characters/naruto_uzumaki.jpg'),
(2, 'Sasuke Uchiha', '../assets/images/characters/sasuke_uchiha.jpg'),
(3, 'Monkey D. Luffy', '../assets/images/characters/luffy.jpg'),
(3, 'Roronoa Zoro', '../assets/images/characters/zoro.jpg'),
(4, 'Tanjiro Kamado', '../assets/images/characters/tanjiro.jpg'),
(4, 'Nezuko Kamado', '../assets/images/characters/nezuko.jpg'),
(5, 'Izuku Midoriya', '../assets/images/characters/izuku.jpg'),
(5, 'Katsuki Bakugo', '../assets/images/characters/bakugo.jpg');

-- Masukkan data karakter untuk film
INSERT INTO characters (title_id, name, image_path) VALUES
(6, 'Dom Cobb', '../assets/images/characters/dom_cobb.jpg'),
(6, 'Arthur', '../assets/images/characters/arthur.jpg'),
(7, 'Cooper', '../assets/images/characters/cooper.jpg'),
(7, 'Murph', '../assets/images/characters/murph.jpg'),
(8, 'Neo', '../assets/images/characters/neo.jpg'),
(8, 'Morpheus', '../assets/images/characters/morpheus.jpg'),
(9, 'Bruce Wayne', '../assets/images/characters/bruce_wayne.jpg'),
(9, 'Joker', '../assets/images/characters/joker.jpg'),
(10, 'Vincent Vega', '../assets/images/characters/vincent_vega.jpg'),
(10, 'Jules Winnfield', '../assets/images/characters/jules_winnfield.jpg');

-- Masukkan data karakter untuk film Korea
INSERT INTO characters (title_id, name, image_path) VALUES
(11, 'Kim Ki-woo', '../assets/images/characters/ki_woo.jpg'),
(11, 'Kim Ki-taek', '../assets/images/characters/ki_taek.jpg'),
(12, 'Seok-woo', '../assets/images/characters/seok_woo.jpg'),
(12, 'Sang-hwa', '../assets/images/characters/sang_hwa.jpg'),
(13, 'Oh Dae-su', '../assets/images/characters/dae_su.jpg'),
(13, 'Lee Woo-jin', '../assets/images/characters/woo_jin.jpg'),
(14, 'Park Gang-du', '../assets/images/characters/gang_du.jpg'),
(14, 'Nam-joo', '../assets/images/characters/nam_joo.jpg'),
(15, 'Curtis Everett', '../assets/images/characters/curtis_everett.jpg'),
(15, 'Minister Mason', '../assets/images/characters/minister_mason.jpg');

-- Masukkan karakter tambahan untuk anime
INSERT INTO characters (title_id, name, image_path) VALUES
(1, 'Armin Arlert', '../assets/images/characters/armin.jpg'),
(1, 'Levi Ackerman', '../assets/images/characters/levi.jpg'),
(1, 'Jean Kirstein', '../assets/images/characters/jean.jpg'),
(2, 'Sakura Haruno', '../assets/images/characters/sakura.jpg'),
(2, 'Kakashi Hatake', '../assets/images/characters/kakashi.jpg'),
(2, 'Hinata Hyuga', '../assets/images/characters/hinata.jpg'),
(3, 'Nami', '../assets/images/characters/nami.jpg'),
(3, 'Sanji', '../assets/images/characters/sanji.jpg'),
(3, 'Usopp', '../assets/images/characters/usopp.jpg'),
(4, 'Giyu Tomioka', '../assets/images/characters/giyu.jpg'),
(4, 'Zenitsu Agatsuma', '../assets/images/characters/zenitsu.jpg'),
(4, 'Inosuke Hashibira', '../assets/images/characters/inosuke.jpg'),
(5, 'All Might', '../assets/images/characters/all_might.jpg'),
(5, 'Ochaco Uraraka', '../assets/images/characters/ochaco.jpg'),
(5, 'Shoto Todoroki', '../assets/images/characters/shoto.jpg');

-- Masukkan karakter tambahan untuk film
INSERT INTO characters (title_id, name, image_path) VALUES
(6, 'Mal Cobb', '../assets/images/characters/mal.jpg'),
(6, 'Saito', '../assets/images/characters/saito.jpg'),
(6, 'Eames', '../assets/images/characters/eames.jpg'),
(7, 'Amelia Brand', '../assets/images/characters/amelia.jpg'),
(7, 'Dr. Mann', '../assets/images/characters/dr_mann.jpg'),
(7, 'TARS', '../assets/images/characters/tars.jpg'),
(8, 'Trinity', '../assets/images/characters/trinity.jpg'),
(8, 'Agent Smith', '../assets/images/characters/agent_smith.jpg'),
(8, 'Oracle', '../assets/images/characters/oracle.jpg'),
(9, 'Harvey Dent', '../assets/images/characters/harvey.jpg'),
(9, 'Alfred Pennyworth', '../assets/images/characters/alfred.jpg'),
(9, 'Rachel Dawes', '../assets/images/characters/rachel.jpg'),
(10, 'Mia Wallace', '../assets/images/characters/mia.jpg'),
(10, 'Butch Coolidge', '../assets/images/characters/butch.jpg'),
(10, 'Captain Koons', '../assets/images/characters/captain_koons.jpg');

-- Masukkan karakter tambahan untuk film Korea
INSERT INTO characters (title_id, name, image_path) VALUES
(11, 'Park Da-hye', '../assets/images/characters/da_hye.jpg'),
(11, 'Yeon-kyo', '../assets/images/characters/yeon_kyo.jpg'),
(11, 'Moon-gwang', '../assets/images/characters/moon_gwang.jpg'),
(12, 'Su-an', '../assets/images/characters/su_an.jpg'),
(12, 'Yong-guk', '../assets/images/characters/yong_guk.jpg'),
(12, 'Jin-hee', '../assets/images/characters/jin_hee.jpg'),
(13, 'Mido', '../assets/images/characters/mido.jpg'),
(13, 'Mr. Park', '../assets/images/characters/mr_park.jpg'),
(13, 'Yoo Ji-tae', '../assets/images/characters/ji_tae.jpg'),
(14, 'Hee-bong', '../assets/images/characters/hee_bong.jpg'),
(14, 'Hyun-seo', '../assets/images/characters/hyun_seo.jpg'),
(14, 'The Monster', '../assets/images/characters/the_monster.jpg'),
(15, 'Edgar', '../assets/images/characters/edgar.jpg'),
(15, 'Tanya', '../assets/images/characters/tanya.jpg'),
(15, 'Wilford', '../assets/images/characters/wilford.jpg');


-- User
INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `profile_image`) VALUES
(1, 'Dija', 'yedija@gmail.com', '$2y$10$fhkgbdFkHZnle5I5X7hjb.e155b6FKh3x0CK2FKikE3MFqiGxjQHa', '../assets/images/user_profiles/default_profile.png');
