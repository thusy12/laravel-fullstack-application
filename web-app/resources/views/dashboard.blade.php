<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (Auth::user()->hasVerifiedEmail())
                        {{ __("Hi :name, You're successfully logged in!", ['name' => Auth::user()->name]) }}
                    @else
                        <div class="text-red-500">
                            {{ __("Please verify your email address to access the dashboard.") }}
                        </div>
                        <div class="mt-4">
                            <form method="POST" action="{{ route('verification.send') }}">
                                @csrf
                                <x-primary-button>
                                    {{ __('Resend Verification Email') }}
                                </x-primary-button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
