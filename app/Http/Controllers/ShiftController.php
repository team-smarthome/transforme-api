<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ApiResponse;
use App\Models\Shift;
use Illuminate\Database\QueryException;
use Exception;
use App\Http\Requests\ShiftRequest;
use App\Http\Resources\ShiftResource;

class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            // if (request('shift_id')) {
            //     $query = Shift::where('id', request('shift_id'));
            //     if (request('nama_shift') && $query->exists()) {
            //         $query = Shift::where('nama_shift', 'like', '%' . request('nama_shift') . '%');
            //     } 
            // } elseif(request('nama_shift')) {
            //     $query = Shift::where('nama_shift', 'like', '%' . request('nama_shift') . '%')->latest();
            // } else {
            //     $query = Shift::latest();
            // }

            // return ApiResponse::paginate($query);
            $query = Shift::query();
            $filterableColumns = [
                'shift_id' => 'id',
                'nama_shift' => 'nama_shift'
            ];

            $filters = $request->input('filter', []);

            foreach ($filterableColumns as $requestKey => $column) {
                if (isset($filters[$requestKey])) {
                    $query->where($column, 'like', '%' . $filters[$requestKey] .'%');
                }
            }

            $query->latest();
            $paginateDate = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));

            $resourceCollection = ShiftResource::collection($paginateDate);

            return ApiResponse::pagination($resourceCollection, 'Successfully get Data');

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
    public function store(ShiftRequest $request)
    {
        try {
            $shift = Shift::create($request->validated());
            $data = $shift->toArray();
            $formattedData = array_merge(['id' => $shift->id], $data);
            return ApiResponse::created($formattedData);
    
        } catch (QueryException $e) {
            return ApiResponse::error('Database error', $e->getMessage(), 500);
    
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
    public function update(ShiftRequest $request)
    {
        try {
            $id = $request->input('shift_id');
            $shift = Shift::findOrFail($id);
            $shift->update($request->validated());

        } catch (QueryException $e) {
            return ApiResponse::error('Database error', $e->getMessage(), 500);

        } catch (Exception $e) {
            return ApiResponse::error('An unexpected error occurred', $e->getMessage(), 500);
        }

        return ApiResponse::updated($shift);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $id = $request->input('shift_id');
            $shift = Shift::findOrFail($id);
            $shift->delete();

        } catch (QueryException $e) {
            return ApiResponse::error('Database error', $e->getMessage(), 500);
        } catch (Exception $e) {
            return ApiResponse::error('Data has Already delete', $e->getMessage(), 500);
        }
        return ApiResponse::deleted(); 
    }
}
