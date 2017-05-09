<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Adumskis\LaravelAdvert\Model\Advert;
use Adumskis\LaravelAdvert\Model\AdvertCategory;

class AdsEngineController extends \App\Http\Controllers\Controller
{
    //
    public function list(Request $request){
        // Advert::with('advert_category')->get();
        $categories = AdvertCategory::all();
        return View('ads.create', compact('categories'));
    }

    public function createad(Request $request){
        Advert::make(
        [
            'alt'=>$request->get('alt'), 'url'=>$request->get('url'),
            'active'=>TRUE,
            'advert_category_id'=>$request->get('advert_category')
        ], 
        $request->file('image')
        );

        return redirect('/admin/adslist');
    }

    public function adslist(Request $request){
        $ads = Advert::with('advert_category')->get();
        return View('ads.list', compact('ads'));
    }

    public function adsedit(Request $request, Advert $id){
        $categories = AdvertCategory::all();
        return View('ads.edit', compact('id', 'categories'));

    }

    public function adseditpost(Request $request, Advert $id){
        if($request->hasFile('image')){
            if ($request->file('image')->isValid()) {
                $id->saveImage($request->image);
            }
        }
        $id->alt = $request->get('alt');
        $id->url = $request->get('url');
        $id->advert_category_id = $request->get('advert_category');
        $id->save();
        return redirect('/admin/adslist');
    }

  public function adsdelete(Request $request, Advert $id){
      $id->delete();
      return redirect('/admin/adslist');
  }
}
