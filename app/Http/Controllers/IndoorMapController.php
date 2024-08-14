<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GedungOtmil;
use App\Http\Resources\GedungOtmilResource;
use App\Models\LokasiOtmil;

class IndoorMapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            function calc($paramOne, $paramTwo)
            {
                if ($paramTwo == 0) {
                    return 0;
                }

                $sum = ($paramOne / $paramTwo) * 100;
                return round($sum, 0);

                // return $sum;
            }


            $lokasiOtmilId = $request->input('lokasi_otmil_id');
            // $namaLokasiOtmil = $request->input('nama_lokasi_otmil');

            if (empty($lokasiOtmilId)) {
                return response()->json([
                    'status' => 'ERROR',
                    'message' => 'lokasi_otmil_id or nama_lokasi_otmil is required',
                    'records' => ''
                ], 400);
            }

            $query = GedungOtmil::query();

            // if (!empty($lokasiOtmilId)) {
            //     $query->where('lokasi_otmil_id', $lokasiOtmilId);
            // }

            $buildings = $query->with(['lokasiOtmil', 'lantaiOtmil.ruanganOtmil.kamera'])
                ->where('lokasi_otmil_id', $lokasiOtmilId)
                ->get();

            $res = $buildings->map(function($gedung) {
                $PositionX = calc($gedung->posisi_X ?? 1, $gedung->lokasiOtmil->panjang ?? 1);
                $PositionY = calc($gedung->posisi_Y,    $gedung->lokasiOtmil->lebar ?? 1);
                $PinX = $gedung->pin_X ?? 0;
                $PinY = $gedung->pin_Y ?? 0;
                $BoxX = $gedung->box_X ?? 0;
                $BoxY = $gedung->box_Y ?? 0;
                
                $width = calc($gedung->panjang, $gedung->lokasiOtmil->panjang ?? 1);
                $height = calc($gedung->lebar, $gedung->lokasiOtmil->lebar ?? 1);
                $aspectRatio = round($gedung->panjang, 0) . "/" . round($gedung->lebar, 0);

                $resLantai = $gedung->lantaiOtmil->map(function($lantai) use ($gedung) {
                    $resRuangan = $lantai->ruanganOtmil->map(function($ruangan) use ($lantai) {
                        $PositionXRuangan = calc($ruangan->posisi_X, $lantai->panjang ?? 1);
                        $PositionYRuangan = calc($ruangan->posisi_Y, $lantai->lebar ?? 1);
                        $widthRuangan = calc($ruangan->panjang, $lantai->panjang ?? 1);
                        $heightRuangan = calc($ruangan->lebar, $lantai->lebar ?? 1);
                        $aspectRatioRuangan = round($ruangan->panjang, 0) . "/" . round($ruangan->lebar, 0);

                        return [
                            'id' => $ruangan->id,
                            'nama' => $ruangan->nama_ruangan_otmil,
                            'positionX' => $PositionXRuangan,
                            'positionY' => $PositionYRuangan,
                            'width' => 'w-[' . $widthRuangan . '%]',
                            'height' => 'h-[' . $heightRuangan . '%]',
                            'pathname' => strtolower(str_replace(" ", "-", $ruangan->nama_ruangan_otmil)),
                        ];
                    });

                    $widthLantai = calc($gedung->panjang, $gedung->lebar ?? 1);
                    $heightLantai = $gedung->lebar > $gedung->panjang ? ceil(($gedung->lebar - $gedung->panjang) / $gedung->lebar * 100) : calc($lantai->lebar ?? 1, $gedung->lebar ?? 1);

                    return [
                        'id' => $lantai->id,
                        'nama' => $lantai->nama_lantai,
                        'width' => 'w-['. $widthLantai .'%]',
                        'height' => 'h-['. $heightLantai .'%]',
                        'ruangan' => $resRuangan,
                    ];
                });

                return [
                    'id' => $gedung->id,
                    'nama' => $gedung->nama_gedung_otmil,
                    'positionX' => 'left-['.$PositionX.'%]',
                    'positionY' => 'bottom-['.$PositionY.'%]',
                    'pinX' => 'right-['.$PinX.'%]',
                    'pinY' => 'top-['.$PinY.'%]',
                    'boxX' => 'ml-['.$BoxX.'%]',
                    'boxY' => 'mt-['.$BoxY.'%]',
                    'width' => 'w-[' .$width.'%]',
                    'height' => 'h-[' .$height.'%]',
                    'aspectRatio' => 'aspect-[' . $width . '/' . $height . ']',
                    'pathname' => strtolower(str_replace(" ", "-", $gedung->nama_gedung_otmil)),
                    'lantai' => $resLantai,
                ];
            });

            $indoormapData = [
                'gedung' => $res,
            ];

            $response = [
                'layer1' => $indoormapData,
                'layer2' => $indoormapData,
                'layer3' => $indoormapData,
            ];

            return response()->json([
                'status' => 'OK',
                'message' => '',
                'lokasi' => [
                    'lokasi_otmil_id' => $lokasiOtmilId,
                    // 'nama_lokasi_otmil' => $namaLokasiOtmil
                ],
                // 'records' => [
                //     'gedung' => GedungOtmilResource::collection($buildings)
                // ]
                'records' => $response
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'ERROR',
                'message' => 'Failed to retrieve data from database',
                'records' => $e->getMessage()
            ], 500);
        }
    }
}
