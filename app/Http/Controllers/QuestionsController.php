<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;

class QuestionsController extends Controller
{
    
    public function saveQuestions(Request $request){

        //echo ($request->session()->get('email'));
        $user=DB::table('users')
        	->where('email','=',$request->session()->get('email'))
        	->value('id');
        DB::table('questions')->insert([
    		['title' =>$request->title, 'body' => $request->body,'tags'=>$request->tags,'userId'=>$user]
		]);

    	return view('home');
    }
    public function viewQuestion(Request $request,$id){
        $user=DB::table('users')
            ->where('email','=',$request->session()->get('email'))
            ->value('id');
        $questionUserId=DB::table('questions')
        ->where('id','=',$id)
        ->value('userId');
        $questionTitle=DB::table('questions')
        ->where('id','=',$id)
        ->value('title');
         $questionBody=DB::table('questions')
        ->where('id','=',$id)
        ->value('body');
        $answers=DB::table('answers')
                ->where('questionId','=',$id)
                ->select('answerId','answer','votes','created_on')
                ->get()
                ->toArray();
        $comments=DB::table('comments')
                ->select('answerId','comment','created_on')
                ->get()
                ->toArray();

        return view('questionBody')->with(['answers'=>$answers,'questionTitle'=>$questionTitle,'questionBody'=>$questionBody,'questionId'=>$id,'userId'=>$user,'questionUserId'=>$questionUserId,'comments'=>$comments]);
    }

    public function saveAnswers(Request $request,$id){
         $user=DB::table('users')
            ->where('email','=',$request->session()->get('email'))
            ->value('id');


        $answers=DB::table('answers')
                ->where('questionId','=',$id)
                ->where('userId','=',$user)
                ->select('answerId','answer','votes','created_on')
                ->get()
                ->toArray();

                if(count($answers)==1){
                    
            $request->session()->put('error','user cannot add more than one answer to a question');
            return redirect('/home');
                }else{
            DB::table('answers')->insert([
             ['questionId' =>$id,'userId'=>$user ,'answer' => $request->asnwerPosted]
              ]);
            return redirect()->route('viewQuestion', ['id' => $id]);
            }
        
    }

    public function savevotes(Request $request,$answerid,$votes){
        DB::table('answers')
                ->where('answerId', $answerid)
                ->update(['votes' => $votes]);
                echo "done";
    }

    public function deleteAnswer(Request $request,$answerid){
        $user=DB::table('users')
            ->where('email','=',$request->session()->get('email'))
            ->value('id');
        DB::table('answers')->where('answerId', $answerid)->delete();
        return redirect('/home');
    }

    public function deleteQuestion(Request $request,$id){
        DB::table('questions')->where('id', $id)->delete();
        DB::table('answers')->where('questionId', $id)->where('userId',$user)->delete();
         $request->session()->put('error','answer deleted.');
        return redirect('/home');
    }


    public function saveComments(Request $request,$id,$questionId){
         $user=DB::table('users')
            ->where('email','=',$request->session()->get('email'))
            ->value('id');

            DB::table('comments')->insert([
             ['answerId' =>$id ,'comment' => $request->comment]
              ]);
            return redirect()->route('viewQuestion', ['id' => $questionId]);
            
        
    }
}

