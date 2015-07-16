<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Request;

class RemoveArticleRequest extends Request
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
            //
        ];
    }
}
