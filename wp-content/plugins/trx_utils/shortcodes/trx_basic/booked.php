<?php


if (function_exists('diveit_exists_visual_composer') && diveit_exists_visual_composer())
    add_action('diveit_action_shortcodes_list',				'diveit_booked_reg_shortcodes');
    add_action('diveit_action_shortcodes_list_vc',		'diveit_booked_reg_shortcodes_vc');



// Register plugin's shortcodes
//------------------------------------------------------------------------

// Register shortcode in the shortcodes list
if (!function_exists('diveit_booked_reg_shortcodes')) {
    function diveit_booked_reg_shortcodes() {
        if (diveit_storage_isset('shortcodes')) {

            $booked_cals = diveit_get_list_booked_calendars();

            diveit_sc_map('booked-appointments', array(
                    "title" => esc_html__("Booked Appointments", "diveit"),
                    "desc" => esc_html__("Display the currently logged in user's upcoming appointments", "diveit"),
                    "decorate" => true,
                    "container" => false,
                    "params" => array()
                )
            );

            diveit_sc_map('booked-calendar', array(
                "title" => esc_html__("Booked Calendar", "diveit"),
                "desc" => esc_html__("Insert booked calendar", "diveit"),
                "decorate" => true,
                "container" => false,
                "params" => array(
                    "calendar" => array(
                        "title" => esc_html__("Calendar", "diveit"),
                        "desc" => esc_html__("Select booked calendar to display", "diveit"),
                        "value" => "0",
                        "type" => "select",
                        "options" => diveit_array_merge(array(0 => esc_html__('- Select calendar -', 'trx_utils')), $booked_cals)
                    ),
                    "year" => array(
                        "title" => esc_html__("Year", "diveit"),
                        "desc" => esc_html__("Year to display on calendar by default", "diveit"),
                        "value" => date("Y"),
                        "min" => date("Y"),
                        "max" => date("Y")+10,
                        "type" => "spinner"
                    ),
                    "month" => array(
                        "title" => esc_html__("Month", "diveit"),
                        "desc" => esc_html__("Month to display on calendar by default", "diveit"),
                        "value" => date("m"),
                        "min" => 1,
                        "max" => 12,
                        "type" => "spinner"
                    )
                )
            ));
        }
    }
}


// Register shortcode in the VC shortcodes list
if (!function_exists('diveit_booked_reg_shortcodes_vc')) {
    function diveit_booked_reg_shortcodes_vc() {

        $booked_cals = diveit_get_list_booked_calendars();

        // Booked Appointments
        vc_map( array(
            "base" => "booked-appointments",
            "name" => esc_html__("Booked Appointments", "diveit"),
            "description" => esc_html__("Display the currently logged in user's upcoming appointments", "diveit"),
            "category" => esc_html__('Content', 'trx_utils'),
            'icon' => 'icon_trx_booked',
            "class" => "trx_sc_single trx_sc_booked_appointments",
            "content_element" => true,
            "is_container" => false,
            "show_settings_on_create" => false,
            "params" => array()
        ) );

        class WPBakeryShortCode_Booked_Appointments extends Diveit_VC_ShortCodeSingle {}

        // Booked Calendar
        vc_map( array(
            "base" => "booked-calendar",
            "name" => esc_html__("Booked Calendar", "diveit"),
            "description" => esc_html__("Insert booked calendar", "diveit"),
            "category" => esc_html__('Content', 'trx_utils'),
            'icon' => 'icon_trx_booked',
            "class" => "trx_sc_single trx_sc_booked_calendar",
            "content_element" => true,
            "is_container" => false,
            "show_settings_on_create" => true,
            "params" => array(
                array(
                    "param_name" => "calendar",
                    "heading" => esc_html__("Calendar", "diveit"),
                    "description" => esc_html__("Select booked calendar to display", "diveit"),
                    "admin_label" => true,
                    "class" => "",
                    "std" => "0",
                    "value" => array_flip(diveit_array_merge(array(0 => esc_html__('- Select calendar -', 'trx_utils')), $booked_cals)),
                    "type" => "dropdown"
                ),
                array(
                    "param_name" => "year",
                    "heading" => esc_html__("Year", "diveit"),
                    "description" => esc_html__("Year to display on calendar by default", "diveit"),
                    "admin_label" => true,
                    "class" => "",
                    "std" => date("Y"),
                    "value" => date("Y"),
                    "type" => "textfield"
                ),
                array(
                    "param_name" => "month",
                    "heading" => esc_html__("Month", "diveit"),
                    "description" => esc_html__("Month to display on calendar by default", "diveit"),
                    "admin_label" => true,
                    "class" => "",
                    "std" => date("m"),
                    "value" => date("m"),
                    "type" => "textfield"
                )
            )
        ) );

        class WPBakeryShortCode_Booked_Calendar extends Diveit_VC_ShortCodeSingle {}

    }
}