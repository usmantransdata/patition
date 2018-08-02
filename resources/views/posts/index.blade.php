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
            <div class="main-content">
            <div class="page-content">
              <div class="page-content-area">

                <div class="row">
                  <div class="col-xs-12">
              
                        <form method="post" action="{{ route('posts.action')}}">
                            {{csrf_field()}}
                    <div>

                      <div class="col-xs-8" style="margin-top: 28px;margin-left: -12px">
                        @if (auth()->user()->isAdmin())

                          <select name="select">
                            <option  >Bulk Actions</option>
                            <option value="approved">Approved</option>
                            <option value="unapproved">Unapproved</option>
                            <option value="trash">Move To Trash</option>
                          </select>
                          <input type="submit" id="doaction" class="button action" value="Apply">
                            @endif
                          <span style="margin-left: 10px"></span>
                         
                           <a href="#" id="all" class="filter">All</a>
                           <span>|</span>
                            <a href="#" id="mine">Mine</a>
                            <input type="hidden" value="{{Auth::user()->name}}" id="m" >
                           <span>|</span>
                          <a href="#" id="publish">Published</a>
                           <input type="hidden" value="publish" id="p">
                            <span>|</span>
                           <a href="#" id="draft">Drafts</a>
                           <input type="hidden" id="d" value="draft">
                            <span>|</span>
                          <a href="#" id="pending">Pendings</a>
                           <input type="hidden" id="pend" value="Pending for Review">
                         
                          
                             <span>|</span>
                           <a href="#" id="trash" style="color:red">Trash</a>
                           <input type="hidden" id="t" value="trash">
                          
                           </div> 
                         
                     
                          <div class="col-xs-offset-10" style="margin-bottom: 15px;">
                          <a href="{{route('posts.create')}}">
                            <input class="btn btn-info" type="button" name="add" value="Add New Post">
                          </a>
                        </div> 

                    </div>
                    <!-- <div class="table-responsive"> -->

                    <!-- <div class="dataTables_borderWrap"> -->
                    <div>

                      <table id="sample-table-2" class="table table-striped table-bordered table-hover">

                        <thead>
                          <tr>

                            <th class="center">
                              <label class="position-relative">
                                <input type="checkbox" class="ace" />
                                <span class="lbl"></span>
                              </label>
                            </th>
                            <th>Title</th>
                            <th>Author</th>
                          <!--  <th class="hidden-480">Categories</th> -->

                            <th>Comments</th>
                            <th>Tags</th>
                            <th class="hidden-480">Created at</th>
                            <th>Post Status </th>
                             <th></th>
                          </tr>
                        </thead>

                        <tbody>
                          <tr>
                            @foreach ($posts as $key => $post)
                            <td class="center">
                              <label class="position-relative">
                                <input type="checkbox" class="ace" value="{{$post->id}}" name="posts[]" />
                                <span class="lbl"></span>
                              </label>
                            </td>
                        @if ($post->post_status == 'Pending for Review')
                            <td>
                               <a style="color:#f89406;font-weight: bold" href="{{route('posts.edit', $post->id)}}" >{{ $post->title }}</a>&nbsp;&nbsp;&nbsp;
                               <span><i class="fa fa-hand-o-right" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;wait for admin review</span>
                            </td>
                             @elseif ($post->post_status == 'Trash')
                              <td>
                               <a style="color:red;font-weight: bold" href="{{route('posts.edit', $post->id)}}" >{{ $post->title }}</a>&nbsp;&nbsp;&nbsp;
                               <span><i class="fa fa-hand-o-right" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;<strong>Trashd</strong></span>
                            </td>
                            @elseif ($post->post_status == 'Draft')
                              <td>
                               <a style="color:#777;font-weight: bold" href="{{route('posts.edit', $post->id)}}" >{{ $post->title }}</a>&nbsp;&nbsp;&nbsp;
                               <span ><i class="fa fa-hand-o-right" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;<strong>Draft</strong> </span>
                            </td>
                            @else


                            <td><a style="font-weight: bold;" href="{{route('posts.edit', $post->id)}}" >{{ $post->title }}</a></td>
                             @endif
                            <td class="hidden-480">{{$post->users->first()['name']}}</td>
                        
                            <td class="hidden-480">
                              @if($post->comments->first()['comments_approved'] == '0')
                                <a href="{{route('comments.index')}}" style="color: red;">
                                     <i class="ace-icon fa fa-comments"></i>
                               {{$cmmnts[$key]}}</a>
                               @else
                                <a href="{{route('comments.index')}}">
                                     <i class="ace-icon fa fa-comments"></i>
                               {{$cmmnts[$key]}}</a>
                               @endif
                            </td>
                            <td>{{$post->tags}}</td>
                            <td>{{$post->created_at}}</td>  
                          <td>   @if($post->post_status == 'Pending for Review')
                              <span class="label label-sm label-warning">{{$post->post_status}}</span>
                              @elseif($post->post_status == 'Draft')
                              <span class="label label-sm label-primary ">{{$post->post_status}}</span>
                              @elseif ($post->post_status == 'Trash')
                              <span class="label label-sm label-danger">{{$post->post_status}}</span>
                              @else
                              <span class="label label-sm label-success">{{$post->post_status}}</span>
                              
                              @endif</td>  

                         <td>
                              <div class="hidden-sm hidden-xs action-buttons">
                              <a href="{{route('posts.edit', $post->id)}}" style="margin-right:10px;" >
                                  <i class="ace-icon fa fa-pencil bigger-130"></i>
                                </a>

                               <a href="{{route('posts.show', $post->id)}}" style="margin-right:10px;" ><span class="fa fa-eye" aria-hidden="true"></span></a>
                              </div>
                         </td>

                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </form>
                  </div>
                </div>
           

                </div>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.page-content-area -->
        </div><!-- /.page-content -->
      </div><!-- /.main-content -->
     

              </div><!-- /.page-content -->
            </div><!-- /.main-content -->

@include('layout.footer')


    <!-- page specific plugin scripts -->
    <script src="{{ asset('/') }}public/aceadmin/assets/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('/') }}public/aceadmin/assets/js/jquery.dataTables.bootstrap.js"></script>

<script>

  jQuery(function($) {
        var oTable1 = 
        $('#sample-table-2').dataTable();
        
      
        $(document).on('click', 'th input:checkbox' , function(){
          var that = this;
          $(this).closest('table').find('tr > td:first-child input:checkbox')
          .each(function(){
            this.checked = that.checked;
            $(this).closest('tr').toggleClass('selected');
          });
        });
      
      
        $('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
        function tooltip_placement(context, source) {
          var $source = $(source);
          var $parent = $source.closest('table')
          var off1 = $parent.offset();
          var w1 = $parent.width();
      
          var off2 = $source.offset();
          //var w2 = $source.width();
      
          if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
          return 'left';
        }


        jQuery(function($) {
$("#all").click(function() {
    oTable1.fnFilter('');
  });

  $("#mine").click(function() {
   var val =  $("#m").val();
        // oTable1.search("h").draw();
     oTable1.fnFilter(val);
  });

  $("#publish").click(function() {
    var val =  $("#p").val();
     oTable1.fnFilter(val);
  });

  $("#draft").click(function() {
    var val =  $("#d").val();
     oTable1.fnFilter(val);
  });

  $("#pending").click(function() {
    var val =  $("#pend").val();
     oTable1.fnFilter(val);
  });

   $("#trash").click(function() {
    var val =  $("#t").val();
     oTable1.fnFilter(val);
  });

 });
      
      });

</script>
  </body>
</html>

