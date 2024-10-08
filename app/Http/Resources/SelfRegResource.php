<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SelfRegResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $positionXFormatted = $this->formatPosition($this->posisi_X, 'bottom');
        $positionYFormatted = $this->formatPosition($this->posisi_Y, 'left');
        return [
            'm_kiosk_id' => $this->id, //
            'gmac' => $this->gmac, //
            'nama_m_kiosk' => $this->nama_m_kiosk, //
            'status_m_kiosk' => $this->status_m_kiosk, //
            'v_m_kiosk_topic' => $this->v_m_kiosk_topic, //
            'lokasi_otmil_id' => $this->ruanganOtmil->lokasi_otmil_id, // ro
            'nama_lokasi_otmil' => $this->ruanganOtmil->lokasiOtmil->nama_lokasi_otmil, // ro lo
            'ruangan_otmil_id' => $this->ruangan_otmil_id, // ro
            'nama_ruangan_otmil' => $this->ruanganOtmil->nama_ruangan_otmil, //ro
            'jenis_ruangan_otmil' => $this->ruanganOtmil->jenis_ruangan_otmil, //ro
            'zona_id_otmil' => $this->ruanganOtmil->zona_id,//ro
            'status_zona_ruangan_otmil' => $this->ruanganOtmil->zona->nama_zona, // ro zona
            'lokasi_lemasmil_id' => $this->lokasi_lemasmil_id, // rl
            'nama_lokasi_lemasmil' => $this->ruanganLemasmil->lokasiLemasmil->nama_lokasi_lemasmil ?? null, // rl ll
            'ruangan_lemasmil_id' => $this->ruangan_lemasmil_id ?? null, //
            'nama_ruangan_lemasmil' => $this->ruanganLemasmil->nama_ruangan_lemasmil ?? null, // rl
            'jenis_ruangan_lemasmil' => $this->ruanganLemasmil->jenis_ruangan_lemasmil ?? null, // rl
            'zona_id_lemasmil' => $this->ruanganLemasmil->zona_id ?? null, // rl
            'status_zona_ruangan_lemasmil' => $this->ruanganLemasmil->zona->nama_zona ?? null, // rl zona
            'positionX' => $positionXFormatted ?? null,
            'positionY' => $positionYFormatted ?? null,
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
