<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class AuthController extends Controller {

    public function me() {
        return [
            "nis" => 3103118139,
            "name" => "Wendri Tri Pambudi",
            "gender" => "Laki-laki",
            "phone" => 6282226481208,
            "class" => "XII RPL 4"
        ];
    }
}