
@extends('Admin.master')
@section('content')

        <div class="container">
            <div class="rowd">
                <div class="card mt-5">
                  <div style="padding: 10px">
                    <h5 class="card-header" style="float: right;display: inline;width: 170px;">كل العملاء</h5>
                    <a href="{{ route('admin.users.create') }}" style="float: left;"><button class="btn btn-success">اضافة عميل </button></a>

                  </div>
                    <div class="table-responsive text-nowrap"  style="height: unset;overflow: initial;">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>الاسم</th>
                            <th>الرقم</th>
                            <th>الصورة</th>
                            <th>اجراء</th>
                          </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($users as $user)
                            <tr>
                                <td>
                                  {{ $loop->index+1 }} 
                                </td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>
                                  <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="{{ $user->name }}" data-bs-original-title="{{ $user->name }}" style="width: 60px !important;display: inline-table;">
                                      <img src="{{ asset($user->photo) }}" width="100px" alt="Avatar" class="rounded-circle">
                                    </li>
                                   </ul>
                                </td>
                                <td>
                                  <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" style="padding: 10px 20px !important;
                                    display: block;">
                                      <i class="mdi mdi-dots-vertical"></i> اجراء
                                    </button>
                                    <div class="dropdown-menu">
                                      <a class="dropdown-item waves-effect" style="text-align: right" href="{{ Route('admin.users.show', $user->id) }}"><i class="mdi mdi-account-eye-outline"></i> التفاصيل</a>
                                      <a class="dropdown-item waves-effect DeleteMod" style="text-align: right"  data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{$user->id}}"><i class="mdi mdi-trash-can-outline me-1"></i> حذف</a>
                                    </div>
                                  </div>
                                </td>
                            </tr>
    
                            @endforeach
                         </tbody>
                      </table>
                    </div>
                  </div>
            </div>
        </div>
    </div>
            <!-- Modal -->
            <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
              <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                  <h5 class="modal-title" id="deleteModalLabel">حذف الفرع </h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                  هل تريد حذف المستخدم؟
                  </div>
                  <div class="modal-footer">
                      <form method="POST" action="{{ Route('admin.users.delete') }}">
                          @csrf
                          <input type="hidden" name="id" id="MyId">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">لا</button>
                          <button type="submit" class="btn btn-primary">نعم</button>                    
                      </form>
                  </div>
              </div>
              </div>
          </div>
        </div>
     
       @push('scripts')
           <script>
               $(document).on('click','.DeleteMod',function(){
                  let id = $(this).attr('data-id');
                  $('#MyId').val(id);
              });
           </script>
       @endpush
  
@endsection



