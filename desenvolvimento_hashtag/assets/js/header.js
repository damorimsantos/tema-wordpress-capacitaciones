function cliqueBotoesHeader() {
    console.log("chamou a função");
    let elemsMenu = document.querySelectorAll(".header__menu");
    let elemsHeaderItem = document.querySelectorAll(".header__item");

    elemsHeaderItem.forEach((elem) => {
        elem.addEventListener("click", () => {
            var elemUL = elem.querySelector("ul.fuga");
            if (!elemUL) {
                return;
            }
            elem.classList.toggle("header__item--aberto");

            const width = window.innerWidth;
            if (width <= 991) {
                if (!elemUL.parentElement.style.maxHeight) {
                    elemUL.parentElement.style.maxHeight =
                        elemUL.offsetHeight * 1.1 + "px";
                } else {
                    elemUL.parentElement.style.maxHeight = "";
                }
            } else {
                // console.log("ok");
                // if (!elemUL.parentElement.style.maxHeight) {
                //     elemUL.parentElement.style.maxHeight =
                //         elemUL.offsetHeight * 1.1 + "px";
                // } else {
                //     elemUL.parentElement.style.maxHeight = "";
                // }
            }
        });
    });

    elemsMenu.forEach((elemMenu) => {
        elemMenu.addEventListener("click", () => {
            document.body.classList.toggle("menu--aberto");
        });
    });
}

cliqueBotoesHeader();
window.addEventListener("resize", () => {
    console.log("redimensionou");
    cliqueBotoesHeader;
});

// ------------------------------

// function mudarLayoutLogoNav() {
//     if (window.innerWidth >= 991) {
//         const elemHeaderLogo = document.querySelector(".header__logo");
//         const elemHeaderNav = document.querySelector(".header__nav");
//         const elemHeaderFuga = document.querySelector(".header > .fuga");

//         if (elemHeaderLogo && elemHeaderNav && elemHeaderFuga) {
//             console.log(elemHeaderLogo, elemHeaderNav, elemHeaderFuga);
//             const wrapper = document.createElement("div");
//             wrapper.className = "header__logo-nav";

//             wrapper.appendChild(elemHeaderLogo);
//             wrapper.appendChild(elemHeaderNav);

//             elemHeaderFuga.insertBefore(wrapper, elemHeaderFuga.firstChild);
//         }
//     }
// }

// mudarLayoutLogoNav();
// window.addEventListener("resize", () => {
//     console.log("redimensionou");
//     mudarLayoutLogoNav;
// });
