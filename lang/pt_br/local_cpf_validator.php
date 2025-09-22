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


$string['cpf_field'] = 'Campo de CPF';
$string['cpf_field_desc'] = 'Selecione o campo do perfil do usuário onde o CPF será validado.';
$string['cpf_validator:settings'] = 'Gerenciar as configurações do Validador de CPF';
$string['error_cpf_format_numeric'] = 'O CPF deve conter apenas 11 números.';
$string['error_cpf_format_special_chars'] = 'O CPF deve estar no formato 000.000.000-00.';
$string['error_cpf_in_use'] = 'O CPF informado é inválido.';
$string['error_cpf_invalid'] = 'O CPF é matematicamente inválido. Por favor, verifique os dígitos.';
$string['error_cpf_required'] = 'O campo CPF é obrigatório.';
$string['format_rules'] = 'Formato de Entrada';
$string['format_rules_desc'] = 'Escolha o formato de entrada para o CPF (números, números com ponto e hífen, etc).';
$string['numeric_only'] = 'Apenas Números';
$string['numeric_with_special_chars'] = 'Números + Ponto e Hífen';
$string['numeric_with_special_chars_and_clean'] = 'Números + Ponto e Hífen (apenas números serão salvos)';
$string['pluginname'] = 'Validador de CPF';
$string['privacy:metadata'] = 'O plugin Validador de CPF valida o campo de nome de usuário durante o cadastro, mas não armazena nenhum dado pessoal.';
$string['settings'] = 'Configurações do Validador de CPF';
$string['validate_on_user_creation'] = 'Validar CPF na criação do usuário';
$string['validate_on_user_creation_desc'] = 'Se ativado, o CPF será validado quando um novo usuário for criado.';
