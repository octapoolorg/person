<script>
    (function() {
        function setDarkMode() {
            const darkMode = localStorage.getItem('color-theme');
            if (darkMode === 'dark') {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        }

        function setThemeMode() {
            const themeName = localStorage.getItem('themeName');
            const themes = ['default', 'funky', 'girly', 'boyish','nature'];
            if (themes.includes(themeName)) {
                document.documentElement.setAttribute('data-theme', themeName);
            } else {
                document.documentElement.setAttribute('data-theme', themes[0]);
            }
        }

        setDarkMode();
        setThemeMode();
    })();
</script>


<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

@vite(['resources/css/app.css', 'resources/js/app.js'])

<link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">
<link rel="mask-icon" href="/favicon/safari-pinned-tab.svg" color="#5bbad5">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="theme-color" content="#ffffff">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="msvalidate.01" content="EDC406416E2FB3CDAC4827429E67472A" />

@stack('head')

@production
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-0NL5CQFS54"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-0NL5CQFS54');
</script>
@endproduction

{!! SEO::generate() !!}