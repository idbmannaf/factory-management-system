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
                    
                    <small>New Project</small>
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <li class="breadcrumb-item active">New Project</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>


<section class="content">
    <div class="container">
        <div class="card">
            <div class="card-header w3-purple">
                New Project
            </div>
            <div class="card-body">
                <form action="{{ route('admin.project.save') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group my-2">
                        <div class="col-md-3">
                            <label for="name">Name</label>
                        </div>
                        <div class="col-md-8">
                            <input class="form-control" type="text" name="name">
                        </div>
                    </div>
                    <div class="input-group my-2">
                        <div class="col-md-3">
                            <label for="description">Description</label>
                        </div>
                        <div class="col-md-8">
                            <textarea class="form-control" type="text" name="description" id="description"></textarea>
                        </div>
                    </div>
                    <div class="input-group my-2">
                        <div class="col-md-3">
                            <label for="feature_img">Featured Image</label>
                        </div>
                        <div class="col-md-8">
                            <input class="form-control" type="file" name="feature_img">
                        </div>
                    </div>
                    <div class="input-group my-2">
                        <div class="col-md-3">
                            <label for="icon">Icon</label>
                        </div>
                        <div class="col-md-8">
                            <input class="form-control" type="file" name="icon">
                        </div>
                    </div>
                    <div class="input-group my-2">
                        <div class="col text-center">
                            <button class="btn btn-primary px-5"><i class="fa fa-save"></i> Save</button>
                        </div>
                    </div>
                </form>
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
