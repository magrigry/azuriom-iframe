<?php

namespace Azuriom\Plugin\Iframe\Controllers;

use Azuriom\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IframeHomeController extends Controller
{

    public function index(string $path)
    {

        foreach (json_decode(setting('iframe.urls', '[]'), true) as $url => $data) {
            if ($path == $url) {
                return view('iframe::index', ['target' => $data['target'], 'title' => $data['title']]);
            }
        }

        abort(404);
    }
}
