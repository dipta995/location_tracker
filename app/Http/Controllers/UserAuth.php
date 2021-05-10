<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class UserAuth extends Controller
{

    function userLogin(Request $request)
    {
      if ($request->has('loginpage'))
        {
            $request->validate([
                'email' => 'required',
                'password' => 'required',



            ]);

         $data = $request->input();
         $checkuser = User::where('email', '=',$data['email'])->where('password', '=', $data['password'])->get();
         foreach ($checkuser as $value) {
              $name = $value['name'];
              $id = $value['id'];
         }
         $rowcount = $checkuser->count();
         if ($rowcount>0) {
             $request->session()->put('user',$name);
             $request->session()->put('userid',$id);

             return redirect('/');
         }
         else{
             dd('false');
         }
        }



    }
}
