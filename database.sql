-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Jun 2024 pada 04.38
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aniflicks`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `characters`
--

CREATE TABLE `characters` (
  `character_id` int(11) NOT NULL,
  `title_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `characters`
--

INSERT INTO `characters` (`character_id`, `title_id`, `name`, `image_path`) VALUES
(136, 1, 'Eren Yeager', '../assets/images/characters/eren_yeager.jpg'),
(137, 1, 'Mikasa Ackerman', '../assets/images/characters/mikasa_ackerman.jpg'),
(138, 2, 'Naruto Uzumaki', '../assets/images/characters/naruto_uzumaki.jpg'),
(139, 2, 'Sasuke Uchiha', '../assets/images/characters/sasuke_uchiha.jpg'),
(140, 3, 'Monkey D. Luffy', '../assets/images/characters/luffy.jpg'),
(141, 3, 'Roronoa Zoro', '../assets/images/characters/zoro.jpg'),
(142, 4, 'Tanjiro Kamado', '../assets/images/characters/tanjiro.jpg'),
(143, 4, 'Nezuko Kamado', '../assets/images/characters/nezuko.jpg'),
(144, 5, 'Izuku Midoriya', '../assets/images/characters/izuku.jpg'),
(145, 5, 'Katsuki Bakugo', '../assets/images/characters/bakugo.jpg'),
(146, 6, 'Dom Cobb', '../assets/images/characters/dom_cobb.jpg'),
(147, 6, 'Arthur', '../assets/images/characters/arthur.jpg'),
(148, 7, 'Cooper', '../assets/images/characters/cooper.jpg'),
(149, 7, 'Murph', '../assets/images/characters/murph.jpg'),
(150, 8, 'Neo', '../assets/images/characters/neo.jpg'),
(151, 8, 'Morpheus', '../assets/images/characters/morpheus.jpg'),
(152, 9, 'Bruce Wayne', '../assets/images/characters/bruce_wayne.jpg'),
(153, 9, 'Joker', '../assets/images/characters/joker.jpg'),
(154, 10, 'Vincent Vega', '../assets/images/characters/vincent_vega.jpg'),
(155, 10, 'Jules Winnfield', '../assets/images/characters/jules_winnfield.jpg'),
(156, 11, 'Kim Ki-woo', '../assets/images/characters/ki_woo.jpg'),
(157, 11, 'Kim Ki-taek', '../assets/images/characters/ki_taek.jpg'),
(158, 12, 'Seok-woo', '../assets/images/characters/seok_woo.jpg'),
(159, 12, 'Sang-hwa', '../assets/images/characters/sang_hwa.jpg'),
(160, 13, 'Oh Dae-su', '../assets/images/characters/dae_su.jpg'),
(161, 13, 'Lee Woo-jin', '../assets/images/characters/woo_jin.jpg'),
(162, 14, 'Park Gang-du', '../assets/images/characters/gang_du.jpg'),
(163, 14, 'Nam-joo', '../assets/images/characters/nam_joo.jpg'),
(164, 15, 'Curtis Everett', '../assets/images/characters/curtis_everett.jpg'),
(165, 15, 'Minister Mason', '../assets/images/characters/minister_mason.jpg'),
(166, 1, 'Armin Arlert', '../assets/images/characters/armin.jpg'),
(167, 1, 'Levi Ackerman', '../assets/images/characters/levi.jpg'),
(168, 1, 'Jean Kirstein', '../assets/images/characters/jean.jpg'),
(169, 2, 'Sakura Haruno', '../assets/images/characters/sakura.jpg'),
(170, 2, 'Kakashi Hatake', '../assets/images/characters/kakashi.jpg'),
(171, 2, 'Hinata Hyuga', '../assets/images/characters/hinata.jpg'),
(172, 3, 'Nami', '../assets/images/characters/nami.jpg'),
(173, 3, 'Sanji', '../assets/images/characters/sanji.jpg'),
(174, 3, 'Usopp', '../assets/images/characters/usopp.jpg'),
(175, 4, 'Giyu Tomioka', '../assets/images/characters/giyu.jpg'),
(176, 4, 'Zenitsu Agatsuma', '../assets/images/characters/zenitsu.jpg'),
(177, 4, 'Inosuke Hashibira', '../assets/images/characters/inosuke.jpg'),
(178, 5, 'All Might', '../assets/images/characters/all_might.jpg'),
(179, 5, 'Ochaco Uraraka', '../assets/images/characters/ochaco.jpg'),
(180, 5, 'Shoto Todoroki', '../assets/images/characters/shoto.jpg'),
(181, 6, 'Mal Cobb', '../assets/images/characters/mal.jpg'),
(182, 6, 'Saito', '../assets/images/characters/saito.jpg'),
(183, 6, 'Eames', '../assets/images/characters/eames.jpg'),
(184, 7, 'Amelia Brand', '../assets/images/characters/amelia.jpg'),
(185, 7, 'Dr. Mann', '../assets/images/characters/dr_mann.jpg'),
(186, 7, 'TARS', '../assets/images/characters/tars.jpg'),
(187, 8, 'Trinity', '../assets/images/characters/trinity.jpg'),
(188, 8, 'Agent Smith', '../assets/images/characters/agent_smith.jpg'),
(189, 8, 'Oracle', '../assets/images/characters/oracle.jpg'),
(190, 9, 'Harvey Dent', '../assets/images/characters/harvey.jpg'),
(191, 9, 'Alfred Pennyworth', '../assets/images/characters/alfred.jpg'),
(192, 9, 'Rachel Dawes', '../assets/images/characters/rachel.jpg'),
(193, 10, 'Mia Wallace', '../assets/images/characters/mia.jpg'),
(194, 10, 'Butch Coolidge', '../assets/images/characters/butch.jpg'),
(195, 10, 'Captain Koons', '../assets/images/characters/captain_koons.jpg'),
(196, 11, 'Park Da-hye', '../assets/images/characters/da_hye.jpg'),
(197, 11, 'Yeon-kyo', '../assets/images/characters/yeon_kyo.jpg'),
(198, 11, 'Moon-gwang', '../assets/images/characters/moon_gwang.jpg'),
(199, 12, 'Su-an', '../assets/images/characters/su_an.jpg'),
(200, 12, 'Yong-guk', '../assets/images/characters/yong_guk.jpg'),
(201, 12, 'Jin-hee', '../assets/images/characters/jin_hee.jpg'),
(202, 13, 'Mido', '../assets/images/characters/mido.jpg'),
(203, 13, 'Mr. Park', '../assets/images/characters/mr_park.jpg'),
(204, 13, 'Yoo Ji-tae', '../assets/images/characters/ji_tae.jpg'),
(205, 14, 'Hee-bong', '../assets/images/characters/hee_bong.jpg'),
(206, 14, 'Hyun-seo', '../assets/images/characters/hyun_seo.jpg'),
(207, 14, 'The Monster', '../assets/images/characters/the_monster.jpg'),
(208, 15, 'Edgar', '../assets/images/characters/edgar.jpg'),
(209, 15, 'Tanya', '../assets/images/characters/tanya.jpg'),
(210, 15, 'Wilford', '../assets/images/characters/wilford.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `title_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `date_posted` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `reviews`
--

INSERT INTO `reviews` (`review_id`, `title_id`, `user_id`, `comment`, `date_posted`) VALUES
(1, 8, 1, 'Aku suka cuy', '2024-06-15 13:47:09'),
(2, 8, 1, 'aku juga', '2024-06-15 13:51:36'),
(3, 1, 1, 'Keren cuy!', '2024-06-15 14:34:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `temporary_characters`
--

CREATE TABLE `temporary_characters` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `temporary_titles`
--

CREATE TABLE `temporary_titles` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `rating` decimal(3,2) DEFAULT NULL,
  `release_date` date DEFAULT NULL,
  `genre` varchar(100) DEFAULT NULL,
  `writer` varchar(255) DEFAULT NULL,
  `studio` varchar(255) DEFAULT NULL,
  `poster_path` varchar(255) DEFAULT NULL,
  `background_path` varchar(255) NOT NULL,
  `trailer_link` varchar(255) DEFAULT NULL,
  `sinopsis` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `titles`
--

CREATE TABLE `titles` (
  `title_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `rating` decimal(3,2) DEFAULT NULL,
  `release_date` date DEFAULT NULL,
  `genre` varchar(100) DEFAULT NULL,
  `writer` varchar(255) DEFAULT NULL,
  `studio` varchar(255) DEFAULT NULL,
  `poster_path` varchar(255) DEFAULT NULL,
  `background_path` varchar(255) NOT NULL,
  `trailer_link` varchar(255) DEFAULT NULL,
  `sinopsis` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `approved` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `titles`
--

INSERT INTO `titles` (`title_id`, `name`, `rating`, `release_date`, `genre`, `writer`, `studio`, `poster_path`, `background_path`, `trailer_link`, `sinopsis`, `description`, `approved`) VALUES
(1, 'Attack on Titan', 9.00, '2013-04-07', 'Action, Drama, Fantasy', 'Hajime Isayama', 'Wit Studio', '../assets/images/posters/attack_on_titan.jpg', '../assets/images/backgrounds/attack_on_titan_bg.jpg', 'https://www.youtube.com/watch?v=AW5_k_Cf4wM', 'Di dunia di mana Titan humanoid raksasa memangsa manusia, Eren Yeager bersumpah untuk menghancurkan Titan setelah kampung halamannya dihancurkan.', 'Attack on Titan adalah salah satu anime paling ikonik yang pernah ada, menggabungkan aksi yang mendebarkan dengan alur cerita yang mendalam dan karakter yang kompleks. Cerita ini berlangsung di dunia di mana manusia terkurung dalam kota tembok besar karena ancaman dari Titan, makhluk raksasa pemakan manusia. Eren Yeager, bersama dengan saudara angkatnya Mikasa Ackerman dan sahabatnya Armin Arlert, memulai perjalanan epik untuk mengalahkan Titan dan membalas dendam atas kampung halamannya yang hancur.\r\n\r\nDi tengah pertempuran melawan Titan, plot berkembang dengan pengungkapan misteri tentang asal-usul Titan dan kota-kota tembok. Seri ini tidak hanya menampilkan adegan pertarungan yang spektakuler, tetapi juga menyelidiki tema-tema seperti keberanian, pengorbanan, dan keyakinan. Karya ini sangat dipuji karena animasinya yang mengesankan dan musik latar yang mendukung suasana epiknya.\r\n\r\nAttack on Titan tidak hanya berhasil sebagai anime aksi, tetapi juga sebagai narasi yang menyentuh tentang manusia dan ambisi untuk bertahan hidup di tengah kehancuran. Dengan ketegangan yang tidak pernah surut dan plot twist yang tak terduga, anime ini terus menarik perhatian penonton dari awal hingga akhir.', 0),
(2, 'Naruto', 8.00, '2002-10-03', 'Action, Adventure, Fantasy', 'Masashi Kishimoto', 'Pierrot', '../assets/images/posters/naruto.jpg', '../assets/images/backgrounds/naruto_bg.jpg', 'https://www.youtube.com/watch?v=-G9BqkgZXRA', 'Naruto Uzumaki, seorang ninja remaja nakal, berjuang mencari pengakuan dan bermimpi menjadi Hokage, pemimpin desa dan ninja terkuat.', 'Naruto adalah salah satu serial anime paling ikonik yang pernah ada, menceritakan kisah seorang ninja muda yang penuh semangat untuk mencapai impian besar menjadi Hokage, pemimpin desa terkuat. Diciptakan oleh Masashi Kishimoto, cerita ini tidak hanya tentang petualangan fisik Naruto Uzumaki, tetapi juga tentang perjalanan rohani dan pertumbuhannya sebagai seorang ninja dan pemimpin.\r\n\r\nCerita dimulai dengan Naruto sebagai anak yang keras kepala dan nakal yang sering dianggap sebagai masalah oleh penduduk desa. Namun, dengan tekadnya yang kuat dan dukungan dari teman-temannya seperti Sasuke Uchiha dan Sakura Haruno, Naruto bertekad untuk membuktikan nilai dirinya dan melindungi orang-orang yang dicintainya. Penuh dengan aksi, humor, dan momen emosional, Naruto berhasil menangkap hati para penggemar di seluruh dunia.\r\n\r\nSelama perjalanannya, Naruto menghadapi berbagai tantangan, termasuk musuh yang kuat dan rahasia kelam dari masa lalunya. Dengan narasi yang mendalam tentang persahabatan, kesetiaan, dan pengorbanan, anime ini tidak hanya menawarkan aksi yang mendebarkan tetapi juga mengajarkan banyak pelajaran hidup. Naruto tetap menjadi salah satu ikon budaya pop yang paling diingat dalam sejarah anime.', 0),
(3, 'One Piece', 9.00, '1999-10-20', 'Action, Adventure, Comedy', 'Eiichiro Oda', 'Toei Animation', '../assets/images/posters/one_piece.jpg', '../assets/images/backgrounds/one_piece_bg.jpg', 'https://www.youtube.com/watch?v=Oo52vQyAR6w', 'Mengikuti petualangan Monkey D. Luffy dan kru bajak lautnya untuk menemukan harta karun terbesar yang pernah ditinggalkan oleh bajak laut legendaris, Gold Roger.', 'One Piece adalah salah satu anime paling panjang dan paling terkenal sepanjang masa, yang mengikuti petualangan epik Monkey D. Luffy dan kru bajak lautnya dalam pencarian harta karun legendaris yang ditinggalkan oleh Raja Bajak Laut, Gol D. Roger. Diciptakan oleh Eiichiro Oda, cerita ini tidak hanya tentang pencarian harta karun, tetapi juga tentang ikatan kuat antara karakter utama dan pengorbanan yang mereka buat untuk mencapai impian mereka.\r\n\r\nLuffy, yang mendapatkan kekuatan elastisnya setelah memakan buah setan Gomu Gomu, memimpin kru bajak laut Topi Jerami dalam petualangan yang tak terhitung jumlahnya di Lautan Grand Line. Bersama dengan Zoro, Nami, Usopp, Sanji, Chopper, Robin, Franky, Brook, dan Jinbe, mereka menghadapi musuh-musuh kuat, aliansi yang berbahaya, dan misteri gelap yang mengelilingi sejarah dunia.\r\n\r\nSatu hal yang membuat One Piece menonjol adalah karakternya yang kuat dan kompleks, serta pengembangan dunia yang detail dan kaya. Meskipun telah berjalan selama bertahun-tahun, anime ini tetap populer berkat alur cerita yang menegangkan, aksi yang epik, dan pesan-pesan moral yang disampaikannya. One Piece tidak hanya anime, tetapi juga fenomena budaya yang telah memengaruhi generasi penggemar anime di seluruh dunia.', 0),
(4, 'Demon Slayer', 8.50, '2019-04-06', 'Action, Adventure, Fantasy', 'Koyoharu Gotouge', 'Ufotable', '../assets/images/posters/demon_slayer.jpg', '../assets/images/backgrounds/demon_slayer_bg.jpg', 'https://www.youtube.com/watch?v=VQGCKyvzIM4', 'Sebuah keluarga diserang oleh iblis dan hanya dua anggota yang selamat - Tanjiro dan adiknya Nezuko, yang perlahan berubah menjadi iblis. Tanjiro berangkat menjadi pembunuh iblis untuk membalas keluarganya dan menyembuhkan adiknya.', 'Demon Slayer (Kimetsu no Yaiba) adalah anime yang menggabungkan aksi, petualangan, dan fantasi gelap dalam sebuah cerita yang menegangkan. Dibuat oleh Koyoharu Gotouge, anime ini mengikuti perjalanan Tanjiro Kamado, seorang pemuda yang menjadi pemburu iblis setelah keluarganya diserang oleh iblis dan adiknya, Nezuko, berubah menjadi iblis. Tanjiro berusaha untuk menyembuhkan adiknya sambil membalas dendam atas kematian keluarganya.\r\n\r\nPertempurannya melawan iblis membawanya bergabung dengan Corp Slayer Pedang yang mematikan, di mana dia bertemu dengan berbagai karakter yang kuat dan berwarna. Setiap pertarungan dalam Demon Slayer tidak hanya menampilkan aksi yang intens tetapi juga pengembangan karakter yang mendalam, baik dari protagonis maupun antagonisnya.\r\n\r\nSelain itu, anime ini juga mengeksplorasi tema-tema seperti persaudaraan, keberanian, dan pengorbanan. Latar belakang yang indah dan desain karakter yang memukau juga menjadi salah satu daya tarik utama dari Demon Slayer. Dengan kombinasi yang sempurna antara emosi yang mendalam dan visual yang memukau, anime ini berhasil mendapatkan tempat di hati jutaan penggemar di seluruh dunia.', 0),
(5, 'My Hero Academia', 8.40, '2016-04-03', 'Action, Adventure, Superhero', 'Kohei Horikoshi', 'Bones', '../assets/images/posters/my_hero_academia.jpg', '../assets/images/backgrounds/my_hero_academia_bg.jpg', 'https://www.youtube.com/watch?v=-77UEct0cZM', 'Seorang anak laki-laki yang mencintai pahlawan super tanpa kekuatan apa pun bertekad untuk mendaftar di akademi pahlawan bergengsi dan belajar apa arti sebenarnya menjadi pahlawan.', 'My Hero Academia (Boku no Hero Academia) adalah anime yang mengambil tema tentang keberanian, impian, dan perjuangan untuk menjadi pahlawan. Diciptakan oleh Kohei Horikoshi, anime ini berlatar di dunia di mana hampir semua orang memiliki Quirk, kekuatan khusus yang unik. Cerita berpusat pada Izuku Midoriya, seorang anak biasa yang bermimpi untuk menjadi pahlawan super meskipun tidak memiliki Quirk.\r\n\r\nPerjalanan Izuku untuk mencapai impian itu dimulai ketika dia bertemu dengan pahlawan terkenal All Might, yang memberinya Quirk One For All. Bersama teman-temannya di Akademi Yuei, seperti Bakugo Katsuki, Ochaco Uraraka, dan Shoto Todoroki, Izuku belajar bagaimana menjadi pahlawan sejati dalam menghadapi musuh-musuh yang semakin kuat dan tantangan-tantangan yang tak terduga.\r\n\r\nMy Hero Academia tidak hanya menampilkan aksi yang seru tetapi juga menyampaikan pesan-pesan moral tentang keadilan, persahabatan, dan kepercayaan pada diri sendiri. Dengan karakter yang kompleks dan perkembangan plot yang menarik, anime ini telah menjadi salah satu yang paling populer dalam genre superhero.', 0),
(6, 'Inception', 9.00, '2010-07-16', 'Action, Sci-Fi, Thriller', 'Christopher Nolan', 'Warner Bros', '../assets/images/posters/inception.jpg', '../assets/images/backgrounds/inception_bg.jpg', 'https://www.youtube.com/watch?v=8hP9D6kZseM', 'Seorang pencuri yang mencuri rahasia perusahaan melalui penggunaan teknologi berbagi mimpi diberi tugas terbalik untuk menanamkan ide ke dalam pikiran seorang CEO.', 'Inception adalah film thriller psikologis yang dipimpin oleh sutradara Christopher Nolan, yang menggabungkan aksi spektakuler dengan konsep ilmiah yang mendalam. Cerita ini berpusat pada Dom Cobb, seorang pencuri yang memiliki kemampuan untuk memasuki mimpi orang lain dan mencuri rahasia dari alam bawah sadar mereka. Cobb mendapatkan tawaran untuk melakukan \"inception\", yaitu menanamkan ide ke dalam pikiran seseorang melalui mimpi.\r\n\r\nDalam perjalanan untuk menjalankan misi ini, Cobb bersama timnya menghadapi tantangan yang semakin rumit dan berbahaya, yang menguji batas kemampuan mereka serta mempertanyakan realitas yang mereka hadapi. Film ini mengeksplorasi tema-tema seperti memori, penyesalan, dan hubungan antara mimpi dan realitas.\r\n\r\nDikenal dengan visual yang menakjubkan dan twist plot yang tak terduga, Inception berhasil menggabungkan aksi yang mengesankan dengan cerita yang cerdas. Performa yang kuat dari Leonardo DiCaprio sebagai Dom Cobb juga menjadi salah satu faktor penarik utama dari film ini, membuatnya menjadi salah satu karya terbaik dalam filmografi Christopher Nolan.', 0),
(7, 'Interstellar', 9.00, '2014-11-07', 'Adventure, Drama, Sci-Fi', 'Christopher Nolan', 'Paramount Pictures', '../assets/images/posters/interstellar.jpg', '../assets/images/backgrounds/interstellar_bg.jpg', 'https://www.youtube.com/watch?v=zSWdZVtXT7E', 'Tim penjelajah melakukan perjalanan melalui lubang cacing di ruang angkasa dalam upaya untuk memastikan kelangsungan hidup umat manusia.', 'Interstellar adalah film epik yang disutradarai oleh Christopher Nolan, menggabungkan drama yang mendalam dengan eksplorasi ilmiah yang spektakuler. Cerita ini berlangsung di masa depan di mana bumi menghadapi krisis ekologi yang mengancam keberlangsungan hidup umat manusia. Sebuah tim penjelajah antariksa dipimpin oleh mantan pilot, Cooper, berangkat dalam misi berbahaya melintasi lubang cacing untuk menemukan planet baru yang dapat dihuni manusia.\r\n\r\nPerjalanan Cooper tidak hanya menghadapi tantangan fisik melintasi ruang dan waktu tetapi juga menguji cinta dan ikatan keluarganya. Film ini menggali tema-tema seperti waktu relatif, eksplorasi luar angkasa, dan eksistensi manusia di alam semesta yang luas. Dikenal dengan visual yang luar biasa dan skor musik yang mengesankan, Interstellar mengajak penonton untuk mempertanyakan tempat mereka dalam kosmos.\r\n\r\nDengan akting luar biasa dari Matthew McConaughey sebagai Cooper dan Anne Hathaway sebagai Amelia Brand, Interstellar tidak hanya menawarkan tontonan yang menarik tetapi juga mempertimbangkan pertanyaan filsafat yang dalam tentang keberadaan manusia dan masa depan peradaban. Film ini tetap menjadi salah satu karya paling ambisius dalam filmografi Christopher Nolan.', 0),
(8, 'The Matrix', 9.00, '1999-03-31', 'Action, Sci-Fi', 'Lana Wachowski, Lilly Wachowski', 'Warner Bros', '../assets/images/posters/the_matrix.jpg', '../assets/images/backgrounds/the_matrix_bg.jpg', 'https://www.youtube.com/watch?v=9ix7TUGVYIo', 'Seorang peretas komputer belajar dari pemberontak misterius tentang sifat kenyataannya yang sebenarnya dan perannya dalam perang melawan pengendali.', 'The Matrix adalah film yang merevolusi genre aksi ilmiah, disutradarai oleh Wachowski bersaudara dan menampilkan aksi spektakuler dengan premis yang inovatif. Cerita ini mengikuti Neo, seorang peretas komputer yang menemukan bahwa dunia yang dia tempati sebenarnya adalah simulasi virtual yang dikelola oleh mesin cerdas. Dia bergabung dengan gerilyawan pemberontak yang dipimpin oleh Morpheus untuk melawan kontrol mesin dan membebaskan umat manusia dari penjajahan digital.\r\n\r\nDikenal dengan efek visual yang revolusioner dan aksi yang mendebarkan, The Matrix juga mengeksplorasi tema-tema seperti realitas versus illusi, kebebasan individu, dan peran teknologi dalam kehidupan manusia. Film ini tidak hanya menarik untuk ditonton tetapi juga menantang pemirsa untuk mempertanyakan sifat eksistensi dan realitas mereka.\r\n\r\nPerforma Keanu Reeves sebagai Neo dan dukungan dari Laurence Fishburne sebagai Morpheus telah membuat The Matrix menjadi salah satu film kultus yang paling dihormati dalam sejarah perfilman. Dengan pengaruh yang luas terhadap budaya populer dan genre aksi ilmiah, film ini tetap relevan dan dihormati hingga hari ini.', 0),
(9, 'The Dark Knight', 9.00, '2008-07-18', 'Action, Crime, Drama', 'Jonathan Nolan, Christopher Nolan', 'Warner Bros', '../assets/images/posters/the_dark_knight.jpg', '../assets/images/backgrounds/the_dark_knight_bg.jpg', 'https://www.youtube.com/watch?v=EXeTwQWrcwY', 'Ketika ancaman yang dikenal sebagai Joker muncul dari masa lalunya yang misterius, ia menimbulkan kekacauan dan kehancuran di antara orang-orang Gotham. Sang Ksatria Kegelapan harus menerima salah satu tes psikologis dan fisik terbesar kemampuannya untuk melawan ketidakadilan.', 'The Dark Knight adalah film superhero yang disutradarai oleh Christopher Nolan dan dianggap sebagai salah satu yang terbaik dalam genre tersebut. Cerita ini melanjutkan petualangan Batman, yang diperankan oleh Christian Bale, dalam menghadapi musuh terbesarnya, Joker, yang diperankan oleh Heath Ledger dalam penampilan yang ikonis. Joker, seorang penjahat psikopat yang tidak bisa diprediksi, menantang Batman untuk mempertaruhkan segalanya dalam permainan kejahatan dan moralitas.\r\n\r\nFilm ini bukan hanya sekuel dari Batman Begins tetapi juga eksplorasi yang mendalam tentang karakter Batman sebagai pahlawan yang kompleks dan korupsi moral yang mengancam Gotham City. Di sisi lain, Harvey Dent, yang diperankan oleh Aaron Eckhart, menghadapi perubahan menjadi Two-Face setelah tragedi pribadi yang mengubah hidupnya.\r\n\r\nDikenal dengan cerita yang gelap, penuh ketegangan, dan penggambaran karakter yang mendalam, The Dark Knight menetapkan standar baru untuk film superhero. Kombinasi dari akting yang kuat, penyutradaraan yang cemerlang, dan tema yang berat membuat film ini tidak hanya menjadi tontonan yang menarik tetapi juga karya seni yang memprovokasi pemikiran.', 0),
(10, 'Pulp Fiction', 8.90, '1994-10-14', 'Crime, Drama', 'Quentin Tarantino, Roger Avary', 'Miramax', '../assets/images/posters/pulp_fiction.jpg', '../assets/images/backgrounds/pulp_fiction_bg.jpg', 'https://www.youtube.com/watch?v=tGpTpVyI_OQ', 'Kehidupan dua pembunuh bayaran, seorang petinju, seorang gangster dan istrinya, serta sepasang perampok restoran bersilangan dalam empat cerita tentang kekerasan dan penebusan.', 'Pulp Fiction adalah film kultus yang disutradarai oleh Quentin Tarantino, dikenal dengan narasi non-linear, dialog tajam, dan karakter-karakter yang ikonik. Cerita ini terdiri dari beberapa alur cerita yang berpotongan, tetapi terfokus pada kehidupan dua pembunuh bayaran, Vincent Vega dan Jules Winnfield, yang melakukan tugas-tugas mereka di bawah pimpinan bos mereka, Marsellus Wallace.\r\n\r\nSelain dari alur utama ini, Pulp Fiction juga memperkenalkan karakter-karakter lain seperti Butch Coolidge, seorang petinju yang melarikan diri setelah menolak menjalankan perintah Marsellus, serta Mia Wallace, istri Marsellus yang terlibat dalam serangkaian kejadian yang memutar balikkan kehidupan mereka.\r\n\r\nFilm ini tidak hanya menampilkan aksi yang intens dan plot yang penuh kejutan tetapi juga mengeksplorasi tema-tema seperti kehidupan kriminal, moralitas, dan keputusan hidup. Tarantino menggunakan dialog-dialog yang penuh gaya untuk membawa karakter-karakternya menjadi hidup dan menciptakan suasana yang gelap namun menghibur.\r\n\r\nPulp Fiction berhasil mendapatkan pengakuan luas sebagai salah satu film terbaik dalam sejarah perfilman, dengan pengaruhnya yang luas terhadap budaya populer dan genre film noir.', 0),
(11, 'Parasite', 9.00, '2019-05-30', 'Drama, Thriller', 'Bong Joon-ho', 'Barunson E&A', '../assets/images/posters/parasite.jpg', '../assets/images/backgrounds/parasite_bg.jpg', 'https://www.youtube.com/watch?v=SEUXfv87Wpk', "Ketamakan dan diskriminasi kelas mengancam hubungan simbiosis yang baru terbentuk antara keluarga Park yang kaya dan klan Kim yang miskin.', 'Parasite adalah film yang disutradarai oleh Bong Joon-ho, yang menggabungkan elemen drama dan thriller untuk menggambarkan ketidaksetaraan sosial dan ambisi keluarga. Cerita ini berpusat pada keluarga Kim, yang hidup dalam kondisi ekonomi yang sulit di sebuah apartemen bawah tanah. Mereka mencoba untuk meningkatkan taraf hidup mereka dengan cara yang tidak terduga, mengambil kesempatan ketika anak mereka direkomendasikan sebagai guru bahasa Inggris untuk keluarga kaya, Park.\r\n\r\nSebagai cerita berlanjut, alur plot mengungkapkan ketegangan antara keluarga Park yang kaya dan keluarga Kim yang miskin, dengan masing-masing keluarga memiliki rahasia dan agenda mereka sendiri. Film ini menggali tema-tema seperti kesenjangan ekonomi, pengkhianatan, dan kompleksitas hubungan antara kelas sosial.\r\n\r\nParasite tidak hanya berhasil sebagai thriller psikologis tetapi juga sebagai kritik sosial yang tajam terhadap ketidakadilan sosial. Dengan akting yang luar biasa dan penyutradaraan yang brilian dari Bong Joon-ho, film ini memenangkan Penghargaan Palme d\'Or di Festival Film Cannes 2019 dan mendapat pengakuan internasional yang luas.", 0),
(12, 'Train to Busan', 8.00, '2016-07-20', 'Action, Horror, Thriller', 'Park Joo-suk', 'Next Entertainment World', '../assets/images/posters/train_to_busan.jpg', '../assets/images/backgrounds/train_to_busan_bg.jpg', 'https://www.youtube.com/watch?v=pyWuHv2-Abk', 'Saat virus zombie mewabah di Korea Selatan, penumpang berjuang untuk bertahan hidup di kereta dari Seoul ke Busan.', 'Train to Busan adalah film horor yang mengambil latar belakang pandemi zombie di Korea Selatan. Disutradarai oleh Yeon Sang-ho, cerita ini mengikuti sekelompok penumpang kereta yang berjuang untuk bertahan hidup saat negara mereka dihantam oleh wabah virus mematikan yang mengubah orang-orang menjadi zombie lapar daging.\r\n\r\nSaat kereta menuju ke Busan, tempat yang dianggap aman dari wabah, penumpang harus berjuang tidak hanya melawan zombie tetapi juga konflik internal di antara mereka sendiri. Di tengah keputusasaan dan ketakutan, mereka harus menemukan cara untuk bekerja sama dan bertahan hidup.\r\n\r\nTrain to Busan menonjol dengan aksi yang intens, atmosfer yang tegang, dan pengembangan karakter yang mendalam. Film ini tidak hanya mengeksplorasi tema-tema seperti keberanian dan kelangsungan hidup tetapi juga menunjukkan sisi gelap dari manusia dalam situasi krisis. Dengan akting yang mengesankan dan efek visual yang mendebarkan, Train to Busan telah menjadi salah satu film horor paling sukses dalam beberapa tahun terakhir.', 0),
(13, 'Oldboy', 8.00, '2003-11-21', 'Action, Drama, Mystery', 'Park Chan-wook', 'Show East', '../assets/images/posters/oldboy.jpg', '../assets/images/backgrounds/oldboy_bg.jpg', 'https://www.youtube.com/watch?v=tAaBkFChaRg', 'Setelah diculik dan dipenjara selama lima belas tahun, Oh Dae-Su dilepaskan, hanya untuk menemukan bahwa ia harus menemukan penculiknya dalam lima hari.', 'Oldboy adalah film thriller yang disutradarai oleh Park Chan-wook, yang mengikuti perjalanan seorang pria bernama Oh Dae-Su. Cerita dimulai ketika Dae-Su diculik dan dipenjara selama lima belas tahun tanpa alasan yang jelas. Setelah tiba-tiba dibebaskan, Dae-Su memulai misi pribadinya untuk mencari tahu siapa yang menculiknya dan apa motif di balik penyiksaannya.\r\n\r\nDalam pencariannya, Dae-Su terlibat dalam serangkaian peristiwa misterius dan bertemu dengan karakter-karakter yang tidak terduga, termasuk seorang wanita bernama Mi-do yang menjadi mitra dalam pencariannya. Cerita mengarah pada twist yang mengubah segalanya dan memperlihatkan sisi gelap dari manusia serta dampak dari dendam yang membara.\r\n\r\nOldboy dikenal dengan penggambaran yang kuat tentang ketegangan psikologis dan kekerasan fisik. Film ini mengeksplorasi tema-tema seperti penyiksaan psikologis, keinginan balas dendam, dan ketegangan moral. Dengan akting yang mengesankan dan penyutradaraan yang cerdas, Oldboy telah diakui sebagai salah satu film thriller terbaik yang pernah dibuat.', 0),
(14, 'The Host', 8.50, '2006-07-27', 'Action, Drama, Horror', 'Bong Joon-ho', 'Showbox', '../assets/images/posters/the_host.jpg', '../assets/images/backgrounds/the_host_bg.jpg', 'https://www.youtube.com/watch?v=1HRTy26s4hw', 'Sebuah monster muncul dari Sungai Han di Seoul dan mulai menyerang orang-orang. Keluarga yang penuh cinta dari salah satu korban melakukan apa saja untuk menyelamatkannya dari cengkeraman monster.', 'The Host adalah film yang disutradarai oleh Bong Joon-ho, yang menggabungkan elemen-elemen aksi, drama, dan horor untuk menghadirkan cerita tentang monster yang menakutkan. Cerita dimulai ketika monster muncul dari sungai di Seoul dan mulai menyerang penduduk, menculik seorang gadis kecil yang merupakan anggota dari keluarga Park.\r\n\r\nKeluarga Park, yang terdiri dari ayah, kakek, dan dua saudara perempuan, bersatu untuk menyelamatkan gadis itu dari cengkeraman monster yang ganas. Mereka melakukan perjalanan berbahaya melalui kota yang dihantui oleh ancaman monster dan otoritas yang korup.\r\n\r\nSelain menawarkan aksi yang mendebarkan, The Host juga menggali tema-tema seperti keluarga, korupsi pemerintah, dan dampak lingkungan. Bong Joon-ho menggunakan film ini untuk menyampaikan pesan tentang konsekuensi dari tindakan manusia terhadap alam, sambil menyajikan narasi yang menyentuh dan bersemangat.\r\n\r\nDikenal dengan visual yang menakjubkan dan penggambaran karakter yang mendalam, The Host telah mendapatkan pengakuan sebagai salah satu film horor paling unik dan berpengaruh dari Korea Selatan.', 0),
(15, 'Snowpiercer', 8.60, '2013-08-01', 'Action, Drama, Sci-Fi', 'Bong Joon-ho', 'CJ Entertainment', '../assets/images/posters/snowpiercer.jpg', '../assets/images/backgrounds/snowpiercer_bg.jpg', 'https://www.youtube.com/watch?v=lGcJL6TG5cA', 'Di masa depan ketika eksperimen perubahan iklim yang gagal telah membunuh semua kehidupan kecuali bagi para penyintas yang naik Snowpiercer, sebuah kereta yang mengelilingi dunia, muncul sistem kelas baru.', 'Snowpiercer adalah film yang disutradarai oleh Bong Joon-ho, berdasarkan novel grafis Prancis Le Transperceneige. Cerita ini berlangsung di masa depan di mana upaya eksperimen perubahan iklim telah mengakibatkan dingin ekstrem yang membekukan seluruh planet. Satu-satunya sisa kehidupan manusia adalah penumpang yang hidup di Snowpiercer, kereta besar yang terus bergerak mengelilingi dunia.\r\n\r\nFilm ini mengikuti Curtis, seorang pemimpin dari kelas bawah yang berjuang untuk menggerakkan revolusi melawan rezim kelas atas yang mengontrol sumber daya dan nasib umat manusia. Dalam perjalanannya ke depan kereta, Curtis menghadapi berbagai tantangan moral dan fisik yang menguji tekad dan keyakinannya.\r\n\r\nSnowpiercer tidak hanya menampilkan adegan aksi yang spektakuler tetapi juga mengeksplorasi tema-tema seperti ketidakadilan sosial, revolusi, dan ketahanan manusia dalam menghadapi bencana global. Dengan akting yang kuat dan visual yang mengesankan, film ini telah menjadi salah satu karya yang paling dihormati dari Bong Joon-ho.', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_image` varchar(255) DEFAULT '../assets/images/user_profiles/default_profile.png',
  `is_admin` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `profile_image`, `is_admin`) VALUES
(1, 'Dija', 'yedija@gmail.com', '$2y$10$fhkgbdFkHZnle5I5X7hjb.e155b6FKh3x0CK2FKikE3MFqiGxjQHa', '../assets/images/user_profiles/default_profile.png', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `watchlist`
--

CREATE TABLE `watchlist` (
  `watchlist_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title_id` int(11) DEFAULT NULL,
  `watched` enum('Sedang Ditonton','Akan Ditonton','Ditahan','Selesai Ditonton') DEFAULT 'Akan Ditonton',
  `rating` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `watchlist`
--

INSERT INTO `watchlist` (`watchlist_id`, `user_id`, `title_id`, `watched`, `rating`) VALUES
(1, 1, 1, 'Akan Ditonton', NULL),
(2, 1, 4, 'Sedang Ditonton', NULL),
(3, 1, 12, 'Selesai Ditonton', 6),
(4, 1, 5, 'Ditahan', NULL),
(5, 1, 6, 'Sedang Ditonton', 3),
(6, 1, 2, 'Sedang Ditonton', 5);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `characters`
--
ALTER TABLE `characters`
  ADD PRIMARY KEY (`character_id`),
  ADD KEY `title_id` (`title_id`);

--
-- Indeks untuk tabel `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `title_id` (`title_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `temporary_characters`
--
ALTER TABLE `temporary_characters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `title_id` (`title_id`);

--
-- Indeks untuk tabel `temporary_titles`
--
ALTER TABLE `temporary_titles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `titles`
--
ALTER TABLE `titles`
  ADD PRIMARY KEY (`title_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeks untuk tabel `watchlist`
--
ALTER TABLE `watchlist`
  ADD PRIMARY KEY (`watchlist_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `title_id` (`title_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `characters`
--
ALTER TABLE `characters`
  MODIFY `character_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;

--
-- AUTO_INCREMENT untuk tabel `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `temporary_characters`
--
ALTER TABLE `temporary_characters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `temporary_titles`
--
ALTER TABLE `temporary_titles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `titles`
--
ALTER TABLE `titles`
  MODIFY `title_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `watchlist`
--
ALTER TABLE `watchlist`
  MODIFY `watchlist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `characters`
--
ALTER TABLE `characters`
  ADD CONSTRAINT `characters_ibfk_1` FOREIGN KEY (`title_id`) REFERENCES `titles` (`title_id`);

--
-- Ketidakleluasaan untuk tabel `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`title_id`) REFERENCES `titles` (`title_id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Ketidakleluasaan untuk tabel `temporary_characters`
--
ALTER TABLE `temporary_characters`
  ADD CONSTRAINT `temporary_characters_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `temporary_characters_ibfk_2` FOREIGN KEY (`title_id`) REFERENCES `titles` (`title_id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `temporary_titles`
--
ALTER TABLE `temporary_titles`
  ADD CONSTRAINT `temporary_titles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `watchlist`
--
ALTER TABLE `watchlist`
  ADD CONSTRAINT `watchlist_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `watchlist_ibfk_2` FOREIGN KEY (`title_id`) REFERENCES `titles` (`title_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
