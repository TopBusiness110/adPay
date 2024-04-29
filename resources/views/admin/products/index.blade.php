@extends('admin/layouts/master')

@section('title')
    {{($setting->name_en) ?? ''}} | المنتجات
@endsection
@section('page_name')  المنتجات @endsection
@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">  المنتجات {{($setting->name_en) ?? ''}}</h3>
                    {{-- <a class="" href="{{ route('ad_packages.create') }}">
                        <button class="btn btn-secondary btn-icon text-white addBtn">
									<span>
										<i class="fe fe-plus"></i>
									</span> اضافة جديد
                        </button>
                    </a> --}}
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table table-striped table-bordered text-nowrap w-100" id="dataTable">
                            <thead>
                            <tr class="fw-bolder text-muted bg-light">
                                <th class="min-w-25px">#</th>
                                <th class="min-w-50px">اسم المنتج</th>
                                <th class="min-w-50px">الصور</th>
                                <th class="min-w-50px">التاجر</th>
                                <th class="min-w-50px">النوع</th>
                                <th class="min-w-50px">السعر</th>
                                <th class="min-w-50px">الفئة</th>
                                <th class="min-w-50px">فئة الفرعية</th>
                                <th class="min-w-50px">الحاله</th>
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
            {data: 'title_ar', name: 'title_ar'},
            {data: 'images', name: 'images'},
            {data: 'vendor_id', name: 'vendor_id'},
            {data: 'type', name: 'type'},
            {data: 'price', name: 'price'},
            {data: 'shop_cat_id', name: 'shop_cat_id'},
            {data: 'shop_sub_cat', name: 'shop_sub_cat'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
        showData('{{route('products.index')}}', columns);

        deleteScript('{{route('product.delete', ':id')}}');


    </script>

<script>

    $(document).on('click', '.statusBtn1', function() {
        var id = $(this).data('id');
        var val = $(this).is(':checked') ? 1 : 0;

        $.ajax({
            url: '{{ route('changeProductsStatus') }}',
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


