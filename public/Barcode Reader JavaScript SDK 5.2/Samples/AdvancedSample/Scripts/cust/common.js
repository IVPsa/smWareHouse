var varCurrentImageWidth = 0, varCurrentImageHeight = 0;

function InitialPreviewIMGInner(ImgSrc, objImage, bAleady) {
    ShowImgWithURL(ImgSrc, objImage, bAleady);
}

function ShowImgWithURL(imgSrc, objImage, bAleady) {
    if (bAleady) {
        objImage.src = imgSrc;
    } else {
        ShowImgInner(imgSrc, objImage);
    }

    ShowImgSize(imgSrc);
  
    if (removeRectAndResult) removeRectAndResult();
}

function ShowImgInner(imgSrc, objImage) {
    $('#divImgLoading').show();

    objImage.src = "";

    var img = new Image();
    img.onload = function () {
        objImage.src = imgSrc;
        $('#divImgLoading').hide();

        img = null;
    }
    img.src = imgSrc;
}

function ShowImgSize(ImgSrc) {
    var img = new Image();

    img.onload = function () {
        varCurrentImageWidth = img.width;
        varCurrentImageHeight = img.height;

        FillRegionTbs();

        ShowImgSizeInner();
        img = null;
    }
    img.src = ImgSrc;
}

function ShowImgSizeInner() {
    var imgWidth, imgHeight,
        imgControl = document.getElementById('divImgWrapper'),
        iImageControlWidth = imgControl.clientWidth,
        iImageControlHeight = imgControl.clientHeight;

    if (varCurrentImageWidth / iImageControlWidth > varCurrentImageHeight / iImageControlHeight) {
        imgWidth = iImageControlWidth;
        imgHeight = varCurrentImageHeight * iImageControlWidth / varCurrentImageWidth;
    } else {
        imgHeight = iImageControlHeight;
        imgWidth = varCurrentImageWidth * iImageControlHeight / varCurrentImageHeight;
    }

    positionObjImg(imgWidth, imgHeight, iImageControlWidth, iImageControlHeight);

}

function positionObjImg(imgWidth, imgHeight, iImageControlWidth, iImageControlHeight) {
    global_objImg.style.position = 'absolute';
    global_objImg.style.top = Math.round((iImageControlHeight - imgHeight) / 2) + 'px';
    global_objImg.style.left = Math.round((iImageControlWidth - imgWidth) / 2) + 'px';
    global_objImg.style.width = parseInt(imgWidth) + 'px';
    global_objImg.style.height = parseInt(imgHeight) + 'px';
};
