<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Contacts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid md:grid-cols-3 gap-2">
                        @if ($contacts->count())
                            @foreach ($contacts as $contact)
                                <div class="bg-gray-200 p-4 rounded">
                                    <div>
                                        {{ $contact->name }}
                                    </div>
                                    <div>
                                        {{ $contact->phone }}
                                    </div>
                                    <div class="my-4 flex justify-between">
                                        <a href="#" class="bg-orange-400 rounded px-4 py-2">
                                            {{ __('Update') }}
                                        </a>
                                        <form action="" method="post">
                                            <button type="submit" class="bg-red-400 rounded px-4 py-2">
                                                {{ __('Delete') }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div>
                                {{ __('The contact list is empty.') }}
                            </div>
                        @endif
                    </div>
                    @if ($contacts->count())
                        <div class="mt-4">
                            {{ $contacts->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
