<?php
class Elementor_Hero extends \Elementor\Widget_Base {

	public function get_name() {
		return 'hero';
	}

	public function get_title() {
		return esc_html__( 'Hero', 'elementor-addon' );
	}

	public function get_icon() {
		return 'eicon-code';
	}

	public function get_categories() {
		return [ 'basic', 'layout' ];
	}

	public function get_keywords() {
		return [ 'hero', 'productive' ];
	}

	protected function register_controls() {

		// Content Tab Start

		$this->start_controls_section(
			'section_text',
			[
				'label' => esc_html__( 'Text', 'elementor-addon' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'heading',
			[
				'label' => esc_html__( 'Heading', 'elementor-addon' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'elementor-addon' ),
			]
		);

		$this->add_control(
			'description',
			[
				'label' => esc_html__( 'Description', 'elementor-addon' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'elementor-addon' ),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_button',
			[
				'label' => esc_html__( 'Button', 'elementor-addon' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'button',
			[
				'label' => esc_html__( 'Text', 'elementor-addon' ),
				'type' => \Elementor\Controls_Manager::BUTTON,
				'text' => esc_html__( 'Click Me', 'elementor-addon' ),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_image',
			[
				'label' => esc_html__( 'Image', 'elementor-addon' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'image',
			[
				'label' => esc_html__( 'Choose Image', 'elementor-addon' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->end_controls_section();

		// Content Tab End


		// Style Tab Start

		$this->start_controls_section(
			'section_text_style',
			[
				'label' => esc_html__( 'Text', 'elementor-addon' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'heading_color',
			[
				'label' => esc_html__( 'Text Color', 'elementor-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hero-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'selector' => '{{WRAPPER}} .hero-title',
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' => esc_html__( 'Text Color', 'elementor-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hero-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'selector' => '{{WRAPPER}} .hero-text',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_button_style',
			[
				'label' => esc_html__( 'Button', 'elementor-addon' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'selector' => '{{WRAPPER}} .hero-button',
			]
		);

		$this->end_controls_section();


		// Style Tab End

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		// heading
		if ( empty( $settings['heading'] ) ) {
			return;
		}
		?>
		<h1 class="hero-title">
			<?php echo $settings['heading']; ?>
		</h1>
		<?php

		// description
		if ( empty( $settings['description'] ) ) {
			return;
		}
		?>
		<p class="hero-text">
			<?php echo $settings['description']; ?>
		</p>
		<?php

		// button
		if ( empty( $settings['button'] ) ) {
			return;
		}
		?>
		<button class="hero-button">
			<?php echo $settings['button']; ?>
		</button>
		<?php
		
		// image
		if ( empty( $settings['image']['url'] ) ) {
			return;
		}

		echo '<img src="' . $settings['image']['url'] . '">';

		echo wp_get_attachment_image( $settings['image']['id'], 'thumbnail' );

		$this->add_render_attribute( 'image', 'src', $settings['image']['url'] );
		$this->add_render_attribute( 'image', 'alt', \Elementor\Control_Media::get_image_alt( $settings['image'] ) );
		$this->add_render_attribute( 'image', 'title', \Elementor\Control_Media::get_image_title( $settings['image'] ) );
		$this->add_render_attribute( 'image', 'class', 'my-custom-class' );
		echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' );
	}

	protected function content_template() {
		?>
		<#
		if ( '' === settings.heading ) {
			return;
		}
		#>
		<h1 class="hero-title">
			{{ settings.heading }}
		</h1>
		<?php

		?>
		<#
		if ( '' === settings.description ) {
			return;
		}
		#>
		<p class="hero-text">
			{{ settings.description }}
		</p>
		<?php

		?>
		<#
		if ( '' === settings.button ) {
			return;
		}
		#>
		<button class="hero-button">
			{{ settings.button }}
		</button>
		<?php

		?>
		<#
		if ( '' === settings.image.url ) {
			return;
		}

		const image = {
			id: settings.image.id,
			url: settings.image.url,
			size: settings.image_size,
			dimension: settings.image_custom_dimension,
			model: view.getEditModel()
		};

		const image_url = elementor.imagesManager.getImageUrl( image );

		if ( '' === image_url ) {
			return;
		}
		#>
		<img src="{{ image_url }}">
		<?php
	}
}
