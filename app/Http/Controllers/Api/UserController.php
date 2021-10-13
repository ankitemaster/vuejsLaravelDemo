<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = User::query();
        if($request->get('search')) {
            $query->where('name', 'like', '%'.$request->get('search').'%');
        }
        if($request->get('filter')) {
            // $query->like('name', $request->get('search'));
        }
        return response()->json([
            'status' => true,
            'message' => 'User List Get Successfully',
            'data' => $query->orderBy('id', 'desc')->get()
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
        $validated = Validator::make($request->all() ,[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        if($validated->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validated->errors()->first(),
                'data' => []
            ]);
        }
        User::create($request->all());
        return response()->json([
            'status' => true,
            'message' => 'User Created Successfully',
            'data' => []
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id', $id)->first();
        if($user->profile) {
            $user->profile = url('images').'/'.$user->profile;
        }
        return response()->json([
            'status' => true,
            'message' => 'User Data Get Successfully',
            'data' => [
                $user
            ]
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
    public function update(Request $request, $id)
    {
        $name = '';
        if($request->hasFile('profile')) {
            $image = $request->file('profile');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $request->merge(['profile'=>$name]);
        }
        User::where('id', $id)->update(
            [
                'name' => $request->name,
                'mobile' => $request->mobile,
                'profile' => $name
            ]
        );
        $user = User::find($id);
        if($user->profile) {
            $user->profile = url('images').'/'.$user->profile;
        }
        return response()->json([
            'status' => true,
            'message' => 'User Updated Successfully',
            'data' => [$user]
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::where('id', $id)->delete();
        return response()->json([
            'status' => true,
            'message' => 'User Deleted Successfully',
            'data' => []
        ]);
    }
}
