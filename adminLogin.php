<!DOCTYPE html>
<html>
<head>
  <title>Login System</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <style>

body {
  background-color: #f2f2f2;
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
}

.login-container {
  background-color: #ffffff;
  border-radius: 4px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  margin: 100px auto;
  max-width: 400px;
  padding: 20px;
}

h2 {
  text-align: center;
}

form {
  display: flex;
  flex-direction: column;
}

input[type="text"],
input[type="password"] {
  margin-bottom: 10px;
  padding: 10px;
}

button {
  background-color: #4CAF50;
  border: none;
  color: white;
  cursor: pointer;
  padding: 10px;
}

button:hover {
  background-color: #45a049;
}

.error {
  color: red;
  margin-top: 10px;
  text-align: center;
}


  </style>
</head>
<body>
  <div class="login-container">
    <h2>Login</h2>
    <form action="login.php" method="POST">
      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Login</button>
    </form>
  </div>
</body>
</html>
