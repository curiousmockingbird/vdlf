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

class ReusablePopup extends Widget_Base
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
        return 'reusable-popup';
    }

    public function get_title()
    {
        return 'Reusable Popup';
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
    public function get_icon()
    {
        return 'eicon-image';
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
        return ['basic'];
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
            'setting_section',
            [
                'label' => __('Button Configuration', 'sage'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'label', [
                'label' => __('Label', 'sage'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Click here to open popup', 'sage'),
                'label_block' => true,
            ]
        );

        $this->add_control(
			'show_button',
			[
				'label' => esc_html__( 'Show Button', 'sage' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'sage' ),
				'label_off' => esc_html__( 'Hide', 'sage' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

        $this->add_control(
			'autoshow',
			[
				'label' => esc_html__( 'Show Popup Automatically', 'sage' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'sage' ),
				'label_off' => esc_html__( 'Hide', 'sage' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

        $this->end_controls_section();
       
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Reusable Popup', 'sage'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // $this->add_control(
        //     'background_color',
        //     [
        //         'label' => __('Background Color', 'sage'),
        //         'type' => \Elementor\Controls_Manager::TEXT,
        //         'default' => '#f0a341'
        //     ]
        // );

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
                'default' => __('Email your Representative to Win Citizenship for All', 'sage'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'btn_text', [
                'label' => __('Button Text', 'sage'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Email now', 'sage'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'btn_link',
            [
                'label' => __('Button Link', 'sage'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '#',
                'label_block' => true,
            ]
        );
        $this->add_control(
            'image_icon',
			[
				'label' => __( 'Choose Icon Image', 'sage' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				]
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
        $title = $settings["title"] ?? "";
        $id = uniqid();
        $btn_link = $settings["btn_link"] ?? "";
        $btn_text = $settings["btn_text"] ?? "";
        $image = $settings["image"] ?? "";
        $image_icon = $settings["image_icon"] ?? "";
        $label = $settings["label"] ?? "";
        $show_button = $settings["show_button"] == "yes" ? "true" : "false";
        $autoshow = $settings["autoshow"] == "yes" ? "true" : "false";
        // $background_color = $settings["background_color"] && $settings["background_color"] != '' ? $settings["background_color"] : 'linear-gradient(180deg, #f0a341 0%, #c22d28 100%)';

        if (\Elementor\Plugin::$instance->editor->is_edit_mode()) {
        ?>

		<div class="elementor-section-preview">

				<h1 ><?php echo $this->get_title() ?></h1>
				<label>This is just section placeholder.</label>

				<p class="mt-2">To view this section click on 'Preview Changes'</p>

		</div>
        <?php }?>
		<reusable-popup
            title="<?php echo $title; ?>"
            id="<?php echo $id; ?>"
            btn_link="<?php echo $btn_link; ?>"
            btn_text="<?php echo $btn_text; ?>"
            image_string="<?php echo htmlspecialchars(json_encode($image), ENT_QUOTES, 'UTF-8'); ?>"
            image_icon_string="<?php echo htmlspecialchars(json_encode($image_icon), ENT_QUOTES, 'UTF-8'); ?>"
            label="<?php echo $label; ?>"
            :show_button="<?php echo $show_button; ?>"
            :autoshow="<?php echo $autoshow; ?>"
        ></reusable-popup>
	<?php
    }
}