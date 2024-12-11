import React, { useState, useEffect } from 'react';
import ProductCard from '../components/ProductCard';
import './styles/home.css';

function Home() {
  const [products, setProducts] = useState([]);

  useEffect(() => {
    // Загружаем данные о товарах
   fetch('http://my-site.ru/')
      .then(response => response.json())
      .then(data => setProducts(data));
  }, []);

  return (
    <div className="product-list">
      <div className='header'>
        <h1>SmartPlanet</h1>
      </div>

      {products.map(product => (
        <ProductCard key={product.id} product={product} />
      ))}
    </div>
  );
}

export default Home;