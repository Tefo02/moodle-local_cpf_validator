// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle. If not, see <http://www.gnu.org/licenses/>.

/**
 * @module local_cpf_validator/validator
 * @description A module for client-side CPF validation on the signup form.
 * @author Stefano Lopes
 */
define(['core/jquery', 'moodle/string'], function($, MoodleString) {

    /**
     * Validates a Brazilian CPF number.
     *
     * @param {string} cpf The CPF string to validate.
     * @returns {boolean} True if the CPF is valid, false otherwise.
     */
    const validateCPF = function(cpf) {
        // Clean the CPF, removing any non-digit characters.
        cpf = cpf.replace(/[^\d]/g, '');

        // Check if it has 11 digits.
        if (cpf.length !== 11) {
            return false;
        }

        // Check for known invalid sequences (e.g., '11111111111').
        if (/^(\d)\1+$/.test(cpf)) {
            return false;
        }

        // Calculate and check the first verification digit.
        let sum = 0;
        let remainder;
        for (let i = 1; i <= 9; i++) {
            sum = sum + parseInt(cpf.substring(i - 1, i)) * (11 - i);
        }
        remainder = (sum * 10) % 11;
        if ((remainder === 10) || (remainder === 11)) {
            remainder = 0;
        }
        if (remainder !== parseInt(cpf.substring(9, 10))) {
            return false;
        }

        // Calculate and check the second verification digit.
        sum = 0;
        for (let i = 1; i <= 10; i++) {
            sum = sum + parseInt(cpf.substring(i - 1, i)) * (12 - i);
        }
        remainder = (sum * 10) % 11;
        if ((remainder === 10) || (remainder === 11)) {
            remainder = 0;
        }
        if (remainder !== parseInt(cpf.substring(10, 11))) {
            return false;
        }

        return true;
    };

    // Public interface of the module.
    return {
        /**
         * Initializes the validation logic on the signup form.
         * @public
         */
        init: function() {
            const usernameField = $('#id_username');

            if (usernameField.length) {
                const errorDiv = $('<div id="cpf-validation-error" style="font-size: 0.9em; margin-top: 5px;"></div>');
                usernameField.after(errorDiv);

                usernameField.on('input', function() {
                    const cpfValue = $(this).val();
                    if (cpfValue.length > 0) {
                        if (validateCPF(cpfValue)) {
                            // To use Moodle language strings, we would do this:
                            // MoodleString.get_string('validcpf', 'local_cpf_validator').done(function(s) {
                            //     errorDiv.text(s).css('color', 'green');
                            // });
                            // For simplicity in this example, we use hardcoded text:
                            errorDiv.text('Valid CPF!').css('color', 'green');
                        } else {
                            // MoodleString.get_string('invalidcpf', 'local_cpf_validator').done(function(s) {
                            //     errorDiv.text(s).css('color', 'red');
                            // });
                            errorDiv.text('Invalid CPF.').css('color', 'red');
                        }
                    } else {
                        // Clear the message when the field is empty.
                        errorDiv.text('');
                    }
                });
            }
        }
    };
});