(function(){
    $('#diffuse').on("click", function () {
        if ($('#original').val() == '' || $('#edited').val() == '') {
            alert('文本不可为空，请重新输入');
            return;
        }
        $('#original_result code,#edited_result code').html('<img src="//csstools.chinaz.com/tools/images/public/load.gif">');
        setTimeout(function () { doDiff(); }, 500);
    });

    $('#clear').on('click', function () {
        clear();
    });

    function clear() {
        $('#original,#edited').val('');
        $('#original_result code,#edited_result code').html('');
        $('#original_result code:eq(0),#edited_result code:eq(0)').remove();
        $('#prevv').remove();
        $('html,body').animate({ scrollTop: 100 }, 1);
    }
    function doDiff() {

        var diff = new SourceDiff.Diff(true);
        var formatter = new SourceDiff.DiffFormatter(diff);

        var text1 = $('#original').val();
        var text2 = $('#edited').val();

        var chag = 0, add = 0, del = 0;
        var results = formatter.formattedDiff(text1, text2);

        var adds = results[3].added.all();
        var dels = results[3].deleted.all();
        var cha = arrayIntersection(adds, dels);

        $(".hljs-line-numbers").remove();
        $('#original_result code').html(results[0]);
        $('#edited_result code').html(results[1]);


        var pre = $('pre code');
        for (var i = 0; i < pre.length; i++) {
            hljs.highlightBlock(pre[i]);
        }

        var _line = 0;
        $('pre code').each(function () {
            var lines = $(this).html().split('<br>').length - 1;
            _line = lines;
            $(this).before('<code class="hljs hljs-line-numbers" style="float: left;"></code>');
            var html = $(this).prev('.hljs-line-numbers');
            for (i = 1; i <= lines; i++) {
                if (i == lines)
                    html.html(html.html() + (i + '.'));
                else
                    html.html(html.html() + (i + '.<br>'));
            }
        });

        $('#prevv').remove();

        var pos = $("#txtcontents").position();
        var prevv_left = pos.left + $("#txtcontents").width() + 20;
        $("body").append('<div id="prevv" class="pa ie" style="top: 10%;left: '+prevv_left+'px;height: 300px;width: 70px;background: rgba(0, 0, 0, 0.08);opacity: 0.8;display:none;position:fixed;">\
            <div class="pr" style="height: 300px;width: 70px;" >\
                <div id="_scrollblock" style="position: absolute;width: 100%;height: 40px;background: rgba(0, 0, 0, 0.1);opacity: 0.8;top:0;left:0;z-index:100"></div>\
            </div>\
            <div id="total">\
                <p style="background-color: #FD8;"><strong>0</strong>处修改</p>\
	            <p style="background-color: #9E9;"><strong>0</strong>处新增</p>\
	            <p style="background-color: #E99"><strong>0</strong>处删除</p>\
            </div>\
        </div>');

        $('#total strong:eq(0)').html(cha.length);
        $('#total strong:eq(1)').html(adds.length - cha.length);
        $('#total strong:eq(2)').html(dels.length - cha.length);


        var scrollTag = true;

        var _h = $('#edited_result code').height();
        new Drag(document.getElementById('_scrollblock'), '', document.getElementById('prevv')).init({
            moveCallback: function (obj) {
                $('html,body').animate({ scrollTop: ((obj.top / 260) * _h +80) }, 1);
                scrollTag = false;
                //$('#prevv').css('top', $(document).scrollTop() + $("#txtcontents").position().top);
            },
            upCallback: function () {
                scrollTag = true;
            },
            isCenter: false
        });


        $('#prevv').show();
        var acha = arrayIntersect(adds, cha);
        var dcha = arrayIntersect(dels, cha);
        if (acha.length != 0) {
            for (var i = 0; i < acha.length; i++) {
                $('#prevv').append('<div style="position: absolute;width: 100%;height: 2px;background-color: #9E9;top: ' + parseInt(acha[i] / _line * 100) + '%;"></div>')
            }
        }
        if (cha.length != 0) {
            for (var i = 0; i < cha.length; i++) {
                $('#prevv').append('<div style="position: absolute;width: 100%;height: 2px;background-color: #FD8;top: ' + parseInt(cha[i] / _line * 100) + '%;"></div>')
            }
        }
        if (dels.length != 0) {
            for (var i = 0; i < dcha.length; i++) {
                $('#prevv').append('<div style="position: absolute;width: 100%;height: 2px;background-color: #E99;top: ' + parseInt(dcha[i] / _line * 100) + '%;"></div>')
            }
        }



        $(window).off('resize').resize(function () {
            var pos = $("#txtcontents").position();
            $('#prevv').css('top', pos.top + 'px').css('left', pos.left + $("#txtcontents").width() + 20 + 'px');
        });

        $(window).off('scroll').scroll(function () {
            if (scrollTag) {
                if ($(window).scrollTop() > $('#edited_result code').offset().top) {
                    $('#_scrollblock').css('top', ($(window).scrollTop() - $('#edited_result code').offset().top) / $('#edited_result code').height() * 100 + 26 + '%');
                    if ($('#_scrollblock').position().top >= 260) {
                        $('#_scrollblock').css('top', '260px');
                    }
                } else {
                    $('#_scrollblock').css('top', '0px');
                }
            }
        });

        var scrollLeft = $('#original_result code:eq(1)');
        var scrollRight = $('#edited_result code:eq(1)');

        var _ltag = true, _rtag = true;
        scrollLeft.off('scroll').scroll(function () {
            if (_rtag) {
                _ltag = false;
                scrollRight.stop().animate({ scrollLeft: scrollLeft.scrollLeft(), scrollTop: scrollLeft.scrollTop() }, 1, function () { _ltag = true; });
            }
        });
        scrollRight.off('scroll').scroll(function () {
            if (_ltag) {
                _rtag = false;
                scrollLeft.stop().animate({ scrollLeft: scrollRight.scrollLeft(), scrollTop: scrollRight.scrollTop() }, 1, function () { _rtag = true; });
            }
        });

    }

    function arrayIntersection(a, b) {
        var ai = 0, bi = 0;
        var result = new Array();

        while (ai < a.length && bi < b.length) {
            if (a[ai] < b[bi]) { ai++; }
            else if (a[ai] > b[bi]) { bi++; }
            else /* they're equal */
            {
                result.push(a[ai]);
                ai++;
                bi++;
            }
        }

        return result;
    }
    function arrayIntersect(a, b) {
        return jQuery.merge(jQuery.grep(a, function (i) {
                return jQuery.inArray(i, b) == -1;
            }), jQuery.grep(b, function (i) {
                return jQuery.inArray(i, a) == -1;
            })
        );
    }


})()