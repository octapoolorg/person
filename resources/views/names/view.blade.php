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
        <nav id="top-nav" class="navbar navbar-expand-xl topnav-menu">
            <div class="container">
                <a href="/" class="navbar-brand">
                    <span class="fs-5">NameCenter</span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">

                    <div class="nav-bar ms-auto w-25">
                        <form class="input-group">
                            <input type="text" class="form-control" placeholder="Search Name"
                                aria-label="Search Name" aria-describedby="search">
                            <button class="btn btn-primary" title="Search name" type="button" id="search">
                                <i class="bi bi-search"></i>
                            </button>
                        </form>
                    </div>
                    <div class="navbar-nav ms-auto">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                        <a class="nav-link" href="#">Names</a>
                        <a class="nav-link" href="#">Blog</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <div class="container mt-md-5">

        <section class="row mb-5">
            <main class="col-lg-8">



                <section>
                    <div class="p-5 mb-4 bg-body-tertiary rounded-3">
                        <div class="container-fluid py-5  text-center">
                            <h1 class="display-5 fw-bold text-capitalize">
                                {!! $data['name']['name'] !!}
                            </h1>
                            <p>means</p>
                            <p class="text-primary">❀ ❀ ❀ </p>
                            <h3 class="fs-4">lorem, ipsum dolor, sit amet</3>
                        </div>
                        <p class="text-md-end fst-italic">it is a girl name ...</p>
                    </div>
                </section>

                <section class="p-3 p-md-4 border mb-5">
                    <div class="d-flex flex-column flex-md-row align-items-md-center my-2">
                        <div class="flex-grow-1 ms-md-3 me-md-4">
                            <h3>♈ Zodia Sign
                                {{-- <span class="ms-md-1 badge bg-boy">Leo</span>     --}}
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
                                        <img src="https://www.pngall.com/wp-content/uploads/2016/05/Leo-PNG-Image.png"
                                            class="figure-img img-fluid rounded" alt="...">
                                        <figcaption class="figure-caption text-center">
                                            Leo
                                        </figcaption>
                                    </figure>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-column flex-md-row align-items-md-center my-2">
                        <div class="flex-grow-1 ms-md-3 me-md-4">
                            <h3>
                                💎 Auspicious Stones
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
                                        <img src="https://img.icons8.com/color-glass/90/emerald.png"
                                            class="figure-img img-fluid rounded" alt="...">
                                        <figcaption class="figure-caption text-center">
                                            Emerald
                                        </figcaption>
                                    </figure>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-column flex-md-row align-items-md-center my-2">
                        <div class="flex-grow-1 ms-md-3 me-md-4">
                            <h3> Auspicious Metal
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
                                        <img src="https://www.pngall.com/wp-content/uploads/2016/05/Leo-PNG-Image.png"
                                            class="figure-img img-fluid rounded" alt="...">
                                        <figcaption class="figure-caption text-center">
                                            Leo
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
                            <h3>Zodia Sign </h3>
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

                    {{-- <section class="p-3 p-md-4 border mb-3">
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
                        <div class="d-flex flex-column flex-md-row align-items-md-center my-2">
                            <div class="flex-grow-1 ms-md-3 me-md-4">
                                <h3>Symbol or Icon</h3>
                                <p>A crown is a symbol of leadership, authority, and distinction. It's a clear
                                    representation of someone who stands out and takes charge.</p>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="symbol bg-body-secondary d-flex align-items-center justify-content-center"
                                    style="width:100px;height:100px;font-size:3rem">
                                    👑
                                </div>
                            </div>
                        </div>
                    </section> --}}

                    <h3>Numerology Number - {!! $data['name']['numerology']['numbers']['destiny'] !!}</h3>
                    <p class="callout callout-primary">
                        <b>Note:</b> "Lorem ipsum dolor sit, amet consectetur 4 adipisicing
                        elit. Placeat eius iusto molestias enim veritatis culpa deleniti ullam qui suscipit temporibus
                        dolorem velit, ad, debitis est tempore sapiente, in error harum?"
                    </p>
                    <h3>Soul Number - {!! $data['name']['numerology']['numbers']['soul'] !!}</h3>
                    <p class="callout callout-primary">
                        Lorem ipsum, dolor sit amet consectetur adipisicing
                        elit. Nisi, quo fugiat vero, quidem est ipsam magnam saepe neque, fugit ipsum et harum minima
                        molestiae. Voluptatum modi ut quo ipsum possimus.
                    </p>
                    <h3 class="my-3">Persoanlity Number - {!! $data['name']['numerology']['numbers']['personality'] !!}</h3>
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
                        @foreach ($data['name']['fancyTexts'] as $fancyText)
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
                        <a href="#" class="btn btn-primary text-uppercase"><i
                                class="bi bi-shuffle me-2"></i>Randomize</a>
                    </div>
                </div>

                <div class="card my-3">
                    <h5 class="ps-3 pt-4">Follow us on Social</h5>
                    <div class="card-body">
                        <div class="d-flex">
                            <a href="">
                                <img src="https://img.icons8.com/color/48/000000/facebook-new.png" />
                            </a>
                            <a href="">
                                <img src="https://img.icons8.com/color/48/000000/instagram-new--v1.png" />
                            </a>
                            <a>
                                <img src="https://img.icons8.com/color/48/000000/pinterest--v1.png" />
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
    </div>

    {{-- https://mdbootstrap.com/docs/standard/navigation/footer/ --}}
    {{-- <footer class="py-5 bg-primary text-white">
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
    </footer> --}}


    <!-- Footer -->
    <footer class="text-center text-lg-start bg-white text-muted">


        <!-- Section: Links  -->
        <section class="">
            <div class="container text-center text-md-start mt-5">

                <!-- Section: Social media -->
                <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
                    <!-- Left -->
                    <div class="me-5 d-none d-lg-block">
                        <span>Get connected with us on social networks:</span>
                    </div>
                    <!-- Left -->

                    <!-- Right -->
                    <div>
                        <a href="" class="me-4 link-dark text-decoration-none">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a href="" class="me-4 link-dark text-decoration-none">
                            <i class="bi bi-instagram"></i>
                        </a>
                        <a href="" class="me-4 link-dark text-decoration-none">
                            <i class="bi bi-reddit"></i>
                        </a>
                    </div>
                    <!-- Right -->
                </section>
                <!-- Section: Social media -->

                <!-- Grid row -->
                <div class="row mt-3">
                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                        <!-- Content -->
                        <h6 class="text-uppercase fw-bold mb-4">
                            <i class="bi bi-gem me-3 text-secondary"></i>Company name
                        </h6>
                        <p>
                            Here you can use rows and columns to organize your footer content. Lorem ipsum
                            dolor sit amet, consectetur adipisicing elit.
                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold mb-4">
                            Products
                        </h6>
                        <p>
                            <a href="#!" class="nav-link">Angular</a>
                        </p>
                        <p>
                            <a href="#!" class="nav-link">React</a>
                        </p>
                        <p>
                            <a href="#!" class="nav-link">Vue</a>
                        </p>
                        <p>
                            <a href="#!" class="nav-link">Laravel</a>
                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold mb-4">
                            Useful links
                        </h6>
                        <p>
                            <a href="#!" class="nav-link">Pricing</a>
                        </p>
                        <p>
                            <a href="#!" class=" nav-link">Settings</a>
                        </p>
                        <p>
                            <a href="#!" class=" nav-link">Orders</a>
                        </p>
                        <p>
                            <a href="#!" class=" nav-link">Help</a>
                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold mb-4">
                            Useful links
                        </h6>
                        <p>
                            <a href="#!" class=" nav-link">Pricing</a>
                        </p>
                        <p>
                            <a href="#!" class=" nav-link">Settings</a>
                        </p>
                        <p>
                            <a href="#!" class=" nav-link">Orders</a>
                        </p>
                        <p>
                            <a href="#!" class=" nav-link">Help</a>
                        </p>
                    </div>
                    <!-- Grid column -->
                </div>
                <!-- Grid row -->
            </div>
        </section>
        <!-- Section: Links  -->

        <!-- Copyright -->
        <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.025);">
            © {{ date('Y') }} Copyright:
            <a class="text-reset fw-bold" href="">Domain.com</a>
        </div>
        <!-- Copyright -->
    </footer>
    <!-- Footer -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>
