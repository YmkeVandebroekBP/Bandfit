<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
    // Exit if accessed directly
}

$fields = array( array(
    'key'           => 'redirect',
    'label'         => __( 'Redirect After Submit', ACFF_NS ),
    'type'          => 'select',
    'instructions'  => '',
    'required'      => 0,
    'wrapper'       => array(
    'width' => '',
    'class' => '',
    'id'    => '',
),
    'choices'       => array(
    'current'    => __( 'Reload Current Page', ACFF_NS ),
    'custom_url' => __( 'Custom URL', ACFF_NS ),
    'referer'    => __( 'Referer', ACFF_NS ),
    'post_url'   => __( 'Post URL', ACFF_NS ),
),
    'allow_null'    => 0,
    'multiple'      => 0,
    'ui'            => 0,
    'return_format' => 'value',
    'ajax'          => 0,
    'placeholder'   => '',
), array(
    'key'               => 'custom_url',
    'label'             => __( 'Custom Url', ACFF_NS ),
    'type'              => 'url',
    'instructions'      => '',
    'required'          => 0,
    'conditional_logic' => array( array( array(
    'field'    => 'redirect',
    'operator' => '==',
    'value'    => 'custom_url',
) ) ),
    'placeholder'       => '',
), array(
    'key'               => 'redirect_action',
    'label'             => __( 'After Reload', ACFF_NS ),
    'type'              => 'select',
    'instructions'      => '',
    'required'          => 0,
    'wrapper'           => array(
    'width' => '',
    'class' => '',
    'id'    => '',
),
    'choices'           => array(
    'clear' => __( 'Clear Form', ACFF_NS ),
    'edit'  => __( 'Edit Form', ACFF_NS ),
),
    'conditional_logic' => array( array( array(
    'field'    => 'redirect',
    'operator' => '==',
    'value'    => 'current',
) ) ),
    'allow_null'        => 0,
    'multiple'          => 0,
    'ui'                => 0,
    'return_format'     => 'value',
    'ajax'              => 0,
    'placeholder'       => '',
) );
$fields = array_merge( $fields, array( array(
    'key'               => 'show_update_message',
    'label'             => __( 'Success Message', ACFF_NS ),
    'type'              => 'true_false',
    'instructions'      => '',
    'required'          => 0,
    'conditional_logic' => 0,
    'message'           => '',
    'ui'                => 1,
    'ui_on_text'        => '',
    'ui_off_text'       => '',
), array(
    'key'               => 'update_message',
    'label'             => '',
    'field_label_hide'  => true,
    'type'              => 'textarea',
    'instructions'      => '',
    'required'          => 0,
    'conditional_logic' => array( array( array(
    'field'    => 'show_update_message',
    'operator' => '==',
    'value'    => '1',
) ) ),
    'placeholder'       => '',
    'maxlength'         => '',
    'rows'              => '2',
    'new_lines'         => '',
), array(
    'key'              => 'error_message',
    'label'            => '',
    'field_label_hide' => true,
    'type'             => 'textarea',
    'instructions'     => __( 'There shouldn\'t be any problems with the form submission, but if there are, this is what your users will see. If you are expeiencing issues, try and changing your cache settings and reach out to ', ACFF_NS ) . 'support@frontendform.com',
    'required'         => 0,
    'placeholder'      => __( 'There has been an error. Form has been submitted successfully, but some actions might not have been completed.', ACFF_NS ),
    'maxlength'        => '',
    'rows'             => '2',
    'new_lines'        => '',
) ) );
return $fields;