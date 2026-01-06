document.querySelector("#btnAddComment").addEventListener("click", function () {
  let productId = this.dataset.postId;
  let commentText = document.querySelector("#commentText").value;

  let formData = new FormData();
  formData.append("text", commentText);
  formData.append("productId", productId);

  fetch("ajax/savecomment.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then((result) => {
      console.log("Success:", result);
    })
    .catch((error) => {
      console.error("Error:", error);
    });
});
