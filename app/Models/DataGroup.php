<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataGroup extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'data_groups';
    public function recipient() {
        return $this->hasMany(DataRecipient::class,'group_id');
    }
}
