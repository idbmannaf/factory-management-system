<form class="form-horizontal" role="form" method="post" action="{{ route('admin.roleAddNewPost') }}">

{{csrf_field()}}

	<div class="row">
		<div class="col-sm-6">

            <div class="box box-widget">
        <div class="box-body" style="background: #ddd;">
            <div class="box box-widget">

                <div class="box-body" style="min-height: 300px;">



                    <div class="form-group">
    <label class="control-label col-sm-3" for="email">User:</label>
    <div class="col-sm-9">

        <select id="email"
            name="email"
            class="form-control select2-container step2-select select2"
            data-placeholder="Name, Email, Usernam, or Mobile Number"
            data-ajax-url="{{route('common2.selectNewRole')}}"
            data-ajax-cache="true"
            data-ajax-dataType="json"
            data-ajax-delay="200"
            required 
            style="width: 100%;">
                <option>{{old('email')}}</option>
              </select>
            @if( $errors->has('email') )
              <span class="help-block">{{ $errors->first('email') }}</span>
            @endif
       
    </div>
  </div>
            
    <div class="form-group form-group-sm {{ $errors->has('branch') ? ' has-error' : '' }}">
                <label class="control-label col-sm-3" for="branch">Branch:</label>

                <div class="col-sm-9">
       <select class="form-control form-group-sm" id="branch" name="branch">
                @if(old('branch'))
                <option selected>{{old('branch')}}</option>
                @endif

                <option value="0">All Branches (Access All Branches Data) </option>
                {{-- branchs --}}
                @foreach ($branches as $branch)
                  <option value="{{ $branch->id }}">{{$branch->branch_name}} ({{ $branch->location }})</option>
                @endforeach
              </select>
                @if ($errors->has('branch'))
                <span class="help-block">
                    <strong>{{ $errors->first('branch') }}</strong>
                </span>
                @endif
    </div>
                
                
            </div>



    <div class="form-group form-group-sm {{ $errors->has('role_value') ? ' has-error' : '' }}">
        <label class="control-label col-sm-3" for="role_value">Role Name:</label>

        <div class="col-sm-9">

            <input  
        type="text" 
        id="role_value" 
        class="form-control" 
        name="role_value"
        value="{{old('role_value')}}"        
        placeholder="Role Name"
        required
        list="role_value_list" 
        />

        <datalist id="role_value_list">
          <option value="Support Team">
          <option value="Branch Admin">
          <option value="Editor">
          <option value="Moderator">
          <option value="Contributor">
        </datalist>
 
        </div>

        
        @if($errors->has('role_value'))

        <span class="help-block">
            <strong>{{ $errors->first('role_value') }}</strong>
        </span>
        
        @endif
    </div>

                    
                </div>
            </div>
        </div>
    </div>

  


     


		</div>
		<div class="col-sm-6">


    <div class="box box-widget">
        <div class="box-body" style="background: #ddd;">
            <div class="box box-widget">
                <div class="box-header">
                    <h3 class="box-title">
                        Select Items (for modify/edit by this role)
                    </h3>
                </div>
                <div class="box-body" style="min-height: 260px;">



<div class="form-group {{ $errors->has('items') ? ' has-error' : '' }}">
         
    <div class="col-sm-12">

        <div class="checkbox">
            <label>
              <input name="items[]" value="payments" type="checkbox">
              Payment
            </label>
          </div>

          <div class="checkbox">
            <label>
              <input name="items[]" value="page" type="checkbox">
              Menu & Page
            </label>
          </div>

          <div class="checkbox">
            <label>
              <input name="items[]" value="gallery" type="checkbox">
              Image Gallery
            </label>
          </div>

          <div class="checkbox">
            <label>
              <input name="items[]" value="videoGallery" type="checkbox">
              Video Gallery
            </label>
          </div>

          <div class="checkbox">
            <label>
              <input name="items[]" value="media" type="checkbox">
              Media
            </label>
          </div>

          <div class="checkbox">
            <label>
              <input name="items[]" value="proposal" type="checkbox">
              Proposal
            </label>
          </div>

          <div class="checkbox">
            <label>
              <input name="items[]" value="users" type="checkbox">
              User Manage
            </label>
          </div>


          @if($errors->has('items'))

        <span class="help-block">
            <strong>{{ $errors->first('items') }}</strong>
        </span>

        @endif
       
    </div>

        
        
    </div>
                    
                </div>
            </div>
        </div>
    </div>


	 


 


 

 	<div class="col-sm-offset-3 col-sm-9">
 		 <button type="submit" class="btn btn-primary pull-right">Add Role</button>

 	</div>	


		</div>
	</div>

</form>