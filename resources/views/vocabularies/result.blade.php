@extends('layouts.app')

@section('content')
    <div class="container">

        @if (Auth::guest())
            <div class="alert alert-warning">
                Please sign in, to save the hash.
            </div>
        @endif

        <h2>Result</h2>
        <div class="row">
            <div class="col-md-12">
                @foreach($data as $id => $value)
                    {{--@dd($value)--}}
                    <h3>
                        @foreach($value as $key => $word)
                            @if( $key === 'origin')
                                {{ $word }}
                            @endif
                        @endforeach
                    </h3>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Algorithm</th>
                            <th>Hash</th>
                            <th>Tools</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($value as $key => $hashed)
                            @if( $key === 'algorithm')
                                @foreach($hashed as $algorithm => $hash)
                                    <tr>
                                        <td class="{{ $id }}-{{ $algorithm }}-algorithm">{{ $algorithm }}</td>
                                        <td class="{{ $id }}-{{ $algorithm }}-hash">{{ $hash }}</td>
                                        <td>
                                            @if (Auth::user())
                                                <form action="{{ route('user::hash.save') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="algorithm" value="{{$algorithm}}">
                                                    <input type="hidden" name="hash" value="{{$hash}}">
                                                    <input type="hidden" name="word" value="{{$value['origin']}}">
                                                    <button type="button" class="btn btn-primary btn-xs">Save</button>
                                                </form>
                                            @else
                                                <button type="button" class="btn btn-primary btn-xs disabled">Save
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                @endforeach
            </div>
        </div>
    </div>
@endsection

