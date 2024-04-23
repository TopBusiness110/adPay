@extends('admin/layouts/master')

@section('title')
    {{ $setting->name_en ?? '' }} | باقات الاعلانات
@endsection
@section('page_name')
باقات الاعلانات
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"> تعديل باقة {{ $setting->name_en ?? '' }}</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('slider.update', $slider['id']) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="name" class="form-control-label">الصورة</label>
                                        <input type="file" class="dropify" name="image"
                                               data-default-file="{{ asset('storage/'.$slider->image) ??  asset('assets/uploads/avatar.png')  }}">
                                        <span class="form-text text-danger text-center">مسموح فقط بالصيغ التالية : png, gif,
                                            jpeg,
                                            jpg,webp</span>
                                    </div>
                                </div>


                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label for="status" class="form-control-label">الحاله</label>
                                    <select name="status" class="form-control">
                                        <option disabled value="">{{ $slider->status == 0 ? 'غير مفعل' : 'مفعل' }}</option>
                                        <option value="0">غير مفعل</option>
                                        <option value="1">مفعل</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="{{ route('sliders.index') }}" class="btn btn-info text-white">رجوع للخلف</a>
                            <button type="submit" class="btn btn-primary" id="addButton">تعديل</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    $('.dropify').dropify()
</script>
