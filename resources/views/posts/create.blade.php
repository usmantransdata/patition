<!DOCTYPE html>
<html lang="en">
  <head>
  @include('layout.header')
  @include('layout.sidebar')

 <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.css" rel="stylesheet">
 <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-tagsinput/1.3.6/jquery.tagsinput.min.css" rel="stylesheet">
   
</head>


  <body class="no-skin">
          <div class="main-container" id="main-container">
            <script type="text/javascript">
              try{ace.settings.check('main-container' , 'fixed')}catch(e){}
            </script>
              <div class="page-content">
                <div class="page-content-area">
                  <div class="page-header">
                    <h1>
                      Create New Post
                      
                    </h1>
                    
                  </div><!-- /.page-header -->
                  <div class="row">
                    <div class="col-xs-12">



         <div class="row">
              <div class="col-md-12">

              <h1>Create New Post</h1>
              <hr>
               
          {{-- Using the Laravel HTML Form Collective to create our form --}}
              {{ Form::open(array('route' => 'posts.store')) }}

              <div class="form-group">
                  <div class="form-group">
                    
                   @if (auth()->check())
         @if (auth()->user()->isAdmin())
                    
                    <label>Save As</label>
                      <select name="post">
                          <option>Publish</option>
                           <option>Draft</option>
                      </select>
                 @else
        
                  <label>Save As</label>
                      <select name="post">
                          <option>Draft</option>
                          <option>Pending for Review</option>
                      </select>

                         @endif
                @endif
                            
                  </div>

              </div>
              <div class="form-group">

                 <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                    <label name="title">Select Category</label><br />
                      <select multiple class="form-control" name="category[]" id="sel2">
                      @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select> 

                </div>


                  <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                  <label name="title">Title</label>
                  <input type="text" name="title" class="form-control">
                        @if ($errors->has('title'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                       @endif
                </div>
                  <br>
                   <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                  <label name="body">Post Body</label>
                   <textarea class="form-control summernote" id="textarea" name="template"></textarea>
                    @if ($errors->has('body'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('body') }}</strong>
                                          </span>
                         @endif
                  </div>

                  <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-tags">Add Tags</label>

                  
                        <div style="width: 500px; margin: 0px auto;">
                        <input name="tags" id="input-tags" style="width:500px !important" />
                      </div>
                    

                  </div>
                  <br>
                  <br>
                  <br>


                  <input type="submit" name="publish" value="Save" class="btn btn-info btn-lg btn-block">
                  
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-tagsinput/1.3.6/jquery.tagsinput.min.js"></script>
<script type="text/javascript">
  $('#input-tags').tagsInput();
</script>

<script>

var $input = $('#textarea');
var $button = $('#start_button');

setInterval(function(){
    if($input.val().length > 40){
      
        $button.attr('disabled', false);
        $button.text('Creat Email Template');
        
    }else{
        $button.attr('disabled', true);
        
        
    }
});
  </script>
  </body>
</html>



