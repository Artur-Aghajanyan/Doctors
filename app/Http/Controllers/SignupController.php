<?php

namespace App\Http\Controllers;

use App\SignupModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SignupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $exploded = explode(',',$request->image);
        $decoded = base64_decode($exploded[1]);
        if(str_contains($exploded[0],'jpeg'))
            $extension ='jpg';
        else
            $extension = 'png';
        $fileName = Str::random().'.'.$extension;
        $path = public_path().'/images/'.$fileName;
        file_put_contents($path, $decoded);


        $data = $request->all();
        $signup = new SignupModel();
        $signup->name = $data['name'];
        $signup->surname = $data['surname'];
        $signup->email = $data['email'];
        $signup->password = $data['password'];
        $signup->about = $data['about'];
        $signup->speciality = $data['speciality'];
        $signup->image = $fileName;
        $signup->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
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
    public function getData(){
        $contact = SignupModel::get(['email']);
        return $contact;
    }
}
