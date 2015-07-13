<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  Tag $tag
     * @return Response
     */
    public function show(Tag $tag)
    {
        $articles = $tag->articles()->published()->paginate(3);

        return view('tags.show', compact('articles', 'tag'));
    }

}
