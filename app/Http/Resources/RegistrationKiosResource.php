<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\RegistrationKios;

class RegistrationKiosResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $positionX = $this->posisi_X ?? 0.0; // Atau nilai default lain
        $positionY = $this->posisi_Y ?? 0.0; // Atau nilai default lain

        $positionXFormatted = $this->formatPosition($positionX, 'bottom');
        $positionYFormatted = $this->formatPosition($positionY, 'left');
        // return parent::toArray($request);
        return [
            'registration_kios_id' => $this->id, //
            'gmac' => $this->gmac, //
            'nama_registration_kios' => $this->nama_registration_kios, //
            'status_registration_kios' => $this->status_registration_kios, //
            'v_registration_kios_topic' => $this->v_registration_kios_topic, //
            'lokasi_otmil_id' => $this->ruanganOtmil->lokasi_otmil_id, // ro
            'nama_lokasi_otmil' => $this->ruanganOtmil->lokasiOtmil->nama_lokasi_otmil, // ro lo
            'ruangan_otmil_id' => $this->ruangan_otmil_id, // ro
            'nama_ruangan_otmil' => $this->ruanganOtmil->nama_ruangan_otmil, //ro
            'lantai_otmil_id' => $this->lantai_otmil_id,
            'gedung_otmil_id' => $this->gedung_otmil_id,
            'jenis_ruangan_otmil' => $this->ruanganOtmil->jenis_ruangan_otmil, //ro
            'zona_id_otmil' => $this->ruanganOtmil->zona_id, //ro
            'status_zona_ruangan_otmil' => $this->ruanganOtmil->zona->nama_zona, // ro zona
            'lokasi_lemasmil_id' => $this->lokasi_lemasmil_id, // rl
            'nama_lokasi_lemasmil' => $this->ruanganLemasmil->lokasiLemasmil->nama_lokasi_lemasmil ?? null, // rl ll
            'ruangan_lemasmil_id' => $this->ruangan_lemasmil_id ?? null, //
            'nama_ruangan_lemasmil' => $this->ruanganLemasmil->nama_ruangan_lemasmil ?? null, // rl
            'jenis_ruangan_lemasmil' => $this->ruanganLemasmil->jenis_ruangan_lemasmil ?? null, // rl
            'zona_id_lemasmil' => $this->ruanganLemasmil->zona_id ?? null, // rl
            'status_zona_ruangan_lemasmil' => $this->ruanganLemasmil->zona->nama_zona ?? null, // rl zona
            'positionX' => $positionXFormatted,
            'positionY' => $positionYFormatted,
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
