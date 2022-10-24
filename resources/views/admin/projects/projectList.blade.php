@extends('admin.layouts.adminMaster')

@section('title')
Projects | {{ env('APP_NAME') }}
@endsection

@push('css')
<link href="{{ asset('https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css') }}" rel="stylesheet">

<style>
  .note-group-select-from-files {
    display: none;
  }
</style>
@endpush

@section('content')

 <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>
               
              <small>Admin Dashboard</small>
            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Admin</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>


    <section class="content">
                <div class="card">
                    <div class="card-header w3-blue">
                        Project List 
                        <a class="btn btn-sm w3-purple" href="{{ route('admin.project.new') }}"><i class="fa fa-plus"></i> add project</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <td>#</td>
                                        <td>Icon</td>
                                        <td>Image</td>
                                        <td>Name</td>
                                        <td>Description</td>
                                        <td>Options</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = ($projects->currentPage() - 1) * $projects->perPage();
                                    @endphp
                                    @foreach ($projects as $project)
                                        <tr>
                                            <td>{{ $i + $loop->iteration }}</td>
                                            <td>
                                                <img src="{{ asset($project->icon) }}" >
                                            </td>
                                            <td>
                                                <img src="{{ asset($project->feature_img) }}" >
                                            </td>
                                            <td>{{ json_decode($project->name) }}</td>
                                            <td>{{ Str::limit(json_decode($project->description), 100, '...') }}</td>
                                            <td>
                                                <a class="btn btn-primary btn-sm" href=""> <i class="fa fa-edit"></i> edit </a>
                                                <a class="btn btn-danger btn-sm" href=""> <i class="fa fa-trash"></i> delete </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
    </section>



@endsection



@push('js')

<script src="{{ asset('https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js') }}"></script>
<script>

  $(document).ready(function() {
    $('#description').summernote({
      placeholder: 'Write description of the post here...',
      minHeight: 160,
      // codemirror: { // codemirror options
      //   theme: 'monokai',
      //   lineNumbers: true,
      //   lineWrapping: true,
      // }
    });
  });
  </script>
@endpush
