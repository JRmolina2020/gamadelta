<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Provider;
use Illuminate\Support\Facades\DB;

class ProviderController extends Controller
{
    public function index()
    {
        $providers = DB::table('providers')->select('id', 'name','company','phone')
        ->orderBy('id', 'ASC')->get();
        return $providers;
    }
 
}
