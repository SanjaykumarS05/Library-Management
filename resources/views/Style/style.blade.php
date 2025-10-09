<style> 
body {
  background-color: #e9e1cf; /* soft beige like library paper */
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  display: flex;
  align-items: center;
  justify-content: center;
  height: 100vh;
  margin: 0;
}

/* === Main Container === */
.container {
  background-color: #fffdf6;
  width: 400px;
  padding: 40px 50px;
  border-radius: 14px;
  box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
  text-align: center;
  transition: all 0.3s ease;
}

.container:hover {
  box-shadow: 0px 8px 18px rgba(0, 0, 0, 0.25);
}

/* === Header === */
h1 {
  color: #2b2a1e;
  font-size: 26px;
  margin-bottom: 30px;
  font-weight: 700;
}

/* === Input Group === */
.input-group {
  margin-bottom: 22px;
  text-align: left;
  position: relative;
}

.input-group label {
  color: #4d493c;
  font-size: 14px;
  display: block;
  margin-bottom: 5px;
  font-weight: 600;
}

.input-group i.material-icons {
  position: absolute;
  left: -35px;
  top: 34px;
  color: #7b6f50;
  font-size: 22px;
}

/* === Input Fields === */
input[type="text"],
input[type="password"] {
  width: 100%;
  padding: 10px 12px;
  font-size: 15px;
  border: 1px solid #b9ae90;
  border-radius: 8px;
  background-color: #fff;
  transition: 0.3s;
}

input[type="text"]:focus,
input[type="password"]:focus {
  border-color: #84754e;
  outline: none;
  background-color: #fffdf8;
}

/* === Button === */
button.submit {
  width: 100%;
  padding: 12px;
  background-color: #1b3a57;
  color: white;
  border: none;
  border-radius: 8px;
  font-size: 15px;
  font-weight: 600;
  cursor: pointer;
  transition: background-color 0.3s ease, transform 0.2s ease;
}

button.submit:hover {
  background-color: #2d5270;
  transform: scale(1.02);
}

/* === Text and Links === */
p {
  font-size: 14px;
  color: #3b372d;
}

a {
  color: #1b3a57;
  font-weight: 600;
  text-decoration: none;
}

a:hover {
  text-decoration: underline;
}



/* === Responsive Design === */
@media (max-width: 480px) {
  .container {
    width: 90%;
    padding: 25px;
  }
}
</style>
