<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Publication;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PubRequest extends FormRequest
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
            'title' => 'required|max:100',
            'summary' => 'required',
            'authors' => 'required',
            'pdffile' => 'mimes:pdf',
            'client_name' => 'min:3',
            'project_name' => 'min:3',
            'topics' => 'min:3',
            'numpages' => 'numeric|min:1',
            'startpage' => 'image|mimes:jpeg,jpg,png|max:2048',
            'endpage' => 'image|mimes:jpeg,jpg,png|max:2048',
        ];
    }

    private function conversorStartPage()
    {
        $image = $this->startpage->store('img'); #Save pub image
        $path = base_path("/storage/app/$image"); #Take the pub image path
        $type = pathinfo($path, PATHINFO_EXTENSION); #Get pub image type
        $data = file_get_contents($path); #Get the pub image
        $imageBase64 = "data:image/$type;base64," . base64_encode($data); #Convert pub image to base64
        Storage::delete($image); #Delete the pub image from the server as it is no longer needed
        return $imageBase64;
    }

    private function conversorEndPage()
    {
        $image = $this->endpage->store('img'); #Save pub image
        $path = base_path("/storage/app/$image"); #Take the pub image path
        $type = pathinfo($path, PATHINFO_EXTENSION); #Get pub image type
        $data = file_get_contents($path); #Get the pub image
        $imageBase64 = "data:image/$type;base64," . base64_encode($data); #Convert pub image to base64
        Storage::delete($image); #Delete the pub image from the server as it is no longer needed
        return $imageBase64;
    }

    /**
     * Add Publication
     * @param string $type
     *
     * @return Illuminate\Routing\Redirector
     */
    public function add($type)
    {
        #Create a new pub
        $pub = new Publication();
        $pub->user_id = auth()->user()->id;
        $pub->title = $this->title;
        $pub->summary = $this->summary;
        $pub->authors = $this->authors;
        $pub->type = $type;

        //// pdf file upload //////
        $fileName = time().'.'.$this->pdffile->extension();
        $this->pdffile->move(public_path('uploads'), $fileName);
        $pub->pdffile = $fileName;
        ///////////////////////////
        if($type == 'article') {
            $pub->startpage = $this->conversorStartPage();
            $pub->endpage = $this->conversorEndPage();
        } elseif($type == 'client report') {
            $pub->client_name = $this->client_name;
            $pub->project_name = $this->project_name;
        } elseif($type == 'book') {
            $pub->topics = $this->topics;
            $pub->numpages = $this->numpages;
        }
        $pub->save();

        session()->flash(
            'success',
            'You have successfully registered your publication!'
        );
        return redirect()->route('home');
    }

    /**
     * Edit pub
     * @param  Publication $pub
     *
     * @return Illuminate\Routing\Redirector
     */
    public function edit($type, Publication $pub)
    {
        $pub->title = $this->title;
        $pub->summary = $this->summary;
        $pub->type = $type;

        //// pdf file upload //////
        if(!is_null($this->pdffile)) {
            $fileName = time().'.'.$this->pdffile->extension();
            $this->pdffile->move(public_path('uploads'), $fileName);
            $pub->pdffile = $fileName;
        }
        ///////////////////////////
        if($type == 'article') {
            if(!is_null($this->startpage)) {
                $pub->startpage = $this->conversorStartPage();
            }
            if(!is_null($this->endpage)) {
                $pub->endpage = $this->conversorEndPage();
            }
        } elseif($type == 'client report') {
            $pub->client_name = $this->client_name;
            $pub->project_name = $this->project_name;
        } elseif($type == 'book') {
            $pub->topics = $this->topics;
            $pub->numpages = $this->numpages;
        }
        $pub->save();
        session()->flash(
            'success',
            'You have successfully edited your publication.'
        );
        return redirect()->route('home');
    }
}