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

class HeroImage extends Widget_Base
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
        return 'Hero Image';
    }

    public function get_title()
    {
        return 'Hero Image';
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
    private function ActionName()
    {
        $args = [
            'hide_empty' => true,
            'orderby' => 'count',
        ];
        $categories = get_terms('action_name', $args);
        $options = array('none' => __('None', 'sage'));
        foreach ($categories as $cat) {
            $options[$cat->slug] = $cat->name;
        }
        return $options;
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Hero Content', 'sage'),
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
            'images',
            [
                'label' => __('Choose Image', 'sage'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
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
            'button_icon',
            [
                'label' => __('Icon', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'phone' => __('Phone', 'sage'),
                    'email' => __('Email', 'sage'),
                    'postcard' => __('Postcard', 'sage'),
                    'none' => __('None', 'sage'),
                ],
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
        $title = $settings["title"] ?? "Email your Representative to Win Citizenship for All";
        $button_text = $settings["button_text"] ?? "Let's Go!";
        $button_icon = $settings["button_icon"] && $settings["button_icon"] !="none" ? $settings["button_icon"] : "email";
        $button_link = $settings["button_link"] ? $settings["button_link"]["url"] : "#";
        $images = $settings["images"] ? $settings["images"]["url"] : null;
        $background = $settings["background"] ?? "transparent";

        if (\Elementor\Plugin::$instance->editor->is_edit_mode()) {
            ?>

		<div class="elementor-section-preview">

				<h1 ><?php echo $this->get_title() ?></h1>
				<label>This is just section placeholder.</label>

				<p class="mt-2">To view this section click on 'Preview Changes'</p>

		</div>
        <?php }?>
		<hero-action 
            background="<?php echo $background;?>"
            title="<?php echo $title; ?>"
            link="<?php echo $button_link; ?>"
            button_icon="<?php echo $button_icon; ?>"
            button_text="<?php echo $button_text; ?>"
            images="<?php echo $images; ?>">
        </hero-action>
	<?php
}

}