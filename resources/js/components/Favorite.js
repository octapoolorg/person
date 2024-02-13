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

        this.init();
    }

    init (){
        const favorites = localStorage.getItem('favorites') ? JSON.parse(localStorage.getItem('favorites')) : [];
        const hasFavorites = favorites.length > 0;

        this.toggleNavbarIcon(hasFavorites);

        if (this.button) {
            const slug = this.button.dataset.slug;
            const isFavorited = favorites.includes(slug);

            this.toggleIcon(isFavorited);
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

            this.update(favorites);
        } catch (error) {
            // If the request fails, revert the UI update
            this.toggleIcon(!isFavorited);
            console.error(error);
            alert('An error occurred while favoriting. Please try again.');
        }
    }

    toggleIcon(isFavorited) {
        if (isFavorited) {
            this.icon.classList.remove('far');
            this.icon.classList.add('fas');
        } else {
            this.icon.classList.remove('fas');
            this.icon.classList.add('far');
        }
    }

    toggleNavbarIcon(hasFavorites) {
        if (hasFavorites) {
            this.navbarIcon.classList.remove('hidden');
        }else {
            this.navbarIcon.classList.add('hidden');
        }
    }

    update(favorites) {
        const hasFavorites = favorites.length > 0;

        this.toggleNavbarIcon(hasFavorites);
        if (hasFavorites) {
            document.cookie = `favorites=true; path=/`;
            localStorage.setItem('favorites', JSON.stringify(favorites));
        } else {
            document.cookie = `favorites=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;`;
            localStorage.removeItem('favorites');
        }
    }
}

new FavoriteButton({
    buttonSelector: '#favorite-button',
    iconSelector: '#favorite-icon',
    navbarIconSelector: '#navbar-favorite-icon',
    endpoint: '/api/favorite'
});