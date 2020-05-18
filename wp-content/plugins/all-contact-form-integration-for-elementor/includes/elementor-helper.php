<?php
namespace Elementor;

//contact-form-7
function acfe_contact_form_7_init(){
    Plugin::instance()->elements_manager->add_category(
        'all-elementor-forms',
        [
            'title'  => 'The INNOVS Forms',
            'icon' => 'font'
        ],
        1
    );
}
add_action( 'elementor/init','Elementor\acfe_contact_form_7_init' );

// gravity-forms
function acfe_gravity_form_init(){
    Plugin::instance()->elements_manager->add_category(
        'all-elementor-forms',
        [
            'title'  => 'Elementor Gravity Form',
            'icon' => 'font'
        ],
        1
    );
}
add_action( 'elementor/init','Elementor\acfe_gravity_form_init' );

//ninja-forms
function Acfe_Ninja_Forms_Style_init() {
    Plugin::instance()->elements_manager->add_category(
        'all-elementor-forms',
        [
            'title'  => 'IE Ninja Forms',
            'icon' => 'font'
        ],
        1
    );
}
add_action( 'elementor/init','Elementor\Acfe_Ninja_Forms_Style_init' );

