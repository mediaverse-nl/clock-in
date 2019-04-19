<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Business;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BusinessController extends Controller
{
    protected $business;

    public function __construct(Business $business)
    {
        $this->business = $business;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $business = $this->business->get();

        return view('super-admin.business.index')
            ->with('business', $business);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.business.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        todo validation of request
        $business = $this->business;

        $business->save($request->all());

        $business->package()->create([
            'business_id' => $business->id,
            'price' => 0
        ]);
        $business->settings()->create([
            'business_id' => $business->id,
            'user_unit_price' => 0
        ]);

        return redirect()
            ->route('super.business.edit', $business->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $business = $this->business->findOrFail($id);

        return view('admin.business.show')
            ->with('business', $business);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $business = $this->business->findOrFail($id);

        return view('super-admin.business.edit')
            ->with('business', $business);
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
