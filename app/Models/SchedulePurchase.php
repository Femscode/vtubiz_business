<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchedulePurchase extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'schedule_purchases';
}
