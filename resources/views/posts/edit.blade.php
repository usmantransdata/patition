<!DOCTYPE html>
<html lang="en">
  @include('layout.header')
  @include('layout.sidebar')

  <body class="no-skin">
          <div class="main-container" id="main-container">
            <script type="text/javascript">
              try{ace.settings.check('main-container' , 'fixed')}catch(e){}
            </script>
              <div class="page-content">
                <div class="page-content-area">
                  <div class="page-header">
                   <h1>Edit Post</h1>
                  </div><!-- /.page-header -->
                  <div class="row">
                    <div class="col-xs-12">


             <div class="row">

              <div class="col-md-12 ">

                  <h1>Edit Post</h1>
                  <hr>
                      {{ Form::model($posts, array('route' => array('posts.update', $posts->id), 'method' => 'PUT')) }}
                      <div class="row">
                        <div class="col-md-12" >
                         
                       
                           <div class="form-group col-lg-offset-1">
                              <span style="font-weight: bolder;">Status&nbsp;<i class="fa fa-arrow-right" aria-hidden="true"></i>&nbsp;&nbsp;</span>
                               <a href="" class="show_hide">
                             <input type="text" readonly name="status" value="{{$posts->post_status}}" style="border:none;width:10%" id="input">
                             Edit</a>
                              
                                <div class="editDiv" style="margin-left:55px;display:none;width:200px;">
                                    <select style="width: 100px" class="dropdown">
                                        <option>Draft</option>
                                        <option>Pending for Review</option>
                                        <option>Trash</option>
                                         @if (auth()->user()->isAdmin())
                                        <option>Publish</option>
                                        @endif
                                    </select>
                                    <input type="button" name="ok" value="OK">
                                   <a href="#" class="hide">Cancel</a>
                                </div>
                              
                          </div>
                      
                         
                           <div class="form-group col-lg-offset-10">
                            <input type="submit" name="update" value="Update" class="btn-primary btn-info"> 
                          </div>
                         
                        </div> 

                      </div>
                      
                   

                     
                      <div class="form-group">
                         <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label name="title">Select Category</label><br />
                          <select readonly multiple class="form-control" name="category[]" id="sel2">
                          @foreach($arr as $category)
                            <option  value="{{$category}}">{{$category}}</option>
                            @endforeach
                        </select> 

                      </div>
                      {{ Form::label('title', 'Title') }}
                      {{ Form::text('title', null, array('class' => 'form-control')) }}<br>

                      {{ Form::label('body', 'Post Body') }}
                      {{ Form::textarea('body', null, array('class' => 'form-control')) }}<br>

                    
                      {{ Form::close() }}
              </div>
              </div>
          </div>
             
      
                    </div><!-- /.col -->
                  </div><!-- /.row -->
                </div><!-- /.page-content-area -->
              </div><!-- /.page-content -->
            </div><!-- /.main-content -->

@include('layout.footer')


<script>
$(document).ready(function(){
 
$('.show_hide').mouseenter(function(){
$(".editDiv").show();
});

$('.editDiv').mouseleave(function(){
$(".editDiv").fadeOut();



$('.dropdown').change(function() {
        var x = $(this).val();
        $('#input').val(x);
    });
});



});
</script>
<script>
</script>
</html>

