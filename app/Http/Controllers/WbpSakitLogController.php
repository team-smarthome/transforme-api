<?php

namespace App\Http\Controllers;

use App\Models\WbpProfile;
use Illuminate\Http\Request;

class WbpSakitLogController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    // Get the total count of sick WBPs (is_sick = 1)
    $totalSickWbp = WbpProfile::where('is_sick', 1)->count();
    $totalHealtyWbp = WbpProfile::where('is_sick', 0)->count();

    // Prepare the response data (you can customize this further)
    $data = [
      'total_sehat' => $totalSickWbp,
      'total_sembuh' => $totalHealtyWbp
    ];

    return response()->json($data); // Return JSON response
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
