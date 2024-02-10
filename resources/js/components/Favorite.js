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
        return document.querySelector(`#favorite-list a[data-url="${url}"]`);
    }

    updateFavoriteList() {
        const favoriteList = document.querySelector('#favorite-list');
        if (!favoriteList) {
            return; // No favorite-list element on this page, so return early
        }

        this.favoritesManager.favorites.forEach((favorite) => {
            let listItem = this.getListItemByUrl(favorite.url);
            if (!listItem) {
                listItem = this.createListItem(favorite);
                favoriteList.appendChild(listItem);
            }
            const heartButton = listItem.querySelector('.fa-heart');
            if (this.favoritesManager.isFavorite(favorite.url)) {
                heartButton.classList.remove('far');
                heartButton.classList.add('fas');
            } else {
                heartButton.classList.remove('fas');
                heartButton.classList.add('far');
            }
        });
    }

    createListItem(favorite) {
        const listItem = document.createElement('a');
        listItem.href = favorite.url;
        listItem.classList.add('p-4', 'shadow', 'dark:shadow-none', 'rounded-lg', 'flex', 'justify-start', 'items-center', 'dark:border', 'dark:border-base-700', 'hover:bg-base-50', 'dark:hover:bg-base-800', 'transition', 'duration-300', 'ease-in-out');

        const div = document.createElement('div');
        div.classList.add('flex-grow');
        listItem.appendChild(div);

        const h2 = document.createElement('h2');
        h2.textContent = favorite.name;
        h2.classList.add('text-xl', 'font-semibold', 'text-primary-800', 'dark:text-primary-100', 'capitalize');
        div.appendChild(h2);

        const p = document.createElement('p');
        p.textContent = favorite.meaning;
        p.classList.add('text-md', 'text-base-500', 'dark:text-base-300');
        div.appendChild(p);

        const span = document.createElement('span');
        span.textContent = 'Learn more';
        span.classList.add('text-primary-600', 'hover:text-primary-900', 'dark:text-primary-400', 'dark:hover:text-primary-200', 'transition', 'duration-300', 'ease-in-out');
        listItem.appendChild(span);

        const heartButton = document.createElement('i');
        heartButton.classList.add('fa-heart', 'cursor-pointer', 'fas');
        heartButton.setAttribute('data-url', favorite.url);
        heartButton.addEventListener('click', (event) => {
            event.preventDefault();
            const isFavorite = this.favoritesManager.toggleFavorite(favorite.url, favorite.name, favorite.meaning);
            this.navbarIcon.updateNavbarIcon();
            if (!isFavorite) {
                heartButton.classList.remove('fas');
                heartButton.classList.add('far');
            } else {
                heartButton.classList.remove('far');
                heartButton.classList.add('fas');
            }
        });
        listItem.appendChild(heartButton);

        return listItem;
    }
}

// Usage
const favoritesManager = new FavoritesManager();
const favoriteButton = new FavoriteButton('favorite-button', 'favorite-icon', favoritesManager);
const navbarIcon = new NavbarIcon('navbar-favorite-icon', favoritesManager);
const favoriteList = new FavoriteList(favoritesManager, navbarIcon);