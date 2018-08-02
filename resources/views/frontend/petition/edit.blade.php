<!DOCTYPE html>
<html>
@include('frontend.layout.header')

      <link rel="stylesheet" href="https://www.ipetitions.com/assets/v3/css/style.css?dashboard" media="all">

      <link href="https://fonts.googleapis.com/css?family=Raleway:400,500,700" rel="stylesheet">


<!--END OF NAVBAR-->

<div class="wrapper">  
<h1 class="pagetitle">{{$petition->title}}</h1>
<a href="{{route('petition.show', $petition->id)}}" class="viewpet" target="blank">View Petition</a>
<a href="{{route('pet')}}" class="viewback">Back to Dashboard</a>
<div id="peteditnav">
  <ul id="my-tab-menu">
    <li > 
      <a id="signatures" href="{{route('petition.edit', $petition->id)}}">Signatures</a></li>
    <li class="active"><a id="edit" style="background: #fff" href="{{route('petEdit', $petition->id)}}">Edit Petition</a></li>
    <li class="petition-share-tab"><a href="#" id="tab-share-for-success">Share for Success!</a></li>
    </ul>
   
</div>

<div class="content edit-petition" id="my-content">
  <div class="description open">
  <h1>Edit Petition</h1>


  <div class="form">
  <form id="questionnaires-form" action="{{route('p.update', $petition->id)}}" method="POST">
 {{ csrf_field() }}
          <div class="row">
              <div class="input-field col s6">
                <i class="material-icons prefix">mode_edit</i>
                <input name="title" required="required" placeholder="Something catchy and not too long" id="icon_prefix" value="{{$petition->title}}" type="text" class="validate">
                <label for="icon_prefix" style="font-size: 17px">Petition Title</label>
              </div>
            </div>

          <div class="row">
              <div class="input-field col s6">
               <i class="material-icons prefix">sms</i>
               
                 <textarea name="message" id="textarea1" class="materialize-textarea validate" >{{$petition->message}}</textarea>
                <label for="textarea1" style="font-size: 17px">Message</label>
              </div>
            </div>   
           

 
    <div class="row">
              <div class="input-field col s6">
                  <i class="material-icons prefix">add_to_photos</i>
                 <div id="image_verify" style="height: auto;margin-left: 40px">
               <img alt="" id="test" src="{{asset('/')}}storage/app/{{$petition->avatar}}" style="height:200px;width: 400px" alt="loading">
             </div>
              <input type="file" onchange="readURL(this);" id="fileBrowser" name="avatar" accept="image/*">

              </div>
  
         
            </div>  
    
        
       <div class="row">
       
          <div id="file_upload">
      

       <div id="upload_drop_image">

          
       </div>
          </div>
          </div>

   <!-- row -->
    <div class="row savebtn">
      <input id="js-save-petition-delayed-image" type="submit" name="yt0" value="Save Petition">    
          </div>

        </form>
  </div><!-- form -->
  </div>
</div>    </div>
<!--PARALAX SECTION-->
<br>


<!--FOOTER-->
<!-- footer -->
 @include('frontend.layout.footer')

 <script type="text/javascript">
   function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
        $('#test').attr('src', e.target.result);
       }
        reader.readAsDataURL(input.files[0]);
       }
    }
</script>
</body>
</html>