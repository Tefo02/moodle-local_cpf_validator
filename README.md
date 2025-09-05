# CPF Validator for Moodle (`local_cpf_validator`)

This Moodle plugin adds robust and configurable server-side validation for Brazilian CPF (Cadastro de Pessoas Físicas) numbers on the user signup form. It ensures that the username field accepts only valid CPFs, improving the data accuracy and consistency of your site.

## Features

-   **Robust Server-Side Validation:** Ensures CPF check digits are mathematically correct upon form submission.
-   **Admin Settings Page:** Allows for easy configuration of the plugin's behavior via the Moodle admin interface.
-   **Flexible Format Rules:** The administrator can choose from three validation and storage modes:
    1.  **Numbers Only:** Strictly accepts and saves the CPF as `12345678909`.
    2.  **Numbers + Mask:** Strictly requires the format `123.456.789-09` and saves it that way.
    3.  **Flexible (Default):** Accepts the CPF with or without the mask, but always saves it in a clean, numbers-only format in the database.

## Installation

1.  Clone or download this repository into the `/local/` directory of your Moodle installation:
    ```bash
    cd /path/to/your/moodle/local
    git clone https://github.com/Tefo02/moodle-local_cpf_validator.git cpf_validator
    ```
2.  Log in to your Moodle site as an administrator and go to **Site administration > Notifications** to complete the installation process.

## Configuration

After installation, you can configure the plugin:

1.  Go to **Site administration > Plugins > Local plugins > CPF Validator**.
2.  In the **"Input Format"** setting, choose one of the three validation rules.
3.  Save changes.

## Requirements

-   Moodle 4.3 or higher (tested on Moodle 4.5).
-   PHP 8.0 or higher.

## Usage

Once installed and configured, the CPF validator will work automatically on the new user registration form. The "Username" field will now require a valid CPF according to the rule you have defined. Any invalid submissions will be blocked with a descriptive error message.

## Notes

-   This plugin uses the `username` field for the CPF. Ensure this aligns with your site's policies, as usernames must be unique.
-   Ensure your privacy policy covers the handling of personal identification numbers like the CPF.

## License

This plugin is licensed under the [GNU General Public License v3](https://www.gnu.org/licenses/gpl-3.0.html).

## Author

Developed by [Stefano Lopes](https://github.com/Tefo02).  
Contributions and suggestions are welcome!
