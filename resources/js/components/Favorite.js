class FavoriteButton {
    constructor({ buttonSelector, iconSelector, navbarIconSelector, endpoint }) {
        this.button = document.querySelector(buttonSelector);
        this.icon = document.querySelector(iconSelector);
        this.navbarIcon = document.querySelector(navbarIconSelector);
        this.endpoint = endpoint;
        const csrfMeta = document.querySelector('meta[name="csrf-token"]');
        this.csrfToken = csrfMeta ? csrfMeta.getAttribute('content') : '';

        if (this.button) {
            this.button.addEventListener('click', () => this.favorite());
        }
    }

    async favorite() {
        const { endpoint, csrfToken, icon } = this;
        const slug = this.button.dataset.slug;

        // Optimistically update the UI
        const isFavorited = !icon.classList.contains('fas');
        this.toggleIcon(isFavorited);

        try {
            const response = await axios({
                method: 'post',
                url: endpoint,
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json'
                },
                data: { slug }
            });

            const { isFavorited: actualIsFavorited, favorites } = response.data;

            // Update the UI with the actual state
            if (isFavorited !== actualIsFavorited) {
                this.toggleIcon(actualIsFavorited);
            }

            this.updateCookie(favorites);
            this.toggleNavbarIcon();
        } catch (error) {
            // If the request fails, revert the UI update
            this.toggleIcon(!isFavorited);
            console.error(error);
        }
    }

    toggleIcon(isFavorited) {
        const { icon } = this;
        if (isFavorited) {
            icon.classList.remove('far');
            icon.classList.add('fas');
        } else {
            icon.classList.remove('fas');
            icon.classList.add('far');
        }
    }

    toggleNavbarIcon() {
        const { navbarIcon } = this;
        navbarIcon.classList.toggle('hidden');
    }

    updateCookie(value) {
        if (value) {
            document.cookie = "favorites=true; path=/";
        } else {
            document.cookie = "favorites=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/";
        }
    }
}

// Instantiate the class
new FavoriteButton({
    buttonSelector: '#favorite-button',
    iconSelector: '#favorite-icon',
    navbarIconSelector: '#navbar-favorite-icon',
    endpoint: '/api/favorite'
});