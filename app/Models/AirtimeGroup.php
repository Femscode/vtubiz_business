<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AirtimeGroup extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'airtime_groups';
    public function recipient() {
        return $this->hasMany(AirtimeRecipient::class,'group_id');
    }

}
