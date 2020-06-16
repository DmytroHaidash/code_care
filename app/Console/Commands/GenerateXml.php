<?php

namespace App\Console\Commands;

use App\Models\Hash;
use App\Models\UserDetails;
use App\User;
use Illuminate\Console\Command;
use SimpleXMLElement;

class GenerateXml extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'xml:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate xml with user info';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function getUserArray($id)
    {
        $user = User::where('id', $id)->get()->toArray();
        foreach ($user as $item) {
            $userBase = $item;
        }
        $user_info = UserDetails::where('user_id', $id)->orderBy('last_login', 'desc')->get()->toArray();
        foreach ($user_info as $item) {
            $userInfo = $item;
        }
        $user_hash = Hash::where('user_id', $id)->with('vocabulary')->orderBy('created_at', 'desc')->get()->toArray();

        return $userData = ['base_info' => $userBase, 'adv_info' => $userInfo, 'hash_info' => $user_hash];
    }

    public function arrayToXml(array $arr, SimpleXMLElement $xml)
    {
        foreach ($arr as $k => $v) {

            if (is_numeric($k)) {
                $k = 'item_' . $k;
            }

            is_array($v)
                ? $this->arrayToXml($v, $xml->addChild($k))
                : $xml->addChild($k, $v);
        }
        return $xml;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $structure = public_path('xml');

        if (!is_writable($structure)) {
            if (file_exists($structure)) {
                chmod($structure, 0777);
            } else {
                mkdir($structure, 0777, false);
            }
        }

        $users = User::all();

        foreach ($users as $user) {
            $xml = $this->arrayToXml($this->getUserArray($user->id), new SimpleXMLElement('<root/>'))->asXML();
            file_put_contents($structure . '/' . $user->name . '.xml', $xml);
        }
    }
}
