const add_to_cart_btns = document.querySelectorAll('.cart-btn-stat');
const username = document.getElementById('user-name-span');

add_to_cart_btns.forEach(element => {
    element.addEventListener("click", () => {
        let data = null;
        if (element.classList.contains('add-to-card-btn'))
            data = {
                "username": username.innerText,
                "fruit-name": element.getAttribute('id'),
                "mode": 1
            }
        else if (element.classList.contains('added-to-card-btn'))
            data = {
                "username": username.innerText,
                "fruit-name": element.getAttribute('id'),
                "mode": 0
            }
        axios.post('http://localhost/store/pages/add_to_cart.controller.php', data)
            .then((res) => {
                if (data["mode"] == 1) {
                    element.innerText = "Added";
                    element.classList.remove('add-to-card-btn');
                    element.classList.add('added-to-card-btn');
                }
                else if (data["mode"] == 0) {
                    element.innerText = "Add To Cart";
                    element.classList.remove('added-to-card-btn');
                    element.classList.add('add-to-card-btn');
                }
            })
            .catch((error) => {
                alert(error.response.data)
            });
    });
});