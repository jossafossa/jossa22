<?php
// Parse part args
$args = array_merge([
  "slug" => false,
], $args);
$slug = $args["slug"];
$types = 4;

$type = crc32($slug) % $types;

set_location(['projects', $slug]);
part("cards/project/card-project-$type", $args);
reset_location(); ?>
