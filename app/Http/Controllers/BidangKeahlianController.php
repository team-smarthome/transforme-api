<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Models\BidangKeahlian;
use Illuminate\Http\Request;

class BidangKeahlianController extends Controller
{
    public function index()
    {
        try {
            if (request('search')) {
                $query = BidangKeahlian::where('nama_bidang_keahlian', 'like', '%' . request('search') . '%')->latest();
            } else {
                $query = BidangKeahlian::latest();
            }

            return ApiResponse::paginate($query);
        } catch (\Throwable $e) {
            return ApiResponse::error('Failed to get Data.', $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_bidang_keahlian' => 'required|string|max:100'
        ]);

        $bidangKeahlian = BidangKeahlian::create($request->all());

        return ApiResponse::success([
            'data' => $bidangKeahlian
        ]);
    }
}
