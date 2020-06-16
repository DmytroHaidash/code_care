<?php

namespace App\Listeners;

use App\Models\UserDetails;
use Carbon\Carbon;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class LogSuccessfulLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    public function handle(Login $event)
    {
        // Country
        $region_data = json_decode(file_get_contents("http://ipinfo.io/" . Request::ip() . "/"));
        if (!empty($region_data->country)) {
            $country = $region_data->country;
        } else {
            $country = 'Not defined';
        }

        // Cookies
        $cookie = json_encode(Request::cookie());
        if (empty($cookie)) {
            $cookie = 'Not defined';
        }

        // Browser
        $user_agent = Request::header('User-Agent');
        if (strpos($user_agent, "Firefox") !== false) $browser = "Firefox";
        elseif (strpos($user_agent, "Opera") !== false) $browser = "Opera";
        elseif (strpos($user_agent, "Chrome") !== false) $browser = "Chrome";
        elseif (strpos($user_agent, "MSIE") !== false) $browser = "Internet Explorer";
        elseif (strpos($user_agent, "Safari") !== false) $browser = "Safari";
        else $browser = "Not defined";

        // Insert Data to DB
        UserDetails::create([
            'ip' => Request::ip(),
            'user_id' => Auth::user()->id,
            'browser' => $browser,
            'country' => $country,
            'cookies' => $cookie,
            'last_login' => Carbon::now()
        ]);
    }
}
