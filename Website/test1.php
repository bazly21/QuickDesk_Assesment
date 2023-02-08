<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
       #container {
  width: 100%;
  height: 100%;
  display: flex;
  flex-direction: column;
  align-items: center;
  font-family: sans-serif;
}

#customer-view {
  display: flex;
  flex-direction: column;
  align-items: center;
}

#now-serving-last-number {
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-bottom: 20px;
}

#take-a-number {
  background-color: #2371E0;
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.counter-section {
  display: flex;
  justify-content: space-between;
}

.counter {
  display: flex;
  flex-direction: column;
  align-items: center;
  width: 20%;
}

.status {
  height: 20px;
  width: 20px;
  border-radius: 50%;
  margin-bottom: 10px;
}

.green {
  background-color: green;
}

p {
  margin: 0;
}


    </style>
</head>
<body>
<div id="container">
  <div id="customer-view">
    <div id="now-serving-last-number">
      <p>Now Serving: <span id="now-serving-num">0</span></p>
      <p>Last Number: <span id="last-num">0</span></p>
      <button id="take-a-number">Take a Number</button>
    </div>
    <div class="counter-section">
      <div class="counter">
        <div class="status green"></div>
        <p>Counter 1</p>
        <p>Current Number: <span id="counter-1-cur-num">0</span></p>
      </div>
      <div class="counter">
        <div class="status green"></div>
        <p>Counter 2</p>
        <p>Current Number: <span id="counter-2-cur-num">0</span></p>
      </div>
      <div class="counter">
        <div class="status green"></div>
        <p>Counter 3</p>
        <p>Current Number: <span id="counter-3-cur-num">0</span></p>
      </div>
      <div class="counter">
        <div class="status green"></div>
        <p>Counter 4</p>
        <p>Current Number: <span id="counter-4-cur-num">0</span></p>
      </div>
    </div>
  </div>
</div>


</body>
</html>