var now = (new Date()).toLocaleString();
$('#current-time').text(now);
setInterval(function() {
    var now = (new Date()).toLocaleString();
    $('#current-time').text(now);
}, 1000);