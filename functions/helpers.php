<?php

/**
 * Get an image from slug
 */
function get_image($slug) {
  $folder = '/build/img';
  $sizes = [150, 300, 600, 900, 1500, 3000];
  $type = pathinfo($slug, PATHINFO_EXTENSION);
  $name = pathinfo($slug, PATHINFO_FILENAME);
  $srcset = join(', ', array_map(
    fn ($size) =>
    "$folder/$name@$size.$type ${size}w",
    $sizes
  ));
  return "<img 
    data-src='$folder/$name.$type'
    data-srcset='$srcset'
    data-sizes='auto'
    class='lazyload'
  />";
}


/**
 * get a template part
 */

function part($slug, $data = []) {
  $args = $data;
  include(ROOT . "/parts/$slug.php");
}

function set_location($new_location) {
  global $global_location;
  $global_location = $new_location;
}

function reset_location() {
  global $global_location;
  $global_location = [];
}

function fs_log($obj, $echo = true) {
  if ($echo) {
    echo "<pre><code>";
    print_r($obj);
    echo "</code></pre>";
  }
  $js_obj = json_encode($obj);
  echo "<script>console.log($js_obj)</script>";
}

function get_array_path($deepArray, $path) {
  $reduce = function ($xs, $x) {
    return (array) $xs[$x] ?? false;
  };
  return array_reduce($path, $reduce, (array) $deepArray);
}


$global_location = [];

function get_field($slug = false, $location = false) {
  global $db;
  global $global_location;
  if (!$location) $location = $global_location;

  $field = get_array_path($db, [...$location]);
  if (!$field) return false;

  if (!$slug) return $field;
  $field = $field[$slug] ?? false;

  return $field;
}

function get_fields($fields = [], $location = false) {
  $fields = array_map(fn ($field) => get_field($field, $location), $fields);
  return $fields;
}
