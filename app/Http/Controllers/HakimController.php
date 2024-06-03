<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hakim;
use App\Http\Requests\HakimRequest;
use App\Helpers\ApiResponse;
use Exception;

class HakimController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $query = Hakim::query();
            $filterableColumns = [
                'hakim_id' => 'id',
                'nip' => 'nip',
                'nama_hakim' => 'nama_hakim',
                'alamat' => 'alamat',
                'departemen' => 'departemen',
            ];
            foreach ($filterableColumns as $requestKey => $column) {
                if ($value = request($requestKey)) {
                    $query->where($column, 'like', '%' . $value . '%');
                }
            }

            $query->latest();
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
    public function store(HakimRequest $request)
    {
        try {
            $hakim =  new Hakim([
                'nip' => $request->nip,
                'nama_hakim' => $request->nama_hakim,
                'alamat' => $request->alamat,
                'departemen' => $request->departemen,
            ]);

            if (Hakim::where('nip', $request->nip)->exists()) {
                return ApiResponse::error('Failed to create Hakim.', 'NIP already exists.');
            }

            if($hakim->save()) {
                $data = $hakim->toArray();
                $formattedData = array_merge(['id' => $hakim->id], $data);
                return ApiResponse::created($formattedData);
            }
        } catch (Exception $e) {
            return ApiResponse::error('Failed to create Hakim.', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(HakimRequest $request)
    {
        try {
            $id = $request->input('hakim_id');
            $hakim = Hakim::find($id);
            if (!$hakim) {
                return ApiResponse::notFound('Hakim not found.');
            }

            $hakim->nip = $request->nip;
            $hakim->nama_hakim = $request->nama_hakim;
            $hakim->alamat = $request->alamat;
            $hakim->departemen = $request->departemen;

            if ($hakim->save()) {
                $data = $hakim->toArray();
                return ApiResponse::updated($data);
            } else {
                return ApiResponse::error('Failed to update Hakim.', 'Failed to update Hakim.');
            }

        } catch (Exception $e) {
            return ApiResponse::error('Failed to update Hakim.', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $id = $request->input('hakim_id');
            $hakim = Hakim::find($id);
            if (!$hakim) {
                return ApiResponse::notFound('Hakim not found.');
            }

            if ($hakim->delete()) {
                return ApiResponse::deleted();
            } else {
                return ApiResponse::error('Failed to delete Hakim.', 'Failed to delete Hakim.');
            }

        } catch (Exception $e) {
            return ApiResponse::error('Failed to delete Hakim.', $e->getMessage());
        }
    }
}
