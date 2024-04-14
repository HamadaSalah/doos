@extends('Admin.master')
@section('content')
<div class="container mt-5">
    <div class="card stacked-form">
    <div class="card-header ">
        <h4 class="card-title f-bold">تعديل العقد </h4>
    </div>
    <div class="card-body">
        <form method="POST" action="{{Route('admin.rents.update', $rent->id)}}" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label> السيارة</label>
                        <select name="car_id" class="form-select" aria-label="Default select example" style="padding-right: 30px " required>
                            <option value="">اختر السيارة </option>
                            @foreach ($cars as $car)
                                <option <?php if($car->id == $rent->car_id) echo 'selected'; ?> value="{{ $car->id }}">{{ $car->type }} - {{$car->model}} - {{ $car->year }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label> العميل</label>
                        <select name="user_id" class="form-select" aria-label="Default select example" style="padding-right: 30px " required>
                            <option value="">اختر العميل </option>
                            @foreach ($users as $user)
                                <option <?php if($user->id == $rent->user_id) echo 'selected'; ?>  value="{{ $user->id }}">{{ $user->name }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>من تاريخ</label>
                        <input name="date_from" type="date" class="form-control" required  value="{{ $rent->date_from }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>الي تاريخ</label>
                        <input name="date_to" type="date" class="form-control" required  value="{{ $rent->date_to }}">
                    </div>        
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>الوقت</label>
                        <input name="time" type="time" class="form-control" required  value="{{ $rent->time }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>الاستلام</label>
                        <select name="location" class="form-select" aria-label="Default select example" style="padding-right: 30px " required  value="{{ $rent->id }}">
                            <option value="1">استلام من الفرع </option>
                            <option value="2">توصيل الي المنزل </option>
                        </select>
                    </div>        
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>الخدمات</label>
                        <select name="services[]" class="form-select" multiple aria-label="Default select example" style="padding-right: 30px " required >
                            @foreach ($services as $ser)
                                <option @if($rent->services->contains($ser->id))
                                    selected
                                @endif  value="{{ $ser->id }}">{{ $ser->name }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>طريقة الارجاع</label>
                        <select name="return_type_id" class="form-select" aria-label="Default select example" style="padding-right: 30px " required>
                            <option value="">طريقة الارجاع </option>
                            @foreach ($rent_types as $re)
                                <option <?php if($re->id == $rent->return_type_id) echo 'selected'; ?> value="{{ $re->id }}">{{ $re->name }} </option>
                            @endforeach
                        </select>
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