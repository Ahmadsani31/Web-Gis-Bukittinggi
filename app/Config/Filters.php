<?php

namespace Config;

use App\Filters\AuthGuard;
use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\SecureHeaders;

class Filters extends BaseConfig
{
    /**
     * Configures aliases for Filter classes to
     * make reading things nicer and simpler.
     *
     * @var array<string, string>
     * @phpstan-var array<string, class-string>
     */
    public array $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        'authGuard'     => AuthGuard::class
    ];

    /**
     * List of filter aliases that are always
     * applied before and after every request.
     *
     * @var array<string, array<string, array<string, string>>>|array<string, array<string>>
     * @phpstan-var array<string, list<string>>|array<string, array<string, array<string, string>>>
     */
    public array $globals = [
        'before' => [
            // 'honeypot',
            'csrf' => [
                'except' => [
                    'admin/modal/modal-import-layer-drainase',
                    'admin/modal/modal-import-layer-air',
                    'admin/modal/modal-layer',
                    'admin/modal/modal-pengaduan',
                    'admin/modal/modal-pengaduan-image',
                    'admin/modal/modal-layer-style',
                    'admin/modal/modal-layer-legend',
                    'admin/modal/modal-drainase-image',
                    'admin/modal/modal-user',
                    'admin/user/simpan',
                    'admin/berita/export-excel',
                    'admin/layer/style',
                    'admin/layer/legend',
                    'admin/pengaduan/export-excel',
                    'admin/drainase/coordinat',
                    'admin/layer/coordinat',
                    'admin/genangan-air/coordinat',
                    'admin/genangan-air/load-img',
                    'admin/drainase/import-layer',
                    'admin/layer/simpan',
                    'admin/layer/show-id/*',
                    'admin/layer-sub/simpan',
                    'admin/genangan-air/import-layer',
                    'admin/notifikasi',
                    'datatable/server-side',
                    'load-all-layer',
                    'datatable',
                    'select2/getdatakec/*',
                    'select2/getdatakel/*',
                    'delete',
                    'peta/data-grafik',
                    'peta/get-coordinat',
                    'peta/load-sidebar',
                    'peta/detail-coordinat',
                    'peta/load-all-layer',
                    'simpan/pengaduan',
                    'datatable/d',
                    'peta/legend'
                ]
            ],
            'authGuard' => [
                'except' => [
                    '/',
                    'datatable',
                    'peta',
                    'peta/get-coordinat',
                    'peta/load-sidebar',
                    'peta/detail-coordinat',
                    'peta/load-all-layer',
                    'berita',
                    'datatable/d',
                    'peta/data-grafik',
                    'berita/detail/*',
                    'peta/detail-drainase/*',
                    'peta/detail-genangan-air/*',
                    'admin/drainase/coordinat',
                    'admin/modal/modal-drainase-image',
                    'admin/modal/modal-pengaduan-image',
                    'data-pengaduan',
                    'simpan/pengaduan',
                    'select2/getdatakec/*',
                    'select2/getdatakel/*',
                    'peta/legend',
                    'signin',
                    'login',
                    'signin/*',
                    'logout/*'
                ]
            ]
            // 'invalidchars',
        ],
        'after' => [
            'toolbar',
            // 'honeypot',
            // 'secureheaders',
        ],
    ];

    /**
     * List of filter aliases that works on a
     * particular HTTP method (GET, POST, etc.).
     *
     * Example:
     * 'post' => ['foo', 'bar']
     *
     * If you use this, you should disable auto-routing because auto-routing
     * permits any HTTP method to access a controller. Accessing the controller
     * with a method you don't expect could bypass the filter.
     */
    public array $methods = [];

    /**
     * List of filter aliases that should run on any
     * before or after URI patterns.
     *
     * Example:
     * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
     */
    public array $filters = [];
}
