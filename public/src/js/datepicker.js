//Date and Time Picker functions
($('.datepicker').pickadate({
    // Escape any “rule” characters with an exclamation mark (!).
    format: 'You selecte!d: dddd, dd mmm, yyyy',
    formatSubmit: 'yyyy-mm-dd',
    hiddenPrefix: 'prefix__',
    hiddenSuffix: '__suffix'
}));
$('.timepicker').pickatime({
    // Escape any “rule” characters with an exclamation mark (!).
    format: 'T!ime selected: h:i a',
    formatLabel: '<b>h:i <!i>a</!i>',
    formatSubmit: 'HH:i:00',
    hiddenPrefix: 'prefix__',
    hiddenSuffix: '__suffix'
});