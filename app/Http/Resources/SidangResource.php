<?php

namespace App\Http\Resources;

use App\Models\Ahli;
use App\Models\Hakim;
use App\Models\OditurPenuntut;
use App\Models\Pengacara;
use App\Models\PivotKasusWbp;
use App\Models\Saksi;
use App\Models\WbpProfile;
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

        $hakim = Hakim::select('id', 'nip', 'nama_hakim', 'alamat', 'departemen')
            ->with(['sidang' => function($query){
                $query->select('pivot_sidang_hakim.id', 'pivot_sidang_hakim.sidang_id', 'pivot_sidang_hakim.role_ketua', 'pivot_sidang_hakim.hakim_id');
            }])
            ->get();

        $saksi = Saksi::select('id', 'nama_saksi', 'no_kontak', 'alamat', 'jenis_kelamin', 'kasus_id', 'keterangan')
            ->with(['sidang' => function($query){
                $query->select('pivot_sidang_saksi.id');
            }])
            ->get();

        $ahli = Ahli::select('id', 'nama_ahli', 'bidang_ahli')
            ->with(['sidang' => function($query){
                $query->select('pivot_sidang_ahli.id');
            }])
            ->get();

        $kasusWbp = PivotKasusWbp::select('id', 'wbp_profile_id')
            // ->with(['kasus.wbpProfile' => function($query){
            //     $query->select('kasus.wbpProfile.nama');
            // }])
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
            "sidang_hakim" => $hakim->map(function($hakims){
                return $hakims->sidang->map(function($pivot) use ($hakims) {
                    return [
                        'pivot_sidang_hakim_id' => $pivot->id,
                        'role_ketua' => $pivot->pivot->role_ketua,
                        'hakim_id' => $hakims->id,
                        'nip' => $hakims->nip,
                        'nama_hakim' => $hakims->nama_hakim,
                        'alamat' => $hakims->alamat,
                        'departemen' => $hakims->departemen
                    ];
                });
            })->flatten(1),
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
                        // 'sidang_id' => $sidang->id,
                        'nama_pengacara' => $sidang->nama_pengacara,
                    ];
                });
            })->flatten(1),
            "sidang_saksi" => $saksi->map(function($saksis){
                return $saksis->sidang->map(function($pivot) use ($saksis) {
                    return [
                        'pivot_sidang_saksi_id' => $pivot->id,
                        'saksi_id' => $saksis->id,
                        'nama_saksi' => $saksis->nama_saksi
                    ];
                });
            }
            )->flatten(1),
            "sidang_ahli" => $ahli->map(function($ahlis){
                return $ahlis->sidang->map(function($pivot) use ($ahlis) {
                    return [
                        'pivot_sidang_ahli_id' => $pivot->id,
                        'ahli_id' => $ahlis->id,
                        'nama_ahli' => $ahlis->nama_ahli,
                        'bidang_ahli' => $ahlis->bidang_ahli
                    ];
                });
            })->flatten(1),
            "sidang_kasus_wbp" => $kasusWbp->map(function($wbp){
                return [
                    'pivot_kasus_wbp_id' => $wbp->id,
                    'wbp_profile_id' => $wbp->wbp_profile_id,
                    'nama_wbp' => $this->wbpProfile->nama ?? null
                ];
            }),
            'hasil_vonis' => $this->historiVonis->pluck('hasil_vonis')->toArray(),
            'masa_tahanan_tahun' => $this->historiVonis->pluck('masa_tahanan_tahun')->toArray(),
            'masa_tahanan_bulan' => $this->historiVonis->pluck('masa_tahanan_bulan')->toArray(),
            'masa_tahanan_hari' => $this->historiVonis->pluck('masa_tahanan_hari')->toArray(),
            "nama_dokumen_persidangan" => $this->dokumenPersidangan->nama_dokumen_persidangan ?? null,
            "link_dokumen_persidangan" => $this->dokumenPersidangan->link_dokumen_persidangan ?? null,
            "sidang_id_dokumen" => $this->dokumenPersidangan->sidang_id ?? null
        ];
    }
}
