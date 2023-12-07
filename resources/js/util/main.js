import $ from 'jquery';
import { copyToClipboard } from './clipboard.js';
import { imageReplacement } from './imageReplacement.js';
import { generators } from './generators.js';
import {darkModeToggle} from "./darkMode.js";

$(function() {
    copyToClipboard();
    imageReplacement();
    darkModeToggle();

    for (const key in generators) {
        $(`#generate-${key}`).on('click',function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: generators[key].url,
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    name: $("#actual-name").text(),
                },
                success: function(response) {
                    $(`#${key}`).html(response);
                }
            });
        });
    }
});