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
 * Hooks for local_cpf_validator plugin.
 *
 * @package     local_cpf_validator
 * @copyright   2025 Stefano Lopes Delgado <stefanolopes84@gmail.com>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_cpf_validator\hook;

defined('MOODLE_INTERNAL') || die();

/**
 * Class containing the hook callbacks for output related events.
 *
 * @package   local_cpf_validator
 * @copyright 2025 Your Name
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class output_hooks {
    /**
     * Hook callback executed before the footer is rendered.
     * We use this to add our AMD JavaScript module to the signup page.
     *
     * @param \core\hook\output\before_footer_html_generation $hook The hook instance.
     * @return void
     */
    public static function before_footer(\core\hook\output\before_footer_html_generation $hook): void {
        global $PAGE;
        if (strpos($PAGE->url->get_path(), '/login/signup.php') !== false) {
            $PAGE->requires->js_call_amd('local_cpf_validator/validator', 'init');
        }
    }
}