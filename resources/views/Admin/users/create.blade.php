@extends('Admin.master')
@section('content')
<div class="container mt-5">
    <div class="card stacked-form">
    <div class="card-header ">
        <h4 class="card-title f-bold">اضافة عميل</h4>
    </div>
    <div class="card-body">
        <form method="POST" action="{{Route('admin.users.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label> الاسم</label>
                        <input name="name" type="text" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label> الايميل</label>
                        <input name="email" type="text" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label> الرقم</label>
                        <input name="phone" type="text" class="form-control" required>
                    </div>
                </div>
            </div>
         
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>تاريخ الميلاد</label>
                        <input name="birthday" type="date" class="form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>رقم الهوية</label>
                        <input name="id_number" type="number" class="form-control">
                    </div>        
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>صورة الهوية</label>
                        <input name="id_number_file" type="file" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>حالة الرخصة</label>
                        <select name="licence_status" class="form-select" aria-label="Default select example" style="padding-right: 30px ">
                            <option value="1">سارية </option>
                            <option value="0">غير سارية </option>
                        </select>
                    </div>        
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>صورة الرخصة</label>
                        <input name="licence_file" type="file" class="form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>الصورة الشخصية</label>
                        <input name="photo" type="file" class="form-control">
                    </div>
                </div>
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