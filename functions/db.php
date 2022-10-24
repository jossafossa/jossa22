<?php

function check_manditory($array, $keys, $object_name) {
  foreach ($keys as $key) {
    if (!isset($array[$key]) || !$array[$key]) throw new Exception("key $key not found in $object_name");
  }
}

class Menu {
  public function __construct($settings) {
    $settings = array_merge([
      'name' => false,
      'items' => [],
    ], $settings);
    check_manditory($settings, ['name'], 'make_menu');

    $this->name = $settings['name'];
    $this->items = $settings['items'];
  }
}

function get_menu($slug) {
  global $db;
  $menu = $db->menus[$slug] ?? false;
  if (!$menu) return false;
  return $menu;
}

function default_menu_item_callback($item) { ?>
  <li>
    <a href="<?= $item->url ?>" target='<?= $item->target ?>'><?= $item->title; ?></a>
  </li>
<?php }

function get_the_menu_items($slug, $item_callback = false) {
  ob_start();
  $menu = get_menu($slug) ?? false;
  if (!$menu) return false;

  $item_callback = is_callable($item_callback) ?: 'default_menu_item_callback';
  foreach ($menu->items as $item) {
    $item_callback($item);
  }
  return ob_get_clean();
}

function make_menu_items($items) {
  return array_map(fn ($item) => new MenuItem($item), $items);
}

class MenuItem {
  public function __construct($settings = []) {
    $settings = array_merge([
      'title' => false,
      'url' => '#',
      'target' => '_blank',
    ], $settings);
    $this->title = $settings['title'];
    $this->url = $settings['url'];
    $this->target = $settings['target'];
  }
}

class Project {
  public function __construct($settings = []) {
    $settings = array_merge([
      'title' => false,
      'url' => '#',
      'image' => 'placeholder.jpg',
      'slug' => false,
    ], $settings);
    $this->title = $settings['title'];
    $this->url = $settings['url'];
    $this->image = $settings['image'];
    $this->slug = $settings['slug'];
  }
}

$db = (object)[
  // MENUS
  'menus' => [
    'main_menu' => new Menu([
      'name' => 'Main Menu',
      'items' => [
        new MenuItem([
          'title' => 'Over ons',
          'url' => '#',
        ]),
        new MenuItem([
          'title' => 'Contact',
          'url' => '#',
        ]),
      ]
    ])
  ],

  // PROJECTS
  'projects' => [
    'project_1' => new Project([
      'title' => 'Test project',
      'image' => 'placeholder.jpg',
      'url' => '#',
      'slug' => 'project_1'
    ]),
    'project_2' => new Project([
      'title' => 'Test project 2',
      'image' => 'placeholder.jpg',
      'url' => '#',
      'slug' => 'project_2'
    ])
  ]
];
