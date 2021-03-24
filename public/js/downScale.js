// Take an image URL, downscale it to the given width, and return a new image URL.
var promiseImage = function(img) {
    return new Promise((resolve, reject) => {
        img.onload = () => resolve(img)
        img.onerror = reject
    })
}
var downScale = async function downscaleImage(dataUrl, newWidth, imageType) {
    "use strict";
    var image, oldWidth, oldHeight, newHeight, canvas, ctx, newDataUrl;

    // Provide default values
    imageType = imageType || "image/jpeg";

    // Create a temporary image so that we can compute the height of the downscaled image.
    image = new Image();
    let loadImage = promiseImage(image)
    image.src = dataUrl;
    await loadImage
    oldWidth = image.width;
    oldHeight = image.height;
    newHeight = Math.floor(oldHeight / oldWidth * newWidth)


    // Create a temporary canvas to draw the downscaled image on.
    canvas = document.createElement("canvas");
    canvas.width = newWidth;
    canvas.height = newHeight;

    // Draw the downscaled image on the canvas and return the new data URL.
    ctx = canvas.getContext("2d");
    ctx.drawImage(image, 0, 0, newWidth, newHeight);
    newDataUrl = canvas.toDataURL(imageType);
    return newDataUrl;
}
export default downScale