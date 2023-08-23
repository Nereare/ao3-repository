<?php
require "common.php";

if ($auth->isLoggedIn()) {
  if (isset($_GET["action"])) {
    switch ($_GET["action"]) {
      case "add":
        // Check sent data
        if (
          isset($_GET["rating"]) &&
          isset($_GET["warning_not"]) &&
          isset($_GET["warning_violence"]) &&
          isset($_GET["warning_death"]) &&
          isset($_GET["warning_none_apply"]) &&
          isset($_GET["warning_noncon"]) &&
          isset($_GET["warning_underage"]) &&
          isset($_GET["fandoms"]) &&
          isset($_GET["category_ff"]) &&
          isset($_GET["category_fm"]) &&
          isset($_GET["category_gen"]) &&
          isset($_GET["category_mm"]) &&
          isset($_GET["category_multi"]) &&
          isset($_GET["category_other"]) &&
          isset($_GET["relationships"]) &&
          isset($_GET["characters"]) &&
          isset($_GET["other_tags"]) &&
          isset($_GET["title"]) &&
          isset($_GET["cocreators"]) &&
          isset($_GET["summary"]) &&
          isset($_GET["notes_beginning"]) &&
          isset($_GET["notes_end"]) &&
          isset($_GET["collections"]) &&
          isset($_GET["gift_to"]) &&
          isset($_GET["remix_uri"]) &&
          isset($_GET["remix_title"]) &&
          isset($_GET["remix_author"]) &&
          isset($_GET["remix_lang"]) &&
          isset($_GET["remix_translation"]) &&
          isset($_GET["series"]) &&
          isset($_GET["lang"])
        ) {
          // If everything alright, run creation method
          $works->add(
            $_GET["rating"],
            $_GET["warning_not"],
            $_GET["warning_violence"],
            $_GET["warning_death"],
            $_GET["warning_none_apply"],
            $_GET["warning_noncon"],
            $_GET["warning_underage"],
            $_GET["fandoms"],
            $_GET["category_ff"],
            $_GET["category_fm"],
            $_GET["category_gen"],
            $_GET["category_mm"],
            $_GET["category_multi"],
            $_GET["category_other"],
            $_GET["relationships"],
            $_GET["characters"],
            $_GET["other_tags"],
            $_GET["title"],
            $_GET["cocreators"],
            $_GET["summary"],
            $_GET["notes_beginning"],
            $_GET["notes_end"],
            $_GET["collections"],
            $_GET["gift_to"],
            $_GET["remix_uri"],
            $_GET["remix_title"],
            $_GET["remix_author"],
            $_GET["remix_lang"],
            $_GET["remix_translation"],
            $_GET["series"],
            $_GET["lang"]
          );
          // And notify
          loggy("debug", "New work added", "works", "add");
          echo "0";
        } else {
          // If missing fields
          loggy("error", "Missing required fields", "works", "add");
          die("428");
        }
        break;
      default:
        loggy("error", "Invalid action", "works", "start");
        die("428");
    }
  } else {
    loggy("error", "Missing action", "works", "start");
    die("428");
  }
} else {
  loggy("error", "User not signed in", "works", "start");
  die("428");
}
