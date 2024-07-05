@extends('Admin.master')
@section('content')
<div class="container mt-5">
    <div class="card stacked-form">
     <div class="card-body ">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">السيارة</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">التفاصيل </button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">العميل</button>
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
                            <div class="raduisadata">{{ $rent->car->type }}</div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="mycardata">
                            <label for="">الموديل</label>
                            <div class="raduisadata">{{ $rent->car->model }}</div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="mycardata">
                            <label for="">السنة</label>
                            <div class="raduisadata">{{ $rent->car->year }}</div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="mycardata">
                            <label for="">السعر</label>
                            <div class="raduisadata">{{ $rent->car->price }}</div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="mycardata">
                            <label for="">رقم اللوحة</label>
                            <div class="raduisadata">{{ $rent->car->number }}</div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="mycardata">
                            <label for="">التامين</label>
                            <div class="raduisadata">{{ $rent->car->assurance }}</div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="mycardata">
                            <label for="">عدد الكيلو مترات</label>
                            <div class="raduisadata">{{ $rent->car->kilos }}</div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="mycardata">
                            <label for="">السائق</label>
                            <div class="raduisadata">{{ $rent->car->with_driver }}</div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="mycardata">
                            <label for="">الحالة</label>
                            <div class="raduisadata">{{ $rent->car->status }}</div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="mycardata">
                            <label for="">اسم الشركة</label>
                            <div class="raduisadata">{{ $rent->car->company?->name }}</div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="mycardata">
                            <label for="">الاستئجار المتاح</label>
                            <div class="raduisadata">
                                @if (isset($rent->car->rentTypes) && count($rent->car->rentTypes) > 0)
                                    @foreach ($rent->car->rentTypes as $itm)
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
                        @foreach ($rent->car->files as $file)
                            <img src="{{asset($file->path)}}" class="img-thumbnail mb-1" style="width: 20%;height: 150px;padding: 10px">
        
                    @endforeach
                    </ul>
                    
                    {{-- @foreach ($rent->car->files as $file)
                        <div class="col-md-4">
                            <img src="{{asset($file->path)}}" class="img-thumbnail" style="min-width: 100%">
                        </div>
        
                    @endforeach --}}
                </div>
        
            </div>
            <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <div class="mycardata">
                            <label for="">من تاريخ</label>
                            <div class="raduisadata">{{ $rent->date_from }}</div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="mycardata">
                            <label for="">الي تاريخ</label>
                            <div class="raduisadata">{{ $rent->date_to }}</div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="mycardata">
                            <label for="">الوقت</label>
                            <div class="raduisadata">{{ $rent->time }}</div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="mycardata">
                            <label for="">طريقة الارجاع</label>
                            <div class="raduisadata">{{ $rent->returnType->name }}</div>
                        </div>
                    </div>

                </div>


            </div>
            <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <div class="mycardata">
                            <label for="">الاسم</label>
                            <div class="raduisadata">{{  $rent->user->name }}</div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="mycardata">
                            <label for="">البريد</label>
                            <div class="raduisadata">{{  $rent->user->email }}</div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="mycardata">
                            <label for="">الموبايل</label>
                            <div class="raduisadata">{{  $rent->user->phone }}</div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="mycardata">
                            <label for="">تاريخ الميلاد</label>
                            <div class="raduisadata">{{  $rent->user->birthday }}</div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="mycardata">
                            <label for="">حالة الرخصة</label>
                            <div class="raduisadata">{{  $rent->user->licence_status==1 ? 'سارية' : 'منتهية' }}</div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="mycardata">
                            <label for="">الصورة</label>
                            
                            <div class="raduisadata"><img   height="200px" width="300px" style="border-radius: 25px;text-align: center;margin: auto" src="{{asset( $rent->user->photo)}}" alt=""></div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="mycardata">
                            <label for="">صورة الرخصة</label>
                            <div class="raduisadata"><img height="200px" width="300px" style="border-radius: 25px;text-align: center;margin: auto" src="{{asset( $rent->user->licence_file)}}" alt=""></div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="mycardata">
                            <label for="">صورة الــ id</label>
                            <div class="raduisadata"><img height="200px" width="300px" style="border-radius: 25px;text-align: center;margin: auto" src="{{asset( $rent->user->id_number_file)}}" alt=""></div>
                        </div>
                    </div>
                </div>     
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
                <input type="hidden" name="car_id" value="{{$rent->car->id}}">
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
