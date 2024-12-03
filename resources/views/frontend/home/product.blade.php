<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce Home</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" href="{{ asset('assets/frontend/style.css') }}"> <!-- Add your CSS file -->
</head>

<body>
    <div class="header">
        <header class="container">
            <h1>My E-Commerce Store</h1>
            <nav>
                <ul id="categories"></ul>
            </nav>
        </header>
    </div>

    <div class="main">
        <main class="container">
            <section class="product">
                <h2>Products</h2>
                <div id="product-list" class="product-grid"></div>
            </section>
        </main>
    </div>

    <script>
        // Fetch categories
        axios.get('/api/categories')
            .then(response => {
                const categories = response.data.data;
                const categoryList = document.getElementById('categories');

                categories.forEach(category => {
                    const listItem = document.createElement('li');
                    listItem.innerHTML = `<a href="#" data-id="${category.id}">${category.name}</a>`;
                    listItem.querySelector('a').addEventListener('click', (e) => {
                        e.preventDefault();
                        fetchProductsByCategory(category.id);
                    });
                    categoryList.appendChild(listItem);
                });
            })
            .catch(error => console.error('Error fetching categories:', error));

        // Fetch products
        function fetchProductsByCategory(categoryId = null) {
            let url = '/api/products';
            if (categoryId) url += `?category_id=${categoryId}`;

            axios.get(url)
                .then(response => {
                    const products = response.data.data;
                    const productList = document.getElementById('product-list');
                    productList.innerHTML = ''; // Clear existing products

                    products.forEach(product => {
                        let imagesArray;
                        try {
                            imagesArray = typeof product.images === 'string' ? JSON.parse(product.images) : product.images;
                        } catch (error) {
                            console.error('Error parsing product images:', error, product.images);
                            imagesArray = [];
                        }

                        const imageSrc = imagesArray.length ? `/${imagesArray[0]}` : '/default-image.jpg';

                        const productCard = document.createElement('div');
                        productCard.className = 'product-card';
                        productCard.innerHTML = `
                    <img src="${imageSrc}" height="120" width="100" alt="${product.name}">
                    <h3>${product.name}</h3>
                    <p>${product.description}</p>
                    <strong>Price: $${product.price}</strong>
                    <button data-id="${product.id}">Add to Cart</button>
                `;
                        productCard.querySelector('button').addEventListener('click', () => {
                            addToCart(product.id);
                        });
                        productList.appendChild(productCard);
                    });
                })
                .catch(error => console.error('Error fetching products:', error));
        }

        // Add to cart
        function addToCart(productId) {
            axios.post('/cart/add', {
                    product_id: productId
                })
                .then(response => {
                    alert('Product added to cart!');
                })
                .catch(error => {
                    console.error('Error adding product to cart:', error);
                    alert('Could not add product to cart.');
                });
        }

        // Fetch all products initially
        fetchProductsByCategory();
    </script>
</body>

</html>