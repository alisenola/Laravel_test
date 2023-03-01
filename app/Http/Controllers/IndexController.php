<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Publication;
use App\Http\Requests\PubRequest;
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
            'articles' => Publication::where('type', 'article')->get(),
            'reports' => Publication::where('type', 'client report')->get(),
            'books' => Publication::where('type', 'book')->get(),
        ]);
    }

    /**
     * View Create Publication Page
     * @param  string       $section
     * @param  string       $type
     * @param  Publication  $pub
     *
     * @return Illuminate\Support\Facades\View
     */
    public function viewCreatePub($section, $type, Publication $pub = null) {
        if ($section === 'add' && is_null($pub)) {
            return view('create-pub', [
                'pub' => $pub,
                'section' => $section,
                'type' => $type,
            ]);
        } elseif (
            $section === 'edit' &&
            !is_null($pub) &&
            $pub->exists()
        ) {

            return view('create-pub', [
                'pub' => $pub,
                'section' => $section,
                'type' => $type,
            ]);
        } else {
            return abort(404);
        }
    }

    /**
     * Create Publication 
     * @param  string       $section
     * @param  string       $type
     * @param  Publication  $pub
     *
     * @return PubRequest
     */
    public function createPub($section, $type, Publication $pub = null, PubRequest $request) {
        if ($section === 'add') {
            try {
                return $request->add($type);
            } catch (Exception $exception) {
                session()->flash('error', $exception->getMessage());
                return redirect()->back();
            }
        } elseif (
            $section === 'edit' &&
            !is_null($pub) &&
            $pub->exists()
        ) {
            try {
                return $request->edit($type, $pub);
            } catch (Exception $exception) {
                session()->flash('error', $exception->getMessage());
                return redirect()->back();
            }
        } else {
            return abort(404);
        }
    }

    /**
     * Create Publication 
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

    public function delPub(Publication $pub)
    {
        $pub->delete();

        session()->flash('success', 'You have successfully deleted publication');
        return redirect()->back();
    }
}