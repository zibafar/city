@extends('miniLayout')
@section('title')
    خطای دسترسی 403
@endsection
@section('content')
        <div class="global_center">
            <form class="text-center white size330 center">
                <header>
                    <h2>خطای دسترسی!</h2>
                </header>
                <div class="form-body">
                    <p class="">{{$exception->getMessage()}}</p>
                    <a href="{{ URL::previous() }}">بازگشت به صفجه قبل</a>
                </div>
            </form>
    </div>
</div>
@endsection
