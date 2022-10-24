<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function getInfo()
    {
        $data = auth()->user();
        return response()->json($data, 200);
    }

    public function updateProfile(Request $request)
    {
        // dd($request->all());
        $user           = auth()->user();
        $validation = Validator::make($request->all(),[
            'name'      => 'required|max:255',
            'email'     => 'email|string|max:255|unique:users,email,'.$user->id,
            'mobile'    => 'required|string|max:255|unique:users,mobile,'.$user->id,
            'gender'    => 'required',
            'dob'       => 'required|max:255',
        ]);

        if ($validation->fails()) {
            return response()->json($validation->errors(), 209);
        }

        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->mobile   = $request->mobile;
        $user->gender   = $request->gender;
        $user->dob      = $request->dob;
        $user->save();

        return response()->json($user, 200);

    }
    public function uploadProfilePicture(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'image' => 'image|max:512',
        ]);
        if ($validation->fails()) {
            return response()->json($validation->errors(), 209);
        }
        $user = auth()->user();
        if ($request->hasFile('image')) {

            $pp = $request->file('image');
            $extension = strtolower($pp->getClientOriginalExtension());

            if($user->img_name)
            {
                // $f = 'product/fi/'.$newProduct->feature_img;
                // if(Storage::disk('upload')->exists($f))
                // {
                //     Storage::disk('upload')->delete($f);
                // }
                $img = ltrim($user->img_name, url('/').'/storage');
                $img = '/public/'.$img;
                Storage::delete($img);
            }

            $randomFileName = $user->id.'_fi_'.date('Y_m_d_his').'_'.rand(10000000,99999999).'.'.$extension;

            $pp->storeAs('user/pp',$randomFileName , 'public');
            $user->img_name = url('/').'/storage'.'/user/pp/'.$randomFileName;
            $user->save();

            return response()->json($user, 200);
        }
    }
}
