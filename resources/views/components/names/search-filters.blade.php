<div class="sm:col-span-1">
    <label for="alphabet" class="block text-sm font-medium text-base-700 dark:text-base-300">Alphabet</label>
    <select id="alphabet" name="alphabet" class="mt-1 block w-full pl-3 pr-10 py-2 bg-base-50 dark:bg-base-600 dark:text-base-300 border border-base-300 dark:border-base-500 dark:focus:border-primary-500 text-base-700 rounded-lg shadow-sm focus:bg-surface focus:border-primary-500 focus:ring-0 transition duration-300 ease-in-out">
        <option value="">Select Alphabet</option>
        @foreach(range('A', 'Z') as $char)
            <option value="{{ $char }}" {{ request()->query('alphabet') == $char ? 'selected' : '' }}>{{ $char }}</option>
        @endforeach
    </select>
</div>
<div class="sm:col-span-1">
    <label for="origin" class="block text-sm font-medium text-base-700 dark:text-base-300">Origin</label>
    <select id="origin" name="origin" class="mt-1 block w-full pl-3 pr-10 py-2 bg-base-50 dark:bg-base-600 dark:text-base-300 border border-base-300 dark:border-base-500 dark:focus:border-primary-500 text-base-700 rounded-lg shadow-sm focus:bg-surface focus:border-primary-500 focus:ring-0 transition duration-300 ease-in-out">
        <option value="">Select Origin</option>
        @foreach($origins as $origin)
            <option value="{{ $origin->slug }}" {{ request()->query('origin') == $origin->slug ? 'selected' : '' }}>{{ $origin->name }}</option>
        @endforeach
    </select>
</div>
<div class="sm:col-span-1">
    <label for="gender" class="block text-sm font-medium text-base-700 dark:text-base-300">Gender</label>
    <select id="gender" name="gender" class="mt-1 block w-full pl-3 pr-10 py-2 bg-base-50 dark:bg-base-600 dark:text-base-300 border border-base-300 dark:border-base-500 dark:focus:border-primary-500 text-base-700 rounded-lg shadow-sm focus:bg-surface focus:border-primary-500 focus:ring-0 transition duration-300 ease-in-out">
        <option value="">Select Gender</option>
        @foreach($genders as $gender)
            <option value="{{ $gender->slug }}" {{ request()->query('gender') == $gender->slug ? 'selected' : '' }}>{{ $gender->name }}</option>
        @endforeach
    </select>
</div>