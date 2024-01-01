@extends('admin.layouts.master')
@section('title')
    تعديل خيار
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
@endsection
@section('content')

<h4 class="py-3 mb-4">
      <a href="{{route('admin.dashboard')}}">
          <span class="text-muted fw-light">الرئيسية/</span>
      </a>
      <a href="{{route('admin.options.index')}}">
          <span class="text-muted fw-light">الخيارات/</span>
      </a>
     تعديل الخيار
  </h4>


      <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
          <!-- Form controls -->
          <div class="col-md-12">
            <div class="card mb-4">
              <h5 class="card-header">تعديل الخيار </h5>
              <div class="card-body">
                  <form action="{{ route('admin.options.update',$option->id) }}" method="Post">
                        @csrf
                        @method('PUT')
                        <div class="mb-2 fw-bold">
                              <label  class="form-label">الاسم</label>
                              <input type="text" name="name" value="{{ $option->name }}" class="form-control"/>
                              @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>

                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <div class="mb-2 fw-bold">
                                    النوع
                                </div>
                                <div class="">
                                    <select required class="form-control" name="input_type">
                                        <option selected disabled value="">اختار النوع</option>
                                        @foreach(config('types.input_types') as $type)
                                            <option value="{{$type}}" {{ ($option->input_type == $type) ? 'selected' : '' }}>  {{ $type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mb-3">
                            <div class="form-group ">
                                <div class="mb-2 fw-bold">
                                    <span>اقسام المنتجات</span>
                                </div>
                                <div class="">
                                    <select required class="form-control select2" name="categories[]"  multiple="multiple">
                                        @forelse($categories as $cat)
                                        <option value="{{ $cat->id }}"
                                            {{ in_array($cat->id , $option->categories->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $cat->name }}</option>
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
@section('script')
    <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(function() {
 //select2 with search
 function matchStart(params, data) {
                // If there are no search terms, return all of the data
                if ($.trim(params.term) === '') {
                    return data;
                }

                // Skip if there is no 'children' property
                if (typeof data.children === 'undefined') {
                    return null;
                }

                // `data.children` contains the actual options that we are matching against
                var filteredChildren = [];
                $.each(data.children, function(idx, child) {
                    if (child.text.toUpperCase().indexOf(params.term.toUpperCase()) == 0) {
                        filteredChildren.push(child);
                    }
                });

                // If we matched any of the timezone group's children, then set the matched children on the group
                // and return the group object
                if (filteredChildren.length) {
                    var modifiedData = $.extend({}, data, true);
                    modifiedData.children = filteredChildren;

                    // You can return modified objects from here
                    // This includes matching the `children` how you want in nested data sets
                    return modifiedData;
                }

                // Return `null` if the term should not be displayed
                return null;
            }

            $(".select2").select2({
                tags: true,
                closeOnSelect: false,
                minimumResultsForSearch: Infinity,
                matcher: matchStart,
                placeholder:"اختر القسم"
            });
        })
        </script>
@endsection
