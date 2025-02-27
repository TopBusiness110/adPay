@extends('admin/layouts/master')

@section('title')
    {{($setting->name_en) ?? ''}} | المستخدمين
@endsection
@section('page_name')  المستخدمين @endsection
@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">  المستخدمين {{($setting->name_en) ?? ''}}</h3>
                    {{-- <a class="" href="{{ route('ad_packages.create') }}">
                        <button class="btn btn-secondary btn-icon text-white addBtn">
									<span>
										<i class="fe fe-plus"></i>
									</span> اضافة جديد
                        </button>
                    </a> --}}

                    <div class="">
                        <label class="form-label">فلترة المستخدمين</label>
                        <select id="status-filter">
                            <option value="all">الكل</option>
                            <option value="advertise">معلن</option>
                            <option value="user">مستخدم</option>
                            <option value="vendor">تاجر</option>
                        </select>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table table-striped table-bordered text-nowrap w-100" id="dataTable">
                            <thead>
                            <tr class="fw-bolder text-muted bg-light">
                                <th class="min-w-25px">#</th>
                                <th class="min-w-50px">الصورة</th>
                                <th class="min-w-50px">الاسم</th>
                                <th class="min-w-50px">الرقم</th>
                                <th class="min-w-50px">النوع</th>
                                <th class="min-w-50px">الحالة</th>
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

        <!-- Create Or Edit Modal -->
        <div class="modal fade" id="editOrCreate" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="example-Modal3">بيانات المتجر</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="modal-body">

                    </div>
                </div>
            </div>
        </div>
        <!-- Create Or Edit Modal -->
    </div>
    @include('admin/layouts/myAjaxHelper')
@endsection
@section('ajaxCalls')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>

        function showEditModal(routeOfEdit){
            $(document).on('click', '.showBtn', function () {
                var id = $(this).data('id')
                var url = routeOfEdit;
                url = url.replace(':id', id)
                $('#modal-body').html(loader)
                $('#editOrCreate').modal('show')

                setTimeout(function () {
                    $('#modal-body').load(url)
                }, 500)
            })
        }

        var columns = [
            {data: 'id', name: 'id'},
            {data: 'image', name: 'image'},
            {data: 'name', name: 'name'},
            {data: 'phone', name: 'phone'},
            {data: 'type', name: 'type'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]

        deleteScript('{{route('appUser.delete', ':id')}}');

        showEditModal('{{ route('showShop', ':id') }}');

        let ajax = {
            url: '{{route('appUsers.index')}}',
            data: function (d) {
                d.status = $('#status-filter').val(); // Assuming you have a select input with the id 'status-filter'
            }
        };
        showData(ajax, columns);

        $('#status-filter').on('change', function () {
            $('#dataTable').DataTable().destroy();
            ajax.data = function (d) {
                d.status = $('#status-filter').val(); // Assuming you have a select input with the id 'status-filter'
            }
            showData(ajax, columns)
        })



    </script>

<script>

    $(document).on('click', '.statusBtn', function() {
        var id = $(this).data('id');
        var val = $(this).is(':checked') ? 1 : 0;

        $.ajax({
            url: '{{ route('changeUserStatus') }}',
            type: 'post',
            data: {
                "_token": "{{ csrf_token() }}",
                'id': id,
                'status': val
            },
            success: function(data) {

                // Check if val is not equal to 0 before executing toastr.success()
                if (val !== 0) {
                    toastr.success('Success', 'تم التفعيل بنجاح');
                }
                else
                {
                    toastr.warning('Success', 'تم الغاء التفعيل');
                }
            },
        });
    });
</script>

@endsection


