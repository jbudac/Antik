
@extends('layouts.app')
@section('content')
<div class="container">
    <input type="date" class="form-control input-lg" name="note_date">
   <input type="text" class="form-control input-lg" name="add_note" /> <input type="button" value="Add Note" name="add_note_button"/><div>
    <table class="table" name="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Poznamka</th>
            <th scope="col">Datum</th>
          </tr>
        </thead>
        <tbody>
@foreach($list as $note)
<tr>
   <!-- <td>{{$loop->iteration}}</td>-->
    <td>{{$note->id}}</td>
    <td>{{$note->note}}</td>
    <td>{{$note->date}}</td>
  </tr>
@endforeach
        </tbody>
    </table>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
	// jquery code here
    $("[name=add_note_button]").on('click',function(){
       // alert($('[name=add_note]').val());
        $.ajax({
            url: "api/save_note",
            type: "POST",
            data: {
                note_text: $('[name=add_note]').val(),
                note_date: $('[name=note_date]').val()
            },
            success: function (message) {
                iteration=$("[name=table]").last();
                console.log(iteration);
                $("[name=table]").append('<tr>'+
    '<td>'+message.note.id+'</td>'+
    '<td>'+message.note.note+'</td>'+
    '<td>'+message.note.date+'</td>'+
  '</tr>');
            },
            error: function () {
                alert("nie je mozne pridat, zhoda pred datum "+$('[name=note_date]').val()+" je vacsia ako 80%");
               // swal("Error", "Unable to bring up the dialog.", "error");
            }
        });
        })
}, false);
   
    
    </script>

@stop