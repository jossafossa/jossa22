<?php


function get_image($slug) {
  $folder = '/build/img';
  $sizes = [150, 300, 600, 900, 1500, 3000];
  $srcset = join(', ', array_map(
    fn ($size) =>
    "$folder/$slug@$size.webp ${size}w",
    $sizes
  ));
  return "
  <noscript>
	  <img src='$slug.webp' />
  </noscript>
  <img 
    data-src='$folder/$slug@75.webp'
    data-srcset='$srcset'
    data-sizes='auto'
    class='lazyload'
    data-optimumx='1.5'
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
