<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ApiResponse;
use App\Models\Platform;
use App\Http\Resources\PlatformResource;
use Illuminate\Database\QueryException;
use Exception;
use App\Http\Requests\PlatformRequest;

class PlatfromController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
    try {
            $query = Platform::query();
            $filterableColumns = [
                'platform_id' => 'id',
                'nama_platform' => 'platform',
            ];

            foreach ($filterableColumns as $requestKey => $column) {
                if ($request->has($requestKey)) {
                    $query->where($column, 'like', '%' . $request->input($requestKey) . '%');
                }
            }

            $query->latest();
            $paginatedData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));
                        
            $resourceCollection = PlatformResource::collection($paginatedData);

            return ApiResponse::pagination($resourceCollection);

        } catch (Exception $e) {
            return ApiResponse::error('Failed to get Data.', $e->getMessage());
        } catch (Exception $e) {
            return ApiResponse::error('An unexpected error occurred', $e->getMessage(), 500);
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
public function store(PlatformRequest $request)
    {
        try {
            // Map 'nama_platform' to 'platform'
            $platform = Platform::create([
                'platform' => $request->input('nama_platform'), // Ensure correct mapping
            ]);

            return ApiResponse::created($platform);
        } catch (QueryException $e) {
            return ApiResponse::error('Failed to save data.', $e->getMessage());
        } catch (Exception $e) {
            return ApiResponse::error('An unexpected error occurred', $e->getMessage(), 500);
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
 public function update(PlatformRequest $request)
    {
        $id = $request->input('id');
        
        // Find the platform by ID or fail
        $platform = Platform::findOrFail($id);

        // Check for existing platform with the same name but different ID
        $existingPlatform = Platform::where('platform', $request->input('nama_platform'))
            ->where('id', '!=', $id)
            ->first();

        if ($existingPlatform) {
            return ApiResponse::error('Platform already exists.', null, 400);
        }

        try {
            // Update platform with the new name
            $platform->update([
                'platform' => $request->input('nama_platform'),
            ]);

            return ApiResponse::updated($platform);
        } catch (QueryException $e) {
            return ApiResponse::error('Failed to update data.', $e->getMessage());
        } catch (Exception $e) {
            return ApiResponse::error('An unexpected error occurred', $e->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->input('id');
        $platform = Platform::findOrFail($id);
        $platform->delete();

        return ApiResponse::deleted();
    }
}
