<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request)
    {
        return array_merge(parent::share($request), [
            'auth' => function () use ($request) {
                return [
                    'user' => $request->user() ? [
                        'id' => $request->user()->id,
                        'first_name' => $request->user()->first_name,
                        'last_name' => $request->user()->last_name,
                        'email' => $request->user()->email,
                        'role' => $request->user()->role,
                        'photo' => $request->user()->photoUrl(['w' => 40, 'h' => 40, 'fit' => 'crop']),
                        'admin' => $request->user()->owner,
                        // 'permissions' => $request->user()->permissions,
                        'account' => [
                            'id' => $request->user()->account->id,
                            'name' => $request->user()->account->name,
                        ],
                    ] : null,
                ];
            },
            'tabs' => [
                // ['label' => 'Dashboard', 'route' => 'dashboard'],
                ['label' => 'Expedientes', 'route' => 'expedients', 'show' => true],
                ['label' => 'Plantillas', 'route' => 'templates', 'show' =>  $request->user()->owner ?? false],
                ['label' => 'Requisitos', 'route' => 'requirements', 'show' =>  $request->user()->owner ?? false],
                ['label' => 'Maquinaria', 'route' => 'machineries', 'show' =>  $request->user()->owner ?? false],
                ['label' => 'Usuarios', 'route' => 'users', 'show' =>  $request->user()->owner ?? false],
            ],
            'flash' => function () use ($request) {
                return [
                    'success' => $request->session()->get('success'),
                    'error' => $request->session()->get('error'),
                ];
            },
        ]);
    }
}
