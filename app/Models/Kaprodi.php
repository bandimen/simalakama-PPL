<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kaprodi extends Model
{
    protected $table = 'kaprodi';
    protected $fillable = ['nidn'];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
