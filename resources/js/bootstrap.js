import axios from 'axios';
import Alpine from 'alpinejs'
import 'flowbite';

import { ThemeManager } from './lib/ThemeManager.js';

window.axios = axios;
window.Alpine = Alpine;

window.ThemeManager = new ThemeManager();

Alpine.start();