(function(){

  var $textarea = $('.editer'),
      $preview = $('.preview'),
      converter = new Markdown.getSanitizingConverter();
      Markdown.Extra.init(converter);
      convert = converter.makeHtml;

  var text = sessionStorage.getItem("mkdowninfo");
  if(text == null || text == "null" || text == ""){
    text = "";
  }

  // instead of `keyup`, consider using `input` using this plugin: http://mathiasbynens.be/notes/oninput#comment-1
  $textarea.keyup(function() {
    if(text == null){
      $preview.html(convert($textarea.val()));
      sessionStorage.setItem("mkdowninfo", $textarea.val());
    }else{
      $textarea.val(text);
      $preview.html(convert(text));
      text = null;
    }
  }).trigger('keyup');


  $(".help-info").on('click', function(){
    $(".help-wrapper").hide(100);
  });


  $(".help-tips").on('click', function(){
    $(".help-wrapper").toggle();
  });

  $(".clearpage").on('click', function(){
    $textarea.val('').trigger('keyup');
  });

  $(".download").on('click', function(){
    var val = $textarea.val();

    if(!val){
      $textarea.focus();
      return false;
    }

    if (navigator.platform.match('Win')) {
      val = val.replace(/\n/g, '\r\n');
    } 
    val = $.base64.encode(val, true);
    var url = "data:application/octet-stream;charset=utf-8;base64," + val;
    $(this).attr('href', url);
    $(this)[0].download = 'bakup-[kjson.com].md';
  });

})();