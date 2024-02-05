import { isLanguageSupported } from '../utilities/functions.js';

export class SpeechManager {
    constructor() {
        this.speaking = false;
        this.paused = false;
        this.msg = null;
        this.currentCharIndex = 0;
        this.originalText = '';
        this.words = [];
        this.pausedAtCharIndex = 0;
        this.UNSUPPORTED_SPEECH_SYNTHESIS = "Speech synthesis not supported";
        this.UNSUPPORTED_LANGUAGE = "Language not supported";
        this.ERROR_SPEECH_SYNTHESIS = "Error during speech synthesis";
    }

    async speak() {
        const speakButton = document.querySelector('#speak');
        const speakIcon = document.querySelector('#speak > i');
        const targetTextElement = document.getElementById('targetText');
        let targetLang = document.getElementById('target-language').value;

        if (!('speechSynthesis' in window)) {
            this.handleError(this.UNSUPPORTED_SPEECH_SYNTHESIS);
            return;
        }

        if (this.speaking) {
            if (this.paused) {
                this.resumeSpeech(targetTextElement, speakIcon, targetLang);
            } else {
                this.pauseSpeech(speakIcon);
            }
            return;
        }

        this.originalText = targetTextElement.innerText.trim();
        this.words = this.originalText.split(/(\s+)/);
        var isLangSupported = await isLanguageSupported(targetLang);

        if (!isLangSupported) {
            console.warn(this.UNSUPPORTED_LANGUAGE);
            targetLang = 'en-US';
        }

        this.startSpeech(targetTextElement, speakIcon, targetLang);
    }

    startSpeech(targetTextElement, speakIcon, targetLang) {
        try {
            this.msg = new SpeechSynthesisUtterance();
            this.setupSpeechSynthesisUtterance(targetTextElement, targetLang);

            this.msg.onboundary = (event) => {
                if (event.name === 'word') {
                    this.currentCharIndex = event.charIndex;
                    this.highlightWord(targetTextElement);
                }
            };

            this.msg.onend = () => {
                targetTextElement.innerHTML = this.originalText;
                this.updateIcon(speakIcon, 'fa-volume-up');
                this.resetState();
            };

            window.speechSynthesis.speak(this.msg);
            this.updateIcon(speakIcon, 'fa-pause');
            this.speaking = true;
            this.paused = false;
        } catch (error) {
            this.handleError(this.ERROR_SPEECH_SYNTHESIS, error);
        }
    }

    pauseSpeech(speakIcon) {
        window.speechSynthesis.pause();
        this.paused = true;
        this.updateIcon(speakIcon, 'fa-play');
    }

    resumeSpeech(targetTextElement, speakIcon, targetLang) {
        window.speechSynthesis.resume();
        this.paused = false;
        this.updateIcon(speakIcon, 'fa-pause');
    }

    setupSpeechSynthesisUtterance(targetTextElement, targetLang) {
        this.msg.text = targetTextElement.innerText;
        this.msg.lang = targetLang;
        this.msg.volume = 1;
        this.msg.rate = 0.8;

        let voices = window.speechSynthesis.getVoices();
        this.msg.voice = voices.find(voice => voice.lang === targetLang);
    }

    highlightWord(targetTextElement) {
        let currentIndex = 0;
        targetTextElement.innerHTML = this.words.map(word => {
            let wordLength = word.trim().length;
            if (!wordLength) return word; // Skip spaces

            let isCurrentWord = currentIndex <= this.currentCharIndex &&
                                currentIndex + wordLength > this.currentCharIndex;
            currentIndex += wordLength + 1; // +1 for the space

            return isCurrentWord ? `<span class='bg-primary-200'>${word}</span>` : word;
        }).join('');
    }

    resetState() {
        this.speaking = false;
        this.paused = false;
        this.currentCharIndex = 0;
        this.pausedAtCharIndex = 0;
    }

    handleError(errorCode, error = null) {
        console.error('SpeechManager Error:', errorCode, error);
    }

    updateIcon(iconElement, newIconClass) {
        const iconClasses = ['fa-play', 'fa-pause', 'fa-volume-up'];
        iconElement.classList.remove(...iconClasses);
        iconElement.classList.add(newIconClass);
    }
}
