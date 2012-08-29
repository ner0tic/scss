function classToggle(u,d,o) {
  $.ajax({
      url: u,
      data: d.f.serialize(),
      cache: o.c,
      dataType: o.t
    });
}