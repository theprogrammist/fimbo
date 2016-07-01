<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;
use App\Page;
use Validator;

class LectionController extends Controller
{
    public function show($lectionId = null, $pageNum = null, Request $request)
    {
        $lection = Page::find($lectionId);
        return view('lections', compact('lectionId','pageNum','lection'));
    }
}
