@extends('layouts.main')

@section('content')
    <section class="row mb-5">
        <main class="col-lg-8">
            <section>
                <div class="p-5 mb-4 bg-body-tertiary rounded-3">
                    <div class="container-fluid py-5  text-center">
                        <h1 class="display-5 fw-bold text-capitalize">
                            {!! $data['nameDetails']->name !!}
                        </h1>
                        <p>means</p>
                        <p class="text-primary">❀ ❀ ❀ </p>
                        <h3 class="fs-4">{!! $data['nameDetails']->meaning !!}</h3>
                    </div>
                    <p class="text-md-end fst-italic">it is a {!! $data['nameDetails']->gender->gender !!} ...</p>
                </div>
            </section>

            <section class="p-3 p-md-4 border shadow-sm mb-5">
                <div class="d-flex flex-column flex-md-row align-items-md-center my-2">
                    <div class="flex-grow-1 ms-md-3 me-md-4">
                        <h3>
                            Zodiac Sign
                        </h3>
                        <p>
{{--{!! $data['numerology']['zodiac']['description'] !!}--}}
                            The zodiac sign of a person with the name Ali is Aries. This is the first sign of the
                            zodiac and is ruled by the planet Mars. People with this sign are known to be
                            courageous, confident, and determined. They are also known to be natural leaders.
                        </p>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="flex-shrink-0">
                            <div class="symbol d-flex align-items-center justify-content-center"
                                 style="width:100px;height:100px;font-size:3rem">
                                <figure class="figure">
                                    <img src="{!! asset("static/images/zodiac/signs/".strtolower($data['numerology']['zodiac']['sign']).".png") !!}"
                                         class="figure-img img-fluid rounded" alt="...">
                                    <figcaption class="figure-caption text-center fw-bolder text-black">
                                        {{ $data['numerology']['zodiac']['sign'] }}
                                    </figcaption>
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-column flex-md-row align-items-md-center my-2">
                    <div class="flex-grow-1 ms-md-3 me-md-4">
                        <h3>
                            Auspicious Stones
                        </h3>
                        <p>This color is often associated with energy, strength, power, determination, and
                            passion. It signifies leadership and assertiveness, making it a great choice for
                            number 1.
                        </p>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="flex-shrink-0">
                            <div class="symbol d-flex align-items-center justify-content-center"
                                 style="width:100px;height:100px;font-size:3rem">
                                <figure class="figure">
                                    <img src="{!! asset("static/images/zodiac/stones/citrine.png") !!}"
                                         class="figure-img img-fluid rounded" alt="...">
                                    <figcaption class="figure-caption text-center text-black fw-bolder">
                                        {{ $data['numerology']['zodiac']['attributes']['stone'] }}
                                    </figcaption>
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="p-3 p-md-4 border mb-5">
                <div class="d-flex flex-column flex-md-row align-items-md-center my-2">
                    <div class="flex-grow-1 ms-md-3 me-md-4">
                        <h3>Zodiac Sign </h3>
                        <p>This color is often associated with energy, strength, power, determination, and
                            passion. It signifies leadership and assertiveness, making it a great choice for
                            number 1.
                        </p>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="flex-shrink-0">
                            <div class="symbol bg-body-secondary d-flex align-items-center justify-content-center"
                                 style="width:100px;height:100px;font-size:3rem">
                                <img src="" style="width:130px">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-column flex-md-row align-items-md-center my-2">
                    <div class="flex-grow-1 ms-md-3 me-md-4">
                        <h3>Auspicious Color</h3>
                        <p>This color is often associated with energy, strength, power, determination, and
                            passion. It signifies leadership and assertiveness, making it a great choice for
                            number 1.
                        </p>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="flex-shrink-0">
                            <div class="symbol bg-body-secondary d-flex align-items-center justify-content-center"
                                 style="width:100px;height:100px;font-size:3rem">
                                <div class="square pulse red"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="">
                <h1>Details about Ali name</h1>
                <h2 class="">Ali Name Numerology</h2>
                <p class="">
                    Assigning a specific color to each number can help users quickly identify and resonate with
                    their numerology number. Here's a potential color association, though the choices are subjective
                    and can be adjusted: <a href="#">Persoanlity of Ali</a> , <a href="#">Soul of
                        Ali</a>
                </p>

                <h3>Numerology Number - {!! $data['numerology']['numbers']['destiny'] !!}</h3>
                <p class="callout callout-primary">
                    <b>Note:</b> "Lorem ipsum dolor sit, amet consectetur 4 adipisicing
                    elit. Placeat eius iusto molestias enim veritatis culpa deleniti ullam qui suscipit temporibus
                    dolorem velit, ad, debitis est tempore sapiente, in error harum?"
                </p>
                <h3>Soul Number - {!! $data['numerology']['numbers']['soul'] !!}</h3>
                <p class="callout callout-primary">
                    Lorem ipsum, dolor sit amet consectetur adipisicing
                    elit. Nisi, quo fugiat vero, quidem est ipsam magnam saepe neque, fugit ipsum et harum minima
                    molestiae. Voluptatum modi ut quo ipsum possimus.
                </p>
                <h3 class="my-3">Persoanlity Number - {!! $data['numerology']['numbers']['personality'] !!}</h3>
                <p class="callout callout-primary">
                    Lorem ipsum dolor sit amet consectetur, adipisicing
                    elit. Commodi quae ratione ullam architecto provident ducimus sint perferendis rem. Voluptas
                    excepturi consectetur esse quis earum explicabo veniam ab voluptates, aperiam quae.
                </p>
            </section>

            {{-- https://mdbootstrap.com/docs/standard/data/tables#section-advanced-example --}}
            <table class="table table-striped table-bordered">
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
                        <a href="">Alia</a>
                        <a href="">Alina</a>
                    </td>
                </tr>
                </tbody>
            </table>

            <h2 class=" my-3">Abbreviation of Ali</h2>
            <table class="table table-striped table-bordered">
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

            <h2 class="">Ali name wallpaper</h2>
            <img src="{!! asset('static/images/wallpaper.jpg') !!}" class="img-thumbnail my-3" style="width: 1280px" width="1280"
                 height="720" alt="Ali">
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Doloribus repellat, quis consequatur totam
                earum numquam cumque quas. Fugit, quasi minima.</p>
            <h2 class="">Ali - Fancy Text Styles</h2>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Veniam, fugiat!</p>
            <table class="table table-striped table-bordered table-hover">
                <tbody>
                @foreach ($data['fancyTexts'] as $fancyText)
                    <tr>
                        <th scope="row">{{ $fancyText }}</th>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="questions" itemscope itemtype="https://schema.org/FAQPage">
                <h2 class="">
                    Frequently asked questions (FAQ) about Ali
                </h2>
                <div class="item">
                    <div class="question" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                        <span>Q</span>
                        <span itemprop="name">
                            Is Ali a good name?
                        </span>
                    </div>
                    <div class="answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                        <span>A</span>
                        <span itemprop="text">Yes, Ali is a good name.</span>
                    </div>
                </div>
            </div>

            <section class="social-share my-4">
                <div class='social-share-btns'>
                    <a class='share-btn share-btn-instagram'
                       href='https://twitter.com/intent/tweet?text=url-current-page' rel='nofollow'
                       target='_blank'>
                        <i class='bi bi-instagram'></i>
                        Tweet
                    </a>
                    <a class='share-btn share-btn-facebook'
                       href='https://www.facebook.com/sharer/sharer.php?u=url-current-page' rel='nofollow'
                       target='_blank'>
                        <i class='bi bi-facebook'></i>
                        Share
                    </a>
                    <a class='share-btn share-btn-linkedin'
                       href='https://www.linkedin.com/cws/share?url=url-current-page' rel='nofollow'
                       target='_blank'>
                        <i class='bi bi-linkedin'></i>
                        Share
                    </a>
                    <a class='share-btn share-btn-reddit' href='http://www.reddit.com/submit?url=url-current-page'
                       rel='nofollow' target='_blank'>
                        <i class='bi bi-reddit'></i>
                        Share
                    </a>
                    <a class='share-btn share-btn-mail'
                       href='mailto:?subject=Ali name - all you need to know&amp;amp;body=url-current-page'
                       rel='nofollow' target='_blank' title='via email'>
                        <i class='bi bi-envelope'></i>
                        Share
                    </a>
                </div>
            </section>

            <section>
                <div class="my-3">
                    <h4 class="">User Comments About Ali</h4>
                    <div class="d-flex my-2">
                        <div class="flex-shrink-0">
                            <img src="https://via.placeholder.com/50x50" alt="...">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6>Ahmad Ali</h6>
                            <p>This is some content from a media component. You can replace this with any content
                                and
                                adjust it as needed.</p>
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

            <div class="card">
                <div class="card-body py-4">
                    <h5 class="card-title">Generate random name</h5>
                    <p class="card-text">Click to generate a list of random names to make a better choice.</p>
                    <a href="#" class="btn btn-primary text-uppercase">
                        <i class="bi bi-shuffle me-2"></i>Randomize
                    </a>
                </div>
            </div>

            <div class="card my-3">
                <h5 class="ps-3 pt-4">Follow us on Social</h5>
                <div class="card-body">
                    <div class="d-flex">
                        <a href="">
                            <img src="https://img.icons8.com/color/48/000000/facebook-new.png"  alt=""/>
                        </a>
                        <a href="">
                            <img src="https://img.icons8.com/color/48/000000/instagram-new--v1.png"  alt=""/>
                        </a>
                        <a>
                            <img src="https://img.icons8.com/color/48/000000/pinterest--v1.png"  alt=""/>
                        </a>

                    </div>
                </div>
            </div>

            <div class="card my-3">
                <h5 class="ps-3 pt-4">Popular Baby Names</h5>
                <div class="card-body">
                    <div class="d-flex flex-row flex-wrap gap-2">
                        <a href="" class="name-label">
                            <i class="bi bi-gender-male bg-boy text-white p-2 gender-label"></i>
                            <span class="text-center ms-3">Boy Names</span>
                        </a>
                        <a href="" class="name-label">
                            <i class="bi bi-gender-female bg-girl text-white p-2 gender-label"></i>
                            <span class="text-center ms-3">Girl Names</span>
                        </a>
                    </div>
                </div>
            </div>
        </aside>
    </section>
@endsection
