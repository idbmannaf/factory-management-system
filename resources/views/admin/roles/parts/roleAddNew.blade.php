
    <section class="content-header">
      <h1>
        Role
        <small>Add New</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Role</a></li>
        <li class="active">Add New</li>
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
              <h3 class="box-title"><i class="fa fa-th"></i> New Role</h3>
              
            </div>

            <div class="box-body">


            @include('admin.roles.includes.forms.roleAddNewForm')
               
            </div>             
        </div>
        
      </div>        
      </div>
      <!-- /.row -->


    </section>
