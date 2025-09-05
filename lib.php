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
 * Library file for local_cpf_validator plugin.
 *
 * @package     local_cpf_validator
 * @copyright   2025 Stefano Lopes Delgado <stefanolopes84@gmail.com>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Hook to VALIDATE the Moodle signup form.
 * This function only returns errors. It does not change the data.
 */
function local_cpf_validator_validate_extend_signup_form($data) {
    $errors = [];

    if (empty($data['username'])) {
        $errors['username'] = get_string('error_cpf_required', 'local_cpf_validator');
    } else {
        $errorstring = local_cpf_validator_validate_cpf($data['username']);
        if ($errorstring !== true) {
            $errors['username'] = get_string($errorstring, 'local_cpf_validator');
        }
    }

    return $errors;
}

/**
 * Hook to MODIFY user data after validation but before creation.
 * This function runs only if the validation above passes.
 *
 * @param stdClass &$user The user object, passed by reference.
 */
function local_cpf_validator_post_signup_requests(&$user) {
    // Check if the setting to clean the CPF is enabled.
    if (get_config('local_cpf_validator', 'format_rules') === 'numeric_with_special_chars_and_clean') {
        if (isset($user->username)) {
            // Clean the username (CPF) by removing non-digit characters.
            $user->username = preg_replace('/[^\d]/', '', $user->username);
        }
    }
}

/**
 * Helper function to validate a CPF number.
 *
 * @param string $cpf
 * @return bool|string True if valid, or a string identifier for the error.
 */
function local_cpf_validator_validate_cpf($cpf) {
    $originalcpf = $cpf;
    $cleancpf = preg_replace('/[^\d]/', '', $originalcpf);

    $format_rules = get_config('local_cpf_validator', 'format_rules');

    if ($format_rules == 'numeric_with_special_chars') {
        if (!preg_match('/^\d{3}\.\d{3}\.\d{3}-\d{2}$/', $originalcpf)) {
            return 'error_cpf_format_special_chars'; 
        }
    } else if ($format_rules == 'numeric_only') {
        if (!preg_match('/^\d{11}$/', $originalcpf)) {
            return 'error_cpf_format_numeric'; 
        }
    }
    
    if (strlen($cleancpf) != 11 || preg_match('/^(.)\1{10}$/', $cleancpf)) {
        return 'error_cpf_invalid';
    }

    for ($t = 9; $t < 11; $t++) {
        $d = 0;
        for ($c = 0; $c < $t; $c++) {
            $d += $cleancpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cleancpf[$c] != $d) {
            return 'error_cpf_invalid';
        }
    }

    return true;
}