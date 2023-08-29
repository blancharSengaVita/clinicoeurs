import {enableJavaScript} from "./enableJs";
enableJavaScript();

import {stikyHeader} from "./stikyHeader"
stikyHeader.init();

import {tabs} from "./tabs"
if (window.location.pathname === '/fr/' || window.location.pathname === '/en/' || window.location.pathname === '/nl/') {
    tabs.init();
}






