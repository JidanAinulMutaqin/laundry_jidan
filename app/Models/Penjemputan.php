<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjemputan extends Model
{
    use HasFactory;

    protected $primarykey = 'id';
    public $incrementing = true;
    protected $table = 'penjemputan';
    protected $guarded = ['id'];

    public function member()
    {
        return $this->belongsTo(Member::class, 'id_member');
    }

}
