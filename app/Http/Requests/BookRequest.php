<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Book;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Authorsofbook;

class BookRequest extends FormRequest
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
            'topics' => 'required|max:100',
            'numpages' => 'required|numeric',
        ];
    }

    /**
     * Add Publication
     *
     * @return Illuminate\Routing\Redirector
     */
    public function add()
    {
        #Create a new book
        $book = new Book();
        $book->user_id = auth()->user()->id;
        $book->title = $this->title;
        $book->summary = $this->summary;

        //// pdf file upload //////
        $fileName = time().'.'.$this->pdffile->extension();
        $this->pdffile->move(public_path('uploads'), $fileName);
        $book->pdffile = $fileName;
        ///////////////////////////

        $book->topics = $this->topics;
        $book->numpages = $this->numpages;
        $book->save();

        $authors = $this->input('authors');
        foreach ($authors as $author) {
            $authorofbook = new Authorsofbook();
            $authorofbook->author_id = $author;
            $authorofbook->book_id = $book->id;

            $authorofbook->save();
        }

        session()->flash(
            'success',
            'You have successfully registered your book!'
        );
        return redirect()->route('home');
    }

    /**
     * Edit pub
     * @param  Book $book
     *
     * @return Illuminate\Routing\Redirector
     */
    public function edit(Book $book)
    {
        $book->title = $this->title;
        $book->summary = $this->summary;

        //// pdf file upload //////
        if(!is_null($this->pdffile)) {
            $fileName = time().'.'.$this->pdffile->extension();
            $this->pdffile->move(public_path('uploads'), $fileName);
            $book->pdffile = $fileName;
        }
        ///////////////////////////
        
        $book->topics = $this->topics;
        $book->numpages = $this->numpages;
        $book->save();

        $authors = $this->input('authors');
        $authorofbooks = Authorsofbook::where('book_id', $book->id)->get();
        foreach($authorofbooks as $authorofbook) {
            $authorofbook->delete();
        }
        foreach ($authors as $author) {
            $authorofbook = new Authorsofbook();
            $authorofbook->author_id = $author;
            $authorofbook->book_id = $book->id;

            $authorofbook->save();
        }
        session()->flash(
            'success',
            'You have successfully edited your book.'
        );
        return redirect()->route('home');
    }
}