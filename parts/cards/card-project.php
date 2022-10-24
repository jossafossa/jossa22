<?php
// Parse part args
$args = array_merge([
  "slug" => false,
], $args);
$slug = $args["slug"];
?>

<?php if ($slug) : ?>

  <?php
  set_location(['projects', $slug]);
  $url = get_field('url');
  $link_prefix = $url ? "<a href='$url'>" : '';
  $link_suffix = $url ? "</a>" : '';

  ?>

  <?= $link_prefix; ?>
  <article class="card-project vstack g-1">
    <?php if ($image = get_field('image')) : ?>
      <picture>
        <?= get_image($image) ?>
      </picture>
    <?php endif; ?>

    <section class="vstack g-1">
      <?php if ($title = get_field('title')) : ?>
        <h2>
          <?= $title ?>
        </h2>
      <?php endif; ?>
    </section>

  </article>
  <?= $link_suffix; ?>

  <?php reset_location(); ?>

<?php endif; ?>