

@extends('layouts.app')

@section('content')
<h2>Book list</h2>

<div id="table">
	<div class="row">
		<div class="col">
			Publisher
		</div>
		<div class="col">
			Author(s)
		</div>
		<div class="col">
			Title
		</div>
		<div class="col">
			Catalog Price
		</div>
		<div class="col">
			Special Price
		</div>
	</div>
</div>

<script>
$(document).ready(function(){

	$.ajax({
	  url: "books/offset/0/limit/6/column/title/asc/true",
	  type: "GET",
	  dataType : "json",
	  success: function(result){
		  
		  if($.isArray(result) ){
			
			var first=true;
			
			$.each(result, function(index, value){
				
				if(first){
					first=false;
					var row=$("<div />").addClass("row");
					
					row.html("New Division");
					$( "#table" ).append( row );
				}
				console.log(value);
			});
			//$( "#table" ).html( "<strong>" + result + "</strong> degrees" );
		  }
	  }
	})
})
</script>

@endsection