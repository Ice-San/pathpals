const infoParentElement = document.querySelector(".info");

const firstInfoItemsText = document.getElementById("firstText");
const firstInfoItemsImg = document.getElementById("firstImg");

const secondInfoItemsText = document.getElementById("secondText");
const secondInfoItemsImg = document.getElementById("secondImg");

const threeInfoItemsText = document.getElementById("thirdText");
const threeInfoItemsImg = document.getElementById("thirdImg");
const wow1InfoItems = document.querySelector(".wow-left");
const wow2InfoItems = document.querySelector(".wow-right");

document.addEventListener('scroll', () => {
    const scrollY = window.scrollY;

    if (infoParentElement) {
        const windowHeight = window.innerHeight;
        const elementHeight = infoParentElement.offsetHeight;

        const firstScrollThreshold = Math.min(windowHeight * 0.3, elementHeight * 0.05);
        const secondScrollThreshold = Math.min(windowHeight * 1.5, elementHeight * 0.4);
        const threeScrollThreshold = Math.min(windowHeight * 3, elementHeight * 0.85);

        // First section
        if(scrollY < firstScrollThreshold - 10) {
            firstInfoItemsImg.classList.remove("info-items-after");
            firstInfoItemsImg.classList.add("info-first-item-before");

            firstInfoItemsText.style.background = "linear-gradient(to right, #000000 " + 0 + "%, transparent " + 0 + "%)";
        } else {
            const firsttextAppersCalc = scrollY - firstScrollThreshold;
            const firstSlowFactor = Math.sqrt(firsttextAppersCalc) * 2;
            const firstPercentageStart = Math.min(Math.max(firstSlowFactor * 1.2, 0), 100);
            const firstPercentageEnd = Math.min(Math.max(firstSlowFactor * 1.2 + 20, 0), 100);

            firstInfoItemsText.style.background = "linear-gradient(to right, #000000 " + firstPercentageStart + "%, transparent " + firstPercentageEnd + "%)";
            firstInfoItemsText.style.webkitBackgroundClip = "text";
            firstInfoItemsText.style.webkitTextFillColor = "transparent";

            firstInfoItemsImg.classList.add("info-items-after");
            firstInfoItemsImg.classList.remove("info-first-item-before");
        }

        // Second section
        if(scrollY < secondScrollThreshold - 10) {
            secondInfoItemsImg.classList.remove("info-items-after");
            secondInfoItemsImg.classList.add("info-second-item-before");

            secondInfoItemsText.style.background = "linear-gradient(to right, #000000 " + 0 + "%, transparent " + 0 + "%)";
        } else {
            const secondtextAppersCalc = scrollY - secondScrollThreshold;

            // Ajuste o fator multiplicador para aumentar a velocidade
            const secondSlowFactor = Math.sqrt(secondtextAppersCalc) * 2; // Aumentado de 1.5 para 2.5

            // Aumente a faixa de porcentagem para acelerar a animação
            const secondPercentageStart = Math.min(Math.max(secondSlowFactor * 1.2, 0), 100);
            const secondPercentageEnd = Math.min(Math.max(secondSlowFactor * 1.2 + 20, 0), 100);

            secondInfoItemsText.style.background = "linear-gradient(to right, #000000 " + secondPercentageStart + "%, transparent " + secondPercentageEnd + "%)";
            secondInfoItemsText.style.webkitBackgroundClip = "text";
            secondInfoItemsText.style.webkitTextFillColor = "transparent";

            secondInfoItemsImg.classList.add("info-items-after");
            secondInfoItemsImg.classList.remove("info-second-item-before");
        }

        // Third section
        if(scrollY < threeScrollThreshold - 10) {
            threeInfoItemsImg.classList.remove("info-items-after");
            threeInfoItemsImg.classList.add("info-three-item-before");

            wow1InfoItems.classList.remove("info-items-after");
            wow1InfoItems.classList.add("info-wow-item-before");

            wow2InfoItems.classList.remove("info-items-after");
            wow2InfoItems.classList.add("info-wow-item-before");

            threeInfoItemsText.classList.remove("third-text-appears");
            threeInfoItemsText.classList.add("third-text-desappears");
        } else {
            threeInfoItemsImg.classList.add("info-items-after");
            threeInfoItemsImg.classList.remove("info-three-item-before");

            wow1InfoItems.classList.add("info-items-after");
            wow1InfoItems.classList.remove("info-wow-item-before");

            wow2InfoItems.classList.add("info-items-after");
            wow2InfoItems.classList.remove("info-wow-item-before");

            threeInfoItemsText.classList.add("third-text-appears");
            threeInfoItemsText.classList.remove("third-text-desappears");
        }
    }
});