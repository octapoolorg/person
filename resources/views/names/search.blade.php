@extends('layouts.main')

@section('content')
<section class="py-12 bg-gray-50">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <!-- Search Form -->
                <form action="{{ route('names.search') }}" method="GET" class="space-y-8 divide-y divide-gray-200">
                    <div class="space-y-8 divide-y divide-gray-200 sm:space-y-5">
                        <div>
                            <div>
                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                    Search Names
                                </h3>
                                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                    Find names by keywords, alphabets, origin, or gender.
                                </p>
                            </div>
                            <div class="mt-6 sm:mt-5 space-y-6 sm:space-y-5">
                                <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                    <label for="search" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                        Name or Keyword
                                    </label>
                                    <div class="mt-1 sm:mt-0 sm:col-span-2">
                                        <div class="max-w-lg flex rounded-md shadow-sm">
                                            <input type="search" name="q" id="search" class="flex-1 block w-full min-w-0 rounded-md sm:text-sm border-gray-300" placeholder="Search names...">
                                        </div>
                                    </div>
                                </div>
                                <div class="sm:border-t sm:border-gray-200 sm:pt-5">
                                    <fieldset>
                                        <legend class="text-base font-medium text-gray-900">Filters</legend>
                                        <div class="mt-4 space-y-4">
                                            <div class="flex items-center">
                                                <label for="alphabet" class="mr-3 block text-sm font-medium text-gray-700">
                                                    Alphabet:
                                                </label>
                                                <select id="alphabet" name="alphabet" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                                    <option value="">Select Alphabet</option>
                                                    @foreach(range('A', 'Z') as $char)
                                                        <option value="{{ $char }}" {{ request()->query('alphabet') == $char ? 'selected' : '' }}>{{ $char }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="flex items-center">
                                                <label for="origin" class="mr-3 block text-sm font-medium text-gray-700">
                                                    Origin:
                                                </label>
                                                <select id="origin" name="origin" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                                    <option value="">Select Origin</option>
                                                    @foreach($origins as $origin)
                                                        <option value="{{ $origin->slug }}" {{ request()->query('origin') == $origin->slug ? 'selected' : '' }}>{{ $origin->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="flex items-center">
                                                <label for="gender" class="mr-3 block text-sm font-medium text-gray-700">
                                                    Gender:
                                                </label>
                                                <select id="gender" name="gender" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                                    <option value="">Select Gender</option>
                                                    @foreach($genders as $gender)
                                                        <option value="{{ $gender->slug }}" {{ request()->query('gender') == $gender->slug ? 'selected' : '' }}>{{ $gender->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pt-5">
                        <div class="flex justify-end">
                            <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Search
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
