<?php
$languages = request()->getLanguages();
$preferredLanguage = $languages[0]; // The first language in the list is the preferred language
?>
<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="trans('messages.Password', [], $preferredLanguage)" />
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="row">
            <div class="block mt-4 col-6">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-400"><?= trans('messages.Remember me', [], $preferredLanguage) ?></span>
                </label>
            </div>
        
            <div class="block mt-4 col-6">
            @if (Route::has('password.request'))
                <a class="flex justify-end underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    <?= trans('messages.Forgot your password?', [], $preferredLanguage) ?>
                </a>
            @endif
            </div>
        </div>

        <div class="flex items-center justify-end mt-4">
   

            <x-primary-button class="ml-3">
                <?= trans('messages.Login', [], $preferredLanguage) ?>
            </x-primary-button>
        </div>
        
        <a href="auth/google" class="google btn"><i class="fa fa-google fa-fw"></i> <?= trans('messages.login_google', [], $preferredLanguage) ?></a>

        
        <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('register') }}">
            <?= trans('messages.Don’t have an account? Create one.', [], $preferredLanguage) ?>
        </a>
        
    </form>
</x-guest-layout>
