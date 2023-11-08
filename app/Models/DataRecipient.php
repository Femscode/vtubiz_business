<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataRecipient extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'data_recipients';
}
