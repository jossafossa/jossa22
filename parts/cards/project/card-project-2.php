<?php 
$args = array_merge([
  "slug" => false,
], $args); 
$slug = $args["slug"];
?>
<?php if ($slug) : ?>

<?php
$url = get_field('url');
$link_prefix = $url ? "<a href='$url'>" : '';
$link_suffix = $url ? "</a>" : '';

?>
<?= $link_prefix; ?>
<article class="card-project-2 vstack g-1">
  <?php if ($image = get_field('image')) : ?>
    <picture class='has-radius ratio ratio-tall'>
      <?= get_image($image) ?>
    </picture>
  <?php endif; ?>

  <section class="vstack text-center">

  <?php if ($subtitle = get_field('subtitle')) : ?>
      <span class='h6 subtitle text-muted'>
        <?= $subtitle ?>
      </span>
    <?php endif; ?>

    <?php if ($title = get_field('title')) : ?>
      <h2 class='h4'>
        <?= $title ?>
      </h2>
    <?php endif; ?>

  </section>

</article>
<?= $link_suffix; ?>


<?php endif; ?>