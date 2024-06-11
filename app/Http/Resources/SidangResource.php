<?php

namespace App\Http\Resources;

use App\Models\OditurPenuntut;
use App\Models\Pengacara;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SidangResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $oditurPenuntut = OditurPenuntut::select('id', 'nama_oditur', 'nip', 'alamat')
        ->with(['sidang' => function($query){
            $query->select('pivot_sidang_oditur.role_ketua', 'pivot_sidang_oditur.id');
        }])
        ->get();

        $pengacara = Pengacara::select('id', 'nama_pengacara')
        ->with(['sidang' => function($query){
            $query->select('sidang_pengacara.nama_pengacara');
        }])
        ->get();

        return [
            "sidang_id" => $this->id,
            "nama_sidang" => $this->nama_sidang,
            "juru_sita" => $this->juru_sita,
            "pengawas_peradilan_militer" => $this->pengawas_peradilan_militer,
            "jadwal_sidang" => $this->jadwal_sidang,
            "perubahan_jadwal_sidang" => $this->perubahan_jadwal_sidang,
            "kasus_id" => $this->kasus_id,
            "nomor_kasus" => $this->kasus->nomor_kasus ?? null,
            "nama_kasus" => $this->kasus->nama_kasus ?? null,
            "waktu_mulai_sidang" => $this->waktu_mulai_sidang,
            "waktu_selesai_sidang" => $this->waktu_selesai_sidang,
            "agenda_sidang" => $this->agenda_sidang,
            "pengadilan_militer_id" => $this->pengadilan_militer_id,
            "hasil_keputusan_sidang" => $this->hasil_keputusan_sidang,
            "jenis_persidangan_id" => $this->jenis_persidangan_id,
            "zona_waktu" => $this->zona_waktu,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "wbp_profile_id_kasus" => $this->kasus->wbp_profile_id,
            "wbp_profile_id" => $this->wbp_profile_id,
            "jenis_perkara_id" => $this->kasus->jenis_perkara_id,
            "lokasi_kasus" => $this->kasus->lokasi_kasus,
            "waktu_kejadian" => $this->kasus->waktu_kejadian,
            "tanggal_pelimpahan_kasus" => $this->kasus->tanggal_pelimpahan_kasus,
            "waktu_pelaporan_kasus" => $this->kasus->waktu_pelaporan_kasus,
            "created_at_kasus" => $this->kasus->created_at,
            "updated_at_kasus" => $this->kasus->updated_at ?? null,
            "nama_wbp" => $this->wbpProfile->nama ?? null,
            "nrp_wbp" => $this->wbpProfile->nrp ?? null,
            "nomor_tahanan_wbp" => $this->wbpProfile->nomor_tahanan ?? null,
            "kategori_perkara_id" => $this->kasus->jenisPerkara->kategori_perkara_id ?? null,
            "nama_jenis_perkara" => $this->kasus->jenisPerkara->kategoriPerkara->nama_kategori_perkara ?? null,
            "pasal" => $this->kasus->jenisPerkara->pasal ?? null,
            "vonis_tahun_perkara" => $this->kasus->jenisPerkara->vonis_tahun_perkara,
            "vonis_bulan_perkara" => $this->kasus->jenisPerkara->vonis_bulan_perkara,
            "vonis_hari_perkara" => $this->kasus->jenisPerkara->vonis_hari_perkara,
            "nama_kategori_perkara" => $this->kasus->jenisPerkara->kategoriPerkara->nama_kategori_perkara,
            "nama_pengadilan_militer" => $this->pengadilanMiliter->nama_pengadilan_militer,
            "provinsi_id" => $this->pengadilanMiliter->provinsi_id,
            "nama_provinsi" => $this->pengadilanMiliter->provinsi->nama_provinsi,
            "nama_jenis_persidangan" => $this->jenisPersidangan->nama_jenis_persidangan,
            "sidang_hakim" => [],
            "sidang_oditur" => $oditurPenuntut->map(function($oditur){
                return $oditur->sidang->map(function($pivot) use ($oditur) {
                    return [
                        'pivot_sidang_oditur_id' => $pivot->id,
                        'role_ketua' => $pivot->pivot->role_ketua,
                        'oditur_penuntut_id' => $oditur->id,
                        'nip' => $oditur->nip,
                        'nama_oditur' => $oditur->nama_oditur,
                        'alamat' => $oditur->alamat
                    ];
                });
            })->flatten(1),
            "sidang_pengacara" => $pengacara->map(function($pengacara){
                return $pengacara->sidang->map(function($sidang) use ($pengacara) {
                    return [
                        'nama_pengacara' => $sidang->nama_pengacara,
                    ];
                });
            })->flatten(1),
            // 'oditur' => $oditurPenuntut->map(function ($oditur) {
            //     return [
            //         'oditur_penuntut_id' => $oditur->id,
            //         // 'nama_wbp' => $wbp->nama
            //     ];
            // }),
        ];
    }
}
