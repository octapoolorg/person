<!-- Comments Section -->
<section class="px-6 py-10 w-full dark:bg-gray-800 shadow rounded-lg "> <!-- Full width section -->
    <h2 class="mb-6 text-3xl font-semibold text-gray-800 dark:text-gray-100 lg:text-4xl">Comments</h2>

    <div class="space-y-6 max-w-4xl mx-auto">
        @foreach ($data['nameDetails']->comments as $comment)
            <article class="flex space-x-4 p-4 bg-white dark:bg-gray-800 rounded-lg shadow dark:shadow-none">
                <img src="{!! Avatar::create($comment->email)->toGravatar(['d' => 'identicon']); !!}" alt="User profile picture"
                     class="w-16 h-16 rounded-full">

                <div class="flex-1">
                    <h3 class="text-lg font-medium text-gray-800 dark:text-gray-100">{{$comment->name}}</h3>
                    <p class="text-gray-600 dark:text-gray-300">{{$comment->content}}</p>
                    <span class="text-gray-700 dark:text-gray-300">{{ $comment->created_at->diffForHumans() }}</span>
                </div>
            </article>
        @endforeach
    </div>

    <!-- Comment Form -->
    <div class="mt-10 p-6 bg-white dark:bg-gray-800 rounded-lg shadow dark:shadow-none max-w-4xl mx-auto">
        <h3 class="text-xl font-medium text-gray-800 dark:text-gray-100 mb-4">
            Leave a Comment:
        </h3>

        @if ($errors->any())
            <div class="bg-red-100 dark:bg-red-800 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
                 role="alert">
                <ul class="list-disc text-red-700 dark:text-red-300">
                    @foreach ($errors->all() as $error)
                        <li class="text-sm">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('names.comments.store', $data['nameDetails']) }}" method="POST">
            <div class="space-y-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-100">Name:</label>
                    <input type="text" id="name" name="name"
                           class="mt-1 p-2 w-full border border-gray-300 dark:border-gray-700 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-100"
                           placeholder="Your name" required>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-100">
                        Email (won't be displayed):
                    </label>
                    <input type="email" id="email" name="email"
                           class="mt-1 p-2 w-full border border-gray-300 dark:border-gray-700 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-100"
                           placeholder="you@example.com" required>
                </div>

                <div>
                    <label for="comment" class="block text-sm font-medium text-gray-700 dark:text-gray-100">Comment:</label>
                    <textarea id="comment" name="content" rows="4"
                              class="mt-1 p-2 w-full border border-gray-300 dark:border-gray-700 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-100" placeholder="Add a comment..." required></textarea>
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                            class="py-2 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-md shadow-sm">
                        Post Comment
                    </button>
                </div>
            </div>
            @csrf
        </form>
    </div>
</section>