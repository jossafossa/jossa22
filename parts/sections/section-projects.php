<?php
// Parse template_part args
$args = array_merge([
  "title" => false,
  "projects" => false,
], $args);
$title = $args["title"];
$projects = $args["projects"] ? get_fields($args["projects"], ['projects']) : get_field('projects');
?>

<?php if (count($projects) > 0) : ?>
  <section class="page-section">
    <div class="container">
      <div class="vstack g-2">
        <?php if ($title) : ?>
          <h2>
            <?= $title; ?>
          </h2>
        <?php endif; ?>

        <div class="row g-1 row-1 row-md-2 row-lg-3">

          <?php foreach ($projects as $project) : ?>
            <div class="col">
              <?php part('cards/card-project', [
                'slug' => $project->slug
              ]); ?>
            </div>
          <?php endforeach; ?>

        </div>

      </div>
    </div>
  </section>
<?php endif; ?>

<?php fs_log(get_field('title')) ?>