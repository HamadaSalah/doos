@extends('Admin.master')
@section('content')
<div class="container mt-5">
    <div class="card stacked-form">
     <div class="card-body ">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">تفاصيل السيارة</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">العقود</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">الصيانات والوقود</button>
            </li>
            {{-- <li class="nav-item" role="presentation">
              <button class="nav-link" id="disabled-tab" data-bs-toggle="tab" data-bs-target="#disabled-tab-pane" type="button" role="tab" aria-controls="disabled-tab-pane" aria-selected="false">الحوادث</button>
            </li> --}}
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <div class="mycardata">
                            <label for="">النوع</label>
                            <div class="raduisadata">{{ $car->type }}</div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="mycardata">
                            <label for="">الموديل</label>
                            <div class="raduisadata">{{ $car->model }}</div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="mycardata">
                            <label for="">السنة</label>
                            <div class="raduisadata">{{ $car->year }}</div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="mycardata">
                            <label for="">السعر</label>
                            <div class="raduisadata">{{ $car->price }}</div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="mycardata">
                            <label for="">رقم اللوحة</label>
                            <div class="raduisadata">{{ $car->number }}</div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="mycardata">
                            <label for="">التامين</label>
                            <div class="raduisadata">{{ $car->assurance }}</div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="mycardata">
                            <label for="">عدد الكيلو مترات</label>
                            <div class="raduisadata">{{ $car->kilos }}</div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="mycardata">
                            <label for="">السائق</label>
                            <div class="raduisadata">{{ $car->with_driver }}</div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="mycardata">
                            <label for="">الحالة</label>
                            <div class="raduisadata">{{ $car->status }}</div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="mycardata">
                            <label for="">اسم الشركة</label>
                            <div class="raduisadata">{{ $car->company?->name }}</div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="mycardata">
                            <label for="">الاستئجار المتاح</label>
                            <div class="raduisadata">
                                @if (isset($car->rentTypes) && count($car->rentTypes) > 0)
                                    @foreach ($car->rentTypes as $itm)
                                        <span class="spandata"> {{ $itm->name}} </span> 
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <hr/>
                <div class="row">
                    <h3 class="mt-2 mb-5">الصور</h3>
                    <ul id="images" style="text-align: center;margin: auto">
                        @foreach ($car->files as $file)
                            <img src="{{asset($file->path)}}" class="img-thumbnail mb-1" style="width: 20%;height: 150px;padding: 10px">
        
                    @endforeach
                    </ul>
                    
                    {{-- @foreach ($car->files as $file)
                        <div class="col-md-4">
                            <img src="{{asset($file->path)}}" class="img-thumbnail" style="min-width: 100%">
                        </div>
        
                    @endforeach --}}
                </div>
        
            </div>
            <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">...</div>
            <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
                <button class="btn btn-success"  data-bs-toggle="modal" data-bs-target="#addMainTain"> اضافة  <i class="fa fa-plus"> </i>  </button>

                @if (count($car->maintains) > 0)
                    <div class="table-responsive p-0">

                    <table class="table align-items-center mb-0">
                      <thead>
                        <tr>
                          <th class="text-uppercase text-center font-weight-bolder ">#</th>
                          <th class="text-uppercase text-center font-weight-bolder  ps-2">التكلفة</th>
                          <th class="text-center text-uppercase font-weight-bolder ">التاريخ</th>
                          <th class="text-center text-uppercase font-weight-bolder ">التفاصيل</th>
                          <th class="text-secondary ">اجراء</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($car->maintains as $main)
                            <tr>
                            <td>
                                <p class="text-xs font-weight-bold mb-0 text-center">{{$main->id}}</p>
                            </td>
                            <td>
                                <p class="text-xs font-weight-bold mb-0 text-center">{{$main->amount}}</p>
                            </td>
                            <td class="align-middle text-center">
                                <span class="text-secondary text-xs font-weight-bold text-center">{{$main->date}}</span>
                            </td>
                            <td>
                                <p class="text-xs font-weight-bold mb-0 text-center">{{$main->description}}</p>
                            </td>

                            <td class="align-middle">
                              <a href="{{route('admin.maintain.delete', $main->id)}}"> <button class="btn btn-danger">حذف</button></a>
                            </td>
                            </tr>                            
                        @endforeach
                      </tbody>
                    </table>
                </div>
                @else
                        <center>
                            لا يوجد
                        </center>
                @endif
                


            </div>
            <div class="tab-pane fade" id="disabled-tab-pane" role="tabpanel" aria-labelledby="disabled-tab" tabindex="0">...</div>
          </div>
          




    </div>
    <div class="card-footer ">
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="addMainTain" tabindex="-1" aria-labelledby="addMainTainLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addMainTainLabel">اضافة مصاريف صيانة او وقود</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{Route('admin.maintain.store')}}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="car_id" value="{{$car->id}}">
                <div class="form-group">
                    <label>التكلفة</label>
                    <input name="amount" type="number" min="0" class="form-control">
                </div>
                <div class="form-group">
                    <label>التاريخ</label>
                    <input name="date" type="date" class="form-control">
                </div>
                <div class="form-group">
                    <label>الوصف</label>
                    <input name="description" type="text" class="form-control">
                </div>
                <div class="form-group"><br/>
                    <button type="submit" class="btn btn-fill btn-info">حفظ</button>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>
  
   

</div>
@endsection
