@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>View generated XML file. File generated by php artisan xml:generate command.</h3>
                @foreach($files as $file)
                    <ul class="list-group">
                        <li class="list-group-item"><a href="{{ url('/xml', $file) }}">{{ $file }}</a></li>
                    </ul>
                @endforeach
            </div>
        </div>
    </div>
@endsection
