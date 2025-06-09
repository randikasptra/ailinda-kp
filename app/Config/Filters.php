<?php

namespace Config;

use CodeIgniter\Config\Filters as BaseFilters;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\ForceHTTPS;
use CodeIgniter\Filters\PageCache;
use CodeIgniter\Filters\PerformanceMetrics;
use CodeIgniter\Filters\SecureHeaders;

class Filters extends BaseFilters
{
    /**
     * Configures aliases for Filter classes.
     *
     * @var array<string, class-string|list<class-string>>
     */
    public array $aliases = [
        'csrf'         => CSRF::class,
        'toolbar'      => DebugToolbar::class,
        'honeypot'     => Honeypot::class,
        'forcehttps'   => ForceHTTPS::class,
        'pagecache'    => PageCache::class,
        'performance'  => PerformanceMetrics::class,
        'secureheaders'=> SecureHeaders::class,
        'role'         => \App\Filters\RoleFilter::class,
    ];

    /**
     * Special required filters always run before/after others.
     * Leave empty unless needed.
     */
    public array $required = [
        'before' => [],
        'after'  => [],
    ];

    /**
     * Filters that are always applied before/after every request.
     */
    public array $globals = [
        'before' => [
            // 'forcehttps', // Uncomment if using HTTPS
            // 'csrf',       // Uncomment to enable CSRF protection
        ],
        'after' => [
            'toolbar',      // Debug toolbar for dev
            // 'pagecache',  // Enable if using page cache
        ],
    ];

    /**
     * Filters by HTTP methods.
     */
    public array $methods = [];

    /**
     * Filters by URI patterns.
     */
    public array $filters = [
        // Example: 'role' => ['before' => ['dashboard/*']],
    ];
}
