@extends('main')
@section('content')
<title>Home - TEST</title>
@include('includes.flash.validation')
@include('includes.flash.success')
@include('includes.flash.error')
<section class="mt-4 text-center">
    <div class="dropdown">
        <button class="dropbtn">Create Publication</button>
        <div class="dropdown-content">
            <a href="{{ route('create-article', ['section' => 'add']) }}"> Create Article</a>
            <a href="{{ route('create-report', ['section' => 'add']) }}"> Create Client Report</a>
            <a href="{{ route('create-book', ['section' => 'add']) }}"> Create Book</a>
        </div>
    </div>
    <table class="table mt-4">
        <thead>
            <tr>
                <th colspan="7">All Articles</th>
            </tr>
            <tr>
                <th>Title</th>
                <th style="width:15%">Summary</th>
                <th style="width:15%">Authors</th>
                <th style="width:15%">Start Page</th>
                <th style="width:15%">End Page</th>
                <th style="width:15%">PDF</th>
                <th style="width:5%"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($articles as $article)
            <tr>
                <td>{{ $article->title }}</td>
                <td>{{ $article->summary }}</td>
                <td>
                    @foreach($article->authors() as $author)
                    {{ $author->name }},
                    @endforeach
                </td>
                <td>{{ $article->startpage }}</td>
                <td>{{ $article->endpage }}</td>
                <td><a href="{{ route('downpdf', ['filename' => $article->pdffile]) }}">{{ $article->pdffile }}<a></td>
                <td>
                    <a href="{{ route('create-article', ['section' => 'edit', 'article' => $article->id]) }}"
                        value="edit" title="edit"><i class="fas fa-edit"></i></a>
                    <a href="{{ route('delarticle', ['article' => $article->id]) }}" value="delete" title="delete"><i
                            class="fas fa-trash"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <table class="table mt-4">
        <thead>
            <tr>
                <th colspan="7">All Client Reports</th>
            </tr>
            <tr>
                <th>Title</th>
                <th style="width:15%">Summary</th>
                <th style="width:15%">Authors</th>
                <th style="width:15%">Client Name</th>
                <th style="width:15%">Project Name</th>
                <th style="width:15%">PDF</th>
                <th style="width:5%"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($reports as $report)
            <tr>
                <td>{{ $report->title }}</td>
                <td>{{ $report->summary }}</td>
                <td>
                    @foreach($report->authors() as $author)
                    {{ $author->name }},
                    @endforeach
                </td>
                <td>{{ $report->client_name }}</td>
                <td>{{ $report->project_name }}</td>
                <td><a href="{{ route('downpdf', ['filename' => $report->pdffile]) }}">{{ $report->pdffile }}</a></td>
                <td>
                    <a href="{{ route('create-report', ['section' => 'edit', 'report' => $report->id]) }}" value="edit"
                        title="edit"><i class="fas fa-edit"></i></a>
                    <a href="{{ route('delreport', ['report' => $report->id]) }}" value="delete" title="delete"><i
                            class="fas fa-trash"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <table class="table mt-4">
        <thead>
            <tr>
                <th colspan="7">All Books</th>
            </tr>
            <tr>
                <th>Title</th>
                <th style="width:15%">Summary</th>
                <th style="width:15%">Authors</th>
                <th style="width:15%">Topics</th>
                <th style="width:15%">Pages</th>
                <th style="width:15%">PDF</th>
                <th style="width:5%"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $book)
            <tr>
                <td>{{ $book->title }}</td>
                <td>{{ $book->summary }}</td>
                <td>
                    @foreach($book->authors() as $author)
                    {{ $author->name }},
                    @endforeach
                </td>
                <td>{{ $book->topics }}</td>
                <td>{{ $book->numpages }}</td>
                <td><a href="{{ route('downpdf', ['filename' => $book->pdffile]) }}">{{ $book->pdffile }}</a></td>
                <td>
                    <a href="{{ route('create-book', ['section' => 'edit', 'book' => $book->id]) }}" value="edit"
                        title="edit"><i class="fas fa-edit"></i></a>
                    <a href="{{ route('delbook', ['book' => $book->id]) }}" value="delete" title="delete"><i
                            class="fas fa-trash"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</section>
@stop