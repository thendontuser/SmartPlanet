import React, { useState, useEffect } from 'react';
import ProductCard from '../components/ProductCard';

function Home() {
  const [products, setProducts] = useState([]);

  useEffect(() => {
    // Загружаем данные о товарах
    fetch('http://my-site.ru/', { mode: 'no-cors'})  // Путь может быть изменен в зависимости от вашего бекенда
      .then(response => response.json())
      .then(data => setProducts(data));
  }, []);

  return (
    <div className="product-list">
      {products.map(product => (
        <ProductCard key={product.id} product={product} />
      ))}
    </div>
  );
}

export default Home;