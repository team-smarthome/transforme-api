<?php

namespace App\Http\Controllers;

use App\Http\Resources\PangkatResource;
use App\Models\Pangkat;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Helpers\ApiResponse;


class PangkatController extends Controller
{
    public function index()
    {
        $namaPangkat = request()->input('nama_pangkat');

        try {
            $query = Pangkat::query();

            if ($namaPangkat) {
                $query->where('nama_pangkat', 'like', '%' . $namaPangkat . '%');
            }

            $query->latest();

            return ApiResponse::paginate($query);
        } catch (\Exception $e) {
            return ApiResponse::error('Failed to get Data.', $e->getMessage());
        }
    }



    public function store(Request $request)
    {
        $request->validate([
            'nama_pangkat' => 'required|string|max:100'
        ]);

        $pangkat = Pangkat::create($request->all());

        return ApiResponse::success([
            'data' => $pangkat
        ]);
    }
}
