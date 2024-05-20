<?php
namespace App\Http\Controllers;

use App\Models\Agama;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class AgamaController extends BaseController
{
    public function index(Request $request)
    {   

        $collection = Agama::latest()->get();
        return response()->json([
            'status' => 200,
            'message' => 'Data retrieved successfully',
            'data' => $collection
        ]);
        // $collection = Agama::paginate($request->recordsPerPage)->appends($request->query());
        // $agama = Agama::all();

        // $result = [
        //     'data' => $collection->items(),
        //     'links' => $collection->links(),
        //     'meta' => $collection->toArray()
        // ];

        // return $this->wrapResponse(Response::HTTP_OK, self::SUCCESS, $result);

        // return response()->json($agama, 200);
        // if ($request->query('not-paginate')) {
        //     $collection = Agama::all();
        //     $result = ['data' => $collection];
        //     $response = $this->wrapResponse(Response::HTTP_OK, self::SUCCESS, $result);
        // } else {
        //     $collection = Agama::paginate($request->recordsPerPage)->appends($request->query());
        //     $result = [
        //         'data' => $collection->items(),
        //         'links' => $collection->links(),
        //         'meta' => $collection->toArray()
        //     ];
        //     $response = $this->wrapResponse(Response::HTTP_OK, self::SUCCESS, $result);
        // }

        // if ($request->query('not-paginate')) {
        //     $collection = Agama::all();
        //     $result = ['data' => $collection];
        // } else {
        //     $collection = Agama::paginate($request->recordsPerPage)->appends($request->query());
        //     $result = [
        //         'data' => $collection->items(),
        //         'links' => $collection->links(),
        //         'meta' => $collection->toArray()
        //     ];
        // }

        // return $this->wrapResponse(Response::HTTP_OK, self::SUCCESS, $result);
    }


    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama_agama' => 'required|string|max:255|unique:agama,nama_agama',
            ]);
    
            $agama = Agama::create($request->all());

            return response()->json($agama, 201);
    
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors();
    
            if ($errors->has('nama_agama')) {
                return response()->json([
                    'message' => 'Validation error',
                    'errors' => $errors->get('nama_agama')
                ], 422);
            }
    
            return response()->json([
                'message' => 'Validation error',
                'errors' => $errors->all()
            ], 422);
        }
    }
    
    public function show($id)
    {
        $agama = Agama::findOrFail($id);

        return response()->json($agama, 200);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_agama' => 'required|string|max:255',
        ]);

        $agama = Agama::findOrFail($id);

        $namaEditAgama = $request->input('nama_agama');
        $existingAgama = Agama::where('nama_agama', $agama->nama_agama)->first();

        if ($existingAgama && $existingAgama->id !== $id) {
            return response()->json(['message' => 'Nama agama sudah ada.'], 422);
        }

        $agama->update($request->all());

        return response()->json($agama, 200);
    }

    public function destroy($id, Request $request)
    {
        $agama = Agama::findOrFail($id);
        // $agama->forceDelete(); hapus permanen
        $agama->delete();

        return response()->json('Data berhasil dihapus', 204);
    }

    public function restore($id)
    {
        $agama = Agama::withTrashed()->findOrFail($id);
        $agama->restore();

        return response()->json($agama);
    }
}
