<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
         <?= trans('messages.Thanks for signing up! Before you start, could you verify your email address by clicking on the link we just sent you? If you did not receive the email, we will be happy to send you another one.', [], $preferredLanguage) ?>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
             <?= trans('messages.A new verification link has been sent to the email address you provided during registration.', [], $preferredLanguage) ?>
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                     <?= trans('messages.Resend Verification Email', [], $preferredLanguage) ?>
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                    <?= trans('messages.Logout', [], $preferredLanguage) ?>
            </button>
        </form>
    </div>
</x-guest-layout>
