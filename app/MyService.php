<?php

namespace Datlx\Avaocuoi;

class MyService
{
    public const OPTION = 'datlx_avaocuoi_service';
    public const OPTION_SLUG_SERVICE = 'datlx_avaocuoi_service';
    public const POST_TYPE_SERVICE = 'post_type_service';
    public const TAXONOMY_TAG = 'taxonomy_service_tag';
    public const TAXONOMY_CATEGORY = 'taxonomy_service_category';


    public function __construct()
    {
        add_action('init', [$this, 'servicePostType'], 0);
        add_action('init', [$this, 'serviceCategoryTaxonomy'], 0);
        add_action('init', [$this, 'serviceTagTaxonomy'], 0);
        add_action('single_template', [$this, 'portfolio_single'], 0);
    }

    public function getOption($option = '', $default = null)
    {
        $option = get_option(MyService::OPTION);

        return (isset($option[$option]) ? $option[$option] : $default);
    }

    public function servicePostType()
    {
        $slugText = $this->getOption(MyService::OPTION_SLUG_SERVICE);

        $slug = !(empty($slugText)) ? $slugText : 'dich-vu';

        // Register Custom Post Type

        $labels = array(
            'name' => _x('Services', 'Post Type General Name', 'aocuoi'),
            'singular_name' => _x('MyService', 'Post Type Singular Name', 'aocuoi'),
            'menu_name' => __('Services', 'aocuoi'),
            'name_admin_bar' => __('MyService', 'aocuoi'),
            'archives' => __('Item Archives', 'aocuoi'),
            'attributes' => __('Item Attributes', 'aocuoi'),
            'parent_item_colon' => __('Parent Item:', 'aocuoi'),
            'all_items' => __('All Items', 'aocuoi'),
            'add_new_item' => __('Add New Item', 'aocuoi'),
            'add_new' => __('Add New', 'aocuoi'),
            'new_item' => __('New Item', 'aocuoi'),
            'edit_item' => __('Edit Item', 'aocuoi'),
            'update_item' => __('Update Item', 'aocuoi'),
            'view_item' => __('View Item', 'aocuoi'),
            'view_items' => __('View Items', 'aocuoi'),
            'search_items' => __('Search Item', 'aocuoi'),
            'not_found' => __('Not found', 'aocuoi'),
            'not_found_in_trash' => __('Not found in Trash', 'aocuoi'),
            'featured_image' => __('Featured Image', 'aocuoi'),
            'set_featured_image' => __('Set featured image', 'aocuoi'),
            'remove_featured_image' => __('Remove featured image', 'aocuoi'),
            'use_featured_image' => __('Use as featured image', 'aocuoi'),
            'insert_into_item' => __('Insert into item', 'aocuoi'),
            'uploaded_to_this_item' => __('Uploaded to this item', 'aocuoi'),
            'items_list' => __('Items list', 'aocuoi'),
            'items_list_navigation' => __('Items list navigation', 'aocuoi'),
            'filter_items_list' => __('Filter items list', 'aocuoi'),
        );
        $args = array(
            'can_export' => true,
            'capability_type' => 'post',
            'description' => __('MyService type.', 'aocuoi'),
            'exclude_from_search' => false,
            'has_archive' => false,
            'hierarchical' => false,
            'label' => __('MyService', 'aocuoi'),
            'rewrite' => array('slug' => $slug),
            'labels' => $labels,
            'menu_position' => 20, // vi tri menu
            'menu_icon' => 'dashicons-images-alt2', // icon cua menu
            'public' => true,
            'publicly_queryable' => true,
            'show_in_admin_bar' => true,
            'show_in_menu' => true,
            'show_in_rest' => true, // cho phep su dung api
            'show_in_nav_menus' => true,
            'show_ui' => true,
            'supports' => array('title', 'editor', 'thumbnail', 'comments', 'revisions'), // cac tinh nang duoc ho tro trong page, co co dung elementor thi them no vao
        );
        register_post_type(MyService::POST_TYPE_SERVICE, $args);
    }

    // Register Custom Taxonomy
    public function serviceTagTaxonomy()
    {

        $labels = array(
            'add_new_item' => __('Add New MyService Tag', 'aocuoi'),
            'add_or_remove_items' => __('Add or remove MyService Tag', 'aocuoi'),
            'all_items' => __('All MyService Tags', 'aocuoi'),
            'choose_from_most_used' => __('Choose from the most used MyService Tag', 'aocuoi'),
            'edit_item' => __('Edit MyService Tag', 'aocuoi'),
            'items_list_navigation' => __('Items list navigation', 'aocuoi'),
            'items_list' => __('Items list', 'aocuoi'),
            'menu_name' => __('MyService Tag', 'aocuoi'),
            'name' => _x('MyService Tags', 'Taxonomy General Name', 'aocuoi'),
            'new_item_name' => __('New MyService Tag Name', 'aocuoi'),
            'no_terms' => __('No items', 'aocuoi'),
            'not_found' => __('Not Found', 'aocuoi'),
            'parent_item_colon' => __('Parent MyService Tag:', 'aocuoi'),
            'parent_item' => __('Parent MyService Tag', 'aocuoi'),
            'popular_items' => __('Popular Items', 'aocuoi'),
            'search_items' => __('Search MyService Tag', 'aocuoi'),
            'separate_items_with_commas' => __('Separate MyService Tag with commas', 'aocuoi'),
            'singular_name' => _x('MyService Tag', 'Taxonomy Singular Name', 'aocuoi'),
            'update_item' => __('Update MyService Tag', 'aocuoi'),
            'view_item' => __('View Item', 'aocuoi'),
        );
        $args = array(
            'hierarchical' => false,
            'labels' => $labels,
            'public' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'service-tags'), //trailingslashit('aocuoi') them ki tu / vao sau aocuoi de tao url cho link 
            'show_admin_column' => true,
            'show_in_nav_menus' => true,
            'show_in_rest' => true, // cho phep su dung api
            'show_tagcloud' => true,
            'show_ui' => true,
            'update_count_callback' => '_update_post_term_count',
        );
        register_taxonomy(MyService::TAXONOMY_TAG, array(MyService::POST_TYPE_SERVICE), $args);
    }

    public function serviceCategoryTaxonomy()
    {

        $labels = array(
            'add_new_item' => __('Add New MyService Category', 'aocuoi'),
            'add_or_remove_items' => __('Add or remove MyService Category', 'aocuoi'),
            'all_items' => __('All Categories', 'aocuoi'),
            'choose_from_most_used' => __('Choose from the most used MyService Category', 'aocuoi'),
            'edit_item' => __('Edit MyService Category', 'aocuoi'),
            'items_list_navigation' => __('Items list navigation', 'aocuoi'),
            'items_list' => __('Items list', 'aocuoi'),
            'menu_name' => __('MyService Category', 'aocuoi'),
            'name' => _x('Categories', 'Taxonomy General Name', 'aocuoi'),
            'new_item_name' => __('New MyService Category Name', 'aocuoi'),
            'no_terms' => __('No items', 'aocuoi'),
            'not_found' => __('Not Found', 'aocuoi'),
            'parent_item_colon' => __('Parent MyService Category:', 'aocuoi'),
            'parent_item' => __('Parent MyService Category', 'aocuoi'),
            'popular_items' => __('Popular Items', 'aocuoi'),
            'search_items' => __('Search MyService Category', 'aocuoi'),
            'separate_items_with_commas' => __('Separate MyService Category with commas', 'aocuoi'),
            'singular_name' => _x('MyService Category', 'Taxonomy Singular Name', 'aocuoi'),
            'update_item' => __('Update MyService Category', 'aocuoi'),
            'view_item' => __('View Item', 'aocuoi'),
        );
        $args = array(
            'hierarchical' => true,
            'labels' => $labels,
            'public' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'chip'),
            'show_admin_column' => true,
            'show_in_nav_menus' => true,
            'show_in_rest' => true, // cho phep su dung api
            'show_tagcloud' => true,
            'show_ui' => true,
            'update_count_callback' => '_update_post_term_count',
        );
        register_taxonomy(MyService::TAXONOMY_CATEGORY, array(MyService::POST_TYPE_SERVICE), $args);
    }

    public function portfolio_single($template)
    {
        global $post;

        if ($post->custom_post_type === MyService::POST_TYPE_SERVICE) {
            $template = Main::view('services/single.php');
        }

        return $template;
    }

    /**
     * Hien thi bai viet lien quan toi taxonomy la MyService::TAXONOMY_TAG
     */
    public function related()
    {
        global $post;

        $cats = get_the_term($post, MyService::TAXONOMY_CATEGORY);

        if ($cats) {
            $cat_ids = array();

            foreach ($cats as $cat) {
                $cat_ids[] = $cat->term_id;
            }

            $post_perpage = (int) $this->getOption('relpost_count', 3);

            $args = [
                'post_type' => '',
            ];
        }
    }
}
