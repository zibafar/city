@extends('miniLayout')
@section('title')
    خطای ۴۱۹
@endsection

@section('content')
        <div class="global_center">
            <form class="text-center white size330 center">
                <header>
                    <h2>
                    انقضای فرم
                    </h2>
                </header>
                <div class="form-body">
                    <p class="">شما در این صفحه خیلی منتظر ماندید کد امنیتی شما منقضی شد لطفا دوباره تلاش کنید</p>
                    <a href="{{ url()->previous() }}">بازگشت به صفجه قبل</a>
                </div>
            </form>
    </div>
</div>
@endsection
