<div>
    <ul id="main-nav-ul">
        <li><a id="home-link" href="/store/pages/">Home</a></li>
        <li><a id="product-link" href="/store/pages/product.php">Product</a></li>
        <li><a id="contact-link" href="/store/pages/contactUs.php">Contact us</a></li>
    </ul>
    <ul id="auth-nav-ul">
        <li><span style="color: white;"><?= $_SESSION['username'] ?></span></li>
        <li><a id="log-out">Log out</a></li>
    </ul>
</div>

<script src="../js/stickyNavbar.js"></script>

<script>
    switch(location.href)
    {
        case 'http://localhost/store/pages/':
        case 'http://localhost/store/pages/index.php':
            document.getElementById('home-link').classList.add("active");
            break;
        case 'http://localhost/store/pages/product.php':
            document.getElementById('product-link').classList.add("active");
            break;
        case 'http://localhost/store/pages/contactUs.php':
            document.getElementById('contact-link').classList.add("active");
            break;
    }

    document.getElementById('log-out').addEventListener('click', () => {
        if (confirm("Are you sure you want to log out!?"))
            location.href = '/store/pages/auth/auth.php?logout=1';
    });
</script>