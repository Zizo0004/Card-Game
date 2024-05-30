<?php include('navbar.php');

if (!isset($_SESSION['username'])) {
   header('Location: index.php');
   exit();
};


?>
<div id="main">
  <div id="leaderboard">

    <table class="table">
      <thead>
        <tr>
          <th>Username</th>
          <th>Best Scores</th>
          <th>Best Scores per Level</th>
        </tr>
      </thead>
      <tbody id="data">





      </tbody>
    </table>

  <!-- </div> -->
<!-- </div> -->

  </div>
  <script>
    let request = new XMLHttpRequest();
    request.open('GET', 'score.json?t=' + new Date().getTime(), true);


request.onload = function() {
  if (request.status >= 200 && request.status < 400) {
    let data = JSON.parse(request.responseText);
    displayData(data);
  } else {
    console.error('Failed to load data');
  }
};

request.onerror = function() {
  console.error('Failed to connect to server');
};

request.send();

    function displayData(data) {
  let html = '';
  data.forEach(function(item) {
    html += ' <tr ><td data-label="Username">'+item.username+'</td>'+
          '<td data-label="Best Scores">'+item.totalScore+'</td>'+
          '<td data-label="Best Scores per Level">Level 1:'+item.level1Points +'<br>Level 2:' +item.level2Points+'<br>Level 3: '+item.level3Points+'</td></tr>';
  });
  document.querySelector('#data').innerHTML = html;
}

  </script>
