<?php

namespace App\Http\Controllers;

use App\Models\URL;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class URLController extends Controller
{
    public function index()
    {
        return view('url.index', [
            'urls' => auth()->user()->urls,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'url' => 'required|url',
            'code' => 'nullable|string',
        ]);

        if ($request->input('code')) {
            $shortened = $request->input('code');
            if (URL::where('code', $shortened)->exists()) {
                return redirect()->back()->with('error', 'The code is already in use.');
            }
        } else {
            $shortened = Str::random(6);
            while (URL::where('code', $shortened)->exists()) {
                $shortened = Str::random(6);
            }
        }

        $url = auth()->user()->urls()->create([
            'url' => $request->input('url'),
            'code' => $shortened,
        ]);

        Cache::put('sh-' . $shortened, $url->url, now()->addMonth());

        return view('url.index', [
            'url' => $url,
            'urls' => auth()->user()->urls,
        ]);
    }

    public function show($code)
    {
        $url = URL::where('code', $code)->first();
        if ($url) {
            return redirect($url->url);
        } else {
            return view('welcome');
        }
    }
}
