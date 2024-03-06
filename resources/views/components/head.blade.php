<x-meta />
<x-fonts />

@vite(['resources/css/app.css', 'resources/js/app.js'])

<script>
    document.addEventListener('DOMContentLoaded', function() {
        ThemeManager.init();
    });
</script>
@stack('head_tags')

@production
<meta name="google-adsense-account" content="ca-pub-5845517826660589">
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5845517826660589"
crossorigin="anonymous"></script>
@endproduction