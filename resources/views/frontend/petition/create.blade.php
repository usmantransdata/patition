<!DOCTYPE html>
<html>
@include('frontend.layout.header')
<!--END OF NAVBAR-->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet"/>

  <link rel="stylesheet" href="http://demo.itsolutionstuff.com/plugin/croppie.css">


  <meta name="csrf-token" content="{{ csrf_token() }}">
<!--PARALAX SECTION-->
<br>
<div class="container" style="padding-top: 120px">

  <div class="row">
      <div class="row">
        <div class="col s12">
          <h3>Create a Petition</h3>
          <p>Create a powerful online petition in just minutes. Our system is flexible, customizable, and easy to use. Best of all, it's free!
          Start by filling out this form, and in a few minutes you'll be ready to collect thousands of signatures.</p>
        </div>
      </div>
      <!--  -->
    <form class="col s12" method="POST" action="{{ route('petition.store') }}" enctype="multipart/form-data" id="form">
        {{ csrf_field() }}
          <div class="row">
              <div class="input-field col s6">
                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                <i class="material-icons prefix">mode_edit</i>
                <input name="title" value="{{ old('title') }}" required="required" placeholder="Something catchy and not too long" id="title" type="text" class="validate">
                <label for="title" style="font-size: 17px">Petition Title<span style="color: red">*</span></label>
                  @if ($errors->has('title'))
                  <span class="help-block">
                      <strong>{{ $errors->first('title') }}</strong>
                  </span>
              @endif
            </div>
              </div>
            </div>

             <div class="row">
              <div class="input-field col s6">
                 <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                <i class="material-icons prefix">sms</i>
               
                 <textarea style="padding: .8rem 0px 0px" name="description" id="textarea1" class="materialize-textarea validate" placeholder="Fully explain what is going on ?"></textarea>
                <label for="textarea1" style="font-size: 17px">Message<span style="color: red;size: 20px">*</span></label>
                 @if ($errors->has('description'))
                  <span class="help-block">
                      <strong>{{ $errors->first('description') }}</strong>
                  </span>
              @endif
            </div>
              </div>
            </div>

          <div class="row">
                 <div class="input-field col s6" >
                   <i class="material-icons prefix">wc</i>
                <!--  <select multiple name="tag_list[]" id="dec" class="select">
                     <option value="" disabled selected>Chose Decision Maker</option>
                   </select> -->
                  
                  <select multiple name="tag_list[]" id="decisionmaker" >
                    <option value="" disabled selected>Chose Decision Maker</option>
                      @foreach($decision_maker as $decision) 
                          <option value="{{$decision->id}}">{{$decision->company}}</option>
                      @endforeach 
                   </select>  
                
                 <span class="pull-right">
                  <i class="fa fa-plus-square" aria-hidden="true"></i>&nbsp;
                  <a  class="waves-effect waves-light modal-trigger" href="#modal1">add new decision Maker</a>
                </span>

               <!--  <select style="outline: none" id="tag_list" name="tag_list[]"></select> --> 
                 </div>
            </div>
        
            <br>
              <div class="row">
             
                <div class="input-field col s6">
                   <i class="material-icons prefix">filter_list</i>
                  <select multiple name="categories[]" id="decisionmaker">
                      <option value="" disabled selected>Chose categories</option>
                      @foreach($category as $cat) 
                          <option value="{{$cat->id}}">{{$cat->name}}</option>
                      @endforeach
                      </select>
                     
                </div>     
              </div>
     <br>
              <div class="row">
             
                <div class="input-field col s6">
                   <i class="material-icons prefix">add_circle</i>
                  <select multiple name="survey[]">
                      <option value="" disabled selected>Add survey to this petition</option>
                      @foreach($survey as $survey) 
                          <option value="{{$survey->id}}">{{$survey->title}}</option>
                      @endforeach
                      </select>
                         <span class="pull-right">
                  <i class="fa fa-plus-square" aria-hidden="true"></i>&nbsp;
                  <a  class="waves-effect waves-light modal-trigger" href="#surveyModel">add new survey</a>
                </span>
                  </div>     
              </div>

            <div class = "row">
              <div class="col s6">
               
                <input type="hidden" name="avatar" id="crop" value=
                "">
                <div id="browse" class="col-md-6 text-center" style="display: none">
                  <div id="upload-demo" style="width:350px"></div>
                 </div>
                  <div class="col-md-6">
                   
                <label style="font-size: 17px">Upload Relevent Image</label>
                <div class = "file-field input-field"> 
                   <div class = "waves-effect waves-green btn-flat N/A transparent black-text"
                    style="border:2px solid black;">
                      <span>Browse</span>
                      <input class="image" type="file" id="upload">
                   </div>
                </div>
             </div>  
            </div>
         
      </div>
            <div class="row">
              <div class="col s12">
                <button type="button" class="cropandsubmit btn-flat waves-effect waves-light green lighten-2 black-text" name="petition">Create Petition</button>
              </div>
            </div>
    </form>
  </div>
</div>
  <!--model window for add decision maker -->
  <form id="button" method="post">
    {{ csrf_field() }}
<div id="modal1" class="modal">
  <br>
  <div class="container" id="decision" >
       <div class="row">
              <div class="input-field col s8">
                <i class="material-icons prefix">mode_edit</i>
                <input name="tag_list" id="tag_list" required="required" placeholder="Add new decision maker (company name or person name)" id="icon_prefix" type="text" class="validate">
                <label for="icon_prefix" style="font-size: 17px">Decision Maker</label>
              </div>
            </div>
      <div class="modal-footer">
        <button class="btn waves-effect waves-light">Save</button>
      </div>
    </div>
</div>
</form>
<!--model end for decision maker -->

<!-- survey model start from here -->
<div id="surveyModel" class="modal bottom-sheet" >

<div class="container">
  <div class="row">
      <div class="col m12">
          <div class="card hoverable">
        <div class="card-content black-text">
          <span class="card-title black-text">Easily Create, Send And Analyze Surveys
          </span>
          <p>Finally, it's important to remember that you've got one of the most powerful activism tools ever invented.<br>Now Easily Create, Send And Analyze Surveys</p>
        </div>
      </div>
      <br><br>
         <form class="col m12" id="publish" method="POST" enctype="multipart/form-data">
          {{csrf_field()}}
         <div class="row">
             
          <input type="hidden" name="petition_last_id" value="">
                <div class="col m8">
                  <input type="text" placeholder="Survey Title" name="title" >
                 </div>
                 <div class="col m6">
                  <input type="text" placeholder="Question" name="question" >
                 </div>
                <div class="col m6" style="margin-top: 20px">
                 <select id="selectBox" style="width: 150px;">
                  <option>Chose Survey</option>
                   <!--  <option value="short" data-icon="fa-sort-amount-desc">Short Answer</option>
                     <option value="paragraph" data-icon="fa-paragraph">Paragraph</option> -->
                     <option value="multi" >Multi Choice</option>
                    </select>
                
                 </div>

              <div id="outputArea"></div>

          </div>
      </div>

       <div class="modal-footer">
         <div class="col m6 pull-right">
          <a href="#">
            <button class="waves-effect waves-green btn-flat N/A transparent black-text" style="border:2px solid black;">Publish</button>
          </a>
        </div>
      </div>
 </form>
</div>
</div>
</div>
<!--survey model end here -->

<!--FOOTER-->
<!-- footer -->
 @include('frontend.layout.footer')
<!-- js here -->
   <!--  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-tagsinput/1.3.6/jquery.tagsinput.min.js"></script> -->
   
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script src="http://demo.itsolutionstuff.com/plugin/croppie.js"></script>



<script type="text/javascript">
 $("#selectBox").change(function() {
  var htmlString = "";
  var len = $(this).val();
  if(len == 'short'){
    htmlString += "<input type='text' name='short' readonly class='validate' placeholder='Short answer text'>";
  }
  if(len == 'paragraph'){
    htmlString += "<textarea readonly type='text' name='paragraph' class='materialize-textarea' placeholder='Long answer text'></textarea>";
      }
    if(len == 'multi'){
        htmlString += '<div id="field" class="input_fields_wrap col m8"><input class="input" id="field1" name="option[]" type="text"/></div><div id="field2" class="col m4" style="margin-top:20px"><input type="button" onclick="myFunction()"class="btn add-more"  value="+">';
    }
  $("#outputArea").html(htmlString);
});
$(document).ready(function() {
  
  

  $.ajaxSetup({
headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});
    $('#button').submit(function(e){
    e.preventDefault(); 
    $.ajax({
    url: '{{route("addDecisionMaker")}}',
    type: 'POST',
    data: $(this).serialize(), // it will serialize the form data
    dataType: 'html',
    cache: false,
    success: function(data){
             $("#modal1").modal('close');
    var arr = JSON.parse(data);
    if(arr){
          
      $('.dropdown-content').append("<li class id="+ arr.id+"><span><input type='checkbox'><label></label>"+ arr.company+"</span></li>");
                 $('#decisionmaker').append("<option value="+ arr.id+">"+ arr.company+"</option>"); 
                 
                }
     
        },        
    })
});

    $('#publish').submit(function(e){
    e.preventDefault(); 
    $.ajax({
    url: '{{ route("survey-create") }}',
    type: 'POST',
    data: $(this).serialize(), // it will serialize the form data
    dataType: 'html',
    cache: false,
    success: function(data){
             $("#surveyModel").modal('close');
        },        
    })
});



  function iformat(icon) {
    var originalOption = icon.element;
    return $('<span><i class="fa ' + $(originalOption).data('icon') + '"></i> ' + icon.text + '</span>');
}
  $("#selectBox").select2({
     templateSelection: iformat,
    templateResult: iformat,
    allowHtml: true
  });
});
</script>
<script type="text/javascript">
 $('.image').click(function(){
$("#browse").show();
 });
$.ajaxSetup({
headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});


$uploadCrop = $('#upload-demo').croppie({
    enableExif: true,
    viewport: {
        width: 300,
        height: 300,
        //type: 'circle'
    },
    boundary: {
        width: 400,
        height: 400
    }
});

$('#upload').on('change', function () { 
  var reader = new FileReader();
    reader.onload = function (e) {
      $uploadCrop.croppie('bind', {
        url: e.target.result
      }).then(function(){
        console.log('jQuery bind complete');
      });
    }
    reader.readAsDataURL(this.files[0]);
});

$('.cropandsubmit').on('click', function (ev) {
if( $('#upload').val().length != 0 ) {
  $uploadCrop.croppie('result', {
    type: 'canvas',
    size: 'viewport'
  }).then(function (resp) {
    $.ajax({
      url: "{{route('petition.image')}}",
      type: "POST",
      data: {"image":resp},
      success: function (data) {
          $("#crop").val(data);
          $("#form").submit();
        //html = '<img src="' + resp + '" />';
        //$("#upload-demo-i").html(html);
       
      }
    });
  });
}else{
  $("#form").submit();
 // $('#error').show();
}
});
</script>

<script>
</script>

<script type="text/javascript">
 $(document).ready(function () {
  $('.modal').modal();
        $('select').material_select();
    });  
</script>
<!-- 
 <script type="text/javascript">
  $('#tag_list').select2({
    tags: true,
    placeholder: "Decision Maker",
    ajax: {
        url: '{{route("/find")}}',
        dataType: 'json',
        data: function (params) {
            return {
                q: $.trim(params.term)
            };
        },
        processResults: function (data) {
            return {
                results: data
            };
        },
        cache: true
    }
});
</script> -->

<script>
   var max_fields      = 5; //maximum input boxes allowed
  var x = 1;
function myFunction() {
  
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add-more"); //Add button ID
    

        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $('.input').attr("placeholder", "Option");
            $(wrapper).append('<div class="col m12"><input class="input" type="text" name="option[]"/><a href="#" class="remove_field">Remove</a></div>'); //add input box
        } 
$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
}

</script>


</body>
</html>