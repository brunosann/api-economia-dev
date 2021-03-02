<?php

namespace Config;

use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation
{
	//--------------------------------------------------------------------
	// Setup
	//--------------------------------------------------------------------

	/**
	 * Stores the classes that contain the
	 * rules that are available.
	 *
	 * @var string[]
	 */
	public $ruleSets = [
		Rules::class,
		FormatRules::class,
		FileRules::class,
		CreditCardRules::class,
	];

	/**
	 * Specifies the views that are used to display the
	 * errors.
	 *
	 * @var array<string, string>
	 */
	public $templates = [
		'list'   => 'CodeIgniter\Validation\Views\list',
		'single' => 'CodeIgniter\Validation\Views\single',
	];

	//--------------------------------------------------------------------
	// Rules
	//--------------------------------------------------------------------
	public $signin = [
		'email' => ['label' => 'Email', 'rules' => 'required|valid_email'],
		'password' => ['label' => 'Senha', 'rules' => 'required|min_length[8]'],
	];

	public $signup = [
		'name' => ['label' => 'Nome', 'rules' => 'required|alpha_space'],
		'email' => ['label' => 'Email', 'rules' => 'required|valid_email'],
		'password' => ['label' => 'Senha', 'rules' => 'required|min_length[8]'],
		'co_password' => ['label' => 'Confirme Senha', 'rules' => 'required|min_length[8]|matches[password]'],
	];

	public $revenue = [
		'value' => ['label' => 'Valor', 'rules' => 'required|decimal'],
		'description' => ['label' => 'Descrição', 'rules' => 'required|string'],
	];
}
