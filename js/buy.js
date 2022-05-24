const buy_btns = document.querySelectorAll('.buy-btn');

buy_btns.forEach(element => {
    element.addEventListener('click', () => {
        location.href = "/store/pages/buy_view.php?fruit=" + element.getAttribute('id');
    });
});