<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Desa extends Model
{
    protected $fillable = ['kode_desa', 'kecamatan_id', 'nama_desa'];
}
