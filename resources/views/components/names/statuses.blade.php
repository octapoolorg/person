{{-- social media statuses for whatsapp, telegram, facebook--}}
<section class="px-4 py-10 md:p-8 border dark:border-base-700 mb-10 rounded-lg shadow dark:shadow-none bg-surface dark:bg-base-800">
    <h2 class="text-2xl md:text-4xl text-base-800 dark:text-base-100 mb-4 font-semibold">
        Social Media Statuses for {!! $name->name !!} Name
    </h2>
    <p class="text-lg leading-relaxed text-base-700 dark:text-base-300 max-w-prose">
        Social media statuses are a great way to express your feelings and thoughts. They are a reflection
        of your personality and mood. Choose from a variety of social media statuses to find the one that
        best suits you.
    </p>

    @foreach ($data['statuses'] as $status)
    <div class="mt-8">
        <h3 class="text-xl md:text-2xl text-base-800 dark:text-base-100 mb-4 font-semibold">
            Social Media Status {{ $loop->iteration }}:
        </h3>
        <p class="text-lg leading-relaxed text-base-700 dark:text-base-300 max-w-prose">
            {!! $status !!}
        </p>
    </div>
    @endforeach
</section>
