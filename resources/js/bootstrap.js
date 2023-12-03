import('preline')

document.addEventListener('DOMContentLoaded', () => {
    // Snackbar Function
    function showSnackbar(message) {
        const snackbar = document.createElement('div');
        snackbar.textContent = message;
        snackbar.className = 'fixed left-1/2 transform -translate-x-1/2 bottom-10 bg-black text-white px-4 py-2 rounded shadow-lg z-50 opacity-0';
        document.body.appendChild(snackbar);

        // Show Snackbar
        setTimeout(() => snackbar.style.opacity = 1, 100);

        // Hide and Remove Snackbar after 3 seconds
        setTimeout(() => {
            snackbar.style.opacity = 0;
            setTimeout(() => document.body.removeChild(snackbar), 300);
        }, 3000);
    }

    // Functionality for Copy to Clipboard
    document.querySelectorAll('.copy-to-clipboard').forEach(element => {
        element.addEventListener('click', () => {
            const textToCopy = element.innerText;
            navigator.clipboard.writeText(textToCopy)
                .then(() => {
                    showSnackbar("Text copied to clipboard");
                })
                .catch(err => {
                    console.error('Could not copy text: ', err);
                });
        });
    });

    // Functionality for Image Replacement
    const mainImage = document.getElementById('name-wallpaper');
    const allImages = document.querySelectorAll('.switch-wallpaper');

    if (mainImage) {
        allImages.forEach(img => {
            img.addEventListener('click', () => {
                mainImage.src = img.dataset.src;
                allImages.forEach(otherImg => otherImg.classList.add('opacity-60'));
                img.classList.remove('opacity-60');
            });
        });
    }
});
