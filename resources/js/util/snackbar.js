import $ from 'jquery';
// snackbar.js
export function showSnackbar(message) {
    const snackbar = $('<div>').text(message).addClass('fixed left-1/2 transform -translate-x-1/2 bottom-10 bg-black text-white px-4 py-2 rounded shadow-lg z-50 opacity-0');
    $('body').append(snackbar);

    // Show Snackbar
    setTimeout(() => snackbar.css('opacity', 1), 100);

    // Hide and Remove Snackbar after 3 seconds
    setTimeout(() => {
        snackbar.css('opacity', 0);
        setTimeout(() => snackbar.remove(), 300);
    }, 3000);
}