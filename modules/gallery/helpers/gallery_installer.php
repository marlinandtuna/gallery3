<?php defined("SYSPATH") or die("No direct script access.");
/**
 * Gallery - a web based photo album viewer and editor
 * Copyright (C) 2000-2009 Bharat Mediratta
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or (at
 * your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street - Fifth Floor, Boston, MA  02110-1301, USA.
 */
class gallery_installer {
  static function install() {
    $db = Database::instance();
    $db->query("CREATE TABLE {access_caches} (
                 `id` int(9) NOT NULL auto_increment,
                 `item_id` int(9),
                 PRIMARY KEY (`id`))
               DEFAULT CHARSET=utf8;");

    $db->query("CREATE TABLE {access_intents} (
                 `id` int(9) NOT NULL auto_increment,
                 `item_id` int(9),
                 PRIMARY KEY (`id`))
               DEFAULT CHARSET=utf8;");

    $db->query("CREATE TABLE {caches} (
                `id` int(9) NOT NULL auto_increment,
                `key` varchar(255) NOT NULL,
                `tags` varchar(255),
                `expiration` int(9) NOT NULL,
                `cache` longblob,
                PRIMARY KEY (`id`),
                KEY (`tags`))
                DEFAULT CHARSET=utf8;");

    $db->query("CREATE TABLE {failed_logins} (
                `id` int(9) NOT NULL auto_increment,
                `count` int(9) NOT NULL,
                `name` varchar(255) NOT NULL,
                `time` int(9) NOT NULL,
                PRIMARY KEY (`id`))
                DEFAULT CHARSET=utf8;");

    $db->query("CREATE TABLE {graphics_rules} (
                 `id` int(9) NOT NULL auto_increment,
                 `active` BOOLEAN default 0,
                 `args` varchar(255) default NULL,
                 `module_name` varchar(64) NOT NULL,
                 `operation` varchar(64) NOT NULL,
                 `priority` int(9) NOT NULL,
                 `target`  varchar(32) NOT NULL,
                 PRIMARY KEY (`id`))
               DEFAULT CHARSET=utf8;");

    $db->query("CREATE TABLE {incoming_translations} (
                 `id` int(9) NOT NULL auto_increment,
                 `key` char(32) NOT NULL,
                 `locale` char(10) NOT NULL,
                 `message` text NOT NULL,
                 `revision` int(9) DEFAULT NULL,
                 `translation` text,
                 PRIMARY KEY (`id`),
                 UNIQUE KEY(`key`, `locale`),
                 KEY `locale_key` (`locale`, `key`))
               DEFAULT CHARSET=utf8;");

    $db->query("CREATE TABLE {items} (
                 `id` int(9) NOT NULL auto_increment,
                 `album_cover_item_id` int(9) default NULL,
                 `captured` int(9) default NULL,
                 `created` int(9) default NULL,
                 `description` varchar(2048) default NULL,
                 `height` int(9) default NULL,
                 `left_ptr` int(9) NOT NULL,
                 `level` int(9) NOT NULL,
                 `mime_type` varchar(64) default NULL,
                 `name` varchar(255) default NULL,
                 `owner_id` int(9) default NULL,
                 `parent_id` int(9) NOT NULL,
                 `rand_key` float default NULL,
                 `relative_path_cache` varchar(255) default NULL,
                 `relative_url_cache` varchar(255) default NULL,
                 `resize_dirty` boolean default 1,
                 `resize_height` int(9) default NULL,
                 `resize_width` int(9) default NULL,
                 `right_ptr` int(9) NOT NULL,
                 `slug` varchar(255) default NULL,
                 `sort_column` varchar(64) default NULL,
                 `sort_order` char(4) default 'ASC',
                 `thumb_dirty` boolean default 1,
                 `thumb_height` int(9) default NULL,
                 `thumb_width` int(9) default NULL,
                 `title` varchar(255) default NULL,
                 `type` varchar(32) NOT NULL,
                 `updated` int(9) default NULL,
                 `view_count` int(9) default 0,
                 `weight` int(9) NOT NULL default 0,
                 `width` int(9) default NULL,
                 PRIMARY KEY (`id`),
                 KEY `parent_id` (`parent_id`),
                 KEY `type` (`type`),
                 KEY `random` (`rand_key`),
                 KEY `weight` (`weight` DESC))
               DEFAULT CHARSET=utf8;");

    $db->query("CREATE TABLE {logs} (
                 `id` int(9) NOT NULL auto_increment,
                 `category` varchar(64) default NULL,
                 `html` varchar(255) default NULL,
                 `message` text default NULL,
                 `referer` varchar(255) default NULL,
                 `severity` int(9) default 0,
                 `timestamp` int(9) default 0,
                 `url` varchar(255) default NULL,
                 `user_id` int(9) default 0,
                 PRIMARY KEY (`id`))
               DEFAULT CHARSET=utf8;");

    $db->query("CREATE TABLE {messages} (
                 `id` int(9) NOT NULL auto_increment,
                 `key` varchar(255) default NULL,
                 `severity` varchar(32) default NULL,
                 `value` varchar(255) default NULL,
                 PRIMARY KEY (`id`),
                 UNIQUE KEY(`key`))
               DEFAULT CHARSET=utf8;");

    $db->query("CREATE TABLE {modules} (
                 `id` int(9) NOT NULL auto_increment,
                 `active` BOOLEAN default 0,
                 `name` varchar(64) default NULL,
                 `version` int(9) default NULL,
                 PRIMARY KEY (`id`),
                 UNIQUE KEY(`name`))
               DEFAULT CHARSET=utf8;");

    $db->query("CREATE TABLE {outgoing_translations} (
                 `id` int(9) NOT NULL auto_increment,
                 `base_revision` int(9) DEFAULT NULL,
                 `key` char(32) NOT NULL,
                 `locale` char(10) NOT NULL,
                 `message` text NOT NULL,
                 `translation` text,
                 PRIMARY KEY (`id`),
                 UNIQUE KEY(`key`, `locale`),
                 KEY `locale_key` (`locale`, `key`))
               DEFAULT CHARSET=utf8;");

    $db->query("CREATE TABLE {permissions} (
                 `id` int(9) NOT NULL auto_increment,
                 `display_name` varchar(64) default NULL,
                 `name` varchar(64) default NULL,
                 PRIMARY KEY (`id`),
                 UNIQUE KEY(`name`))
               DEFAULT CHARSET=utf8;");

    $db->query("CREATE TABLE {sessions} (
                `session_id` varchar(127) NOT NULL,
                `data` text NOT NULL,
                `last_activity` int(10) UNSIGNED NOT NULL,
                PRIMARY KEY (`session_id`))
               DEFAULT CHARSET=utf8;");

    $db->query("CREATE TABLE {tasks} (
                `id` int(9) NOT NULL auto_increment,
                `callback` varchar(128) default NULL,
                `context` text NOT NULL,
                `done` boolean default 0,
                `name` varchar(128) default NULL,
                `owner_id` int(9) default NULL,
                `percent_complete` int(9) default 0,
                `state` varchar(32) default NULL,
                `status` varchar(255) default NULL,
                `updated` int(9) default NULL,
                PRIMARY KEY (`id`),
                KEY (`owner_id`))
               DEFAULT CHARSET=utf8;");

    $db->query("CREATE TABLE {themes} (
                 `id` int(9) NOT NULL auto_increment,
                 `name` varchar(64) default NULL,
                 `version` int(9) default NULL,
                 PRIMARY KEY (`id`),
                 UNIQUE KEY(`name`))
               DEFAULT CHARSET=utf8;");

    $db->query("CREATE TABLE {vars} (
                `id` int(9) NOT NULL auto_increment,
                `module_name` varchar(64) NOT NULL,
                `name` varchar(64) NOT NULL,
                `value` text,
                PRIMARY KEY (`id`),
                UNIQUE KEY(`module_name`, `name`))
               DEFAULT CHARSET=utf8;");

    foreach (array("albums", "logs", "modules", "resizes", "thumbs", "tmp", "uploads") as $dir) {
      @mkdir(VARPATH . $dir);
      if (in_array($dir, array("logs", "tmp", "uploads"))) {
        self::_protect_directory(VARPATH . $dir);
      }
    }

    access::register_permission("view", "View");
    access::register_permission("view_full", "View full size");
    access::register_permission("edit", "Edit");
    access::register_permission("add", "Add");

    // Mark for translation (must be the same strings as used above)
    t("View full size");
    t("View");
    t("Edit");
    t("Add");

    // Hardcode the first item to sidestep ORM validation rules
    $now = time();
    db::build()->insert(
      "items",
      array("created" => $now,
            "description" => "",
            "left_ptr" => 1,
            "level" => 1,
            "parent_id" => 0,
            "resize_dirty" => 1,
            "right_ptr" => 2,
            "sort_column" => "weight",
            "sort_order" => "ASC",
            "thumb_dirty" => 1,
            "title" => "Gallery",
            "type" => "album",
            "updated" => $now,
            "weight" => 1))
      ->execute();
    $root = ORM::factory("item", 1);
    access::add_item($root);

    module::set_var("gallery", "active_site_theme", "wind");
    module::set_var("gallery", "active_admin_theme", "admin_wind");
    module::set_var("gallery", "page_size", 9);
    module::set_var("gallery", "thumb_size", 200);
    module::set_var("gallery", "resize_size", 640);
    module::set_var("gallery", "default_locale", "en_US");
    module::set_var("gallery", "image_quality", 75);
    module::set_var("gallery", "image_sharpen", 15);

    // Add rules for generating our thumbnails and resizes
    graphics::add_rule(
      "gallery", "thumb", "gallery_graphics::resize",
      array("width" => 200, "height" => 200, "master" => Image::AUTO),
      100);
    graphics::add_rule(
      "gallery", "resize", "gallery_graphics::resize",
      array("width" => 640, "height" => 640, "master" => Image::AUTO),
      100);

    // Instantiate default themes (site and admin)
    foreach (array("wind", "admin_wind") as $theme_name) {
      $theme_info = new ArrayObject(parse_ini_file(THEMEPATH . $theme_name . "/theme.info"),
                                    ArrayObject::ARRAY_AS_PROPS);
      $theme = ORM::factory("theme");
      $theme->name = $theme_name;
      $theme->version = $theme_info->version;
      $theme->save();
    }

    block_manager::add("dashboard_sidebar", "gallery", "block_adder");
    block_manager::add("dashboard_sidebar", "gallery", "stats");
    block_manager::add("dashboard_sidebar", "gallery", "platform_info");
    block_manager::add("dashboard_sidebar", "gallery", "project_news");
    block_manager::add("dashboard_center", "gallery", "welcome");
    block_manager::add("dashboard_center", "gallery", "photo_stream");
    block_manager::add("dashboard_center", "gallery", "log_entries");

    module::set_var("gallery", "choose_default_tookit", 1);
    module::set_var("gallery", "date_format", "Y-M-d");
    module::set_var("gallery", "date_time_format", "Y-M-d H:i:s");
    module::set_var("gallery", "time_format", "H:i:s");
    module::set_var("gallery", "show_credits", 1);
    // @todo this string needs to be picked up by l10n_scanner
    module::set_var("gallery", "credits", "Powered by <a href=\"%url\">Gallery %version</a>");
    module::set_var("gallery", "simultaneous_upload_limit", 5);
    module::set_version("gallery", 25);
  }

  static function upgrade($version) {
    $db = Database::instance();
    if ($version == 1) {
      module::set_var("gallery", "date_format", "Y-M-d");
      module::set_var("gallery", "date_time_format", "Y-M-d H:i:s");
      module::set_var("gallery", "time_format", "H:i:s");
      module::set_version("gallery", $version = 2);
    }

    if ($version == 2) {
      module::set_var("gallery", "show_credits", 1);
      module::set_version("gallery", $version = 3);
    }

    if ($version == 3) {
      $db->query("CREATE TABLE {caches} (
                 `id` varchar(255) NOT NULL,
                 `tags` varchar(255),
                 `expiration` int(9) NOT NULL,
                 `cache` text,
                 PRIMARY KEY (`id`),
                 KEY (`tags`))
                 DEFAULT CHARSET=utf8;");
      module::set_version("gallery", $version = 4);
    }

    if ($version == 4) {
      Cache::instance()->delete_all();
      $db->query("ALTER TABLE {caches} MODIFY COLUMN `cache` LONGBLOB");
      module::set_version("gallery", $version = 5);
    }

    if ($version == 5) {
      Cache::instance()->delete_all();
      $db->query("ALTER TABLE {caches} DROP COLUMN `id`");
      $db->query("ALTER TABLE {caches} ADD COLUMN `key` varchar(255) NOT NULL");
      $db->query("ALTER TABLE {caches} ADD COLUMN `id` int(9) NOT NULL auto_increment PRIMARY KEY");
      module::set_version("gallery", $version = 6);
    }

    if ($version == 6) {
      module::clear_var("gallery", "version");
      module::set_version("gallery", $version = 7);
    }

    if ($version == 7) {
      $groups = identity::groups();
      $permissions = ORM::factory("permission")->find_all();
      foreach($groups as $group) {
        foreach($permissions as $permission) {
          // Update access intents
          $db->query("ALTER TABLE {access_intents} MODIFY COLUMN {$permission->name}_{$group->id} BINARY(1) DEFAULT NULL");
          // Update access cache
          if ($permission->name === "view") {
            $db->query("ALTER TABLE {items} MODIFY COLUMN {$permission->name}_{$group->id} BINARY(1) DEFAULT FALSE");
          } else {
            $db->query("ALTER TABLE {access_caches} MODIFY COLUMN {$permission->name}_{$group->id} BINARY(1) NOT NULL DEFAULT FALSE");
          }
        }
      }
      module::set_version("gallery", $version = 8);
    }

    if ($version == 8) {
      $db->query("ALTER TABLE {items} CHANGE COLUMN `left`  `left_ptr`  INT(9) NOT NULL;");
      $db->query("ALTER TABLE {items} CHANGE COLUMN `right` `right_ptr` INT(9) NOT NULL;");
      module::set_version("gallery", $version = 9);
    }

    if ($version == 9) {
      $db->query("ALTER TABLE {items} ADD KEY `weight` (`weight` DESC);");

      module::set_version("gallery", $version = 10);
    }

    if ($version == 10) {
      module::set_var("gallery", "image_sharpen", 15);

      module::set_version("gallery", $version = 11);
    }

    if ($version == 11) {
      $db->query("ALTER TABLE {items} ADD COLUMN `relative_url_cache` varchar(255) DEFAULT NULL");
      $db->query("ALTER TABLE {items} ADD COLUMN `slug` varchar(255) DEFAULT NULL");

      // This is imperfect since some of the slugs may contain invalid characters, but it'll do
      // for now because we don't want a lengthy operation here.
      $db->query("UPDATE {items} SET `slug` = `name`");

      // Flush all path caches becuase we're going to start urlencoding them.
      $db->query("UPDATE {items} SET `relative_url_cache` = NULL, `relative_path_cache` = NULL");
      module::set_version("gallery", $version = 12);
    }

    if ($version == 12) {
      if (module::get_var("gallery", "active_site_theme") == "default") {
        module::set_var("gallery", "active_site_theme", "wind");
      }
      if (module::get_var("gallery", "active_admin_theme") == "admin_default") {
        module::set_var("gallery", "active_admin_theme", "admin_wind");
      }
      module::set_version("gallery", $version = 13);
    }

    if ($version == 13) {
      // Add rules for generating our thumbnails and resizes
      Database::instance()->query(
        "UPDATE {graphics_rules} SET `operation` = CONCAT('gallery_graphics::', `operation`);");
      module::set_version("gallery", $version = 14);
    }

    if ($version == 14) {
      $sidebar_blocks = block_manager::get_active("site_sidebar");
      if (empty($sidebar_blocks)) {
        $available_blocks = block_manager::get_available_site_blocks();
        foreach  (array_keys(block_manager::get_available_site_blocks()) as $id) {
          $sidebar_blocks[] = explode(":", $id);
        }
        block_manager::set_active("site_sidebar", $sidebar_blocks);
      }
      module::set_version("gallery", $version = 15);
    }

    if ($version == 15) {
      module::set_var("gallery", "identity_provider", "user");
      module::set_version("gallery", $version = 16);
    }

    // Convert block keys to an md5 hash of the module and block name
    if ($version == 16) {
      foreach (array("dashboard_sidebar", "dashboard_center", "site_sidebar") as $location) {
        $blocks = block_manager::get_active($location);
        $new_blocks = array();
        foreach ($blocks as $block) {
          $new_blocks[md5("{$block[0]}:{$block[1]}")] = $block;
        }
        block_manager::set_active($location, $new_blocks);
      }
      module::set_version("gallery", $version = 17);
    }

    // We didn't like md5 hashes so convert block keys back to random keys to allow duplicates.
    if ($version == 17) {
      foreach (array("dashboard_sidebar", "dashboard_center", "site_sidebar") as $location) {
        $blocks = block_manager::get_active($location);
        $new_blocks = array();
        foreach ($blocks as $block) {
          $new_blocks[rand()] = $block;
        }
        block_manager::set_active($location, $new_blocks);
      }
      module::set_version("gallery", $version = 18);
    }

    // Rename blocks_site.sidebar to blocks_site_sidebar
    if ($version == 18) {
      $blocks = block_manager::get_active("site.sidebar");
      block_manager::set_active("site_sidebar", $blocks);
      module::clear_var("gallery", "blocks_site.sidebar");
      module::set_version("gallery", $version = 19);
    }

    // Set a default for the number of simultaneous uploads
    // Version 20 was reverted in 57adefc5baa7a2b0dfcd3e736e80c2fa86d3bfa2, so skip it.
    if ($version == 19 || $version == 20) {
      module::set_var("gallery", "simultaneous_upload_limit", 5);
      module::set_version("gallery", $version = 21);
    }

    // Update the graphics rules table so that the maximum height for resizes is 640 not 480.
    // Fixes ticket #671
    if ($version == 21) {
      $resize_rule = ORM::factory("graphics_rule")
        ->where("id", "=", "2")
        ->find();
      // make sure it hasn't been changed already
      $args = unserialize($resize_rule->args);
      if ($args["height"] == 480 && $args["width"] == 640) {
        $args["height"] = 640;
        $resize_rule->args = serialize($args);
        $resize_rule->save();
      }
      module::set_version("gallery", $version = 22);
    }

    // Update slug values to be legal.  We should have done this in the 11->12 upgrader, but I was
    // lazy.  Mea culpa!
    if ($version == 22) {
      foreach (db::build()
               ->from("items")
               ->select("id", "slug")
               ->where(new Database_Expression("`slug` REGEXP '[^_A-Za-z0-9-]'"), "=", 1)
               ->execute() as $row) {
        $new_slug = item::convert_filename_to_slug($row->slug);
        if (empty($new_slug)) {
          $new_slug = rand();
        }
        db::build()
          ->update("items")
          ->set("slug", $new_slug)
          ->set("relative_url_cache", null)
          ->where("id", "=", $row->id)
          ->execute();
      }
      module::set_version("gallery", $version = 23);
    }

    if ($version == 23) {
      $db->query("CREATE TABLE {failed_logins} (
                  `id` int(9) NOT NULL auto_increment,
                  `count` int(9) NOT NULL,
                  `name` varchar(255) NOT NULL,
                  `time` int(9) NOT NULL,
                  PRIMARY KEY (`id`))
                  DEFAULT CHARSET=utf8;");
      module::set_version("gallery", $version = 24);
    }

    if ($version == 24) {
      foreach (array("logs", "tmp", "uploads") as $dir) {
        self::_protect_directory(VARPATH . $dir);
      }
      module::set_version("gallery", $version = 25);
    }
  }

  static function uninstall() {
    $db = Database::instance();
    $db->query("DROP TABLE IF EXISTS {access_caches}");
    $db->query("DROP TABLE IF EXISTS {access_intents}");
    $db->query("DROP TABLE IF EXISTS {graphics_rules}");
    $db->query("DROP TABLE IF EXISTS {incoming_translations}");
    $db->query("DROP TABLE IF EXISTS {failed_logins}");
    $db->query("DROP TABLE IF EXISTS {items}");
    $db->query("DROP TABLE IF EXISTS {logs}");
    $db->query("DROP TABLE IF EXISTS {modules}");
    $db->query("DROP TABLE IF EXISTS {outgoing_translations}");
    $db->query("DROP TABLE IF EXISTS {permissions}");
    $db->query("DROP TABLE IF EXISTS {sessions}");
    $db->query("DROP TABLE IF EXISTS {tasks}");
    $db->query("DROP TABLE IF EXISTS {themes}");
    $db->query("DROP TABLE IF EXISTS {vars}");
    $db->query("DROP TABLE IF EXISTS {caches}");
    foreach (array("albums", "resizes", "thumbs", "uploads",
                   "modules", "logs", "database.php") as $entry) {
      system("/bin/rm -rf " . VARPATH . $entry);
    }
  }

  static function _protect_directory($dir) {
    $fp = @fopen("$dir/.htaccess", "w+");
    fwrite($fp, "DirectoryIndex .htaccess\nSetHandler Gallery_Security_Do_Not_Remove\n" .
           "Options None\n<IfModule mod_rewrite.c>\nRewriteEngine off\n</IfModule>\n" .
           "Order allow,deny\nDeny from all\n");
    fclose($fp);
  }
}
