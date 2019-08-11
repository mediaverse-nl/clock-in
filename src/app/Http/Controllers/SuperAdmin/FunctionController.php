<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Functions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FunctionController extends Controller
{
    protected $function;

    public function __construct(Functions $function)
    {
        $this->function = $function;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($business_id)
    {
        return view('admin.function.create')
            ->with('business_id', $business_id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $function = $this->function;

        $function->business_id = $request->business_id;
        $function->value = $request->value;

        $function->save();

        return redirect()
            ->route('super.business.edit', $request->business_id);
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
}
