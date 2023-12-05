import $ from 'jquery';
import { showSnackbar } from './snackbar.js';

export function copyToClipboard() {
    $('body').on('click', '.copy-to-clipboard', function(event) {
        event.preventDefault();
        const textToCopy = $(this).text();

        // Modern way to copy to clipboard
        if (navigator.clipboard) {
            navigator.clipboard.writeText(textToCopy)
                .then(() => {
                    showSnackbar("Text copied to clipboard");
                })
                .catch(err => {
                    console.error('Could not copy text: ', err);
                });
        } else {
            // Fallback for older browsers
            var textArea = $('<textarea>').val(textToCopy).css({position: 'fixed', top: 0});
            $('body').append(textArea);
            textArea.focus();
            textArea.select();

            try {
                var successful = document.execCommand('copy');
                var msg = successful ? 'successful' : 'unsuccessful';
                if (msg === 'successful') {
                    showSnackbar("Text copied to clipboard");
                }
            } catch (err) {
                console.error('Fallback: Oops, unable to copy', err);
            }

            textArea.remove();
        }
    });
}