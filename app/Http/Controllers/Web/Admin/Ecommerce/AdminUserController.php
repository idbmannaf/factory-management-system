<?php

namespace App\Http\Controllers\Web\Admin\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use League\Flysystem\Filesystem;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        menuSubmenu('users', 'all');
        $users = User::paginate(50);
        return view('admin.ecommerce.user.index', [
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.ecommerce.user.edit', [
            'user' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(User $user,Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'mobile' => 'required|string|unique:users,mobile,'.$user->id.',id',
            'nid' => 'required|max:255',
        ]);

        $user->name = $request->name ?? $user->name;
        $user->mobile = $request->mobile ?? $user->mobile;
        $user->nid = $request->nid ?? $user->nid;
        $user->dob = $request->dob ?? $user->dob;
        $user->save();

        // if ($request->img) 
        // {
            
        //     $file = $request->img;
        //     Storage::disk('public')->delete('storage/user/pp/'.$user->img_name);

        //     $originalName = $file->getClientOriginalName();
        //     Storage::disk('public')->put('storage/user/pp/'.$originalName, File::get($file));
        //     $user->img_name = $originalName;

        //     $user->save();
        // }

        if ($request->img) {
            // if ($user->img_name) {
            //     $n = $user->img_name;
            //     $d = url('/').'/storage';
            //     $img = ltrim($n,$d);
            //     $img = 'public/pro'.$img; // idk why this 'pro' was trimmed earlier
            //     // dd($img);
            //     Storage::delete($img);
            // }

            $cp = $request->img;
            $extension = strtolower($cp->getClientOriginalExtension());
            $randomFileName = $user->id.'_fi_'.date('Y_m_d_his').'_'.rand(10000000,99999999).'.'.$extension;
            $cp->storeAs('user/pp',$randomFileName , 'public');

            $user->img_name = url('/').'/storage'.'/user/pp/'.$randomFileName;
            $user->save();
        }

        return redirect()->back()->with('success', 'User is updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function updatePassword(User $user,Request $request)
    {
        if ($request->password) {
            $this->validate($request, [
                'password' => 'string',
            ]);

            $user->password_temp    = $request->password;
            $user->password         = Hash::make($request->password);
            $user->save();
        }else{
            $user->password_temp = rand(100000,999999);
            $user->password = Hash::make($user->password_temp);
            $user->save();
        }
        return redirect()->back()->with('success', 'Password is updated.');
    }
}
