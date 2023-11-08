<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AirtimeRecipient extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'airtime_recipients';
}
