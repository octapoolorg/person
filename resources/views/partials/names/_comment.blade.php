<!-- Comments Section -->
<section class="px-6 py-10 w-full shadow rounded-lg border"> <!-- Full width section -->
    <h2 class="mb-6 text-3xl font-semibold text-slate-800 lg:text-4xl">Comments</h2>

    <div class="space-y-6 max-w-4xl mx-auto">
        @foreach ($data['nameDetails']->comments as $comment)
            <article class="flex space-x-4 p-4 rounded-lg shadow">
                <img src="{!! Avatar::create($comment->email)->toGravatar(['d' => 'identicon']); !!}" alt="User profile picture"
                     class="w-16 h-16 rounded-full">

                <div class="flex-1">
                    <h3 class="text-xl font-medium text-slate-800">{{$comment->name}}</h3>
                    <p class="text-lg leading-relaxed text-slate-700 max-w-prose">{{$comment->content}}</p>
                    <span class="text-slate-700">{{ $comment->created_at->diffForHumans() }}</span>
                </div>
            </article>
        @endforeach
    </div>

    <!-- Comment Form -->
    <div class="space-y-6 max-w-4xl mx-auto mt-10 rounded-lg">
        <h3 class="text-xl font-medium text-slate-800 mb-4">
            Leave a Comment:
        </h3>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
                 role="alert">
                <ul class="list-disc text-red-700">
                    @foreach ($errors->all() as $error)
                        <li class="text-sm">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('names.comments.store', $data['nameDetails']) }}" method="POST">
            <div class="space-y-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-slate-700">Name:</label>
                    <input type="text" id="name" name="name"
                           class="mt-1 p-2 w-full border border-slate-300 rounded-md shadow-sm"
                           placeholder="Your name" required>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700">
                        Email (won't be displayed):
                    </label>
                    <input type="email" id="email" name="email"
                           class="mt-1 p-2 w-full border border-slate-300 rounded-md shadow-sm"
                           placeholder="you@example.com" required>
                </div>

                <div>
                    <label for="comment" class="block text-sm font-medium text-slate-700">Comment:</label>
                    <textarea id="comment" name="content" rows="4"
                              class="mt-1 p-2 w-full border border-slate-300 rounded-md shadow-sm" placeholder="Add a comment..." required></textarea>
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