const filter_container = document.getElementById("filter-container");
const show_filter = document.getElementById("show-filter");
const hr = document.getElementById("hr");
const filter_submit = document.getElementById("filter-submit");
const filter_clear = document.getElementById("filter-clear");
const filter_product_keywords = document.getElementById("filter-product-keywords");
const filter_product_name = document.getElementById("filter-product-name");
const filter_product_price_min = document.getElementById("filter-product-price-min");
const filter_product_price_max = document.getElementById("filter-product-price-max");
const pagination_buttons = document.querySelectorAll(".pagination-button");
const pagination_to_left = document.getElementById("pagination-to-left");
const pagination_to_right = document.getElementById("pagination-to-right");
const main_card_container = document.getElementById("main-card-container");
const sec_card_container = document.getElementById("sec-card-container");
const third_card_container = document.getElementById("third-card-container");

let opened = true;
show_filter.addEventListener("click", () => {
    opened = !opened;

    if (opened) {
        show_filter.innerHTML = "Show Filter ∨";
        filter_container.classList.remove("filter-container-none");
        hr.classList.remove("filter-mb-68");
    } else {
        show_filter.innerHTML = "Show Filter >";
        filter_container.classList.add("filter-container-none");
        hr.classList.add("filter-mb-68");
    }
});

filter_clear.addEventListener("click", () => {
    filter_product_keywords.value = "";
    filter_product_name.value = "";
    filter_product_price_min.value = "";
    filter_product_price_max.value = "";
});

//////////////////

function changePage(pageType) {
    if (pageType === 1) {
        main_card_container.classList.remove("d-none");
        sec_card_container.classList.add("d-none");
        third_card_container.classList.add("d-none");
    }
    else if (pageType === 2) {
        main_card_container.classList.add("d-none");
        sec_card_container.classList.remove("d-none");
        third_card_container.classList.add("d-none");
    }
    else if (pageType === 3) {
        main_card_container.classList.add("d-none");
        sec_card_container.classList.add("d-none");
        third_card_container.classList.remove("d-none");
    }
}

pagination_buttons.forEach(element => {
    element.addEventListener("click", () => {
        if (element.classList.contains("no")) return;

        if (element.innerHTML === "1") {
            changePage(1);
        }
        else if (element.innerHTML === "2") {  
            changePage(2);
        }
        else if (element.innerHTML === "3") {
            changePage(3);
        }
    
        pagination_buttons.forEach(index => {
            index.classList.remove("pagination-active-button")
        });

        element.classList.add("pagination-active-button");
        location.href = "#card-container-section";
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
            console.log(number)

            if (number === 3) {
                found_left = true;
                changePage(2);
            }
            else if (number === 2) {  
                found_left = true;
                changePage(1);
            }
            else if (number === 1) {
                pagination_buttons[3].classList.add('pagination-active-button')
                found_left = false;
                changePage(3);
            }
        
            location.href = "#card-container-section";
        }
    }
});

let found_right = false;
pagination_to_right.addEventListener("click", () => {
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

            console.log(number)

            if (number === 3) {
                pagination_buttons[1].classList.add('pagination-active-button')
                found_right = false;
                changePage(1);
            }
            else if (number === 2) {  
                found_right = true;
                changePage(3);
            }
            else if (number === 1) {
                found_right = true;
                changePage(2);
            }

            location.href = "#card-container-section";
        }
    })
});
    