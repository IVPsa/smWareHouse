function getBacodeFormat() {
    var barcodeFormat = 0,
        ckbFormats = $('.barcodeType input[type=checkbox]');

    for (var i = 0; i < ckbFormats.length; i++) {

        if (ckbFormats[i].checked == true)
            barcodeFormat = barcodeFormat | (ckbFormats[i].value * 1);
    }

    return barcodeFormat;
}

function getMaxBarcodesNumPerPage() {
    var iMaxNumPerPage = parseInt($('#tbMaxNumPerPage').val());

    if (isNaN(iMaxNumPerPage) || iMaxNumPerPage > MaxBarcodesNumPerPage) {
        $('#tbMaxNumPerPage').val(MaxBarcodesNumPerPage);
        return MaxBarcodesNumPerPage;
    } else if (iMaxNumPerPage < MinBarcodesNumPerPage) {
        $('#tbMaxNumPerPage').val(MinBarcodesNumPerPage);
        return MinBarcodesNumPerPage;
    }

    $('#tbMaxNumPerPage').val(iMaxNumPerPage);
    return iMaxNumPerPage;
}

function getTimeoutPerPage() {
    var iTimeoutPerPage = parseInt($('#tbTimeoutPerPage').val());

    if (isNaN(iTimeoutPerPage) || iTimeoutPerPage > MaxTimeoutPerPage) {
        $('#tbTimeoutPerPage').val(MaxTimeoutPerPage);
        return MaxTimeoutPerPage;
    } else if (iTimeoutPerPage < MinTimeoutPerPage) {
        $('#tbTimeoutPerPage').val(MinTimeoutPerPage);
        return MinTimeoutPerPage;
    }

    $('#tbTimeoutPerPage').val(iTimeoutPerPage);
    return iTimeoutPerPage;
}

function getImgCaptureDevice() {
    return parseInt($('#sltImgCaptureDevice').val());
}

function getBarcodeOrientationType() {
    return parseInt($('#sltBarcodeOrientationType').val());
}

function getBarcodeTextEncoding() {    
    return parseInt($('#sltBarcodeTextEncoding').val());
}

function getBarcodeColorMode() {
    var ckbLightOnDark = $('#lightOnDark'),
        ckbDarkOnLight = $('#darkOnLight'),
        bLightOnDarkChecked = ckbLightOnDark.prop('checked'),
        bDarkOnLightChecked = ckbDarkOnLight.prop('checked');

    if (bLightOnDarkChecked && bDarkOnLightChecked) {
        // BCM_DarkAndLight
        return 2;
    } else if (bLightOnDarkChecked && !bDarkOnLightChecked) {
        return parseInt(ckbLightOnDark.val());
    } else if (!bLightOnDarkChecked && bDarkOnLightChecked) {
        return parseInt(ckbDarkOnLight.val());
    } else {
        return parseInt(ckbDarkOnLight.val());
    }
}

function getUseOneDDeblurValue() {
    return $('#deBlur').prop('checked');
}

function setBarcodeOptions() {
    dbrObject.useOneDDeblur = getUseOneDDeblurValue();
    dbrObject.imageCaptureDevice = getImgCaptureDevice();
    dbrObject.barcodeFormats = getBacodeFormat();
    dbrObject.maxBarcodesNumPerPage = getMaxBarcodesNumPerPage();
    dbrObject.timeoutPerPage = getTimeoutPerPage();
    dbrObject.barcodeColorMode = getBarcodeColorMode();
    dbrObject.barcodeTextEncoding = getBarcodeTextEncoding();

    dbrObject.clearAllRegions();
    if(userRect.right > userRect.left && userRect.bottom > userRect.top) {
            
        var left = parseInt($('#tbRegionLeft').val());
        var top = parseInt($('#tbRegionTop').val());
        var right = parseInt($('#tbRegionRight').val());
        var bottom = parseInt($('#tbRegionBottom').val());
    
        if (!isNaN(left) && !isNaN(top) && !isNaN(right) && !isNaN(bottom)) {
            dbrObject.addRegion(left, top, right, bottom, false);
        }
    }

    dbrObject.clearAllAngles();
    var orientationType = getBarcodeOrientationType();
    if(orientationType == 0) {
        dbrObject.addAngle(dynamsoft.dbrEnv.EnumBarcodeOrientationType.EBOT_Horizontal);
    } else if(orientationType == 1) {
        dbrObject.addAngle(dynamsoft.dbrEnv.EnumBarcodeOrientationType.EBOT_Vertical);
    }
}

function onReadSuccess(userData, readResult) {
    displayResult(readResult);

    $('#liResults').click();

    showLoadingLayer(false);
}

function onReadError(userData, errCode, errMsg) {
    showLoadingLayer(false);

    alert(errMsg);
}

function decodeBarcode() {
    var index = $('#curPage').text();
    var imgSrc = sample_images_base64string[index - 1];

    if (imgSrc.indexOf("base64,") > 0) {
        var base64img = imgSrc.split(',')[1];
        showLoadingLayer(true);
        dbrObject.readBase64Async(base64img, 1, onReadSuccess, onReadError);
    } else {
        alert("Invalid base64 string.");
    	//showLoadingLayer(true);
        //dbrObject.readBinaryAsync(global_objInput.files[0], 1, onReadSuccess, onReadError);
    }
}

function displayResult(data) {
    var barcodeCount = data.getCount();

    var boundingRect = {};
    var result = ['Total barcode(s) found: ', barcodeCount, '. <br/><br/>'];

    for (var i = 0; i < barcodeCount; i++) {
        var barcode = data.get(i);

        boundingRect["Left"] = barcode.left;
        boundingRect["Top"] = barcode.top;
        boundingRect["Right"] = barcode.width + barcode.left;
        boundingRect["Bottom"] = barcode.height + barcode.top;

        addResultRect(i + 1, boundingRect, false);

        result.push('Barcode: ' + (i + 1) + '<br/>');
        result.push('Type: <b>' + barcode.formatString + '</b><br/>');
        result.push('Value: <b>' + convertTextForHTML(barcode.text) + '</b><br/>');
        result.push('Region: {Left: ' + barcode.left + ', Top: ' + barcode.top
            + ', Width: ' + barcode.width
            + ', Height: ' + barcode.height + '}' + '<br/>');
        result.push('Module Size: ' + barcode.moduleSize + '<br/>');
        result.push('Angle: ' + barcode.angle + '<br/><br/>');
    }

    $('#divResult').html(result.join(''));
}

function addResultRect(index, boundingRect, isUnrecognized) {
    var restRectPosition = getResultRectPosition(boundingRect),
        strDiv = [
            '<div class="rect ',
            isUnrecognized ? 'unrecognized' : 'recognized', '"',
            ' style="top: ', restRectPosition.top, 'px; ',
            'left: ', restRectPosition.left, 'px; ',
            'width: ', restRectPosition.right - restRectPosition.left, 'px; ',
            'height: ', restRectPosition.bottom - restRectPosition.top, 'px;">',
            '<span>[',index,']</span>',
            '</div>'
        ].join('');

    $("#divImgWrapper").append(strDiv);
}

function getResultRectPosition(actualImgRect) {
    var rect = { left: 0, top: 0, right: 0, bottom: 0 },
        imageRect = {};

    imageRect.top = global_objImg.offsetTop;
    imageRect.left = global_objImg.offsetLeft;
    imageRect.bottom = global_objImg.offsetTop + global_objImg.offsetHeight;
    imageRect.right = global_objImg.offsetLeft + global_objImg.offsetWidth;

    rect.left = parseInt(
        actualImgRect.Left / varCurrentImageWidth *
        (imageRect.right - imageRect.left) +
        imageRect.left
    );

    rect.top = parseInt(
        actualImgRect.Top / varCurrentImageHeight *
        (imageRect.bottom - imageRect.top) +
        imageRect.top
    );

    rect.right = parseInt(
        (actualImgRect.Right - actualImgRect.Left + 1) / varCurrentImageWidth * (imageRect.right - imageRect.left + 2)
        + rect.left + 1
    );

    rect.bottom = parseInt(
        (actualImgRect.Bottom - actualImgRect.Top + 1) / varCurrentImageHeight * (imageRect.bottom - imageRect.top + 3)
        + rect.top + 1
    );

    return rect;
}

function removeRectAndResult(bNotHideSelector) {
    $('#divResult').text('');

    $('#divImgWrapper .rect').remove();

    if (!bNotHideSelector) {
        $('#imgSelector').hide();
        userRect.left = 0;
        userRect.top = 0;
        userRect.right = 0;
        userRect.bottom = 0;
    }
}

$('#btnReadBarcode').on('click', function (e) {
    e.preventDefault();

    removeRectAndResult(true);

    setBarcodeOptions();
    decodeBarcode();
});

function convertTextForHTML(str) {
    str = str.replace(/</g, '&lt;');
    str = str.replace(/>/g, '&gt;');
    str = ['<pre class="resultPre">', str, '</pre>'].join('');
    if ((str.indexOf('\n') & str.indexOf('\r')) != -1) {
        str = '<br>' + str;
    }
    return str;
}
