document.querySelector("#btnAddComment").addEventListener("click", function () {
  let productId = this.getAttribute("productId");
  let commentText = document.querySelector("#commentText").value;
  console.log(productId);
  console.log(commentText);
});
