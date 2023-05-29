<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Create Contact') }}
            </h2>
            <a href="{{ route('contacts.index') }}" class="bg-green-300 py-2 px-4 rounded">
                {{ __('Contacts') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form class="flex flex-col gap-2" action="{{ route('contacts.store') }}" method="post">
                        @csrf
                        <label>{{ __('Name') }}</label>
                        <input type="text" name="name">
                        @error('name')
                            <div class="text-sm text-red-500">
                                {{ $message }}
                            </div>
                        @enderror

                        <label>{{ __('Phone') }}</label>
                        <input type="text" name="phone">
                        @error('phone')
                            <div class="text-sm text-red-500">
                                {{ $message }}
                            </div>
                        @enderror

                        <button type="submit" class="bg-blue-300 py-2 px-4 rounded">
                            {{ __('Store') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
