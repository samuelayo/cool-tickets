<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Adumskis\LaravelAdvert\Model\Advert;

class AdsEngineController extends \App\Http\Controllers\Controller
{
    //
    public function list(Request $request){
        // Advert::with('advert_category')->get();
        return View('ads.create');
    }

    public function createad(Request $request){
        Advert::make(
        $request->only(['alt', 'url',
        'active'=>TRUE,
        'advert_category_id'=>2
        ]), 
        $request->file('image')
        );
    }
}
