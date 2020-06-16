@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="alert alert-info">
                    <strong>Your information:</strong> Ip - {{ $userInfo->ip }},
                    Browser - {{ $userInfo->browser }},
                    Country - {{ $userInfo->country }},
                    Last login - {{ $userInfo->last_login }}
                </div>

                <h3>Saved hashses</h3>

                @if (Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                @endif

                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Word</th>
                        <th>Algorithm</th>
                        <th>Hash</th>
                        <th>Tools</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($hashes as $hash)
                        <tr>
                            <td>{{ $hash->vocabulary->word }}</td>
                            <td>{{ $hash->algorithm }}</td>
                            <td><a href="{{ url('/api/hashes', $hash->id) }}">{{ $hash->hash }}</a></td>
                            <td>
                                {{ Form::open(['method' => 'DELETE', 'route' => ['user::hash.delete', $hash->id]]) }}
                                {{ Form::submit('Delete',
                                    ['class' => 'btn btn-primary btn-xs deleteHash']) }}
                                {{ Form::close() }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $hashes->render() }}
            </div>
        </div>
@endsection
