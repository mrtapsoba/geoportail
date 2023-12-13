<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class shapefileController extends Controller
{
    //

    public function getShpData(Request $request)
    {
        $request->validate(
            [
                'shapefile' => 'required',
            ]
        );

        $data = new ShpController($request->shapefile, [], []);
        //echo "3";
        return response()->json($data->getAllData());
    }
}
