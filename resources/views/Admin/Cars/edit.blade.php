@extends('Admin.master')
@section('content')
<div class="container mt-5">
    <div class="card stacked-form">
    <div class="card-header ">
        <h4 class="card-title f-bold">تعديل علي  سيارة </h4>
    </div>
    <div class="card-body">
        <form method="POST" action="{{Route('admin.cars.update', $car->id)}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>نوع السيارة</label>
                        <input name="type" value="{{ $car->type }}" type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>موديل السيارة</label>
                        <input name="model" value="{{ $car->model }}" type="text" class="form-control">
                    </div>        
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>سنة الصنع</label>
                        <input name="year" value="{{ $car->year }}" type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>السعر</label>
                        <input name="price" value="{{ $car->price }}" type="text" class="form-control">
                    </div>        
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>رقم اللوحة</label>
                        <input name="number" value="{{ $car->number }}" type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>التامين</label>
                        <select name="assurance" value="{{ $car->assurance }}" class="form-select" aria-label="Default select example" style="padding-right: 30px ">
                            <option value="1">شامل </option>
                            <option value="0">غير شامل </option>
                        </select>
                    </div>        
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>عدد الكيلومترات</label>
                        <input name="kilos" value="{{ $car->kilos }}" type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>السائق</label>
                        <select name="with_driver" value="{{ $car->with_driver }}" class="form-select" aria-label="Default select example" style="padding-right: 30px">
                            <option value="1">بدون</option>
                            <option value="0">شامل </option>
                        </select>
                    </div>        
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>الشركة</label>
                        <select class="form-select" name="company_id" value="{{ $car->company_id }}" aria-label="Default select example" style="padding-right: 30px">
                            @foreach ($companies as $company)
                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>نوع الاستئجار</label>
                        <select class="form-select" name="rents[]" aria-label="Default select example" style="overflow: auto;height: 100px;" multiple>
                            @foreach ($rentTypes as $rent)
                                <option @if($car->rentTypes->contains($rent->id))
                                    selected
                                @endif value="{{ $rent->id }}">{{ $rent->name }}</option>
                            @endforeach
                        </select>
                    </div>        
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>الصور</label>
                        <div class="mb-2">
                            @foreach ($car->files as $file)
                                
                            <img src="{{ $file->path}}" width="80"  height="80" alt="" style="border-radius: 5px">
                            @endforeach
                        </div>
                        <input type="file" name="img[]" id="" class="form-control" multiple style="display: block">
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