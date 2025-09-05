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
 * Extra validation hook for the Moodle signup form.
 * Validates that the username field contains a valid CPF.
 *
 * @param array $data Form data.
 * @return array List of errors in the format ['field' => 'message'].
 */
function local_cpf_validator_validate_extend_signup_form($data) {
    $errors = [];

    if (empty($data['username'])) {
        $errors['username'] = get_string('invalidcpf', 'local_cpf_validator');
    } else if (!local_cpf_validator_validate_cpf($data['username'])) {
        $errors['username'] = get_string('invalidcpf', 'local_cpf_validator');
    }

    return $errors;
}

/**
 * Helper function to validate a CPF number.
 *
 * @param string $cpf
 * @return bool
 */
function local_cpf_validator_validate_cpf($cpf) {
    
    // Find if has only numbers
    if (!preg_match('/^\d+$/', $cpf)) {
        return false;
    }
    
    // Must have 11 digits and not be all identical
    if (strlen($cpf) != 11 || preg_match('/^(.)\1{10}$/', $cpf)) {
        return false;
    }

    for ($t = 9; $t < 11; $t++) {
        $d = 0;
        for ($c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) {
            return false;
        }
    }

    return true;
}
