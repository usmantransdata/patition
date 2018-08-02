<!DOCTYPE html>
<html>
@include('frontend.layout.header')
<link rel="stylesheet" type="text/css" href="{{asset('/')}}public/dist/css/search.css">
<meta name="_token" content="{{ csrf_token() }}">


<!--END OF NAVBAR-->
<section>
  <img src="{{asset('/')}}public/frontend/images/about.jpg" style="width: 100%; height: 350px;"> 
  <!-- filter: blur(3px); -->
  <h2 class="white-text" style="background-color:#00000099;opacity: 0.8; position: absolute; top:180px; left: 0; width:100%; text-align: center;"><strong>Browse Your Desired</strong><strong class="green-text"> Petitions</strong></h2>
</section>
  <br>
  <!--RANDOM CONTENT-->
<div class="container content">
  <div class="section">
    <div class="row ">

      

      <div class="col s12 center">
        <h4>Top Categories</h4>
        <p style="font-size: 17px">Finally, it's important to remember that you've got one of the most powerful activism tools ever invented.<br>Now Easily Create, Send And Analyze Surveys</p>
      </div>
    </div>
  </div>
</div>
<div class="container">
  <div class="row">

      @foreach($categories as $cat)
    <div class="col m3" style="cursor: pointer;">
     <a href="{{route('categoryView', $cat->id)}}">
      <div class="center">
       <!--  <i class="fa fa-cube fa-2x" aria-hidden="true"></i> -->
        <h5 class="green-text">{{$cat->name}}</h5>
        <hr width="50%">
     </a>
      </div>
    </div>
      @endforeach
  </div>
  <br><br>
  <div class="row center">
    <a href="">
          <button class="waves-effect waves-green btn-flat N/A transparent black-text" style="border:2px solid black;">Brwose More</button>
        </a>
  </div>
   <div class="col s12 center">
          <h5>Find out some of the hotest petition</h5>
        <form>
          <input type="text" id="searchMe" class="searchbar" name="search" placeholder="Search..">
         <button aria-label="Search" class="btn btn-action btn-big js-search-button">
         <span class="symbol-search symbol-compact" aria-hidden="true"></span>
       </button>

        </form>
     </div>
</div>
<br>
<!--RANDOM CONTENT-->
<div class="container content">
  <div class="section">
    <div class="row ">
      <div class="col s12 center">
        <h4>See What's People Choice</h4>
        <p style="font-size: 17px">Finally, it's important to remember that you've got one of the most powerful activism tools ever invented.<br>Now Easily Create, Send And Analyze Surveys</p>
      </div>
    </div>
  </div>
</div>
<!--END OF CONTENT-->
<!-- RANDOM CONTECT -->
<div class="container">
  <div class="section">
    <div class="row-cards">
      <div class="row s12" >
        <!-- column 1 -->
       @foreach($petitions->slice(0, 4) as $key => $petition)
     
          @if($key === 0)
        
        <div class="col m4" >
          <a href="">
          <div class="card blue-grey darken-2 hoverable" style="height: 430px;">
            <div class="card-image">
              <img src="{{asset('/')}}storage/app/{{$petition->avatar}}" style="height: 150px">
              <a class="btn-floating halfway-fab blue-grey darken-4">
                <i class="material-icons white-text">edit</i></a>
            </div>
            
            <div class="card-content">
             
              <a href=""><span class="card-title green-text" style="height: 50px">{{$petition->title}}</span></a><br>
              <p class="white-text" style="height: 130px">{{substr($petition->message, 0, 100)}}</p>
              <a href="{{route('petition.show', $petition->id)}}" class="green-text">View Article</a>
            </div>
          </div>
          </a>
        </div> 

          @endif
           @if($key === 1)
         
     <div class="col m4" >
          <a href="">
          <div class="card blue-grey darken-2 hoverable" style="height: 480px;" >
            <div class="card-image">
              <img src="{{asset('/')}}/storage/app/{{$petition->avatar}}" style="height: 150px">
              <a class="btn-floating halfway-fab blue-grey darken-4">
                <i class="material-icons white-text">edit</i></a>
            </div>
            <div class="card-content">
              <a href=""><span class="card-title green-text" style="height: 50px">{{$petition->title}}</span></a>
              <p class="white-text" style="height: 150px">{{substr($petition->message, 0, 100)}}</p><a href="{{route('petition.show', $petition->id)}}" class="green-text">View Article</a>
              
            </div>
          </div>
          </a>
         </div> 
          @endif
             @if($key === 2)
      <div class="col m4" >
          <a href="">
          <div class="card blue-grey darken-2 hoverable" style="height: 430px;">
            <div class="card-image">
              <img src="{{asset('/')}}storage/app/{{$petition->avatar}}" style="height: 150px">
              <a class="btn-floating halfway-fab blue-grey darken-4">
                <i class="material-icons white-text">edit</i></a>
            </div>
            
            <div class="card-content">
             
              <a href=""><span class="card-title green-text" style="height: 50px">{{$petition->title}}</span></a><br>
              <p class="white-text" style="height: 130px">{{substr($petition->message, 0, 100)}}</p>
              <a href="{{route('petition.show', $petition->id)}}" class="green-text">View Article</a>
            </div>
          </div>
          </a>
        </div> 
          @endif
            @endforeach
        </div>
        <div class="row s12" >
         @foreach($petitions->slice(0, 8) as $key => $petition)
     
         @if($key === 3)
      <div class="col m4" style="margin-top: -70px">
          <a href="">
          <div class="card blue-grey darken-2 hoverable" style="height: 430px;">
            <div class="card-image">
              <img src="{{asset('/')}}storage/app/{{$petition->avatar}}" style="height: 150px">
              <a class="btn-floating halfway-fab blue-grey darken-4">
                <i class="material-icons white-text">edit</i></a>
            </div>
            
            <div class="card-content">
             
              <a href=""><span class="card-title green-text" style="height: 50px">{{$petition->title}}</span></a><br>
              <p class="white-text" style="height: 130px">{{substr($petition->message, 0, 100)}}</p>
              <a href="{{route('petition.show', $petition->id)}}" class="green-text">View Article</a>
            </div>
          </div>
          </a>
        </div> 
          @endif
           @if($key === 4)
      <div class="col m4" style="margin-top: -17px">
          <a href="">
          <div class="card blue-grey darken-2 hoverable" style="height: 430px;">
            <div class="card-image">
              <img src="{{asset('/')}}storage/app/{{$petition->avatar}}" style="height: 150px">
              <a class="btn-floating halfway-fab blue-grey darken-4">
                <i class="material-icons white-text">edit</i></a>
            </div>
            
            <div class="card-content">
             
              <a href=""><span class="card-title green-text" style="height: 50px">{{$petition->title}}</span></a><br>
              <p class="white-text" style="height: 130px">{{substr($petition->message, 0, 100)}}</p>
              <a href="{{route('petition.show', $petition->id)}}" class="green-text">View Article</a>
            </div>
          </div>
          </a>
        </div> 
          @endif

          @if($key === 5)
      <div class="col m4" style="margin-top: -70px">
          <a href="">
          <div class="card blue-grey darken-2 hoverable" style="height: 430px;">
            <div class="card-image">
              <img src="{{asset('/')}}storage/app/{{$petition->avatar}}" style="height: 150px">
              <a class="btn-floating halfway-fab blue-grey darken-4">
                <i class="material-icons white-text">edit</i></a>
            </div>
            
            <div class="card-content">
             
              <a href=""><span class="card-title green-text" style="height: 50px">{{$petition->title}}</span></a><br>
              <p class="white-text" style="height: 130px">{{substr($petition->message, 0, 100)}}</p>
              <a href="{{route('petition.show', $petition->id)}}" class="green-text">View Article</a>
            </div>
          </div>
          </a>
        </div> 
          @endif
     @endforeach
      </div>

       <div class="row s12" >
         @foreach($petitions->slice(0, 12) as $key => $petition)
     
         @if($key === 6)
      <div class="col m4" style="margin-top: -70px">
          <a href="">
          <div class="card blue-grey darken-2 hoverable" style="height: 430px;">
            <div class="card-image">
              <img src="{{asset('/')}}storage/app/{{$petition->avatar}}" style="height: 150px">
              <a class="btn-floating halfway-fab blue-grey darken-4">
                <i class="material-icons white-text">edit</i></a>
            </div>
            
            <div class="card-content">
             
              <a href=""><span class="card-title green-text" style="height: 50px">{{$petition->title}}</span></a><br>
              <p class="white-text" style="height: 130px">{{substr($petition->message, 0, 100)}}</p>
              <a href="{{route('petition.show', $petition->id)}}" class="green-text">View Article</a>
            </div>
          </div>
          </a>
        </div> 
          @endif
           @if($key === 7)
      <div class="col m4" style="margin-top: -17px">
          <a href="">
          <div class="card blue-grey darken-2 hoverable" style="height: 430px;">
            <div class="card-image">
              <img src="{{asset('/')}}storage/app/{{$petition->avatar}}" style="height: 150px">
              <a class="btn-floating halfway-fab blue-grey darken-4">
                <i class="material-icons white-text">edit</i></a>
            </div>
            
            <div class="card-content">
             
              <a href=""><span class="card-title green-text" style="height: 50px">{{$petition->title}}</span></a><br>
              <p class="white-text" style="height: 130px">{{substr($petition->message, 0, 100)}}</p>
              <a href="{{route('petition.show', $petition->id)}}" class="green-text">View Article</a>
            </div>
          </div>
          </a>
        </div> 
          @endif

          @if($key === 8)
      <div class="col m4" style="margin-top: -70px">
          <a href="">
          <div class="card blue-grey darken-2 hoverable" style="height: 430px;">
            <div class="card-image">
              <img src="{{asset('/')}}storage/app/{{$petition->avatar}}" style="height: 150px">
              <a class="btn-floating halfway-fab blue-grey darken-4">
                <i class="material-icons white-text">edit</i></a>
            </div>
            
            <div class="card-content">
             
              <a href=""><span class="card-title green-text" style="height: 50px">{{$petition->title}}</span></a><br>
              <p class="white-text" style="height: 130px">{{substr($petition->message, 0, 100)}}</p>
              <a href="{{route('petition.show', $petition->id)}}" class="green-text">View Article</a>
            </div>
          </div>
          </a>
        </div> 
          @endif
     @endforeach
      </div>


    </div>
  </div>
</div>
<!--FOOTER-->
@include('frontend.layout.footer')
<script type="text/javascript">
  $('#searchMe').on('keyup',function(){
  $text=$(this).val();

  $.ajax({
 
type : 'get', 
url : '{{route("searchMe")}}',
data:{'search':$text},
 
success:function(data){
 
$('tbody').html(data);
 
}
 
});
})  
</script>

<script type="text/javascript">
 
$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
 
</script>

</body>
</html>