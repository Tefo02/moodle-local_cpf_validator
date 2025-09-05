<?php
// This file is part of Moodle - https://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * Plugin administration pages are defined here.
 *
 * @package     local_cpf_validator
 * @category    admin
 * @copyright   2025 Stefano Lopes Delgado <stefanolopes84@gmail.com>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

// This line ensures that this page is only accessible to users who can manage site settings.
if ($hassiteconfig) {
    // Create the main settings page object.
    // 'local_cpf_validator' is the component name.
    // get_string('pluginname', 'local_cpf_validator') sets the title of the page.
    $settings = new admin_settingpage(
        'local_cpf_validator',
        get_string('pluginname',
        'local_cpf_validator'));

    // Create the setting itself - a dropdown menu (configselect).
    $setting = new admin_setting_configselect(
        'local_cpf_validator/format_rules',                             // The unique name of the setting
        get_string('format_rules', 'local_cpf_validator'),              // The label for the setting
        get_string('format_rules_desc', 'local_cpf_validator'),         // The description/help text
        'numeric_with_special_chars_and_clean',                         // The default value
        [                                                               // The options for the dropdown
            'numeric_with_special_chars_and_clean' => get_string('numeric_with_special_chars_and_clean', 'local_cpf_validator'),
            'numeric_with_special_chars' => get_string('numeric_with_special_chars', 'local_cpf_validator'),
            'numeric_only' => get_string('numeric_only', 'local_cpf_validator'),
        ]
    );

    // Add the setting to our page.
    $settings->add($setting);

    // Add the page to the 'localplugins' category in the admin menu.
    $ADMIN->add('localplugins', $settings);
}