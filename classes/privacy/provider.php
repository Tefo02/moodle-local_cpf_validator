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
 * Privacy API provider for the CPF Validator plugin.
 *
 * @package    local_cpf_validator
 * @copyright  2025 Stefano Lopes Delgado
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_cpf_validator\privacy;

/**
 * Null privacy provider.
 *
 * This plugin does not store any personal user data, so it implements the
 * null_provider interface to declare this to Moodle's privacy subsystem.
 */
class provider implements \core_privacy\local\metadata\null_provider {
    /**
     * Get the language string identifier explaining why this plugin stores no data.
     *
     * @return string The language string identifier.
     */
    public static function get_reason(): string {
        return 'privacy:metadata';
    }
}
