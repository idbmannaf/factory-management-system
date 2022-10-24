
{{--Supplier Edit Modal--}}
<div class="modal" id="edit{{$supplier->id}}">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Edit {{$supplier->name}}</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{route('admin.updateSupplier',['supplier'=>$supplier])}}" method="post">
@csrf
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name"></label>
                        <input type="text" name="name" id="name" class="form-control" value="{{$supplier->name}}" placeholder="Enter Name..">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                    <input type="email" name="email" in="email" class="form-control" value="{{$supplier->email}}" placeholder="Enter Email..">
                    </div>
                    <div class="form-group">
                        <label for="mobile"> Mobile</label>
                            <input type="text" name="mobile" id="mobile" class="form-control" value="{{$supplier->mobile}}" placeholder="Phone Number" >
                    </div>

                    <label for="active">
                        <input type="checkbox" name="active" {{$supplier->active ? 'checked': ''}} id="active"> Active
                    </label>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info">Update</button>
                </div>
            </form>

        </div>
    </div>
</div>


{{--Supplier View Modal--}}
<div class="modal" id="view{{$supplier->id}}">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">{{$supplier->name}}</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <p><b>Name: </b> {{$supplier->name}}</p>
                <p><b>Email: </b> {{$supplier->email}}</p>
                <p><b>Phone: </b> {{$supplier->mobile}}</p>

                <p><b>Active: </b>
                    @if ($supplier->active)
                        <span class="badge badge-success">Activated</span>
                    @else
                        <span class="badge badge-danger">InActivated</span>
                    @endif</p>

            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
