<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <x-application-logo class="block h-12 w-auto"/>

                    <h1 class="mt-8 text-2xl font-medium text-gray-900">

                    </h1>

                    <p class="mt-6 text-gray-500 leading-relaxed">
                        Laravel Jetstream provides a beautiful, robust starting point for your next Laravel application.
                        Laravel is designed
                        to help you build your application using a development environment that is simple, powerful, and
                        enjoyable. We believe
                        you should love expressing your creativity through programming, so we have spent time carefully
                        crafting the Laravel
                        ecosystem to be a breath of fresh air. We hope you love it.
                    </p>
                </div>

                <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
                    <ul role="list" class="divide-y divide-gray-100">
                        @foreach($urls as $_url)
                            <li class="flex gap-x-4 py-5">
                                <div class="min-w-0">
                                    <p>
                                        @if(isset($url) && $url->id === $_url->id)
                                            <span class="text-2xl font-bold text-red-500">THIS</span>
                                        @endif
                                        #{{ $_url->id }}
                                    </p>
                                    <p class="text-sm font-semibold leading-6 text-gray-900">go/{{ $_url->code }}</p>
                                    <p class="mt-1 truncate text-xs leading-5 text-gray-500">{{ $_url->url }}</p>
                                </div>

                                <button
                                    onclick="navigator.clipboard.writeText('{{ route('url.show', $_url->code) }}')"
                                    class="mt-2 inline-flex items-center px-4 py-2  text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Copy
                                </button>
                                <button class="mt-2 inline-flex items-center px-4 py-2  text-sm font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    Delete
                                </button>
                            </li>
                        @endforeach
                    </ul>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>
