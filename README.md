# CPF Validator for Moodle (`local_cpf_validator`)

This Moodle plugin provides automatic validation of Brazilian CPF (Cadastro de Pessoas Físicas) numbers in user-related forms. It ensures that only valid CPFs are accepted during user registration or profile updates, improving data accuracy and consistency.

## Features

- Validates CPF numbers in Moodle user forms.
- Accepts multiple input formats: with or without dots (`.`) and hyphen (`-`).
- Prevents submission of invalid CPF numbers.
- Seamlessly integrates with Moodle’s core user profile system.

## How It Works

The plugin modifies and uses the default user identification field to treat it as a CPF field. It adds validation logic that checks if the input matches the rules of a valid Brazilian CPF, allowing flexibility in formatting (e.g., `123.456.789-09` or `12345678909`).

## Installation

1. Clone or download this repository into your Moodle installation under the `/local/` directory:

``
cd /path/to/your/moodle/local
git clone https://github.com/Tefo02/moodle-local_cpf_validator.git cpf_validator
``

2. Go to your Moodle site and complete the installation through the admin interface.

3. (Optional) Adjust user field settings if necessary in *Site administration > Users > Accounts > User profile fields*.

## Requirements

- Moodle 4.3 or higher (may also work on earlier versions with minor changes).
- PHP 7.3+

## Usage

Once installed, the CPF validator will automatically run on user registration and profile update forms. Users must enter a valid CPF number in the specified user field.

Accepted formats:
- `12345678909`
- `123.456.789-09`

Invalid CPF numbers will trigger a validation error and prevent form submission.

## Notes

- This plugin does not store or manipulate CPF data beyond validation.
- Ensure your privacy policy covers the handling of personal identification numbers like CPF.

## License

This plugin is licensed under the [GNU General Public License v3](https://www.gnu.org/licenses/gpl-3.0.html).

## Author

Developed by [Stefano Lopes](https://github.com/Tefo02)  
Contributions and suggestions are welcome!


