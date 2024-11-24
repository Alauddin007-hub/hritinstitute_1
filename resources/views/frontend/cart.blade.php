<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>

    <link rel="stylesheet" href="{{asset(assets/frontend/style.css)}}">
</head>
<body>
    <h1>Your Cart</h1>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cart as $id => $item)
                <tr>
                    <td>{{ $item['name'] }}</td>
                    <td>${{ $item['price'] }}</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>${{ $item['price'] * $item['quantity'] }}</td>
                    <td>
                        <form method="POST" action="{{ url('/cart/remove') }}">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $id }}">
                            <button type="submit">Remove</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <p>Total Amount: ${{ array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart)) }}</p>
</body>
</html>
