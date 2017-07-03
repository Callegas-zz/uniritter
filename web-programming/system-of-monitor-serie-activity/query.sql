
CREATE TABLE serie (
  serieId BIGINT AUTO_INCREMENT NOT NULL,
  serieName VARCHAR(100) NOT NULL,
  serieDescribe VARCHAR(350) NOT NULL,
  totalSeasons INT NOT NULL,
  PRIMARY KEY (serieId)
);


CREATE UNIQUE INDEX serie_idx
ON serie
( serieName );

CREATE TABLE user (
  userId BIGINT AUTO_INCREMENT NOT NULL,
  userPassword VARCHAR(30) NOT NULL,
  userLogin VARCHAR(30) NOT NULL,
  userName VARCHAR(30) NOT NULL,
  PRIMARY KEY (userId)
);


CREATE TABLE serie_rating (
  serie_ratingId BIGINT AUTO_INCREMENT NOT NULL,
  userId BIGINT NOT NULL,
  serieId BIGINT NOT NULL,
  rate DECIMAL(5) NOT NULL,
  PRIMARY KEY (serie_ratingId)
);


CREATE TABLE serie_user (
  serie_user_id BIGINT AUTO_INCREMENT NOT NULL,
  userId BIGINT NOT NULL,
  serieId BIGINT NOT NULL,
  currentSeason INT NOT NULL,
  currentEpisode INT NOT NULL,
  PRIMARY KEY (serie_user_id)
);


ALTER TABLE serie_user ADD CONSTRAINT serie_serie_user_fk
FOREIGN KEY (serieId)
REFERENCES serie (serieId)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE serie_rating ADD CONSTRAINT serie_serie_rating_fk
FOREIGN KEY (serieId)
REFERENCES serie (serieId)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE serie_user ADD CONSTRAINT user_serie_user_fk
FOREIGN KEY (userId)
REFERENCES user (userId)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE serie_rating ADD CONSTRAINT user_serie_rating_fk
FOREIGN KEY (userId)
REFERENCES user (userId)
ON DELETE NO ACTION
ON UPDATE NO ACTION;
