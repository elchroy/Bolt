<?php

namespace Bolt\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

use Bolt\Http\Requests;

class JsonController extends Controller
{
    public function storeJson(Request $request) {

        $data = $request->all();

        $newJson = DB::table('jsons')->insert([
            "data" => json_encode($data['json_data']),
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now(),
        ]);

        return response()->json([
            'status' => 'json saved'
        ], 201);

    }

    public function getStoredJson (Request $request) {
        $jsons = DB::table('jsons')->latest()->get();
        $data = [
            'jsons' => $jsons
        ];
        return view('json.index', $data);
    }
}
