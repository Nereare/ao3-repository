<?php
require "common.php";

if ($auth->isLoggedIn()) {
  if (isset($_GET["action"])) {
    switch ($_GET["action"]) {
      case "empty": ?>
<div class="box has-text-centered">
  <p>Select a project...</p>
</div>
<?php
        loggy("debug", "Empty box requested and sent", "fills", "empty");
        break;
      case "new-work": ?>
<div class="box">
  <h2 class="title is-4">
    <span class="icon-text">
      <span class="icon">
        <i class="mdi mdi-folder-plus"></i>
      </span>
      <span>New Work</span>
    </span>
  </h2>

  <div class="field">
    <div class="control has-icons-left">
      <input type="text" class="input is-large" id="new-work-title" placeholder="Title" required>
      <span class="icon is-left">
        <i class="mdi mdi-format-header-1"></i>
      </span>
    </div>
  </div>

  <div class="field">
    <div class="control is-expanded has-icons-left">
      <div class="select is-fullwidth">
        <select id="new-work-rating" required>
          <option value="" selected disabled>Rating...</option>
          <?php foreach ($works->get_ratings() as $w) { ?>
            <option value="<?php echo $w; ?>"><?php echo $w; ?></option>
          <?php } ?>
        </select>
      </div>
      <span class="icon is-left">
        <i class="mdi mdi-shape"></i>
      </span>
    </div>
  </div>
  <div class="field">
    <div class="control has-icons-left">
      <input type="text" class="input" id="new-work-cocreators" data-type="tags" placeholder="Co-Creators">
      <span class="icon is-left">
        <i class="mdi mdi-account-edit"></i>
      </span>
    </div>
  </div>

  <h3 class="title is-5">
    <span class="icon-text">
      <span class="icon">
        <i class="mdi mdi-alert"></i>
      </span>
      <span>Warnings</span>
    </span>
  </h3>

  <div class="columns">
    <div class="column">
      <div class="field">
        <div class="control">
          <input type="checkbox" class="is-checkradio" id="new-work-warning_not">
          <label for="new-work-warning_not">Choose Not To Use</label>
        </div>
      </div>
      <div class="field">
        <div class="control">
          <input type="checkbox" class="is-checkradio" id="new-work-warning_violence">
          <label for="new-work-warning_violence">Graphic Violence</label>
        </div>
      </div>
      <div class="field">
        <div class="control">
          <input type="checkbox" class="is-checkradio" id="new-work-warning_death">
          <label for="new-work-warning_death">Major Character Death</label>
        </div>
      </div>
    </div>

    <div class="column">
      <div class="field">
        <div class="control">
          <input type="checkbox" class="is-checkradio" id="new-work-warning_none_apply">
          <label for="new-work-warning_none_apply">No Warnings Apply</label>
        </div>
      </div>
      <div class="field">
        <div class="control">
          <input type="checkbox" class="is-checkradio" id="new-work-warning_noncon">
          <label for="new-work-warning_noncon">Rape/Non-Con</label>
        </div>
      </div>
      <div class="field">
        <div class="control">
          <input type="checkbox" class="is-checkradio" id="new-work-warning_underage">
          <label for="new-work-warning_underage">Underage</label>
        </div>
      </div>
    </div>
  </div>

  <h3 class="title is-5">
    <span class="icon-text">
      <span class="icon">
        <i class="mdi mdi-gender-transgender"></i>
      </span>
      <span>Categories</span>
    </span>
  </h3>

  <div class="columns">
    <div class="column">
      <div class="field">
        <div class="control">
          <input type="checkbox" class="is-checkradio" id="new-work-category_ff">
          <label for="new-work-category_ff">F/F</label>
        </div>
      </div>
      <div class="field">
        <div class="control">
          <input type="checkbox" class="is-checkradio" id="new-work-category_fm">
          <label for="new-work-category_fm">F/M</label>
        </div>
      </div>
      <div class="field">
        <div class="control">
          <input type="checkbox" class="is-checkradio" id="new-work-category_gen">
          <label for="new-work-category_gen">Gen</label>
        </div>
      </div>
    </div>

    <div class="column">
      <div class="field">
        <div class="control">
          <input type="checkbox" class="is-checkradio" id="new-work-category_mm">
          <label for="new-work-category_mm">M/M</label>
        </div>
      </div>
      <div class="field">
        <div class="control">
          <input type="checkbox" class="is-checkradio" id="new-work-category_multi">
          <label for="new-work-category_multi">Multi</label>
        </div>
      </div>
      <div class="field">
        <div class="control">
          <input type="checkbox" class="is-checkradio" id="new-work-category_other">
          <label for="new-work-category_other">Other</label>
        </div>
      </div>
    </div>
  </div>

  <h3 class="title is-5">
    <span class="icon-text">
      <span class="icon">
        <i class="mdi mdi-tag-multiple"></i>
      </span>
      <span>Other Tags</span>
    </span>
  </h3>

  <div class="field">
    <div class="control has-icons-left">
      <input type="text" class="input" id="new-work-fandoms" data-type="tags" placeholder="Fandoms" required>
      <span class="icon is-left">
        <i class="mdi mdi-castle"></i>
      </span>
    </div>
  </div>
  <div class="field">
    <div class="control has-icons-left">
      <input type="text" class="input" id="new-work-relationships" data-type="tags" placeholder="Relationships">
      <span class="icon is-left">
        <i class="mdi mdi-account-multiple"></i>
      </span>
    </div>
  </div>
  <div class="field">
    <div class="control has-icons-left">
      <input type="text" class="input" id="new-work-characters" data-type="tags" placeholder="Characters">
      <span class="icon is-left">
        <i class="mdi mdi-account"></i>
      </span>
    </div>
  </div>
  <div class="field">
    <div class="control has-icons-left">
      <input type="text" class="input" id="new-work-other_tags" data-type="tags" placeholder="Other Tags">
      <span class="icon is-left">
        <i class="mdi mdi-tag"></i>
      </span>
    </div>
  </div>

  <h3 class="title is-5">
    <span class="icon-text">
      <span class="icon">
        <i class="mdi mdi-book-edit"></i>
      </span>
      <span>Summary</span>
    </span>
  </h3>

  <div class="field mb-0">
    <div class="control">
      <textarea class="textarea has-fixed-size countable-textarea" id="new-work-summary" rows="5" placeholder="Summary here..." data-max-chars="1250" required></textarea>
    </div>
    <p class="help mt-0 mb-3"><span id="new-work-summary-count">0</span> chars</p>
  </div>

  <h3 class="title is-5">
    <span class="icon-text">
      <span class="icon">
        <i class="mdi mdi-pencil"></i>
      </span>
      <span>Notes</span>
    </span>
  </h3>

  <div class="field">
    <div class="control">
      <input type="checkbox" class="is-checkradio" id="new-work-misc-beginning-notes">
      <label for="new-work-misc-beginning-notes">At the beginning</label>
    </div>
  </div>
  <div class="field is-hidden ml-5">
    <div class="control">
      <textarea class="textarea has-fixed-size countable-textarea" id="new-work-notes_beginning" rows="7" placeholder="Beginning notes..." data-max-chars="5000"></textarea>
    </div>
    <p class="help mt-0 mb-3"><span id="new-work-notes_beginning-count">0</span> chars</p>
  </div>

  <div class="field">
    <div class="control">
      <input type="checkbox" class="is-checkradio" id="new-work-misc-end-notes">
      <label for="new-work-misc-end-notes">At the end</label>
    </div>
  </div>
  <div class="field is-hidden ml-5 mb-0">
    <div class="control">
      <textarea class="textarea has-fixed-size countable-textarea" id="new-work-notes_end" rows="7" placeholder="Beginning notes..." data-max-chars="5000"></textarea>
    </div>
    <p class="help mt-0 mb-3"><span id="new-work-notes_end-count">0</span> chars</p>
  </div>

  <h3 class="title is-5">
    <span class="icon-text">
      <span class="icon">
        <i class="mdi mdi-dots-horizontal-circle"></i>
      </span>
      <span>Other</span>
    </span>
  </h3>

  <div class="field">
    <div class="control has-icons-left">
      <input type="text" class="input" id="new-work-collections" data-type="tags" placeholder="Collections...">
      <span class="icon is-left">
        <i class="mdi mdi-box-shadow"></i>
      </span>
    </div>
  </div>

  <div class="field">
    <div class="control has-icons-left">
      <input type="text" class="input" id="new-work-gift_to" data-type="tags" placeholder="Gift to...">
      <span class="icon is-left">
        <i class="mdi mdi-gift"></i>
      </span>
    </div>
  </div>

  <div class="field">
    <div class="control">
      <input type="checkbox" class="is-checkradio" id="new-work-misc-remix">
      <label for="new-work-misc-remix">This work is a remix, a translation, etc.</label>
    </div>
  </div>
  <div class="is-hidden ml-5 mb-3" id="new-work-misc-remix-div">
    <div class="field">
      <div class="control has-icons-left">
        <input type="text" class="input" id="new-work-remix_uri" placeholder="Original URI...">
        <span class="icon is-left">
          <i class="mdi mdi-link"></i>
        </span>
      </div>
    </div>
    <div class="field">
      <div class="control has-icons-left">
        <input type="text" class="input" id="new-work-remix_title" placeholder="Original title...">
        <span class="icon is-left">
          <i class="mdi mdi-format-title"></i>
        </span>
      </div>
    </div>
    <div class="field">
      <div class="control has-icons-left">
        <input type="text" class="input" id="new-work-remix_author" placeholder="Original author...">
        <span class="icon is-left">
          <i class="mdi mdi-account-edit"></i>
        </span>
      </div>
    </div>
    <div class="field">
      <div class="control is-expanded has-icons-left">
        <div class="select is-fullwidth">
          <select id="new-work-remix_lang">
            <option value="" selected disabled>Original language...</option>
            <?php foreach ($works->get_langs() as $lang) { ?>
              <option value="<?php echo $lang["abbr"]; ?>"><?php echo $lang["name"]; ?></option>
            <?php } ?>
          </select>
        </div>
        <span class="icon is-left">
          <i class="mdi mdi-translate"></i>
        </span>
      </div>
    </div>
    <div class="field">
      <div class="control">
        <input type="checkbox" class="is-checkradio" id="new-work-remix_translation">
        <label for="new-work-remix_translation">
          <span class="icon-text">
            <span class="icon is-left">
              <i class="mdi mdi-translate-variant"></i>
            </span>
            <span>This work is a translation</span>
          </span>
        </label>
      </div>
    </div>
  </div>

  <div class="field">
    <div class="control">
      <input type="checkbox" class="is-checkradio" id="new-work-misc-series">
      <label for="new-work-misc-series">This work is part of a series</label>
    </div>
  </div>
  <div class="field ml-5 is-hidden">
    <div class="control has-icons-left">
      <input type="text" class="input" id="new-work-series" data-type="tags" placeholder="Series...">
      <span class="icon is-left">
        <i class="mdi mdi-bookmark-box-multiple"></i>
      </span>
    </div>
  </div>

  <div class="field">
    <div class="control is-expanded has-icons-left">
      <div class="select is-fullwidth">
        <select id="new-work-lang" required>
          <option value="" selected disabled>Language...</option>
          <?php foreach ($works->get_langs() as $lang) { ?>
            <option value="<?php echo $lang["abbr"]; ?>"><?php echo $lang["name"]; ?></option>
          <?php } ?>
        </select>
      </div>
      <span class="icon is-left">
        <i class="mdi mdi-translate"></i>
      </span>
    </div>
  </div>

  <div class="field has-addons">
    <div class="control is-expanded">
      <button class="button is-fullwidth is-success" id="new-work-save">
        <span class="icon-text">
          <span class="icon">
            <i class="mdi mdi-content-save"></i>
          </span>
          <span>Save</span>
        </span>
      </button>
    </div>
    <div class="control is-expanded">
      <button class="button is-fullwidth" id="new-work-cancel">
        <span class="icon-text">
          <span class="icon">
            <i class="mdi mdi-cancel"></i>
          </span>
          <span>Cancel</span>
        </span>
      </button>
    </div>
  </div>
</div>
<?php
        loggy("debug", "New work form requested and sent", "fills", "new-work");
        break;
      case "work-list":
        $work_list = $works->retrieve();
        if (count($work_list) > 0) {
          foreach ($work_list as $w) { ?>
<a class="panel-block" data-wid="<?php echo $w["id"]; ?>">
  <span class="panel-icon">
    <i class="mdi mdi-folder"></i>
  </span>
  <span><?php echo $w["title"]; ?></span>
</a>
          <?php }
        } else { ?>
<div class="panel-block">
  <span class="panel-icon">
    <i class="mdi mdi-folder-question"></i>
  </span>
  <span>No works...</span>
</div><?php
        }
        loggy("debug", "Works' list requested and sent", "fills", "work-list");
        break;
      default: ?>
<div class="box">
  <p class="title is-2 has-text-warning">Tsc tsc tsc... How have you managed to use this action?</p>
</div>
<?php
        loggy("error", "Unrecognized action", "fills", "start");
        break;
    }
  } else { ?>
<div class="box">
  <p class="title is-2 has-text-warning">Tsc tsc tsc... We should have received something to do...</p>
</div>
<?php
    loggy("error", "Missing action", "fills", "start");
  }
} else { ?>
<div class="box">
  <p class="title is-2 has-text-danger">You should not be seeing this, you sneaky bastard!</p>
</div>
<?php
  loggy("error", "User not signed in", "fills", "start");
}
