let infiniteScrollers = document.querySelectorAll(".infinite-scroller");

infiniteScrollers.forEach((scroller) => {
    let innerScroller = scroller.querySelector(".infinite-scroller > *");
    let scrollerContent = Array.from(innerScroller.children);
    let mediaQuery = window.matchMedia("(min-width: 1921px)");

    scrollerContent.forEach((item) => {
        let itemDuplicado = item.cloneNode(true);

        itemDuplicado.setAttribute("aria-hidden", true);
        innerScroller.appendChild(itemDuplicado);
    });

    if (mediaQuery.matches) {
        scrollerContent.forEach((item) => {
            let itemDuplicado = item.cloneNode(true);

            itemDuplicado.setAttribute("aria-hidden", true);
            innerScroller.appendChild(itemDuplicado);
        });
    }

    console.log("Duplicou os itens do Scroller Infinito!");
});
