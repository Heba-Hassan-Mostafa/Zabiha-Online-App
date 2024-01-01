@extends('admin.layouts.master')
@section('title')
      تعديل الوقت 
@endsection
@section('content')

<h4 class="py-3 mb-4">
      <a href="{{route('admin.dashboard')}}">
          <span class="text-muted fw-light">الرئيسية/</span>
      </a>
      <a href="{{route('admin.categories.index')}}">
          <span class="text-muted fw-light" >اوقات التوصيل/</span>
      </a>
      تعديل الوقت
  </h4>


      <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
          <!-- Form controls -->
          <div class="col-md-12">
            <div class="card mb-4">
              <h5 class="card-header"> تعديل الوقت </h5>
              <div class="card-body">
                  <form action="{{ route('admin.delivery-time.update',$time->id) }}" method="Post">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                              <label  class="form-label">من</label>
                              <input type="text" name="from" value="{{ $time->from }}" class="form-control"/>
                              @error('from')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>

                        <div class="mb-3">
                            <label  class="form-label">الى</label>
                            <input type="text" name="to" value="{{ $time->to }}" class="form-control"/>
                            @error('to')<span class="text-danger">{{ $message }}</span>@enderror
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