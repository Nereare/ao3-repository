CREATE TABLE IF NOT EXISTS `works` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  -- Tags
  `rating` ENUM('Not Rated', 'General Audiences', 'Teen
And Up Audiences', 'Mature', 'Explicit') NOT NULL,
  `warning_not` BOOLEAN NOT NULL DEFAULT FALSE,
  `warning_violence` BOOLEAN NOT NULL DEFAULT FALSE,
  `warning_death` BOOLEAN NOT NULL DEFAULT FALSE,
  `warning_none_apply` BOOLEAN NOT NULL DEFAULT FALSE,
  `warning_noncon` BOOLEAN NOT NULL DEFAULT FALSE,
  `warning_underage` BOOLEAN NOT NULL DEFAULT FALSE,
  `fandoms` VARCHAR(256) NOT NULL DEFAULT '',
  `category_ff` BOOLEAN NOT NULL DEFAULT FALSE,
  `category_fm` BOOLEAN NOT NULL DEFAULT FALSE,
  `category_gen` BOOLEAN NOT NULL DEFAULT FALSE,
  `category_mm` BOOLEAN NOT NULL DEFAULT FALSE,
  `category_multi` BOOLEAN NOT NULL DEFAULT FALSE,
  `category_other` BOOLEAN NOT NULL DEFAULT FALSE,
  `relationships` VARCHAR(256) NOT NULL DEFAULT '',
  `characters` VARCHAR(256) NOT NULL DEFAULT '',
  `other_tags` VARCHAR(256) NOT NULL DEFAULT '',
  -- Preface
  `title` VARCHAR(255) NOT NULL,
  `cocreators` VARCHAR(256),
  `summary` TEXT, -- Max 1,250 chars
  `notes_beginning` TEXT, -- Max 5,000 chars
  `notes_end` TEXT, -- Max 5,000 chars
  -- Associations
  `collections` VARCHAR(256) NOT NULL DEFAULT '',
  `gift_to` VARCHAR(256) NOT NULL DEFAULT '',
  `remix_uri` VARCHAR(256),
  `remix_title` VARCHAR(64),
  `remix_author` VARCHAR(64),
  `remix_lang` VARCHAR(8),
  `remix_translation` BOOLEAN,
  `series` VARCHAR(64),
  `chapters` SMALLINT UNSIGNED,
  `publication` DATE NOT NULL,
  `lang` VARCHAR(8) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `chapters` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `work` INT UNSIGNED NOT NULL,
  `publication` DATE NOT NULL,
  `title` VARCHAR(64) NOT NULL,
  `body` LONGTEXT NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
);
