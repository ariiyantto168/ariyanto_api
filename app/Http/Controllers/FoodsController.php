<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Foods;



class FoodsController extends Controller
{

    public function index()
    {
        return Foods::all();
    }

    public function create(Request $request)
    {
        $foods = new Foods();
        $foods->code = $this->get_code();
        $foods->namefoods = $request->input('namefoods');
        $foods->price = $request->input('price');
        $foods->hargadasar = $request->input('hargadasar');
        $foods->laba = $request->input('laba');
        $foods->description = $request->input('description');
        $foods->save();
        return response()->json($foods);
    }

    public function update(Request $request)
    {
        $foods = Foods::find($request->idfoods);
        $foods->namefoods = $request->input('namefoods');
        $foods->price = $request->input('price');   
        $foods->hargadasar = $request->input('hargadasar');
        $foods->laba = $request->input('laba');
        $foods->description = $request->input('description');
        $foods->save();
        return response()->json($foods);
    }
  


    public function get_code()
    {
        $date_ym = date('ym');
        $date_between = [date('Y-m-01 00:00:00'), date('Y-m-t 23:59:59')];
        
        $dataFoods = Foods::select('code')
  			->whereBetween('created_at',$date_between)
  			->orderBy('code','desc')
              ->first();
        
              if(is_null($dataFoods)) {
                $nowcode = '00001';
            } else {
                $lastcode = $dataFoods->code;
                $lastcode1 = intval(substr($lastcode, -5))+1;
                $nowcode = str_pad($lastcode1, 5, '0', STR_PAD_LEFT);
            }
  
            return 'code-'.$date_ym.'-'.$nowcode;
    }    
}
