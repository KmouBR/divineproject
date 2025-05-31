function toggleCart() {
    const cart = document.getElementById("cart");
    if (cart) {
        cart.classList.toggle("open");
    } else {
        console.error("Carrinho (#cart) não encontrado no DOM!");
    }
}
