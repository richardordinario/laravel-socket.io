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
                                <li class="list-group-item user-{{$item['key']}}"> <a href="">{{$item['name']}}</a> </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="mt-2">Friends Name</h4>
                        </div>
                        <div class="card-body">
                            <div class="row mt-3">
                                <div class="col-md-2"></div>
                                <div class="col-md-10">
                                    <div class="card">
                                        <div class="card-body">
                                            Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit..."
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-10">
                                    <div class="card">
                                        <div class="card-body">
                                            Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit..."
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2"></div>
                            </div>
                        </div>
                        <div class="card-footer" style="background: transparent;">
                            <div class="form-group row pt-3">
                                <div class="col-md-10">
                                    <div class="chat-input w-100 bg-white"
                                    id="chat-input"
                                    contenteditable=""
                                    style="border: 2px solid #888; padding: 6px;border-radius:12px"></div>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-success">Submit</button>
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
<script>
   $(function () {
        $('.chat-input').keypress(function(e) {
            var val = $(this).html();
            if(e.which === 13 && !e.shiftKey) {
                $('.chat-input').html('')

            }
        })

        function send() {

        }

       let user_id = "{{ Auth::user()->id }}"
       let ip_address = '127.0.0.1'
       let socket_port = '8005'
       let socket = io(ip_address + ':' + socket_port)

       socket.on('connect', function(){
           socket.emit('user_connected', user_id)
       })

       socket.on('updateUserStatus', (data) => {
           $('.list-group-item').removeClass('bg-success')
           $.each(data, function(key, val) {
                if(val !== null && val !== 0) {
                    let usertab = $('.user-'+key)
                    usertab.addClass('bg-success text-white')
                    console.log(key)
                }
           })
       })
   })
</script>
@endsection
