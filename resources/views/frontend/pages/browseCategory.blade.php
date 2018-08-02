<!DOCTYPE html>
<html>
@include('frontend.layout.header')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!--END OF NAVBAR-->
<section>
  <img src="{{asset('/')}}public/frontend/images/about.jpg" style="width: 100%; height: 350px;"> 
  <!-- filter: blur(3px); -->
  <h2 class="white-text" style="background-color:#00000099;opacity: 0.8; position: absolute; top:180px; left: 0; width:100%; text-align: center;"><strong>{{$cat->name}}</strong><strong class="green-text"> Petitions</strong></h2>
</section>

<br><br>
<!--RANDOM CONTENT-->
<div class="container content">
  <div class="section">
    <div class="row ">
      <div class="col s12 center">
        <h4>We like The Way You Think</h4>
        <p style="font-size: 17px">Finally, it's important to remember that you've got one of the most powerful activism tools ever invented- the Internet- at your disposal. You may wonder if your voice will ever be heard. But online petitions are special precisely because they allow everyone to have a voice.</p>
      </div>
    </div>
    <center>
      <a href="{{route('petition.index')}}">
        <button class="waves-effect waves-green btn-flat N/A transparent black-text" style="border:2px solid black;">Start Petition</button>
      </a>
      </center>
  </div>
</div>
<!--END OF CONTENT-->
<br><br>
<div class="container">
  <div class="row">
    <div class="col s8" style="border-top: 3px solid #4CAF50;">
      <h5><b class="green-text">Recent</b> Social Petitions</h5>
    </div>
    <div class="col s4" style="border-top: 3px solid #4CAF50;">
      <h5><b class="green-text">Top</b> Categories</h5>
    </div>
    <div class="col m8">
      <br>  
      <!-- Card 1 -->
      @foreach($petitions as $petition)

      <div class="card horizontal hoverable" style="height: 230px;">
        <div class="card-image">
          <img src="{{asset('/')}}/storage/app/{{$petition->avatar}}" style="height: 230px; width: 200px">
        </div>
        <div class="card-stacked">
          <div class="card-content">
            <p class="green-text" style="font-size: 22px;"><strong>{{$petition->title}}</strong></p>
            <p style="height: 100px">{{substr($petition->message, 0, 75)}}</p>
          
            <div class="chip green lighten-2 hoverable black-text">
              <i class="fa fa-thumbs-up black-text" aria-hidden="true"></i>
              120
            </div>
            <div class="chip green lighten-2 hoverable black-text">
              <i class="fa fa-comments black-text" aria-hidden="true"></i>
              139
            </div>
            <div class="chip green lighten-2 hoverable black-text">
              <i class="fa fa-handshake-o black-text" aria-hidden="true"></i>
              100
            </div>
             <div class="right chip blue-grey darken-4 hoverable white-text">
              <i class="fa fa-handshake-o white-text" aria-hidden="true"></i>
              Sign
            </div>
          </div>
        </div>

      </div>
      @endforeach
<!-- End Card 1 -->
       
            
    </div>
    <div class="col m4">
      <br>
    
      </div>
  </div>
</div>

<!--FOOTER-->
@include('frontend.layout.footer')
</body>
</html>