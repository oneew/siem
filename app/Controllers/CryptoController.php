<?php

namespace App\Controllers;

class CryptoController extends BaseController
{
    public function hash_verifier()
    {
        $data['title'] = 'Hash Verifier & Generator (Persandian)';
        return view('crypto/hash_verifier', $data);
    }
}
