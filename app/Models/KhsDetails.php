<?php

namespace App\Models;

use App\Models\Khs;
use App\Models\irsDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KhsDetails extends Model
{
    use HasFactory;

    protected $fillable = ['khs_id', 'irs_details_id', 'nilai'];

    public function khs()
    {
        return $this->belongsTo(Khs::class);
    }

    public function irsDetail()
    {
        return $this->belongsTo(IrsDetail::class, 'irs_details_id');
    }
    public function irsDetails()
    {
        return $this->belongsTo(IrsDetail::class, 'irs_details_id');
    }
    
}