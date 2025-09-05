<?php
// This file is part of Moodle - http://moodle.org/
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
 * Settings for the CPF Validator plugin.
 *
 * @package    local_cpf_validator
 * @copyright  2025 Stefano Lopes Delgado <stefanolopes84@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

// This line ensures that this code only runs for users who have permission to configure the site.
if ($hassiteconfig) {
    // Creates a new settings page and adds it to the "Local plugins" category.
    $settings = new admin_settingpage(
        'local_cpf_validator_settings',
        get_string('pluginname', 'local_cpf_validator')
    );

    // Creates the dropdown menu setting for the CPF format rules.
    $setting = new admin_setting_configselect(
        'local_cpf_validator/format_rules',
        get_string('format_rules', 'local_cpf_validator'),
        get_string('format_rules_desc', 'local_cpf_validator'),
        'numeric_with_special_chars_and_clean',
        [
            'numeric_with_special_chars_and_clean' => get_string('numeric_with_special_chars_and_clean', 'local_cpf_validator'),
            'numeric_with_special_chars' => get_string('numeric_with_special_chars', 'local_cpf_validator'),
            'numeric_only' => get_string('numeric_only', 'local_cpf_validator'),
        ]
    );

    // Adds the setting to the page.
    $settings->add($setting);

    // Adds the settings page to the admin navigation tree.
    $ADMIN->add('localplugins', $settings);
}
