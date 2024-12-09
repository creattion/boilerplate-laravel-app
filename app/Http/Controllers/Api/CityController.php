<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;

class CityController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->input('q');

        $cities = City::query()
            ->where('name', 'like', "%$q%")
            ->orderBy('name')
            ->orderBy('uf')
            ->get();

        return response()->json([
            'cities' => $cities,
        ]);
    }

    public function show(int $id)
    {
        $city = City::find($id);

        if (! $city) {
            return $this->apiNotFound('Cidade não encontrada');
        }

        return $this->apiSuccess($city);
    }
}
