<section class="px-4 py-10 md:p-8 bg-primary-800 mb-10 rounded-xl shadow-lg text-surface">
    <h2 class="text-2xl md:text-4xl text-surface dark:text-base-100 mb-4 font-semibold">
        Statuses for {!! $name->name !!}
    </h2>
    <p class="text-lg lg:text-xl leading-relaxed mb-8 max-w-prose">
        Social media statuses are a great way to express your feelings and thoughts. They reflect
        your personality and mood. Choose from a variety of statuses to find the one that
        best suits you.
    </p>

    @foreach ($data['statuses'] as $status)
    <blockquote class="mt-8 pl-4 border-l-4 border-surface/50 italic">
        <p class="text-lg lg:text-xl leading-relaxed max-w-prose">
            {!! $status !!}
        </p>
    </blockquote>
    @endforeach
</section>
