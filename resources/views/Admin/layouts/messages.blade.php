<div class="container">
    
    @if ($errors->any())
        <div class="row">
            @foreach ($errors->all() as $error)
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>{{$error}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> <i class="fa fa-close d-block"></i></button>
              </div>
              @endforeach
        </div>
        @endif

        @if (session('success'))
        <div class="row">
        <div class="col-md-12">
            <div class="alert alert-success ">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> </button>
                <span class="text-white">
                <b> </b> {{session('success')}}</span>
            </div>
        </div>
        </div>
        @endif
        @if (session('error'))
        <div class="row">
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <i class="fa fa-close" class="myclose"></i>
            </button>
            <span>
                <b> Danger - </b> {{session('error')}}</span>
        </div>
        </div>
    @endif

</div>