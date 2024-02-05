/** @type {import('tailwindcss').Config} */
const colors = require('tailwindcss/colors')
const { createThemes } = require('tw-colors');

export default {
    darkMode: 'class',
    content: [
        "./resources/**/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js"
    ],
    theme: {
        extend: {
            fontFamily: {
                'am' : ['Noto Sans Ethiopic', 'sans-serif'],
                'ar' : ['Noto Sans Arabic', 'sans-serif'],
                'hy' : ['Noto Sans Armenian', 'sans-serif'],
                'as' : ['Noto Sans Bengali', 'sans-serif'],
                'bn' : ['Noto Sans Bengali', 'sans-serif'],
                'zh' : ['Noto Sans SC', 'sans-serif'],
                'ka' : ['Noto Sans Georgian', 'sans-serif'],
                'gu' : ['Noto Sans Gujarati', 'sans-serif'],
                'he' : ['Noto Sans Hebrew', 'sans-serif'],
                'hi' : ['Noto Sans Devanagari', 'sans-serif'],
                'ja' : ['Noto Sans CJK JP', 'sans-serif'],
                'kn' : ['Noto Sans Kannada', 'sans-serif'],
                'km' : ['Noto Sans Khmer', 'sans-serif'],
                'ko' : ['Noto Sans KR', 'sans-serif'],
                'ckb': ['Noto Naskh Arabic', 'sans-serif'],
                'ml' : ['Noto Sans Malayalam', 'sans-serif'],
                'mt' : ['Noto Sans Indic Siyaq Numbers', 'sans-serif'],
                'mn' : ['Noto Sans Mongolian', 'sans-serif'],
                'my' : ['Noto Sans Myanmar', 'sans-serif'],
                'or' : ['Noto Sans Oriya', 'sans-serif'],
                'fa' : ['Noto Naskh Arabic', 'sans-serif'],
                'pa' : ['Noto Sans Gurmukhi', 'sans-serif'],
                'sd' : ['Noto Naskh Arabic', 'sans-serif'],
                'si' : ['Noto Sans Sinhala', 'sans-serif'],
                'ta' : ['Noto Sans Tamil Supplement', 'sans-serif'],
                'te' : ['Noto Sans Telugu', 'sans-serif'],
                'th' : ['Noto Sans Thai', 'sans-serif'],
                'ti' : ['Noto Sans Ethiopic', 'sans-serif'],
                'ur' : ['Noto Sans Arabic', 'sans-serif'],
                'yi' : ['Noto Sans Hebrew', 'sans-serif']
            }
        },
    },
    plugins: [
        require('@tailwindcss/typography'),
        require('flowbite/plugin'),
        createThemes({
            'default' : {
               'primary': colors.indigo,
               'base': colors.neutral,
               'surface': colors.white,
            },
            'funky' : {
               'primary': colors.fuchsia,
               'base': colors.neutral,
               'surface': colors.white,
            },
            'girly' : {
                'primary': colors.pink,
                'base': colors.neutral,
                'surface': colors.white,
            },
            'boyish' : {
                'primary': colors.blue,
                'base': colors.neutral,
                'surface': colors.white,
            },
            'nature' : {
                'primary': colors.green,
                'base': colors.neutral,
                'surface': colors.white,
            },
        },{
            defaultTheme: 'default',
        })
    ],
};
