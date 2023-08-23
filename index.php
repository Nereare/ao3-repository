<?php require_once "header.php"; ?>

<main class="section">
  <div class="container">
    <div class="columns">
      <!-- Works List -->
      <div class="column is-4">
        <nav class="panel">
          <p class="panel-heading">
            Works
          </p>
          <div class="panel-block">
            <div class="control">
              <button class="button is-fullwidth is-primary" id="new-work">
                <span class="icon-text">
                  <span class="icon">
                    <i class="mdi mdi-folder-plus"></i>
                  </span>
                  <span>New Work</span>
                </span>
              </button>
            </div>
          </div>
          <div id="work-list"></div>
        </nav>
      </div>

      <!-- Edit Field -->
      <div class="column" id="container">
      </div>
    </div>
  </div>
</main>

<?php require_once "footer.php"; ?>
