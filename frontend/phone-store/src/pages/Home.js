import React, { useState, useEffect } from 'react';
import ProductCard from '../components/ProductCard';
import { useNavigate } from 'react-router-dom';
import './styles/home.css';

function Home() {

  const navigate = useNavigate();
  
  const handleLogin = () => {
    navigate('/login');
  };

  const handleRegistration = () => {
    navigate('/reg');
  }

  const handleCart = () => {
    navigate('/cart');
  }

  const [products, setProducts] = useState([]);
  const [user, setUser] = useState([]);

  useEffect(() => {
    // Загружаем данные о пользователе
   fetch(`http://my-site.ru/getUserName.php?id=${localStorage.getItem('userId')}`)
      .then(response => response.json())
      .then(data => setUser(data));
  }, []);

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

      <div className='user'>
        <label id='userLabel'>Пользователь: {user[0]}</label>
      </div>

      <div className='autorization'>
        <button onClick={handleLogin}>Войти</button>
        <button onClick={handleRegistration}>Регистрация</button>
      </div>

      <div className='cart_button'>
        <button onClick={handleCart}>Корзина</button>
      </div>

      {products.map(product => (
        <ProductCard key={product.id} product={product} />
      ))}
    </div>
  );
}

export default Home;