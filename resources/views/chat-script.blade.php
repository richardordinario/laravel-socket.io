<script>
    $(function () {
         $('.chat-input').keypress(function(e) {
            if(e.which === 13 && !e.shiftKey) {
                let message = $(this).html()
                send(message)
                $('.chat-input').html('')
                return false
            }
         })
 
         function send(message) { 
             let friend_id = $('.friend_id').attr('id')
             let url = '/send'
             let form = $(this)
             let formData = new FormData()
             let token = "{{ csrf_token() }}"
 
             formData.append('message', message)
             formData.append('_token', token)
             formData.append('receiver_id', friend_id)
            
             $.ajax({
                 url: '/send',
                 type: 'POST',
                 data: formData,
                 processData: false,
                 contentType: false,
                 dataType: 'JSON',
                 success:function(data) {
                    appendMessageSender(message)
                 }
             })
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

        function appendMessageSender(message) {
            let name ='{{ Auth::user()->name }}'
            let html = ''            
            html += '<div class="row mt-3">'
            html += '<div class="col-md-2"><div class="bg-secondary" style="height:50px;width:50px;border-radius:50%"></div></div>'
            html += '<div class="col-md-10">'
            html += '<small>'+name+'</small> <small class="float-right">1 min ago</small>'
            html += '<div class="card">'
            html += '<div class="card-body">'
            html += message
            html += '</div>'
            html += '</div>'
            html += '</div>'
            html += '</div>'
            $('.chat-wrapper').append(html)
        }

        function appendMessageReceiver(message) {
            let html = ''            
            html += '<div class="row mt-3">'
            html += '<div class="col-md-2"><div class="bg-secondary" style="height:50px;width:50px;border-radius:50%"></div></div>'
            html += '<div class="col-md-10">'
            html += '<small>'+message.sender_name+'</small> <small class="float-right">'+message.created_at+'</small>'
            html += '<div class="card">'
            html += '<div class="card-body">'
            html += message.content
            html += '</div>'
            html += '</div>'
            html += '</div>'
            html += '</div>'
            $('.chat-wrapper').append(html)
        }

        socket.on('message-channel:App\\Events\\MessageEvent', function(message) {
            console.log('new message')
            appendMessageReceiver(message)
        })
    })
 </script>