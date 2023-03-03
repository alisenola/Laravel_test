@extends('main')
@section('content')

<title>Create Client Report - TEST</title>

<section>
    @if($section == 'add')
    <h1>Register New Client Report</h1>
    @elseif($section == 'edit')
    <h1>Edit Client Report</h1>
    @endif
    <form method="post"
        action="{{ $section == 'edit' ? route('post.createreport', ['section' => $section, 'report' => $report->id]) : route('post.createreport', ['section' => $section]) }}"
        enctype="multipart/form-data">
        @csrf
        <div class="form-row"><label>Title *</label>
            <input name="title" required="" autofocus="" minlength="3" maxlength="100" @if($section=='edit' )
                value="{{ $report->title }}" @endif placeholder="Title">
        </div>
        @error('title')
        <p class="text-danger">{{ $errors->first('title') }}</p>
        @enderror
        <div class="form-row"><label>Summary *</label>
            <input name="summary" required="" autofocus="" @if($section=='edit' ) value="{{ $report->summary }}" @endif
                placeholder="Summary">
        </div>
        @error('summary')
        <p class="text-danger">{{ $errors->first('summary') }}</p>
        @enderror
        <label for="selectauthor" class="btn btn-sm btn-success">Select Authors</label>
        <input type="checkbox" id="selectauthor">
        <div class="author_list">
            @forelse($allAuthors as $author)
            <label for="{{ $author->id }}" class="author_item w-100"><input type="checkbox" name="authors[]"
                    id="{{ $author->id }}" value="{{ $author->id }}" @if($section=='edit' ) <?php foreach (
                                    $authors
                                    as $a
                                ) {
                                    if ($a->id == $author->id) {
                                        echo 'checked';
                                    } else {
                                        echo '';
                                    }
                                } ?> @endif />{{ $author->name }}
            </label><br>
            @empty
            @endforelse
        </div>
        <div class="form-now mt-3">
            <label for="clientname" class="form-label">Choose Client Name</label>
            <input id="clientname" type="text" name="clientname" required="" @if($section=='edit' )
                value="{{ $report->client_name }}" @endif placeholder="Client Name">
        </div>
        @error('clientname')
        <p class="text-danger">{{ $errors->first('clientname') }}</p>
        @enderror
        <div class="form-now">
            <label for="projectname" class="form-label">Choose Project Name</label>
            <input id="projectname" type="text" name="projectname" required="" @if($section=='edit' )
                value="{{ $report->project_name }}" @endif placeholder="Project Name">
        </div>
        @error('projectname')
        <p class="text-danger">{{ $errors->first('projectname') }}</p>
        @enderror
        <div class="form-now">
            <label for="pdffile" class="form-label">Choose PDF File</label>
            <input id="pdffile" type="file" name="pdffile" @if($section=='add' ) required="" @endif>
        </div>
        @error('pdffile')
        <p class="text-danger">{{ $errors->first('pdffile') }}</p>
        @enderror
        <div class="form-row">
            <button class="submit-btn" type="submit">@if($section == 'edit')Edit Client Report @elseif($section
                == 'add') Register New Client Report @endif</button>
        </div>
    </form>
</section>

@stop