document.querySelector("#btnAddComment").addEventListener("click", function () {
  let productId = this.dataset.postId;
  let commentText = document.querySelector("#commentText").value;
  console.log(productId);
  console.log(commentText);
});
