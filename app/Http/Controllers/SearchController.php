<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Artisan;
use App\Models\Image;
use App\Models\Category;
use App\Http\Controllers\ArtisanController;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $category = $request->category;
        $address = $request->address;
        $city = $request->city;

        $category = Category::where('category', 'like', "%$category%")->first();
        if (!$category){
            return response([
                'msg' => 'No Similar Category Found'
            ], 404);
        }

        /*$artisansearch = Artisan::with(['category'])->where('category_id', $category->id)
        ->where('address', 'like', "%$address%")->get();*/

        $search = Artisan::with(['category']);

        if ($request->address){
            $search->where('address', 'like', "%$request->keyword%");
        }

        if ($request->category){
            $search->whereHas('category', function($query) use($request){
                $query->where('category_id', $category->id);
            });
        }

        $artisanrequest = $search->get();

        return response()->json([
            'msg' => 'Artisan Found',
            'Data' => $artisanrequest
        ], 200);
    }
}
