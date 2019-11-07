<?php
/**
 * @author Ayep's TM
 * @copyright 2019 AYEP'S
 * Author URI: https://ayeps.ru
 * Plugin Name: Ayep's Faker
 * Description: Generate fake post data during wordpress development
 * @version 0.1.0
 */

use bheller\ImagesGenerator\ImagesGeneratorProvider;
use Faker\Factory;

require_once 'vendor/autoload.php';

define( 'AYEPS_FAKER_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

add_action('admin_menu', 'init');
function init(){
    add_menu_page('Faker', 'Faker', 'administrator', 'ayp_faker', 'render_admin_page');
}

function render_admin_page()
{
    include 'template/admin-settings.php';
}

add_action('wp_ajax_ayp_faker_generate', 'ayp_faker_generate');
function ayp_faker_generate()
{
    $faker = Faker\Factory::create();
    $faker->addProvider(new ImagesGeneratorProvider($faker));

    $count = (int)$_POST['count'];
    $gen_image = (int)$_POST['generate_image'] == 1;
    $image_width = (int)$_POST['img']['width'] ?? 1200;
    $image_height = (int)$_POST['img']['height'] ?? 768;

    for ($i=0; $i < $count; $i++) {
        $id = wp_insert_post([
            'post_title'    => $faker->sentence,
            'post_content'  => $faker->paragraphs(10, true),
            'post_status'   => 'publish',
            'post_author'   => 1,
            'post_type' => 'post'
        ]);
        if ($gen_image) {
            set_post_thumbnail($id, getImage($faker, $image_width, $image_height) );
        }
    }

    wp_send_json([
        'img' => $gen_image,
        'status' => 'success'
    ]);
}

function getImage($faker, $width = 1200, $height = 768) {
    if (function_exists('imagettfbbox')) {
        $img = $faker->imageGenerator(AYEPS_FAKER_PLUGIN_DIR . 'tmp', $width, $height, 'png', false, true);
    } else {
        $img = $faker->imageGenerator(AYEPS_FAKER_PLUGIN_DIR . 'tmp', $width, $height, 'png', false, null, '#1f1f1f', '#ff2222');
    }

    $file_array = [
        'name' => $img,
        'tmp_name' => AYEPS_FAKER_PLUGIN_DIR . 'tmp/' . $img
    ];
    $img_id = media_handle_sideload($file_array, 0);

    @unlink(AYEPS_FAKER_PLUGIN_DIR . 'tmp/' . $img);

    return $img_id;
}
