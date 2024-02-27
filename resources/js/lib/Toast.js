class Toast{
    static toast(message) {
        // Show alert on mobile, toast on desktop
        if (window.innerWidth < 768) {
            return alert(message);
        }

        // Get or create the toast container
        let toastContainer = document.getElementById('toast-container') || this.createToastContainer();

        // Remove any existing toast
        const existingToast = document.getElementById('toast');
        if (existingToast) {
            clearTimeout(existingToast.timeout);
            toastContainer.removeChild(existingToast);
        }

        // Create and add the new toast
        const toast = this.createToast(message);
        toastContainer.appendChild(toast);

        // Remove the toast after 5 seconds
        toast.timeout = setTimeout(() => this.removeToast(toast, toastContainer), 5000);

        // Add close button functionality
        toast.querySelector('button[aria-label="Close"]').addEventListener('click', () => this.removeToast(toast, toastContainer));
    }

    static createToastContainer() {
        const toastContainer = document.createElement('div');
        toastContainer.id = 'toast-container';
        toastContainer.className = 'fixed bottom-10 left-10 p-4 mb-4 text-base-500 bg-surface rounded-lg shadow dark:text-base-400 dark:bg-base-800';
        document.body.appendChild(toastContainer);
        return toastContainer;
    }

    static createToast(message) {
        const toast = document.createElement('div');
        toast.id = 'toast';
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
        return toast;
    }

    static removeToast(toast, toastContainer) {
        clearTimeout(toast.timeout);
        toastContainer.removeChild(toast);
        if (toastContainer.childElementCount === 0) {
            document.body.removeChild(toastContainer);
        }
    }
}