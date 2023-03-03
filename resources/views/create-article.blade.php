@extends('main')
@section('content')

<title>Create Article - TEST</title>

<section>
    @if($section == 'add')
    <h1>Register New Article</h1>
    @elseif($section == 'edit')
    <h1>Edit Article</h1>
    @endif
    <form method="post"
        action="{{ $section == 'edit' ? route('post.createarticle', ['section' => $section, 'article' => $article->id]) : route('post.createarticle', ['section' => $section]) }}"
        enctype="multipart/form-data">
        @csrf
        <div class="form-row"><label>Title *</label>
            <input name="title" required="" autofocus="" minlength="3" maxlength="100" @if($section=='edit' )
                value="{{ $article->title }}" @endif placeholder="Title">
        </div>
        @error('title')
        <p class="text-danger">{{ $errors->first('title') }}</p>
        @enderror
        <div class="form-row"><label>Summary *</label>
            <input name="summary" required="" autofocus="" @if($section=='edit' ) value="{{ $article->summary }}" @endif
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
            <label for="startpage" class="form-label">Choose Start Page</label>
            <input id="startpage" type="number" name="startpage" required="" @if($section=='edit' )
                value="{{ $article->startpage }}" @endif placeholder="First Page">
        </div>
        @error('startpage')
        <p class="text-danger">{{ $errors->first('startpage') }}</p>
        @enderror
        <div class="form-now">
            <label for="endpage" class="form-label">Choose End Page</label>
            <input id="endpage" type="number" name="endpage" required="" @if($section=='edit' )
                value="{{ $article->endpage }}" @endif placeholder="Last Page">
        </div>
        @error('endpage')
        <p class="text-danger">{{ $errors->first('endpage') }}</p>
        @enderror
        <div class="form-now">
            <label for="pdffile" class="form-label">Choose PDF File</label>
            <input id="pdffile" type="file" name="pdffile" @if($section=='add' ) required="" @endif>
        </div>
        @error('pdffile')
        <p class="text-danger">{{ $errors->first('pdffile') }}</p>
        @enderror
        <div class="form-row">
            <button class="submit-btn" type="submit">@if($section == 'edit')Edit Article @elseif($section
                == 'add') Register New Article @endif</button>
        </div>
    </form>
</section>

@stop