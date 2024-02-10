class SpeechManager {
    constructor() {
        if (!('speechSynthesis' in window)) {
            throw new Error("Speech synthesis not supported");
        }
        this.msg = new SpeechSynthesisUtterance();
    }

    speak(text, lang = 'en-US') {
        this.msg.text = text || '';
        this.msg.lang = lang;
        window.speechSynthesis.speak(this.msg);
    }
}

export { SpeechManager };