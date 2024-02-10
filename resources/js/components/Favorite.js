class FavoritesManager {
    constructor() {
        this.favorites = this.getFavoritesFromLocalStorage();
    }

    getFavoritesFromLocalStorage() {
        try {
            const cookieExists = document.cookie.split(';').some((item) => item.trim().startsWith('favorites='));
            if (!cookieExists) {
                localStorage.removeItem('favorites-list');
            }
            return JSON.parse(localStorage.getItem('favorites-list')) ?? [];
        } catch (error) {
            console.error('Failed to parse favorites from localStorage', error);
            return [];
        }
    }

    toggleFavorite(url, name, meaning) {
        const favorite = this.favorites.find(fav => fav.url === url);
        if (favorite) {
            this.favorites = this.favorites.filter(fav => fav.url !== url);
        } else {
            this.favorites.push({ url, name, meaning });
        }
        this.updateLocalStorageAndCookie();
        const isFavorite = this.isFavorite(url);
        window.dispatchEvent(new CustomEvent('favoriteToggled', { detail: { url, isFavorite } }));
        return isFavorite;
    }

    updateLocalStorageAndCookie() {
        try {
            if (this.favorites.length === 0) {
                localStorage.removeItem('favorites-list');
                document.cookie = "favorites=false; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                document.cookie = "favorites-list=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
            } else {
                localStorage.setItem('favorites-list', JSON.stringify(this.favorites));
                document.cookie = `favorites=true; path=/`;
                document.cookie = `favorites-list=${encodeURIComponent(JSON.stringify(this.favorites))}; path=/`;
            }
        } catch (error) {
            console.error('Failed to update localStorage or cookie', error);
        }
    }

    isFavorite(url) {
        return this.favorites.some(fav => fav.url === url);
    }
}

class FavoriteButton {
    constructor(buttonId, iconSelector, favoritesManager) {
        this.favoriteButton = document.querySelector(`#${buttonId}`);
        this.favoriteIcon = document.querySelector(`#${iconSelector}`);
        if (this.favoriteButton && this.favoriteIcon) {
            this.favoritesManager = favoritesManager;
            window.addEventListener('favoriteToggled', (event) => {
                if (event.detail.url === `${window.location.origin}${window.location.pathname}`) {
                    this.updateFavoriteButton(event.detail.isFavorite);
                }
            });
            this.init();
        }
    }

    init() {
        this.favoriteButton.addEventListener('click', () => {
            const currentPageUrl = `${window.location.origin}${window.location.pathname}`;
            const name = document.getElementById('actual-name').textContent.trim();
            const meaning = document.getElementById('actual-meaning').textContent.trim();
            const isFavorite = this.favoritesManager.toggleFavorite(currentPageUrl, name, meaning);
            this.updateFavoriteButton(isFavorite);
        });

        // Check if the current page is favorited when the button is initialized
        const currentPageUrl = `${window.location.origin}${window.location.pathname}`;
        const isFavorite = this.favoritesManager.isFavorite(currentPageUrl);
        this.updateFavoriteButton(isFavorite);
    }

    updateFavoriteButton(isFavorite) {
        if (isFavorite) {
            this.favoriteIcon.classList.remove('far');
            this.favoriteIcon.classList.add('fas');
        } else {
            this.favoriteIcon.classList.remove('fas');
            this.favoriteIcon.classList.add('far');
        }
    }
}


class NavbarIcon {
    constructor(iconId, favoritesManager) {
        this.navbarIcon = document.querySelector(`#${iconId}`);
        if (this.navbarIcon) {
            this.favoritesManager = favoritesManager;
            window.addEventListener('favoriteToggled', () => this.updateNavbarIcon());
            this.init();
        }
    }

    init() {
        this.updateNavbarIcon();
    }

    updateNavbarIcon() {
        if (this.favoritesManager.favorites.length > 0) {
            this.navbarIcon.classList.remove('hidden');
        } else {
            this.navbarIcon.classList.add('hidden');
        }
    }
}

class FavoriteList {
    constructor(favoritesManager, navbarIcon) {
        this.favoritesManager = favoritesManager;
        this.navbarIcon = navbarIcon;
        if (document.querySelector('#favorite-list')) {
            window.addEventListener('favoriteToggled', () => this.updateFavoriteList());
            this.init();
        }
    }

    init() {
        this.updateFavoriteList();
    }

    getListItemByUrl(url) {
        return document.querySelector(`#favorite-list li[data-url="${url}"]`);
    }

    updateFavoriteList() {
        const favoriteList = document.querySelector('#favorite-list');
        if (!favoriteList) {
            return; // No favorite-list element on this page, so return early
        }

        // Clear the existing list
        favoriteList.innerHTML = '';

        this.favoritesManager.favorites.forEach((favorite) => {
            let listItem = this.getListItemByUrl(favorite.url);
            if (!listItem) {
                listItem = document.createElement('li');
                listItem.textContent = `${favorite.name} - ${favorite.meaning}`;
                listItem.setAttribute('data-url', favorite.url);
                listItem.classList.add('list-item', 'flex', 'justify-between', 'items-center', 'p-2', 'border', 'border-gray-200', 'rounded'); // Add your Tailwind CSS classes here

                const heartButton = document.createElement('i');
                heartButton.classList.add('fa-heart', 'cursor-pointer');
                heartButton.setAttribute('data-url', favorite.url);
                heartButton.addEventListener('click', () => {
                    const isFavorite = this.favoritesManager.toggleFavorite(favorite.url, favorite.name, favorite.meaning);
                    this.navbarIcon.updateNavbarIcon();
                    this.updateFavoriteList();
                });

                listItem.appendChild(heartButton);
                favoriteList.appendChild(listItem);
            }
        });
    }
}

// Usage
const favoritesManager = new FavoritesManager();
const favoriteButton = new FavoriteButton('favorite-button', 'favorite-icon', favoritesManager);
const navbarIcon = new NavbarIcon('navbar-favorite-icon', favoritesManager);
const favoriteList = new FavoriteList(favoritesManager, navbarIcon);