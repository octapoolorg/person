// Your existing code in bootstrap.js

window.copyToClipboard = function(event) {
    const textToCopy = event.target.innerText;
    navigator.clipboard.writeText(textToCopy).then(() => {
        alert("Text copied to clipboard");
    }).catch(err => {
        console.error('Could not copy text: ', err);
    });
};
