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
 * PHP function to validate a CPF number.
 *
 * @param string $cpf The CPF number to validate.
 * @return bool True if the CPF is valid, false otherwise.
 */
function local_cpf_validator_validateCPF($cpf) {
    // Remove any non-numeric characters
    $cpf = preg_replace('/[^0-9]/is', '', $cpf);

    // CPF must have 11 digits
    if (strlen($cpf) != 11) {
        return false;
    }

    // Reject CPFs with all digits equal (e.g. 11111111111)
    if (preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }

    // Validate first and second verification digits
    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) {
            return false;
        }
    }

    return true;
}

/**
 * Function used by Moodle to validate the signup form.
 *
 * @param array $data The submitted form data.
 * @param array $files The uploaded files.
 * @return array An array of errors. If empty, validation passed.
 */
function local_cpf_validator_signup_form_validation($data, $files) {
    $errors = array();
    
    $cpf = $data['username']; // Using the 'username' field for the CPF
    
    if (!local_cpf_validator_validateCPF($cpf)) {
        // If the CPF is invalid, add an error to the 'username' field.
        // Using get_string to retrieve the message from the language file.
        $errors['username'] = get_string('invalidcpf', 'local_cpfvalidator');
    }
    
    return $errors;
}

/**
 * Function executed before rendering the footer of every page.
 * We use this to load our JavaScript on the signup page.
 */
function local_cpf_validator_before_footer() {
    global $PAGE;

    // The signup page URL ends with /login/signup.php
    if (strpos($PAGE->url->get_path(), '/login/signup.php') !== false) {
        // Request Moodle to load our AMD module and call the 'init' function.
        $PAGE->requires->js_call_amd('local_cpfvalidator/validator', 'init');
    }
}
