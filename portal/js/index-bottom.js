var line = new ProgressBar.Circle('#card1', {
  strokeWidth: 6,
  easing: 'easeInOut',
  duration: 1400,
  color: '#0275d8',
  trailColor: '#eee',
  trailWidth: 5,
  svgStyle: null
});
var card1 = Date.getDaysInMonth(Date.today().toString('yyyy'), Date.today().toString('M')-1);

line.animate(Date.today().toString('dd')/card1);

var line1 = new ProgressBar.Circle('#card2', {
  strokeWidth: 6,
  easing: 'easeInOut',
  duration: 1400,
  color: '#0275d8',
  trailColor: '#eee',
  trailWidth: 5,
  svgStyle: null
});
var line2 = new ProgressBar.Circle('#card3', {
  strokeWidth: 6,
  easing: 'easeInOut',
  duration: 1400,
  color: '#0275d8',
  trailColor: '#eee',
  trailWidth: 5,
  svgStyle: null
});

var line4 = new ProgressBar.Line('#att_record', {
  strokeWidth: 0.3,
  easing: 'easeInOut',
  duration: 1400,
  color: '#0275d8',
  trailColor: '#eee',
  trailWidth: 1,
  svgStyle: null
});

$('#sidenav1').addClass('active');