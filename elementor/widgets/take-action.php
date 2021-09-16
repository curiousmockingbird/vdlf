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

class TakeActionWidget extends Widget_Base
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
        return 'Take Action';
    }

    public function get_title()
    {
        return 'Take Action';
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
        return 'eicon-post-list';
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
    private function ActionName() {
        $args = [
            'hide_empty' => true,
            'orderby'    => 'count',
        ];
        $categories = get_terms('action_name', $args);
        $options= array('none' => __( 'None', 'plugin-domain' ));
        foreach ($categories as $cat) {
            $options[$cat->slug] = $cat->name;
        }
        return $options;
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'action_section',
            [
                'label' => __('Take Action', 'sage'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'background',
            [
                'label' => __('Background Color', 'sage'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#F0A341',
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

        $this->add_control(
            'take_action_title', [
                'label' => __('Title', 'sage'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Take Action', 'sage'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'take_action_tax', [
                'label' => __( 'Action Name', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'none',
				'options' => $this->ActionName()
            ]
        );

        // $this->add_control(
        //     'take_action_label', [
        //         'label' => __('Label', 'sage'),
        //         'type' => \Elementor\Controls_Manager::TEXT,
        //         'default' => __('Action', 'sage'),
        //         'label_block' => true,
        //     ]
        // );

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
        $perpage           = $settings["perpage"] ?? 3;
        $take_action_title = $settings["take_action_title"] ?? "Take Action";
        #$take_action_label = $settings["take_action_label"] ?? "Action";
        $take_action_tax   = $settings["take_action_tax"] ?? "None";
        $background        = $settings["background"] ?? "transparent";

        if (\Elementor\Plugin::$instance->editor->is_edit_mode()) {
        ?>

		<div class="elementor-section-preview">

				<h1 ><?php echo $this->get_title() ?></h1>
				<label>This is just section placeholder.</label>

				<p class="mt-2">To view this section click on 'Preview Changes'</p>

		</div>
        <?php } ?>		
		<take-action
            background="<?php echo $background;?>"
            actions-name="<?php echo $take_action_tax; ?>"
            title="<?php echo $take_action_title; ?>"
            perpage="<?php echo (int)($perpage); ?>"
        ></take-action>
	<?php  
    }

}
