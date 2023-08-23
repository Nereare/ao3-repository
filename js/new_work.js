function new_work() {
  // Bulma tags input setting up
  BulmaTagsInput.attach();

  // Show notes' fields
  $("#new-work-misc-beginning-notes").on("change", function() {
    if ($(this).is(":checked")) {
      $("#new-work-notes_beginning")
        .parent().parent().removeClass("is-hidden")
        .find("textarea").trigger("focus");
    } else {
      $("#new-work-notes_beginning")
        .val("")
        .parent().parent().addClass("is-hidden");
    }
  });
  $("#new-work-misc-end-notes").on("change", function () {
    if ($(this).is(":checked")) {
      $("#new-work-notes_end")
        .parent().parent().removeClass("is-hidden")
        .find("textarea").trigger("focus");
    } else {
      $("#new-work-notes_end")
        .val("")
        .parent().parent().addClass("is-hidden");
    }
  });

  // Show other fields
  $("#new-work-misc-remix").on("change", function() {
    if ($(this).is(":checked")) {
      $("#new-work-misc-remix-div").removeClass("is-hidden");
    } else {
      $("#new-work-misc-remix-div").addClass("is-hidden");
    }
  });
  $("#new-work-misc-series").on("change", function () {
    if ($(this).is(":checked")) {
      $("#new-work-series")
        .parent().parent().removeClass("is-hidden")
        .find("textarea").trigger("focus");
    } else {
      $("#new-work-series")
        .val("")
        .parent().parent().addClass("is-hidden");
    }
  });

  // Count characters in textareas
  $(".countable-textarea").on("change input", function() {
    // Get data
    let max = parseInt($(this).attr("data-max-chars"));
    let size = $(this).val().length;
    let id = $(this).attr("id");
    // Change span contents to textarea size
    $("#" + id + "-count")
      .removeClass("has-text-danger")
      .html(size);
    // Change color, if size extrapolates max
    if (size > max) {
      $("#" + id + "-count").addClass("has-text-danger");
    }
  });

  // Cancel button
  $("#new-work-cancel").on("click", function() {
    closeWork();
  });
  // Save new work
  $("#new-work-save").on("click", function() {
    // Disable button
    let btn = $(this);
    btn
      .addClass("is-loading")
      .attr("disabled", true);
    // Check required fields
    if (
      $("#new-work-title").val() != "" &&
      $("#new-work-rating").val() != "" &&
      $("#new-work-fandoms").val() != "" &&
      $("#new-work-summary").val() != "" &&
      $("#new-work-lang").val() != ""
    ) {
      // Fetch work data
      let data = {
        action:              "add",
        rating:              $("#new-work-rating").val(),
        warning_not:         $("#new-work-warning_not").val(),
        warning_violence:    $("#new-work-warning_violence").is(":checked"),
        warning_death:       $("#new-work-warning_death").is(":checked"),
        warning_none_apply:  $("#new-work-warning_none_apply").is(":checked"),
        warning_noncon:      $("#new-work-warning_noncon").is(":checked"),
        warning_underage:    $("#new-work-warning_underage").is(":checked"),
        fandoms:             $("#new-work-fandoms").val(),
        category_ff:         $("#new-work-category_ff").is(":checked"),
        category_fm:         $("#new-work-category_fm").is(":checked"),
        category_gen:        $("#new-work-category_gen").is(":checked"),
        category_mm:         $("#new-work-category_mm").is(":checked"),
        category_multi:      $("#new-work-category_multi").is(":checked"),
        category_other:      $("#new-work-category_other").is(":checked"),
        relationships:       ($("#new-work-relationships").val() == "") ? null : $("#new-work-relationships").val(),
        characters:          ($("#new-work-characters").val() == "") ? null : $("#new-work-characters").val(),
        other_tags:          ($("#new-work-other_tags").val() == "") ? null : $("#new-work-other_tags").val(),
        title:               $("#new-work-title").val(),
        cocreators:          ($("#new-work-cocreators").val() == "") ? null : $("#new-work-cocreators").val(),
        summary:             $("#new-work-summary").val(),
        notes_beginning:     ($("#new-work-notes_beginning").val() == "") ? null : $("#new-work-notes_beginning").val(),
        notes_end:           ($("#new-work-notes_end").val() == "") ? null : $("#new-work-notes_end").val(),
        collections:         ($("#new-work-collections").val() == "") ? null : $("#new-work-collections").val(),
        gift_to:             ($("#new-work-gift_to").val() == "") ? null : $("#new-work-gift_to").val(),
        remix_uri:           ($("#new-work-remix_uri").val() == "") ? null : $("#new-work-remix_uri").val(),
        remix_title:         ($("#new-work-remix_title").val() == "") ? null : $("#new-work-remix_title").val(),
        remix_author:        ($("#new-work-remix_author").val() == "") ? null : $("#new-work-remix_author").val(),
        remix_lang:          ($("#new-work-remix_lang").val() == "") ? null : $("#new-work-remix_lang").val(),
        remix_translation:   $("#new-work-remix_translation").is(":checked"),
        series:              ($("#new-work-series").val() == "") ? null : $("#new-work-series").val(),
        lang:                $("#new-work-lang").val()
      };
      // Run ajax
      $.ajax({
        url: "php/works.php",
        method: "get",
        data: data
      })
        .fail(function() { reply = "500"; } )
        .done(function(r) { reply = r; })
        .always(function() {
          resetNotification();
          if (reply == "0") {
            closeWork();
            refreshWorks();
            setNotification("Work created successfully.", "is-success");
          } else {
            // Reenable button
            btn
              .removeClass("is-loading")
              .attr("disabled", false);
            setNotification("The creation try returned an error.<br>Error #" + reply, "is-danger");
          }
        });
    } else {
      // Show notification
      resetNotification();
      setNotification("You must fill all required fields!", "is-warning");
      // Reenable button
      btn
        .removeClass("is-loading")
        .attr("disabled", false);
    }
  });
}
