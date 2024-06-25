<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB; // Import DB facade here

class SidangResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // Fetching kasus_id
        $kasus_id = DB::table('sidang')->where('id', $this->id)->value('kasus_id');

        // Fetching data from pivot_kasus_wbp
        $pivot_kasus_wbp = DB::table('pivot_kasus_wbp')->where('kasus_id', $kasus_id)->get();

        // Transforming pivot_kasus_wbp into array format
        $pivot_kasus_wbp_array = $pivot_kasus_wbp->map(function ($item) {
            return [
                'pivot_kasus_wbp_id' => $item->id,
                'kasus_id' => $item->kasus_id,
                'wbp_profile_id' => $item->wbp_profile_id, 
            ];
        })->toArray();

        // Returning the resource array
        return [
            'sidang_id' => $this->id,
            'nama_sidang' => $this->nama_sidang,
            'juru_sita' => $this->juru_sita,
            'pengawas_peradilan_militer' => $this->pengawas_peradilan_militer,
            'jadwal_sidang' => $this->jadwal_sidang,
            'perubahan_jadwal_sidang' => $this->perubahan_jadwal_sidang,
            'kasus_id' => $this->kasus_id,
            'nomor_kasus' => $this->kasus->nomor_kasus,
            'nama_kasus' => $this->kasus->nama_kasus,
            'waktu_mulai_sidang' => $this->waktu_mulai_sidang,
            'waktu_selesai_sidang' => $this->waktu_selesai_sidang,
            'agenda_sidang' => $this->agenda_sidang,
            'pengadilan_militer_id' => $this->pengadilan_militer_id,
            'hasil_keputusan_sidang' => $this->hasil_keputusan_sidang,
            'jenis_persidangan_id' => $this->jenis_persidangan_id,
            'zona_waktu' => $this->zona_waktu,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'lokasi_kasus' => $this->kasus->lokasi_kasus,
            'waktu_kejadian' => $this->kasus->waktu_kejadian,
            'tanggal_pelimpahan_kasus' => $this->kasus->tanggal_pelimpahan_kasus,
            'waktu_pelaporan_kasus' => $this->kasus->waktu_pelaporan_kasus,
            'created_at_kasus' => $this->kasus->created_at,
            'updated_at_kasus' => $this->kasus->updated_at,
            'nama_wbp' => $this->wbpProfile->nama,
            'nrp_wbp' => $this->wbpProfile->nrp,
            'nomor_tahanan_wbp' => $this->wbpProfile->nomor_tahanan,
            'kategori_perkara_id' => $this->kasus->kategori_perkara_id,
            'nama_kategori_perkara' => $this->kasus->kategoriPerkara->nama_kategori_perkara,
            'jenis_perkara_id' => $this->kasus->jenis_perkara_id,
            'nama_jenis_perkara' => $this->kasus->jenisPerkara->nama_jenis_perkara,
            'pasal' => $this->kasus->jenisPerkara->nama_jenis_perkara,
            'vonis_tahun_perkara' => $this->kasus->jenisPerkara->vonis_tahun_perkara,
            'vonis_bulan_perkara' => $this->kasus->jenisPerkara->vonis_bulan_perkara,
            'vonis_hari_perkara' => $this->kasus->jenisPerkara->vonis_hari_perkara,
            'nama_pengadilan_militer' => $this->pengadilanMiliter->nama_pengadilan_militer,
            'provinsi_id' => $this->pengadilanMiliter->provinsi_id,
            'nama_provinsi' => $this->pengadilanMiliter->provinsi->nama_provinsi,
            'nama_jenis_persidangan' => $this->jenisPersidangan->nama_jenis_persidangan,
            'sidang_oditur' => $this->whenLoaded('oditurPenuntut', function () {
                return $this->oditurPenuntut->map(function ($item) {
                    return [
                        'pivot_sidang_oditur_id' => $item->id,
                        'role_ketua' => $item->pivot->role_ketua,
                        'oditur_penuntut_id' => $item->pivot->oditur_penuntut_id,
                        'nip' => $item->nip,
                        'nama_oditur' => $item->nama_oditur,
                        'alamat' => $item->alamat
                    ];
                });
            }),
            // 'sidang_pengacara' => $this->whenLoaded('pengacara', function () {
            //     return $this->pengacara->map(function ($item) {
            //         return [
            //             'nama_pengacara' => $item->pivot->nama_pengacara
            //         ];
            //     });
            // }),
            'sidang_saksi' => $this->whenLoaded('saksi', function () {
                return $this->saksi->map(function ($item) {
                    return [
                        'pivot_sidang_saksi_id' => $item->id,
                        'saksi_id' => $item->pivot->saksi_id,
                        'nama_saksi' => $item->nama_saksi
                    ];
                });
            }),
            'sidang_ahli' => $this->whenLoaded('ahli', function () {
                return $this->ahli->map(function ($item) {
                    return [
                        'pivot_sidang_ahli_id' => $item->id,
                        'ahli_id' => $item->pivot->ahli_id,
                        'nama_ahli' => $item->nama_ahli,
                        'bidang_ahli' => $item->bidang_ahli
                    ];
                });
            }),
            'sidang_kasus_wbp' => $this->whenLoaded('wbpProfilePivot', function () {
                return $this->wbpProfilePivot->map(function ($item) {
                    return [
                        'pivot_kasus_wbp_id' => $item->pivot->kasus_id,
                        'wbp_profile_id' => $item->pivot->wbp_profile_id,
                        'keterangan' => $item->pivot->keterangan
                    ];
                });
            }),
            'sidang_kasus_wbp' => $pivot_kasus_wbp_array,
            // 'sidang_kasus_wbp' => $this->whenLoaded('kasus', function () {
            //     return $this->kasus->flatMap(function ($kasus) {
            //         return $kasus->wbpProfiles->map(function ($wbpProfile) use ($kasus) {
            //             return [
            //                 // 'pivot_kasus_wbp_id' => $kasus->pivot->kasus_id,
            //                 'wbp_profile_id' => $wbpProfile->pivot->wbp_profile_id,
            //                 'keterangan' => $wbpProfile->pivot->keterangan
            //             ];
            //         });
            //     });
            // }),



            // 'masa_tahanan_tahun' => $this->historiVonis->masa_tahanan_tahun,
            // 'masa_tahanan_bulan' => $this->historiVonis->masa_tahanan_bulan,
            // 'masa_tahanan_hari' => $this->historiVonis->masa_tahanan_hari,
            // 'nama_dokumen_persidangan' => $this->dokumenPersidangan->nama_dokumen_persidangan,
            // 'link_dokumen_persidangan' => $this->dokumenPersidangan->link_dokumen_persidangan,
            // 'sidang_id_dokumen' => $this->dokumenPersidangan->sidang_id,
        ];
    }
}