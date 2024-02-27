class SpeechManager {
    constructor(buttons) {
        if (!('speechSynthesis' in window)) {
            throw new Error("Speech synthesis not supported");
        }
        this.msg = new SpeechSynthesisUtterance();
        buttons.forEach(button => {
            button.classList.remove('hidden');
        });
    }

    speak(text, lang = 'en-GB') {
        this.msg.text = text || '';
        this.msg.lang = lang;
        window.speechSynthesis.speak(this.msg);
    }
}
const buttons = document.querySelectorAll('.speak');
if (buttons.length) {
    window.SpeechManager = new SpeechManager(buttons);
}