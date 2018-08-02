<!DOCTYPE html>
<html>
  @include('layout.header')
  @include('layout.sidebar')
  <!-- Content Wrapper. Contains page content -->

  <body class="no-skin">
          <div class="main-container" id="main-container">
                <script type="text/javascript">
                  try{ace.settings.check('main-container' , 'fixed')}catch(e){}
                </script>


              <div class="page-content">
                <div class="page-content-area">

                      <div class="page-header">
                        <h1>
                          Email Templates
                          <small>
                            <i class="ace-icon fa fa-angle-double-right"></i>
                            Edit, View &amp; Delete
                          </small>
                        </h1>
                      </div><!-- /.page-header -->

                        <div class="col-xs-offset-10" style="margin-bottom: 15px;">
                          <a href="{{route('create-email-template')}}">
                            <input class="btn btn-info" type="button" name="add" value="Add New Template">
                          </a>
                        </div> 

                  <div class="row">
                    <div class="col-xs-12">
                       <div class="content-wrapper">
                         <div style="margin-top: 50px">     
                <table id="sample-table-2" class="table table-striped table-bordered table-hover" >
                  <thead>
                    <tr>

                              <th class="center">
                                <label class="position-relative">
                                   
                                  <input type="checkbox" class="ace" name="checkbox-top" />

                                  <span class="lbl"></span> 
                                 
                                </label>
                              </th>
                      <th>Title</th>
                      <th>Subject</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                  	@foreach($templates as $template)
                    <tr>
                         <td class="center">
                                <label class="position-relative">
                                  
                                  <input type="checkbox" class="ace" value="" name="input[]" />
                                  <span class="lbl"></span>
                                  
                                </label>
                              </td>
                      <td>{{$template->title}}</td>
                      <td>{{$template->subject}}</td>
                      <td>
                      	<a href="{{route('email-edit', $template->id)}}" style="margin-right:10px;" ><span class="fa fa-pencil-square-o" aria-hidden="true"></span></a>

              			<a href="{{route('email-view', $template->id)}}" style="margin-right:10px;" ><span class="fa fa-eye" aria-hidden="true"></span></a></button>

                      <!--	<a href="{{route('email-del')}}" ><span class="fa fa-trash-o" aria-hidden="true"></span></a>
                      -->
                    </td>
                     </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>

@include('layout.footer')

<script src="{{ asset('/') }}public/aceadmin/assets/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('/') }}public/aceadmin/assets/js/jquery.dataTables.bootstrap.js"></script>

<script >
   jQuery(function($) {
        var oTable1 = 
        $('#sample-table-2').dataTable();
});

    $(document).on('click', 'th input:checkbox' , function(){
          var that = this;
          $(this).closest('table').find('tr > td:first-child input:checkbox')
          .each(function(){
            this.checked = that.checked;
            $(this).closest('tr').toggleClass('selected');
          });
        });
</script>
  </body>
</html>
