<?php 
$default = array(
  "image" => false,
);
$args = array_merge($default, $args); 
$image = $args["image"];
?>

<section class="page-section section-hero">
  <?php if($image): ?>
    <picture class='has-filter'>
      <?= get_image($image) ?>
    </picture>
  <?php endif; ?>

  <div class="container">
    <div class="row row-1 row-lg-2 align-items-center">
      <div class="col">
        <h1>Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore rem atque error, voluptatibus fugiat iusto aperiam! Labore, vitae aliquam. Unde.</h1>
      </div>
      <div class="col">
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam sequi adipisci sint. Consequatur, corporis ipsam. Iure officiis itaque reprehenderit ex. Quibusdam voluptatibus tenetur, voluptatum labore, ut, beatae eveniet animi a necessitatibus eum assumenda rem ullam molestias. Sint esse eum laudantium.</p>
      </div>
    </div>
  </div>
</section>