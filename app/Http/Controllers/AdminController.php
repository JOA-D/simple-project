<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = Admin::with('user')->orderBy('id','desc')->paginate(5);
        return response()->view('admin.index',compact('admins'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator=Validator($request->all(),[
            'name' => "required|string|min:3|max:50",
            'mobile' => "required|string|min:3|max:10000",
            'email' => "required|email|unique:admins,email",
            'password' => "required",
        ],[
            'email.required' => "Enter Your Email",
            'password.required' => "Enter Your Password",
        ]);
        if(!$validator->fails()){
            $admins = new Admin();
            $admins->email = $request->get('email');
            $admins->password = Hash::make($request->get('password'));
            $isSaved = $admins->save();
            if($isSaved){
                $users = new User();
                $users->name=$request->get('name');
                $users->mobile=$request->get('mobile');
                $users->actor()->associate($admins);
                $isSaved=$users->save();
                return response()->json(['message'=>$isSaved ? "Saved is Successfully":"Saved is Failed"],$isSaved ? 200 :400);
            }else{
                return response()->json(['message' =>"Saved is Failed"],400);
            }
        } else {
            return response()->json(['message' => $validator-> getMessageBag()->first()],400);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admins = Admin::findOrFail($id);
        return response()->view('admin.edit',compact('admins'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator=Validator($request->all(),[
            'name' => "required|string|min:3|max:50",
            'mobile' => "required|string|min:3|max:10000",
        ],[
            'email.required' => "Please Enter Correct Email !",
        ]);
        if(!$validator->fails()){
            $admins = Admin::findOrFail($id);
            $admins->email = $request->get('email');
            $admins->password = Hash::make($request->get('password'));
            $isSaved = $admins->save();
            if($isSaved){
                $users = $admins->user;
                $users->name=$request->get('name');
                $users->mobile=$request->get('mobile');
                $users->actor()->associate($admins);
                $isSaved=$users->save();
                return response()->json(['message'=>$isSaved ? "update is Successfully":"update is Failed"],$isSaved ? 200 :400);
            }else{
                return response()->json(['message' =>"update is Failed"],400);
            }
        } else {
            return response()->json(['message' => $validator-> getMessageBag()->first()],400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admins = Admin::destroy($id);
        return response()->json(['message'=>$admins ? "Deleted is Successfully":"Deleted is Failed"]);
    }
}
