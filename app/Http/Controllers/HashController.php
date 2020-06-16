<?php

namespace App\Http\Controllers;

use App\Models\Hash;
use App\Models\Vocabulary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HashController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hashes = Hash::where('user_id', '=', Auth::user()->id)
            ->orderBy('created_at', 'DESC')
            ->get();

        $hashesArr = [];

        foreach ($hashes as $key => $value) {
            $hashesArr[$key]['id'] = $value->id;
            $hashesArr[$key]['origin'] = $value->vocabulary->word;
            $hashesArr[$key][$value->algorithm] = $value->hash;
            $hashesArr[$key]['created_at'] = $value->created_at->format('Y-m-d H:m');
        }

        if (!$hashesArr) {
            return abort(404);
        }

        return response()->json($hashesArr, $status=200, $headers=[], $options=JSON_PRETTY_PRINT);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->all());
        $word_id = Vocabulary::where('word', $request->word)->first()->id;
        $hash = new Hash();
        $hash->algorithm = ($request->algorithm);
        $hash->hash = ($request->hash);
        $hash->user_id = (Auth::user()->id);
        $hash->vocabulary_id = ($word_id);
        $hash->save();
        return redirect()->route('user::hashes');
    }

    /**
     * @param Hash $hash
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Hash $hash)
    {
        $hash->delete();

        return redirect()->back()->with('success', 'Hash deleted');
    }
}
