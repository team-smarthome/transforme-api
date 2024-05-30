<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AktivitasGelangResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"=> $this->id,
            "gmac"=> $this->gmac,
            "dmac"=> $this->dmac,
            "baterai"=> $this->baterai,
            "step"=> $this->step,
            "heartrate" => $this->heartrate,
            "temp"=> $this->temp,
            "spo"=> $this->spo,
            "systolic" => $this->systolic,
            "diastolic"=> $this->diastolic,
            "cutoff_flag"=> $this->cutoff_flag,
            "type" => $this->type,
            "x0" => $this->x0,
            "y0"=> $this->y0,
            "z0"=> $this->z0,
            "timestamp"=> $this->timestamp,
            "wbp_profile_id"=> $this->wbp_profile_id,
            "rssi"=> $this->rssi,
            "created_at"=> $this->created_at,
            "updated_at"=> $this->updated_at,
        ];
    }
}
