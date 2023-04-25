<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Estate;
use Illuminate\Http\Request;

class Search_Filter extends Controller
{

    public function Filter(Request $request)
    {
        try
        {

            $post = null ;

            if ($request['type'] == 'estate' )
            {
                if ($request['estate_type'] != null)
                    $post = \App\Models\Estate::where('estate_type' , $request['estate_type']);

                if ($request['operation_type'] != null)
                    $post = $post->where('operation_type' , $request['operation_type']) ;

                if ($request['location'] != null)
                    $post = $post->where('location' , $request['location'] );

                if ($request['locationInDamascus'] != null)
                    $post = $post->where('locationInDamascus' , $request['locationInDamascus']) ;

                if ($request['max_price']!=null)
                    $post = $post->where('price' , '<' , $request['max_price']) ;


                if ($request['min_price']!=null)
                    $post = $post->where('price' , '>' , $request['min_price']) ;

                if ($request['max_space']!=null)
                    $post = $post->where('space' , '<' , $request['max_space']) ;


                if ($request['min_space']!=null)
                    $post = $post->where('space' , '>' , $request['max_space']) ;

                if($post)
                    return response()->json([
                        'Status'=>true ,
                        'PostsSeeder'=> $post->get()
                    ],201) ;

            }


            if ($request['type'] == 'car' )
            {
                if ($request['operation_type'] != null)
                    $post = \App\Models\Car::where('operation_type' , $request['operation_type']) ;

                if ($request['transmission_type'] != null)
                    $post =  $post->where('transmission_type' , $request['transmission_type']) ;


                if ($request['brand'] != null)
                    $post =  $post->where('brand' , $request['brand']) ;

                if ($request['secondary_brand'] != null)
                    $post =  $post->where('secondary_brand' , $request['secondary_brand']) ;

                if ($request['color'] != null)
                    $post =  $post->where('color' , $request['color']) ;

                if ($request['location'] != null)
                    $post =  $post->where('location' , $request['location'] );

                if ($request['locationInDamascus'] != null)
                    $post =  $post->where('locationInDamascus' , $request['locationInDamascus']) ;

                if ($request['max_year']!=null)
                    $post = $post->where('year' , '<' , $request['max_year']) ;

                if ($request['min_year']!=null)
                    $post = $post->where('year' , '>' , $request['min_year']) ;


                if ($request['max_price']!=null)
                    $post = $post->where('price' , '<' , $request['max_price']) ;


                if ($request['min_price']!=null)
                    $post = $post->where('price' , '>' , $request['min_price']) ;

                if ($request['max_kilometers']!=null)
                    $post = $post->where('kilometers' , '<' , $request['kilometers']) ;

                if($post)
                    return response()->json([
                        'Status'=>true ,
                        'PostsSeeder'=> $post->get()
                    ],201) ;
            }
        }
        catch (\Exception $exception){

            return response()->json([
                'Status' => false ,
                'Message' => $exception->getMessage()
            ], 401) ;
        }

    }

    public function Search(Request $request)
    {
        try
        {
            $post = null ;

            if($request['search']!=null)
            {
                if ($request['type'] == 'car' )
                {
                    $post = Car::where('description' ,'like' ,'%'.$request['description'].'%');
                    if($post)
                        return response()->json([
                            'Status'=>true ,
                            'Estates'=> $post->get(),

                        ],201) ;
                }
                if ($request['type'] == 'estate' )
                {
                    $post = Estate::where('description' ,'like' ,'%'.$request['description'].'%');
                    if($post)
                        return response()->json([
                            'Status'=>true ,
                            'Estates'=> $post->get()
                        ],201) ;
                }

            }

        }
        catch (\Exception $exception){

            return response()->json([
                'Status' => false ,
                'Message' => $exception->getMessage()
            ], 401) ;
        }
    }
}
