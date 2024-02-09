import axios from 'axios';

export class Generator {
    constructor() {
        this.generators = {
            'abbreviations': {
                'title': 'Abbreviations',
                'description': 'Generate abbreviations of the name.',
                'url': '/api/names/generate/abbreviations'
            },
            'usernames': {
                'title': 'Usernames',
                'description': 'Generate usernames of the name.',
                'url': '/api/names/generate/usernames'
            },
            'fancy-texts': {
                'title': 'Fancy Texts',
                'description': 'Generate fancy texts of the name.',
                'url': '/api/names/generate/fancy-texts'
            },
        };
    }

    generate() {
        for (const key in this.generators) {
            const button = document.getElementById(`generate-${key}`);
            if (button) {
                button.addEventListener('click', (e) => {
                    e.preventDefault();
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    const name = document.getElementById("actual-name").textContent;
                    axios.post(this.generators[key].url, {
                        _token: csrfToken,
                        name: name,
                    })
                    .then((response) => {
                        document.getElementById(key).innerHTML = response.data;
                    })
                    .catch((error) => {
                        console.log(error);
                    });
                });
            }
        }
    }
}

const Generate = new Generator();
Generate.generate();