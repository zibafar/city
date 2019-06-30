<?php

namespace App\Http\Controllers;

use App\County;
use App\Province;
use App\Sick;
use Illuminate\Http\Request;

class SickController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sicks =  Sick::get();
//        return view('users.index.expert',compact('experts'));

        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provinces=Province::get();

        return view('sick.create',compact('provinces'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $messages = [
            'type.required' => 'نوع نا معتبر.',
            'type.in' => 'نوع نا معتبر.',
            'count.required' => 'تعداد باید وارد شود.',
            'count.numeric' => 'تداد باید عددی باشد.',
            'count.min' => 'تعداد حداقل باید ۱ باشد.',
            'count.max' => 'تعداد حداکثر باید ۲۰ باشد.',
            'begin.date_format' => 'ساعت شروع نامعتبر.',
            'begin.required' => 'ساعت شروع باید وارد شود.',
            'begin.before' => 'ساعت شروع باید قبل از ساعت پایان باشد.',

            'date.required' => 'تاریخ باید وارد شود.',
            'date.date_format' => 'تاریخ نامعتبر.',
            'major.required' => 'رشته نامعتبر.',
            'major.exists' => 'رشته نامعتبر.',
            'major.numeric' => 'رشته نامعتبر.',
        ];
        $this->validate($request, [
            'type' => 'required|in:مجازی,حضوری',
            'count' => 'required|numeric|min:1',
            'time_item_input' => 'required',
            'date' => 'required|date_format:"Y/m/d"',
            'major' => 'numeric|nullable',
        ], $messages);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sick  $sick
     * @return \Illuminate\Http\Response
     */
    public function show(Sick $sick)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sick  $sick
     * @return \Illuminate\Http\Response
     */
    public function edit(Sick $sick)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sick  $sick
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sick $sick)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sick  $sick
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sick $sick)
    {
        //
    }


}
