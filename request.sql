--Create Table
CREATE TABLE `Player` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `name` varchar(64) COLLATE utf8_bin NOT NULL,
 PRIMARY KEY (`id`)
);
CREATE TABLE `Highscore` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `idGame` int(11) NOT NULL,
 `idPlayer` int(11) NOT NULL,
 `time` time DEFAULT NULL,
 `score` int(11) DEFAULT NULL,
 PRIMARY KEY (`id`)
);
-- Reset Player
DELETE FROM Player WHERE id != 1;
ALTER TABLE Player AUTO_INCREMENT = 1;