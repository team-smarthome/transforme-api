<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ApiResponse;
use App\Models\Platform;
use App\Http\Resources\PlatformResource;
use Illuminate\Database\QueryException;
use Exception;
// use App\Http\Requests\AgamaRequest;

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

            $filters = $request->input('filter', []);

            foreach ($filterableColumns as $requestKey => $column) {
                if (isset($filters[$requestKey])) {
                    $query->where($column, 'like', '%' . $filters[$requestKey] . '%');
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
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
