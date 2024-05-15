<?php

namespace App\Http\Controllers;

use App\Models\IP;
use Illuminate\Http\Request;

class IPController extends Controller
{
    public function query(Request $request)
    {
        $request->validate([
            'ip' => 'nullable'
        ]);

        $ip = IP::where('ip', $request->input('ip'))->firstOrCreate(['ip' => $request->input('ip')]);
        $ip->update([
            'hostname' => gethostbyaddr($request->input('ip')),
        ]);

        return view('ip.show', compact('ip'));
    }
}
