<!DOCTYPE html>
<html lang="en">
  @include('layout.header')
  @include('layout.sidebar')

  @if (session('status'))
                      <div class="alert alert-success">
                          {{ session('status') }}
                      </div>
@endif
  <body class="no-skin">
          <div class="main-container" id="main-container">
            <script type="text/javascript">
              try{ace.settings.check('main-container' , 'fixed')}catch(e){}
            </script>
              <div class="page-content">
                <div class="page-content-area">
                  <div class="page-header">
                    <h1>
                     User Administration
                      <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Add Users &amp; Assign Roles
                      </small>
                    </h1>
                  
                  </div><!-- /.page-header -->
                  <div class="row">
                    <div class="col-xs-12">

   
<div class="col-lg-10 col-lg-offset-1">
    <h1><i class="fa fa-users"></i> User Administration <a href="{{ route('roles.index') }}" class="btn btn-default pull-right">Roles</a>
    <a href="{{ route('permissions.index') }}" class="btn btn-default pull-right">Permissions</a></h1>
    <hr>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Date/Time Added</th>
                    <th>User Roles</th>
                    <th>Account Status</th>
                    <th>Operations</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($users as $user)
                <tr>

                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at }}</td>
                  <td>{{  $user->roles()->pluck('name')->implode(' ') }}</td>{{-- Retrieve array of roles associated to a user and convert to string --}}
                  <td>
                      @if ($user->verified == 1)
                      <p>Active</p>
                      @endif
                       @if ($user->verified == 0)
                      <p style="color:red">inactive</p>
                      @endif
                       @if ($user->is_delete == 1)
                      <p style="color:red">deleted</p>
                      @endif
                      @if ($user->is_delete == 1)
                        <a href="{{ route('re-active', $user->id)}}" style="color:#478fcacc">re-active</a>
                      @endif
                  </td>

                   <td>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>


                    <a href="javascript:void(0);" onclick="$(this).find('form').submit();" class="btn btn-danger">
                      <i class="fa fa-trash-o" aria-hidden="true"></i>
                      <form action="{{ route('users.destroy', $user->id) }}" method="post">
                          <input type="hidden" name="_method" value="DELETE">
                          {!! csrf_field() !!}
                      </form>
                  </a>

                  

                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

    <a href="{{ route('users.create') }}" class="btn btn-success">Add User</a>

</div>
 
                    </div><!-- /.col -->
                  </div><!-- /.row -->
                </div><!-- /.page-content-area -->
              </div><!-- /.page-content -->
            </div><!-- /.main-content -->

@include('layout.footer')
  </body>
</html>
