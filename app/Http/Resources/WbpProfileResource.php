<?php

namespace App\Http\Resources;

use App\Models\AksesRuangan;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WbpProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $aksesRuangan = $this->whenLoaded('aksesRuangan');

        $aksesRuanganOtmil = $aksesRuangan->filter(function ($item) {
            return !is_null($item->ruangan_otmil_id) && $item->ruangan_otmil_id !== '';
        });

        $aksesRuanganLemasmil = $aksesRuangan->filter(function ($item) {
            return !is_null($item->ruangan_lemasmil_id) && $item->ruangan_lemasmil_id !== '';
        });

        // $aksesRuangan = $this->whenLoaded('aksesRuangan', collect([]));

        // $aksesRuanganOtmil = $aksesRuangan->isNotEmpty() ? $aksesRuangan->filter(function ($item) {
        //     return !is_null($item->ruangan_otmil_id) && $item->ruangan_otmil_id !== '';
        // }) : collect([]);

        // $aksesRuanganLemasmil = $aksesRuangan->isNotEmpty() ? $aksesRuangan->filter(function ($item) {
        //     return !is_null($item->ruangan_lemasmil_id) && $item->ruangan_lemasmil_id !== '';
        // }) : collect([]);

        return [
            'id' => $this->id,
            'nama_wbp' => $this->nama,
            'pangkat_id' => $this->pangkat_id,
            'nama_pangkat' => $this->pangkat->nama_pangkat,
            'kesatuan_id' => $this->kesatuan_id,
            'nama_kesatuan' => $this->kesatuan->nama_kesatuan,
            'nama_lokasi_kesatuan' => $this->kesatuan->lokasiKesatuan->nama_lokasi_kesatuan,
            'tempat_lahir' => $this->tempat_lahir,
            'tanggal_lahir' => $this->tanggal_lahir,
            'jenis_kelamin' => $this->jenis_kelamin,
            'provinsi_id' => $this->provinsi_id,
            'nama_provinsi' => $this->provinsi->nama_provinsi,
            'kota_id' => $this->kota_id,
            'alamat' => $this->alamat,
            'nama_kota' => $this->kota->nama_kota,
            'agama_id' => $this->agama_id,
            'nama_agama' => $this->agama->nama_agama,
            'status_kawin_id' => $this->status_kawin_id,
            'nama_status_kawin' => $this->statusKawin->nama_status_kawin,
            'pendidikan_id' => $this->pendidikan_id,
            'nama_pendidikan' => $this->pendidikan->nama_pendidikan,
            'tahun_lulus' => $this->pendidikan->tahun_lulus,
            'bidang_keahlian_id' => $this->bidang_keahlian_id,
            'nama_bidang_keahlian' => $this->bidangKeahlian->nama_bidang_keahlian,
            'foto_wajah' => $this->foto_wajah,
            'nomor_tahanan' => $this->nomor_tahanan,
            'residivis' => $this->residivis,
            'status_wbp_kasus_id' => $this->status_wbp_kasus_id,
            'nama_status_wbp_kasus' => $this->statusWbpKasus->nama_status_wbp_kasus,
            'created_at_wbp_profile' => $this->created_at,
            'updated_at_wbp_profile' => $this->updated_at,
            'foto_wajah_fr' => $this->foto_wajah_fr,
            'is_isolated' => $this->is_isolated,
            'is_sick' => $this->is_sick,
            'wbp_sickness' => $this->wbp_sickness,
            'gelang_id' => $this->gelang_id,
            'hunian_wbp_lemasmil_id' => $this->hunian_wbp_lemasmil_id,
            'hunian_wbp_otmil_id' => $this->hunian_wbp_otmil_id,
            'nama_hunian_wbp_lemasmil' => $this->when($this->hunianWbpLemasmil, fn() => $this->hunianWbpLemasmil->nama_hunian_wbp_lemasmil),
            'nama_hunian_wbp_otmil' => $this->when($this->hunianWbpOtmil, fn() => $this->hunianWbpOtmil->nama_hunian_wbp_otmil),
            'lokasi_otmil_id' => $this->when($this->hunianWbpOtmil, fn() => $this->hunianWbpOtmil->lokasi_otmil_id),
            'lokasi_lemasmil_id' => $this->when($this->hunianWbpLemasmil, fn() => $this->hunianWbpLemasmil->lokasi_lemasmil_id),
            'nama_lokasi_otmil' => $this->when($this->hunianWbpOtmil, fn() => $this->hunianWbpOtmil->lokasiOtmil->nama_lokasi_otmil),
            'nama_lokasi_lemasmil' => $this->when($this->hunianWbpLemasmil, fn() => $this->hunianWbpLemasmil->lokasiLemasmil->nama_lokasi_lemasmil),
            'status_keluarga' => $this->status_keluarga,
            'nama_kontak_keluarga' => $this->nama_kontak_keluarga,
            'hubungan_kontak_keluarga' => $this->hubungan_kontak_keluarga,
            'nomor_kontak_keluarga' => $this->nomor_kontak_keluarga,
            'matra_id' => $this->matra_id,
            'nama_matra' => $this->nama_matra,
            'nrp' => $this->nrp,
            'tanggal_ditahan_otmil' => $this->tanggal_ditahan_otmil,
            'tanggal_ditahan_lemasmil' => $this->tanggal_ditahan_lemasmil,
            'tanggal_penetapan_tersangka' => $this->tanggal_penetapan_tersangka,
            'tanggal_penetapan_terdakwa' => $this->tanggal_penetapan_terdakwa,
            'tanggal_penetapan_terpidana' => $this->tanggal_penetapan_terpidana,
            'kasus_id' => $this->kasus_id,
            'nama_kasus' => $this->when($this->kasus, fn() => $this->kasus->nama_kasus),
            'nomor_kasus' => $this->when($this->kasus, fn() => $this->kasus->nomor_kasus),
            'jenis_perkara_id' => $this->when($this->kasus, fn() => $this->kasus->jenis_perkara_id),
            'nama_jenis_perkara' => optional($this->kasus->jenisPerkara)->nama_jenis_perkara,
            'pasal' => optional($this->kasus->jenisPerkara)->pasal,
            'vonis_tahun_perkara' => optional($this->kasus->jenisPerkara)->vonis_tahun_perkara,
            'vonis_bulan_perkara' => optional($this->kasus->jenisPerkara)->vonis_bulan_perkara,
            'vonis_hari_perkara' => optional($this->kasus->jenisPerkara)->vonis_hari_perkara,
            'lokasi_kasus' => $this->when($this->kasus, fn() => $this->kasus->lokasi_kasus),
            'waktu_kejadian' => $this->when($this->kasus, fn() => $this->kasus->waktu_kejadian),
            'tanggal_pelimpahan_kasus' => $this->when($this->kasus, fn() => $this->kasus->tanggal_pelimpahan_kasus),
            'kategori_perkara_id' => optional($this->kasus->jenisPerkara)->kategori_perkara_id,
            'nama_kategori_perkara' => $this->kasus ? ($this->kasus->jenisPerkara ? $this->kasus->jenisPerkara->kategoriPerkara->nama_kategori_perkara : null) : null,
            'DMAC' => $this->when($this->gelang, fn() => $this->gelang->dmac),
            'nama_gelang' => $this->when($this->gelang, fn() => $this->gelang->nama_gelang),
            'tanggal_pasang' => $this->when($this->gelang, fn() => $this->gelang->tanggal_pasang),
            'tanggal_aktivasi' => $this->when($this->gelang, fn() => $this->gelang->tanggal_aktivasi),
            'waktu_pelaporan_kasus' => $this->when($this->kasus, fn() => $this->kasus->waktu_pelaporan_kasus),
            'created_at_kasus' => $this->when($this->kasus, fn() => $this->kasus->created_at),
            'updated_at_kasus' => $this->when($this->kasus, fn() => $this->kasus->updated_at),
            'is_diperbantukan' => $this->is_diperbantukan,
            'tanggal_masa_penahanan_otmil' => $this->tanggal_masa_penahanan_otmil,

            'akses_ruangan_otmil' => AksesRuanganResource::collection($aksesRuanganOtmil),
            'akses_ruangan_lemasmil' => AksesRuanganResource::collection($aksesRuanganLemasmil),
        ];
    }
}
