<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class PluginsController extends Controller
{
    public function plugins()
    {
        $pageConfigs = [
            'bodyClass' => 'ecommerce-application',
        ];

        $breadcrumbs = [
            ['link' => url(config('app.admin_path').'/dashboard'), 'name' => __('locale.menu.Dashboard')],
            ['name' => __('locale.menu.Plugins')],
        ];

        $plugins = [
            [
                'name'  => 'Filemanager',
                'image' => 'https://play-lh.googleusercontent.com/6J5-q1NxtE3rkddhURhSSN-q7Zb7oKsUJet3BuTbEHcJZX0wG0HCHz40ApZTDXQF_ch2',
            ],
            [
                'name'  => 'Messenger',
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/b/be/Facebook_Messenger_logo_2020.svg',
            ],
            [
                'name'  => 'Social Login',
                'image' => 'https://img.freepik.com/free-vector/website-user-login-page-template-design_1017-30786.jpg?w=740&t=st=1715633942~exp=1715634542~hmac=de7a31f540a903c9a7247188b56069fc3d6ce4f3a38794a9e496aa500a4da28a',
            ],
        ];

        return view('admin.plugins.index', [
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
            'plugins'     => json_decode(json_encode($plugins), false),
        ]);
    }

    public function editors()
    {

        $breadcrumbs = [
            ['link' => route('admin.plugins.index')],
            ['name' => __('Plugins')],
            ['link' => route('admin.plugins.editors')],
            ['name' => __('Editors')],
        ];

        return view('admin.plugins.editors', [
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    public function filemanager()
    {

        if ($this->checks()) {
            return redirect()->route('admin.settings.general')->with([
                'status'  => 'error',
                'message' => 'Sorry! This option is not available in demo mode',
            ]);
        }

    }
}
