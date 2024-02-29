export class ThemeManager {
    constructor() {
        this.themeButton = document.getElementById('themeButton');
        this.themeDropdown = document.getElementById('themeDropdown');
        this.modes = ['default', 'funky', 'girly', 'boyish', 'nature'];
        this.currentTheme = 'default';

        // Bind the handleScroll method to the instance
        this.handleScroll = this.handleScroll.bind(this);
    }

    init() {
        this.initializeDarkMode();
        this.initColorTheme();
        this.createThemeDropdown();
        this.addEventListeners();

        window.addEventListener('scroll', this.handleScroll);
    }

    handleScroll() {
        if (window.scrollY > 20) {
            this.toggleThemeButton(false);
        } else {
            this.toggleThemeButton(true);
        }
    }

    toggleDarkMode() {
        const isDarkMode = document.documentElement.classList.toggle('dark');
        localStorage.setItem('color-theme', isDarkMode ? 'dark' : 'light');
        this.updateIcons();
    }

    updateIcons() {
        const isDarkMode = document.documentElement.classList.contains('dark');
        const buttons = document.querySelectorAll('.toggle');
        buttons.forEach((btn) => {
            const darkIcon = btn.querySelector('.dark-icon');
            const lightIcon = btn.querySelector('.light-icon');
            darkIcon.classList.toggle('hidden', !isDarkMode);
            lightIcon.classList.toggle('hidden', isDarkMode);
        });
    }

    initializeDarkMode() {
        const colorTheme = localStorage.getItem('color-theme');
        if (colorTheme === 'dark') {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
        this.updateIcons();
    }

    initColorTheme() {
        const defaultTheme = 'default';
        const storedTheme = localStorage.getItem('themeName');
        const documentTheme = document.documentElement.getAttribute('data-theme');
        this.currentTheme = this.modes.includes(documentTheme) ? documentTheme : (this.modes.includes(storedTheme) ? storedTheme : defaultTheme);
        this.changeColorTheme(this.currentTheme);
    }

    createThemeDropdown() {
        this.modes.forEach(mode => {
            const listItem = document.createElement('li');
            listItem.setAttribute('data-theme', mode);

            const link = document.createElement('a');
            link.className = 'p-5 inline-block cursor-pointer bg-primary-700 rounded-full';
            link.setAttribute('data-theme-select', mode);

            listItem.appendChild(link);
            this.themeDropdown.appendChild(listItem);
        });
    }

    changeColorTheme(selectedTheme) {
        if (this.modes.includes(selectedTheme)) {
            this.currentTheme = selectedTheme;
            document.documentElement.setAttribute('data-theme', selectedTheme);
            localStorage.setItem('themeName', selectedTheme);
        } else {
            this.resetToDefaultTheme();
        }
    }

    resetToDefaultTheme() {
        this.currentTheme = this.modes[0];
        document.documentElement.setAttribute('data-theme', this.currentTheme);
        localStorage.setItem('themeName', this.currentTheme);
    }

    addEventListeners() {
        document.addEventListener('click', this.handleDocumentClick.bind(this));
    }

    handleDocumentClick(e) {
        if (this.themeButton.contains(e.target)) {
            this.themeDropdown.classList.toggle('hidden');
        } else if (e.target.tagName === 'A' && e.target.hasAttribute('data-theme-select')) {
            const selectedTheme = e.target.getAttribute('data-theme-select');
            this.changeColorTheme(selectedTheme);
            this.themeDropdown.classList.add('hidden');
        } else if (!this.themeDropdown.contains(e.target)) {
            this.themeDropdown.classList.add('hidden');
        }
    }

    toggleThemeButton(show) {
        this.themeButton.style.display = show ? 'block' : 'none';
    }
}