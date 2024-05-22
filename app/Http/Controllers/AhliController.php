<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ApiResponse;
use App\Models\Ahli;
use Illuminate\Database\QueryException;
use Exception;
use App\Http\Requests\AhliRequest;

class AhliController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            if (request('search')) {
                $keyword = $request->input('search');
                $query = Ahli::where('nama_ahli','like','%'. $keyword . '%')
                ->orWhere('bidang_ahli', 'like', '%' . $keyword . '%')
                ->orWhere('bukti_keahlian', 'like', '%' . $keyword . '%')->latest();
            } else {
                $query = Ahli::latest();
            }

            return ApiResponse::paginate($query);
        } catch (\Exception $e) {
            return ApiResponse::error('Failed to get Data.', $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AhliRequest $request)
    {
        try {
            $ahli = Ahli::create($request->validated());

            return ApiResponse::created($ahli);
        } catch (QueryException $e) {
            return ApiResponse::error('Database error', $e->getMessage(), 500);
        } catch (Exception $e) {
            return ApiResponse::error('An unexpected error occurred', $e->getMessage(),500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ahli = Ahli::findOrFail($id);
        return response()->json($ahli, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
public function update(AhliRequest $request, string $id)
{
    $ahli = Ahli::findOrFail($id);

    $request->validate([
        'nama_ahli' => 'required|string|max:255',
        'bidang_ahli' => 'required|string|max:255',
        'bukti_keahlian' => 'required|string|max:255'
    ]);

    // Check if the updated name already exists
    $existingAhli = Ahli::where('nama_ahli', $request->nama_ahli)->where('id', '!=', $id)->first();
    if ($existingAhli) {
        return ApiResponse::error('Nama ahli sudah ada.', null, 422);
    }

    // Check if the updated field of expertise already exists
    $existingBidang = Ahli::where('bidang_ahli', $request->bidang_ahli)->where('id', '!=', $id)->first();
    if ($existingBidang) {
        return ApiResponse::error('Bidang ahli sudah ada.', null, 422);
    }

    // Check if the updated proof of expertise already exists
    $existingBukti = Ahli::where('bukti_keahlian', $request->bukti_keahlian)->where('id', '!=', $id)->first();
    if ($existingBukti) {
        return ApiResponse::error('Bukti keahlian sudah ada.', null, 422);
    }

    // Update the Ahli
    $ahli->update($request->all());

    return ApiResponse::updated($ahli);
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ahli = Ahli::findOrFail($id);
        $ahli->delete();

        return ApiResponse::deleted();
    }

    public function restore($id){
        $ahli = Ahli::withTrashed()->findOrFail($id);
        $ahli->restore();

        return response()->json($ahli);
    }
}
