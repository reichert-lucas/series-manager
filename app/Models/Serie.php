<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Serie extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'name',
        'capa',
    ];

    public function getCapaUrlAttribute(){
        if ($this->capa) {
            return Storage::url($this->capa);
        } else {
            return Storage::url("icons/no-photos.png");
        }
    }

    public function temporadas()
    {
        return $this->hasMany(Temporada::class);
    }

}
