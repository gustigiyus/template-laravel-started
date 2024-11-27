<x-guest-layout>

    <h1 class="text-xl text-center font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
        Sign in to your account
    </h1>

    <!-- Session Status -->
    {{-- <x-auth-session-status class="mb-4" :status="session('status')" /> --}}

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Data is invalid: </strong>
            <span class="block sm:inline">
                <ul class="mt-1 ml-4 list-disc">
                    @foreach ($errors->all() as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </span>
            <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" aria-label="Close"
                onclick="this.parentElement.remove();">
                <svg class="fill-current h-6 w-6 text-red-700" role="button" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20">
                    <title>Close</title>
                    <path
                        d="M14.348 14.849a1 1 0 001.415-1.415L11.415 10l4.348-4.348a1 1 0 10-1.415-1.415L10 8.585 5.652 4.237a1 1 0 10-1.415 1.415L8.585 10l-4.348 4.348a1 1 0 001.415 1.415L10 11.415l4.348 4.348z" />
                </svg>
            </button>
        </div>
    @endif

    @if (Session::get('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">{{ Session::get('success') }}</strong>
            <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" aria-label="Close"
                onclick="this.parentElement.remove();">
                <svg class="fill-current h-6 w-6 text-green-700" role="button" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20">
                    <title>Close</title>
                    <path
                        d="M14.348 14.849a1 1 0 001.415-1.415L11.415 10l4.348-4.348a1 1 0 10-1.415-1.415L10 8.585 5.652 4.237a1 1 0 10-1.415 1.415L8.585 10l-4.348 4.348a1 1 0 001.415 1.415L10 11.415l4.348 4.348z" />
                </svg>
            </button>
        </div>
    @endif


    {{-- Form --}}
    <form method="POST" action="{{ route('sign-in-process') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="username" :value="__('Username')" />
            <x-text-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')"
                placeholder="enter your username" required autofocus autocomplete="off" />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                placeholder="enter your password" required autocomplete="off" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between mt-4">
            <div class="flex items-start">
                <div class="flex items-center h-5">
                    <input id="remember_me" name="remember" aria-describedby="remember" type="checkbox"
                        class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800">
                </div>
                <div class="ml-3 text-sm">
                    <label for="remember_me" class="text-gray-500 dark:text-gray-300">{{ __('Remember me') }}</label>
                </div>
            </div>
            {{-- @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                    class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500">
                    {{ __('Forgot your password?') }}
                </a>
            @endif --}}
        </div>

        <x-primary-button class="mb-3">
            {{ __('Log in') }}
        </x-primary-button>
    </form>
</x-guest-layout>
