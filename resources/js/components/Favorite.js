class FavoriteButton {
    constructor({ buttonSelector, iconSelector, navbarIconSelector, endpoint }) {
        this.buttons = document.querySelectorAll(buttonSelector);
        this.icon = document.querySelector(iconSelector);
        this.navbarIcon = document.querySelector(navbarIconSelector);
        this.endpoint = endpoint;
        const csrfMeta = document.querySelector('meta[name="csrf-token"]');
        this.csrfToken = csrfMeta ? csrfMeta.getAttribute('content') : '';

        this.buttons.forEach(button => {
            button.addEventListener('click', () => this.favorite(button));
        });

        this.init();
    }

    init (){
        const favorites = localStorage.getItem('favorites') ? JSON.parse(localStorage.getItem('favorites')) : [];
        const hasFavorites = favorites.length > 0;

        this.toggleNavbarIcon(hasFavorites);

        this.buttons.forEach(button => {
            const slug = button.dataset.slug;
            const isFavorited = favorites.includes(slug);

            this.toggleIcon(button, isFavorited);
        });
    }

    async favorite(button) {
        const { endpoint, csrfToken } = this;
        const slug = button.dataset.slug;

        // Optimistically update the UI
        const isFavorited = !button.querySelector('i').classList.contains('fas');
        this.toggleIcon(button, isFavorited);

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
                this.toggleIcon(button, actualIsFavorited);
            }

            this.update(favorites);
        } catch (error) {
            // If the request fails, revert the UI update
            this.toggleIcon(button, !isFavorited);
            console.error(error);
            alert('An error occurred while favoriting. Please try again.');
        }
    }

    toggleIcon(button, isFavorited) {
        const icon = button.querySelector('i');
        if (isFavorited) {
            icon.classList.remove('far');
            icon.classList.add('fas');
        } else {
            icon.classList.remove('fas');
            icon.classList.add('far');
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
    buttonSelector: '.favorite-button',
    iconSelector: '#favorite-icon',
    navbarIconSelector: '#navbar-favorite-icon',
    endpoint: '/api/favorite'
});