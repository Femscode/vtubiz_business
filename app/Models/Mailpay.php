<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mailpay extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table ='mailpays';

    public function user() {
        return $this->belongsTo(User::class);
    }
}
