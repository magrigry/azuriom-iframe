<?php

namespace Azuriom\Plugin\Iframe\Controllers\Admin;

use Azuriom\Http\Controllers\Controller;
use Azuriom\Models\Setting;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function show()
    {
        return view('iframe::admin.index', ['urls' => setting('iframe.urls', '[]')]);
    }

    public function save(Request $request)
    {
        $this->validate($request, [
           'urls.*' => ['required', 'string', 'max:70'],
           'target.*' => ['required', 'string', 'max:255'],
           'title.*' => ['required', 'string', 'max:30'],
        ]);

        if ($request->has('urls') && $request->has('targets') &&  $request->has('titles')) {

            $data = [];
            foreach ($request->get('urls') as $key => $url) {
                if (!empty($request->get('targets')[$key])) {
                    $data[$url] = [
                        'target' => $request->get('targets')[$key],
                        'title' => $request->get('titles')[$key]
                    ];
                }
            }

            Setting::updateSettings([
                'iframe.urls' => json_encode($data),
            ]);
        }

        return redirect()->route('iframe.admin.settings.show');
    }
}
