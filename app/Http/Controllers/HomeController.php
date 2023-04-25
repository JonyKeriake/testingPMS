<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    public function Car_Home()
    {
       try {
           $user_id = Auth::id();
           $favorites_location = DB::table('favorites')
               ->join('cars', 'favorites.car_id', '=', 'cars.id')
               ->where('favorites.user_id', '=', $user_id)
               ->select('cars.location')
               ->get();

           $relatedPosts = [];
           foreach ($favorites_location as $favorite) {
               $relatedPosts[] = Car::where('location', $favorite['location'])->get();
           }

           $Top_Rating_Posts = DB::table('rates')
               ->join('cars', 'rates.car_id', '=', 'cars.id')
               ->where('cars.type', '=', 'car')
               ->select('car_id', DB::raw('AVG(rate) as average_rate'))
               ->groupBy('car_id')
               ->orderByDesc('average_rate');

           return response()->json([
               'related Products' => $relatedPosts,
               'Top Rating' => $Top_Rating_Posts->get()
           ], 201);


       }catch(\Throwable $exception)
       {
           return response() -> json([
               'Status' => false  ,
               'Error Message' => $exception->getMessage() ,
           ] ,  500) ;
       }
    }
    public function Estate_Home()
    {
        try {
            $user_id = Auth::id();
            $favorites_location = DB::table('favorites')
                ->join('estates', 'favorites.estate_id', '=', 'estates.id')
                ->where('favorites.user_id', '=', $user_id)
                ->select('estates.location')
                ->get();

            $relatedPosts = [];
            foreach ($favorites_location as $favorite) {
                $relatedPosts[] = Car::where('location', $favorite['location'])->get();
            }

            $Top_Rating_Posts = DB::table('rates')
                ->join('estates', 'rates.estate_id', '=', 'estates.id')
                ->where('estates.type', '=', 'estate')
                ->select('estate_id', DB::raw('AVG(rate) as average_rate'))
                ->groupBy('estate_id')
                ->orderByDesc('average_rate');

            return response()->json([
                'related posts' => $relatedPosts,
                'Top Rating' => $Top_Rating_Posts->get()
            ], 201);


        }catch(\Throwable $exception)
        {
            return response() -> json([
                'Status' => false  ,
                'Error Message' => $exception->getMessage() ,
            ] ,  500) ;
        }
    }
}
