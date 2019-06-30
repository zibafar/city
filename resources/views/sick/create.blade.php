@extends('layout')


@section('css')
    <link href="{{asset('/')}}/css/bootstrap-toggle.min.css" rel="stylesheet">
    <style>
        .toggle.ios, .toggle-on.ios, .toggle-off.ios {
            border-radius: 20px;
        }

        .toggle.ios .toggle-handle {
            border-radius: 20px;
        }
    </style>
@endsection


@section('content')
    <div class="col-lg-10">
        <h2 class="text-center main_titr">ثبت بیمار</h2>
        <!--  Form for Add New Lesson: -->
        <div class="show_area for_form">
            @include('partial.showError')
            @include('partial.validationError')
            <br>
            <br>
            <form class="text-center" method="post" action="{{route('sicks.store')}}">
                {{csrf_field()}}
                <div class="form-group">
                    <div class="profile_head text-center">
                        <div class="pro_box text-center like_input">
                            <div class="imageBox">
                                <img src="{{asset('/')}}/images/default_img.jpg" class="inp_img" alt="">
                            </div>
                            <br>
                            <div class="mehr_btn mehr_btn-danger upload_file_btn">افزودن تصویر کاربری</div>
                            <input class="form-control my_trigger imgInp" type="file" name="img">

                            <!--                        <input class="mehr_btn mehr_btn-danger upload_file_btn" type="file" name="img">-->
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4">
                            <div class="field_box">
                                <label>نام</label>
                                <span class="icon fa fa-user"></span>
                                <input type="text" name="fname" value="{{old('fname')}}" class="form-control" placeholder="نام" autocomplete="off">
                            </div>
                            <div class="field_box">
                                <label>نام خانوادگی</label>
                                <span class="icon fa fa-user"></span>
                                <input type="text" name="lname" value="{{old('lname')}}" class="form-control" placeholder="نام خانوادگی" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="field_box">
                                <label>گذرواژه</label>
                                <span class="icon fa fa-lock"></span>
                                <input type="password" name="password" value="{{old('password')}}" id="password" class="form-control" placeholder="گذرواژه" autocomplete="off">
                                <span class="icon fa fa-eye ui-component__password-field__show-hide" style="position: absolute; right: 90%; cursor: pointer;" onclick="toggle(this);"></span>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="field_box">
                                    <label>استان</label>
                                    <select name="province" id="province_id" class=" select2-dropdown form-control">
                                        <option >استان را انتخاب کنید</option>
                                        @foreach($provinces as $province)
                                            <option data-url="{{route('ajax.province',$province->id)}}"
                                                    @if(old('major') == $province->id) selected @endif value="{{$province->id}}">
                                                {{$province->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="field_box">
                                    <label for="county">شهرستان را انتخاب کنید </label>
                                    <select  data-url="{{route('ajax.county')}}" name="county" id="county" class=" select2-dropdown form-control">
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="field_box">
                                    <label for="city">شهر را انتخاب کنید </label>
                                    <select name="city" id="city" class=" select2-dropdown form-control">
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>


                    <div class="col-lg-8">
                        <div class="btn_box text-center max_width">
                            <!-- Button of Run the Modal Dialog: -->
                            <button class="mehr_btn mehr_btn-danger" type="submit"> تایید</button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
    <div class="clearfix"></div>
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function () {
            $('select[name="province"]').on('change', function () {
                $('#county').empty();
                var ProvinceID = $(this).val();
                var url = $("#province_id option:selected").data('url');
                console.log(url);
                if (ProvinceID) {
                    $.ajax({
                        url: url,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            if (data.status === 'success') {
                                $.each(data.content, function (key, value) {
                                    $('select[name="county"]').append('<option  value="' + value.id + '">' + value.name
                                        + '</option>');
                                    console.log(value.id);

                                });
                            }

                        }
                    });
                }
            });
            $('select[name="county"]').on('change', function () {
                $('#city').empty();
                var CountyID = $(this).val();
                var url = $("#county").data('url');
                console.log(url);
                if (CountyID) {
                    $.ajax({
                        url: url+'/'+CountyID,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            if (data.status === 'success') {
                                $.each(data.content, function (key, value) {
                                    $('select[name="city"]').append('<option  value="' + value.id + '">' + value.name
                                        + '</option>');
                                    console.log(value.id);

                                });
                            }

                        }
                    });
                }
            });

        });

    </script>

    <script src="{{asset('/')}}js/bootstrap-toggle.min.js"></script>
    <script src="{{asset('/')}}js/mytoggle.js"></script>
@endsection



