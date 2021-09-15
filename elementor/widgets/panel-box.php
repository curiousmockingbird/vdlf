<?php

namespace WPC\Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;
}
// Exit if accessed directly

class PanelBox extends Widget_Base
{

    public function __construct($data = [], $args = null)
    {
        parent::__construct($data, $args);
    }

    public function get_name()
    {
        return 'Panel Box';
    }

    public function get_title()
    {
        return 'Panel Box';
    }

    public function get_icon()
    {
        return 'eicon-gallery-grid';
    }

    public function get_categories()
    {
        return ['basic'];
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'panel_settings',
            [
                'label' => __('Settings', 'sage'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'column',
            [
                'label' => __('Column to show (mobile)', 'sage'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'placeholder' => __('Enter Number', 'sage'),
                'default' => '1',
            ]
        );

        $this->add_control(
            'md_column',
            [
                'label' => __('Column to show (Ipad)', 'sage'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'placeholder' => __('Enter Number', 'sage'),
                'default' => '2',
            ]
        );

        $this->add_control(
            'lg_column',
            [
                'label' => __('Column to show (Dekstop)', 'sage'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'placeholder' => __('Enter Number', 'sage'),
                'default' => '3',
            ]
        );

        $this->add_control(
            'title', [
                'label' => __('Section Title', 'sage'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Services', 'sage'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'button_text', [
                'label' => __('Button Text', 'sage'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('See all', 'sage'),
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'panel_body',
            [
                'label' => __('Content', 'sage'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'panel_title', [
                'label' => __('Title', 'sage'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Panel Title', 'sage'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'panel_link',
            [
                'label' => __('Link', 'sage'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '#',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'panel_content',
            [
                'label' => __('Content', 'sage'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 5,
				'default' => __( 'Default description', 'sage' ),
				'placeholder' => __( 'Type your description here', 'sage' ),
            ]
        );

        $repeater->add_control(
            'panel_background',
            [
                'label' => __('Background Color', 'sage'),
                'type' => \Elementor\Controls_Manager::COLOR,
            ]
        );

        $repeater->add_control(
            'panel_color',
            [
                'label' => __('Color', 'sage'),
                'type' => \Elementor\Controls_Manager::COLOR,
            ]
        );

        $this->add_control(
            'panel_list',
            [
                'label' => __('Panel Box', 'sage'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'panel_title'      => __('Title #1', 'sage'),
                        'panel_link'       => __('#', 'sage'),
                        'panel_content'    => __('Content goes here', 'sage'),
                        'panel_color'      => __('#FFFFFF', 'sage'),
                        'panel_background' => __('#000000', 'sage'),
                    ],
                ],
                'title_field' => '{{{ panel_title }}}',
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $jsonContent = htmlspecialchars(json_encode($settings['panel_list']), ENT_QUOTES, 'UTF-8');
        $options = [
            "column"      => $settings["column"] ?? "3",
            "md_column"   => $settings["md_column"] ?? "3",
            "lg_column"   => $settings["lg_column"] ?? "3",
            "title"       => $settings["title"] ?? "Email your Representative to Win Citizenship for All",
            "button_text" => $settings["button_text"] ?? "Let's Go!",
        ];

        $jsonOptions = htmlspecialchars(json_encode($options), ENT_QUOTES, 'UTF-8');

        if ($settings['panel_list']) {
            if (\Elementor\Plugin::$instance->editor->is_edit_mode()) {
            ?>
            <div class="elementor-section-preview">

                    <h1 ><?php echo $this->get_title() ?></h1>
                    <label>This is just section placeholder.</label>

                    <p class="mt-2">To view this section click on 'Preview Changes'</p>

            </div>
		<?php }?>
		<services json-options='<?php echo $jsonOptions; ?>' json-content='<?php echo $jsonContent; ?>'></services>

	<?php
}
    }
}