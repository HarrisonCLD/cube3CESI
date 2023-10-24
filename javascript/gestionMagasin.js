const FullScreenStock = document.querySelector('.OpenFullScreenStock')
const FullScreenStockContainer = document.querySelector('.fullscreen_stock')

let FullScreenStockActive = false
const url = window.location.href

if (url.includes('stock')) {

    FullScreenStock.addEventListener('click', () => {
        FullScreenStockContainer.style.display = "flex";
        FullScreenStockActive = true
    })

    const closeButton = document.querySelector('.top_stock_search .closeButton')

    closeButton.addEventListener('click', () => {
        if (FullScreenStockActive) {
            FullScreenStockContainer.style.display = 'none'
            FullScreenStockActive = false
        }
    })
}

const lineProduct = document.querySelectorAll('.line_produit');

const tab_line_product = Array.from(lineProduct);

//GESTION APPENCHILD BUG FOREACH PHP

const MainBoardMagasin = document.querySelector('.gestionMagasinBoard')
const StatsContainer = document.querySelector('.stats_container')
const BodyTabStats = document.querySelector('.tbody_stats')
const lineStats = document.querySelectorAll('.line_stats')
const tab_line_stats = Array.from(lineStats)

console.log(BodyTabStats)
console.log(lineStats)

MainBoardMagasin.appendChild(StatsContainer)
for (let k = 0; k < tab_line_stats.length; k++) {
    StatsContainer.appendChild(tab_line_stats[k])
}

for (let j = 0; j < lineStats.length; j++) {
    BodyTabStats.appendChild(lineStats[j])
}