<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($page)
    {
        if (view()->exists("pages.{$page}")) {
            $title = 'Light Bootstrap Dashboard Laravel by Creative Tim & UPDIVISION';
            $navName = ucfirst($page);
            $activeButton = 'laravel';
            
            return view("pages.{$page}", [
                'activePage' => $page,
                'title' => $title,
                'navName' => $navName,
                'activeButton' => $activeButton
            ]);
        }
        return abort(404);
    }
}
