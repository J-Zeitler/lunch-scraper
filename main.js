/**
 * Color today
 */
var weekdays = ["monday", "tuesday", "wednesday", "thursday", "friday", "saturday", "sunday"];

// week start on monday
Date.prototype.sGetDay = function() {
  return (this.getDay() + 6) %7;
}
var d = new Date();
var today = weekdays[d.sGetDay()];

var fields = $('.field');
var future = false;
$.each(fields, function (i, f) {
  var dayClass = "field-name-field-" + today;
  var field = $(f);
  if (field.hasClass(dayClass)) {
    future = true;
    field.addClass('today');
  } else {
    field.addClass(future ? 'future' : 'past');
  }
});

/**
 * sync
 */
var span = $('#sync-time');
var syncTime = span[0].innerHTML;
moment.locale('sv');
var m = moment(syncTime);
span.html(m.fromNow());
