<div class="card-header">
    <a href="/" >
        <i class="fa-solid fa-chevron-left"></i>
    </a>
            <div class="btn-group">

                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ Auth::user()->name }}
                </button>

                <div class="dropdown-menu dropdown-menu-right">
                    <x-dropdown-link :href="route('profile.edit')" class="dropdown-item">
                        <?= trans('messages.Profile', [], $preferredLanguage) ?>
                    </x-dropdown-link>
                    <form method="POST" action="{{ route('logout') }}">
                    @csrf
                        <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="dropdown-item">
                            <?= trans('messages.Logout', [], $preferredLanguage) ?>
                        </x-dropdown-link>
                    </form>
                </div>

            </div>
        </div>