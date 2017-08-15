/**
 * Created by tianyu on 2017/8/15.
 */
/*
 XRegExp 0.2.5
 (c) 2007 Steven Levithan <http://stevenlevithan.com>
 MIT license

 Provides an augmented, cross-browser implementation of regular
 expressions, including support for additional flags.
 */


// Avoid name-space pollution and protect private variables through closure...
(function () {

    /* Prevent this from running more than once, which would break references
     to native globals. Implemented here rather than via an enclosing conditional
     simply because having two enclosures around most of the codebase is ugly. */
    if (window.XRegExp)
        return;

    /*
     Copy various native globals for reference. The object is named
     ``real`` since ``native`` is a reserved JavaScript keyword.
     */
    var real = {
        RegExp:  RegExp,
        exec:    RegExp.prototype.exec,
        match:   String.prototype.match,
        replace: String.prototype.replace
    };

    /*
     Regex syntax parsing with support for the necessary cross-browser
     and context issues (escapings, character classes, etc.)

     Each of the regexes match any string entirely when applied repeatedly,
     hence the nested quantifiers have no risk of causing super-linear
     backtracking despite the lack of real or mimicked atomization.
     */
    var re = {
        extended:            /(?:[^[#\s\\]+|\\(?:[\S\s]|$)|\[\^?]?(?:[^\\\]]+|\\(?:[\S\s]|$))*]?)+|(\s*#[^\n\r\u2028\u2029]*\s*|\s+)([?*+]|{[0-9]+(?:,[0-9]*)?})?/g,
        singleLine:          /(?:[^[\\.]+|\\(?:[\S\s]|$)|\[\^?]?(?:[^\\\]]+|\\(?:[\S\s]|$))*]?)+|\./g,
        characterClass:      /(?:[^\\[]+|\\(?:[\S\s]|$))+|\[\^?(]?)(?:[^\\\]]+|\\(?:[\S\s]|$))*]?/g,
        capturingGroup:      /(?:[^[(\\]+|\\(?:[\S\s]|$)|\[\^?]?(?:[^\\\]]+|\\(?:[\S\s]|$))*]?|\((?=\?))+|(\()(?:<([$\w]+)>)?/g,
        namedBackreference:  /(?:[^\\[]+|\\(?:[^k]|$)|\[\^?]?(?:[^\\\]]+|\\(?:[\S\s]|$))*]?|\\k(?!<[$\w]+>))+|\\k<([$\w]+)>([0-9]?)/g,
        replacementVariable: /(?:[^$]+|\$(?![1-9$&`']|{[$\w]+}))+|\$(?:([1-9]\d*|[$&`'])|{([$\w]+)})/g
    };

    /*** XRegExp
     Accepts a pattern and flags, returns a new, extended RegExp object.
     Differs from a native regex in that additional flags are supported
     and browser inconsistencies are ameliorated.

     - ``x`` for free-spacing and comments
     - ``s`` to cause dot to match all characters
     - ``k`` to engage named capture
     - ``(<name>...)`` to capture with ``name``
     - ``\k<name>`` for a backreference to ``name`` inside the regex
     - ``${name}`` for a backreference to ``name`` inside a replacement string
     - backreferences stored in ``result.name`` or ``arguments[0].name``
     */
    XRegExp = function (pattern, flags) {
        flags = flags || "";

        if (flags.indexOf("x") > -1) {
            pattern = real.replace.call(pattern, re.extended, function ($0, $1, $2) {
                // Keep backreferences separate from subsequent tokens unless the token is a quantifier
                return $1 ? ($2 || "(?:)") : $0;
            });
        }

        var hasNamedCapture = false;
        if (flags.indexOf("k") > -1) {
            var captureNames = [];
            pattern = real.replace.call(pattern, re.capturingGroup, function ($0, $1, $2) {
                if ($1) {
                    if ($2) hasNamedCapture = true;
                    captureNames.push($2 || null);
                    return "(";
                } else {
                    return $0;
                }
            });
            if (hasNamedCapture) {
                // Replace named with numbered backreferences
                pattern = real.replace.call(pattern, re.namedBackreference, function ($0, $1, $2) {
                    var index = $1 ? captureNames.indexOf($1) : -1;
                    // Keep backreferences separate from subsequent literal numbers
                    return index > -1 ? "\\" + (index + 1) + ($2 ? "(?:)" + $2 : "") : $0;
                });
            }
        }

        /*
         If ] is the leading character in a character class, replace it with \] for consistent cross-
         browser handling. This is needed to maintain correctness without browser sniffing when
         constructing the regexes which deal with character classes. They treat a leading ] within a
         character class as a non-terminating, literal character, which is consistent with IE, Safari,
         Perl, PCRE, .NET, Python, Ruby, JGsoft, and most other regex flavors.
         */
        pattern = real.replace.call(pattern, re.characterClass, function ($0, $1) {
            return $1 ? real.replace.call($0, "]", "\\]") : $0;
        });

        if (flags.indexOf("s") > -1) {
            pattern = real.replace.call(pattern, re.singleLine, function ($0) {
                return $0 === "." ? "[\\S\\s]" : $0;
            });
        }

        var regex = real.RegExp(pattern, real.replace.call(flags, /[sxk]+/g, ""));
        if (hasNamedCapture)
            regex._captureNames = captureNames;
        return regex;
    };

    /*
     Returns a new XRegExp object generated by recompiling the regex with the additional flags,
     which may include non-native flags. The original regex object is not altered.
     */
    RegExp.prototype.addFlags = function (flags) {
        flags = (flags || "") + (this.global ? "g" : "") + (this.ignoreCase ? "i" : "") + (this.multiline ? "m" : "");
        var regex = new XRegExp(this.source, flags);
        // Preserve capture names if adding flags to a regex which has already had capture names attached
        if (!regex._captureNames && this._captureNames)
            regex._captureNames = this._captureNames.slice(0);
        return regex;
    };

    RegExp.prototype.exec = function (str) {
        var result = real.exec.call(this, str);
        if (!(this._captureNames && result && result.length > 1))
            return result;
        for (var i = 1; i < result.length; i++) {
            var name = this._captureNames[i - 1];
            if (name)
                result[name] = result[i];
        }
        return result;
    };

    String.prototype.match = function (regex) {
        if (!regex._captureNames || regex.global)
            return real.match.call(this, regex);
        // Run the overriden exec method
        return regex.exec(this);
    };

    String.prototype.replace = function (search, replacement) {
        // If search is not a regex which uses named capturing groups, use the native replace method
        if (!(search instanceof real.RegExp && search._captureNames))
            return real.replace.apply(this, arguments);

        if (typeof replacement === "function") {
            return real.replace.call(this, search, function () {
                // Convert arguments[0] from a string primitive to a String object which can store properties
                arguments[0] = new String(arguments[0]);
                // Store named backreferences on arguments[0] before calling replacement
                for (var i = 0; i < search._captureNames.length; i++) {
                    if (search._captureNames[i])
                        arguments[0][search._captureNames[i]] = arguments[i + 1];
                }
                /* The context object ``this`` is set to the global context ``window`` as it should be with stand-
                 alone anonymous functions, although it's unlikely to be used within a replacement function. */
                return replacement.apply(window, arguments);
            });
        } else {
            return real.replace.call(this, search, function () {
                var args = arguments;
                return real.replace.call(replacement, re.replacementVariable, function ($0, $1, $2) {
                    // Numbered backreference or special variable
                    if ($1) {
                        switch ($1) {
                            case "$": return "$";
                            case "&": return args[0];
                            case "`": return args[args.length - 1].slice(0, args[args.length - 2]);
                            case "'": return args[args.length - 1].slice(args[args.length - 2] + args[0].length);
                            // Numbered backreference
                            default:
                                /* What does "$10" mean?
                                 - Backreference 10, if 10 or more capturing groups exist
                                 - Backreference 1 followed by "0", if 1-9 capturing groups exist
                                 - Otherwise, it's the string "$10" */
                                var literalNumbers = "";
                                $1 = +$1; // Cheap type-conversion
                                while ($1 > search._captureNames.length) {
                                    literalNumbers = $1.split("").pop() + literalNumbers;
                                    $1 = Math.floor($1 / 10); // Drop the last digit
                                }
                                return ($1 ? args[$1] : "$") + literalNumbers;
                        }
                        // Named backreference
                    } else if ($2) {
                        /* What does "${name}" mean?
                         - Backreference to named capture "name", if it exists
                         - Otherwise, it's the string "${name}" */
                        var index = search._captureNames.indexOf($2);
                        return index > -1 ? args[index + 1] : $0;
                    } else {
                        return $0;
                    }
                });
            });
        }
    };

})();
// ...End anonymous function

/*
 Accepts a pattern and flags, returns a new XRegExp object. If the regex has
 previously been cached, returns the cached copy, otherwise the new object is
 cached.
 */
XRegExp.cache = function (pattern, flags) {
    var key = "/" + pattern + "/" + (flags || "");
    return XRegExp.cache[key] || (XRegExp.cache[key] = new XRegExp(pattern, flags));
};

/*
 Overrides the global RegExp constructor/object with the XRegExp constructor.
 This precludes accessing the deprecated properties of the last match on the
 global RegExp object. It also changes the result of ``(/x/.constructor ==
 RegExp)`` and ``(/x/ instanceof RegExp)``, so use with caution.
 */
XRegExp.overrideNative = function () {
    RegExp = XRegExp;
};

if (!Array.prototype.indexOf) {
    // JavaScript 1.6 compliant indexOf from MooTools 1.11; MIT License
    Array.prototype.indexOf = function (item, from) {
        var len = this.length;
        for (var i = (from < 0) ? Math.max(0, len + from) : from || 0; i < len; i++) {
            if (this[i] === item)
                return i;
        }
        return -1;
    };
}


/*
 Helper functions for RegexPal
 (c) 2007 Steven Levithan <http://stevenlevithan.com>
 MIT license
 */

function q (el) {
    if (el.nodeName) return el;
    if (typeof el === "string") return document.getElementById(el);
    return false;
};

var trim = function () {
    // See <http://blog.stevenlevithan.com/archives/faster-trim-javascript>
    var	lSpace = /^\s\s*/,
        rSpace = /\s\s*$/;
    return function (str) {
        return str.replace(lSpace, "").replace(rSpace, "");
    };
}();

// This is much faster than simple use of innerHTML in some browsers
// See <http://blog.stevenlevithan.com/archives/faster-than-innerhtml>
function replaceHtml (el, html) {
    var oldEl = q(el);
    /*@cc_on // Pure innerHTML is slightly faster in IE
     oldEl.innerHTML = html;
     return oldEl;
     @*/
    var newEl = oldEl.cloneNode(false);
    newEl.innerHTML = html;
    oldEl.parentNode.replaceChild(newEl, oldEl);
    /* Since we just removed the old element from the DOM, return a reference
     to the new element, which can be used to restore variable references. */
    return newEl;
};

/* outerHTML is used to work around the fact that IE applies text normalization when using innerHTML,
 which can cause problems with whitespace, etc. Note that even this approach doesn't work with some
 elements such as <div>. However, it mostly works with <pre> elements, at least. */
function replaceOuterHtml (el, html) {
    el = replaceHtml(el, "");
    if (el.outerHTML) { // If IE
        var	id = el.id,
            className = el.className,
            nodeName = el.nodeName;
        el.outerHTML = "<" + nodeName + " id=\"" + id + "\" class=\"" + className + "\">" + html + "</" + nodeName + ">";
        el = q(id); // Reassign, since we just overwrote the element in the DOM
    } else {
        el.innerHTML = html;
    }
    return el;
};

// Return an array of all elements with a specified class name, optionally filtered by tag name and parent
function getElementsByClassName (className, tagName, parentNode) {
    var	els = (q(parentNode) || document).getElementsByTagName(tagName || "*"),
        results = [];
    for (var i = 0; i < els.length; i++) {
        if (hasClass(className, els[i])) results.push(els[i]);
    }
    return results;
};

function hasClass (className, el) {
    /* It might not make sense to cache all regexes in a more widely used hasClass function,
     but RegexPal uses it with a small number of classes so there is little memory overhead. */
    return XRegExp.cache("(?:^|\\s)" + className + "(?:\\s|$)").test(q(el).className);
};

function addClass (className, el) {
    el = q(el);
    if (!hasClass(className, el)) {
        el.className = trim(el.className + " " + className);
    }
};

function removeClass (className, el) {
    el = q(el);
    el.className = trim(el.className.replace(XRegExp.cache("(?:^|\\s)" + className + "(?:\\s|$)", "g"), " "));
};

function toggleClass (className, el) {
    if (hasClass(className, el)) {
        removeClass(className, el);
    } else {
        addClass(className, el);
    }
};

function swapClass (oldClass, newClass, el) {
    removeClass(oldClass, el);
    addClass(newClass, el);
};

function replaceSelection (textbox, str) {
    if (textbox.setSelectionRange) {
        var	start = textbox.selectionStart,
            end = textbox.selectionEnd,
            offset = (start + str.length);
        textbox.value = (textbox.value.substring(0, start) + str + textbox.value.substring(end));
        textbox.setSelectionRange(offset, offset);
    } else if (document.selection) { // If IE (Opera has setSelectionRange and Selection objects)
        var range = document.selection.createRange();
        range.text = str;
        range.select();
    }
};

function extend (to, from) {
    for (var property in from) to[property] = from[property];
    return to;
};

// purge by Douglas Crockford <http://javascript.crockford.com/memory/leak.html>
function purge (d) {
    var a = d.attributes, i, l, n;
    if (a) {
        l = a.length;
        for (i = 0; i < l; i += 1) {
            n = a[i].name;
            if (typeof d[n] === 'function') {
                d[n] = null;
            }
        }
    }
    a = d.childNodes;
    if (a) {
        l = a.length;
        for (i = 0; i < l; i += 1) {
            purge(d.childNodes[i]);
        }
    }
};

// Sniff
var	isWebKit = navigator.userAgent.indexOf("WebKit") > -1,
    isIE /*@cc_on = true @*/,
    isIE6 /*@cc_on = @_jscript_version < 5.7 @*/; // Despite the variable name, this means if IE lower than v7

// RegexPal also needs an Array.prototype.indexOf method, but it's provided by XRegExp



/*
 RegexPal 0.1.4
 (c) 2007 Steven Levithan <http://stevenlevithan.com>
 GNU LGPL 3.0 license
 */


//---------------------------------------------------------------------+
// The RegexPal namespace
//---------------------------------------------------------------------+

var RegexPal = {
    /* Store DOM node references for quick lookup */
    fields: {
        search: new SmartField("search"),
        input:  new SmartField("input"),
        options: {
            flags: {
                g: q("flagG"),
                i: q("flagI"),
                m: q("flagM"),
                s: q("flagS")
            },
            highlightSyntax:  q("highlightSyntax"),
            highlightMatches: q("highlightMatches"),
            invertMatches:    q("invertMatches")
        }
    }
};

extend(RegexPal, function () {
    // Make property shortcuts available to all methods of the returned object through closure...
    var	f = RegexPal.fields,
        o = f.options;

    return {
        highlightMatches: function () {
            // Cache the regexes through closure...
            var re = {
                /* If the matchPair regex seems a little crazy, the theory behind it is that it will be faster than using lazy quantification */
                matchPair: /`~\{((?:[^}]+|\}(?!~`))*)\}~`((?:[^`]+|`(?!~\{(?:[^}]+|\}(?!~`))*\}~`))*)(?:`~\{((?:[^}]+|\}(?!~`))*)\}~`)?/g,
                sansTrailingAlternator: /^(?:[^\\|]+|\\[\S\s]?|\|(?=[\S\s]))*/
            };

            return function () {
                var	search = String(f.search.textbox.value),
                    input  = String(f.input.textbox.value);

                /* Abort if the user's regex contains an error (the test regex accounts for IE's changes to innerHTML).
                 The syntax highlighting catches a number of mistakes and cross-browser issues which might not cause the
                 browser to throw an error. Also abort if the search is empty and not using the invert results option, or
                 if match highlighting is disabled. */
                if (
                    XRegExp.cache('<[bB] class="?err"?>').test(f.search.bg.innerHTML) ||
                    (!search.length && !o.invertMatches.checked) ||
                    !o.highlightMatches.checked
                ) {
                    f.input.clearBg();
                    return;
                }

                try {
                    /* If existing, a single trailing vertical bar (|) is removed from the regex which is to be applied
                     to the input text. This behavior is copied from RegexBuddy, and offers faster results and a less
                     surprising experience while the user is in the middle of creating a regex. */
                    var searchRegex = new XRegExp(re.sansTrailingAlternator.exec(search)[0],
                        (o.flags.g.checked ? "g" : "") +
                        (o.flags.i.checked ? "i" : "") +
                        (o.flags.m.checked ? "m" : "") +
                        (o.flags.s.checked ? "s" : "")
                    );
                    /* An error should never be thrown if syntax highlighting and XRegExp are working correctly, but the
                     potential is avoided nonetheless. Safari in particular has several strange bugs which cause its regex
                     engine's parser to barf during compilation. */
                } catch (err) {
                    f.input.clearBg();
                    return;
                }

                // Matches are never looped over, for performance reasons...

                /* Initially, "`~{...}~`" is used as a safe string to encapsulate matches. Note that if such an
                 unlikely sequence appears in the text, you might receive incorrect results. */
                if (o.invertMatches.checked) {
                    var output = ("`~{" +
                    input.replace(searchRegex, "}~`$&`~{") +
                    "}~`")
                    /* Remove zero-length matches, and combine adjacent matches */
                        .replace(XRegExp.cache("`~\\{\\}~`|\\}~``~\\{", "g"), "");
                } else {
                    var output = input.replace(searchRegex, "`~{$&}~`");
                }
                /* Put all matches within alternating <b> and <i> elements (short element names speed up markup
                 generation). Angled brackets and ampersands are first replaced, to avoid unintended HTML markup
                 within the background <pre> element. */
                output = output
                    .replace(XRegExp.cache("[<&>]", "g"), "_")
                    .replace(re.matchPair, "<b>$1</b>$2<i>$3</i>");

                f.input.setBgHtml(output);
            };
        }(),

        highlightSearchSyntax: function () {
            if (o.highlightSyntax.checked) {
                f.search.setBgHtml(parseRegex(f.search.textbox.value));
            } else {
                f.search.clearBg();
            }
        },

        permalink: function () {
            var	flagsStr = (o.flags.i.checked ? "i" : "") + (o.flags.m.checked ? "m" : "") + (o.flags.s.checked ? "s" : ""),
                regexStr = encodeURIComponent(f.search.textbox.value),
                inputStr = encodeURIComponent(f.input.textbox.value);

            location = "./?flags=" + flagsStr + "&regex=" + regexStr + "&input=" + inputStr;
        }
    };
}());


//---------------------------------------------------------------------+
// parseRegex
//---------------------------------------------------------------------+

var parseRegex = function () {
    /* Even for JavaScript's relatively simple flavor, regex syntax parsing is complicated
     (IMO more so than for e.g. CSS or HTML), partly due to the many backwards and forwards
     context-sensitivity issues. This code is tailored for RegexPal's needs (e.g., no
     representative object is constructed). */

    // Cache through closure...
    //------------------------------------------------------->
    var	re = {
            regexToken:          /\[\^?]?(?:[^\\\]]+|\\[\S\s]?)*]?|\\(?:0(?:[0-3][0-7]{0,2}|[4-7][0-7]?)?|[1-9][0-9]*|x[0-9A-Fa-f]{2}|u[0-9A-Fa-f]{4}|c[A-Za-z]|[\S\s]?)|\((?:\?[:=!]?)?|(?:[?*+]|\{[0-9]+(?:,[0-9]*)?\})\??|[^.?*+^${[()|\\]+|./g,
            characterClassParts: /^(<opening>\[\^?)(<contents>]?(?:[^\\\]]+|\\[\S\s]?)*)(<closing>]?)$/.addFlags("k"),
            characterClassToken: /[^\\-]+|-|\\(?:[0-3][0-7]{0,2}|[4-7][0-7]?|x[0-9A-Fa-f]{2}|u[0-9A-Fa-f]{4}|c[A-Za-z]|[\S\s]?)/g,
            quantifier:          /^(?:[?*+]|\{[0-9]+(?:,[0-9]*)?\})\??$/
        },
        type = {
            NONE:         0,
            RANGE_HYPHEN: 1,
            METACLASS:    2,
            ALTERNATOR:   3
        };

    function errorStr (str) {
        return '<b class="err">' + str + '</b>';
    };

    function getTokenCharCode (token) {
        /* This currently only supports tokens used within regex character classes,
         since that's all it's needed for. */

        // Escape sequence
        if (token.length > 1 && token.charAt(0) === "\\") {
            var t = token.slice(1);
            // Control character
            if (XRegExp.cache("^c[A-Za-z]$").test(t)) {
                return "ABCDEFGHIJKLMNOPQRSTUVWXYZ".indexOf(t.charAt(1).toUpperCase()) + 1;
                // Two or four digit hexadecimal character code
            } else if (XRegExp.cache("^(?:x[0-9A-Fa-f]{2}|u[0-9A-Fa-f]{4})$").test(t)) {
                return parseInt(t.slice(1), 16);
                // One to three digit octal character code up to 377 (hex FF)
            } else if (XRegExp.cache("^(?:[0-3][0-7]{0,2}|[4-7][0-7]?)$").test(t)) {
                return parseInt(t, 8);
                // Metaclass or incomplete token
            } else if (t.length === 1 && "cuxDdSsWw".indexOf(t) > -1) {
                return false;
                // Metacharacter representing a single character index, or escaped literal character
            } else if (t.length === 1) {
                switch (t) {
                    case "b": return 8;  // backspace
                    case "f": return 12; // form feed
                    case "n": return 10; // line feed
                    case "r": return 13; // carriage return
                    case "t": return 9;  // horizontal tab
                    case "v": return 11; // vertical tab
                    default : return t.charCodeAt(0); // escaped literal character
                }
            }
            // Unescaped literal token(s)
        } else if (token !== "\\") {
            return token.charCodeAt(0);
        }
        return false;
    };

    function parseCharacterClass (value) {
        /* Character classes have their own syntax rules which are different (sometimes quite subtly)
         from surrounding regex syntax. Hence, they're treated as a single token and parsed separately. */

        var	output    = "",
            parts     = re.characterClassParts.exec(value),
            parser    = re.characterClassToken,
            lastToken = {
                rangeable: false,
                type: type.NONE
            },
            match, m;

        output += parts.closing ? parts.opening : errorStr(parts.opening);

        // The characterClassToken regex does most of the tokenization grunt work
        while (match = parser.exec(parts.contents)) {
            m = match[0];
            // Escape
            if (m.charAt(0) === "\\") {
                /* Inside character classes, browsers differ on how they handle the following:
                 - Any representation of character index zero (\0, \00, \000, \x00, \u0000)
                 - "\c", when not followed by A-Z or a-z
                 - "\x", when not followed by two hex characters
                 - "\u", when not followed by four hex characters
                 However, although representations of character index zero within character classes don't work on their
                 own in Firefox, they don't throw an error, they work when used with ranges, and it's highly unlikely
                 that the user will actually have such a character in their test data, so such tokens are highlighted
                 normally. The remaining metasequences are flagged as errors. */
                if (XRegExp.cache("^\\\\[cux]$").test(m)) {
                    output += errorStr(m);
                    lastToken = {rangeable: lastToken.type !== type.RANGE_HYPHEN};
                    // Metaclass (matches more than one character index)
                } else if (XRegExp.cache("^\\\\[dsw]$", "i").test(m)) {
                    output += "<b>" + m + "</b>";
                    /* Traditional regex behavior is that a metaclass should be unrangeable (RegexPal terminology).
                     Hence, [-\dz], [\d-z], and [z-\d] should all be equivalent. However, at least some browsers
                     handle this inconsistently. E.g., Firefox 2 throws an invalid range error for [z-\d] and [\d--]. */
                    lastToken = {
                        rangeable: lastToken.type !== type.RANGE_HYPHEN,
                        type: type.METACLASS
                    };
                    // Unescaped "\" at the end of the regex
                } else if (m === "\\") {
                    output += errorStr(m);
                    // Metasequence representing a single character index, or escaped literal character
                } else {
                    output += "<b>" + m.replace(XRegExp.cache("[<&>]"), "_") + "</b>";
                    lastToken = {
                        rangeable: lastToken.type !== type.RANGE_HYPHEN,
                        charCode: getTokenCharCode(m)
                    };
                }
                // Hyphen (might indicate a range)
            } else if (m === "-") {
                if (lastToken.rangeable) {
                    // Save the regex's lastIndex so we can reset it after checking the next token
                    var	lastIndex = parser.lastIndex,
                        nextToken = parser.exec(parts.contents);

                    if (nextToken) {
                        var nextTokenCharCode = getTokenCharCode(nextToken[0]);
                        // Hypen for a reverse range (e.g., z-a) or metaclass (e.g., \d-x or x-\S)
                        if (
                            (nextTokenCharCode !== false && lastToken.charCode > nextTokenCharCode) ||
                            lastToken.type === type.METACLASS ||
                            XRegExp.cache("^\\\\[dsw]$", "i").test(nextToken[0])
                        ) {
                            output += errorStr("-");
                            // Hyphen creating a valid range
                        } else {
                            output += "<u>-</u>";
                        }
                        lastToken = {
                            rangeable: false,
                            type: type.RANGE_HYPHEN
                        };
                    } else {
                        // Hyphen at the end of a properly closed character class (literal character)
                        if (parts.closing) {
                            output += "-"; // Since this is a literal, it's technically "rangeable," but that doesn't matter
                            // Hyphen at the end of an unclosed character class (i.e., the end of the regex)
                        } else {
                            //output += errorStr("-"); // Previous RB handling
                            output += "<u>-</u>";
                            break; // Might as well break
                        }
                    }

                    // Reset the regex's lastIndex so the next while loop iteration will continue appropriately
                    parser.lastIndex = lastIndex;
                    // Hyphen at the beginning of a character class or after a non-rangeable token
                } else {
                    output += "-";
                    lastToken = {rangeable: lastToken.type !== type.RANGE_HYPHEN};
                }
                // Literal character sequence
            } else {
                output += m.replace(XRegExp.cache("[<&>]", "g"), "_");
                lastToken = {
                    rangeable: (m.length > 1 || lastToken.type !== type.RANGE_HYPHEN),
                    charCode: m.charCodeAt(m.length - 1)
                };
            }
        } // End characterClassToken loop

        return output + parts.closing;
    };
    // ...End cache through closure
    //<-------------------------------------------------------


    return function (value) {
        var	output              = "",
            capturingGroupCount = 0,
            groupStyleDepth     = 0,
            openGroups          = [],
            lastToken = {
                quantifiable: false,
                type: type.NONE
            },
            match, m;

        function groupStyleStr (str) {
            return '<b class="g' + groupStyleDepth + '">' + str + '</b>';
        };

        // The regexToken regex does most of the tokenization grunt work
        while (match = re.regexToken.exec(value)) {
            m = match[0];
            switch (m.charAt(0)) {
                // Character class
                case "[":
                    output += "<i>" + parseCharacterClass(m) + "</i>";
                    lastToken = {quantifiable: true};
                    break;
                // Group opening
                case "(":
                    // If this is an invalid group type, mark the error and don't count it towards group depth or total count
                    if (m.length === 2) { // m is "(?"
                        output += errorStr(m);
                    } else {
                        if (m.length === 1) capturingGroupCount++;
                        groupStyleDepth = groupStyleDepth === 5 ? 1 : groupStyleDepth + 1;
                        /* Record the group opening's position and character sequence so we can later mark it as invalid if
                         it turns out to be unclosed in the remainder of the regex. The value of index is the position plus
                         the length of the opening <b> element with group class ('<b class="gN">'.length). */
                        openGroups.push({
                            index:   output.length + 14,
                            opening: m
                        });
                        // Add markup to the group-opening character sequence
                        output += groupStyleStr(m);
                    }
                    lastToken = {quantifiable: false};
                    break;
                // Group closing
                case ")":
                    // If this is an invalid group closing
                    if (!openGroups.length) {
                        output += errorStr(")");
                        lastToken = {quantifiable: false};
                    } else {
                        output += groupStyleStr(")");
                        /* Although at least in some browsers it is possible to quantify lookaheads, this adds no value
                         and is an error with some regex flavors such as PCRE, so flag them as unquantifiable. */
                        lastToken = {
                            quantifiable: !XRegExp.cache("^[=!]").test(openGroups[openGroups.length - 1].opening.charAt(2)),
                            style:        "g" + groupStyleDepth
                        };
                        groupStyleDepth = groupStyleDepth === 1 ? 5 : groupStyleDepth - 1;
                        // Drop the last opening paren from depth tracking
                        openGroups.pop();
                    }
                    break;
                // Escape or backreference
                case "\\":
                    // Backreference or octal character code without a leading zero
                    if (XRegExp.cache("^[1-9]").test(m.charAt(1))) {
                        /* What does "\10" mean?
                         - Backreference 10, if 10 or more capturing groups were opened before this point.
                         - Backreference 1 followed by "0", if 1-9 capturing groups were opened before this point.
                         - Otherwise, it's octal character index 10 (since 10 is inside the octal range 0-377).

                         In the case of \8 or \9 when as many capturing groups weren't opened before this point, they're
                         highlighted as special tokens. However, they should probably be marked as errors since the handling
                         is browser-specific. E.g., in Firefox 2 they seem to be equivalent to "(?!)", while in IE 7 they
                         match the literal characters "8" and "9", which is correct handling. I don't mark them as errors
                         because it would seem inconsistent to users who don't understand the highlighting rules for octals,
                         etc. In fact, octals are not included in ECMA-262v3, but since all the big browsers support them
                         and RegexPal does not implement its own regex engine, it needs to highlight the regex as the
                         browsers interpret them. */
                        var	nonBackrefDigits = "",
                            num = +m.slice(1);
                        while (num > capturingGroupCount) {
                            nonBackrefDigits = XRegExp.cache("[0-9]$").exec(num)[0] + nonBackrefDigits;
                            num = Math.floor(num / 10); // Drop the last digit
                        }
                        if (num > 0) {
                            output += "<b>\\" + num + "</b>" + nonBackrefDigits;
                        } else {
                            var parts = XRegExp.cache("^\\\\([0-3][0-7]{0,2}|[4-7][0-7]?|[89])([0-9]*)").exec(m);
                            output += "<b>\\" + parts[1] + "</b>" + parts[2];
                        }
                        // Metasequence
                    } else if (XRegExp.cache("^[0bBcdDfnrsStuvwWx]").test(m.charAt(1))) {
                        /* Browsers differ on how they handle:
                         - "\c", when not followed by A-Z or a-z
                         - "\x", when not followed by two hex characters
                         - "\u", when not followed by four hex characters
                         Hence, such metasequences are flagged as errors. */
                        if (XRegExp.cache("^\\\\[cux]$").test(m)) {
                            output += errorStr(m);
                            lastToken = {quantifiable: false};
                            break;
                        }
                        output += "<b>" + m + "</b>";
                        // Non-quantifiable metasequence
                        if ("bB".indexOf(m.charAt(1)) > -1) {
                            lastToken = {quantifiable: false};
                            break;
                        }
                        // Unescaped "\" at the end of the regex
                    } else if (m === "\\") {
                        output += errorStr(m);
                        // Escaped literal character
                    } else {
                        output += m.replace(XRegExp.cache("[<&>]"), "_");
                    }
                    lastToken = {quantifiable: true};
                    break;
                // Not a character class, group opening/closing, escape sequence, or backreference
                default:
                    // Quantifier
                    if (re.quantifier.test(m)) {
                        if (lastToken.quantifiable) {
                            var interval = XRegExp.cache("^\\{([0-9]+)(?:,([0-9]*))?").exec(m);
                            // Interval quantifier in reverse numeric order or out of range
                            if (interval &&
                                (
                                    (interval[1] > 65535) ||
                                    (
                                        interval[2] &&
                                        ((interval[2] > 65535) || (+interval[1] > +interval[2]))
                                    )
                                )
                            ) {
                                output += errorStr(m);
                            } else {
                                // Quantifiers for groups are shown in the style of the (preceeding) group's depth
                                output += (lastToken.style ? '<b class="' + lastToken.style + '">' : '<b>') + m + '</b>';
                            }
                        } else {
                            output += errorStr(m);
                        }
                        lastToken = {quantifiable: false};
                        // Vertical bar (alternator)
                    } else if (m === "|") {
                        /* If there is a vertical bar at the very start of the regex, flag it as an error since it
                         effectively truncates the regex at that point. If two top-level vertical bars are next to
                         each other, flag it as an error for similar reasons. These behaviors copied from RegexBuddy. */
                        if (lastToken.type === type.NONE || (lastToken.type === type.ALTERNATOR && !openGroups.length)) {
                            output += errorStr(m);
                        } else {
                            // Alternators within groups are shown in the style of the (containing) group's depth
                            output += openGroups.length ? groupStyleStr("|") : "<b>|</b>";
                        }
                        lastToken = {
                            quantifiable: false,
                            type: type.ALTERNATOR
                        };
                        // ^ or $ anchor
                    } else if ("^$".indexOf(m) > -1) {
                        output += "<b>" + m + "</b>";
                        lastToken = {quantifiable: false};
                        // Dot (.)
                    } else if (m === ".") {
                        output += "<b>.</b>";
                        lastToken = {quantifiable: true};
                        // Literal character sequence
                    } else {
                        output += m.replace(XRegExp.cache("[<&>]", "g"), "_");
                        lastToken = {quantifiable: true};
                    }
                // End default case
            } // End switch m.charAt(0)
        } // End regexToken loop

        // Mark the opening character sequence for each unclosed grouping as invalid
        var numCharsAdded = 0;
        for (var i = 0; i < openGroups.length; i++) {
            var errorIndex = openGroups[i].index + numCharsAdded;
            output = (
                output.slice(0, errorIndex) +
                errorStr(openGroups[i].opening) +
                output.slice(errorIndex + openGroups[i].opening.length)
            );
            numCharsAdded += errorStr("").length;
        }

        return output;
    };
}();


//---------------------------------------------------------------------+
// SmartField
//---------------------------------------------------------------------+

/* SmartField is my name for the rich text boxes RegexPal creates, which
 are essentially <div> container elements enclosing <textarea> elements
 on top of <pre> elements, combined with some CSS and JavaScript to
 facilitate seemless scrolling (the only scrollbar actually belongs to the
 container). The code for smart fields is occasionally browser-specific
 and is extremely hacky in general. However, it offers major speed
 benefits over traditional JavaScript-based rich text editors, although
 with more limited capabilities. */

function SmartField (el) {
    el = q(el);
    /* The <textarea> element already exists for graceful-degradation reasons.
     Not that RegexPal would work at all without JavaScript, but whatever. */
    var	textboxEl = el.getElementsByTagName("textarea")[0],
        bgEl      = document.createElement("pre");

    textboxEl.id = el.id + "Text";
    bgEl.id      = el.id + "Bg";
    el.insertBefore(bgEl, textboxEl);

    // TODO: Augment SmartField key events per field, rather than using de-facto global handlers
    textboxEl.onkeydown = function (e) {SmartField.prototype._onKeyDown(e);};
    textboxEl.onkeyup   = function (e) {SmartField.prototype._onKeyUp(e);};

    // Avoid unnecessary horizontal scollbars in IE, which wraps long words differently than Firefox
    if (isIE) el.style.overflowX = "hidden";
    // Turn off spellcheck for Firefox
    if (textboxEl.spellcheck) textboxEl.spellcheck = false;
    /* Safari 3 beta starts textarea contents three pixels from the left, and this cannot be removed
     by setting CSS padding or margin attributes to zero. */
    //if (isWebKit) textboxEl.style.marginLeft = "-3px";

    this.field = el;
    this.textbox = textboxEl;
    this.bg = bgEl;
};

extend(SmartField.prototype, {
    setBgHtml: function (html) {
        // Workaround an IE text-normaliztion bug where a leading newline is removed (causing highlighting to be misaligned)
        if (isIE) html = html.replace(XRegExp.cache("^\\r\\n"), "\r\n\r\n");
        // The trailing characters improve seemless scrolling
        this.bg = replaceOuterHtml(this.bg, html + "<br>&nbsp;");
        this.setDimensions();
    },

    clearBg: function () {
        this.setBgHtml(this.textbox.value.replace(XRegExp.cache("[<&>]", "g"), "_"));
    },

    setDimensions: function () {
        /* Set the width of the textarea to its scrollWidth. Note that although the background content autoexpands, its
         offsetWidth isn't dynamically updated as is its offsetHeight (at least in Firefox 2). The pixel adjustments avoid
         an unnecessary horizontal scrollbar and keep the last character to the right in view when the container element
         has a horizontal scrollbar. */
        this.textbox.style.width = "";
        var	scrollWidth = this.textbox.scrollWidth,
            offsetWidth = this.textbox.offsetWidth;

        //this.textbox.style.width = (scrollWidth === offsetWidth ? offsetWidth - 1 : scrollWidth) + "px";

        /* Set the height of the absolute-positioned textarea to its background content's offsetHeight. Since the background
         content autoexpands, this allows the elements to be scrolled simultaneously using the parent element's scrollbars.
         Setting it to textbox.scrollHeight instead of bg.offsetHeight would also work, but that would require us to first
         blank style.height. It would also prevent us from improving seemless scrolling by adding trailing characters to the
         background content (which is done outside this method) before testing its height. Comparing bg.offsetHeight to the
         container's offsetHeight (minus 2 for borders) is done for the sake of IE6, since CSS min-height doesn't work there. */
        //this.textbox.style.height = Math.max(this.bg.offsetHeight, this.field.offsetHeight - 2) + "px";
    },

    _onKeyDown: function (e) {
        e = e || event;
        if (!this._filterKeys(e)) return false;
        var srcEl = e.srcElement || e.target;
        switch (srcEl) {
            case RegexPal.fields.search.textbox:
                // Since the textbox's value doesn't change until the keydown event finishes, run the match after 0ms
                setTimeout(function () {RegexPal.highlightSearchSyntax.call(RegexPal);}, 0);
                break;
            // There might be other elements to handle in the future (e.g., replacement)
        }
        /* Scrolling works automatically in IE and Firefox. A bug with Opera's scrollHeight causes height to go wonky
         if we use it repeatedly as below, so this is only for WebKit. Compared to real autoscrolling, this is an
         incomplete patch job, as it only scrolls when the cursor is at the end of the text. */
        if (isWebKit && srcEl.selectionEnd === srcEl.value.length) {
            srcEl.parentNode.scrollTop = srcEl.scrollHeight;
        }
        this._testKeyHold(e);
    },

    _onKeyUp: function (e) {
        e = e || event;
        var srcEl = e.srcElement || e.target;
        this._keydownCount = 0; // Reset
        if (this._matchOnKeyUp) {
            this._matchOnKeyUp = false; // Reset
            switch (srcEl) {
                case RegexPal.fields.search.textbox: // fallthru
                case RegexPal.fields.input.textbox:
                    RegexPal.highlightMatches();
                    break;
                // There might be other elements to handle in the future
            }
        }
    },

    _testKeyHold: function (e) {
        var srcEl = e.srcElement || e.target;
        this._keydownCount++;
        /* If this is the third keydown before a keyup fires, remove real-time matches until keyup. Allowing a
         couple keydowns before removing the matches offers a balanace between reducing performance issues when
         holding down keys, and keeping performance up for fast typists. */
        if (this._keydownCount > 2) {
            RegexPal.fields.input.clearBg();
            this._matchOnKeyUp = true;
        } else {
            /* Since we're running this on keydown but the textbox's value doesn't change until code for the
             event finishes, run the match after 0ms as a workaround. */
            switch (srcEl) {
                case RegexPal.fields.search.textbox: // fallthru
                case RegexPal.fields.input.textbox:
                    setTimeout(function () {RegexPal.highlightMatches.call(RegexPal);}, 0);
                    break;
                // There might be other elements to handle in the future
            }
        }
    },

    _filterKeys: function (e) {
        var	srcEl = e.srcElement || e.target,
            f = RegexPal.fields;

        // If the user pressed a key which does not change the input, return false to prevent running a match
        if (this._deadKeys.indexOf(e.keyCode) > -1)
            return false;

        // If the user pressed tab (keyCode 9) in the search or input fields, override the default behavior
        if ((e.keyCode === 9) && (srcEl === f.input.textbox || (srcEl === f.search.textbox && !e.shiftKey))) {
            /* Moving focus between the search and input fields can't be reliably achieved in
             Firefox using tabindex alone because of how the markup is structured */

            if (srcEl === f.input.textbox) {
                if (e.shiftKey) {
                    f.search.textbox.focus();
                } else {
                    // Insert a tab character, overwriting any selected text
                    replaceSelection(srcEl, "\t");
                    // Opera's tabbing mechanism fires before keydown, so bring back the focus
                    if (window.opera)
                        setTimeout(function () {srcEl.focus();}, 0);
                }
            } else {
                f.input.textbox.focus();
            }

            if (e.preventDefault) e.preventDefault();
            else e.returnValue = false;
        }

        return true;
    },

    _matchOnKeyUp: false,
    _keydownCount: 0,
    _deadKeys: [16,17,18,19,20,27,33,34,35,36,37,38,39,40,44,45,112,113,114,115,116,117,118,119,120,121,122,123,144,145]
});

/* Killed key codes:
 16:  shift          17:  ctrl           18:  alt            19:  pause          20:  caps lock
 27:  escape         33:  page up        34:  page down      35:  end            36:  home
 37:  left           38:  up             39:  right          40:  down           44:  print screen
 45:  insert         112: f1             113: f2             114: f3             115: f4
 116: f5             117: f6             118: f7             119: f8             120: f9
 121: f10            122: f11            123: f12            144: num lock       145: scroll lock

 These could be included, but Opera handles them incorrectly:
 91:  Windows (Opera reports both the Windows key and "[" as 91.)
 93:  context menu (Opera reports the context menu key as 0, and "]" as 93.) */


//---------------------------------------------------------------------+
// Page setup
//---------------------------------------------------------------------+

(function () {
    var	f = RegexPal.fields,
        o = f.options;

    onresize = function (e) {
        // Make the input field fill viewport height
        //f.input.field.style.height = Math.max((window.innerHeight || document.documentElement.clientHeight) - 210, 60) + "px";
        f.search.setDimensions();
        f.input.setDimensions();
    };
    onresize(); // Immediately resize to viewport height

    // Run a match and syntax highlighting with whatever data exists onload
    RegexPal.highlightSearchSyntax();
    RegexPal.highlightMatches();

    for (var flag in o.flags) {
        o.flags[flag].onclick = RegexPal.highlightMatches;
    }

    o.highlightSyntax.onclick  = RegexPal.highlightSearchSyntax;
    o.highlightMatches.onclick = RegexPal.highlightMatches;
    o.invertMatches.onclick    = RegexPal.highlightMatches;

    function makeResetter (field) {
        return function () {
            field.clearBg();
            field.textbox.value = "";
            field.textbox.onfocus = null;
        };
    };
    if (f.search.textbox.value === "Enter regex here.") {
        f.search.textbox.onfocus = makeResetter(f.search);
    }
    if (f.input.textbox.value === "Enter test data here.") {
        f.input.textbox.onfocus = makeResetter(f.input);
    }

    if (isIE6) {
        onunload = function (e) {
            // No need to purge the potentially numerous descendants of the background <pre> elements
            f.search.clearBg();
            f.input.clearBg();
            // Remove event handlers to clear memory leaks
            purge(document.body);
        };
    }
})();


$(function(){
    $('#commonRegex .bd li a').bind('click', function(){
        if($(this).attr('data-regex') !== $('#searchText').val()) {
            $('#searchText').val($(this).attr('data-regex')).trigger('keydown').trigger('keyup');
        }
        return false;
    })
})