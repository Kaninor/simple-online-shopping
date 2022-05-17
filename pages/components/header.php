<header>
    <div class="container">
        <div class="logo-heading-container">
            <img class="logo" src="../assets/logo1.png">
            <h2 style="user-select: none">Online Shopping</h2>
        </div>
        <form method="POST" action="/store/pages/filter.php">
            <div class="form-control">
                <input type="hidden" name="search" value="1">
                <input type="search" name="search-txt" placeholder="Search..." value="<?= isset($_GET['search']) ? $_GET['search'] : null ?>">
                <button>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                    </svg>
                </button>
            </div>
        </form>
    </div>
</header>