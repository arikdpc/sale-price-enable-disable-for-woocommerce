<?php
add_action('wp_ajax_des_restore_sale_prices', 'des_restore_sale_prices');
add_action('wp_ajax_nopriv_des_restore_sale_prices', 'des_restore_sale_prices');

function des_restore_sale_prices() {
    $per_page = intval($_POST['per_page']);
    $page = intval($_POST['page']);

    $args = array(
        'post_type' => 'product',
        'posts_per_page' => $per_page,
        'paged' => $page,
        'post_status' => 'publish',
    );
    $loop = new WP_Query($args);

    while ($loop->have_posts()) {
        $loop->the_post();
        $product = wc_get_product(get_the_ID());
        if ($product) {
            if ($product->is_type('variable')) {
                foreach ($product->get_children() as $child_id) {
                    $variation = wc_get_product($child_id);
                    $original_sale_price = get_post_meta($variation->get_id(), '_original_sale_price', true);
                    if (!empty($original_sale_price)) {
                        $variation->set_sale_price($original_sale_price);
                        $variation->save();
                        delete_post_meta($variation->get_id(), '_original_sale_price');
                    }
                }
            } else {
                $original_sale_price = get_post_meta($product->get_id(), '_original_sale_price', true);
                if (!empty($original_sale_price)) {
                    $product->set_sale_price($original_sale_price);
                    $product->save();
                    delete_post_meta($product->get_id(), '_original_sale_price');
                }
            }
        }
    }

    wp_reset_postdata();

    $next_page = $page + 1;
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => $per_page,
        'paged' => $next_page,
        'post_status' => 'publish',
    );
    $loop = new WP_Query($args);

    wp_send_json(array('done' => !$loop->have_posts()));

    wp_die(); // this is required to terminate immediately and return a proper response
}
