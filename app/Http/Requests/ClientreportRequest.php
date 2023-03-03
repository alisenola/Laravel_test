<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\{Authorsofclientreport,Clientreport};

class ClientreportRequest extends FormRequest
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
            'clientname' => 'required|max:100',
            'projectname' => 'required|max:100',
        ];
    }

    /**
     * Add Client Report
     *
     * @return Illuminate\Routing\Redirector
     */
    public function add()
    {
        #Create a new report
        $report = new Clientreport();
        $report->user_id = auth()->user()->id;
        $report->title = $this->title;
        $report->summary = $this->summary;

        //// pdf file upload //////
        $fileName = time().'.'.$this->pdffile->extension();
        $this->pdffile->move(public_path('uploads'), $fileName);
        $report->pdffile = $fileName;
        ///////////////////////////

        $report->client_name = $this->clientname;
        $report->project_name = $this->projectname;
        $report->save();

        $authors = $this->input('authors');
        foreach ($authors as $author) {
            $authorofclientreport = new Authorsofclientreport();
            $authorofclientreport->author_id = $author;
            $authorofclientreport->clientreport_id = $report->id;

            $authorofclientreport->save();
        }

        session()->flash(
            'success',
            'You have successfully registered your report!'
        );
        return redirect()->route('home');
    }

    /**
     * Edit pub
     * @param  Clientreport $report
     *
     * @return Illuminate\Routing\Redirector
     */
    public function edit(Clientreport $report)
    {
        $report->title = $this->title;
        $report->summary = $this->summary;

        //// pdf file upload //////
        if(!is_null($this->pdffile)) {
            $fileName = time().'.'.$this->pdffile->extension();
            $this->pdffile->move(public_path('uploads'), $fileName);
            $report->pdffile = $fileName;
        }
        ///////////////////////////
        
        $report->client_name = $this->clientname;
        $report->project_name = $this->projectname;
        $report->save();

        $authors = $this->input('authors');
        $authorofclientreports = Authorsofclientreport::where('clientreport_id', $report->id)->get();
        foreach($authorofclientreports as $authorofreport) {
            $authorofreport->delete();
        }
        foreach ($authors as $author) {
            $authorofreport = new Authorsofclientreport();
            $authorofreport->author_id = $author;
            $authorofreport->clientreport_id = $report->id;

            $authorofreport->save();
        }
        session()->flash(
            'success',
            'You have successfully edited your report.'
        );
        return redirect()->route('home');
    }
}