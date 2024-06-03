<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GelangLogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' =>$this->id,
            'gelang_id' => $this->gelang_id,
            'nama_gelang' => $this->gelang->nama_gelang,
            'v_gmac' => $this->v_gmac,
            'v_dmac'=> $this->v_dmac,
            'v_vbatt'=> $this->v_vbatt,
            'v_step' => $this->v_step,
            'v_heartrate' => $this->v_heartrate,
            'v_temp' => $this->v_temp,
            'v_spo' => $this->v_spo,
            'v_systolic' => $this->v_systolic,
            'v_diastolic'=> $this->v_diastolic,
            'v_rssi' => $this->v_rssi,
            'n_cutoff_flag'=> $this->n_cutoff_flag,
            'n_type'=> $this->n_type,
            'v_x0' => $this->v_x0,
            'v_y0' => $this->vy0,
            'v_z0'=> $this->v_z0,
            'd_time' => $this->d_time,
            'n_isavailable' => $this->n_isavailable,
            'v_gateway_topic' => $this-> v_gateway_topic
        ];
    }
}

