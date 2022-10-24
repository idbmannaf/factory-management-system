<br>
<section class="content">
    <div class="card card-primary">
        <div class="card-header with-border">
            <h3 class="card-title">
                Manage Product Categories 
                <button class="btn btn-default w3-text-gray btn-sm btn-cat-create-ajax">Create New Category</button>
            </h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <input id="search-input" placeholder="Search Category" class="search-input" />
                    <br>
                    
                    <div id="SimpleJSTree">

                    </div>

                    
                </div>

                <div class="col-md-9">
                     
                    <div class="data-ajax-container">

                        Select A Category from the Directory
                    </div>

                    
                </div>
                {{-- <div class="col-md-3">
                    <div class="row">
                        <div class="col-md-12">
                            <img src="{{ route('imagecache', [ 'template'=>'pfimd','filename' => $cat->img_name ]) }}" alt="{{$cat->title}}" width="30px;">
                        </div>
                        <div class="col-md-12">
                            <img src="" alt="">
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</section>