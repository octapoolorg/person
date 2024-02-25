<section class="py-8 px-4 md:px-8 rounded-lg shadow dark:shadow-none my-10 border dark:border-base-700 bg-surface dark:bg-base-800" id="abbreviations">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <h2 class="text-2xl md:text-4xl text-base-800 dark:text-base-100 mb-4 md:mb-10 font-semibold">
            Abbreviations of {!! $name->name !!}
        </h2>
        <a href="javascript:" id="generate-abbreviations" class="group mt-4 md:mt-0 text-primary-600 hover:text-primary-800 dark:hover:text-primary-200 dark:text-primary-400 font-semibold transition-colors duration-300 flex items-center self-end">
            Generate new
            <i class="fas fa-sync-alt ml-2 group-hover:text-primary-800 dark:group-hover:text-primary-200"></i>
        </a>
    </div>
    <div class="overflow-hidden">
        <table class="w-full text-left text-base-600 dark:text-base-300">
            <tbody class="divide-y divide-base-200 dark:divide-base-700" id="abbreviations">
                @foreach ($data['abbreviations'] as $abbreviationData)
                    @foreach ($abbreviationData as $alphabet => $abbreviation)
                        <tr class="hover:bg-base-100 dark:hover:bg-base-700 transition-colors duration-300">
                            <th class="text-lg p-4 font-semibold text-base-800 dark:text-base-100 bg-base-100 dark:bg-base-700 uppercase">
                                {!! $alphabet !!}
                            </th>
                            <td class="text-lg p-4 text-base-900 dark:text-base-100">{!! $abbreviation !!}</td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
</section>