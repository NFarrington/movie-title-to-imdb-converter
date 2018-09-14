<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Cache;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Display the dashboard.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function dashboard(Request $request)
    {
        return view('index')->with('results', $request->session()->get('results'));
    }

    public function search(Request $request)
    {
        $url = sprintf(
            '%s?apikey=%s&v=%s',
            config('services.omdb.base'),
            config('services.omdb.key'),
            config('services.omdb.version')
        );

        $results = [];
        $titles = preg_split('/\r\n|\r|\n/', $request->get('titles'));
        foreach ($titles as $title) {
            $result = Cache::remember("title.$title", 60 * 24,
                function () use ($url, $title) {
                    try {
                        $response = app('guzzle')->get("$url&s=$title");
                        return json_decode($response->getBody());
                    } catch (\Exception $e) {
                        dd($title, $e);
                    }
                });

            $results[] = $result->Response == 'True'
                ? ['query' => $title, 'results' => $result->Search]
                : ['query' => $title, 'results' => []];
        }

        return redirect()->route('dashboard')->with('results', $results);
    }
}
