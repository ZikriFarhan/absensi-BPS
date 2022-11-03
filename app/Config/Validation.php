<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

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

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------

    // Rules For Registration
    //--------------------------------------------------------------------
    public $registration = [
        'username' => [
            'label' =>  'Auth.username',
            'rules' => 'required|max_length[30]|min_length[3]|regex_match[/\A[a-zA-Z0-9\.]+\z/]|is_unique[users.username]',
        ],
        'email' => [
            'label' =>  'Auth.email',
            'rules' => 'required|max_length[254]|valid_email|is_unique[auth_identities.secret]',
        ],
        'password' => [
            'label' =>  'Auth.password',
            'rules' => 'required|strong_password',
        ],
        'password_confirm' => [
            'label' =>  'Auth.passwordConfirm',
            'rules' => 'required|matches[password]',
        ],
    ];

    // Rules For Login 
    //--------------------------------------------------------------------
    public $login = [
        'username' => [
            'label' =>  'Auth.username',
            'rules' => 'required|max_length[30]|min_length[3]|regex_match[/\A[a-zA-Z0-9\.]+\z/]',
        ],
        // 'email' => [
        //     'label' =>  'Auth.email',
        //     'rules' => 'required|max_length[254]|valid_email',
        // ],
        'password' => [
            'label' =>  'Auth.password',
            'rules' => 'required',
        ],
    ];
}
