<?php
$languages = request()->getLanguages();
$preferredLanguage = $languages[0]; // The first language in the list is the preferred language
?>
@include('partials.head')

<body className='snippet-body'>
    <div class="card">
        @include('partials.header')


        <div class="ps-container ps-theme-default ps-active-y" id="chat-content">
                   
            
            @foreach($messages as $message)
            @if ($message->role === 'assistant')
            <div class="media media-chat">
                <div class="media-body">
                    {!! \Illuminate\Mail\Markdown::parse($message->content) !!}
                </div>
            </div>
            @elseif ($message->role === 'user')
            <div class="media media-chat media-chat-reverse">
                <div class="media-body">
                    {!! \Illuminate\Mail\Markdown::parse($message->content) !!}
                </div>
            </div>
            @endif
            @endforeach

            <div class="d-none media media-chat media-chat-reverse" id="userMessage">
                
            </div>

            <div id="loader" class="d-none" >
                <img src="/assets/images/loader.gif" alt="Loading..." style="width:120px">
            </div>

            <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;">
                <div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div>
            </div>
            <div class="ps-scrollbar-y-rail" style="top: 0px; height: 0px; right: 2px;">
                <div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 2px;"></div>
            </div>
        </div>

        <form id="footer-bar" class="publisher bt-1 border-light" action="/chat/{{ $randomId }}" method="post">
            @csrf
            <img class="avatar avatar-xs" src="/assets/images/robot.png" alt="...">
            <input class="publisher-input" id="message" type="text" name="message" autocomplete="off" spellcheck="false" placeholder="<?= trans('messages.ask_anything', [], $preferredLanguage) ?>">
            
            <a class="publisher-btn text-info" href="/reset"><i class="fa-solid fa-arrows-rotate"></i></a>
            <a class="publisher-btn text-info" href="#" data-abc="true" id="sendForm"><i class="fa fa-paper-plane"></i></a>
            
        </form>

    </div>
  
@include('partials.footer')