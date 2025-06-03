<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    protected $table    = 'table_kecamatans';
    protected $fillable = ['kode_kecamatan', 'nama_kecamatan'];
}
