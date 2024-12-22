import React, { useState, useEffect } from 'react';
import '../pages/styles/cart.css';
import ProductCardInCart from '../components/ProductCardInCart';

function CartPage() {
  const userId = localStorage.getItem('userId');
  const [cartItems, setCartItems] = useState([]);

  useEffect(() => {
    // Загружаем данные корзины
   fetch(`http://my-site.ru/cartProcessing.php?id=${userId}`)
      .then(response => response.json())
      .then(data => setCartItems(data));
  }, []);

  if (cartItems.length === 0) {
    return <p>Ваша корзина пуста</p>;
  }
  
  return (
    <div>
      <div className='header'>
        <h1>SmartPlanet</h1>
      </div>

      <div className='cart-paragraph'>
        <h2>Корзина</h2>
      </div>

      <div className='cart-list'>
        {cartItems.map(p => (
          <ProductCardInCart key={p[0][0]} product={p[0]} />
        ))}
      </div>
    </div>
  );
}

export default CartPage;