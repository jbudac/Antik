<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use Carbon\Carbon;

class NoteController extends Controller
{
    //

    public function notesList(){
        $list=Note::all();
        return view('note_list',compact('list'));
    }

    public function insertNote(Request $request){
        $note_text=$request->get('note_text');
        $note_date=$request->get('note_date');
           $percentage=0;
           $notes=Note::whereDate('date', $note_date)->get();
            foreach($notes as $note){
                $tes=similar_text($note->note,$note_text,$percentage);
                if($percentage>80){
                    return response()->json([
                        "note"=>null,
                        "similarity"=>$percentage,
                        "message" => 'Error'
                    ], 409);
                }
            }
            $note=Note::create(
                ['note'=>$note_text,'date'=>$note_date]
            );
            return response()->json([
                "note"=>$note,
                "similarity"=>$percentage,
                "message" => 'Ok'
            ], 200);
            
    }
}
