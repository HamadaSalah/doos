@extends('Admin.master')
@section('content')
<div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h6 style="float: right">كل طرق الاسترجاع</h6>
            <a style="float: left" href="{{route('admin.ReturnType.create')}}"><button class="btn btn-success">اضافة طرق الاسترجاع</button></a>   
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder">#</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder ">الاسترجاع</th>
                    <th class="text-secondary"></th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($branches as $branch)
                        <tr>
                            <td>
                                <div class="d-flex px-2 py-1">
                                    <div class="d-flex flex-column justify-content-center">
                                    <p class="text-xs text-secondary mb-0">1</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex px-2 py-1">
                                    <div class="d-flex flex-column justify-content-center">
                                    <p class="text-xs text-secondary mb-0">{{ $branch->name }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle">
                                <a href="{{route('admin.ReturnType.edit', $branch->id)}}"><button class="btn btn-primary">تعديل </button></a>
                                <button class="btn btn-danger DeleteMod" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{$branch->id}}">حذف</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
              <div class="text-center">
                {{ $branches->links() }}

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
                <h5 class="modal-title" id="deleteModalLabel">حذف طرق الاستلام </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                هل تريد حذف طرق الاستلام؟
                </div>
                <div class="modal-footer">
                    <form method="POST" action="{{ Route('admin.ReturnType.delete') }}">
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
  </div>
@endsection
