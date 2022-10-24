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
                       Raw Categories
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('storeCategories',['type'=>'raw']) }}" method="POST" class="op-hide">
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="text" name="name" placeholder="Category Name" class="form-control">
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
                        <div class="card-header">All Raw Categories</div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Cat Id</th>
                                            <th>Action</th>
                                            <th>Cat Name</th>
                                            <th>Cat Type</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($categories as $category)
                                        <tr>
                                            <tD>{{$category->id}}</tD>
                                            <td>
                                                <a href="javascript:void(0)" data-toggle="modal" data-target="#edtiCategory{{$category->id}}" class="btn btn-info">Edit</a>
                                                <form action="{{route('deleteCategories',['category'=>$category])}}" method="post" class="d-inline">
                                                    @csrf
                                                    <button class="btn btn-danger" onclick="return confirm('are You sure? you want to delete this category?');">Delete</button>
                                                </form>
                                            </td>
                                            <td>{{$category->name}} </td>
                                            <td><b>{{$category->type}}</b></td>
                                            <td>

                                            @if ($category->active)
                                            <div class="span text-success">Actived</div>
                                            @else
                                            <div class="span text-danger">Inactived</div>
                                            @endif

                                        </td>
                                        </tr>
                                        {{-- Category Modal Edit  --}}
                                        <div class="modal fade" id="edtiCategory{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h5 class="modal-title" id="exampleModalLabel">Edit Category {{$category->name}}</h5>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                  </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('updateCategories',['category'=>$category]) }}" method="POST">
                                                        @csrf
                                                        <div class="form-group">
                                                            <input type="text" name="name" value="{{$category->name}}" placeholder="Category Name" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <select name="cat_type" id="" class="form-control">
                                                                <option value="">Category Type</option>
                                                                <option {{$category->type == 'raw' ? 'selected' : ''}} value="raw">Raw</option>
                                                                <option {{$category->type == 'pack' ? 'selected' : ''}} value="pack">Pack</option>
                                                                <option {{$category->type == 'dhpl_medicine' ? 'selected' : ''}} value="dhpl_medicine">Dhpl Medicine</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for=""></label>
                                                            <label for="active"> <input {{$category->active ? 'checked' : ''}} type="checkbox" name="active" id="active"> Active</label>

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
                                                No Category Found
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            {{$categories->render()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@push('js')
@endpush
