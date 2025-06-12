function removeFromCart(
  productId,
  updateCartItemsTable = false,
  price = 0,
  title = ""
) {
  console.log(`Removing product ${productId} from cart`);

  fetch(`/removeFromCart?productId=${productId}`, {
    method: "GET",
    headers: {
      "Content-Type": "application/json",
    },
  })
    .then((response) => {
      if (response.ok) {
        return response.json();
      } else {
        throw new Error("Network response was not ok");
      }
    })
    .then((data) => {
      console.log("Product removed from cart:", data);
      document.getElementById("cartCount").innerText = data.cartCount;
      if (updateCartItemsTable) {
        const cartItemsTable = document.getElementById("cartItemsTable");
        cartItemsTable.innerHTML = "";
        data.cart.forEach((item) => {
          const row = document.createElement("tr");
          row.innerHTML = `
            <td>${item.productName}</td>
            <td>${item.quantity}</td>
            <td>${item.productPrice}</td>
            <td>${item.rowPrice}</td>
            <td>
              <a href="javascript:addToCart(${item.productId}, true)" class="btn btn-info">+</a>
              <a href="javascript:removeFromCart(${item.productId}, true)" class="btn btn-danger">−</a>
            </td>
          `;
          cartItemsTable.appendChild(row);
        });
        document.getElementById("totalPrice").innerText = data.cartTotal;
      }
    })
    .catch((error) => {
      console.error("There was a problem removing from cart:", error);
    });
}
