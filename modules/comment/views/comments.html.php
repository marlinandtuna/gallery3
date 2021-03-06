<?php defined("SYSPATH") or die("No direct script access.") ?>
  <a href="<?= url::site("form/add/comments/{$item->id}") ?>" id="g-admin-comment-button"
   class="g-button ui-corner-all ui-icon-left ui-state-default right">
  <span class="ui-icon ui-icon-comment"></span>
  <?= t("Add a comment") ?>
</a>
<div id="g-comment-detail">
<? if (!$comments->count()): ?>
<p id="g-no-comments-yet">
  <?= t("No comments yet. Be the first to <a %attrs>comment</a>!",
        array("attrs" => html::mark_clean("id= \"g-no-comments\" href=\"" . url::site("form/add/comments/{$item->id}") . "\" class=\"showCommentForm\""))) ?>
</p>
<? endif ?>
<ul>
  <? foreach ($comments as $comment): ?>
  <li id="g-comment-<?= $comment->id ?>">
    <p class="g-author">
      <a href="#">
        <img src="<?= $comment->author()->avatar_url(40, $theme->url("images/avatar.jpg", true)) ?>"
             class="g-avatar"
             alt="<?= html::clean_attribute($comment->author_name()) ?>"
             width="40"
             height="40" />
      </a>
      <? if ($comment->author()->guest): ?>
      <?= t('on %date %name said',
            array("date" => date("Y-M-d H:i:s", $comment->created),
                  "name" => html::clean($comment->author_name()))); ?>
      <? else: ?>
      <?= t('on %date <a href="%url">%name</a> said',
            array("date" => date("Y-M-d H:i:s", $comment->created),
                  "url" => user_profile::url($comment->author_id),
                  "name" => html::clean($comment->author_name()))); ?>
      <? endif ?>
    </p>
    <div>
      <?= nl2br(html::purify($comment->text)) ?>
    </div>
  </li>
  <? endforeach ?>
</ul>
</div>
