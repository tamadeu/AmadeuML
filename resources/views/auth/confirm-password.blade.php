<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
         <?= trans('messages.This is a secure area of the app. Please confirm your password before continuing.', [], $preferredLanguage) ?>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="trans('messages.Password', [], $preferredLanguage)" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-4">
            <x-primary-button>
                 <?= trans('messages.Confirm', [], $preferredLanguage) ?>
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
