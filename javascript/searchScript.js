// // script.js

// document.addEventListener("DOMContentLoaded", function () {
//     const searchForm = document.getElementById("search-form");
//     const searchInput = document.getElementById("search-input");
//     const searchResults = document.getElementById("search-results");

//     searchForm.addEventListener("submit", function (e) {
//         e.preventDefault();
//         const searchTerm = searchInput.value;

//         // Envoyer le terme de recherche au serveur PHP
//         fetch(`search.php?query=${searchTerm}`)
//             .then(response => response.json())
//             .then(data => {
//                 // Afficher les résultats dans la div search-results
//                 displayResults(data);
//             });
//     });

//     function displayResults(results) {
//         // Effacer les résultats précédents
//         searchResults.innerHTML = "";

//         // Afficher les nouveaux résultats
//         if (results.length === 0) {
//             searchResults.innerHTML = "Aucun résultat trouvé.";
//         } else {
//             const ul = document.createElement("ul");
//             results.forEach(result => {
//                 const li = document.createElement("li");
//                 li.textContent = result;
//                 ul.appendChild(li);
//             });
//             searchResults.appendChild(ul);
//         }
//     }
// });
