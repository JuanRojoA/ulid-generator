<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UlidController extends Controller
{
    /**
     * Display the ULID generator form.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('ulid.index', ['ulids' => []]);
    }

    /**
     * Generate ULIDs based on user input.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function generate(Request $request)
    {
        // Validate the input
        $request->validate([
            'count' => 'nullable|integer|min:1|max:100',
        ]);

        // Determine the number of ULIDs to generate
        $count = $request->input('count', 1);
        $count = $count > 100 ? 100 : $count; // Cap at 100 to prevent abuse

        // Generate ULIDs
        $ulids = [];
        for ($i = 0; $i < $count; $i++) {
            usleep(3000); // Wait 3 milliseconds
            $ulids[] = (string) Str::ulid()->toBase32();
        }

        // Return the view with generated ULIDs
        return view('ulid.index', ['ulids' => $ulids, 'count' => $count]);
    }
}
