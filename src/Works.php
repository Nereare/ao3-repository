<?php
namespace Nereare\AO3;

class Works {

  private array          $works,
                         $langs;
  private \PDO           $db;
  private \PDOStatement  $get,
                         $add;

  /**
   * Create a work-management object.
   *
   * @param  \PDO    $db    The database connection object.
   */
  public function __construct(\PDO $db) {
    // Set \PDO database
    $this->db = $db;
    // Retrieve data
    $this->get = $this->db->prepare(
      "SELECT * FROM `works`"
    );
    $this->works = $this->update();
    // Prepare add query
    $this->add = $this->db->prepare(
      "INSERT INTO `works`
        (
          `rating`,
          `warning_not`,
          `warning_violence`,
          `warning_death`,
          `warning_none_apply`,
          `warning_noncon`,
          `warning_underage`,
          `fandoms`,
          `category_ff`,
          `category_fm`,
          `category_gen`,
          `category_mm`,
          `category_multi`,
          `category_other`,
          `relationships`,
          `characters`,
          `other_tags`,
          `title`,
          `cocreators`,
          `summary`,
          `notes_beginning`,
          `notes_end`,
          `collections`,
          `gift_to`,
          `remix_uri`,
          `remix_title`,
          `remix_author`,
          `remix_lang`,
          `remix_translation`,
          `series`,
          `lang`,
          `publication`
        ) VALUES (
          :rating,
          :warning_not,
          :warning_violence,
          :warning_death,
          :warning_none_apply,
          :warning_noncon,
          :warning_underage,
          :fandoms,
          :category_ff,
          :category_fm,
          :category_gen,
          :category_mm,
          :category_multi,
          :category_other,
          :relationships,
          :characters,
          :other_tags,
          :title,
          :cocreators,
          :summary,
          :notes_beginning,
          :notes_end,
          :collections,
          :gift_to,
          :remix_uri,
          :remix_title,
          :remix_author,
          :remix_lang,
          :remix_translation,
          :series,
          :lang,
          NOW()
        )"
    );
    // Retrieve languages
    $this->langs = $this->fetch_langs();
  }

  /***************************************************/
  /*                 PRIVATE METHODS                 */
  /***************************************************/

  /**
   * (Re)Fetch list of works.
   *
   * @return  array    A list of works.
   */
  private function update(): array {
    $this->get->execute();
    $res = $this->get->fetchAll(\PDO::FETCH_ASSOC);
    $this->get->closeCursor();
    return $res;
  }

  /**
   * Fetch registered languages from current database.
   *
   * @return   array    A list of languages abbreviations and names.
   */
  private function fetch_langs(): array {
    $res = $this->db->query(
      "SELECT `abbr`, `name` FROM `langs` ORDER BY `name` ASC",
      \PDO::FETCH_ASSOC
    )->fetchAll();
    return $res;
  }

  /**
   * Fetch possible values for given `ENUM` column.
   *
   * @param    string    $column    The name of the column to retrieve enum values.
   * @return   array                An array of strings of the possible enum values.
   */
  private function get_enum(string $column): array {
    $res = $this->db->query(
      "SHOW COLUMNS FROM `works` WHERE Field = '{$column}'",
      \PDO::FETCH_ASSOC
    )->fetch();
    preg_match("/^enum\(\'(.*)\'\)$/", $res["Type"], $matches);
    $enum = explode("','", $matches[1]);
    return $enum;
  }

  /***************************************************/
  /*                  PUBLIC METHODS                 */
  /***************************************************/

  /**
   * Get current list of works.
   *
   * @return  array    A list of works.
   */
  public function retrieve(): array {
    return $this->works;
  }

  /**
   * Get list of possible ratings.
   *
   * @return  array    A list of strings, each one of the possible ratings.
   */
  public function get_ratings(): array {
    return $this->get_enum("rating");
  }

  /**
   * Get possible languages.
   *
   * @return   array    A list of languages abbreviations and names.
   */
  public function get_langs(): array {
    return $this->langs;
  }

  /**
   * Add a new work to the list.
   *
   * @param   string          $rating                The rating of the work.
   * @param   boolean|null    $warning_not           Quasi-warning for if you choose not to use warnings.
   * @param   boolean|null    $warning_violence      Warning for graphic violence.
   * @param   boolean|null    $warning_death         Warning for major characters death.
   * @param   boolean|null    $warning_none_apply    Quasi-warning if none apply.
   * @param   boolean|null    $warning_noncon        Warning if non-consent is depicted.
   * @param   boolean|null    $warning_underage      Warning if underage is depicted.
   * @param   string          $fandoms               To what fandom(s) the work belongs.
   * @param   boolean|null    $category_ff           Category if F/F relations are present.
   * @param   boolean|null    $category_fm           Category if F/M relations are present.
   * @param   boolean|null    $category_gen          Category if general relations are present.
   * @param   boolean|null    $category_mm           Category if M/M relations are present.
   * @param   boolean|null    $category_multi        Category if multiple kinds of relations are present.
   * @param   boolean|null    $category_other        Category if other kinds of relations are present.
   * @param   string|null     $relationships         List of relationships depicted.
   * @param   string|null     $characters            List of character portrayed.
   * @param   string|null     $other_tags            List of miscellaneous tags.
   * @param   string          $title                 Title of the work.
   * @param   string|null     $cocreators            List of co-creators' usernames.
   * @param   string          $summary               Summary of the work.
   * @param   string|null     $notes_beginning       Notes to be shown at the beginning of the work.
   * @param   string|null     $notes_end             Notes to be shown at the end of the work.
   * @param   string|null     $collections           List of collection containing this work.
   * @param   string|null     $gift_to               Username of the person to which this work is gifted.
   * @param   string|null     $remix_uri             If a remix, the link to the original work.
   * @param   string|null     $remix_title           If a remix, the title of the original work.
   * @param   string|null     $remix_author          If a remix, the author of the original work.
   * @param   string|null     $remix_lang            If a remix, the language of the original work.
   * @param   boolean|null    $remix_translation     If a remix, if the is a tranlation of the original work.
   * @param   string|null     $series                If part of a series, its name.
   * @param   string          $lang                  The language of the work.
   *
   * @return void
   */
  public function add(
    string $rating,
    bool|null $warning_not,
    bool|null $warning_violence,
    bool|null $warning_death,
    bool|null $warning_none_apply,
    bool|null $warning_noncon,
    bool|null $warning_underage,
    string $fandoms,
    bool|null $category_ff,
    bool|null $category_fm,
    bool|null $category_gen,
    bool|null $category_mm,
    bool|null $category_multi,
    bool|null $category_other,
    string|null $relationships,
    string|null $characters,
    string|null $other_tags,
    string $title,
    string|null $cocreators,
    string $summary,
    string|null $notes_beginning,
    string|null $notes_end,
    string|null $collections,
    string|null $gift_to,
    string|null $remix_uri,
    string|null $remix_title,
    string|null $remix_author,
    string|null $remix_lang,
    bool|null $remix_translation,
    string|null $series,
    string $lang
  ): void {
    // Run add query
    $this->add->execute(["rating" => $rating,
      "warning_not" => $warning_not,
      "warning_violence" => $warning_violence,
      "warning_death" => $warning_death,
      "warning_none_apply" => $warning_none_apply,
      "warning_noncon" => $warning_noncon,
      "warning_underage" => $warning_underage,
      "fandoms" => $fandoms,
      "category_ff" => $category_ff,
      "category_fm" => $category_fm,
      "category_gen" => $category_gen,
      "category_mm" => $category_mm,
      "category_multi" => $category_multi,
      "category_other" => $category_other,
      "relationships" => $relationships,
      "characters" => $characters,
      "other_tags" => $other_tags,
      "title" => $title,
      "cocreators" => $cocreators,
      "summary" => $summary,
      "notes_beginning" => $notes_beginning,
      "notes_end" => $notes_end,
      "collections" => $collections,
      "gift_to" => $gift_to,
      "remix_uri" => $remix_uri,
      "remix_title" => $remix_title,
      "remix_author" => $remix_author,
      "remix_lang" => $remix_lang,
      "remix_translation" => $remix_translation,
      "series" => $series,
      "lang" => $lang
    ]);
  }
}
