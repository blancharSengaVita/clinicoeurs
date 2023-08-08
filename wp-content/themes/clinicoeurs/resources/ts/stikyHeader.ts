export const stikyHeader = {
    init(){
        let prevScrollpos = window.scrollY;
        window.addEventListener('scroll', ()=>{
            const currentScrollPos = window.scrollY;
            if (currentScrollPos < 1){
                return
            } else if (currentScrollPos > prevScrollpos ) {
                document.querySelector("header").classList.add("scrolling-down");
            } else {
                document.querySelector("header").classList.remove("scrolling-down");
            }
            prevScrollpos = currentScrollPos;
        });
    }
}