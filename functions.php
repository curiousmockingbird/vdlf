<?php


/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our theme. We will simply require it into the script here so that we
| don't have to worry about manually loading any of our classes later on.
|
*/

if (! file_exists($composer = __DIR__ . '/vendor/autoload.php')) {
    wp_die(__('Error locating autoloader. Please run <code>composer install</code>.', 'sage'));
}

require $composer;

/*
|--------------------------------------------------------------------------
| Run The Theme
|--------------------------------------------------------------------------
|
| Once we have the theme booted, we can handle the incoming request using
| the application's HTTP kernel. Then, we will send the response back
| to this client's browser, allowing them to enjoy our application.
|
*/

require_once __DIR__ . '/bootstrap/app.php';

function wpcc_allowed_block_types() {
	return array(
		'core/paragraph'
	);
}
add_filter( 'allowed_block_types', 'wpcc_allowed_block_types' );

$editor = get_role('editor');
// add $cap capability to this role object
$editor->add_cap('edit_theme_options');

add_action('admin_menu', function () {
    if (!current_user_can('manage_options') && function_exists('PLL')) {
        add_menu_page(__('Strings translations', 'sage'), __('Languages', 'sage'), 'edit_theme_options', 'mlang_strings', array(PLL(), 'languages_page'), 'dashicons-translation');
        add_menu_page(__('Strigs translations tab', 'sage'), __('Setup', 'sage'), 'edit_theme_options', 'mlang_import_export_strings', array(PLL(), 'languages_page'), 'dashicons-translation');
    }
});

if (!current_user_can('manage_options') && function_exists('PLL')) {
    /**
     * Init Polylang Theme Translation plugin.
     */
    add_action('init', 'process_polylang_theme_translation_injection');

    function process_polylang_theme_translation_injection()
    {
        if (Polylang_TT_access::get_instance()->is_polylang_page()) {
            if (Polylang_TT_access::get_instance()->chceck_plugin_access()) {
                $plugin_obj = new Polylang_Theme_Translation();
                $plugin_obj->run();
            }
        }

    }

    add_action('wp_loaded', 'process_polylang_theme_translation_wp_loaded_injection');
    function process_polylang_theme_translation_wp_loaded_injection()
    {
        if (isset($_POST) && isset($_POST['export_strings']) && (int) $_POST['export_strings'] === 1) {
            $translation = new Polylang_Theme_Translation();
            $exporter = new Polylang_TT_exporter($translation);
            $exporter->export();
        }

        if (isset($_POST["action_import_strings"])) {
            if (PLL() instanceof PLL_Settings) {
                $fileName = $_FILES["import_strings"]["tmp_name"];
                if ($_FILES["import_strings"]["size"] > 0 && $fileName) {
                    $importer = new Polylang_TT_importer();
                    $counter = $importer->import($fileName);

                    wp_redirect((add_query_arg(['_msg' => 'translations-imported', 'items' => $counter], wp_get_referer())));
                    exit;
                }
            }
            wp_redirect((add_query_arg('_msg', 'translations-import-error', wp_get_referer())));
            exit;
        }

        if (isset($_POST['action_settings'])) {
            $settings = [
                'themes' => [],
                'plugins' => [],
            ];
            $t = isset($_POST['themes']) ? $_POST['themes'] : [];
            foreach ($t as $item) {
                if (in_array($item, pll_get_themes())) {
                    $settings['themes'][] = $item;
                }
            }

            $t = isset($_POST['plugins']) ? $_POST['plugins'] : [];
            foreach ($t as $item) {
                if (in_array($item, pll_get_plugins())) {
                    $settings['plugins'][] = $item;
                }
            }

            update_option(Polylang_Theme_Translation::SETTINGS_OPTION, $settings);

            wp_redirect((add_query_arg(['_msg' => 'settings-saved'], wp_get_referer())));
            exit;
        }

    }

    
}