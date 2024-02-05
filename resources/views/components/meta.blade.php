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
            const themes = ['default', 'funky', 'mellow', 'girly', 'boyish'];
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
@hasSection ('head')
    @yield('head')
@else
    {!! SEO::generate() !!}
@endif

@laravelPWA