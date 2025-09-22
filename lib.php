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
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Library file for the local_cpf_validator plugin.
 *
 * This file contains the legacy callbacks used by the plugin for validation
 * and data modification during the user signup process.
 *
 * @package    local_cpf_validator
 * @copyright  2025 Stefano Lopes Delgado <stefanolopes84@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Extra validation hook for the Moodle signup form.
 *
 * This function is a Moodle legacy callback, triggered during the signup
 * form validation process. It checks the 'username' field against CPF rules.
 *
 * @param  array $data The raw data submitted in the form, as an associative array.
 * @return array An array of errors. An empty array means validation passed.
 */
function local_cpf_validator_validate_extend_signup_form(array $data): array {
    $errors = [];

    $selectedfield = get_config('local_cpf_validator', 'cpf_field');

    if (empty($data[$selectedfield])) {
        $errors[$selectedfield] = get_string('error_cpf_required', 'local_cpf_validator');
    } else {
        $validationresult = local_cpf_validator_validate_cpf($data[$selectedfield]);

        if ($validationresult !== true) {
            $errors[$selectedfield] = get_string($validationresult, 'local_cpf_validator');
        }
    }

    return $errors;
}


/**
 * Hook to modify user data after validation but before user creation.
 *
 * This function is a Moodle legacy callback that runs after form validation
 * is successful. It is used here to clean the CPF number before it is
 * saved to the database if the corresponding setting is enabled.
 *
 * @param stdClass $user The user data object, passed by reference.
 * @return void
 */
function local_cpf_validator_post_signup_actions(stdClass &$user): void {
    $selectedfields = get_config('local_cpf_validator', 'cpf_field');

    if (!$selectedfields) {
        return;
    }

    if (isset($user->{$selectedfields}) && is_string($user->{$selectedfields})) {
        $user->{$selectedfields} = preg_replace('/[^\d]/', '', $user->{$selectedfields});
    }
}

/**
 * Helper function to validate a Brazilian CPF number.
 *
 * This function checks both the format (based on admin settings) and the
 * mathematical validity (check digits) of the CPF.
 *
 * @param  string $cpf The CPF string to be validated.
 * @return bool|string Returns true if the CPF is valid, otherwise returns the
 * language string identifier for the specific error.
 */
function local_cpf_validator_validate_cpf(string $cpf) {
    if (get_config('local_cpf_validator', 'validate_on_user_creation') != 1) {
        return true; // Skip validation if the setting is disabled.
    }

    $originalcpf = $cpf;
    $cleancpf = preg_replace('/[^\d]/', '', $originalcpf);
    $formatrules = get_config('local_cpf_validator', 'format_rules');

    if ($formatrules == 'numeric_with_special_chars') {
        if (!preg_match('/^\d{3}\.\d{3}\.\d{3}-\d{2}$/', $originalcpf)) {
            return 'error_cpf_format_special_chars';
        }
    } else if ($formatrules == 'numeric_only') {
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
