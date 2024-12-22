import React, { useState, useEffect } from 'react';

function Cart({ items, removeItem }) {
  /*const [product, setProduct] = useState(null);

  useEffect(() => {
    fetch(`http://my-site.ru/productInfo.php?id=${items}`)
      .then(response => response.json())
      .then(data => setProduct(data));
  }, []);*/


  if (items.length === 0) {
    return (
      <div>
        <h2>Корзина</h2>
        <p>Ваша корзина пуста</p>
      </div>
    );
  }

  return (
    <ul>
      {items.map(item => (
        <li key={item[0]}>
          <span>{item[2]}</span>
          <button onClick={() => removeItem(item[0])}>Удалить</button>
        </li>
      ))}
    </ul>
  );
}

export default Cart;