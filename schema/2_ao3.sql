CREATE TABLE IF NOT EXISTS `works` (
  `id`                 INT UNSIGNED NOT NULL AUTO_INCREMENT,
  -- Tags
  `rating`             ENUM('Not Rated', 'General Audiences', 'Teen And Up Audiences', 'Mature', 'Explicit') NOT NULL,
  `warning_not`        BOOLEAN NOT NULL DEFAULT FALSE,
  `warning_violence`   BOOLEAN NOT NULL DEFAULT FALSE,
  `warning_death`      BOOLEAN NOT NULL DEFAULT FALSE,
  `warning_none_apply` BOOLEAN NOT NULL DEFAULT FALSE,
  `warning_noncon`     BOOLEAN NOT NULL DEFAULT FALSE,
  `warning_underage`   BOOLEAN NOT NULL DEFAULT FALSE,
  `fandoms`            VARCHAR(256) NOT NULL DEFAULT '',
  `category_ff`        BOOLEAN NOT NULL DEFAULT FALSE,
  `category_fm`        BOOLEAN NOT NULL DEFAULT FALSE,
  `category_gen`       BOOLEAN NOT NULL DEFAULT FALSE,
  `category_mm`        BOOLEAN NOT NULL DEFAULT FALSE,
  `category_multi`     BOOLEAN NOT NULL DEFAULT FALSE,
  `category_other`     BOOLEAN NOT NULL DEFAULT FALSE,
  `relationships`      VARCHAR(256) NOT NULL DEFAULT '',
  `characters`         VARCHAR(256) NOT NULL DEFAULT '',
  `other_tags`         VARCHAR(256) NOT NULL DEFAULT '',
  -- Preface
  `title`              VARCHAR(255) NOT NULL,
  `cocreators`         VARCHAR(256),
  `summary`            TEXT, -- Max 1,250 chars
  `notes_beginning`    TEXT, -- Max 5,000 chars
  `notes_end`          TEXT, -- Max 5,000 chars
  -- Associations
  `collections`        VARCHAR(256) NOT NULL DEFAULT '',
  `gift_to`            VARCHAR(256) NOT NULL DEFAULT '',
  `remix_uri`          VARCHAR(256),
  `remix_title`        VARCHAR(64),
  `remix_author`       VARCHAR(64),
  `remix_lang`         VARCHAR(8),
  `remix_translation`  BOOLEAN,
  `series`             VARCHAR(64),
  `publication`        DATE NOT NULL,
  `lang`               VARCHAR(8) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `chapters` (
  `id`               INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `work`             INT UNSIGNED NOT NULL,
  `publication`      DATE NOT NULL,
  `title`            VARCHAR(64) NOT NULL,
  `notes_beginning`  TEXT, -- Max 5,000 chars
  `notes_end`        TEXT, -- Max 5,000 chars
  `body`             LONGTEXT NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `langs` (
  `id`    INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `abbr`  VARCHAR(8) NOT NULL,
  `name`  VARCHAR(32) NOT NULL,
  PRIMARY KEY (`id`)
);

INSERT INTO `langs`
  (`abbr`, `name`)
  VALUES
    ('so', 'af Soomaali'),
    ('afr', 'Afrikaans'),
    ('ar', 'العربية'),
    ('egy', '𓂋𓏺𓈖 𓆎𓅓𓏏𓊖'),
    ('arc', 'ܐܪܡܝܐ | ארמיא'),
    ('hy', 'հայերեն'),
    ('ast', 'asturianu'),
    ('id', 'Bahasa Indonesia'),
    ('ms', 'Bahasa Malaysia'),
    ('bg', 'Български'),
    ('bn', 'বাংলা'),
    ('jv', 'Basa Jawa'),
    ('ba', 'Башҡорт теле'),
    ('be', 'беларуская'),
    ('bos', 'Bosanski'),
    ('br', 'Brezhoneg'),
    ('ca', 'Català'),
    ('ceb', 'Cebuano'),
    ('cs', 'Čeština'),
    ('chn', 'Chinuk Wawa'),
    ('cy', 'Cymraeg'),
    ('da', 'Dansk'),
    ('de', 'Deutsch'),
    ('et', 'eesti keel'),
    ('el', 'Ελληνικά'),
    ('sux', '𒅴𒂠'),
    ('en', 'English'),
    ('ang', 'Eald Englisċ'),
    ('es', 'Español'),
    ('eo', 'Esperanto'),
    ('eu', 'Euskara'),
    ('fa', 'فارسی'),
    ('fil', 'Filipino'),
    ('fr', 'Français'),
    ('fur', 'Furlan'),
    ('ga', 'Gaeilge'),
    ('gd', 'Gàidhlig'),
    ('gl', 'Galego'),
    ('got', '𐌲𐌿𐍄𐌹𐍃𐌺𐌰'),
    ('hak', '中文-客家话'),
    ('ko', '한국어'),
    ('hau', 'Hausa | هَرْشَن هَوْسَ'),
    ('hi', 'हिन्दी'),
    ('hr', 'Hrvatski'),
    ('haw', 'ʻŌlelo Hawaiʻi'),
    ('ia', 'Interlingua'),
    ('zu', 'isiZulu'),
    ('is', 'Íslenska'),
    ('it', 'Italiano'),
    ('he', 'עברית'),
    ('kal', 'Kalaallisut'),
    ('kan', 'ಕನ್ನಡ'),
    ('kat', 'ქართული'),
    ('cor', 'Kernewek'),
    ('khm', 'ភាសាខ្មែរ'),
    ('qkz', 'Khuzdul'),
    ('sw', 'Kiswahili'),
    ('ht', 'kreyòl ayisyen'),
    ('ku', 'Kurdî | کوردی'),
    ('kir', 'Кыргызча'),
    ('fcs', 'Langue des signes québécoise'),
    ('lv', 'Latviešu valoda'),
    ('lb', 'Lëtzebuergesch'),
    ('lt', 'Lietuvių kalba'),
    ('la', 'Lingua latina'),
    ('hu', 'Magyar'),
    ('mk', 'македонски'),
    ('ml', 'മലയാളം'),
    ('mt', 'Malti'),
    ('mnc', 'ᠮᠠᠨᠵᡠ ᡤᡳᠰᡠᠨ'),
    ('qmd', 'Mando´a'),
    ('mr', 'मराठी'),
    ('mik', 'Mikisúkî'),
    ('mon', 'ᠮᠣᠩᠭᠣᠯ ᠪᠢᠴᠢᠭ᠌ | Монгол Кирилл үсэг'),
    ('my', 'မြန်မာဘာသာ'),
    ('nah', 'Nāhuatl'),
    ('nan', '中文-闽南话 臺語'),
    ('ppl', 'Nawat'),
    ('nl', 'Nederlands'),
    ('ja', '日本語'),
    ('no', 'Norsk'),
    ('azj', 'Азәрбајҹан дили | آذربایجان دیلی'),
    ('ce', 'Нохчийн мотт'),
    ('ota', 'لسان عثمانى'),
    ('ps', 'پښتو'),
    ('nds', 'Plattdüütsch'),
    ('pl', 'Polski'),
    ('ptBR', 'Português brasileiro'),
    ('ptPT', 'Português europeu'),
    ('pa', 'ਪੰਜਾਬੀ'),
    ('kaz', 'qazaqşa | қазақша'),
    ('qya', 'Quenya'),
    ('ro', 'Română'),
    ('ru', 'Русский'),
    ('sco', 'Scots'),
    ('sq', 'Shqip'),
    ('sjn', 'Sindarin'),
    ('si', 'සිංහල'),
    ('sk', 'Slovenčina'),
    ('slv', 'Slovenščina'),
    ('gem', 'Sprēkō Þiudiskō'),
    ('sr', 'Српски'),
    ('fi', 'Suomi'),
    ('sv', 'Svenska'),
    ('ta', 'தமிழ்'),
    ('mri', 'te reo Māori'),
    ('tel', 'తెలుగు'),
    ('th', 'ไทย'),
    ('tqx', 'Thermian'),
    ('bod', 'བོད་སྐད་'),
    ('vi', 'Tiếng Việt'),
    ('cop', 'ϯⲙⲉⲧⲣⲉⲙⲛ̀ⲭⲏⲙⲓ'),
    ('tlh', 'tlhIngan-Hol'),
    ('tok', 'toki pona'),
    ('tsd', 'τσακώνικα'),
    ('chr', 'ᏣᎳᎩ ᎦᏬᏂᎯᏍᏗ'),
    ('tr', 'Türkçe'),
    ('uk', 'Українська'),
    ('urd', 'اُردُو'),
    ('uig', 'ئۇيغۇر تىلى'),
    ('vol', 'Volapük'),
    ('wuu', '中文-吴语'),
    ('yi', 'יידיש'),
    ('yua', 'maaya´ t´àan'),
    ('yue', '中文-广东话 粵語'),
    ('zh', '中文-普通话 國語');
