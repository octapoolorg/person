const LATIN_LANGUAGES = ["af", "sq", "bm", "eu", "ca", "ceb", "hr", "cs", "da", "nl", "en", "eo", "et", "tl", "fi", "fr", "fy", "gl", "lg", "de", "ht", "ha", "haw", "hu", "is", "ig", "id", "ga", "it", "la", "lv", "lt", "lb", "ms", "mt", "no", "pl", "pt", "qu", "ro", "sl", "so", "es", "su", "sw", "sv", "tr", "vi", "cy", "yo", "zu"];

function isVoiceSupported(voices, lang) {
    return voices.some(voice => voice.lang.startsWith(lang));
}

function getFallbackLanguage(lang) {
    return 'en'; // Fallback to English, adjust as needed
}

function handleVoicesChanged(resolve, lang, eventListener) {
    const voices = window.speechSynthesis.getVoices();
    const isSupported = isVoiceSupported(voices, lang);

    if (isSupported) {
        resolve(lang);
    } else if (LATIN_LANGUAGES.includes(lang)) {
        resolve(getFallbackLanguage(lang));
    } else {
        resolve(null);
    }

    if (eventListener) {
        window.speechSynthesis.removeEventListener('voiceschanged', eventListener);
    }
}

export function isLanguageSupported(lang) {
    return new Promise((resolve, reject) => {
        let voices = window.speechSynthesis.getVoices();

        if (voices.length > 0) {
            handleVoicesChanged(resolve, lang, null);
        } else {
            const eventListener = () => handleVoicesChanged(resolve, lang, eventListener);
            window.speechSynthesis.addEventListener('voiceschanged', eventListener);

            setTimeout(() => {
                window.speechSynthesis.removeEventListener('voiceschanged', eventListener);
                reject(new Error('Timeout while waiting for voices to load'));
            }, 5000);
        }
    });
}