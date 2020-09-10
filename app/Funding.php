<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\HomeController as HC;
use Carbon\Carbon;
use Auth;
use Validator;


class Funding extends Model
{
    protected $table='fundings';
    protected $primarykey='id';
    public $timestamp='true';
    protected $fillable = [ 'user_id','user_name','gender','phone','age','address','status','fund_amount',
                            'fund_reason','fund_gathered','fund_date','extra_info','expired_at', ];

    public static function storeFund($data)
    {  
        if($data['extra_info'] === null)
        {
            $extra = 'nothing';
        } else {
            $extra = $data['extra_info'];
        }
        $ex_dt = Carbon::create($data['fund_last_date'])->sub('1 day');
        try{
            self::Create([
                'user_id'=>Auth::user()->id,
                'user_name'=>$data['full_name'],
                'phone'=>$data['phone'],
                'age'=>$data['age'],
                'gender'=>$data['gender'],
                'address'=>$data['address'],            
                'fund_amount'=>$data['fund_amount'],
                'fund_reason'=>$data['fund_reason'],
                'fund_date'=>$data['fund_last_date'],
                'fund_gathered'=>0,
                'status'=>'offline',
                'expired_at'=>$ex_dt,
                'extra_info'=>$extra,
            ]);
            
        }catch(\Exception $exc){
            dd($exc);
        }
    }
}

