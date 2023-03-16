<form id="footer-bar" class="publisher bt-1 border-light" action="/chat/{{ $randomId }}" method="post">
    @csrf
    <img class="avatar avatar-xs" src="/assets/images/robot.png" alt="...">
    <input class="publisher-input" id="message" type="text" name="message" autocomplete="off" spellcheck="false" placeholder="<?= trans('messages.ask_anything', [], $preferredLanguage) ?>">
    
    <a class="publisher-btn text-info" href="/reset"><i class="fa-solid fa-arrows-rotate"></i></a>
    <a class="publisher-btn text-info" href="#" data-abc="true" id="sendForm"><i class="fa fa-paper-plane"></i></a>
    
</form>