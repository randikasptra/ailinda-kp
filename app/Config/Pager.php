<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Pager extends BaseConfig
{
    public array $templates = [
        'default_full'   => 'CodeIgniter\Pager\Views\default_full',
        'default_simple' => 'CodeIgniter\Pager\Views\default_simple',
        'default_head'   => 'CodeIgniter\Pager\Views\default_head',

        // Custom Tailwind (file ada di app/Views/Pagers/tailwind_pagination.php)
        'tailwind_pagination' => 'Pagers/tailwind_pagination',
    ];

    public int $perPage = 20;
}
