{{-- Add Values for option --}}
<a type="button" data-toggle="modal" data-bs-toggle="modal" data-bs-target="#inlineForm{{ $option->id }}"
    title="اضافة قيم للخيار" class="btn btn-primary btn-sm text-white"><i class="fas fa-plus-square"></i></a>
<!-- Modal -->
<div class="modal fade" id="inlineForm{{ $option->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">
                    اضف خيار ل
                    {{ $option->name }}
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="{{ 'add-value' . $option->id }}" class="form form-horizontal"
                    action="{{ route('admin.option-values.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="col-12 mb-3">
                            <div class="form-group ">
                                <div class="col-md-4">
                                    <span>الاسم</span>
                                </div>

                                <div class="col-md-8">
                                    <input type="hidden" class="form-control" name="option_id"
                                        value="{{ $option->id }}">
                                    <input type="text" class="form-control" name="value"
                                        value="{{ old('value') }}">
                                    @error('value')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="col-md-4">
                                    <span>السعر</span>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" class="form-control" name="price"
                                        value="{{ old('price') }}">
                                    @error('price')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">غلق</button>
                <button form="{{ 'add-value' . $option->id }}" type="submit" class="btn btn-primary">حفظ</button>
            </div>
        </div>
    </div>
</div>


{{-- show Values of option --}}
<a type="button" data-bs-toggle="modal" data-bs-target="#values{{ $option->id }}" title="عرض القيم"
    class="btn btn-primary btn-sm text-white"><i class="far fa-eye"></i></a>

<!-- Modal -->
<div class="modal fade" id="values{{ $option->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">
                    الخيارات ل
                    {{ $option->name }}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="myTable display nowrap" style="width: 100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>الاسم</th>
                                <th>السعر</th>
                                <th>خيارات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($option->option_values as $value)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ \Illuminate\Support\Str::words($value->value, 5) }}</td>
                                    <td>{{ $value->price != null ? $value->price : 'لا يوجد سعر' }}</td>
                                    <td>
                                        {{-- <a type="button" data-toggle="modal" data-bs-toggle="modal" data-bs-target="#inlineFor{{ $value->id }}"
                                                title="تعديل  " class="btn btn-primary btn-sm text-white"><i class="fas fa-edit"></i></a>
                                            <!-- Modal -->
                                            <div class="modal fade" id="inlineForm{{ $value->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="exampleModalLabel">
                                                                  تعديل قيمة  
                                                                {{ $value->name }}
                                                            </h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form id="{{ 'add-value' . $value->id }}" class="form form-horizontal"
                                                                action="{{ route('admin.option-values.update',$value->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="modal-body">
                                                                    <div class="col-12 mb-3">
                                                                        <div class="form-group ">
                                                                            <div class="col-md-4">
                                                                                <span>الاسم</span>
                                                                            </div>
                                            
                                                                            <div class="col-md-8">
                                                                                <input type="hidden" class="form-control" name="option_id"
                                                                                    value="{{ $option->id }}">
                                                                                <input type="text" class="form-control" name="value"
                                                                                    value="{{ $value->value }}">
                                                                                @error('value')
                                                                                    <span class="text-danger">{{ $message }}</span>
                                                                                @enderror
                                            
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group ">
                                                                            <div class="col-md-4">
                                                                                <span>السعر</span>
                                                                            </div>
                                                                            <div class="col-md-8">
                                                                                <input type="number" class="form-control" name="price"
                                                                                    value="{{ $value->price }}">
                                                                                @error('price')
                                                                                    <span class="text-danger">{{ $message }}</span>
                                                                                @enderror
                                            
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">غلق</button>
                                                            <button form="{{ 'add-value' . $option->id }}" type="submit" class="btn btn-primary">حفظ</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                               --}}
                                               <a href="{{ route('admin.option-values.edit', $value->id) }}" class="btn btn-info btn-sm"
                                                role="button" aria-pressed="true" title="تعديل">
                                                <i class="fa fa-edit"></i></a>
            


                                        <a onclick="fireDeleteEvent({{ $value->id }})" type="button" title="حذف"
                                            class="btn btn-danger btn-sm text-white"><i
                                                class="fas fa-trash-alt"></i></a>
                                        <form action="{{ route('admin.option-values.destroy', $value->id) }}"
                                            method="POST" id="form-{{ $value->id }}">
                                            @csrf
                                            @method('Delete')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">غلق</button>
            </div>
        </div>
    </div>
</div>
