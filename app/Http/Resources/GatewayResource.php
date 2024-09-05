<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Gateway;

class GatewayResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @return array<string, mixed>
   */
  public function toArray(Request $request): array
  {
    $totalGateways = Gateway::count();

    // Convert posisi_X and posisi_Y to the desired format
    $positionXFormatted = $this->formatPosition($this->posisi_X, 'left');
    $positionYFormatted = $this->formatPosition($this->posisi_Y, 'bottom');

    return [
      'gateway_id' => $this->id,
      'gmac' => $this->gmac,
      'nama_gateway' => $this->nama_gateway,
      'status_gateway' => $this->status_gateway,
      'jumlah_gateway' => $totalGateways,
      'positionX' => $positionXFormatted,
      'positionY' => $positionYFormatted,
      'v_gateway_topic' => $this->v_gateway_topic,
      'lokasi_otmil_id' => $this->ruanganOtmil->lokasi_otmil_id,
      'nama_lokasi_otmil' => $this->ruanganOtmil->lokasiOtmil->nama_lokasi_otmil,
      'ruangan_otmil_id' => $this->ruangan_otmil_id,
      'nama_ruangan_otmil' => $this->ruanganOtmil->nama_ruangan_otmil,
      'lantai_otmil_id' => $this->lantai_otmil_id,
      'gedung_otmil_id' => $this->gedung_otmil_id,
      'jenis_ruangan_otmil' => $this->ruanganOtmil->jenis_ruangan_otmil,
      'zona_id_otmil' => $this->ruanganOtmil->zona_id,
      'status_zona_ruangan_otmil' => $this->ruanganOtmil->zona->nama_zona,
      'lokasi_lemasmil_id' => $this->lokasi_lemasmil_id,
      'nama_lokasi_lemasmil' => $this->ruanganLemasmil->lokasiLemasmil->nama_lokasi_lemasmil ?? null,
      'ruangan_lemasmil_id' => $this->ruangan_lemasmil_id ?? null,
      'nama_ruangan_lemasmil' => $this->ruanganLemasmil->nama_ruangan_lemasmil ?? null,
      'jenis_ruangan_lemasmil' => $this->ruanganLemasmil->jenis_ruangan_lemasmil ?? null,
      'zona_id_lemasmil' => $this->ruanganLemasmil->zona_id ?? null,
      'status_zona_ruangan_lemasmil' => $this->ruanganLemasmil->zona->nama_zona ?? null,
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
