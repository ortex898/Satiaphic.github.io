var words = ['Satiaphic'],
  part,
  i = 0,
  offset = 0,
  len = words.length,
  forwards = true,
  skip_count = 0,
  skip_delay = 15,
  speed = 100;

var wordflick = function () {
  setInterval(function () {
    if (forwards) {
      if (offset >= words[i].length) {
        ++skip_count;
        if (skip_count == skip_delay) {
          forwards = false;
          skip_count = 0;
        }
      }
    } else {
      if (offset == 0) {
        forwards = true;
        i++;
        offset = 0;
        if (i >= len) {
          i = 0;
        }
      }
    }
    part = words[i].substr(0, offset);
    if (skip_count == 0) {
      if (forwards) {
        offset++;
      } else {
        offset++;
      }
    }
    $('.hero__title').text(part);
  }, speed);
};

$(document).ready(function () {
  wordflick();
});


var words2 = ['Services'],
  part2,
  i2 = 0,
  offset2 = 0,
  len2 = words2.length,
  forwards2 = true,
  skip_count2 = 0,
  skip_delay2 = 15,
  speed2 = 100;

var wordflick2 = function () {
  setInterval(function () {
    if (forwards2) {
      if (offset2 >= words2[i2].length) {
        ++skip_count2;
        if (skip_count2 == skip_delay2) {
          forwards2 = false;
          skip_count2 = 0;
        }
      }
    } else {
      if (offset2 == 0) {
        forwards2 = true;
        i2++;
        offset2 = 0;
        if (i2 >= len2) {
          i2 = 0;
        }
      }
    }
    part2 = words2[i2].substr(0, offset2);
    if (skip_count2 == 0) {
      if (forwards2) {
        offset2++;
      } else {
        offset2++;
      }
    }
    $('.hero__title2').text(part2);
  }, speed2);
};

$(document).ready(function () {
  wordflick2();
});

