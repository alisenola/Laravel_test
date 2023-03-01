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
            <a href="{{ route('create-pub', ['section' => 'add', 'type' => 'article']) }}"> Create Article</a>
            <a href="{{ route('create-pub', ['section' => 'add', 'type' => 'client report']) }}"> Create Client
                Report</a>
            <a href="{{ route('create-pub', ['section' => 'add', 'type' => 'book']) }}"> Create Book</a>
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
            @foreach($articles as $pub)
            <tr>
                <td>{{ $pub->title }}</td>
                <td>{{ $pub->summary }}</td>
                <td>{{ $pub->authors }}</td>
                <td><img src="{{ $pub->startpage }}" width="60px" height="80px" /></td>
                <td><img src="{{ $pub->endpage }}" width="60px" height="80px" /></td>
                <td><a href="{{ route('downpdf', ['filename' => $pub->pdffile]) }}">{{ $pub->pdffile }}<a></td>
                <td>
                    <a href="{{ route('create-pub', ['section' => 'edit', 'type' => 'article', 'pub' => $pub->id]) }}"
                        value="edit" title="edit"><i class="fas fa-edit"></i></a>
                    <a href="{{ route('delpub', ['pub' => $pub->id]) }}" value="delete" title="delete"><i
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
            @foreach($reports as $pub)
            <tr>
                <td>{{ $pub->title }}</td>
                <td>{{ $pub->summary }}</td>
                <td>{{ $pub->authors }}</td>
                <td>{{ $pub->client_name }}</td>
                <td>{{ $pub->project_name }}</td>
                <td><a href="{{ route('downpdf', ['filename' => $pub->pdffile]) }}">{{ $pub->pdffile }}</a></td>
                <td>
                    <a href="{{ route('create-pub', ['section' => 'edit', 'type' => 'client report', 'pub' => $pub->id]) }}"
                        value="edit" title="edit"><i class="fas fa-edit"></i></a>
                    <a href="{{ route('delpub', ['pub' => $pub->id]) }}" value="delete" title="delete"><i
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
            @foreach($books as $pub)
            <tr>
                <td>{{ $pub->title }}</td>
                <td>{{ $pub->summary }}</td>
                <td>{{ $pub->authors }}</td>
                <td>{{ $pub->topics }}</td>
                <td>{{ $pub->numpages }}</td>
                <td><a href="{{ route('downpdf', ['filename' => $pub->pdffile]) }}">{{ $pub->pdffile }}</a></td>
                <td>
                    <a href="{{ route('create-pub', ['section' => 'edit', 'type' => 'book', 'pub' => $pub->id]) }}"
                        value="edit" title="edit"><i class="fas fa-edit"></i></a>
                    <a href="{{ route('delpub', ['pub' => $pub->id]) }}" value="delete" title="delete"><i
                            class="fas fa-trash"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</section>
@stop