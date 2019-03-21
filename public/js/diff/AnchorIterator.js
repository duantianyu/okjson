var SourceDiff = SourceDiff || {};

SourceDiff.AnchorIterator = function(anchors) {
    var allAnchors = anchors.all();
    var currentIndex = 0;

    var getNextEdit = function () {
        if (currentIndex + 1 < allAnchors.length) {
            currentIndex++;
            return allAnchors[currentIndex];
        }
        return false;
    };

    var getPrevEdit = function () {
        if (currentIndex - 1 >= 0) {
            currentIndex--;
            return allAnchors[currentIndex];
        }
        return false;
    };

    return {
        getNextEdit: getNextEdit,
        getPrevEdit: getPrevEdit
    };
};





/********************/

(function () {
    window.sys = {};
    var ua = navigator.userAgent.toLowerCase();
    var s;
    (s = ua.match(/msie ([\d.]+)/)) ? sys.ie = s[1] :
        (s = ua.match(/firefox\/([\d.]+)/)) ? sys.firefox = s[1] :
            (s = ua.match(/chrome\/([\d.]+)/)) ? sys.chrome = s[1] :
                (s = ua.match(/opera\/.*version\/([\d.]+)/)) ? sys.opera = s[1] :
                    (s = ua.match(/version\/([\d.]+).*safari/)) ? sys.safari = s[1] : 0;

    if (/webkit/.test(ua)) sys.webkit = ua.match(/webkit\/([\d.]+)/)[1];
})();


function Drag(obj, mover, parentElm) {
    this.obj = obj;
    this.mover = mover;
    this.ht = mover || obj;
    this.parentElm = parentElm;
}
Drag.prototype.mouseup = function (_this, e, callback) {
    e = e || window.event;
    if (_this.obj.drag) {
        _this.obj.drag = 0;
        if (sys.ie) _this.ht.releaseCapture();
        else {
            window.releaseEvents(Event.MOUSEMOVE | Event.MOUSEUP);
            e.preventDefault();
        }
        document.body.onselectstart = null;
    }
    if (callback) callback();
}
Drag.prototype.mousemove = function (_this, e, callback) {
    if (!_this.obj.drag) return;
    e = e || window.event;
    var l, t;
    if (_this.parentElm) {
        var pos = $(_this.parentElm).position();
        l = e.clientX - _this.obj._x - pos.left;
        t = e.clientY - _this.obj._y - pos.top;
    } else {
        l = e.clientX - _this.obj._x;
        t = e.clientY - _this.obj._y;
    }
    if (l < 0) l = 0;
    if (t < 0) t = 0;
    var inner;
    if (_this.parentElm) inner = { width: _this.parentElm.offsetWidth, height: _this.parentElm.offsetHeight };
    else inner = getInner();
    if (l + _this.obj.offsetWidth >= inner.width) l = inner.width - _this.obj.offsetWidth;
    if (t + _this.obj.offsetHeight >= inner.height) t = inner.height - _this.obj.offsetHeight;
    //console.log($(_this.parentElm).position().top);
    $(_this.obj).css({ left: l + "px", top: t + "px" });
    if (callback) callback({ left: l, top: t });
}
Drag.prototype.mousedown = function (_this, e, callback) {
    e = e || window.event;
    if (sys.ie) _this.ht.setCapture();
    else {
        window.captureEvents(Event.MOUSEMOVE | Event.MOUSEUP);
        e.preventDefault();
    }
    var l = getLeft(_this.obj), t = getTop(_this.obj);
    _this.obj._x = e.clientX - l;
    _this.obj._y = e.clientY - t;
    _this.obj.drag = 1;
    document.body.onselectstart = function () { return false; };
    if (callback) callback({ left: e.clientX, top: e.clientY });
}
Drag.prototype.init = function (settings) {
    var _options = {
        isCenter:true,//是否
        downCallback: null,
        moveCallback: null,
        upCallback: null
    };
    _options = $.extend(_options,settings);
    var _this = this;
    if (_options.isCenter) center(_this.obj);
    $(_this.ht).on("mousedown", function (e) { _this.mousedown(_this, e, _options.downCallback); });
    if (!sys.ie)
        _this.ht = document.body;
    $(_this.ht).on("mousemove", function (e) { _this.mousemove(_this, e, _options.moveCallback); });
    $(_this.ht).on("mouseup", function (e) { _this.mouseup(_this, e, _options.upCallback); });
    $(window).resize(function () { if (_options.isCenter) center(_this.obj); });
};


var getInner = function () {
    return {
        width: window.innerWidth || document.documentElement && document.documentElement.clientWidth || 0,
        height: window.innerHeight || document.documentElement && document.documentElement.clientHeight || 0
    }
}
var center = function (elm) {
    var inner = getInner();
    elm.style.left = ((inner.width - elm.clientWidth) / 2) + "px";
    elm.style.top = ((inner.height - elm.clientHeight) / 2) + "px";
}
var getTop = function (e) {
    var offset = e.offsetTop;
    if (e.offsetParent != null) offset += getTop(e.offsetParent);
    return offset;
}
var getLeft = function (e) {
    var offset = e.offsetLeft;
    if (e.offsetParent != null) offset += getLeft(e.offsetParent);
    return offset;
}