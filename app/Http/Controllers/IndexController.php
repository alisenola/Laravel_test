<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\{Article, Authorsofarticle, Authorsofclientreport, Authorsofbook, Book, Clientreport, Author};
use App\Http\Requests\{ArticleRequest, BookRequest, ClientreportRequest};
use Illuminate\Support\Facades\Response;

class IndexController extends Controller
{
    /**
     * Home view
     * @param
     *
     * @return Illuminate\Support\Facades\View
     */
    public function viewHome() {
        return view('home', [
            'articles' => Article::get(),
            'reports' => Clientreport::get(),
            'books' => Book::get(),
        ]);
    }

    /**
     * View Create Article Page
     * @param  string       $section
     * @param  Article  $article
     *
     * @return Illuminate\Support\Facades\View
     */
    public function viewCreateArticle($section, Article $article = null) {
        if ($section === 'add' && is_null($article)) {
            return view('create-article', [
                'article' => $article,
                'section' => $section,
                'allAuthors' => Author::get(),
            ]);
        } elseif (
            $section === 'edit' &&
            !is_null($article) &&
            $article->exists()
        ) {
            return view('create-article', [
                'article' => $article,
                'section' => $section,
                'allAuthors' => Author::get(),
                'authors' => $article->authors(),
            ]);
        } else {
            return abort(404);
        }
    }

    /**
     * View Create Client Report Page
     * @param  string       $section
     * @param  Clientreport  $report
     *
     * @return Illuminate\Support\Facades\View
     */
    public function viewCreateReport($section, Clientreport $report = null) {
        if ($section === 'add' && is_null($report)) {
            return view('create-report', [
                'report' => $report,
                'section' => $section,
                'allAuthors' => Author::get(),
            ]);
        } elseif (
            $section === 'edit' &&
            !is_null($report) &&
            $report->exists()
        ) {
            return view('create-report', [
                'report' => $report,
                'section' => $section,
                'allAuthors' => Author::get(),
                'authors' => $report->authors(),
            ]);
        } else {
            return abort(404);
        }
    }

    /**
     * View Create Book Page
     * @param  string       $section
     * @param  Book  $book
     *
     * @return Illuminate\Support\Facades\View
     */
    public function viewCreateBook($section, Book $book = null) {
        if ($section === 'add' && is_null($book)) {
            return view('create-book', [
                'book' => $book,
                'section' => $section,
                'allAuthors' => Author::get(),
            ]);
        } elseif (
            $section === 'edit' &&
            !is_null($book) &&
            $book->exists()
        ) {
            return view('create-book', [
                'book' => $book,
                'section' => $section,
                'allAuthors' => Author::get(),
                'authors' => $book->authors(),
            ]);
        } else {
            return abort(404);
        }
    }

    /**
     * Create Article
     * @param  string       $section
     * @param  Article  $articl
     *
     * @return ArticleRequest
     */
    public function createArticle($section, Article $article = null, ArticleRequest $request) {
        if ($section === 'add') {
            try {
                return $request->add();
            } catch (Exception $exception) {
                session()->flash('error', $exception->getMessage());
                return redirect()->back();
            }
        } elseif (
            $section === 'edit' &&
            !is_null($article) &&
            $article->exists()
        ) {
            try {
                return $request->edit($article);
            } catch (Exception $exception) {
                session()->flash('error', $exception->getMessage());
                return redirect()->back();
            }
        } else {
            return abort(404);
        }
    }

        /**
     * Create Client Report
     * @param  string       $section
     * @param  Clientreport  $repoty
     *
     * @return ClientreportRequest
     */
    public function createReport($section, Clientreport $report = null, ClientreportRequest $request) {
        if ($section === 'add') {
            try {
                return $request->add();
            } catch (Exception $exception) {
                session()->flash('error', $exception->getMessage());
                return redirect()->back();
            }
        } elseif (
            $section === 'edit' &&
            !is_null($report) &&
            $report->exists()
        ) {
            try {
                return $request->edit($report);
            } catch (Exception $exception) {
                session()->flash('error', $exception->getMessage());
                return redirect()->back();
            }
        } else {
            return abort(404);
        }
    }

        /**
     * Create Book
     * @param  string       $section
     * @param  Book  $book
     *
     * @return BookRequest
     */
    public function createBook($section, Book $book = null, BookRequest $request) {
        if ($section === 'add') {
            try {
                return $request->add();
            } catch (Exception $exception) {
                session()->flash('error', $exception->getMessage());
                return redirect()->back();
            }
        } elseif (
            $section === 'edit' &&
            !is_null($book) &&
            $book->exists()
        ) {
            try {
                return $request->edit($book);
            } catch (Exception $exception) {
                session()->flash('error', $exception->getMessage());
                return redirect()->back();
            }
        } else {
            return abort(404);
        }
    }

    /**
     * Create Article 
     * @param  string       $filename
     *
     * @return Response
     */
    public function getDownload($filename)
    {
        //PDF file is stored under project/public/download/info.pdf
        $file= public_path(). "/uploads/" . $filename;

        $headers = array(
                'Content-Type: application/pdf',
                );

        return Response::download($file, 'book.pdf', $headers);
        session()->flash('success', 'You have successfully downloaded');
        return redirect()->back();
    }

    public function delArticle(Article $article)
    {
        $article->delete();

        session()->flash('success', 'You have successfully deleted article');
        return redirect()->back();
    }
    
    public function delReport(Clientreport $report)
    {
        $report->delete();

        session()->flash('success', 'You have successfully deleted client report');
        return redirect()->back();
    }
    
    public function delBook(Book $book)
    {
        $book->delete();

        session()->flash('success', 'You have successfully deleted book');
        return redirect()->back();
    }
}