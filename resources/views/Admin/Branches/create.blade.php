
@extends('Admin.master')
@section('content')
<div class="container mt-5">
    <div class="card stacked-form">
    <div class="card-header ">
        <h4 class="card-title f-bold">اضافة فرع جديد</h4>
    </div>
    <div class="card-body ">
        <form method="POST" action="{{Route('admin.branches.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>اسم الفرع</label>
                <input name="name" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label>الوصف</label>
                <input name="description"type="text" class="form-control">
            </div>
            <div class="form-group">
                <label>العنوان</label>
                <input name="address"type="text" class="form-control">
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
