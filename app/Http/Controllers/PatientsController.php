<?php

namespace App\Http\Controllers;

use App\PatientsModel;
use Illuminate\Http\Request;

class PatientsController extends Controller
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
        $data = $request->all();
        $patient = new PatientsModel();
        $patient->name = $data['name'];
        $patient->surname = $data['surname'];
        $patient->phone = $data['phone'];
        $patient->doctor = $data['doctorName'];
        $patient->time = $data['time'];
        $patient->type = $data['type'];
        $patient->date = $data['date'];
        $patient->save();
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
        $data = PatientsModel::all();
        return $data;
    }
    public function getDataForTable(Request $request){
        $req = $request->all();
        $data = PatientsModel::get()->where('doctor',$req['doctor']);
        return $data;
    }
    public function getDataTable(){
        $data = PatientsModel::all();
        return $data;
    }

}
