<?php
$languages = request()->getLanguages();
$preferredLanguage = $languages[0]; // The first language in the list is the preferred language
?>
<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        <?= trans('messages.Forgot your password? No problem. Just tell us your email address and we’ll email you a password reset link that will allow you to choose a new one.', [], $preferredLanguage) ?>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                <?= trans('messages.Email password reset link', [], $preferredLanguage) ?>
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
