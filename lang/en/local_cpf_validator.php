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
 * Plugin strings are defined here.
 *
 * @package     local_cpf_validator
 * @category    string
 * @copyright   2025 Stefano Lopes Delgado <stefanolopes84@gmail.com>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['cpf_field'] = 'CPF Field';
$string['cpf_field_desc'] = 'Select the user profile field where the CPF will be validated.';
$string['cpf_validator:settings'] = 'Manage CPF Validator settings';
$string['error_cpf_format_numeric'] = 'The CPF must contain only 11 numbers.';
$string['error_cpf_format_special_chars'] = 'The CPF must be in the format 000.000.000-00.';
$string['error_cpf_invalid'] = 'The CPF is mathematically invalid. Please check the digits.';
$string['error_cpf_required'] = 'The CPF field is required.';
$string['format_rules'] = 'Input Format';
$string['format_rules_desc'] = 'Choose the input format for CPF (numbers, numbers with dot and hyphen, etc).';
$string['numeric_only'] = 'Only Numbers';
$string['numeric_with_special_chars'] = 'Numbers + Dot and Hyphen';
$string['numeric_with_special_chars_and_clean'] = 'Numbers + Dot and Hyphen (only numbers will be saved)';
$string['pluginname'] = 'CPF Validator';
$string['privacy:metadata'] = 'The CPF Validator plugin validates the username field but does not store any personal data itself.';
$string['settings'] = 'CPF Validator settings';
$string['validate_on_user_creation'] = 'Validate CPF on user creation';
$string['validate_on_user_creation_desc'] = 'If enabled, the CPF will be validated when a new user is created.';