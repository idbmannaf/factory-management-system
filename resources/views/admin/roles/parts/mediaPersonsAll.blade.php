
    <section class="content-header">
      <h1>
        Media Persons
        <small>All</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Media Persons</a></li>
        <li class="active">All</li>
      </ol>
    </section>



    <!-- Main content -->
    <section class="content"> 




<!-- Info boxes -->
      <div class="row">
      <div class="col-md-12">

      @include('alerts.alerts')

        <div class="box box-widget">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-th"></i> All Media Persons</h3>
              <div class="pull-right">
                <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#myModal">Add New Media Person</a>
 

              </div>

              
            </div>

            <div class="box-body">
              <table class="table table-bordered text-center">
          <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Commission (Per User)</th>
              <th>Balance (Tk)</th> 
              <th>Action</th>
            </tr>
          </thead>
          <tbody>

          @foreach($usersAll as $user)
            <tr>
              
              <td>{{$user->user->name}}</td>
              <td>{{$user->user->email}}</td>
              <td>{{ $user->commission }} %</td>
              <td>{{ $user->balance }} Tk</td>
 
              <td>


              

              <div class="btn-group">
                  <!-- <button type="button" class="btn btn-sm btn-warning edit-cat" data-url="">Delete</button> -->
                  <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-warning dropdown-toggle" data-toggle="dropdown">
                     Delete</button>
                    <ul class="dropdown-menu" role="menu">
                      <li>

                      <form class="delete-admin" action="{{route('admin.mediaPersonDelete',$user)}}" method="POST" >
                        {{ csrf_field() }}

                      <button class="btn btn-xs btn-danger">Confirm</button> 
                    </form>
                        

                      </li>

                    </ul>
                  </div>
                </div>





              </td>
            </tr>
          @endforeach
          </tbody>
        </table>
            </div>

            <div class="box-footer text-center">
              {{$usersAll->render()}}
            </div>
        </div>
        
      </div>        
      </div>
      <!-- /.row -->







<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add New Media Person</h4>
      </div>
      <div class="modal-body">
        <div class="box box-widget">
             
            <!-- /.box-header -->
            <!-- form start -->
            <form  class="form-horizontal" method="post" action="{{route('admin.mediaPersonAddNewPost')}}">
            {{csrf_field()}}
              <div class="box-body">

                <div class="row">
                  <div class="col-sm-12">

                    <div class="form-group form-group-sm {{ $errors->has('email') ? ' has-error' : '' }}">
                      <label class="control-label col-sm-4" for="email"> Email  </label>
                      <div class="col-sm-8">
                        <select id="email"
                        name="email"
                        required 
                        class="form-control select2-container step2-select select2"
                        data-placeholder="Name, Email, Usernam, or Mobile Number"
                        data-ajax-url="{{route('admin.selectNewRole')}}"
                        data-ajax-cache="true"
                        data-ajax-dataType="json"
                        data-ajax-delay="200"
                        style="width: 100%;">
                            <option>{{old('email')}}</option>
                          </select>
                        @if ($errors->has('email'))
                        <span class="help-block">
                          <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                      </div>
                    </div>


            <div class="form-group form-group-sm {{ $errors->has('commission') ? ' has-error' : '' }}">
            <label class="control-label col-sm-4" for="commission"> Commission (%)</label>
            <div class="col-sm-8">
              <input type="number" min="0" max="100" step="1" name="commission" value="{{old('commission')}}" class="form-control"
               placeholder="  Commission">
              @if ($errors->has('commission'))
              <span class="help-block">
                <strong>{{ $errors->first('commission') }}</strong>
              </span>
              @endif
            </div>
          </div>

          <div class="form-group form-group-sm {{ $errors->has('balance') ? ' has-error' : '' }}">
            <label class="control-label col-sm-4" for="balance">Initial Balance </label>
            <div class="col-sm-8">
              <input type="number" min="0" step="any" name="balance" value="{{ old('balance') }}" class="form-control" placeholder="Initial Balance">
              @if ($errors->has('balance'))
              <span class="help-block">
                <strong>{{ $errors->first('balance') }}</strong>
              </span>
              @endif
            </div>
          </div>

          <div class="form-group form-group-sm">
            <label class="control-label col-sm-4" for="balance"> </label>
            <div class="col-sm-8">

               <button class="btn btn-sm btn-primary">Create Media Person</button>
               
            </div>
          </div>



            

                    

                  </div>
                </div>

                

              </div>
              <!-- /.box-body -->
 
            </form>
          </div>
      </div>
    </div>

  </div>
</div>
      

    </section>
