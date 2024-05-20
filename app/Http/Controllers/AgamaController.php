<?php
namespace App\Http\Controllers;

use App\Models\Agama;
use Illuminate\Http\Request;

class AgamaController extends Controller
{
    public function index()
    {
        $collection = Agama::latest()->get();
        return response()->json([
            'status' => 200,
            'message' => 'Data retrieved successfully',
            'data' => $collection
        ]);
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

        return response()->json($agama);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_agama' => 'required|string|max:255',
        ]);

        $agama = Agama::findOrFail($id);
        $agama->update($request->all());

        return response()->json($agama);
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
