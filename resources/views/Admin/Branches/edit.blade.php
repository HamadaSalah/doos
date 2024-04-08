@extends('Admin.master')
@section('content')
<div class="container mt-5">
    <div class="card stacked-form">
    <div class="card-header ">
        <h4 class="card-title f-bold">تعديل الفرع </h4>
    </div>
    <div class="card-body ">
        <form method="POST" action="{{Route('admin.branches.update', $branch->id)}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>اسم الفرع</label>
                <input name="name" type="text" class="form-control" value="{{ $branch->name }}">
            </div>
            <div class="form-group">
                <label>الوصف</label>
                <input name="description"type="text" class="form-control"  value="{{ $branch->description }}">
            </div>
            <div class="form-group">
                <label>العنوان</label>
                <input name="address"type="text" class="form-control"  value="{{ $branch->address }}">
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
