// function TriTab(TabToSort) {
//     TabToSort.sort((a, b) => {
//       const textA = a.textContent.toLowerCase();
//       const textB = b.textContent.toLowerCase();
//       return textA.localeCompare(textB);
//     });
//   }

const OpenAnnonce = document.querySelector(".top_mail_container a");
const ContainerFullScreen = document.querySelector(".ContainerFullScreen");

OpenAnnonce.addEventListener("click", () => {
  ContainerFullScreen.style.display = "flex";
});

const closeButton = document.querySelector(".closeButton");

closeButton.addEventListener("click", () => {
  ContainerFullScreen.style.display = "none";
});
