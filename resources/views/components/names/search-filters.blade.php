<div>
    <label for="alphabet" class="block mb-2 text-sm font-medium text-base-900 dark:text-base-300">Alphabet</label>
    <select name="alphabet" id="alphabet" class="bg-surface border border-base-300 text-base-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-base-700 dark:border-base-600 dark:placeholder-base-400 dark:text-surface">
        <option value="">Select Alphabet</option>
        @foreach(range('A', 'Z') as $char)
            <option value="{{ $char }}" {{ request()->query('alphabet') == $char ? 'selected' : '' }}>{{ $char }}</option>
        @endforeach
    </select>
</div>
<div>
    <label for="origin" class="block mb-2 text-sm font-medium text-base-900 dark:text-base-300">Origin</label>
    <select name="origin" id="origin" class="bg-surface border border-base-300 text-base-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-base-700 dark:border-base-600 dark:placeholder-base-400 dark:text-surface">
        <option value="">Select Origin</option>
        @foreach($origins as $origin)
            <option value="{{ $origin->slug }}" {{ request()->query('origin') == $origin->slug ? 'selected' : '' }}>{{ $origin->name }}</option>
        @endforeach
    </select>
</div>
<div>
    <label for="gender" class="block mb-2 text-sm font-medium text-base-900 dark:text-base-300">Gender</label>
    <select name="gender" id="gender" class="bg-surface border border-base-300 text-base-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-base-700 dark:border-base-600 dark:placeholder-base-400 dark:text-surface">
        <option value="">Select Gender</option>
        @foreach($genders as $gender)
            <option value="{{ $gender->slug }}" {{ request()->query('gender') == $gender->slug ? 'selected' : '' }}>{{ $gender->name }}</option>
        @endforeach
    </select>
</div>