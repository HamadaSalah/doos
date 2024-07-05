@extends('Admin.master')
@section('content')
<div class="container mt-5">
    <div class="card stacked-form">
    <div class="card-header ">
        <h4 class="card-title f-bold">تعديل طرق الاستئجار  </h4>
    </div>
    <div class="card-body ">
        <form method="POST" action="{{Route('admin.RentType.update', $branch->id)}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>اسم  </label>
                <input name="name" type="text" class="form-control" value="{{ $branch->name }}">
            </div>
            <div class="form-group"><br/>
                <button type="submit" class="btn btn-fill btn-info">حفظ</button>
            </div>
        </form>
    </div>
    <div class="card-footer ">
    </div>
</div>


</div>
@endsection
