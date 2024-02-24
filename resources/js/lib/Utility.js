import LazyLoad from "vanilla-lazyload";
export class Utility {

    static start() {
        this.lazyLoad();
    }

    static copyTextToClipboard(e) {
        e.preventDefault();
        const text = e.target.innerText;
        if (navigator.clipboard) {
            return navigator.clipboard.writeText(text).then(() => {
                alert('Text copied to clipboard');
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
                    alert('Text copied to clipboard');
                }
                return Promise.resolve(successful);
            } catch (err) {
                return Promise.reject(err);
            }
        }
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