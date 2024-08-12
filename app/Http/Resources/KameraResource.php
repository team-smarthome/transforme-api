<?php

namespace App\Http\Resources;

use App\Models\Kamera;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KameraResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @return array<string, mixed>
   */
  public function toArray(Request $request): array
  {
    $totalKameras = Kamera::count();

    // Convert posisi_X and posisi_Y to the desired format
    $positionXFormatted = $this->formatPosition($this->posisi_X, 'left');
    $positionYFormatted = $this->formatPosition($this->posisi_Y, 'bottom');
    return [
      'kamera_id' => $this->id,
      'nama_kamera' => $this->nama_kamera,
      'url_rtsp' => $this->url_rtsp,
      'ip_address' => $this->ip_address,
      'ruangan_otmil_id' => $this->ruangan_otmil_id ?? null,
      'nama_ruangan_otmil' => $this->ruanganOtmil->nama_ruangan_otmil ?? null,
      'ruangan_lemasmil_id' => $this->ruangan_lemasmil_id ?? null,
      'nama_ruangan_lemasmil' => $this->ruanganLemasmil->nama_ruangan_lemasmil ?? null,
      'nama_lokasi_otmil' =>  $this->ruanganOtmil->lokasiOtmil->nama_lokasi_otmil ?? null,
      'nama_lokasi_lemasmil' =>  $this->ruanganLemasmil->lokasiLemasmil->nama_lokasi_lemasmil ?? null,
      'merk' => $this->merk,
      'model' => $this->model,
      'status_kamera' => $this->status_kamera,
      'is_play' => $this->is_play,
      'positionX' => $positionXFormatted,
      'positionY' => $positionYFormatted,
      'zona_ruangan_otmil' => $this->ruanganOtmil->zona->nama_zona ?? null,
      'zona_ruangan_lemasmil' => $this->ruanganLemasmil->zona->nama_zona ?? null,
      'created_at' => $this->created_at,
      'updated_at' => $this->updated_at,
    ];
  }

  /**
   * Format the position value into a string with a percentage format.
   *
   * @param float $value
   * @param string $direction
   * @return string
   */
  private function formatPosition(float $value, string $direction): string
  {
    return "{$direction}-[{$value}%]";
  }
}
