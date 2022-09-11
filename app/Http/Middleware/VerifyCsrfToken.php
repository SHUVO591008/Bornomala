<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        "general/status","header/status","news/status","news/scrollBar","about/status","service/status","instituteDetails/status","general/socialstatus","slider/status","general/leftposition","general/rightposition","general/footerposition","general/socialleftposition","general/socialrightposition","general/socialfooterposition","courseAdvertise/status","courseAdvertise/button/on/off","QuestionsAns/status","social/status","admin/details/status","contact/details/status","contact/social/status","class/classedit",
    ];
}
