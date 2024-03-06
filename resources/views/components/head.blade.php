<x-meta />
<x-fonts />

@vite(['resources/css/app.css', 'resources/js/app.js'])

<script>
    document.addEventListener('DOMContentLoaded', function() {
        ThemeManager.init();
    });
</script>
@stack('head_tags')
