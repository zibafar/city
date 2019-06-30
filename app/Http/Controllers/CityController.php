<?php

namespace App\Http\Controllers;

use App\City;
use App\County;
use App\Province;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function ajaxProvince($id = null)
    {
        $data['status'] = 'success';
        $data['message'] = 'اطلاعات دریافت شد';
        $data['content'] = null;
        try {
            $province = Province::findOrFail($id);
            $counties=$province->counties;

            $data['content'] = $counties;

        } catch (\Exception $ex) {
            $data['status'] = 'fail';
            $data['message'] = $ex->getMessage();
        } finally {
            echo json_encode($data);
        }
    }
    public function ajaxCounty($id = null)
    {
        $data['status'] = 'success';
        $data['message'] = 'اطلاعات دریافت شد';
        $data['content'] = null;
        try {
            $county = County::findOrFail($id);
            $cities=$county->cities;

            $data['content'] = $cities;

        } catch (\Exception $ex) {
            $data['status'] = 'fail';
            $data['message'] = $ex->getMessage();
        } finally {
            echo json_encode($data);
        }
    }


}
