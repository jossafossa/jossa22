<?php 

/**
 * Get an image from slug
 */
function get_image($slug) {
  $folder = '/build/img';
  $sizes = [150, 300,600,900,1500,3000];
  $srcset = join(', ', array_map(fn($size) => 
    "$folder/$slug@$size.webp ${size}w"
  , $sizes));
  return "<img 
    data-src='$folder/$slug.webp'
    data-srcset='$srcset'
    data-sizes='auto'
    class='lazyload'
  />";
}


/**
 * get a template part
 */

 function part($slug, $data) {
  $args = $data;
  include(ROOT . "/parts/$slug.php");
 }


?>