<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sellings;

class SellingsController extends Controller
{
    public function index()
    {
        return Sellings::all();
    }

    public function create(Request $request)
    {
        $sellings = new Sellings();
        $sellings->antrian = $this->antrian();
        $sellings->total = $request->input('total');
        $sellings->money = $request->input('money');
        $sellings->change = $request->input('change');
        $sellings->save();
        return response()->json($sellings);
    }

    public function antrian()
    {
        $date_ym = date('ym');
        $date_between = [date('Y-m-01 00:00:00'), date('Y-m-t 23:59:59')];
        
        $antrian = Sellings::select('antrian')
  			->whereBetween('created_at',$date_between)
  			->orderBy('antrian','desc')
              ->first();
        
              if(is_null($antrian)) {
                $nowcode = '00001';
            } else {
                $lastcode = $antrian->antrian;
                $lastcode1 = intval(substr($lastcode, -5))+1;
                $nowcode = str_pad($lastcode1, 5, '0', STR_PAD_LEFT);
            }
  
            return 'antrian-'.$date_ym.'-'.$nowcode;
    }
}
