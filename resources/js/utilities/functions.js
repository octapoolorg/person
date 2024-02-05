export function copyTextToClipboard(text) {
    if (navigator.clipboard) {
        return navigator.clipboard.writeText(text);
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
            return Promise.resolve(successful);
        } catch (err) {
            return Promise.reject(err);
        }
    }
}

export function imageReplacement() {
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