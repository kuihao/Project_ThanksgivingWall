<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Abort, if called directly.


class Widget_Acfe_Gravity_Form extends Widget_Base {

	public function get_name() {
		return 'acfe-gravity';
	}

	public function get_title() {
		return esc_html__( 'IE Gravity Form', 'all-elementor-forms' );
	}

	public function get_icon() {
		return 'fa fa-envelope-o';
	}

   public function get_categories() {
		return [ 'all-elementor-forms' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
  			'acfe_section_gravity_form',
  			[
  				'label' => esc_html__( 'IE Gravity Form', 'all-elementor-forms' )
  			]
  		);

		$this->add_control(
			'acfe_gravity_form',
			[
				'label' => esc_html__( 'Select gravity form', 'all-elementor-forms' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'options' => eaiocf_select_gravity_form(),
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'acfe_section_gravity_styles',
			[
				'label' => esc_html__( 'Form Container Styles', 'all-elementor-forms' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'acfe_gravity_background',
			[
				'label' => esc_html__( 'Form Background Color', 'all-elementor-forms' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .acfe-gravity-container' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'acfe_gravity_alignment',
			[
				'label' => esc_html__( 'Form Alignment', 'all-elementor-forms' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => true,
				'options' => [
					'default' => [
						'title' => __( 'Default', 'all-elementor-forms' ),
						'icon' => 'fa fa-ban',
					],
					'left' => [
						'title' => esc_html__( 'Left', 'all-elementor-forms' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'all-elementor-forms' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'all-elementor-forms' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'default',
				'prefix_class' => 'acfe-gravity-form-align-',
			]
		);

		$this->add_responsive_control(
  			'acfe_gravity_width',
  			[
  				'label' => esc_html__( 'Form Width', 'all-elementor-forms' ),
  				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 1500,
					],
					'em' => [
						'min' => 1,
						'max' => 80,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .acfe-gravity-container' => 'width: {{SIZE}}{{UNIT}};',
				],
  			]
  		);

  		$this->add_responsive_control(
  			'acfe_gravity_max_width',
  			[
  				'label' => esc_html__( 'Form Max Width', 'all-elementor-forms' ),
  				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 1500,
					],
					'em' => [
						'min' => 1,
						'max' => 80,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .acfe-gravity-container' => 'max-width: {{SIZE}}{{UNIT}};',
				],
  			]
  		);

		$this->add_responsive_control(
			'acfe_gravity_margin',
			[
				'label' => esc_html__( 'Form Margin', 'all-elementor-forms' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .acfe-gravity-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'acfe_gravity_padding',
			[
				'label' => esc_html__( 'Form Padding', 'all-elementor-forms' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .acfe-gravity-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'acfe_gravity_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'all-elementor-forms' ),
				'type' => Controls_Manager::DIMENSIONS,
				'separator' => 'before',
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .acfe-gravity-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'acfe_gravity_border',
				'selector' => '{{WRAPPER}} .acfe-gravity-container',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'acfe_gravity_box_shadow',
				'selector' => '{{WRAPPER}} .acfe-gravity-container',
			]
		);

		$this->end_controls_section();

		/**
		 * Form Fields Styles
		 */
		$this->start_controls_section(
			'acfe_section_gravity_field_styles',
			[
				'label' => esc_html__( 'Form Fields Styles', 'all-elementor-forms' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'acfe_gravity_input_background',
			[
				'label' => esc_html__( 'Input Field Background', 'all-elementor-forms' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .acfe-gravity-container .gfield input[type="text"],
					 {{WRAPPER}} .acfe-gravity-container .gfield input[type="password"],
					 {{WRAPPER}} .acfe-gravity-container .gfield input[type="email"],
					 {{WRAPPER}} .acfe-gravity-container .gfield input[type="url"],
					 {{WRAPPER}} .acfe-gravity-container .gfield input[type="number"],
					 {{WRAPPER}} .acfe-gravity-container .gfield select,
					 {{WRAPPER}} .acfe-gravity-container .gfield textarea' => 'background-color: {{VALUE}};',
				],
			]
		);


  		$this->add_responsive_control(
  			'acfe_gravity_input_width',
  			[
  				'label' => esc_html__( 'Input Width', 'all-elementor-forms' ),
  				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 1500,
					],
					'em' => [
						'min' => 1,
						'max' => 80,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .acfe-gravity-container .gfield input[type="text"],
					 {{WRAPPER}} .acfe-gravity-container .gfield input[type="password"],
					 {{WRAPPER}} .acfe-gravity-container .gfield input[type="email"],
					 {{WRAPPER}} .acfe-gravity-container .gfield input[type="url"],
					 {{WRAPPER}} .acfe-gravity-container .gfield select,
					 {{WRAPPER}} .acfe-gravity-container .gfield input[type="number"]' => 'width: {{SIZE}}{{UNIT}};',
				],
  			]
  		);

  		$this->add_responsive_control(
  			'acfe_gravity_textarea_width',
  			[
  				'label' => esc_html__( 'Textarea Width', 'all-elementor-forms' ),
  				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 1500,
					],
					'em' => [
						'min' => 1,
						'max' => 80,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .acfe-gravity-container .gfield textarea' => 'width: {{SIZE}}{{UNIT}};',
				],
  			]
  		);

		$this->add_responsive_control(
			'acfe_gravity_input_padding',
			[
				'label' => esc_html__( 'Fields Padding', 'all-elementor-forms' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .acfe-gravity-container .gfield input[type="text"],
					 {{WRAPPER}} .acfe-gravity-container .gfield input[type="password"],
					 {{WRAPPER}} .acfe-gravity-container .gfield input[type="email"],
					 {{WRAPPER}} .acfe-gravity-container .gfield input[type="url"],
					 {{WRAPPER}} .acfe-gravity-container .gfield select,
					 {{WRAPPER}} .acfe-gravity-container .gfield input[type="number"],
					 {{WRAPPER}} .acfe-gravity-container .gfield textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);



		$this->add_control(
			'acfe_gravity_input_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'all-elementor-forms' ),
				'type' => Controls_Manager::DIMENSIONS,
				'separator' => 'before',
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .acfe-gravity-container .gfield input[type="text"],
					 {{WRAPPER}} .acfe-gravity-container .gfield input[type="password"],
					 {{WRAPPER}} .acfe-gravity-container .gfield input[type="email"],
					 {{WRAPPER}} .acfe-gravity-container .gfield input[type="url"],
					 {{WRAPPER}} .acfe-gravity-container .gfield select,
					 {{WRAPPER}} .acfe-gravity-container .gfield input[type="number"],
					 {{WRAPPER}} .acfe-gravity-container .gfield textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'acfe_gravity_input_border',
				'selector' => '
					 {{WRAPPER}} .acfe-gravity-container .gfield input[type="text"],
					 {{WRAPPER}} .acfe-gravity-container .gfield input[type="password"],
					 {{WRAPPER}} .acfe-gravity-container .gfield input[type="email"],
					 {{WRAPPER}} .acfe-gravity-container .gfield input[type="url"],
					 {{WRAPPER}} .acfe-gravity-container .gfield select,
					 {{WRAPPER}} .acfe-gravity-container .gfield input[type="number"],
					 {{WRAPPER}} .acfe-gravity-container .gfield textarea',
			]
		);


		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'acfe_gravity_input_box_shadow',
				'selector' => '
					 {{WRAPPER}} .acfe-gravity-container .gfield input[type="text"],
					 {{WRAPPER}} .acfe-gravity-container .gfield input[type="password"],
					 {{WRAPPER}} .acfe-gravity-container .gfield input[type="email"],
					 {{WRAPPER}} .acfe-gravity-container .gfield input[type="url"],
					 {{WRAPPER}} .acfe-gravity-container .gfield select,
					 {{WRAPPER}} .acfe-gravity-container .gfield input[type="number"],
					 {{WRAPPER}} .acfe-gravity-container .gfield textarea',
			]
		);

		$this->add_control(
			'acfe_gravity_focus_heading',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__( 'Focus State Style', 'all-elementor-forms' ),
				'separator' => 'before',
			]
		);


		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'acfe_gravity_input_focus_box_shadow',
				'selector' => '
					 {{WRAPPER}} .acfe-gravity-container .gfield input[type="text"]:focus,
					 {{WRAPPER}} .acfe-gravity-container .gfield input[type="password"]:focus,
					 {{WRAPPER}} .acfe-gravity-container .gfield input[type="email"]:focus,
					 {{WRAPPER}} .acfe-gravity-container .gfield input[type="url"]:focus,
					 {{WRAPPER}} .acfe-gravity-container .gfield select:focus,
					 {{WRAPPER}} .acfe-gravity-container .gfield input[type="number"]:focus,
					 {{WRAPPER}} .acfe-gravity-container .gfield textarea:focus',
			]
		);

		$this->add_control(
			'acfe_gravity_input_focus_border',
			[
				'label' => esc_html__( 'Border Color', 'all-elementor-forms' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .acfe-gravity-container .gfield input[type="text"]:focus,
					 {{WRAPPER}} .acfe-gravity-container .gfield input[type="password"]:focus,
					 {{WRAPPER}} .acfe-gravity-container .gfield input[type="email"]:focus,
					 {{WRAPPER}} .acfe-gravity-container .gfield input[type="url"]:focus,
					 {{WRAPPER}} .acfe-gravity-container .gfield select:focus,
					 {{WRAPPER}} .acfe-gravity-container .gfield input[type="number"]:focus,
					 {{WRAPPER}} .acfe-gravity-container .gfield textarea:focus' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		/**
		 * Typography
		 */
		$this->start_controls_section(
			'acfe_section_gravity_typography',
			[
				'label' => esc_html__( 'Color & Typography', 'all-elementor-forms' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);


		$this->add_control(
			'acfe_gravity_label_color',
			[
				'label' => esc_html__( 'Label Color', 'all-elementor-forms' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .acfe-gravity-container, {{WRAPPER}} .acfe-gravity-container .nf-field-label label' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'acfe_gravity_field_color',
			[
				'label' => esc_html__( 'Field Font Color', 'all-elementor-forms' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .acfe-gravity-container .gfield input[type="text"],
					 {{WRAPPER}} .acfe-gravity-container .gfield input[type="password"],
					 {{WRAPPER}} .acfe-gravity-container .gfield input[type="email"],
					 {{WRAPPER}} .acfe-gravity-container .gfield input[type="url"],
					 {{WRAPPER}} .acfe-gravity-container .gfield select,
					 {{WRAPPER}} .acfe-gravity-container .gfield input[type="number"],
					 {{WRAPPER}} .acfe-gravity-container .gfield textarea' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'acfe_gravity_placeholder_color',
			[
				'label' => esc_html__( 'Placeholder Font Color', 'all-elementor-forms' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .acfe-gravity-container ::-webkit-input-placeholder' => 'color: {{VALUE}};',
					'{{WRAPPER}} .acfe-gravity-container ::-moz-placeholder' => 'color: {{VALUE}};',
					'{{WRAPPER}} .acfe-gravity-container ::-ms-input-placeholder' => 'color: {{VALUE}};',
				],
			]
		);


		$this->add_control(
			'acfe_gravity_label_heading',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__( 'Label Typography', 'all-elementor-forms' ),
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'acfe_gravity_label_typography',
				'selector' => '{{WRAPPER}} .acfe-gravity-container, {{WRAPPER}} .acfe-gravity-container .wpuf-label label',
			]
		);


		$this->add_control(
			'acfe_gravity_heading_input_field',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__( 'Input Fields Typography', 'all-elementor-forms' ),
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'acfe_gravity_input_field_typography',
				'selector' => '{{WRAPPER}} .acfe-gravity-container .gfield input[type="text"],
					 {{WRAPPER}} .acfe-gravity-container .gfield input[type="password"],
					 {{WRAPPER}} .acfe-gravity-container .gfield input[type="email"],
					 {{WRAPPER}} .acfe-gravity-container .gfield input[type="url"],
					 {{WRAPPER}} .acfe-gravity-container .gfield select,
					 {{WRAPPER}} .acfe-gravity-container .gfield input[type="number"],
					 {{WRAPPER}} .acfe-gravity-container .gfield textarea',
			]
		);

		$this->end_controls_section();

		/**
		 * Button Style
		 */
		$this->start_controls_section(
			'acfe_section_gravity_submit_button_styles',
			[
				'label' => esc_html__( 'Submit Button Styles', 'all-elementor-forms' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

  		$this->add_responsive_control(
  			'acfe_gravity_submit_btn_width',
  			[
  				'label' => esc_html__( 'Button Width', 'all-elementor-forms' ),
  				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 1500,
					],
					'em' => [
						'min' => 1,
						'max' => 80,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .acfe-gravity-container .gform_button' => 'width: {{SIZE}}{{UNIT}};',
				],
  			]
  		);

		$this->add_responsive_control(
			'acfe_gravity_submit_btn_alignment',
			[
				'label' => esc_html__( 'Button Alignment', 'all-elementor-forms' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => true,
				'options' => [
					'default' => [
						'title' => __( 'Default', 'all-elementor-forms' ),
						'icon' => 'fa fa-ban',
					],
					'left' => [
						'title' => esc_html__( 'Left', 'all-elementor-forms' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'all-elementor-forms' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'all-elementor-forms' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'default',
				'prefix_class' => 'acfe-gravity-form-btn-align-',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'acfe_gravity_submit_btn_typography',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .acfe-gravity-container .gform_button',
			]
		);

		$this->add_responsive_control(
			'acfe_gravity_submit_btn_margin',
			[
				'label' => esc_html__( 'Margin', 'all-elementor-forms' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .acfe-gravity-container .gform_button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'acfe_gravity_submit_btn_padding',
			[
				'label' => esc_html__( 'Padding', 'all-elementor-forms' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .acfe-gravity-container .gform_button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'acfe_gravity_submit_button_tabs' );

		$this->start_controls_tab( 'normal', [ 'label' => esc_html__( 'Normal', 'all-elementor-forms' ) ] );

		$this->add_control(
			'acfe_gravity_submit_btn_text_color',
			[
				'label' => esc_html__( 'Text Color', 'all-elementor-forms' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .acfe-gravity-container .gform_button' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'acfe_gravity_submit_btn_background_color',
			[
				'label' => esc_html__( 'Background Color', 'all-elementor-forms' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .acfe-gravity-container .gform_button' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'acfe_gravity_submit_btn_border',
				'selector' => '{{WRAPPER}} .acfe-gravity-container .gform_button',
			]
		);

		$this->add_control(
			'acfe_gravity_submit_btn_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'all-elementor-forms' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .acfe-gravity-container .gform_button' => 'border-radius: {{SIZE}}px;',
				],
			]
		);



		$this->end_controls_tab();

		$this->start_controls_tab( 'acfe_gravity_submit_btn_hover', [ 'label' => esc_html__( 'Hover', 'all-elementor-forms' ) ] );

		$this->add_control(
			'acfe_gravity_submit_btn_hover_text_color',
			[
				'label' => esc_html__( 'Text Color', 'all-elementor-forms' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .acfe-gravity-container .gform_button:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'acfe_gravity_submit_btn_hover_background_color',
			[
				'label' => esc_html__( 'Background Color', 'all-elementor-forms' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .acfe-gravity-container .gform_button:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'acfe_gravity_submit_btn_hover_border_color',
			[
				'label' => esc_html__( 'Border Color', 'all-elementor-forms' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .acfe-gravity-container .gform_button:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();


		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'acfe_gravity_submit_btn_box_shadow',
				'selector' => '{{WRAPPER}} .acfe-gravity-container .gform_button',
			]
		);


		$this->end_controls_section();

	}


	protected function render( ) {

      $settings = $this->get_settings();


	?>


	<?php if ( ! empty( $settings['acfe_gravity_form'] ) ) : ?>
		<div class="acfe-gravity-container">
			<?php echo do_shortcode( '[gravityform id="'.$settings['acfe_gravity_form'].'" title="true" description="true"]' ); ?>
		</div>
	<?php endif; ?>

	<?php

	}

	protected function content_template() {''

		?>


		<?php
	}
}


Plugin::instance()->widgets_manager->register_widget_type( new Widget_Acfe_Gravity_Form() );