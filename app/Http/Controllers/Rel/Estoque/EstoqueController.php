<?php

namespace App\Http\Controllers\Rel\Estoque;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class EstoqueController extends Controller
{
    public function index(){
        return view('rel.estoque.index');
    }
}
