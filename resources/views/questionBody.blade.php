@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>
<head>
	<title>ViewQuestions</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
  	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<style type="text/css">
	
</style>
</head>
<body>
<div class="container">
	<div class="form-group">
		<label style="color: blue;">Title :</label>
		<h2>{{$questionTitle}}</h2>
		<label style="color: blue;">Body :</label>
		<p >
		{{$questionBody}}
		</p>
	</div>
	
	
		

	<ul id='myid'>
		@foreach($answers as $a)

		<li id={{$a->answerId}}>
			<div class="row">
			
			<div class="col-md-3">
				@if($questionUserId==$userId)
				<div class="vote roundrect">
				
  				<button id="down" class="increment down">Downvote</button>
    			<button id="up" class="increment up">Upvote</button>
  				<div class="count" id="countVotes">
  				{{$a->votes}}
  				</div>
				</div>
				@endif
		</div>
		<div class="col-md-8">
			<div class="accordion" id="accordionExample">
  				<div class="card">
    			<div class="card-header" id="headingOne">
      			<h2 class="mb-0">
        		<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          		{{$a->answer}}
        		</button>
      			</h2>
    			</div>

    			<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
     			<div class="card-body">
     				<ul>
     					@foreach($comments as $c)
     					
     					<li>{{$c->comment}}</li>
     					
     					@endforeach
     				</ul>
     				<a href="#" data-toggle="modal" data-target="#questionBody">Add comment</a>
     				<a href="/deleteAnswer/{{$a->answerId}}"  style="color: red;margin-left: 10px;">Delete</a>

     				<div class="modal fade" id="questionBody" role="dialog">
    	<div class="modal-dialog">
    
      <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">Add comment</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            
            </div>
            <div class="modal-body">
            <form action="/saveComments/{{$a->answerId}}/{{$questionId}}" method="POST"  class="commentsForm" id="commentsForm">
                    @csrf
                    <div>
                    	
                        <label>Comment Text</label>
                        <input type="text" name="comment"  id="comment" required="required">
                        <br>
                        
                        <input type="submit" name="" value="Save comment" class="btn btn-primary pull-right">
                    </div>
            </form>
            </div>
            
        </div>
      			</div>
    			</div>
  			</div>
  			</div>
			</div>
			
		</li>
		
		
		@endforeach

	</ul>

	<form action="/saveAnswers/{{$questionId}}" method="POST"  class="answersForm" id="answersForm">
	@csrf
	<textarea rows="10" id="asnwerPosted" name="asnwerPosted"></textarea>    
	<input type="submit" name="" value="Post your answer" class="btn btn-primary pull-right">
	</form>


	    
      
    
     
</div>


</body>
<script type="text/javascript">
$(function(){

  $(".increment").click(function(){
    var count = parseInt($("~ .count", this).text());
    
    if($(this).hasClass("up")) {
      var count = count + 1;
      
       $("~ .count", this).text(count);
    } else {
    	console.log('here');
      var count = count - 1;
      console.log(count);
       $("~ .count", this).text(count);     
    }
    
    $(this).parent().addClass("bump");
    
    setTimeout(function(){
      $(this).parent().removeClass("bump");    
    }, 400);
    
    	$("#myid li").click(function() {    
    		$.ajax({
  	 			url: '/savevotes/'+$(this).attr('id')+'/'+count,
                    type: 'get',
                    // //datatype: "JSON",
                    // contentType: false,
                    // processData: false,
                    success: function(data){
                      
                        

                    }
  			})
		});
    
  	});

  
});
	
</script>
</html>

@endsection