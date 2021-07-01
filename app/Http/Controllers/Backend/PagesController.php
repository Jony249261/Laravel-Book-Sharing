<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Author;
use App\Publisher;
use App\Book;

class PagesController extends Controller
{
    public function index(){

        $total_categories = count(Category::all());
    	$total_publishers = count(Publisher::all());
    	$total_books = count(Author::all());
    	$total_authors = count(Book::all());

        return view('backend.pages.index', compact('total_categories', 'total_publishers','total_books','total_authors'));
    }
}
