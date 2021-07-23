<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';
    protected $fillable = ['nama_depan','nama_belakang','jenis_kelamin','agama','alamat','avatar','user_id'];

    public function mapel()
    {
        return $this->belongsToMany(Mapel::class)->withPivot('nilai');
    }

    public function rataRataNilai()
    {
        if($this->mapel->isNotEmpty()){
            $total = 0;
            $hitung = 0;
            foreach($this->mapel as $mapel)
            {
                $total += $mapel->pivot->nilai;
                $hitung++;
            }
            return round($total/$hitung);
        }
    }

    public function namaLengkap()
    {
        return $this->nama_depan . ' ' . $this->nama_belakang;
    }
}
