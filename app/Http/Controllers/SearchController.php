<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Artisan;
use App\Models\Image;
use App\Http\Controllers\ArtisanController;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $category = $request->category;
        $address = $request->address;

        $artisansearch = Artisan::with(['category', 'state', 'city', 'address']);

        $artisan = $artisansearch->get();

        return response()->json([
            'msg' => 'Artisan Found',
            'Data' => $artisan
        ], 200);
    }
}
