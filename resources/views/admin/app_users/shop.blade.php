<div class="modal-body">
        <input type="hidden" value="{{$app_user->id}}" name="id">
    <div class="row">
        <div class="col-12">
            <div class="form-group d-flex flex-column">
                <label for="name" class="form-control-label">البانر</label>
                <img src="{{asset($app_user->shop->banner)}}" alt="image" style="height: 250px; border-radius:10px; ">
            </div>
        </div>
    </div>

    <table class="table border mt-4">
        <thead>
        <tr>
            <th scope="col" class="border">اللوجو</th>
            <th scope="col">الاسم</th>
            <th scope="col" class="border">التصنيف الفرعى</th>
            <th scope="col">التصنيف الرئيسى</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row" class="border">
                <img src="{{asset($app_user->shop->logo)}}" alt="image" style="height: 70px;">
            </th>
            <td>{{$app_user->shop->title_ar}}</td>
            <td class="border">

                    <ul style="list-style-type: disclosure-closed; padding: 0 20px 0 0;">
                    @foreach($app_user->shop->shop_sub_cat as $value)
                        <li>{{ $value }}</li>
                    @endforeach
                    </ul>

            </td>


            <td>{{$app_user->shop->category->title_ar}}</td>
        </tr>
        </tbody>
    </table>


</div>
<script>
    $('.dropify').dropify()
</script>
