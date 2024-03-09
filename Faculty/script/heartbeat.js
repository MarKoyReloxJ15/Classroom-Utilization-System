setInterval(function() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '../backend/heartbeat.php', true);
    xhr.send();
  }, 30000);
  