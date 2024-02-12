<section class="max-w-4xl mx-auto bg-base-50 dark:bg-base-800 rounded-lg overflow-hidden text-base-900 dark:text-base-100 p-8 md:pt-16 relative">
    <article class="text-center">
        <header>
            <h1 class="text-4xl sm:text-5xl font-bold mb-4 dark:text-base-100" id="actual-name">
                {{ $name->name }}
                <a href="javascript:;" onclick="SpeechManager.speak(document.getElementById('actual-name').innerText.trim())" class="text-lg text-green-500 dark:text-green-400 hover:text-green-600 dark:hover:text-green-500">
                    <i class="fas fa-volume-up"></i>
                </a>
            </h1>
        </header>

        <div class="mt-8 mb-12">
            <strong class="text-xl font-semibold uppercase dark:text-base-200">
                Means:
            </strong>
            <p id="actual-meaning" class="text-base sm:text-lg mt-2 break-words dark:text-base-300 capitalize">
                {{ $name->meaning }}
            </p>
        </div>

        @if ($name->generated)
            <div class="flex justify-center mb-4">
                <div class="relative group">
                    <i class="fas fa-info-circle text-lg text-primary-500 dark:text-primary-400"></i>
                    <div class="absolute bottom-full mb-2 hidden group-hover:block bg-base-900 dark:bg-base-700 text-surface text-xs rounded py-1 px-3">
                        Based on Numerology.
                    </div>
                </div>
            </div>
        @endif
    </article>

    <a href="javascript:;" id="favorite-button" class="absolute top-4 right-4 text-pink-600 dark:text-pink-500 hover:text-pink-700 dark:hover:text-pink-600">
        <i class="far fa-heart" id="favorite-icon"></i>
    </a>
</section>
<footer class="bg-primary-500 dark:bg-primary-800 text-center py-4 rounded-b-xl">
    <p class="text-md text-surface font-bold dark:text-base-300" id="gender">
        Gender: <span class="font-normal dark:text-base-400">{{ $name->gender->name }}</span>
    </p>
</footer>