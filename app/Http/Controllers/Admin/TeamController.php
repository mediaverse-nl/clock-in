<?php

namespace App\Http\Controllers\Admin;

use App\Traits\FilterSessionTrait;
use App\Traits\getLocationTrait;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class TeamController extends Controller
{
    use getLocationTrait, FilterSessionTrait;

    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $this->filterItems(['user']);


        $users = $this->getBusinessFromUser()->users()->get();

        return view('admin.team.index')
            ->with('users', $users);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function roles()
    {
        return view('admin.team.roles');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $business = $this->getBusinessFromUser();

        return view('admin.team.create')
            ->with('business', $business);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $business_id = $this->getBusinessFromUser()->id;

        $random_password = str_random(8);

        $user = $this->user;
        $user->business_id = $business_id;
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
            ->route('admin.team.edit', $user->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $business = $this->getBusinessFromUser();

        if (!in_array($id, $business->users->pluck('id')->toArray())){
            return abort(403);
        }
        $user = $this->user->findOrFail($id);

        return view('admin.team.edit')
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
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        $weekArray = [];
        foreach ($request->availabilty as $k => $v){
            $weekArray[] = [
                'user_id' => $id,
                'start_monday' => $v['ma']['van'],
                'start_tuesday' => $v['di']['van'],
                'start_wednesday' => $v['wo']['van'],
                'start_thursday' => $v['do']['van'],
                'start_friday' => $v['vr']['van'],
                'start_saturday' => $v['za']['van'],
                'start_sunday' => $v['zo']['van'],
                'end_monday' => $v['ma']['tot'],
                'end_tuesday' => $v['di']['tot'],
                'end_wednesday' => $v['wo']['tot'],
                'end_thursday' => $v['do']['tot'],
                'end_friday' => $v['vr']['tot'],
                'end_saturday' => $v['za']['tot'],
                'end_sunday' => $v['zo']['tot'],
                'week_nr' => Carbon::now()->addWeeks($k)->weekOfYear,
            ];
        }

//        dd($weekArray);
        $user->availability()->delete();
        $user->availability()->insert($weekArray);

        $user->userFunctions()->delete();
        foreach ($request->functions as $function)
        {
            $user->userFunctions()->create([
                'user_id' => $user->id,
                'function_id' => $function
            ]);
        }

        return redirect()->back();

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
