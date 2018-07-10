<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Webklex\IMAP\Client;

use App\Http\Controllers\Controller;

class MailController extends Controller
{
    protected $auth;

    public function __construct()
    {
        $this->auth = Auth::user();
    }

    public function index()
    {
        $oClient = new Client([
            'host'  => env('IMAP_HOST'),
            'port'  => env('IMAP_PORT'),
            'encryption'    => env('IMAP_ENCRYPTION'), // Supported: false, 'ssl', 'tls'
            'validate_cert' => env('IMAP_VALIDATE_CERT'),
            'username' => env('IMAP_USERNAME'),
            'password' => env('IMAP_PASSWORD'),
        ]);

        //Connect to the IMAP Server
        $oClient->connect();

        //Get all Mailboxes
        /** @var \Webklex\IMAP\Support\FolderCollection $aFolder */
        $aFolder = $oClient->getFolders('INDEX');

//        foreach($aFolder as $f){
//            $msg = $f->getMessages('ALL', null, false, false);
//            $paginator = $msg->paginate(5);
//
//            foreach($paginator as $m) {
////                $m;
//            }
//        }
//
//        foreach($aFolder as $oFolder){
//
//            //Get all Messages of the current Mailbox $oFolder
//            /** @var \Webklex\IMAP\Support\MessageCollection $aMessage */
//            $aMessage = $oFolder->getMessages();
//
//            $test = $oFolder->getMessages();
//    //        $oFolder = $oClient->getFolder('ALL');
//
////            dd($test);
//
//        }

        return view('mail.index')
            ->with('aFolder', $aFolder)
            ->with('oFolder', $aFolder);
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
