<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use App\Article;
use App\Http\Requests\Request;

class EditArticleRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $article = $this->route()->parameter('articles');
        return Auth::user()->id == $article->user->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:3',
            'body' => 'required',
            'published_at' => 'required|date',
        ];
    }
}
