//////////////////////////////////////////////// declaration
const
  setAlert = () => {
    $("form [pattern]").each(function () {
      this.oninvalid = function () {
        this.setCustomValidity($(this).data("txt"));
      }
      this.oninput = function () {
        this.setCustomValidity(" ");
      }
      this.onchange = function () {
        this.setCustomValidity("");
      }
    });
  },
  randnum = () => {
    // $('#login form').off('submit');
    const code = Math.floor(Math.random() * 8000) + 1000;
    const t1 = Math.random() / 2 - 0.2, t2 = Math.random() / 2 - 0.2;
    $("svg text").text(code).attr('transform', `matrix(1 ${t1} ${t2} 1 35 35)`);
    $("#login [name=admchk]").attr("pattern", code);
  },
  msgFormRenew = $(".slide.msg").html(),
  msgSlide = (bl) => {
    $(".slide.msg").html(msgFormRenew); //reset (backto msgadd mode)
    bl ? $(".slide.msg").addClass('active') : $(".slide.msg").removeClass('active');
    setAlert();
  },
  msgall = () => {
    $.post('/api.php?do=msgall', e => {
      $("#msg .col").html(e);
    });
  },
  msgallAdm = () => {
    $.post('/api.php?do=msgallAdm', e => {
      $("#msg .col").html(e);
    });
  },
  msgadd = () => {
    msgSlide(1);
    // get file name to shown
    $("form.msgadd input[type=file]").change(function () {
      if (this.files.length) $(this).next().text(this.files[0].name);
    });

    $('form.msgadd').submit(event => {
      event.preventDefault();
      $.ajax({
        url: '/api.php?do=msgadd',
        data: new FormData(event.currentTarget),  // or $(form.msgadd)
        type: 'POST',
        contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
        processData: false, // NEEDED, DON'T OMIT THIS
        success: (re) => {
          msgSlide(0); // close msg from
          msgall(); //reload msg all
        }
      });
    });
  },
  msgtop = who => {
    const item = $(who).parents(".item");
    const topbool = item.find("div.top").length;

    $.post('/api.php?do=msgtop', { id: item.find('[name=id]').val(), tag: topbool ? 0 : 1 }, function (re) {
      msgallAdm(); //reload msg all
    });
  },
  msgmdy = who => { //need know mdy button is who
    const item = $(who).parents(".item");
    if (item.find("input[name=pwd]").val() != item.find("input[name=chk]").val()) {
      // alert("序號錯誤！");
      item.find("input[name=chk]")[0].setCustomValidity("序號錯誤！");
      item.find("input[name=chk]")[0].reportValidity();
    }
    else {
      msgSlide(1); //open msg form
      const target = $(".slide.msg form");
      target.find('[name=id]').val(item.find('[name=id]').val());
      target.find('[name=user]').val(item.find('[name=user]').text());
      target.find('[name=pwd]').val(item.find('[name=pwd]').val());
      target.find('[name=tel]').val(item.find('[name=tel]').val());
      target.find('[name=mail]').val(item.find('[name=mail]').val());
      target.find('[name=info]').val(item.find('[name=info]').text());
      target.find('[name=img]').parents("label").before(item.find('[name=img]').clone().css({ "width": "50px", "height": "50px" }));
      target.find("[name=showtel][type=checkbox]")[0].checked = !item.find("[name=showtel]").hasClass("dn");
      target.find("[name=showmail][type=checkbox]")[0].checked = !item.find("[name=showmail]").hasClass("dn");
      target.attr('class', 'msgmdy');   //msgmdy mode

      // get file name to shown
      $("form.msgmdy input[type=file]").change(function () {
        if (this.files[0].name) $(this).next().text(this.files[0].name);
      });

      $('.msgmdy').submit(event => {
        event.preventDefault();
        $.ajax({
          url: '/api.php?do=msgmdy',
          data: new FormData(event.currentTarget),
          type: 'POST',
          contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
          processData: false, // NEEDED, DON'T OMIT THIS
          success: (re) => {
            msgSlide(0); // close msg from
            msgall(); //reload msg all
          }
        });
      });
    }
  },
  msgmdyAdm = who => { //need know mdy button is who
    const item = $(who).parents(".item");
    msgSlide(1); //open msg form
    const target = $(".slide.msg form");
    target.find('[name=id]').val(item.find('[name=id]').val());
    target.find('[name=user]').val(item.find('[name=user]').text());
    target.find('[name=pwd]').val(item.find('[name=pwd]').val());
    target.find('[name=tel]').val(item.find('[name=tel]').val());
    target.find('[name=mail]').val(item.find('[name=mail]').val());
    target.find('[name=info]').val(item.find('[name=info]').text());
    target.find('[name=img]').parents("label").before(item.find('[name=img]').clone().css({ "width": "50px", "height": "50px" }));
    target.find("[name=showtel][type=checkbox]")[0].checked = !item.find("[name=showtel]").hasClass("dn");
    target.find("[name=showmail][type=checkbox]")[0].checked = !item.find("[name=showmail]").hasClass("dn");
    target.find('[name=reply]').val(item.find('[name=reply]').text());
    target.attr('class', 'msgmdy');   //msgmdy mode

    // get file upload name to shown
    $("form.msgmdy input[type=file]").change(function () {
      if (this.files[0].name) $(this).next().text(this.files[0].name);
    });

    $('.msgmdy').submit(event => {
      event.preventDefault();
      $.ajax({
        url: '/api.php?do=msgmdyAdm',
        data: new FormData(event.currentTarget),
        type: 'POST',
        contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
        processData: false, // NEEDED, DON'T OMIT THIS
        success: (re) => {
          msgSlide(0); // close msg from
          msgallAdm(); //reload msg all
        }
      });
    });
  },
  msgdel = (who) => { //need know del button is who;
    const item = $(who).parents(".item");
    if (item.find("input[name=pwd]").val() != item.find("input[name=chk]").val()) alert("序號錯誤！");
    else {
      $.post('/api.php?do=msgdel', { id: item.find('[name=id]').val() }, function (re) {
        msgall(); //reload msg all
      });
    }
  },
  msgkill = (who) => { //need know del button is who;
    const item = $(who).parents(".item");
    $.post('/api.php?do=msgkill', { id: item.find('[name=id]').val() }, function (re) {
      msgallAdm(); //reload msg all
    });
  },
  teamFormRenew = $(".slide.team").html(),
  teamSlide = (bl) => {
    $(".slide.team").html(teamFormRenew); //reset (backto teamadd mode)
    bl ? $(".slide.team").addClass('active') : $(".slide.team").removeClass('active');
    setAlert();
  },
  teamallAdm = () => {
    $.post('/api.php?do=teamallAdm', e => {
      $("#team .scrollbox").html(e);
    });
  },
  teamall = () => {
    $.post('/api.php?do=teamall', e => {
      $("#team .scrollbox").html(e);
    });
  },
  teambreak = who => {
    const tag = $(who).parents(".item").find("[name=tag]").val();
    $.post('/api.php?do=teambreak', { tag }, function (re) {
      teamallAdm(); //reload msg all
    });
  },
  teamrand = () => {
    $.post('/api.php?do=teamrand', function (re) {
      teamallAdm(); //reload msg all
    });
  },
  teamadd = () => {
    teamSlide(1);
    // get file name to shown
    $("form.teamadd input[type=file]").change(function () {
      if (this.files.length) $(this).next().text(this.files[0].name);
    });

    $('form.teamadd').submit(event => {
      event.preventDefault();
      $.ajax({
        url: '/api.php?do=teamadd',
        data: new FormData(event.currentTarget),  // or $(form.msgadd)
        type: 'POST',
        contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
        processData: false, // NEEDED, DON'T OMIT THIS
        success: (re) => {
          teamSlide(0); // close msg from
          teamall(); //reload team all
        }
      });
    });
  },
  adslider = () => {
    let start = 0;
    const imgs = $("#ad img");
    setInterval(() => {
      const
        posx = Math.floor(Math.random() * 200) - 100,
        posy = Math.floor(Math.random() * 200) - 100;
      imgs.eq(start++).fadeOut(2000);
      imgs.eq(start %= imgs.length).css("transform", `scale(2) translate(${posx * 2}px, ${posy * 2}px)`).fadeIn(2000);
    }, 5000);
  };