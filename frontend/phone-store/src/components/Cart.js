import React from 'react';

function Cart({ items, removeItem }) {
  return (
    <div>
      <h2>Корзина</h2>
      {items.length === 0 ? (
        <p>Ваша корзина пуста</p>
      ) : (
        <ul>
          {items.map(item => (
            <li key={item.id}>
              <span>{item.name}</span>
              <button onClick={() => removeItem(item.id)}>Удалить</button>
            </li>
          ))}
        </ul>
      )}
    </div>
  );
}

export default Cart;