import $ from 'jquery';

export function imageReplacement() {
    const mainImage = $('#name-wallpaper');
    const allImages = $('.switch-wallpaper');

    if (mainImage.length) {
        allImages.on('click', function() {
            mainImage.attr('src', $(this).data('src'));
            allImages.addClass('opacity-60');
            $(this).removeClass('opacity-60');
        });
    }
}