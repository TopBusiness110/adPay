@extends('admin/layouts/master')

@section('title')
    {{($setting->name_en) ?? ''}} | الاشعارات
@endsection
@section('page_name') الاشعارات @endsection
@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"> الاشعار {{($setting->name_en) ?? ''}}</h3>
                    <a class="" href="{{ route('notification.create') }}">
                        <button class="btn btn-secondary btn-icon text-white addBtn">
									<span>
										<i class="fe fe-plus"></i>
									</span> اضافة جديد
                        </button>
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table table-striped table-bordered text-nowrap w-100" id="dataTable">
                            <thead>
                            <tr class="fw-bolder text-muted bg-light">
                                <th class="min-w-25px">#</th>
                                <th class="min-w-50px">لوجو</th>
                                <th class="min-w-50px">العنوان</th>
                                <th class="min-w-50px">النص</th>
                                <th class="min-w-50px">المستخدم</th>
                                <th class="min-w-50px">نوع</th>
                                <th class="min-w-50px rounded-end">العمليات</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--Delete MODAL -->
        <div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">حذف بيانات</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input id="delete_id" name="id" type="hidden">
                        <p>هل انت متأكد من حذف البيانات التالية <span id="title" class="text-danger"></span>؟</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" id="dismiss_delete_modal">
                            الغاء
                        </button>
                        <button type="button" class="btn btn-danger" id="delete_btn">حذف !</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL CLOSED -->
    </div>
    @include('admin/layouts/myAjaxHelper')
@endsection
@section('ajaxCalls')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        var columns = [
            {data: 'id', name: 'id'},
            {data: 'logo', name: 'logo'},
            {data: 'title', name: 'title'},
            {data: 'body', name: 'body'},
            {data: 'user_id', name: 'user_id'},
            {data: 'type', name: 'type'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
        showData('{{route('notifications.index')}}', columns);

        deleteScript('{{route('notification.delete', ':id')}}');


    </script>
@endsection


