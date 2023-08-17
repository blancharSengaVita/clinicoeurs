import {enableJavaScript} from "./enableJs";

enableJavaScript();

import {displayTheMenuOnDesktop} from "./displayTheMenuOnDesktop";

displayTheMenuOnDesktop.init();

import {stikyHeader} from "./stikyHeader"

stikyHeader.init();

import {tabs} from "./tabs"
if (window.location.pathname === '/fr/' || window.location.pathname === '/en/' || window.location.pathname === '/nl/') {
    tabs.init();
}






