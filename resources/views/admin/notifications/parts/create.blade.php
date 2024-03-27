@extends('admin/layouts/master')

@section('title')
    {{ $setting->name_en ?? '' }} | الاشعارات
@endsection
@section('page_name')
    الاشعارات
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"> اضافةاشعار {{ $setting->name_en ?? '' }}</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('notification.store') }}">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                        <label for="name" class="form-control-label">لوجو</label>
                                        <input type="file" class="dropify" name="logo"
                                            data-default-file="{{ asset('assets/uploads/avatar.png') }}"
                                            accept="image/png,image/webp , image/gif, image/jpeg,image/jpg" />
                                        <span class="form-text text-danger text-center">مسموح فقط بالصيغ التالية : png, gif, jpeg,
                                            jpg,webp</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="cat_id" class="form-control-label">الفئة</label>
                                    <select name="type" id="cat_id" class="form-control">
                                        <option value="">اختر نوع</option>
                                        <option value="all">الكل</option>
                                        <option value="user">مستخدم</option>
                                        <option value="vendor">بائع</option>
                                        <option value="advertise">معلن</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="user_select" class="form-control-label">المستخدم</label>
                                    <select name="user_id" id="user_select" class="form-control">
                                        <!-- Options will be dynamically populated here -->
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="title" class="form-control-label">العنوان</label>
                                    <input type="text" class="form-control" name="title">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="body" class="form-control-label">النص</label>
                                    <textarea class="form-control" name="body" rows="8"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="{{ route('notifications.index') }}" class="btn btn-info text-white">رجوع للخلف</a>
                            <button type="submit" class="btn btn-primary" id="addButton">اضافة</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('ajaxCalls')
    <script>
        $('.dropify').dropify()

        $(document).ready(function() {
            $("#cat_id").on('change', function() {
                var cat_id = $(this).val();

                $.ajax({
                    url: '{{ route('get_users') }}', // Replace this with the actual URL for fetching users based on category
                    type: 'GET',
                    data: {
                        cat_id: cat_id
                    },
                    dataType: 'json',
                    success: function(response) {
                        // Clear existing options
                        $("#user_select").empty();

                        // Append new options
                        $.each(response, function(index, user) {
                            $("#user_select").append('<option value="' + user.id +'">' + user.name + '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>
@endsection
