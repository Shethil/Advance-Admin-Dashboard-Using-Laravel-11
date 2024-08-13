<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;

class FrontendController extends Controller
{
    public function index($page_slug)
    {
        $page = Page::findBySlug($page_slug);
        return view('page_builder', compact('page'));
    }
}
