<?php

namespace App\Models;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Result extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'results';

    public function question(){
    	return $this->belongsTo(Question::class);
    }

    public function answer(){
    	return $this->belongsTo(Answer::class);
    }
}
