-- Setting the collation of the database to utf8
ALTER DATABASE jlambert13 CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS `clap`;
DROP TABLE IF EXISTS article;
DROP TABLE IF EXISTS profile;

-- creating profile entity
CREATE TABLE profile (
	-- primary key attribute creation
	-- NOT NULL === required
	profileId BINARY(16) NOT NULL,
	profileActivationToken CHAR (32),
	profileFirstName VARCHAR (32) NOT NULL,
	profileLastName VARCHAR (32) NOT NULL,
	profileEmail VARCHAR (128) NOT NULL,
	profileHash CHAR(97) NOT NULL,
	UNIQUE(profileEmail),
	PRIMARY KEY(profileId)
);

-- creating article entity
CREATE TABLE article (
	articleId BINARY(16) NOT NULL,
	articleProfileId BINARY(16) NOT NULL,
	-- 21845 is the limit,
	articleContent VARCHAR(8192) NOT NULL,
	articleDate DATETIME(6) NOT NULL,
	INDEX (articleProfileId),
	FOREIGN KEY (articleProfileId) REFERENCES profile(profileId),
	PRIMARY KEY (articleId)
);

-- creating the clap entity (weak entity from m-to-n for profile --> article)
CREATE TABLE `clap` (
	clapProfileId BINARY(16) NOT NULL,
	clapArticleId BINARY(16) NOT NULL,
	clapDate DATETIME(6) NOT NULL,
	-- max clap is 50, but will be constrained by the logic
	clapNumber TINYINT UNSIGNED NOT NULL,
	-- index of foreign keys
	INDEX(clapProfileId),
	INDEX(clapArticleId),
	-- foreign key relation creation
	FOREIGN KEY (clapProfileId) REFERENCES profile(profileId),
	FOREIGN KEY (clapArticleId) REFERENCES article(articleId),
	-- composite foreign key of foreign keys
	PRIMARY KEY (clapProfileId, clapArticleId)
);