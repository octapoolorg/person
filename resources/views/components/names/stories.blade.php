<section class="px-6 py-10 w-full shadow rounded-lg border dark:border-base-700 bg-surface dark:bg-base-800" id="stories">
    <h2 class="mb-6 text-3xl font-semibold text-base-800 dark:text-base-100 lg:text-4xl">
        Share a story about {!! $name->name !!}
    </h2>

    <div class="space-y-6 max-w-4xl mx-auto">
        @foreach ($name->comments as $comment)
            <article
                class="flex space-x-6 p-6 rounded-lg bg-surface dark:bg-base-900 shadow transition duration-300 ease-in-out hover:bg-base-50 dark:hover:bg-base-700">
                <img src="{!! Avatar::create($comment->email)->toGravatar(['d' => 'identicon']) !!}" alt="Profile picture of {!! $comment->name !!}"
                    class="w-16 h-16 rounded-full border-4 border-base-200 dark:border-base-700 object-cover">

                <div class="flex-1">
                    <div class="flex justify-between items-center mb-1">
                        <h3 class="text-lg font-bold text-base-900 dark:text-surface">{!! $comment->name !!}</h3>
                        <span
                            class="text-sm font-medium text-base-500 dark:text-base-400">{!! $comment->created_at->diffForHumans() !!}</span>
                    </div>
                    <p class="text-base text-base-800 dark:text-base-300 leading-snug mb-2">
                        {!! $comment->content !!}
                    </p>
                </div>
            </article>
        @endforeach
    </div>

    <!-- Sotry Form -->
    <div class="space-y-6 max-w-4xl mx-auto mt-10 rounded-lg dark:shadow-none">
        <h3 class="text-xl font-medium text-base-800 dark:text-base-100 mb-4">
            Share your story
        </h3>

        @if ($errors->any())
            <div class="bg-red-100 dark:bg-red-800 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
                role="alert">
                <ul class="list-disc text-red-700 dark:text-red-300">
                    @foreach ($errors->all() as $error)
                        <li class="text-sm">{!! $error !!}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{!! route('names.stories', $name) !!}" method="POST">
            @csrf
            <div class="space-y-4">
                <div>
                    <label for="c-name"
                        class="block text-sm font-medium text-base-700 dark:text-base-100">Name:</label>
                    <input type="text" id="c-name" name="name"
                        class="mt-1 p-2 w-full border border-base-300 dark:border-base-500 focus:bg-surface placeholder:text-base-700 dark:placeholder:text-base-400 focus:border-primary-500 dark:focus:border-primary-500 focus:ring-0 rounded-md shadow-sm dark:text-base-100 bg-base-100 dark:bg-base-800"
                        placeholder="Your name" required>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-base-700 dark:text-base-100">
                        Email (won't be displayed):
                    </label>
                    <input type="email" id="email" name="email"
                        class="mt-1 p-2 w-full border border-base-300 dark:border-base-500 focus:bg-surface placeholder:text-base-700 dark:placeholder:text-base-400 focus:border-primary-500 dark:focus:border-primary-500 focus:ring-0 rounded-md shadow-sm dark:text-base-100 bg-base-100 dark:bg-base-800"
                        placeholder="you@example.com" required>
                </div>

                <div>
                    <label for="content" class="block text-sm font-medium text-base-700 dark:text-base-100">
                        Story:
                    </label>
                    <textarea id="content" name="content" rows="4"
                        class="mt-1 p-2 w-full border border-base-300 dark:border-base-500 focus:bg-surface placeholder:text-base-700 dark:placeholder:text-base-400 focus:border-primary-500 dark:focus:border-primary-500 focus:ring-0 rounded-md shadow-sm dark:text-base-100 bg-base-100 dark:bg-base-800"
                        placeholder="Your story ..." required></textarea>
                </div>



                <!-- Data Privacy Notice -->
                <div class="mt-6 text-sm text-base-500 dark:text-base-400">
                    By submitting this form, you agree to our <a href="/pages/privacy-policy">Privacy Policy</a>.
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="py-2 px-4 bg-primary-600 hover:bg-primary-700 text-surface font-semibold rounded-md shadow-sm">
                        Submit
                    </button>
                </div>
            </div>
        </form>
    </div>

</section>
