import LazyLoad from "vanilla-lazyload";

export class Utility {

    static start() {
        this.lazyLoad();
    }

    static copyTextToClipboard(text, e) {
        e.preventDefault();
        if (navigator.clipboard) {
            return navigator.clipboard.writeText(text).then(() => {
                // this.highlightText(e);
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
                    // this.highlightText(e);
                }
                return Promise.resolve(successful);
            } catch (err) {
                return Promise.reject(err);
            }
        }
    }

    static highlightText(e) {
        alert('Success! The content has been copied to your clipboard. Feel free to share it with others.');
        // highlight the text, can be input, textarea or div, span
        if (typeof e.target.select === "function") {
            // For input and textarea elements
            e.target.select();
        } else if (window.getSelection) {
            // For div, span, and other non-input elements
            const range = document.createRange();
            range.selectNodeContents(e.target);
            window.getSelection().removeAllRanges(); // clear current selection
            window.getSelection().addRange(range);
        } else {
            // For old IE versions
            const textRange = document.body.createTextRange();
            textRange.moveToElementText(e.target);
            textRange.select();
        }

        // Unselect after 3 seconds
        setTimeout(() => {
            if (window.getSelection) {
                window.getSelection().removeAllRanges();
            } else {
                document.selection.empty(); // For old IE versions
            }
        }, 5000);
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