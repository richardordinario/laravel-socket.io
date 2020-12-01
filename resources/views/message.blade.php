@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row my-5 justify-content-center">
        <div class="col-md-10">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            Friends List
                        </div>
                        <div class="card-body">
                            <ul class="list-group">
                                @foreach ($data as $item)
                            <li class="list-group-item user-{{$item['key']}}"> <a href="{{url('/chat'.'/'.$item['key'])}}">{{$item['name']}}</a> </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            
            </div>

        </div>
    </div>
</div>
@include('chat-script')
@endsection
