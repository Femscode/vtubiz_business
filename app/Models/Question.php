<?php

namespace App\Models;

use App\Models\Answer;
use App\Models\Giveaway;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'questions';

    private $limit = 10;
    private $order = 'DESC';

    public function answers(){
    	return $this->hasMany(Answer::class);
    }

    public function testlink(){
    	return $this->belongsTo(Giveaway::class,'test_id');
    }


    public function storeQuestion($data){
        // dd($data);
        // $data['test_id'] = $data['test'];
        // dd($data,'the new data');
    	return Question::create([
            'test_id' => $data['test'],
            'give_away_id' => $data['test'],
            'question' => $data['question'],
          
        ]);
    }

    public function getQuestions(){
        return Question::orderBy('created_at',$this->order)->with('quiz')->paginate($this->limit);

    }

    public function getQuestionById($id){
        return Question::find($id);
    }

    public function findQuestion($id){
        return Question::find($id);
    }
    public function updateQuestion($id,$data){
        $question = Question::find($id);
        $question->question = $data['question'];
        $question->test_id = $data['quiz'];
        $question->save();
        return $question;
    }

    public function deleteQuestion($id){
        Question::where('id',$id)->delete();
    }
}
