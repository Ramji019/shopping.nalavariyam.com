<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	public $ismobile;
	public $viewprefix;

    public function __construct()
    {
        $this->ismobile = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "mobile")) || is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "tablet"));
        $this->viewprefix =  $this->ismobile ? "mobile/" : "";
    }
}
