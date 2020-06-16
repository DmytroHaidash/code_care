@extends('layouts.app')

@section('content')
    <div class="container">

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h4>Vocabulary words</h4>
        <div class="row">
            <form action="{{route('HashGenerator::post')}}" method="post">
                @csrf
                <div class="col-6">
                    <ul class="list-group">
                        @foreach($vocabularies as $item)
                            <li class="list-group-item">
                                <input type="checkbox" name="words[]"  id="words-{{$item->id}}" value="{{ $item->word }}">
                                <label for="words-{{$item->id}}">{{ $item->word }}</label>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">Tools</div>
                        <div class="panel-body">
                            <h5>Select hashing</h5>
                            <p>
                                <input type="checkbox" class="custom-control-input"
                                       id="md5" name="hash[]" value="md5">
                                <label class="custom-control-label" for="md5">MD5</label>
                            </p>
                            <p>
                                <input type="checkbox" class="custom-control-input"
                                       id="sha1" name="hash[]" value="sha1">
                                <label class="custom-control-label" for="sha1">SHA-1</label>
                            </p>
                            <p>
                                <input type="checkbox" class="custom-control-input"
                                       id="sha256" name="hash[]" value="sha256">
                                <label class="custom-control-label" for="sha256">SHA-256</label>
                            </p>
                            <p>
                                <input type="checkbox" class="custom-control-input"
                                       id="sha512" name="hash[]" value="sha512">
                                <label class="custom-control-label" for="sha512">SHA-512</label>
                            </p>
                            <p>
                                <input type="checkbox" class="custom-control-input"
                                       id="blowfish" name="hash[]" value="blowfish">
                                <label class="custom-control-label" for="blowfish">BLOWFISH</label>
                            </p>
                            <button class="btn btn-primary btn-sm">Create hash</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection


