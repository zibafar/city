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
            $('select[name="major"]').on('change', function () {
                $('#lesson').empty();
                var majorID = $(this).val();
                var url = $("#major_id option:selected").data('url');
                console.log(url);
                if (majorID) {
                    $.ajax({
                        url: url,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            if (data.status === 'success') {
                                $.each(data.content, function (key, value) {
                                    $('select[name="lesson"]').append('<option value="' + value.id + '">' + value.lesson.name + '-' + value.unit + 'واحدی'
                                        + '</option>');
                                    // console.log('<option value="' + value.id + '">' + value.lesson.name + '-' + value.unit + 'واحدی'
                                    // + '</option>');
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



