@extends('main')
@section('content')

<title>Create Publication - TEST</title>

<section>
    @if($section == 'add')
    <h1>Register New {{ ucfirst($type) }}</h1>
    @elseif($section == 'edit')
    <h1>Edit {{ ucfirst($type) }}</h1>
    @endif
    <form method="post"
        action="{{ $section == 'edit' ? route('post.createpub', ['section' => $section, 'type' => $type, 'pub' => $pub->id]) : route('post.createpub', ['type' => $type, 'section' => $section]) }}"
        enctype="multipart/form-data">
        @csrf
        <div class="form-row"><label>Title *</label>
            <input name="title" required="" autofocus="" minlength="3" maxlength="100" @if($section=='edit' )
                value="{{ $pub->title }}" @endif placeholder="Title">
        </div>
        @error('title')
        <p class="text-danger">{{ $errors->first('title') }}</p>
        @enderror
        <div class="form-row"><label>Summary *</label>
            <input name="summary" required="" autofocus="" @if($section=='edit' ) value="{{ $pub->summary }}" @endif
                placeholder="Summary">
        </div>
        @error('summary')
        <p class="text-danger">{{ $errors->first('summary') }}</p>
        @enderror
        <div class="form-row"><label>Authors *</label>
            <input name="authors" required="" autofocus="" @if($section=='edit' ) value="{{ $pub->authors }}" @endif
                placeholder="Authors">
        </div>
        @error('authors')
        <p class="text-danger">{{ $errors->first('authors') }}</p>
        @enderror
        @if($type === 'client report')
        <div class="form-row"><label>Client Name *</label>
            <input name="client_name" required="" autofocus="" minlength="3" @if($section=='edit' )
                value="{{ $pub->client_name }}" @endif placeholder="Client Name">
        </div>
        @error('client_name')
        <p class="text-danger">{{ $errors->first('client_name') }}</p>
        @enderror
        <div class="form-row"><label>Project Name *</label>
            <input name="project_name" required="" autofocus="" minlength="3" @if($section=='edit' )
                value="{{ $pub->project_name }}" @endif placeholder="Project Name">
        </div>
        @error('project_name')
        <p class="text-danger">{{ $errors->first('project_name') }}</p>
        @enderror
        @endif
        @if($type === 'book')
        <div class="form-row"><label>Topics *</label>
            <input name="topics" required="" autofocus="" minlength="3" @if($section=='edit' )
                value="{{ $pub->topics }}" @endif placeholder="Topics">
        </div>
        @error('topics')
        <p class="text-danger">{{ $errors->first('topics') }}</p>
        @enderror
        <div class="form-row"><label>Number Of Pages *</label>
            <input type="number" name="numpages" required="" autofocus="" minlength="1" @if($section=='edit' )
                value="{{ $pub->numpages }}" @endif placeholder="Number Of Pages">
        </div>
        @error('numpages')
        <p class="text-danger">{{ $errors->first('numpages') }}</p>
        @enderror
        @endif
        @if($type === 'article')
        <div class="form-now">
            <label for="startpage" class="form-label">Choose Start Page</label>
            <input id="startpage" type="file" name="startpage" @if($section=='add' ) required="" @endif>
        </div>
        @error('startpage')
        <p class="text-danger">{{ $errors->first('startpage') }}</p>
        @enderror
        <div class="form-now">
            <label for="endpage" class="form-label">Choose End Page</label>
            <input id="endpage" type="file" name="endpage" @if($section=='add' ) required="" @endif>
        </div>
        @error('endpage')
        <p class="text-danger">{{ $errors->first('endpage') }}</p>
        @enderror
        @endif
        <div class="form-now">
            <label for="pdffile" class="form-label">Choose PDF File</label>
            <input id="pdffile" type="file" name="pdffile" @if($section=='add' ) required="" @endif>
        </div>
        @error('pdffile')
        <p class="text-danger">{{ $errors->first('pdffile') }}</p>
        @enderror
        <div class="form-row">
            <button class="submit-btn" type="submit">@if($section == 'edit')Edit {{ ucfirst($type) }} @elseif($section
                == 'add')
                Register New {{ ucfirst($type) }} @endif</button>
        </div>
    </form>
</section>

@stop