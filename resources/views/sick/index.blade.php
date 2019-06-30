@extends('layout')


@section('css')
    <link rel="stylesheet" href="{{asset('/')}}/css/jquery.dataTables.css">

@endsection

@section('content')

    <div class="col-lg-10">
        <div class="show_area">

            @include('partial.showError')
            @include('partial.validationError')
            <h3 class="text-center">گروه های درسی</h3>

            <!--  Table: -->
            <table id="example" class="table table-bordered" style="width:100%">
                <thead>
                <tr>
                    <th class="text-center">کد</th>
                    <th class="text-center">استاد</th>
                    <th class="text-center">دانشجویان ورودی ترم</th>
                    <th class="text-center"> دانشگاه</th>
                    <th class="text-center"> رشته</th>
                    <th class="text-center">درس</th>
                    <th class="text-center">واحد</th>
                    <th class="text-center">دستیاران</th>
                    <th class="text-center">وقت امتحان</th>
                    <th class="text-center">امکانات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($courses as $course)
                    <tr>
                        <td class="text-center">{{$course->id}}</td>
                        <td class="text-center">{{$course->user->getFullName()}}</td>
                        <td class="text-center">{{$course->term->year.' - '.$course->term->season}}</td>
                        <td class="text-center"> {{@$course->department->name}}</td>
                        <td class="text-center"> {{$course->lessonMajor->major->code}}</td>

                        <td class="text-center">({{$course->lessonMajor->lesson->code}}
                            ) {{$course->lessonMajor->lesson->name}} </td>
                        <td class="text-center">
                            {{$course->lessonMajor->unit}} واحدی
                        </td>
                        <td class="text-center">
                            @if(count($course->assists)>0)
                                @foreach($course->assists as $assist)

                                    {{$assist->parent->getFullName()}}
                                    <br>
                                @endforeach
                            @endif

                        </td>

                        <td class="text-center">
                            {!! $course->program_exam !!}
                        </td>

                        <td class="text-center tools_box">
                            <a href="{{route('updateCourse',$course->id)}}">
                                <span class="icon fa fa-pencil-alt"></span>
                            </a>


                            <a class="add_to_delete" style="display: inline-block" data-itemdetails="{{$course->id}}"
                               data-deleteurl="{{route('courses.destroy',$course->id)}}">

                                <span class="icon fa fa-trash-alt"></span>
                            </a>


                            <a href="{{route('students.course',$course)}}">
                                <span class="icon fa fa-users"></span>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>

                    <th class="text-center">کد</th>
                    <th class="text-center">استاد</th>
                    <th class="text-center">دانشجویان ورودی ترم</th>
                    <th class="text-center"> دانشگاه</th>
                    <th class="text-center"> رشته</th>
                    <th class="text-center">درس</th>
                    <th class="text-center">واحد</th>
                    <th class="text-center">دستیاران</th>
                    <th class="text-center">وقت امتحان</th>
                    <th class="text-center">امکانات</th>
                </tr>
                </tfoot>
            </table>

        </div>
    </div>
    <div class="clearfix"></div>


    <div class="modal fade" id="modal_delete" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <p></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">لغو</button>
                    <button type="button" onclick="delete_row()" class="btn btn-primary">پاک شود</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
@endsection

@section('js')

    <script>
        $(document).ready(function() {
            // Setup - add a text input to each footer cell
            $('#example tfoot th').each( function () {
                var title = $(this).text();
                $(this).html( '<input type="text" class="form-control" placeholder="جستجوی '+title+'" />' );
            } );

            // DataTable
            var table = $('#example').DataTable();

            // Apply the search
            table.columns().every( function () {
                var that = this;

                $( 'input', this.footer() ).on( 'keyup change', function () {
                    if ( that.search() !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                } );
            } );
        } );

    </script>
    <script src="{{asset('/')}}js/jquery.dataTables.js"></script>


@endsection


