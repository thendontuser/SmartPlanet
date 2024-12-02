import React, { useState } from 'react';
import Login from '../components/Login';

function LoginPage() {
  const [user, setUser] = useState(null);

  const handleLogin = (username, password) => {
    // Логика аутентификации
    setUser({ username });
  };

  return (
    <div>
      {!user ? (
        <Login onLogin={handleLogin} />
      ) : (
        <p>Добро пожаловать, {user.username}!</p>
      )}
    </div>
  );
}

export default LoginPage;