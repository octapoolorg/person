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
    constructor(favoritesManager) {
        this.favoritesManager = favoritesManager;
        this.favoriteListElement = document.getElementById('favorite-list');
        if (this.favoriteListElement) {
            window.addEventListener('favoriteToggled', this.updateFavoriteList.bind(this));
            this.initialPopulate();
        }
    }

    initialPopulate() {
        // Clear the list before initial population
        this.favoriteListElement.innerHTML = '';

        // Initial population of the list with current favorites
        this.favoritesManager.favorites.forEach(favorite => {
            const listItem = this.createListItem(favorite);
            this.favoriteListElement.appendChild(listItem);
        });
    }

    updateFavoriteList() {
        // Update UI without removing non-favorite items, just update their state
        const urlsInUI = Array.from(this.favoriteListElement.querySelectorAll('.favorite-item')).map(li => li.getAttribute('data-url'));

        // Add new favorites not yet in UI
        this.favoritesManager.favorites.forEach(favorite => {
            if (!urlsInUI.includes(favorite.url)) {
                const listItem = this.createListItem(favorite);
                this.favoriteListElement.appendChild(listItem);
            }
        });

        // Update all items' favorite state
        urlsInUI.forEach(url => {
            const listItem = this.getListItemByUrl(url);
            const isFavorite = this.favoritesManager.isFavorite(url);
            this.updateHeartIcon(listItem, isFavorite);
        });
    }

    getListItemByUrl(url) {
        return this.favoriteListElement.querySelector(`li[data-url="${url}"]`);
    }

    updateHeartIcon(listItem, isFavorite) {
        const heartIcon = listItem.querySelector('.fa-heart');
        if (heartIcon) {
            heartIcon.className = `fa-heart cursor-pointer text-red-500 text-2xl ${isFavorite ? 'fas' : 'far'}`;
        }
    }

    createListItem({ url, name, meaning }) {
        const listItem = document.createElement('li');
        listItem.setAttribute('data-url', url);
        listItem.className = 'favorite-item p-4 shadow rounded-lg flex justify-between items-center transition duration-300 ease-in-out dark:border dark:border-base-700 hover:bg-base-50 dark:bg-base-800 dark:hover:shadow-base-800';

        listItem.innerHTML = `
            <a href="${url}" class="flex-grow">
                <h2 class="text-xl font-semibold text-primary-800 dark:text-primary-100 capitalize">${name}</h2>
                <p class="text-md text-base-500 dark:text-base-300">${meaning}</p>
            </a>
            <i class="fa-heart cursor-pointer ml-4 text-red-500 text-2xl ${this.favoritesManager.isFavorite(url) ? 'fas' : 'far'}"></i>
        `;

        // Event listener for the heart icon to toggle favorite status
        listItem.querySelector('.fa-heart').addEventListener('click', (event) => {
            event.preventDefault();
            this.favoritesManager.toggleFavorite(url, name, meaning);
        });

        return listItem;
    }
}

// Usage
const favoritesManager = new FavoritesManager();
const favoriteButton = new FavoriteButton('favorite-button', 'favorite-icon', favoritesManager);
const navbarIcon = new NavbarIcon('navbar-favorite-icon', favoritesManager);
const favoriteList = new FavoriteList(favoritesManager, navbarIcon);