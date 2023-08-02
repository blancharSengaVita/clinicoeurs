export const displayTheMenuOnDesktop = {
    navDesktop: HTMLElement,
    navMobile: HTMLElement,

    initConst():void{
        this.navDesktop = document.querySelector('.menu--desktop');
        this.navMobile = document.querySelector('.menu--mobile');
    },

    selectGoodMenu(){
        if (window.innerWidth > 767) {
            this.navDesktop.classList.remove('display-none');
            this.navMobile.classList.add('display-none');
        } else {
            this.navDesktop.classList.add('display-none');
            this.navMobile.classList.remove('display-none');
        }
    },

    selectGoodMenuOnLoad(){
        window.addEventListener('load', ()=>{
            this.selectGoodMenu();
        });
    },

    selectGoodMenuOnResize():void {
        window.addEventListener('resize', () => {
            this.selectGoodMenu();
        });
    },

    init(): void {
        this.initConst();
        this.selectGoodMenuOnLoad();
        this.selectGoodMenuOnResize();
    }
}