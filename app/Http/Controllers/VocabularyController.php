<?php

namespace App\Http\Controllers;

use App\Http\Requests\HashViewRequest;
use App\Models\Vocabulary;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class VocabularyController extends Controller
{
    public function index():View
    {
        $vocabularies = Vocabulary::all();
        return view('vocabularies.index', compact('vocabularies'));
    }

    public function hashView(HashViewRequest $request)
    {
        $hashWords = [];

        foreach ($request->hash as $value) {
            if ($value === 'md5') {
                foreach ($request->words as $id => $word) {
                    $hashWords[$id]['algorithm']['MD5'] = hash('MD5', $word);
                    $hashWords[$id]['origin'] = $word;
                }
            }

            if ($value === 'sha256') {
                foreach ($request->words as $id => $word) {
                    $hashWords[$id]['algorithm']['SHA-256'] = hash('sha256', $word);
                    $hashWords[$id]['origin'] = $word;
                }
            }

            if ($value === 'sha512') {
                foreach ($request->words as $id => $word) {
                    $hashWords[$id]['algorithm']['SHA-512'] = hash('sha512', $word);
                    $hashWords[$id]['origin'] = $word;
                }
            }

            if ($value === 'sha1') {
                foreach ($request->words as $id => $word) {
                    $hashWords[$id]['algorithm']['SHA-1'] = hash('sha1', $word);
                    $hashWords[$id]['origin'] = $word;
                }
            }

            if ($value === 'blowfish') {
                foreach ($request->words as $id => $word) {
                    $hashWords[$id]['algorithm']['Blowfish'] = crypt($word, 'CRYPT_BLOWFISH');
                    $hashWords[$id]['origin'] = $word;
                }
            }
        }

        return view('vocabularies.result', ['data' => $hashWords]);
    }
}
