<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoanDdetails;
use App\Models\EmiDetails;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function processData(Request $request){



      $check_table_exist = Schema::hasTable('emi_details');

        if($check_table_exist == true)
        {
            Schema::drop('emi_details');
        }


                Schema::connection('mysql')->create('emi_details', function($table)
                {
                    $loan_details  =  LoanDdetails::orderBy('num_of_payment','DESC')->first();



                     $min_date =    LoanDdetails::orderBy('first_payment_date','ASC')->first()->first_payment_date;
                     $max_date  =    LoanDdetails::orderBy('first_payment_date','DESC')->first()->last_payment_date;


                    $period = \Carbon\CarbonPeriod::create( $min_date, '1 month',  $max_date);

                    $arr=[];
                    foreach ($period as $dt) {

                        array_push($arr, $dt->format("Y")."_".$dt->format('F'));
                    }

                    $table->integer('id');
                    $table->increments('clientid');
                    foreach ($arr as $key => $value) {
                        $table->string($value)->nullable();
                    }
                    $table->timestamps();
                });

                $all_loan_details  =  LoanDdetails::get();
                $id=1;
                foreach ($all_loan_details as $key => $loan_details) {

                    $emi = $loan_details->loan_amount/$loan_details->num_of_payment;

                    $period = \Carbon\CarbonPeriod::create( $loan_details->first_payment_date, $loan_details->last_payment_date);

                    $arr1=[];
                    foreach ($period as $dt) {
                        array_push($arr1, $dt->format("Y")."_".$dt->format('F'));
                    }


                    $allEmiDetails = EmiDetails::get();

                    $EmiDetails = new EmiDetails();
                    $EmiDetails->id = $id;
                    $EmiDetails->clientid = $loan_details->clientid;
                    foreach($arr1 as $k => $mc)
                    {

                        $EmiDetails->setAttribute($mc, $emi);

                    }
                    $EmiDetails->save();
                    $id++;

                }
                $emi_details = EmiDetails::get();

                 $table_head=  Schema::getColumnListing('emi_details');
                return view('emi_details/emi_details',compact('emi_details','table_head'));

    }


public function loan_details()
{


    $loan_details  =  LoanDdetails::get();

    return view('loan_details/loan_details',compact('loan_details'));

}



}

