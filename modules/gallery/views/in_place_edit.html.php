<?php defined("SYSPATH") or die("No direct script access.") ?>
<style>
  #g-inplace-edit-form ul {
    margin: 0;
  }
  #g-inplace-edit-message {
background-color: #FFF;
  }
</style>
<?= form::open($action, array("method" => "post", "id" => "g-inplace-edit-form", "class" => "g-short-form"), $hidden) ?>
  <ul>
    <li <? if (!empty($errors["input"])): ?> class="g-error"<? endif ?>>
      <?= form::input("input", $form["input"], " class='textbox'") ?>
    </li>
    <li>
      <?= form::submit(array("class" => "submit ui-state-default"), t("Save")) ?>
    </li>
    <li><a href="#" class="g-cancel"><?= t("Cancel") ?></a></li>
  </ul>
<?= form::close() ?>
<? if (!empty($errors["input"])): ?>
<div id="g-inplace-edit-message" class="g-error"><?= $errors["input"] ?></div>
<? endif ?>

