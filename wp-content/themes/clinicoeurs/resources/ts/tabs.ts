export const tabs = {
    //first tab link and content
    firstTabLink : HTMLButtonElement,
    firstTabContent: HTMLElement,
    firstContentLink: HTMLElement,
    contentLink: HTMLElement,
    // firstLinkImage: HTMLImageElement,

    //list of tablinks
    tabsList: [] as HTMLButtonElement[],

    //
    buttonTarget: HTMLButtonElement,
    tabContent: HTMLElement,
    lastTabContent: HTMLElement,
    tabContentTarget: HTMLElement,
    contentLinkTarget: HTMLElement,
    lastContentLink: HTMLElement,

    constInit() {
        this.firstTabLink = document.querySelector('.tabs__links');
        this.firstTabContent = document.querySelector('.tabs__content');
        this.firstContentLink = document.querySelector('.content__link');


        this.contentLink = document.querySelectorAll('.content__link');
        this.tabsList = document.querySelectorAll('.tabs__links');
        this.tabContent = document.querySelectorAll('.tabs__content');
    },
    addClassActive() {
        this.firstTabLink.classList.add("active");
        this.firstTabContent.classList.add("active");
    },
    setupTabs() {
        this.contentLink.forEach((link : HTMLElement)=>{
            link.setAttribute('tabindex','-1');
        });
        this.firstContentLink.removeAttribute('tabindex','-1');

        this.tabsList.forEach((tabLink:HTMLButtonElement) => {
            tabLink.addEventListener('click', (e:MouseEvent) => {
                e.preventDefault();

                this.buttonTarget = e.currentTarget;
                this.tabContentTarget = document.querySelector(`#${this.buttonTarget.dataset.id}`);
                this.contentLinkTarget = document.querySelector(`.content__link--${this.buttonTarget.dataset.id}`);
                this.lastLink = document.querySelector('.active');
                this.lastTabContent = document.getElementById(`${this.lastLink.dataset.id}`);
                this.lastContentLink = document.querySelector(`.content__link--${this.lastLink.dataset.id}`);

                this.lastLink.classList.remove('active');
                this.lastTabContent.classList.remove('active');
                this.lastContentLink.setAttribute('tabindex','-1');

                this.buttonTarget.classList.add('active');
                this.tabContentTarget.classList.add('active');
                this.contentLinkTarget.removeAttribute('tabindex','-1');
            })
        });
    },
    init() {
        this.constInit();
        this.addClassActive();
        this.setupTabs();
    }
}