@extends('layouts.main')

@section('content')
    <section class="row mb-5">
        <main class="col-lg-8">
            <section>
                <div class="p-5 mb-5 bg-body-tertiary text-dark rounded-3 shadow-sm">
                    <div class="container py-5 text-center">
                        <h1 class="display-4 fw-bold text-capitalize text-info mb-2">
                            {!! $data['nameDetails']->name !!}
                        </h1>
                        <p class="fs-3 text-muted mb-3">Means</p>
                        <div class="mb-4">
                            <span class="text-primary display-3">❀</span>
                            <span class="text-primary display-3">❀</span>
                            <span class="text-primary display-3">❀</span>
                        </div>
                        <h2 class="fs-1 text-success mb-4">
                            {!! $data['nameDetails']->meaning !!}
                        </h2>
                    </div>
                    <div class="text-end pe-4">
                        <p class="fs-3 fst-italic text-secondary">
                            It is a {!! $data['nameDetails']->gender->name !!} name.
                        </p>
                    </div>
                </div>
            </section>


            <!-- Create a separate CSS file for the following styles -->
            <style>
                .symbol-container {
                    width: 100px;
                    height: 100px;
                    font-size: 3rem;
                }
            </style>

            <section class="p-3 p-md-4 border shadow-sm mb-5">
                <!-- Zodiac Sign Section -->
                @include('partials.names._box', [
                    'title' => 'Zodiac Sign',
                    'description' => __(
                        'zodiac.' . strtolower($data['numerology']['zodiac']['sign']) . '.zodiac_sign',
                        ['name' => $data['nameDetails']->name]),
                    'img_src' => asset(
                        'static/images/zodiac/signs/' . strtolower($data['numerology']['zodiac']['sign']) . '.png'),
                    'caption' => $data['numerology']['zodiac']['sign'],
                ])

                <!-- Auspicious Stones Section -->
                @include('partials.names._box', [
                    'title' => 'Auspicious Stones',
                    'description' => __(
                        'zodiac.' . strtolower($data['numerology']['zodiac']['sign']) . '.auspicious_stones',
                        ['name' => $data['nameDetails']->name]),
                    'img_src' => asset('static/images/zodiac/stones/citrine.png'),
                    'caption' => $data['numerology']['zodiac']['attributes']['stone'],
                ])
            </section>


            <section class="p-3 p-md-4 border mb-5">
                <div class="d-flex flex-column flex-md-row align-items-md-center my-2">
                    <div class="flex-grow-1 ms-md-3 me-md-4">
                        <h3>Auspicious Color</h3>
                        <p>
                            {!! __('zodiac.' . strtolower($data['numerology']['zodiac']['sign']) . '.auspicious_colors', [
                                'name' => $data['nameDetails']->name,
                            ]) !!}
                        </p>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="symbol bg-body-secondary d-flex align-items-center justify-content-center"
                            style="width:100px;height:100px;font-size:3rem">
                            <div class="square pulse orange"></div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="mb-5">
                <h2 class="mb-4">Details about {!! $data['nameDetails']->name !!} name</h2>

                <h3 class="my-3">{!! $data['nameDetails']->name !!} Name Numerology</h3>
                <p class="mb-3">
                    Assigning a specific color to each number can help users quickly identify and resonate with
                    their numerology number. Here's a potential color association, though the choices are subjective
                    and can be adjusted.
                </p>

                <h3 class="my-3">Numerology Number - {!! $data['numerology']['numbers']['destiny'] !!}</h3>
                <div class="callout callout-primary mb-4">
                    <b>{!! $data['nameDetails']->name !!}:</b>
                    <p>
                        {!! __('numerology.destiny.' . $data['numerology']['numbers']['destiny'], [
                            'name' => $data['nameDetails']->name,
                        ]) !!}
                    </p>
                </div>

                <h3 class="my-3">Soul Number - {!! $data['numerology']['numbers']['soul'] !!}</h3>
                <div class="callout callout-primary mb-4">
                    <b>{!! $data['nameDetails']->name !!}:</b>
                    <p>
                        {!! __('numerology.soul.' . $data['numerology']['numbers']['soul'], ['name' => $data['nameDetails']->name]) !!}
                    </p>
                </div>

                <h3 class="my-3">Personality Number - {!! $data['numerology']['numbers']['personality'] !!}</h3>
                <div class="callout callout-primary mb-4">
                    <b>{!! $data['nameDetails']->name !!}:</b>
                    <p>
                        {!! __('numerology.personality.' . $data['numerology']['numbers']['personality'], [
                            'name' => $data['nameDetails']->name,
                        ]) !!}
                    </p>
                </div>
            </section>

            {{-- https://mdbootstrap.com/docs/standard/data/tables#section-advanced-example --}}
            <table class="table table-striped table-bordered mb-5">
                <tbody>

                    <tr>
                        <th scope="row" class="text-end">Ruling Hours</th>
                        <td class="text-start text-primary">7am ~ 9am</td>
                    </tr>

                    <tr>
                        <th scope="row" class="text-end">Lucky Days</th>
                        <td class="text-start text-primary">Tuesday, Thursday</td>
                    </tr>

                    <tr>
                        <th scope="row" class="text-end">Passion</th>
                        <td class="text-start text-primary">To lead the way for others</td>
                    </tr>

                    <tr>
                        <th scope="row" class="text-end">Life Pursuit</th>
                        <td class="text-start text-primary">The thrill of the moment</td>
                    </tr>

                    <tr>
                        <th scope="row" class="text-end">Vibration</th>
                        <td class="text-start text-primary">Enthusiastic</td>
                    </tr>

                    <tr>
                        <th scope="row" class="text-end">Suffixed Name</th>
                        <td class="text-start text-primary">
                            <a href="">{!! $data['nameDetails']->name !!}a</a>
                            <a href="">{!! $data['nameDetails']->name !!}na</a>
                        </td>
                    </tr>
                </tbody>
            </table>

            <h2 class="my-3">Abbreviation of {!! $data['nameDetails']->name !!}</h2>
            <table class="table table-striped table-bordered mb-5">
                <tbody>
                    <tr>
                        <th scope="row">A</th>
                        <td>Awesome</td>
                    </tr>
                    <tr>
                        <th scope="row">L</th>
                        <td>Lion</td>
                    </tr>
                    <tr>
                        <th scope="row">I</th>
                        <td colspan="2">Intelligent</td>
                    </tr>
                </tbody>
            </table>

            <h2 class="fw-bold text-primary mb-3">{!! $data['nameDetails']->name !!} Name Wallpaper</h2>
            <img src="{!! asset('static/images/wallpaper.jpg') !!}" class="img-fluid rounded img-thumbnail my-4 shadow"
                alt="{!! $data['nameDetails']->name !!}" style="max-width: 100%; height: auto;">
            <p class="text-muted mb-4">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Doloribus repellat, quis
                consequatur totam earum numquam cumque quas. Fugit, quasi minima.</p>
            <h2 class="fw-bold text-primary mb-3">{!! $data['nameDetails']->name !!} - Fancy Text Styles</h2>
            <p class="text-muted mb-4">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Veniam, fugiat!</p>

            <!-- Fancy Text Table -->
            <table class="table table-striped table-bordered table-hover shadow-sm mb-5">
                <tbody>
                    @foreach ($data['fancyTexts'] as $fancyText)
                        <tr>
                            <th scope="row" class="fs-5">{{ $fancyText }}</th>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- FAQ Section -->
            <div class="questions" itemscope itemtype="https://schema.org/FAQPage">

                <h2 class="my-4">
                    Frequently asked questions (FAQ) about {!! $data['nameDetails']->name !!}
                </h2>

                <div class="item mb-3">
                    <div class="question" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                        <span>Q</span>
                        <span itemprop="name">
                            Is {!! $data['nameDetails']->name !!} a good name?
                        </span>
                    </div>
                    <div class="answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                        <span>A</span>
                        <span itemprop="text">Yes, {!! $data['nameDetails']->name !!} is a good name.</span>
                    </div>
                </div>

                <div class="item mb-3">
                    <div class="question" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                        <span>Q</span>
                        <span itemprop="name">
                            What is the meaning of {!! $data['nameDetails']->name !!}?
                        </span>
                    </div>
                    <div class="answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                        <span>A</span>
                        <span itemprop="text">{!! $data['nameDetails']->meaning !!}</span>
                    </div>
                </div>

                <div class="item mb-3">
                    <div class="question" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                        <span>Q</span>
                        <span itemprop="name">
                            How common is the name {!! $data['nameDetails']->name !!}?
                        </span>
                    </div>
                    <div class="answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                        <span>A</span>
                        <span itemprop="text">The name {!! $data['nameDetails']->name !!} is relatively common and has been used by
                            many individuals around the world.</span>
                    </div>
                </div>

                <div class="item mb-3">
                    <div class="question" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                        <span>Q</span>
                        <span itemprop="name">
                            Are there any famous personalities with the name {!! $data['nameDetails']->name !!}?
                        </span>
                    </div>
                    <div class="answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                        <span>A</span>
                        <span itemprop="text">Yes, there are several famous personalities named {!! $data['nameDetails']->name !!} in
                            various fields.</span>
                    </div>
                </div>

                <div class="item mb-3">
                    <div class="question" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                        <span>Q</span>
                        <span itemprop="name">
                            In which cultures or regions is the name {!! $data['nameDetails']->name !!} popular?
                        </span>
                    </div>
                    <div class="answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                        <span>A</span>
                        <span itemprop="text">The name {!! $data['nameDetails']->name !!} is popular in several cultures and regions,
                            including [List some regions/cultures here].</span>
                    </div>
                </div>

            </div>


            <section class="social-share my-4">
                <div class='social-share-btns'>
                    <a class='share-btn share-btn-instagram' href='https://twitter.com/intent/tweet?text=url-current-page'
                        rel='nofollow' target='_blank'>
                        <i class='bi bi-instagram'></i>
                        Tweet
                    </a>
                    <a class='share-btn share-btn-facebook'
                        href='https://www.facebook.com/sharer/sharer.php?u=url-current-page' rel='nofollow'
                        target='_blank'>
                        <i class='bi bi-facebook'></i>
                        Share
                    </a>
                    <a class='share-btn share-btn-linkedin' href='https://www.linkedin.com/cws/share?url=url-current-page'
                        rel='nofollow' target='_blank'>
                        <i class='bi bi-linkedin'></i>
                        Share
                    </a>
                    <a class='share-btn share-btn-reddit' href='http://www.reddit.com/submit?url=url-current-page'
                        rel='nofollow' target='_blank'>
                        <i class='bi bi-reddit'></i>
                        Share
                    </a>
                    <a class='share-btn share-btn-mail'
                        href='mailto:?subject={!! $data['nameDetails']->name !!} name - all you need to know&amp;amp;body=url-current-page'
                        rel='nofollow' target='_blank' title='via email'>
                        <i class='bi bi-envelope'></i>
                        Share
                    </a>
                </div>
            </section>

            <section>
                <div class="my-3">
                    <h4 class="mb-3">User Comments About {!! $data['nameDetails']->name !!}</h4>

                    <div class="d-flex my-2">
                        <div class="flex-shrink-0">
                            <img src="https://via.placeholder.com/50x50" alt="...">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6>{!! $data['nameDetails']->name !!}</h6>
                            <p>
                                This is some content from a media component.
                                You can replace this with any content and
                                adjust it as needed.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card my-5">
                    <div class="card-header">
                        Add a comment
                    </div>
                    <div class="card-body">
                        <form class="row g-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name">
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email">
                            </div>
                            <div class="col-12">
                                <label for="comment" class="form-label">Comment</label>
                                <textarea class="form-control" name="comment" id="comment" rows="3"></textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Submit comment</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>

        </main>
        <aside class="col-lg-4">

            <div class="card shadow-sm my-3">
                <div class="card-body py-4">
                    <h5 class="card-title fw-bold text-primary">Generate Random Name</h5>
                    <p class="card-text text-muted">Click to generate a list of random names to make a better choice.</p>
                    <a href="#" class="btn btn-primary text-uppercase">
                        <i class="bi bi-shuffle me-2"></i>Randomize
                    </a>
                </div>
            </div>

            <div class="card shadow-sm my-3">
                <h5 class="ps-3 pt-4 fw-bold text-primary">Follow Us on Social</h5>
                <div class="card-body">
                    <div class="d-flex justify-content-around">
                        <a href="">
                            <img src="https://img.icons8.com/color/48/000000/facebook-new.png" alt="Facebook" />
                        </a>
                        <a href="">
                            <img src="https://img.icons8.com/color/48/000000/instagram-new--v1.png" alt="Instagram" />
                        </a>
                        <a href="">
                            <img src="https://img.icons8.com/color/48/000000/pinterest--v1.png" alt="Pinterest" />
                        </a>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm my-3">
                <h5 class="ps-3 pt-4 fw-bold text-primary">Popular Baby Names</h5>
                <div class="card-body">
                    <div class="d-flex flex-row flex-wrap justify-content-around">
                        <a href="" class="name-label d-flex align-items-center">
                            <i class="bi bi-gender-male bg-boy text-white p-2 gender-label"></i>
                            <span class="text-center ms-3">Boy Names</span>
                        </a>
                        <a href="" class="name-label d-flex align-items-center">
                            <i class="bi bi-gender-female bg-girl text-white p-2 gender-label"></i>
                            <span class="text-center ms-3">Girl Names</span>
                        </a>
                    </div>
                </div>
            </div>

        </aside>

    </section>
@endsection
