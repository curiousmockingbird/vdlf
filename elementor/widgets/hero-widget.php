<?php
namespace WPC\Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
if (!defined('ABSPATH')) {
    exit;
}
// Exit if accessed directly

class HeroWidget extends Widget_Base
{

    /**
     * Get widget name.
     *
     * Retrieve oEmbed widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'Hero Action';
    }

    public function get_title()
    {
        return 'Hero Action';
    }

    /**
     * Get widget icon.
     *
     * Retrieve oEmbed widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon(){
        return 'far fa-images';
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the oEmbed widget belongs to.
     *
     * @since 1.0.0
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories()
    {
        return ['general'];
    }

    /**
     * Register oEmbed widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls()
    {

        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'sage'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );


        $this->add_control(
			'image',
			[
				'label' => __( 'Choose Image', 'sage' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				]
			]
		);

        $this->add_control(
            'title', [
                'label' => __('Title', 'sage'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Custom title goes here', 'sage'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'button_text', [
                'label' => __('Button Text', 'sage'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Let\'s Go!', 'sage'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label' => __('Link to bio', 'sage'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __('https://your-link.com', 'sage'),
                'show_external' => true,
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );

        $this->add_control(
            'perpage',
            [
                'label' => __('Show Perpage', 'sage'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __('Item to shows', 'sage'),
                'default' => '3',
            ]
        );

        $this->add_control(
			'important_note',
			[
				'label' => __( 'Take Action', 'sage' ),
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'raw' => __( '<br><a  href="/wp-admin/edit.php?post_type=take_actions" target="_blank" class="elementor-button elementor-button-default  elementor-go-pro elementor-control-type-tab">Add, edit or remove content in this section</a>', 'sage' ),
				'content_classes' => 'your-class',
			]
		);

		$this->end_controls_section();

    }

    /**
     * Render oEmbed widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $props = [
			"title"       => $settings["title"] ?? "Email your Representative to Win Citizenship for All",
			"button_text" => $settings["button_text"] ?? "Let's Go!",
            "button_link" => $settings["button_link"] ?? "#",
			"perpage"     => $settings["perpage"] ?? 3
		];
        
        $jsonContent = htmlspecialchars(json_encode($props), ENT_QUOTES, 'UTF-8');

        
        if (\Elementor\Plugin::$instance->editor->is_edit_mode()) {
        ?>

		<div class="elementor-section-preview">

				<h1 ><?php echo $this->get_title() ?></h1>
				<label>This is just section placeholder.</label>

				<p class="mt-2">To view this section click on 'Preview Changes'</p>

		</div>
        <?php } ?>		
		<hero json-content='<?php echo $jsonContent; ?>'></hero>
	<?php  
    }

}
