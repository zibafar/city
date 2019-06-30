@extends('layout')

@section('content')
    <div class="col-lg-10">
        <h2 class="text-center main_titr">ویرایش گروه درسی</h2>
        <!--  Form for update New Lesson: -->
        <div class="show_area for_form">
            @include('partial.showError')
            @include('partial.validationError')
            <br>
            <br>
            <form class="text-center" method="post" action="{{route('updateCoursePost',$course->id)}}">
                {{csrf_field()}}
                <div class="form-group">
                    <div class="col-lg-4">
                        <div class="field_box">
                            <label>استاد</label>
                            <select name="teacher" class=" select2-dropdown form-control">
                                @foreach($teachers as $teacher)
                                    <option @if($course->user_id == $teacher->id ) selected
                                            @endif value="{{$teacher->id}}">{{$teacher->getFullName()}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="field_box">
                            <label>دانشجویان ورودی ترم</label>
                            <select name="term" class="form-control">
                                @foreach($terms as $term)
                                    <option @if($course->term_id == $term->id ) selected
                                            @endif value="{{$term->id}}">{{$term->year .'-'. $term->season}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="field_box">
                            <label>درس - رشته</label>

                            <select name="lesson" class=" select2-dropdown form-control">
                                @foreach($lessons as $lesson)
                                    <option @if($course->lesson_majors_id == $lesson->id) selected
                                            @endif value="{{$lesson->id}}">({{$lesson->lesson->code}}
                                        ) {{$lesson->lesson->name}} {{$lesson->unit}} واحد
                                        - {{$lesson->major->name}} </option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="col-lg-4">
                        <div class="field_box">
                            <label>دانشگاه</label>
                            <select name="dept" id="dep_id" class=" select2-dropdown form-control">
                                <option >موسسه را انتخاب کنید</option>
                                @foreach($depts as $dept)
                                    <option
                                            @if($course->dept_id == $dept->id) selected
                                            @endif
                                            value="{{$dept->id}}">{{$dept->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    <br>
                    <br>
                    <br>
                    <div class="col-lg-6">
                        <div class="field_box">
                            <label>انتخاب دستیار</label>
                            <select class="select2-multiple form-control" name="users[]" multiple="multiple">
                                @foreach($assists as $assist)
                                    <option @if(in_array($assist->id,$relatedAssists)) selected
                                            @endif value="{{$assist->id}}">{{$assist->getFullName()}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="field_box">
                            <label>فعال</label>
                            <select name="status" class="form-control">
                                <option @if($course->status == 1 ) selected @endif value="1">فعال</option>
                                <option @if($course->status == 0 ) selected @endif value="0">غیر فعال</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4">
                            <div class="field_box">
                                <label>تاریخ امتحانات</label>
                                <input name="date_exam" id="dateInput" class="form-control" type="text"
                                       autocomplete="off"
                                       value="{{!empty($course->date_exam)? \App\Assistance::convertDateToJalaliToShow($course->date_exam): '1398/04/13'}}">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="field_box">
                                <label>ساعت آغاز</label>
                                <input type="time" id="begin_exam" name="begin_exam" class="form-control"
                                       min="8:00" max="21:00" step="300" value="{{!empty($course->start)? $course->start : "15:00"}}" >
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="field_box">
                                <label>ساعت پایان </label>
                                <input type="time" id="end_exam" name="end_exam" class="form-control"
                                       min="9:00" max="22:00" step="300" value="{{!empty($course->end)? $course->end : "17:00"}}" >
                            </div>
                        </div>



                    </div>


                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <div class="btn_box text-center">
                        <!-- Button of Run the Modal Dialog: -->
                        <button class="mehr_btn mehr_btn-danger" type="submit">تایید</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="clearfix"></div>
@endsection


