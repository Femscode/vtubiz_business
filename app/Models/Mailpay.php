<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mailpay extends Model
{
    use HasFactory;
    protected $guarded = 'mailpay';
    protected $table ='mailpays';
}
