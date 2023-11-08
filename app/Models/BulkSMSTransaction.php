<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BulkSMSTransaction extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'bulk_s_m_s_transactions';
    public function user() {
        return $this->belongsTo(User::class);
    }
}
