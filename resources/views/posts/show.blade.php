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
                   <h1>{{ $post->title }}</h1>
                   <div style="margin-top:15px;">
                      @if (auth()->check())
         @if (auth()->user()->isAdmin())
           
                    {!! Form::open(['method' => 'DELETE', 'route' => ['posts.destroy', $post->id] ]) !!}
                    <a href="{{ url()->previous() }}" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
                    @can('Edit Post')
                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-info" role="button"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                    @endcan
                    @can('Delete Post')
                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i>
                    </button>
                    @endcan
                    {!! Form::close() !!}
                </div>

     @endif
@endif
</div>
                   
                  </div><!-- /.page-header -->

                  <div class="row">
                    <div class="col-xs-12">
                       <div class="form-group col-lg-offset-0">
                              <span style="font-weight: bolder;">Status&nbsp;<i class="fa fa-arrow-right" aria-hidden="true"></i>&nbsp;&nbsp;</span>
                            
                          
                          @if ($post->post_status == 'Pending for Review')
                            <span style="color:red;font-weight: bolder">{{$post->post_status}}</span>  
                            @else
                            <span><strong>{{$post->post_status}}</strong></span>
                            @endif
                              
                          </div>
                      
          <div class="container">
             <select readonly multiple class="form-control" name="category[]">
                   @foreach($posts as $pos)

                      <option value="{{$pos->id}}">{{$pos->name}}</option>
                     @endforeach
              </select> 
              <h1>{{ $post->title }}</h1>
              <hr>
              <p class="lead">{{ $post->body }} </p>
              <hr>
           
   </div><!-- /.col -->
    
   <div class="row">
    <div class="col-md-8 col-md-offset-0">
      
      @foreach($commnts as $commnt)
@if ($commnt->comments_approved == 1)
      <div class="comment" style="border-radius: 0!important;;">
       <p><strong>{{$commnt->user_email}}</strong> </p>
       <p> {{$commnt->comment}}</p>
      </div>
@endif      
        @endforeach
    </div>
  </div>
    @if ($post->post_status == 'Pending for Review')
    <div></div>

  @else
            <div class="row">
              <div id="comment-form">
              <span><h2>Leave a Reply</h2></span><br>
              @guest
                <input type="email" name="email" value="Email">
              @else
              <span style="color: green">Login As {{ Auth::user()->name}}</span><br>

              <span > <a style="color: red;" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout</a></span>
              @endguest
            <form action="{{ route('cmmnts.store', $post->id) }}" method="POST">
               {{ csrf_field() }}
                  <div>
            <textarea name="comments" id="comments" cols="50" rows="5" style="font-family:sans-serif;font-size:1.2em;"></textarea>
                  </div>
                  <input type="submit" class="btn-primary" value="Submit">
                  </form>
               </div>
             </div>  
@endif

                  </div><!-- /.row -->

                </div><!-- /.page-content-area -->
              </div><!-- /.page-content -->
            </div><!-- /.main-content -->

@include('layout.footer')
  </body>
</html>
