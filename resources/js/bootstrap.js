import axios from 'axios';
import Alpine from 'alpinejs'
import { Utility } from './lib/Utility.js';
import 'flowbite';
import './components/Generator.js';
import './components/Favorite.js';

import { ThemeManager } from './lib/ThemeManager.js';

window.axios = axios;
window.Alpine = Alpine;
window.Utility = Utility;

window.ThemeManager = new ThemeManager();

Utility.start();