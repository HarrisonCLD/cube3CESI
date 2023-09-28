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

// for (let i = 0; i < tab_line_product.length; i++) {
//     tab_line_product[i].addEventListener('click', () => {
//         tab_line_product[i].classList.toggle('line_produit_up_height');
//     })
// }

//GESTION APPENCHILD BUG FOREACH PHP

const MainBoardMagasin = document.querySelector('.gestionMagasinBoard')
const StatsContainer = document.querySelector('.stats_container')
const lineStats = document.querySelectorAll('.line_stats')
const tab_line_stats = Array.from(lineStats)

MainBoardMagasin.appendChild(StatsContainer)
for (let k = 0; k < tab_line_stats.length; k++) {
    StatsContainer.appendChild(tab_line_stats[k])
}