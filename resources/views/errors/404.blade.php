@extends('miniLayout')
@section('title')
    خطای ۴۰۴
@endsection

@section('content')
        <div class="global_center">
            <form class="text-center white size330 center">
                <header>
                    <h2>
                    این صفحه وجود ندارد!
                    </h2>
                </header>
                <div class="form-body">
                    <p class="">{{$exception->getMessage()}}</p>
                    <a href="{{ url()->previous() }}">بازگشت به صفجه قبل</a>
                </div>
            </form>
    </div>
</div>
@endsection
