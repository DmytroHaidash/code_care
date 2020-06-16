<?php

namespace App\Http\Controllers;

use App\Models\UserDetails;
use App\User;
use Illuminate\Http\Request;
use App\Models\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hashes = Hash::where('user_id', '=', Auth::user()->id)
            ->orderBy('created_at', 'DESC')
            ->paginate(20);

        $userInfo = UserDetails::where('user_id', '=', Auth::user()->id)->orderBy('last_login', 'desc')->get()->first();
        return view('home', ['hashes' => $hashes, 'userInfo' => $userInfo]);

    }

    public function showFiles()
    {

        $dir = public_path('xml');
        $files = scandir($dir);

        $deleteStrOne = '.';
        unset($files[array_search($deleteStrOne, $files)]);

        $deleteStrTwo = '..';
        unset($files[array_search($deleteStrTwo, $files)]);

        return view('showXml', ['files' => $files]);
    }
}
