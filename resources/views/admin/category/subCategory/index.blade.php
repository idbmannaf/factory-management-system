@extends('admin.layouts.adminMaster')
@section('title')
    Admin Dashboard
@endsection



@push('css')
@endpush

@section('content')
    <section class="content">
        <br>
        @include('alerts.alerts')
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                       Categories Types
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('storeSubCategories') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select name="category_id" id="" class="form-control">
                                        <option value="">Select Category Type</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}} ({{$category->type}})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="text" name="name" placeholder="Category Type Name" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for=""></label>
                                    <label for="active"> <input type="checkbox" name="active" id="active"> Active</label>
                                    <button type="submit" class="btn btn-info"><i class="fas fa-plus"></i> Add</button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="card">
                        <div class="card-header">All Category Types</div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Cat Type Id</th>
                                        <th>Action</th>
                                        <th>Category Name</th>
                                        <th>Category Type Name</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse ($sub_categories as $subcat)
                                        <tr>
                                            <tD>{{$subcat->id}}</tD>
                                            <td>
                                                <a href="javascript:void(0)" data-toggle="modal" data-target="#edtiSubCategory{{$subcat->id}}" class="btn btn-info">Edit</a>
                                                <form action="{{route('deleteSubCategories',['subcat'=>$subcat])}}" method="post" class="d-inline">
                                                    @csrf
                                                    <button class="btn btn-danger" onclick="return confirm('are You sure? you want to delete this category?');">Delete</button>
                                                </form>
                                            </td>
                                            <td>{{$subcat->category->name}}</td>
                                            <td>{{$subcat->name}} </td>
                                            <td>

                                                @if ($subcat->active)
                                                    <div class="span text-success">Actived</div>
                                                @else
                                                    <div class="span text-danger">Inactived</div>
                                                @endif

                                            </td>
                                        </tr>
                                        {{-- Category Modal Edit  --}}
                                        <div class="modal fade" id="edtiSubCategory{{$subcat->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Edit Category {{$subcat->name}}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('updateSubCategories',['subcat'=>$subcat]) }}" method="POST">
                                                            @csrf
                                                            <div class="form-group">
                                                                <label for="category_id">Category Type</label>
                                                                <select name="category_id" id="category_id" class="form-control">
                                                                    <option value="">Select Category Type</option>
                                                                    @foreach($categories as $category)
                                                                        <option {{$category->id == $subcat->category_id ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}} ({{$category->type}})</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="text" name="name" value="{{$subcat->name}}" placeholder="Category Type Name" class="form-control">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for=""></label>
                                                                <label for="active"> <input {{$subcat->active ? 'checked' : ''}} type="checkbox" name="active" id="active"> Active</label>

                                                            </div>
                                                            <div class="form-group">
                                                                <button type="submit" class="btn btn-info">Update</button>
                                                            </div>
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-danger">
                                                No Sub-Category Found
                                            </td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                            {{$sub_categories->render()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@push('js')
@endpush
