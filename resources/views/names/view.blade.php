<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ Vite::asset('resources/scss/app.scss') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

</head>

<body>

    <header class="bg-white shadow-sm">
        <nav id="top-nav" class="navbar navbar-expand-xl bg-primary navbar-dark">
            <div class="container">
                <a href="/" class="text-white text-uppercase">
                    <span class="fs-5">DivineSays</span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav mx-auto">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                        <a class="nav-link" href="#">Names</a>
                        <a class="nav-link" href="#">Blog</a>
                    </div>
                    <div class="navbar-nav">
                        <form class="col-12 col-lg-auto mb-3 mb-lg-0">
                            <label class="input-group">
                                <input type="search" class="form-control" placeholder="Search name..."
                                    aria-label="Search">
                                <button type="submit" class="input-group-text"><i class="bi bi-search"></i></button>
                            </label>
                        </form>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <div class="container mt-md-5">

        <section class="row mb-5">
            <main class="col-lg-8">

                <h1>Details about Ali name</h1>

                <div class="card mt-md-5">
                    <div class="card-header">
                        <h3>Meaning of Ali</h3>
                    </div>
                    <div class="card-body">
                        <p class="lead">
                            <b>Lorem ipsum dolor sit amet.</b>
                        </p>
                        <ul class="list-group" role="list">
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">Gender</div>
                                    Male
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">Origin</div>
                                    Arab
                                </div>
                            </li>
                        </ul>
                    </div>

                </div>

                <section class="mt-md-5">
                    <h2 class="">Ali Name Numerology</h2>
                    <p class="lead">
                        Ali is [gender] name of [origin] origin. It is mostly used by
                        people with [religion] religion. Meaning of Ali is [meaning, meaning two]. It
                        contains [m Letters and n Words]. <a href="#">Persoanlity of Ali</a> , <a
                            href="#">Soul of Ali</a>
                    </p>

                    <section class="my-5">
                        <div class="d-flex align-items-center my-2">
                            <div class="flex-grow-1 ms-3">
                                <h3>Zodiac Sign</h3>
                            </div>
                            <div class="flex-shrink-0">
                                <img src="https://via.placeholder.com/100x100" alt="...">
                            </div>
                        </div>
                        <div class="d-flex align-items-center my-2">
                            <div class="flex-grow-1 ms-3">
                                <h3>Auspicious Color</h3>
                            </div>
                            <div class="flex-shrink-0">
                                <img src="https://via.placeholder.com/100x100" alt="...">
                            </div>
                        </div>
                    </section>

                    <h3>Numerology Number </h3>
                    <p class="callout lead fst-italic">
                        "Lorem ipsum dolor sit, amet consectetur 4 adipisicing
                        elit. Placeat eius iusto molestias enim veritatis culpa deleniti ullam qui suscipit temporibus
                        dolorem velit, ad, debitis est tempore sapiente, in error harum?"
                    </p>
                    <h3>Soul Number</h3>
                    <p class="callout lead fst-italic">
                        Lorem ipsum, dolor sit amet consectetur adipisicing
                        elit. Nisi, quo fugiat vero, quidem est ipsam magnam saepe neque, fugit ipsum et harum minima
                        molestiae. Voluptatum modi ut quo ipsum possimus.
                    </p>
                    <h3 class="my-3">Persoanlity Number</h3>
                    <p class="callout lead fst-italic">
                        Lorem ipsum dolor sit amet consectetur, adipisicing
                        elit. Commodi quae ratione ullam architecto provident ducimus sint perferendis rem. Voluptas
                        excepturi consectetur esse quis earum explicabo veniam ab voluptates, aperiam quae.
                    </p>
                </section>



                {{-- https://mdbootstrap.com/docs/standard/data/tables#section-advanced-example --}}
                <table class="table table-striped table-bordered">
                    <tbody>
                        <tr>
                            <th scope="row" class="text-end">Auspicious Stones</th>
                            <td class="text-start text-primary">Ruby</td>
                        </tr>

                        <tr>
                            <th scope="row" class="text-end">Auspicious Metal</th>
                            <td class="text-start text-primary">Copper, Iron</td>
                        </tr>

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
                            <th scope="row" class="text-end">Ruling Planet</th>
                            <td class="text-start text-primary">Mars</td>
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
                {{-- <img src="{!! route('name.image', ['name' => strtolower($data['name'])]) !!}" class="img-thumbnail my-3" style="width: 1280px" width="1280" --}}
                {{-- height="720" alt="Ali"> --}}
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Doloribus repellat, quis consequatur totam
                    earum numquam cumque quas. Fugit, quasi minima.</p>
                <h2 class="">Ali - Fancy Text Styles</h2>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Veniam, fugiat!</p>
                <table class="table table-striped table-bordered table-hover">
                    <tbody>
                        {{-- @foreach ($data['fancyTexts'] as $fancyText)
                            <tr>
                                <th scope="row">{{ $fancyText }}</th>
                            </tr>
                        @endforeach --}}
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
                </section>

                <div class="my-3">
                    <h4 class="">User Comments About Ali</h4>
                    <div class="d-flex my-2">
                        <div class="flex-shrink-0">
                            <img src="https://via.placeholder.com/50x50" alt="...">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6>Ahmad Ali</h6>
                            <p>This is some content from a media component. You can replace this with any content and
                                adjust it as needed.</p>
                        </div>
                    </div>
                    <div class="d-flex my-2">
                        <div class="flex-shrink-0">
                            <img src="https://via.placeholder.com/50x50" alt="...">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6>Ahmad Ali</h6>
                            <p>This is some content from a media component. You can replace this with any content and
                                adjust it as needed.</p>
                        </div>
                    </div>
                    <div class="d-flex my-2">
                        <div class="flex-shrink-0">
                            <img src="https://via.placeholder.com/50x50" alt="...">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6>Ahmad Ali</h6>
                            <p>This is some content from a media component. You can replace this with any content and
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
            </main>
            <aside class="col-lg-4">

                <div class="card">
                    <h5 class="card-header">Get name ideas</h5>
                    <div class="card-body">
                        <h5 class="card-title">Generate rnadom name</h5>
                        <p class="card-text">Click to generate a list of random names to make a better choice.</p>
                        <a href="#" class="btn btn-primary text-uppercase"><i
                                class="bi bi-shuffle me-2"></i>Randomize</a>
                    </div>
                </div>

                {{-- <div class="card my-3">
                    <h5 class="card-header">Follow us on Social</h5>
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <a href=""><img
                                    src="https://img.icons8.com/color/48/000000/facebook-new.png" /></a>
                            <a href=""><img
                                    src="https://img.icons8.com/color/48/000000/pinterest--v1.png" /></a>
                            <a href=""><img
                                    src="https://img.icons8.com/color/48/000000/instagram-new--v1.png" /></a>
                            <a href=""><img src="https://img.icons8.com/color/48/000000/twitter--v1.png" /></a>
                        </div>
                    </div>
                </div> --}}

                <div class="card my-3">
                    <h5 class="card-header">Popular Boy Names</h5>
                    <div class="card-body">
                        <div class="d-flex flex-row flex-wrap gap-2">
                            <a href="" class="name-label">
                                <i class="bi bi-gender-male bg-boy text-white p-2 gender-label"></i>
                                <span class="text-center ms-3">Baby Name</span>
                            </a>
                            <a href="" class="name-label">
                                <i class="bi bi-gender-male bg-boy text-white p-2 gender-label"></i>
                                <span class="text-center ms-3">Baby Name</span>
                            </a>
                            <a href="" class="name-label">
                                <i class="bi bi-gender-male bg-boy text-white p-2 gender-label"></i>
                                <span class="text-center ms-3">Baby Name</span>
                            </a>
                            <a href="" class="name-label">
                                <i class="bi bi-gender-male bg-boy text-white p-2 gender-label"></i>
                                <span class="text-center ms-3">Baby Name</span>
                            </a>
                            <a href="" class="name-label">
                                <i class="bi bi-gender-male bg-boy text-white p-2 gender-label"></i>
                                <span class="text-center ms-3">Baby Name</span>
                            </a>
                            <a href="" class="name-label">
                                <i class="bi bi-gender-male bg-boy text-white p-2 gender-label"></i>
                                <span class="text-center ms-3">Baby Name</span>
                            </a>
                            <a href="" class="name-label">
                                <i class="bi bi-gender-male bg-boy text-white p-2 gender-label"></i>
                                <span class="text-center ms-3">Baby Name</span>
                            </a>
                            <a href="" class="name-label">
                                <i class="bi bi-gender-male bg-boy text-white p-2 gender-label"></i>
                                <span class="text-center ms-3">Baby Name</span>
                            </a>

                        </div>
                        <a href="" class="btn btn-info d-block my-2">More Boy Names</a>
                    </div>
                </div>

                <div class="card my-3">
                    <h5 class="card-header">Popular Girl Names</h5>
                    <div class="card-body">
                        <div class="d-flex flex-row flex-wrap gap-2">
                            <a href="" class="name-label">
                                <i class="bi bi-gender-female bg-girl text-white p-2 gender-label"></i>
                                <span class="text-center ms-3">Baby Name</span>
                            </a>
                            <a href="" class="name-label">
                                <i class="bi bi-gender-female bg-girl text-white p-2 gender-label"></i>
                                <span class="text-center ms-3">Baby Name</span>
                            </a>
                            <a href="" class="name-label">
                                <i class="bi bi-gender-female bg-girl text-white p-2 gender-label"></i>
                                <span class="text-center ms-3">Baby Name</span>
                            </a>
                            <a href="" class="name-label">
                                <i class="bi bi-gender-female bg-girl text-white p-2 gender-label"></i>
                                <span class="text-center ms-3">Baby Name</span>
                            </a>
                            <a href="" class="name-label">
                                <i class="bi bi-gender-female bg-girl text-white p-2 gender-label"></i>
                                <span class="text-center ms-3">Baby Name</span>
                            </a>
                            <a href="" class="name-label">
                                <i class="bi bi-gender-female bg-girl text-white p-2 gender-label"></i>
                                <span class="text-center ms-3">Baby Name</span>
                            </a>
                            <a href="" class="name-label">
                                <i class="bi bi-gender-female bg-girl text-white p-2 gender-label"></i>
                                <span class="text-center ms-3">Baby Name</span>
                            </a>
                            <a href="" class="name-label">
                                <i class="bi bi-gender-female bg-girl text-white p-2 gender-label"></i>
                                <span class="text-center ms-3">Baby Name</span>
                            </a>


                        </div>
                        <a href="" class="btn btn-danger d-block my-2">More Girl Names</a>
                    </div>
                </div>
            </aside>
        </section>
    </div>

    {{-- https://mdbootstrap.com/docs/standard/navigation/footer/ --}}
    <footer class="py-5 bg-primary text-white">
        <div class="container">
            <div class="row">
                <div class="col-2">
                    <h5>Section</h5>
                    <nav class="navbar" data-bs-theme="dark">
                        <div class="navbar-nav">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                            <a class="nav-link" href="#">Features</a>
                            <a class="nav-link" href="#">Pricing</a>
                            <a class="nav-link" href="#">Pricing</a>
                            <a class="nav-link" href="#">Pricing</a>
                        </div>
                    </nav>
                </div>

                <div class="col-2">
                    <h5>Section</h5>
                    <nav class="navbar" data-bs-theme="dark">
                        <div class="navbar-nav">
                            <a class="nav-link" aria-current="page" href="#">Home</a>
                            <a class="nav-link" href="#">Features</a>
                            <a class="nav-link" href="#">Pricing</a>
                            <a class="nav-link" href="#">Pricing</a>
                            <a class="nav-link" href="#">Pricing</a>
                        </div>
                    </nav>
                </div>

                <div class="col-2">
                    <h5>Section</h5>
                    <nav class="navbar" data-bs-theme="dark">
                        <div class="navbar-nav">
                            <a class="nav-link" aria-current="page" href="#">Home</a>
                            <a class="nav-link" href="#">Features</a>
                            <a class="nav-link" href="#">Pricing</a>
                            <a class="nav-link" href="#">Pricing</a>
                            <a class="nav-link" href="#">Pricing</a>
                        </div>
                    </nav>
                </div>

                <div class="col-4 offset-1">
                    <form action="">
                        <h5>Subscribe to our newsletter</h5>
                        <p>Monthly digest of whats new and exciting from us.</p>
                        <div class="d-flex w-100 gap-2">
                            <label for="newsletter1" class="visually-hidden">Email address</label>
                            <input id="newsletter1" required type="text" class="form-control"
                                placeholder="Email address">
                            <button class="btn bg-white text-black" type="submit">Subscribe</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="d-flex justify-content-between py-4 my-4 border-top">
                <p>&copy; 2021 Company, Inc. All rights reserved.</p>
                <ul class="list-unstyled d-flex social">
                    <li class="ms-3"><a class="link-dark" href="#"><i
                                class="bi bi-twitter text-white"></i></a></li>
                    <li class="ms-3"><a class="link-dark" href="#"><i
                                class="bi bi-instagram text-white"></i></a></li>
                    <li class="ms-3"><a class="link-dark" href="#"><i
                                class="bi bi-facebook text-white"></i></a></li>
                </ul>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>
