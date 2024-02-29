import axios from 'axios';
import Alpine from 'alpinejs'
import persist from '@alpinejs/persist'
import { ThemeManager } from './lib/ThemeManager.js';
import { Utility } from './lib/Utility.js';
import 'flowbite';
import './lib/SpeechManager.js';
import './components/Generator.js';
import './components/Favorite.js';

window.axios = axios;
window.Alpine = Alpine;
window.Utility = Utility;

window.ThemeManager = new ThemeManager();

Utility.start();

Alpine.plugin(persist)
Alpine.start();