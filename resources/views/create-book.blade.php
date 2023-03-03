@extends('main')
@section('content')

<title>Create Book - TEST</title>

<section>
    @if($section == 'add')
    <h1>Register New Book</h1>
    @elseif($section == 'edit')
    <h1>Edit Book</h1>
    @endif
    <form method="post"
        action="{{ $section == 'edit' ? route('post.createbook', ['section' => $section, 'book' => $book->id]) : route('post.createbook', ['section' => $section]) }}"
        enctype="multipart/form-data">
        @csrf
        <div class="form-row"><label>Title *</label>
            <input name="title" required="" autofocus="" minlength="3" maxlength="100" @if($section=='edit' )
                value="{{ $book->title }}" @endif placeholder="Title">
        </div>
        @error('title')
        <p class="text-danger">{{ $errors->first('title') }}</p>
        @enderror
        <div class="form-row"><label>Summary *</label>
            <input name="summary" required="" autofocus="" @if($section=='edit' ) value="{{ $book->summary }}" @endif
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
            <label for="topics" class="form-label">Choose Topics</label>
            <input id="topics" type="text" name="topics" required="" @if($section=='edit' ) value="{{ $book->topics }}"
                @endif placeholder="Topics Published">
        </div>
        @error('topics')
        <p class="text-danger">{{ $errors->first('topics') }}</p>
        @enderror
        <div class="form-now">
            <label for="numpages" class="form-label">Choose Number of Pages</label>
            <input id="numpages" type="number" name="numpages" required="" @if($section=='edit' )
                value="{{ $book->numpages }}" @endif placeholder="Number of Pages">
        </div>
        @error('numpages')
        <p class="text-danger">{{ $errors->first('numpages') }}</p>
        @enderror
        <div class="form-now">
            <label for="pdffile" class="form-label">Choose PDF File</label>
            <input id="pdffile" type="file" name="pdffile" @if($section=='add' ) required="" @endif>
        </div>
        @error('pdffile')
        <p class="text-danger">{{ $errors->first('pdffile') }}</p>
        @enderror
        <div class="form-row">
            <button class="submit-btn" type="submit">@if($section == 'edit')Edit Book @elseif($section
                == 'add') Register New Book @endif</button>
        </div>
    </form>
</section>

@stop