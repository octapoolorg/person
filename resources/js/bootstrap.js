import axios from 'axios';
import Alpine from 'alpinejs'
import { ThemeManager } from './lib/ThemeManager.js';
import { SpeechManager } from './lib/SpeechManager.js';
import { Utility } from './lib/Utility.js';
import 'flowbite';
import './components/Generator.js';
import './components/Favorite.js';


window.axios = axios;
window.Alpine = Alpine;
window.Utility = Utility;

window.ThemeManager = new ThemeManager();
window.SpeechManager = new SpeechManager();

Utility.start();
Alpine.start();