import React, { useState } from 'react';
import Cart from '../components/Cart';

function CartPage() {
  const [cartItems, setCartItems] = useState([]);

  const removeItem = (id) => {
    setCartItems(cartItems.filter(item => item.id !== id));
  };

  return (
    <div>
      <Cart items={cartItems} removeItem={removeItem} />
    </div>
  );
}

export default CartPage;