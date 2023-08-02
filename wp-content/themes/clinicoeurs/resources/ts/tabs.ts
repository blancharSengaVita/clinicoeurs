export const tabs = {
    //first tab link and content
    firstTabLink : HTMLButtonElement,
    firstTabContent: HTMLElement,

    //list of tablinks
    tabsList: [] as HTMLButtonElement[],

    //
    buttonTarget: HTMLButtonElement,
    lastLink: HTMLButtonElement,


    tabContent: HTMLElement,
    lastTabContent: HTMLElement,
    tabContentTarget: HTMLElement,




    constInit() {
        this.firstTabLink = document.querySelector('.tabs__links');
        this.firstTabContent = document.querySelector('.tabs__content');

        this.tabsList = document.querySelectorAll('.tabs__links');
        this.tabContent = document.querySelectorAll('.tabs__content');
    },
    addClassActive() {
        this.firstTabLink.classList.add("active");
        this.firstTabContent.classList.add("active");
    },
    setupTabs() {
        this.tabsList.forEach((tabLink:HTMLButtonElement) => {
            tabLink.addEventListener('click', (e:MouseEvent) => {
                // e.preventDefault();

                // debugger
                this.buttonTarget = e.currentTarget;
                this.tabContentTarget = document.querySelector(`#${this.buttonTarget.dataset.id}`);
                this.lastLink = document.querySelector('.active');
                this.lastTabContent = document.getElementById(`${this.lastLink.dataset.id}`);

                console.log(e.currentTarget)
                this.lastLink.classList.remove('active');
                this.lastTabContent.classList.remove('active');

                this.buttonTarget.classList.add('active');
                this.tabContentTarget.classList.add('active');
                e.stopPropagation();
            })
        });
    },
    init() {
        this.constInit();
        this.addClassActive();
        this.setupTabs();
    }
}

// export const tabss = {
//     init() {
//         this.cacheDom();
//         this.enableJavaScript();
//         this.setupTabs();
//     },
//     cacheDom() {
//         this.tabLinks = document.querySelectorAll('.tablinks');
//         this.tabContent = document.querySelectorAll('.tabcontent');
//         this.HtmlElement = window.document.documentElement;
//     },
//     enableJavaScript() {
//         this.HtmlElement.classList.add('js-enabled');
//     },
//     setupTabs() {
//         this.tabLinks.forEach(link => {
//             link.addEventListener('click', el => {
//                 this.openTabs(el);
//             });
//         });
//     },
//     openTabs(el) {
//         const btnTarget = el.currentTarget;
//         const {country} = btnTarget.dataset;
//         this.tabLinks.forEach(link => {
//             link.classList.remove('active');
//         });
//         this.tabContent.forEach(tab => {
//             tab.classList.remove('active');
//         });
//         document.querySelector(`#${country}`).classList.add('active');
//         btnTarget.classList.add('active');
//     }
// }