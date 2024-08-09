<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
 
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $nums = [4,3,4,1,1,4,1,4];
 


        $nums = array_filter($nums, function($value) {
            return $value > 0;
        });
        $nums = array_unique($nums);
        sort($nums = array_unique($nums));
                 for($i=1;$i<=count($nums);$i++) {
                        if($i < $nums[$i-1]) {
                           return $i;
                       }
                       else {
                           $latest = $nums[$i-1];
                       }
               }


                return $latest+1;
   
    }
}
