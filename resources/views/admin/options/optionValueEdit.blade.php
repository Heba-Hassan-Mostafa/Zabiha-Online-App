@extends('admin.layouts.master')
@section('title')
    تعديل قيمة الخيار   
@endsection
@section('content')

<h4 class="py-3 mb-4">
      <a href="{{route('admin.dashboard')}}">
          <span class="text-muted fw-light">الرئيسية/</span>
      </a>
      <a href="{{route('admin.options.index')}}">
          <span class="text-muted fw-light">الخيارات/</span>
      </a>
      تعديل قيمة الخيار   
</h4>


      <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
          <!-- Form controls -->
          <div class="col-md-12">
            <div class="card mb-4">
              <h5 class="card-header">   تعديل قيمة الخيار  </h5>
              <div class="card-body">
                  <form action="{{ route('admin.option-values.update',$value->id) }}" method="Post">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                              <label  class="form-label">الاسم</label>
                              <input type="text" name="value" value="{{ $value->value }}" class="form-control"/>
                              @error('value')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>

                        <div class="mb-3">
                              <label  class="form-label">السعر</label>
                              <input type="number" name="price" value="{{ $value->price }}" class="form-control"/>
                              @error('price')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>

                        <div class="col-12 mb-3">
                              <div class="form-group row">
                                  <div class="col-md-12">
                                      <span> الخيارات</span>
                                  </div>
                                  <div class="col-md-8">
                                      <select required class="form-control" name="options">
                                          @forelse($options as $option)
                                          <option value="{{ $option->id }}" {{ $value->option_id == $option->id ? 'selected' : '' }}>{{ $option->name }}</option>
                                          @empty
                                              @endforelse
                                      </select>
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
