@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row my-5 justify-content-center">
        <div class="col-md-10">
            <div class="row">
                <div class="col-md-8 justify-content-center">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="mt-2 friend_id" id="{{$id}}">Friends Name</h4>
                        </div>
                        <div class="card-body">
                            <div class="chat-wrapper"></div>
                        </div>
                        <div class="card-footer" style="background: transparent;">
                            <div class="form-group row pt-3">
                                <div class="col-md-12">
                                    <div class="chat-input w-100 bg-white"
                                    id="chat-input"
                                    contenteditable=""
                                    style="border: 2px solid #888; padding: 6px;border-radius:12px"></div>
                                </div>
                               
                            </div>
                            <button class="btn btn-primary text-white btn-sm btn-file">Add File</button> |
                            <button class="btn btn-info text-white btn-sm btn-bold" onclick="document.execCommand('bold', false, '');">B</button>
                            <button class="btn btn-secondary text-white btn-sm btn-italic" onclick="document.execCommand('italic', false, '');"> <i>I</i></button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@include('chat-script')
@endsection
