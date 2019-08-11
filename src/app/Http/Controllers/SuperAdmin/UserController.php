<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Business;
use App\User;
use function Composer\Autoload\includeFile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $user;

    protected $business;

    public function __construct(Business $business, User $user)
    {
        $this->user = $user;
        $this->business = $business;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($business_id)
    {
        $business = $this->business->findOrFail($business_id);

        return view('admin.user.create')
            ->with('business', $business)
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
        $random_password = str_random(8);

        $user = $this->user;
        $user->business_id = $request->business_id;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($random_password);
        $user->save();

        foreach ($request->functions as $function)
        {
            $user->userFunctions()->create([
                'user_id' => $user->id,
                'function_id' => $function
            ]);
        }


//        todo this must send email
//        Mail::to($user->email)->send(new RegisterdAccount($user, $random_password));

        return redirect()
            ->route('super.business.edit', $request->business_id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->user->findOrFail($id);

        return view('admin.user.edit')
            ->with('user', $user);
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
        $user = $this->user->findOrFail($id);

        $user->save();

        return redirect()->route('super.business', $user->business->id);
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
