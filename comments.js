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
      let newComment = document.createElement("div");
      newComment.classList.add("comment-item");
      newComment.innerHTML = `
                  <div class="comment-content">
                      <strong>Jij:</strong>
                      <p>${result.body}</p>
                  </div>
              `;

      document.querySelector("#comment-list").prepend(newComment);

      document.querySelector("#commentText").value = "";
    })
    .catch((error) => {
      console.error("Error:", error);
    });
});
