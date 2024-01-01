@extends('admin.layouts.master')
@section('title')
      اضافة صلاحية جديد
@endsection
@section('content')

<h4 class="py-3 mb-4">
      <a href="{{route('admin.dashboard')}}">
          <span class="text-muted fw-light">الرئيسية/</span>
      </a>
      <a href="{{route('admin.roles.index')}}">
          <span class="text-muted fw-light" > الصلاحيات/</span>
      </a>
      اضافة صلاحية جديد
  </h4>


      <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
          <!-- Form controls -->
          <div class="col-md-12">
            <div class="card mb-4">
              <h5 class="card-header"> اضافة صلاحية جديد </h5>
              <div class="card-body">
                  <form action="{{ route('admin.roles.store') }}" method="Post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                              <label  class="form-label"> الاسم</label>
                              <input type="text" name="name" value="{{ old('name') }}" class="form-control"/>
                              @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>

                        <div class="col-12 mb-3">
                            <div class="form-group ">
                                <div class="col-md-12">
                                    <span class="fw-bold"> الصلاحيات</span>
                                </div>
                                <div class="col-md-8 mt-3">
                                    <input type="checkbox" name="select_all" onclick="CheckAll('box1',this)">
                                    <label for='selectAll'>اختر الكل</label>
                                    <div class="row mt-3">
                                        @forelse ($permissions as $permission)
                                            <label class="col-md-3">
                                                <input type="checkbox" name="permission[]" value="{{ $permission->id }}" class="box1">
                                                {{ $permission->name }}
                                            </label>
                                        @empty
                                        @endforelse
                                    </div>
                                    @error('permission')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                          <div class="form-group pt-4 mr-4">
                              <button type="submit" name="save" class="btn btn-primary">
                                حفظ</button>

                          </div>
                  </form>
              </div>
            </div>
          </div>

      </div>
@endsection
@section('script')
<script>
    function CheckAll(className, elem) {
        var elements = document.getElementsByClassName(className);
        var l = elements.length;

        if (elem.checked) {
            for (var i = 0; i < l; i++) {
                elements[i].checked = true;
            }
        } else {
            for (var i = 0; i < l; i++) {
                elements[i].checked = false;
            }
        }

    }
</script>
@endsection
