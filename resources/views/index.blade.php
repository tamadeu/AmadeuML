<?php
$languages = request()->getLanguages();
$preferredLanguage = $languages[0]; // The first language in the list is the preferred language
?>
@include('partials.head')

<body className='snippet-body'>
    <div class="card" style="margin:15px;">
        <h1 class="card-title"><strong>{{ $chat_name }}</strong></h1>

        <ul class="chat-list">
            @foreach ($chats as $chat)
            @php
                $updatedAt = \Carbon\Carbon::parse($chat->updated_at);
                $formatedUpdatedAt = $updatedAt->format('d/m/y - H:i');
            @endphp
                <li class="chat-item">
                    <img class="user-pic" src="/assets/images/avatars/{{ $chat->avatar }}" alt="User picture">
                    <div class="chat-info">
                        <a href="/chat/{{ $chat->id }}">
                            <p class="chat-name">{{ $chat->title }}</p>
                        
                        <p class="chat-date">{{ $formatedUpdatedAt }}</p>
                        </a>
                    </div>
                    <form action="{{ route('chats.delete', ['id' => $chat->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this chat?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit"><?= trans('messages.Delete', [], $preferredLanguage) ?></button>
                    </form>
                </li>
            @endforeach
    
        </ul>
        
    <div class="new-chat">
        <a href="/new" class="btn btn-info" role="button" ><?= trans('messages.new_chat', [], $preferredLanguage) ?></a>
    </div>
    </div>
    
@include('partials.footer')
