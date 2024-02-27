import LazyLoad from "vanilla-lazyload";

export class Utility {

    static start() {
        this.lazyLoad();
    }

    static copyTextToClipboard(text, e) {
        e.preventDefault();
        if (navigator.clipboard) {
            return navigator.clipboard.writeText(text).then(() => {
                this.toast('Copied to clipboard');
            });
        } else {
            const textArea = document.createElement("textarea");
            textArea.style.position = 'fixed';
            textArea.style.opacity = '0';
            textArea.value = text;
            document.body.appendChild(textArea);
            textArea.focus();
            textArea.select();

            try {
                const successful = document.execCommand('copy');
                document.body.removeChild(textArea);
                if (successful) {
                    this.toast('Copied to clipboard');
                }
                return Promise.resolve(successful);
            } catch (err) {
                return Promise.reject(err);
            }
        }
    }

    static toast(message) {
        //device width - mobile will show alert, desktop will show toast
        if (window.innerWidth < 768) {
            alert(message);
            return;
        }
        // Create the toast container if it doesn't exist
        let toastContainer = document.getElementById('toast-container');
        if (!toastContainer) {
            toastContainer = document.createElement('div');
            toastContainer.id = 'toast-container';
            toastContainer.className = 'fixed bottom-10 left-10 p-4 mb-4 text-base-500 bg-surface rounded-lg shadow dark:text-base-400 dark:bg-base-800';
            document.body.appendChild(toastContainer);
        }

        // Create the toast element
        const toast = document.createElement('div');
        toast.className = 'flex items-center';
        toast.innerHTML = `
            <div class="flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200 my-2">
                <i class="fas fa-check"></i>
            </div>
            <div class="ms-3 text-sm font-normal">${message}</div>
            <button type="button" class="bg-surface dark:bg-transparent text-base-400 hover:text-base-900 dark:hover:text-base-300 h-8 w-8" aria-label="Close">
                <span class="sr-only">Close</span>
                <i class="fas fa-times"></i>
            </button>
        `;

        // Add the toast to the container
        toastContainer.appendChild(toast);

        // Remove the toast after 5 seconds
        setTimeout(() => {
            toastContainer.removeChild(toast);
            if (toastContainer.childElementCount === 0) {
                // If there are no more toasts, remove the container
                document.body.removeChild(toastContainer);
            }
        }, 5000);

        // Close button functionality
        const closeButton = toast.querySelector('button[aria-label="Close"]');
        closeButton.addEventListener('click', () => {
            toastContainer.removeChild(toast);
            if (toastContainer.childElementCount === 0) {
                document.body.removeChild(toastContainer);
            }
        });
    }

    static lazyLoad() {
        const lazyLoadInstance = new LazyLoad({
            elements_selector: ".lazy"
        });
    }

    static imageReplacement() {
        const mainImage = document.getElementById('name-wallpaper');
        const allImages = document.querySelectorAll('.switch-wallpaper');

        if (mainImage) {
            allImages.forEach(image => {
                image.addEventListener('click', function() {
                    mainImage.src = this.dataset.src;
                    allImages.forEach(img => img.classList.add('opacity-60'));
                    this.classList.remove('opacity-60');
                });
            });
        }
    }
}