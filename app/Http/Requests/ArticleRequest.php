<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Article;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Authorsofarticle;

class ArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:3|max:100',
            'summary' => 'required',
            'pdffile' => 'mimes:pdf',
            'startpage' => 'required|numeric',
            'endpage' => 'required|numeric',
        ];
    }

    /**
     * Add Publication
     * @param string $type
     *
     * @return Illuminate\Routing\Redirector
     */
    public function add()
    {
        #Create a new article
        $article = new Article();
        $article->user_id = auth()->user()->id;
        $article->title = $this->title;
        $article->summary = $this->summary;

        //// pdf file upload //////
        $fileName = time().'.'.$this->pdffile->extension();
        $this->pdffile->move(public_path('uploads'), $fileName);
        $article->pdffile = $fileName;
        ///////////////////////////

        $article->startpage = $this->startpage;
        $article->endpage = $this->endpage;
        $article->save();

        $authors = $this->input('authors');
        foreach ($authors as $author) {
            $authorofarticle = new Authorsofarticle();
            $authorofarticle->author_id = $author;
            $authorofarticle->article_id = $article->id;

            $authorofarticle->save();
        }

        session()->flash(
            'success',
            'You have successfully registered your article!'
        );
        return redirect()->route('home');
    }

    /**
     * Edit pub
     * @param  Publication $pub
     *
     * @return Illuminate\Routing\Redirector
     */
    public function edit(Article $article)
    {
        $article->title = $this->title;
        $article->summary = $this->summary;

        //// pdf file upload //////
        if(!is_null($this->pdffile)) {
            $fileName = time().'.'.$this->pdffile->extension();
            $this->pdffile->move(public_path('uploads'), $fileName);
            $article->pdffile = $fileName;
        }
        ///////////////////////////
        
        $article->startpage = $this->startpage;
        $article->endpage = $this->endpage;
        $article->save();

        $authors = $this->input('authors');
        $authorofarticles = Authorsofarticle::where('article_id', $article->id)->get();
        foreach($authorofarticles as $authorofarticle) {
            $authorofarticle->delete();
        }
        foreach ($authors as $author) {
            $authorofarticle = new Authorsofarticle();
            $authorofarticle->author_id = $author;
            $authorofarticle->article_id = $article->id;

            $authorofarticle->save();
        }
        session()->flash(
            'success',
            'You have successfully edited your article.'
        );
        return redirect()->route('home');
    }
}