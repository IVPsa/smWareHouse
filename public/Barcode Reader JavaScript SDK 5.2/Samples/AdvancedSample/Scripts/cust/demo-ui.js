// tab navigation
$("#tabNav li").each(function (index, element) {
    $(this).click(function () {
        $("#tabNav li").removeClass('on');
        $(this).addClass('on');
        $(".section").removeClass('on');
        $(".section").eq(index).addClass('on');
    });
});

(function () {
    (function ($) {

        $.fn.easyTooltip = $.fn.easyTooltip || function (options) {

            // default configuration properties
            var defaults = {
                xOffset: 10,
                yOffset: 25,
                tooltipId: "easyTooltip",
                clickRemove: false,
                content: "",
                useElement: ""
            };

            var options = $.extend(defaults, options);
            var content;

            this.each(function () {
                var title = $(this).attr("title");
                $(this).hover(function (e) {
                    content = (options.content != "") ? options.content : title;
                    content = (options.useElement != "") ? $("#" + options.useElement).html() : content;
                    $(this).attr("title", "");
                    if (content != "" && content != undefined) {
                        $("body").append("<div id='" + options.tooltipId + "' class=''>" + content + "</div>");
                        $("#" + options.tooltipId)
                            .css("position", "absolute")
                            .css("top", (e.pageY - options.yOffset) + "px")
                            .css("left", (e.pageX + options.xOffset) + "px")
                            .css("display", "none")
                            .fadeIn("fast")
                    }
                },
                function () {
                    $("#" + options.tooltipId).remove();
                    $(this).attr("title", title);
                });
                $(this).mousemove(function (e) {
                    $("#" + options.tooltipId)
                        .css("top", (e.pageY - options.yOffset) + "px")
                        .css("left", (e.pageX + options.xOffset) + "px")
                });
                if (options.clickRemove) {
                    $(this).mousedown(function (e) {
                        $("#" + options.tooltipId).remove();
                        $(this).attr("title", title);
                    });
                }
            });
        };
    })(jQuery);

    $("#lightOnDarkToolTip").easyTooltip({
        tooltipId: "tooltip",
        content: "<div class='tipBody' style='float:left; width:186px;'><div style='width:100%;'><img src='./Images/light-on-dark.png' style='width:100%; height:auto;'/></div></div>"
    });

    $("#darkOnLightToolTip").easyTooltip({
        tooltipId: "tooltip",
        content: "<div class='tipBody' style='float:left; width:186px;'><div style='width:100%;'><img src='./Images/dark-on-light.png' style='width:100%; height:auto;'/></div></div>"
    });

    $("#deblurOneDToolTip").easyTooltip({
        tooltipId: "tooltip",
        content: "<div class='tipBody' style='float:left; width:186px;'><div style='width:100%;'><img src='./Images/deblur-oned.png' style='width:100%; height:auto;'/></div></div>"
    });
})();

var MaxHeight = 480;
var MaxWidth = 450;
var Per = 0.98;
var OriginWidth = 0;

function InitialPreviewIMG() {
    //var iOnloadCount = 0;
    for (var i = 0; i < sample_images_base64string.length; i++) {
        var img = new Image();
        img.src = sample_images_base64string[i];
        img.index = i;

        if (i <= 10) {
            img.onload = function () {
                //iOnloadCount++;
                if (this.index == 0) {
                    InitialPreviewIMGInner(this.src, global_objImg, true);
                    showLoadingLayer(false);
                }
            }

            img.onerror = function () {
                //iOnloadCount++;
                showLoadingLayer(false);
            }
        }
    }
}

function ShowLastUploadImage() {
    $('#allPage').text(sample_images_base64string.length);
    $('#curPage').text(sample_images_base64string.length);

    $('#divImgLoading').hide();

    var img = new Image();
    img.src = sample_images_base64string[sample_images_base64string.length - 1];

    img.onload = function () {
        InitialPreviewIMGInner(this.src, global_objImg, true);
        showLoadingLayer(false);
    }

    img.onerror = function () {
        showLoadingLayer(false);
    }
}

function GetNextImage() {
    var index = $('#curPage').text();
    if (index == "" || index == 0)
        index = 1;
    index = parseInt(index);

    index += 1;
    var count = sample_images_base64string.length;
    if (index == count + 1) {
        $('#curPage').text(count);
        return;
    } else {
        $('#curPage').text(index);
    }

    var imgSrc = sample_images_base64string[index - 1];
    ShowImgWithURL(imgSrc, global_objImg, false);
}

function GetPreImage() {
    var index = $('#curPage').text();
    if (index == "" || index == 0)
        index = 1;
    index = parseInt(index);
    index -= 1;
    if (index == 0) {
        $('#curPage').text(1);
        return;
    } else {
        $('#curPage').text(index);
    }

    var imgSrc = sample_images_base64string[index - 1];
    ShowImgWithURL(imgSrc, global_objImg, false);
}

function imgPageNum() {
    var count = sample_images_base64string.length;
    $('#allPage').text(count);
    $('#curPage').text(1);
}

$('#pagination .left').on('click', function(e) {
    GetPreImage();
    $('#liSettings').click();
});

$('#pagination .right').on('click', function (e) {
    GetNextImage();
    $('#liSettings').click();
});

var MinBarcodesNumPerPage = 1,
    MaxBarcodesNumPerPage = 100,
    curMaxBarcodesNumPerPage = 100,

    MinTimeoutPerPage = 1,
    MaxTimeoutPerPage = 60 * 60 * 1000,
    curTimeoutPerPage = 15000,

    maxBarcodeWidth = 10000;

function isCurImgValid() {
    return !(isNaN(varCurrentImageWidth) || isNaN(varCurrentImageHeight)
        || varCurrentImageWidth <= 0 || varCurrentImageHeight <= 0);
}

$('.barcodeType input[type=checkbox]').on('click', function(e) {
    var chkTypes = $('.barcodeType input[type=checkbox]'),
        bHasTypeCheck = false;

    for (var i = 0; i < chkTypes.length; i++) {
        bHasTypeCheck = bHasTypeCheck || $(chkTypes[i]).prop('checked');
    }

    if (!bHasTypeCheck) $(this).prop('checked', true);
});

function FillRegionTbs(left, top, right, bottom) {
    if (!isCurImgValid) return;

    if (arguments.length === 0) {
        $('#tbRegionLeft').val(0);
        $('#tbRegionRight').val(varCurrentImageWidth);
        $('#tbRegionTop').val(0);
        $('#tbRegionBottom').val(varCurrentImageHeight);

    }else if (arguments.length === 4) {
        $('#tbRegionLeft').val(left);
        $('#tbRegionRight').val(right);
        $('#tbRegionTop').val(top);
        $('#tbRegionBottom').val(bottom);
    }
}

function initTbs() {
    $('#tbMaxNumPerPage').val(curMaxBarcodesNumPerPage);
    $('#tbTimeoutPerPage').val(curTimeoutPerPage);
}

function ajustImgRelatedTbs() {
    if (!isCurImgValid) return;
}

function validateTbValue(el) {
    var inputedValue = parseInt(el.val());
    switch (el.prop('id')) {
        case 'tbMaxNumPerPage':
            if (isNaN(inputedValue)) {

            } else if (inputedValue < 1) {
                curMaxBarcodesNumPerPage = 1;
            } else if (inputedValue > MaxBarcodesNumPerPage) {
                curMaxBarcodesNumPerPage = MaxBarcodesNumPerPage;
            } else {
                curMaxBarcodesNumPerPage = inputedValue;
            }

            el.val(curMaxBarcodesNumPerPage);
            break;

        case 'tbTimeoutPerPage':
            if (isNaN(inputedValue)) {

            } else if (inputedValue < 1) {
                curTimeoutPerPage = 1;
            } else if (inputedValue > MaxTimeoutPerPage) {
                curTimeoutPerPage = MaxTimeoutPerPage;
            } else {
                curTimeoutPerPage = inputedValue;
            }

            el.val(curTimeoutPerPage);
            break;

        default:
            break;
    }
}


function showLoadingLayer(bShow) {
    if (bShow) {
        $('#divMask').show();
        $('#divLoader').show();
    } else {
        $('#divMask').hide();
        $('#divLoader').hide();
    }
}

//---draw rect---
var enumMouseButton = { LEFT: 0, MIDDLE: 1, RIGHT: 2 },
    imgSelector = document.getElementById('imgSelector'),
    clickedX = 0,
    clickedY = 0,
    curX = 0,
    curY = 0,
    // img's real width & height
    orgImgInfo = { width: 0, height: 0 },
    // current img rect in imgContainer
    imgRect = { left: 0, top: 0, right: 0, bottom: 0 },
    // the actual region on imgObject 
    actualImgRect = { left: 0, top: 0, right: 0, bottom: 0 },
    userRect = { left: 0, top: 0, right: 0, bottom: 0 },
    intersectionRect = { left: 0, top: 0, right: 0, bottom: 0 },
    bDrawing;

// get mouse offset position
function getOffset(evt, target) {
    evt = evt || window.event;
    var parent = document.getElementById('divImgWrapper'),
        el = target || evt.target,
        x = 0, y = 0, parentLeft = parent.clientLeft, parentTop = parent.clientTop,
        scrollTop, scrollLeft, bFixed = false;

    while (el && !isNaN(el.offsetLeft) && !isNaN(el.offsetTop)) {

        scrollLeft = el.scrollLeft;
        scrollTop = el.scrollTop;

        if (el.tagName === 'BODY') {
            if (bFixed) {
                scrollLeft = 0;
                scrollTop = 0;
            } else {
                scrollLeft = scrollLeft | document.documentElement.scrollLeft;
                scrollTop = scrollTop | document.documentElement.scrollTop;
            }
        } else {
            if (el.style.position === 'fixed') {
                bFixed = true;
            }
        }

        x += el.offsetLeft - scrollLeft;
        y += el.offsetTop - scrollTop;

        el = el.offsetParent;
    }

    x = evt.clientX - x - parentLeft;
    y = evt.clientY - y - parentTop;

    return { 'x': x, 'y': y };
}

function detectButton(evt) {
    evt = evt || window.event;

    if (evt.which == null) {
        return (evt.button < 2) ? enumMouseButton.LEFT :
            ((evt.button == 4) ? enumMouseButton.MIDDLE : enumMouseButton.RIGHT);
    }
    else {
        return (evt.which < 2) ? enumMouseButton.LEFT :
            ((evt.which == 2) ? enumMouseButton.MIDDLE : enumMouseButton.RIGHT);
    }
};

function calcUserRect() {
    if (curX < clickedX) curX += 1;
    if (curY < clickedY) curY += 1;

    var width = Math.abs(curX - clickedX),
        height = Math.abs(curY - clickedY);

    userRect.top = (curY < clickedY) ? curY : clickedY;
    userRect.left = (curX < clickedX) ? curX : clickedX;
    userRect.right = userRect.left + width;
    userRect.bottom = userRect.top + height;
};

function calcIntersectionRect() {
    intersectionRect.left = Math.max(userRect.left, imgRect.left);
    intersectionRect.right = Math.min(userRect.right, imgRect.right);
    intersectionRect.top = Math.max(userRect.top, imgRect.top);
    intersectionRect.bottom = Math.min(userRect.bottom, imgRect.bottom);
};

function hideImgSelector() {
    imgSelector.style.display = 'none';
};

function positionSelector() {
    intersectionRect.top = intersectionRect.top < 0 ? 0 : intersectionRect.top;
    intersectionRect.top = (intersectionRect.top > imgRect.top) ? intersectionRect.top : imgRect.top;

    intersectionRect.left = intersectionRect.left < 0 ? 0 : intersectionRect.left;
    intersectionRect.left = (intersectionRect.left > imgRect.left) ? intersectionRect.left : imgRect.left;

    if (intersectionRect.right > imgRect.right) {
        intersectionRect.right = imgRect.right;
    }

    if (intersectionRect.bottom > imgRect.bottom) {
        intersectionRect.bottom = imgRect.bottom;
    }

    var top = intersectionRect.top,
        left = intersectionRect.left,
        width = intersectionRect.right - intersectionRect.left,
        height = intersectionRect.bottom - intersectionRect.top;

    if (width > 0 && height > 0) {
        imgSelector.style.top = top + 'px';
        imgSelector.style.left = left + 'px';
        imgSelector.style.width = width + 'px';
        imgSelector.style.height = height + 'px';
        
        imgSelector.style.display = 'block';
    } else {
        hideImgSelector();
    }
};

function displayImgSelector() {
    calcUserRect();
    calcIntersectionRect();

    if (!((intersectionRect.right - intersectionRect.left > 0) &&
        (intersectionRect.bottom - intersectionRect.top > 0))) {
        hideImgSelector();
        return;
    }

    positionSelector();
};

function drawSelector(mousePosition) {
    curX = mousePosition.x;
    curY = mousePosition.y;

    displayImgSelector();
};

function clearMousePosition() {
    clickedX = 0;
    clickedY = 0;
    curX = 0;
    curY = 0;
};

function calcActualImgRect() {
    if (intersectionRect.right <= intersectionRect.left ||
        intersectionRect.bottom <= intersectionRect.top) {
        FillRegionTbs();
        return;
    }

    actualImgRect.top = (
        (intersectionRect.top - imgRect.top + 1) /
        (imgRect.bottom - imgRect.top + 1) *
        orgImgInfo.height
    );
    if (intersectionRect.top === imgRect.top) actualImgRect.top = 0;
    actualImgRect.top = actualImgRect.top < 0 ? 0 : actualImgRect.top;

    actualImgRect.left = (
        (intersectionRect.left - imgRect.left + 1) /
        (imgRect.right - imgRect.left + 1) *
        orgImgInfo.width
    );
    if (intersectionRect.left === imgRect.left) actualImgRect.left = 0;
    actualImgRect.left = actualImgRect.left < 0 ? 0 : actualImgRect.left;

    actualImgRect.bottom = (
        (intersectionRect.bottom - intersectionRect.top + 1) /
        (imgRect.bottom - imgRect.top + 1) *
        orgImgInfo.height +
        actualImgRect.top
    );
    actualImgRect.bottom = actualImgRect.bottom > orgImgInfo.height ? orgImgInfo.height : actualImgRect.bottom;

    actualImgRect.right = (
        (intersectionRect.right - intersectionRect.left + 1) /
        (imgRect.right - imgRect.left + 1) *
        orgImgInfo.width +
        actualImgRect.left
    );
    actualImgRect.right = actualImgRect.right > orgImgInfo.width ? orgImgInfo.width : actualImgRect.right;

    actualImgRect.top = parseInt(actualImgRect.top) < 0 ? 0 : parseInt(actualImgRect.top);
    actualImgRect.left = parseInt(actualImgRect.left) < 0 ? 0 : parseInt(actualImgRect.left);
    actualImgRect.bottom = parseInt(actualImgRect.bottom) > orgImgInfo.height ? orgImgInfo.height : parseInt(actualImgRect.bottom);
    actualImgRect.right = parseInt(actualImgRect.right) > orgImgInfo.width ? orgImgInfo.width : parseInt(actualImgRect.right);

    FillRegionTbs(actualImgRect.left, actualImgRect.top, actualImgRect.right, actualImgRect.bottom);
};

function drawingFinished() {
    bDrawing = false;
    calcActualImgRect();
    clearMousePosition();
};

$('#divImgWrapper').on('mousedown', function(evt) {
    evt = evt || window.event;
    if (detectButton(evt) != enumMouseButton.LEFT) return;

    var mousePosition = getOffset(evt, this);
    
    clickedX = mousePosition.x;
    clickedY = mousePosition.y;

    orgImgInfo.width = varCurrentImageWidth;
    orgImgInfo.height = varCurrentImageHeight;

    imgRect.top = global_objImg.offsetTop;
    imgRect.left = global_objImg.offsetLeft;
    imgRect.bottom = global_objImg.offsetTop + global_objImg.offsetHeight - 1;
    imgRect.right = global_objImg.offsetLeft + global_objImg.offsetWidth - 1;

    bDrawing = true;
});

$('#divImgWrapper').on('mousemove', function (evt) {
    if (!bDrawing) return;

    evt = evt || window.event;
    var mousePosition = getOffset(evt, this);
    
    drawSelector(mousePosition);

    calcActualImgRect();
});

$('#divImgWrapper').on('mouseup', function (evt) {
    evt = evt || window.event;
    if (detectButton(evt) != enumMouseButton.LEFT) return;

    if (bDrawing) {
        var mousePosition = getOffset(evt, this);
        drawSelector(mousePosition);

        drawingFinished();
    }
});

$(document).on('mouseup', function(evt) {
    evt = evt || window.event;

    if (bDrawing) {
        var divImgWrapper = document.getElementById('divImgWrapper'),
            mousePosition = getOffset(evt, divImgWrapper);

        if (isNaN(mousePosition.x) || isNaN(mousePosition.y)) return;

        var outerDivWidth = divImgWrapper.clientWidth,
            outerDivHeight = divImgWrapper.clientHeight;

        if (mousePosition.x >= 0 && mousePosition.x <= outerDivWidth &&
            mousePosition.y >= 0 && mousePosition.y <= outerDivHeight) return;

        drawingFinished();
    }
});

function initUploadControl() {
    $('#upLoadFile').change(readLocalFile);
    $('#uploadFileName').val('');
}

function readLocalFile() {
    if (typeof FileReader == "undefined") {
        //$('#divImgLoading').html("This demo uses html5 FileReader object. Your browser doesn't support it. Please try other " + '<a target="_blank" class="bluelink" href="http://caniuse.com/#search=FileReader">browsers</a>' + '.');    
        //$('#divImgLoading').show();
        alert("This demo uses html5 FileReader object. Your browser doesn't support it.");
        return;
    }
    
    if(this.files.length == 0){
        return;
    }
    
    $('#divImgLoading').show();
    $('#liSettings').click();

    showLoadingLayer(true);
        
    var file = this.files[0];
    if (!file.name.match(/.jpg|.jpeg|.gif|.png|.bmp/i)) {
        $('#divImgLoading').hide();
        showLoadingLayer(false);
        alert("Only 'bmp','jpg','jpeg','gif','png' supported.");
        return false;
    }

    $('#uploadFileName').val(file.name);

	var reader = new FileReader();
	reader.readAsDataURL(file);
	
	reader.onload = function (e) {		
        sample_images_base64string = [];
        sample_images_base64string.push(this.result);
    	ShowLastUploadImage(); 		
	}
}

window.onload = function () {
    //prettyPrint();
    initTbs();
    imgPageNum();
    InitialPreviewIMG();
    initUploadControl();
}

