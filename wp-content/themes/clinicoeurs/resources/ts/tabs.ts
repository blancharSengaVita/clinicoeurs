export const tabs = {
    //first tab link and content
    firstTabLink : HTMLButtonElement,
    firstTabContent: HTMLElement,
    // firstLinkImage: HTMLImageElement,

    //list of tablinks
    tabsList: [] as HTMLButtonElement[],

    //
    buttonTarget: HTMLButtonElement,
    tabContent: HTMLElement,
    lastTabContent: HTMLElement,
    tabContentTarget: HTMLElement,

    constInit() {
        this.firstTabLink = document.querySelector('.tabs__links');
        this.firstTabContent = document.querySelector('.tabs__content');
        // this.firstLinkImage = document.querySelector('.link-image');

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
                e.preventDefault();

                this.buttonTarget = e.currentTarget;
                this.tabContentTarget = document.querySelector(`#${this.buttonTarget.dataset.id}`);
                this.lastLink = document.querySelector('.active');
                this.lastTabContent = document.getElementById(`${this.lastLink.dataset.id}`);

                this.lastLink.classList.remove('active');
                this.lastTabContent.classList.remove('active');

                this.buttonTarget.classList.add('active');
                this.tabContentTarget.classList.add('active');
            })
        });
    },
    init() {
        this.constInit();
        this.addClassActive();
        this.setupTabs();
    }
}