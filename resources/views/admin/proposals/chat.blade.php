@extends('layouts.admin.master')


@section('content')
    <div class="container p-0 ">
        <div class="card card-chat">
            <div class="card-header">
                <div class="row m-0 align-items-center">
                    <div class="col-md-12">
                        <div class="row align-items-center">
                            <div class="col-2">
                                <img src="{{asset('admin/assets/img/user/u2.jpg')}}" class="rounded-circle" />
                            </div>
                            <div class="col-10 pl-0">
                                <h3 class="title">{{$proposal->user->name}}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body px-0">
                <div class="row mx-0">
                    <div class="col-md-12 chat-right-content">
                        <div class="chat-content" id="chat-content">
                            @if($messages->isEmpty())
                            <p class="text-center mb-5" id="empty-message">No messages found.</p>
                            @else
                                @foreach($messages as $message)
                                    @if($message->from_id == auth()->user()->id)
                                        <div class="chat chat-message chat-right" id="{{ $message->id }}">
                                            <div class="chat-body">
                                                <p class="message">{{ $message->message }}</p>
                                                <div class="date-time">{{ $message->created_at->format('d-m-Y, h:i A') }}</div>
                                            </div>
                                            <img class="rounded-circle ml-3" src="{{asset('admin/assets/img/user/u-xl-4.jpg')}}" alt="Image">
                                        </div>
                                    @else
                                        <div class="chat chat-message chat-left" id="{{ $message->id }}">
                                            <img class="rounded-circle mr-3" src="{{asset('admin/assets/img/user/u2.jpg')}}" alt="Image">
                                            <div class="chat-body">
                                                <p class="message">{{ $message->message }}</p>
                                                <div class="date-time">{{ $message->created_at->format('d-m-Y, h:i A') }}</div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                        <form class="px-5 pb-3" id="message-form">
                            <input type="text" class="form-control mb-3" placeholder="Type your message here" id="message-input">
                            <button data-from_id="{{auth()->user()->id}}" data-to_id="{{$proposal->user->id}}" data-proposal_id="{{$proposal->id}}" class="float-right btn btn-primary" id="send-button"><i class="mdi mdi-send"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
    // Get references to the input and button elements
    const messageInput = $('#message-input');
    const sendButton = $('#send-button');
    const chatContent = $('#chat-content');
    
    // Add a click event listener to the send button
    sendButton.on('click', function(event) {
        event.preventDefault();
        
        var from_id = $(this).attr('data-from_id'); 
        var to_id = $(this).attr('data-to_id');
        var proposal_id = $(this).attr('data-proposal_id'); 
        // Get the value of the message input
        const message = messageInput.val().trim();
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        // Check if the message input is not empty
        if (message !== '') {
            // Send the message to the server using Ajax
            $.ajax({
                url: '/send-message',
                method: 'POST',
                data: {
                    from_id: from_id, 
                    to_id: to_id, 
                    proposal_id: proposal_id, // Replace with the ID of the proposal
                    message: message,
                    _token: csrfToken,
                },
                success: function(data) {
                    // Create a new chat message element with the message and the current date and time
                    const chatMessage = `
                        <div class="chat chat-message chat-right" id="${data.id}">
                            <div class="chat-body">
                                <p class="message">${message}</p>
                                <div class="date-time">${new Date().toLocaleString()}</div>
                            </div>
                            <img class="rounded-circle ml-3" src="{{asset('admin/assets/img/user/u-xl-4.jpg')}}" alt="Image">
                        </div>`;
                    $("#empty-message").remove();
                    // Append the new chat message element to the chat content
                    chatContent.append(chatMessage);
                    
                    // Clear the message input
                    messageInput.val('');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error(errorThrown);
                }
            });
        }
    });

    function loadMessages() {
        var lastMessageId = $('.chat-message:last').attr('id');
        $.ajax({
            url: '/messages',
            type: 'GET',
            data: {last_message_id: lastMessageId},
            success: function(response) {
                if (response && response.length > 0) {
                    $.each(response, function(i, message) {
                        // Append the new message to the chat window
                        var html = '<div class="chat chat-message chat-left" id="' + message.id + '">' +
                                '<img class="rounded-circle mr-3" src="' + message.from.avatar + '" alt="Image">' +
                                '<div class="chat-body">' +
                                '<p class="message">' + message.message + '</p>' +
                                '<div class="date-time">' + message.created_at + '</div>' +
                                '</div>' +
                                '</div>';
                        
                        $('#chat-content').append(html);
                    });
                }
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    }

    // Load messages on page load
    loadMessages();

    // Periodically load new messages
    setInterval(loadMessages, 5000);
</script>
@endsection