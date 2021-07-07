@extends('layouts.app')

@section('content')
 <!DOCTYPE html>
 <html>
 <head>
     <title></title>
     <!--  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">   -->
   
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
     <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <style type="text/css">
      .ui-autocomplete-input {
  border: none; 
  font-size: 14px;
  width: 300px;
  height: 24px;
  margin-bottom: 5px;
  padding-top: 2px;
  border: 1px solid #DDD !important;
  padding-top: 0px !important;
  z-index: 1511;
  position: relative;
}
.ui-menu .ui-menu-item a {
  font-size: 12px;
}
.ui-autocomplete {
  position: absolute;
  top: 0;
  left: 0;
  z-index: 1510 !important;
  float: left;
  display: none;
  min-width: 160px;
  width: 160px;
  padding: 4px 0;
  margin: 2px 0 0 0;
  list-style: none;
  background-color: #ffffff;
  border-color: #ccc;
  border-color: rgba(0, 0, 0, 0.2);
  border-style: solid;
  border-width: 1px;
  -webkit-border-radius: 2px;
  -moz-border-radius: 2px;
  border-radius: 2px;
  -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
  -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
  -webkit-background-clip: padding-box;
  -moz-background-clip: padding;
  background-clip: padding-box;
  *border-right-width: 2px;
  *border-bottom-width: 2px;
}
.ui-menu-item > a.ui-corner-all {
    display: block;
    padding: 3px 15px;
    clear: both;
    font-weight: normal;
    line-height: 18px;
    color: #555555;
    white-space: nowrap;
    text-decoration: none;
}
.ui-state-hover, .ui-state-active {
      color: #ffffff;
      text-decoration: none;
      background-color: #0088cc;
      border-radius: 0px;
      -webkit-border-radius: 0px;
      -moz-border-radius: 0px;
      background-image: none;
}
  </style>
 </head>
 <body>

    
     
 
<div class="container">
    <div class="card-header">
        <button type="button" data-toggle="modal" data-target="#questionBody">Ask a public question.</button>
    </div>
    <div class="row justify-content-center">

    <div class="modal fade" id="questionBody" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">Modal Header</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            
            </div>
            <div class="modal-body">
            <form action="/saveQuestions" method="POST"  class="questionsForm" id="questionsForm">
                    @csrf
                    <div>
                        <label>Title</label>
                        <input type="text" name="title" required="required">
                        <br>
                        <label>Body</label>
                        <textarea id="body" name="body"
                        rows="10" cols="50" required="required">
                        </textarea>
                        <br>
                        <label>Tag</label>
                        <input type="text" name="tags" id="autocomplete">
                        <br>
                        <input type="submit" name="" value="Save" class="btn btn-primary pull-right">
                    </div>
            </form>
            </div>
            
        </div>
      
    </div>
    </div>   
        <div class="col-md-8">
            <div class="card">
            </div>

                <div class="card-body">

                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                            {{Session::forget('error')}}
                        </div>
                    @endif
                    <ul>
                    @foreach($questions as $q)
                    <li id={{$q->id}}><a href="/viewQuestion/{{$q->id}}" >{{$q->title}}</a>
                        <br>
                        <a href="/deleteQuestion/{{$q->id}}" style="color: red;">Delete Question</a></li>
                    @endforeach
                      <!-- <li><a href="#">Question 1</a></li>
                      <li><a href="#">Question 2</a></li>
                      <li><a href="#">Question 3</a></li> -->
                    </ul> 

                    
               
                </div>
            </div>
        </div>
    


</div>

<script type="text/javascript">
    $(function(){
    var games = [  "ActionScript", "AppleScript", "Asp", "BASIC", "C", "C++", "Clojure", "COBOL", "ColdFusion", "Erlang", "Fortran", "Groovy", "Haskell", "Java", "JavaScript", "Lisp", "Perl", "PHP", "Python", "Ruby", "Scala", "Scheme"  
        ];

        $("#autocomplete").autocomplete({
        source: games
        });
        $( ".addresspicker" ).autocomplete( "option", "appendTo", ".questionsForm" );
});
</script>

@endsection
