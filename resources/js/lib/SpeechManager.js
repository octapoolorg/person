class SpeechManager {
    constructor(button) {
        if (!('speechSynthesis' in window)) {
            throw new Error("Speech synthesis not supported");
        }
        this.msg = new SpeechSynthesisUtterance();
        button.classList.remove('hidden');
    }

    speak(text, lang = 'en-GB') {
        this.msg.text = text || '';
        this.msg.lang = lang;
        window.speechSynthesis.speak(this.msg);
    }
}
const button = document.querySelector('#speak');
if (button){
    window.SpeechManager = new SpeechManager(button);
}