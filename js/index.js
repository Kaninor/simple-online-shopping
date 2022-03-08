const pagination_buttons = document.querySelectorAll(".pagination-button");
const pagination_img = document.getElementById("pagination-img");
const pagination_to_left = document.getElementById("pagination-to-left");
const pagination_to_right = document.getElementById("pagination-to-right");

function changePage(number) {
    switch (number) {
        case 1:
            pagination_img.setAttribute("src", "../assets/card-images/Grapes.jpg")
            break;
        case 2:
            pagination_img.setAttribute("src", "../assets/card-images/Blueberries.jpg")
            break;
        case 3:
            pagination_img.setAttribute("src", "../assets/card-images/Mango.jpg")
            break;
        case 4:
            pagination_img.setAttribute("src", "../assets/card-images/Strawberries.jpg")
            break;
    }
}


pagination_buttons.forEach(element => {
    element.addEventListener("click", () => {
        if (element.classList.contains("no")) return;

        pagination_buttons.forEach(index => {
            index.classList.remove("pagination-active-button")
        });

        element.classList.add("pagination-active-button")
        changePage(parseInt(element.innerHTML))
    });
});

let found_left = false;
pagination_to_left.addEventListener("click", () => {
    for (let i = pagination_buttons.length - 2; i >= 1; i--) {

        if (found_left) { 
            pagination_buttons[i].classList.add('pagination-active-button')
            found_left = false
            return
        }

        if (pagination_buttons[i].classList.contains('pagination-active-button')) {
            pagination_buttons[i].classList.remove('pagination-active-button')
            let number = parseInt(pagination_buttons[i].innerHTML);
            if (number === 1) {
                changePage(4);
                pagination_buttons[4].classList.add('pagination-active-button')
                found_left = false;
            } else {
                changePage(number - 1);
                found_left = true;
            }
        }
    }
});

let found_right = false;
function pagination_to_right_func() {
    pagination_buttons.forEach(element => {
        if (element.classList.contains('no')) return

        if (found_right) { 
            element.classList.add('pagination-active-button') 
            found_right = false
            return
        }

        if (element.classList.contains('pagination-active-button')) {
            element.classList.remove('pagination-active-button')
            let number = parseInt(element.innerHTML);
            if (number === 4) {
                changePage(1);
                pagination_buttons[1].classList.add('pagination-active-button')
                found_right = false;
            } else {
                changePage(number + 1);
                found_right = true;
            }
        }
    })
}

pagination_to_right.addEventListener("click", () => {
    pagination_to_right_func();
});

setInterval(pagination_to_right_func, 3000)