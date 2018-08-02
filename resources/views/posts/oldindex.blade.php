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
                    <h1>
                      All Posts
                      <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                     </small>
                    </h1>
                  </div><!-- /.page-header -->
                  <div class="row">
                    <div class="col-xs-12">
                      
                      


                       <div class="row"  style="margin-top: 20px">
                          <div class="col-md-10" style="margin-left:15px;border: 1px solid">
                           <a href="{{route('search')}}">All</a>
                           <span>|</span>
                           <a href="{{route('search')}}">Mine</a>
                           <span>|</span>
                           <a href="{{route('search')}}">Published</a>
                            <span>|</span>
                           <a href="{{route('search')}}">Drafts</a>
                            <span>|</span>
                           <a href="{{route('search')}}">Pendings</a>
                          </div>
                       </div>
   
           <div class="content-wrapper">
                         <div>     
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th><input type="checkbox" id="checkAll" name="checkme_top"></th>
                     
                      <th>Title</th>
                      <th>Author</th>
                      <th>Categories</th>
                      <th>Comments</th>
                      <th>Created at</th>
                      <th>Post Status </th>
                      <th>Actions</th>

                    </tr>
                  </thead>
                  <tbody>
                 @foreach ($posts as $key => $post)
                    <tr>
                       <td>
                    <input type="checkbox" class="chkme" id="checkItem" name="">
                  </td> 
                      @if ($post->post_status == 'Pending for Review')
                     
                      <td >
                       <a style="color:red;font-weight: bold" href="{{route('posts.edit', $post->id)}}" >{{ $post->title }}</a><span>---wait for admin review</span>
                     </td>
                     @else

                       <td >
                       <a style="font-weight: bold;" href="{{route('posts.edit', $post->id)}}" >{{ $post->title }}</a>
                     </td>
                       @endif
                      <td>
                        
                       {{$post->users->first()['name']}}</td>
                        
                         <td>
                           @foreach($arr as $arrs)
                           {{$arrs}}  
                            @endforeach
                    </td>
                    

                    <td>
                         
                         <a href="{{route('comments.index')}}">
                  <i class="ace-icon fa fa-comments"></i>
                         {{$cmmnts[$key]}}</a>
                       
                  </td>
                     

                      <td>{{$post->created_at}}</td>  
                      <td>{{$post->post_status}}</td>  

                      <td>
                       <a href="{{route('posts.edit', $post->id)}}" style="margin-right:10px;" ><span class="fa fa-pencil-square-o" aria-hidden="true"></span></a>

                    <a href="{{route('posts.show', $post->id)}}" style="margin-right:10px;" ><span class="fa fa-eye" aria-hidden="true"></span></a></button>

                      <!--  <a href="{{route('email-del')}}" ><span class="fa fa-trash-o" aria-hidden="true"></span></a>
                      -->
                    </td>
                     </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>

   </div><!-- /.col -->
                  </div><!-- /.row -->
                </div><!-- /.page-content-area -->
              </div><!-- /.page-content -->
            </div><!-- /.main-content -->

@include('layout.footer')

<script>
   $("#checkAll").click(function () {
     $('.chkme').not(this).prop('checked', this.checked);
 });
</script>
  </body>
</html>

